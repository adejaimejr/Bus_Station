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
			->table( 'tbviagens_rotas b, location origem, location dest' )
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
		Field::inst( 'tbviagens_rotas.horariopartida' ),
		Field::inst( 'tbviagens_rotas.horariochegada' ),
		Field::inst( 'tbviagens_onibus.marca' ),
		Field::inst( 'tbviagens_tarifas.nome' ),
		Field::inst( 'tbviagens_tarifas.normal' ),
		Field::inst( 'tbviagens_motorista.nome' )
			/*,
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
		Field::inst( 'tbonibus.marca' ),
		Field::inst( 'tbmotorista.nome' ),
		Field::inst( 'tbrotas.horariopartida' ),
		Field::inst( 'tbtarifas.nome' ),
		Field::inst( 'tbtarifas.normal' )		*/
	)
	//->leftJoin( 'location', 'location.id', '=', 'tbrotas.origem' )
	/*->leftJoin( 'tbrotas', 'tbrotas.id', '=', 'tbviagem.rota' )					
	
	*/
	->leftJoin( 'tbviagens_rotas', 'tbviagens_rotas.id', '=', 'tbviagem.rota' )
	->leftJoin( 'tbviagens_onibus', 'tbviagens_onibus.id', '=', 'tbviagem.onibus' )
	->leftJoin( 'tbviagens_tarifas', 'tbviagens_tarifas.id', '=', 'tbviagem.tarifa' )
	->leftJoin( 'tbviagens_motorista', 'tbviagens_motorista.id', '=', 'tbviagem.motorista' )
	->process( $_POST )
	->json();

