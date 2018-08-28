<?php

/*
 * Editor server script for DB table tbMotorista
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
$db->sql( "CREATE TABLE IF NOT EXISTS `tbMotorista` (
	`id` int(10) NOT NULL auto_increment,
	`nome` varchar(40),
	`cpf` varchar(14),
	`nascimento` date,
	`email` varchar(40),
	`telefone` varchar(15),
	`cnh` varchar(11),
	`validadecnh` date,
	PRIMARY KEY( `id` )
);" );

// Build our Editor instance and process the data coming from _POST
Editor::inst( $db, 'tbMotorista', 'id' )
	->fields(
		Field::inst( 'tbMotorista.nome' )
					->validator( Validate::minLen(
										10,
										ValidateOptions::inst()
										->message( 'Minimo de 10 caracteres' )
										) )
					->validator( Validate::maxLen(
										40,
										ValidateOptions::inst()
										->message( 'Máximo de 40 caracteres' )
										) )
/*					->validator( Validate::unique(
										ValidateOptions::inst()
										->message( 'Já existe' )
										) ) */
					->validator( Validate::notEmpty(
										ValidateOptions::inst()
										->message( '*Obrigatório' )
										) ),
		Field::inst( 'tbMotorista.cpf' )
					->validator( Validate::minLen(
										14,
										ValidateOptions::inst()
										->message( 'Ex: 000.000.000-00' )
										) )
					->validator( Validate::maxLen(
										14,
										ValidateOptions::inst()
										->message( 'Ex: 000.000.000-00' )
										) )
					->validator( Validate::unique(
										ValidateOptions::inst()
										->message( 'Já existe' )
										) )
					->validator( Validate::notEmpty(
										ValidateOptions::inst()
										->message( '*Obrigatório' )
										) ),
		Field::inst( 'tbMotorista.nascimento' )
								->validator( Validate::dateFormat( 'Y-m-d' ) )
								->getFormatter( Format::dateSqlToFormat( 'Y-m-d' ) )
								->setFormatter( Format::dateFormatToSql('Y-m-d' ) )
								->validator( Validate::notEmpty(
													ValidateOptions::inst()
													->message( '*Obrigatório' )
													) ),
		Field::inst( 'tbMotorista.email' )
					->validator( Validate::email(
			        ValidateOptions::inst()
							->message( 'Por favor insira um endereço de e-mail' )
			            ->allowEmpty( false )
			            ->optional( false )
			    ) ),
		Field::inst( 'tbMotorista.telefone' )
						->validator( Validate::minLen(
											14,
											ValidateOptions::inst()
											->message( 'Fixo (99) 2100-9020 ou Celular (99) 98888-8888' )
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
		Field::inst( 'tbMotorista.cnh' )
					->validator( Validate::minLen(
										11,
										ValidateOptions::inst()
										->message( 'Ex: 04011205801' )
										) )
					->validator( Validate::maxLen(
										11,
										ValidateOptions::inst()
										->message( 'Ex: 04011205801' )
										) )
					->validator( Validate::unique(
										ValidateOptions::inst()
										->message( 'Já existe' )
										) )
					->validator( Validate::notEmpty(
										ValidateOptions::inst()
										->message( '*Obrigatório' )
										) ),
		Field::inst( 'tbMotorista.validadecnh' )
								->validator( Validate::dateFormat( 'Y-m-d' ) )
								->getFormatter( Format::dateSqlToFormat( 'Y-m-d' ) )
								->setFormatter( Format::dateFormatToSql('Y-m-d' ) )
								->validator( Validate::notEmpty(
													ValidateOptions::inst()
													->message( '*Obrigatório' )
													) )
	)
	->process( $_POST )
	->json();
