<?php

/*
 * Editor server script for DB table tbTributacao
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
$db->sql( "CREATE TABLE IF NOT EXISTS `tbTributacao` (
	`id` int(10) NOT NULL auto_increment,
	`nome` varchar(40),
	`icmsAliquota` float,
	`outrosImpostos` float,
	PRIMARY KEY( `id` )
);" );

// Build our Editor instance and process the data coming from _POST
Editor::inst( $db, 'tbTributacao', 'id' )
	->fields(
		Field::inst( 'tbTributacao.nome' )
			/*		->validator( Validate::minLen(
										15,
										ValidateOptions::inst()
										->message( 'Minimo de 15 caracteres' )
										) ) */
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
		Field::inst( 'tbTributacao.icmsAliquota' )
					->validator( Validate::minLen(
										1,
										ValidateOptions::inst()
									//	->message( 'Ex: 17,00% ou 7%' )
										) )
					->validator( Validate::maxLen(
										6,
										ValidateOptions::inst()
									//	->message( 'Ex: 17,00% ou 7%' )
										) )
				/*	->validator( Validate::unique(
										ValidateOptions::inst()
										->message( 'Já existe' )
										) ) */
					->validator( Validate::notEmpty(
										ValidateOptions::inst()
										->message( '*Obrigatório' )
										) ),
		Field::inst( 'tbTributacao.outrosImpostos' )
					->validator( Validate::minLen(
										1,
										ValidateOptions::inst()
									//	->message( 'Ex: 17,00% ou 7%' )
										) )
					->validator( Validate::maxLen(
										6,
										ValidateOptions::inst()
									//	->message( 'Ex: 17,00% ou 7%' )
										) )
				/*	->validator( Validate::unique(
										ValidateOptions::inst()
										->message( 'Já existe' )
										) ) */
				/*	->validator( Validate::notEmpty(
										ValidateOptions::inst()
										->message( '*Obrigatório' )
										) ),  */
	)
	->process( $_POST )
	->json();
