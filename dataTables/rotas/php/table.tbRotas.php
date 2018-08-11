<?php

/*
 * Editor server script for DB table tbRotas
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
$db->sql( "CREATE TABLE IF NOT EXISTS `tbRotas` (
	`id` int(10) NOT NULL auto_increment,
	`origem` varchar(20),
	`uforigem` varchar(2),
	`codorigem` bigint(7),
	`destino` varchar(20),
	`ufdestino` varchar(2),
	`coddestino` bigint(7),
	`distancia` int(4),
	`horariopartida` time,
	`horariochegada` time,
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
// Build our Editor instance and process the data coming from _POST
Editor::inst( $db, 'tbRotas', 'id' )
	->fields(
		Field::inst( 'tbRotas.origem' )
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
		Field::inst( 'tbRotas.uforigem' )
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
		Field::inst( 'tbRotas.codorigem' )
				->options( Options::inst()
					->table( 'location' )
					->value( 'id' )
					->label( 'codigo' )
				)
							->validator( Validate::dbValues() )
							->validator( Validate::notEmpty(
												ValidateOptions::inst()
												->message( '*Obrigatório' )
												) ),
											Field::inst( 'l3.codigo' ),
		Field::inst( 'tbRotas.destino' )
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
													Field::inst( 'l4.cidade' ),
		Field::inst( 'tbRotas.ufdestino' )
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
											Field::inst( 'l5.uf' ),
		Field::inst( 'tbRotas.coddestino' )
				->options( Options::inst()
					->table( 'location' )
					->value( 'id' )
					->label( 'codigo' )
				)
							->validator( Validate::dbValues() )
							->validator( Validate::notEmpty(
												ValidateOptions::inst()
												->message( '*Obrigatório' )
												) ),
											Field::inst( 'l6.codigo' ),
		Field::inst( 'tbRotas.distancia' )
					->validator( Validate::minLen(
										6,
										ValidateOptions::inst()
										->message( 'Inválido' )
										) )
			/*		->validator( Validate::maxLen(
										4,
										ValidateOptions::inst()
										->message( 'Inválido' )
										) )
					->validator( Validate::unique(
										ValidateOptions::inst()
										->message( 'Já existe' )
										) )   */
					->validator( Validate::notEmpty(
										ValidateOptions::inst()
										->message( '*Obrigatório' )
										) ),
		Field::inst( 'tbRotas.horariopartida' )
			->validator( Validate::dateFormat( 'H:i' ) )
			->getFormatter( Format::datetime( 'H:i:s', 'H:i' ) )
			->setFormatter( Format::datetime( 'H:i', 'H:i:s' ) )
		/*				->validator( Validate::minLen(
											4,
											ValidateOptions::inst()
											->message( 'Inválido' )
											) )
						->validator( Validate::maxLen(
											4,
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
		Field::inst( 'tbRotas.horariochegada' )
			->validator( Validate::dateFormat( 'H:i' ) )
			->getFormatter( Format::datetime( 'H:i:s', 'H:i' ) )
			->setFormatter( Format::datetime( 'H:i', 'H:i:s' ) )
		/*				->validator( Validate::minLen(
											4,
											ValidateOptions::inst()
											->message( 'Inválido' )
											) )
						->validator( Validate::maxLen(
											4,
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
											) )
	)
	->leftJoin( 'location as l1', 'tbRotas.origem', '=', 'l1.id' )
	->leftJoin( 'location as l2', 'tbRotas.uforigem', '=', 'l2.id' )
	->leftJoin( 'location as l3', 'tbRotas.codorigem', '=', 'l3.id' )
	->leftJoin( 'location as l4', 'tbRotas.destino', '=', 'l4.id' )
	->leftJoin( 'location as l5', 'tbRotas.ufdestino', '=', 'l5.id' )
	->leftJoin( 'location as l6', 'tbRotas.coddestino', '=', 'l6.id' )

	->process( $_POST )
	->json();
