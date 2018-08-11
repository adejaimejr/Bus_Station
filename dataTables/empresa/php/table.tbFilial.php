<?php

/*
 * Editor server script for DB table tbFilial
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
$db->sql( "CREATE TABLE IF NOT EXISTS `tbfilial` (
	`id` int(10) NOT NULL auto_increment,
	`razao` varchar(40),
	`cnpj` varchar(18),
	`ie` varchar(10),
	`telefone` varchar(15),
	`logradouro` varchar(40),
	`numero` varchar(10),
	`bairro` varchar(20),
	`cep` varchar(9),
	`cidade` tinyint(4),
	`uf` tinyint(4),
	`tributacao` tinyint(4),
	PRIMARY KEY( `id` )
);" );
// CREATE TABLE " location "
$db->sql( "CREATE TABLE IF NOT EXISTS `location` (
	`id` int(10) NOT NULL auto_increment,
	`cidade` varchar(20),
	`uf` varchar(2),
	`codigo` bigint(10),
	PRIMARY KEY( `id` )
);" );
// Criar campos iniciais tabela location
//$db->sql("INSERT INTO `location` (`id`, `cidade`, `uf`) VALUES (NULL, 'MANAUS', 'AM'), (NULL, 'BOA VISTA', 'RR');");

// Build our Editor instance and process the data coming from _POST
Editor::inst( $db, 'tbFilial', 'id' )
	->fields(
		Field::inst( 'tbFilial.razao' )
					->validator( Validate::minLen(
										15,
										ValidateOptions::inst()
										->message( 'Minimo de 15 caracteres' )
										) )
					->validator( Validate::maxLen(
										40,
										ValidateOptions::inst()
										->message( 'Máximo de 40 caracteres' )
										) )
					->validator( Validate::unique(
										ValidateOptions::inst()
										->message( 'Já existe' )
										) )
					->validator( Validate::notEmpty(
										ValidateOptions::inst()
										->message( '*Obrigatório' )
										) ),
	Field::inst( 'tbFilial.cnpj' )
					->validator( Validate::minLen(
										18,
										ValidateOptions::inst()
										->message( '00.000.000/0000-00' )
										) )
					->validator( Validate::maxLen(
										18,
										ValidateOptions::inst()
										->message( '00.000.000/0000-00' )
										) )
					->validator( Validate::unique(
										ValidateOptions::inst()
										->message( 'Já existe' )
										) )
					->validator( Validate::notEmpty(
										ValidateOptions::inst()
										->message( '*Obrigatório' )
										) ),
		Field::inst( 'tbFilial.ie' )
					->validator( Validate::minLen(
										10,
										ValidateOptions::inst()
										->message( 'Ex: 0000000-0' )
										) )
					->validator( Validate::maxLen(
										10,
										ValidateOptions::inst()
										->message( 'Ex: 0000000-0' )
										) )
					->validator( Validate::unique(
										ValidateOptions::inst()
										->message( 'Já existe' )
										) )
					->validator( Validate::notEmpty(
										ValidateOptions::inst()
										->message( '*Obrigatório' )
										) ),
		Field::inst( 'tbFilial.telefone' )
					->validator( Validate::minLen(
										14,
										ValidateOptions::inst()
										->message( 'Fixo (99) 2100-0000 ou Celular (99) 98888-8888' )
										) )
					->validator( Validate::maxLen(
										15,
										ValidateOptions::inst()
										->message( '(99) 98888-8888' )
										) )
				/*	->validator( Validate::unique(
										ValidateOptions::inst()
										->message( 'Já existe' )
										) )  */
					->validator( Validate::notEmpty(
										ValidateOptions::inst()
										->message( '*Obrigatório' )
										) ),
		Field::inst( 'tbFilial.logradouro' )
					->validator( Validate::minLen(
										4,
										ValidateOptions::inst()
										->message( 'Inválido' )
										) )
					->validator( Validate::maxLen(
										40,
										ValidateOptions::inst()
										->message( 'Máximo de 40 caracteres' )
										) )
			/*		->validator( Validate::unique(
										ValidateOptions::inst()
										->message( 'Já existe' )
										) )   */
					->validator( Validate::notEmpty(
										ValidateOptions::inst()
										->message( '*Obrigatório' )
										) ),
		Field::inst( 'tbFilial.numero' )
		/*			->validator( Validate::minLen(
										4,
										ValidateOptions::inst()
										->message( 'Inválido' )
										) )   */
					->validator( Validate::maxLen(
										10,
										ValidateOptions::inst()
										->message( 'Inválido' )
										) )
			/*		->validator( Validate::unique(
										ValidateOptions::inst()
										->message( 'Já existe' )
										) )   */
					->validator( Validate::notEmpty(
										ValidateOptions::inst()
										->message( '*Obrigatório' )
										) ),
		Field::inst( 'tbFilial.bairro' )
					->validator( Validate::minLen(
										5,
										ValidateOptions::inst()
										->message( 'Inválido' )
										) )
					->validator( Validate::maxLen(
										20,
										ValidateOptions::inst()
										->message( 'Inválido' )
										) )
		/*			->validator( Validate::unique(
										ValidateOptions::inst()
										->message( 'Já existe' )
										) )  */
					->validator( Validate::notEmpty(
										ValidateOptions::inst()
										->message( '*Obrigatório' )
										) ),
		Field::inst( 'tbFilial.cep' )
					->validator( Validate::minLen(
										8,
										ValidateOptions::inst()
										->message( 'Inválido' )
										) )
					->validator( Validate::maxLen(
										9,
										ValidateOptions::inst()
										->message( 'Inválido' )
										) )
			/*		->validator( Validate::unique(
										ValidateOptions::inst()
										->message( 'Já existe' )
										) )   */
					->validator( Validate::notEmpty(
										ValidateOptions::inst()
										->message( '*Obrigatório' )
										) ),
//INICIO - Tabela que será puxado os dados - location
			Field::inst( 'tbFilial.cidade' )
							->options( Options::inst()
							->table( 'location' )
							->value( 'id' )
							->label( 'cidade' )
						)
									->validator( Validate::dbValues() )
									->validator( Validate::notEmpty(
														ValidateOptions::inst()
														->message( '*Obrigatório' )
														) ),
				Field::inst( 'l2.cidade' ),
//INICIO - Tabela que será puxado os dados - location
				Field::inst( 'tbFilial.uf' )
						->options( Options::inst()
							->table( 'location' )
							->value( 'id' )
							->label( 'uf' )
						)
									->validator( Validate::dbValues() )
									->validator( Validate::notEmpty(
														ValidateOptions::inst()
														->message( '*Obrigatório' )
														) ),
				Field::inst( 'l1.uf' ),
//INICIO - Tabela que será puxado os dados - tbtributacao
		   Field::inst( 'tbFilial.tributacao' )
					->options( Options::inst()
						->table( 'tbtributacao' )
						->value( 'id' )
						->label( 'nome' )
					)
								->validator( Validate::dbValues() )
								->validator( Validate::notEmpty(
													ValidateOptions::inst()
													->message( '*Obrigatório' )
													) ),
     Field::inst( 'tbtributacao.nome' )
)
//JOIN DADOS
->leftJoin( 'tbtributacao', 'tbtributacao.id', '=', 'tbFilial.tributacao' )
->leftJoin( 'location as l1', 'tbFilial.uf', '=', 'l1.id' )
->leftJoin( 'location as l2', 'tbFilial.cidade', '=', 'l2.id' )
	->process( $_POST )
	->json();
