<?php

/*
 * Editor server script for DB table tbOnibus
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
$db->sql( "CREATE TABLE IF NOT EXISTS `tbOnibus` (
	`id` int(10) NOT NULL auto_increment,
	`placa` varchar(8),
	`classe` varchar(20),
	`poltronas` tinyint(4),
	`anofabricacao` int(4),
	`chassi` varchar(17),
	`renavam` varchar(13),
	`marca` varchar(20),
	`modelo` varchar(20),
	`vencimentoipva` date,
	`quilometragem` bigint(20),
	PRIMARY KEY( `id` )
);" );

// Build our Editor instance and process the data coming from _POST
Editor::inst( $db, 'tbOnibus', 'id' )
	->fields(
		Field::inst( 'tbOnibus.placa' )
					->validator( Validate::minLen(
										8,
										ValidateOptions::inst()
										->message( 'Ex: JXX-3401' )
										) )
					->validator( Validate::maxLen(
										8,
										ValidateOptions::inst()
										->message( 'Ex: JXX-3401' )
										) )
					->validator( Validate::unique(
										ValidateOptions::inst()
										->message( 'Já existe' )
										) )
					->validator( Validate::notEmpty(
										ValidateOptions::inst()
										->message( '*Obrigatório' )
										) ),
		Field::inst( 'tbOnibus.classe' )
					->validator( Validate::minLen(
										5,
										ValidateOptions::inst()
										->message( 'Inválido' )
										) )
					->validator( Validate::maxLen(
										20,
										ValidateOptions::inst()
										->message( 'Máximo de 20 caracteres' )
										) )
			/*		->validator( Validate::unique(
										ValidateOptions::inst()
										->message( 'Já existe' )
										) ) */
					->validator( Validate::notEmpty(
										ValidateOptions::inst()
										->message( '*Obrigatório' )
										) ),
		Field::inst( 'tbOnibus.renavam' )
					->validator( Validate::minLen(
										13,
										ValidateOptions::inst()
										->message( 'Inválido' )
										) )
					->validator( Validate::maxLen(
										13,
										ValidateOptions::inst()
										->message( 'Máximo de 20 caracteres' )
										) )
					->validator( Validate::unique(
										ValidateOptions::inst()
										->message( 'Já existe' )
										) )
					->validator( Validate::notEmpty(
										ValidateOptions::inst()
										->message( '*Obrigatório' )
										) ),
		Field::inst( 'tbOnibus.poltronas' )
					->validator( Validate::minLen(
										2,
										ValidateOptions::inst()
										->message( 'Ex: 42' )
										) )
					->validator( Validate::maxLen(
										2,
										ValidateOptions::inst()
										->message( 'Ex: 42' )
										) )
			/*		->validator( Validate::unique(
										ValidateOptions::inst()
										->message( 'Já existe' )
										) ) */
					->validator( Validate::notEmpty(
										ValidateOptions::inst()
										->message( '*Obrigatório' )
										) ),
		Field::inst( 'tbOnibus.anofabricacao' )
					->validator( Validate::minLen(
										4,
										ValidateOptions::inst()
										->message( 'Ex: 2018' )
										) )
					->validator( Validate::maxLen(
										4,
										ValidateOptions::inst()
										->message( 'Ex: 2018' )
										) )
			/*		->validator( Validate::unique(
										ValidateOptions::inst()
										->message( 'Já existe' )
										) ) */
					->validator( Validate::notEmpty(
										ValidateOptions::inst()
										->message( '*Obrigatório' )
										) ),
		Field::inst( 'tbOnibus.chassi' )
					->validator( Validate::minLen(
										17,
										ValidateOptions::inst()
										->message( 'Ex: 9BHE21JX24060831' )
										) )
					->validator( Validate::maxLen(
										17,
										ValidateOptions::inst()
										->message( 'Ex: 9BHE21JX24060831' )
										) )
					->validator( Validate::unique(
										ValidateOptions::inst()
										->message( 'Já existe' )
										) )
					->validator( Validate::notEmpty(
										ValidateOptions::inst()
										->message( '*Obrigatório' )
										) ),
		Field::inst( 'tbOnibus.marca' )
					->validator( Validate::minLen(
										3,
										ValidateOptions::inst()
										->message( 'Inválido' )
										) )
					->validator( Validate::maxLen(
										20,
										ValidateOptions::inst()
										->message( 'Máximo de 20 caracteres' )
										) )
			/*		->validator( Validate::unique(
										ValidateOptions::inst()
										->message( 'Já existe' )
										) ) */
					->validator( Validate::notEmpty(
										ValidateOptions::inst()
										->message( '*Obrigatório' )
										) ),
		Field::inst( 'tbOnibus.modelo' )
					->validator( Validate::minLen(
										3,
										ValidateOptions::inst()
										->message( 'Inválido' )
										) )
					->validator( Validate::maxLen(
										20,
										ValidateOptions::inst()
										->message( 'Máximo de 20 caracteres' )
										) )
			/*		->validator( Validate::unique(
										ValidateOptions::inst()
										->message( 'Já existe' )
										) ) */
					->validator( Validate::notEmpty(
										ValidateOptions::inst()
										->message( '*Obrigatório' )
										) ),
		Field::inst( 'tbOnibus.vencimentoipva' )
								->validator( Validate::dateFormat( 'Y-m-d' ) )
								->getFormatter( Format::dateSqlToFormat( 'Y-m-d' ) )
								->setFormatter( Format::dateFormatToSql('Y-m-d' ) )
								->validator( Validate::notEmpty(
													ValidateOptions::inst()
													->message( '*Obrigatório' )
													) ),
		Field::inst( 'tbOnibus.quilometragem' )
		/*			->validator( Validate::minLen(
										1,
										ValidateOptions::inst()
										->message( 'Inválido' )
										) ) */
					->validator( Validate::maxLen(
										10,
										ValidateOptions::inst()
										->message( 'Máximo de 10 caracteres' )
										) )
			/*		->validator( Validate::unique(
										ValidateOptions::inst()
										->message( 'Já existe' )
										) ) */
					->validator( Validate::notEmpty(
										ValidateOptions::inst()
										->message( '*Obrigatório' )
										) )
	)
	->process( $_POST )
	->json();
