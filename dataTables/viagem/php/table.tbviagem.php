<?php

/*
 * Editor server script for DB table tbviagem
 * Created by http://editor.datatables.net/generator
 */

// DataTables PHP library and database connection
include( "lib/DataTables.php" );

/*** Controle de sessão ***/
include("../../../session.php");
include("../../../utils.php");

if (!isSessionOK()) {
	return false;
}
/**************************/

// Alias Editor classes so they are easy to use
use
	DataTables\Editor,
	DataTables\Editor\Field,
	DataTables\Editor\Format,
	DataTables\Editor\Mjoin,
	DataTables\Editor\Options,
	DataTables\Editor\Upload,
	DataTables\Editor\Validate,
	DataTables\Editor\ValidateOptions;

// The following statement can be removed after the first run (i.e. the database
// table has been created). It is a good idea to do this to help improve
// performance.
$db->sql( "CREATE TABLE IF NOT EXISTS `tbviagem` (
	`id` int(10) NOT NULL auto_increment,
	`rota` int(10) NOT NULL,
	`onibus` int(10) NOT NULL,
	`tarifa` int(10) NOT NULL,
	`motorista` int(10) NOT NULL,
	PRIMARY KEY( `id` )
);" );

// Build our Editor instance and process the data coming from _POST
Editor::inst( $db, 'tbviagem', 'id' )
	->fields(
		Field::inst( 'tbviagem.dataviagem' ),
		Field::inst( 'tbviagem.rota' )
			->options( Options::inst()			
			->table( 'tbrotas b, location origem, location dest' )
			->value( 'b.id' )
			->label( ['b.id', 'b.origem', 'origem.id', 'origem.cidade', 'origem.uf', 'dest.id', 'dest.cidade', 'dest.uf', 'horariopartida', 'horariochegada' ])
			->render( function ( $row ) {
				return $row['horariopartida'].' - '.$row['origem.cidade'].','.$row['origem.uf'].'/'.$row['dest.cidade'].','.$row['dest.uf'];
			} )
			->where( function ($q) {				
				$q->where( 'origem.id', 'b.origem', '=', false); // false => segundo parâmetro é coluna; true => é valor
				$q->and_where( 'dest.id', 'b.destino', '=', false); // false => segundo parâmetro é coluna; true => é valor
			})
			)
			->validator( Validate::dbValues() ),
//		Field::inst( 'tbviagens.origem' ),
		Field::inst( 'tbviagem.onibus' )
			->options( Options::inst()			
			->table( 'tbonibus o' )
			->value( 'o.id' )
			->label( ['o.marca' ])
			)
			->validator( Validate::dbValues() ),
		Field::inst( 'tbviagem.tarifa' )
			->options( Options::inst()			
			->table( 'tbtarifas t' )
			->value( 't.id' )
			->label( ['t.nome' ])
			)
			->validator( Validate::dbValues() ),
		Field::inst( 'tbviagem.motorista' )
			->options( Options::inst()			
			->table( 'tbmotorista m' )
			->value( 'm.id' )
			->label( ['m.nome' ])
			)
			->validator( Validate::dbValues() ),
		Field::inst( 'tbviagens_onibus.marca' ),
		Field::inst( 'tbviagens_motorista.nome' ),
		Field::inst( 'tbviagens_rotas.horariopartida' ),
		Field::inst( 'tbviagens_rotas.horariochegada' ),
		Field::inst( 'tbviagens_tarifas.nome' ),
		Field::inst( 'tbviagens_tarifas.normal' )		
	)
    ->on( 'postCreate', function ( $editor, $id, $values, $row ) use ($db) {
		//logChange( $editor->db(), 'create', $id, $values );
		//$editor->db->insert( "tbviagens_rotas", ['origem' => '1']);	
		//[ 'myField' => $_POST['data']['addstock'] ] );
			
		$data = $_POST['data'];
		$viagem = $data[0]['tbviagem'];
		$rota = $viagem['rota'];
		$onibus = $viagem['onibus'];
		$tarifa = $viagem['tarifa'];
		$motorista = $viagem['motorista'];				

		// rota
		$db->sql( "insert tbviagens_rotas " .
			"(origem, uforigem, codorigem, destino, ufdestino, coddestino, distancia, horariopartida, horariochegada) " .
			"select origem, uforigem, codorigem, destino, ufdestino, coddestino, distancia, horariopartida, horariochegada " .
			"from tbrotas where tbrotas.id = ".$rota );

		$rows = $db->sql("select max(id) as id from tbviagens_rotas")->fetchAll();

		$newRota = $rows[0]["id"];

		$db->sql("update tbviagem set rota = ".$newRota." where id = ".$id);


		// onibus
		$db->sql( "insert tbviagens_onibus " .
			"(placa, classe, poltronas, anofabricacao, chassi, renavam, marca, modelo, vencimentoipva, quilometragem) " .
			"select placa, classe, poltronas, anofabricacao, chassi, renavam, marca, modelo, vencimentoipva, quilometragem " .
			"from tbonibus where tbonibus.id = ".$onibus );

		$rows = $db->sql("select max(id) as id from tbviagens_onibus")->fetchAll();

		$newOnibus = $rows[0]["id"];

		$db->sql("update tbviagem set onibus = ".$newOnibus." where id = ".$id);
	
		// poltronas
		$db->sql( "insert tbviagens_poltronas " .
			"(numero, onibus, disponivel) " .
			"select numero, ".$newOnibus.", disponivel " .
			"from tbpoltronas where onibus = ".$onibus );

		// passagens
		$db->sql( "insert tbviagens_passagens " .
			"(viagem, poltrona, disponivel) " .
			"select ".$id.", id, disponivel " .
			"from tbviagens_poltronas where onibus = ".$newOnibus );

		// tarifas
		$db->sql( "insert tbviagens_tarifas " .
			"(nome, normal, promocional, meiapassagem, pedagio, seguro) " .
			"select nome, normal, promocional, meiapassagem, pedagio, seguro " .
			"from tbtarifas where tbtarifas.id = ".$tarifa );

		$rows = $db->sql("select max(id) as id from tbviagens_tarifas")->fetchAll();

		$newTarifa = $rows[0]["id"];

		$db->sql("update tbviagem set tarifa = ".$newTarifa." where id = ".$id);
	
		// motorista
		$db->sql( "insert tbviagens_motorista " .
			"(nome, cpf, nascimento, email, telefone, cnh, validadecnh) " .
			"select nome, cpf, nascimento, email, telefone, cnh, validadecnh " .
			"from tbmotorista where tbmotorista.id = ".$motorista );		
		
		$rows = $db->sql("select max(id) as id from tbviagens_motorista")->fetchAll();

		$newMotorista = $rows[0]["id"];

		$db->sql("update tbviagem set motorista = ".$newMotorista." where id = ".$id);
	
    } )	
    //->on( 'postCreate', function ( $editor, $values ) {
	//	$db->sql( "insert tbviagens_rotas (origem) values(1)" );		
		//$editor->db->sql( "SELECT 1" );		
		//$sql = $db->sql( "UPDATE tblitem SET ItemPrice = '".$rspricelookup->getColumnVal("DefaultPrice")."' WHERE ItemID = '".$rowid."'");
		//IsClient( $editor->db(), $id ??? );		
    //} )	
	/*->on('postCreate', function($editor,$id,$values,$row) {
        //error_log('t.t.p: Created: id= ' . $id . ', catR= ' . $row['category'] . ', descR= ' . $row['description'] . ', catV= ' . $values['category'] . ', descV= ' . $values['description']);
		//notify($id,$values['category'],$values['description']);
		alert("ok");
    } )	*/
	//->leftJoin( 'location', 'location.id', '=', 'tbrotas.origem' )
	->leftJoin( 'tbviagens_rotas', 'tbviagens_rotas.id', '=', 'tbviagem.rota' )				
	->leftJoin( 'tbviagens_onibus', 'tbviagens_onibus.id', '=', 'tbviagem.onibus' )
	->leftJoin( 'tbviagens_motorista', 'tbviagens_motorista.id', '=', 'tbviagem.motorista' )
	->leftJoin( 'tbviagens_tarifas', 'tbviagens_tarifas.id', '=', 'tbviagem.tarifa' )
	->process( $_POST )
	->json();

	//if ($_SERVER['REQUEST_METHOD'] === 'POST') {	
	if(isset($_POST['action']) && $_POST['action'] == 'create'){
		/*$data = $_POST['data'];
		$viagem = $data[0]['tbviagem'];
		$rota = $viagem['rota'];
		$onibus = $viagem['onibus'];
		$tarifa = $viagem['tarifa'];
		$motorista = $viagem['motorista'];				

		//$dataset = $db->sql("select id from tbviagem where rota = ".$rota." and onibus = ".$onibus." and tarifa = ".$tarifa." and motorista = ".$motorista);
		$db->sql( "insert tbviagens_rotas " .
			"(origem, uforigem, codorigem, destino, ufdestino, coddestino, distancia, horariopartida, horariochegada) " .
			"select origem, uforigem, codorigem, destino, ufdestino, coddestino, distancia, horariopartida, horariochegada " .
			"from tbrotas where tbrotas.id = ".$rota );

		$rows = $db->sql("select max(id) as id from tbviagens_rotas")->fetchAll();

		$newRota = $rows[0]["id"];

		//$dataset = $db->sql("update tbviagem set rota = ".$newRota." where id = ".$viagem);

		//$db->sql( "update tbviagens set rota = ".newRotaId." where id = ".$viagemId);

		$db->sql( "insert tbviagens_onibus " .
			"(placa, classe, poltronas, anofabricacao, chassi, renavam, marca, modelo, vencimentoipva, quilometragem) " .
			"select placa, classe, poltronas, anofabricacao, chassi, renavam, marca, modelo, vencimentoipva, quilometragem " .
			"from tbonibus where tbonibus.id = ".$onibus );

		$db->sql( "insert tbviagens_tarifas " .
			"(nome, normal, promocional, meiapassagem, pedagio, seguro) " .
			"select nome, normal, promocional, meiapassagem, pedagio, seguro " .
			"from tbtarifas where tbtarifas.id = ".$tarifa );

		$db->sql( "insert tbviagens_motorista " .
			"(nome, cpf, nascimento, email, telefone, cnh, validadecnh) " .
			"select nome, cpf, nascimento, email, telefone, cnh, validadecnh " .
			"from tbmotorista where tbmotorista.id = ".$motorista );*/

	}
