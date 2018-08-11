<?php

/*
 * Editor server script for DB table tbPassageiro
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
$db->sql( "CREATE TABLE IF NOT EXISTS `tbPassageiro` (
	`id` int(10) NOT NULL auto_increment,
	`nome` varchar(40),
	`email` varchar(40),
	`telefone` varchar(15),
	`emergencia` varchar(15),
	`cpf` varchar(14),
	`nascimento` date,
	`rg` varchar(10),
	`orgaoemissor` varchar(10),
	`logradouro` varchar(40),
	`numero` varchar(10),
	`bairro` varchar(20),
	`cep` varchar(9),
	`cidade` varchar(20),
	`uf` varchar(2),
	PRIMARY KEY( `id` )
);" );

// Build our Editor instance and process the data coming from _POST
Editor::inst( $db, 'tbPassageiro', 'id' )
	->fields(
		Field::inst( 'tbPassageiro.nome' ),
		Field::inst( 'tbPassageiro.email' ),
		Field::inst( 'tbPassageiro.telefone' ),
		Field::inst( 'tbPassageiro.emergencia' ),
		Field::inst( 'tbPassageiro.nascimento' )
		->validator( Validate::dateFormat( 'Y-m-d' ) )
		->getFormatter( Format::dateSqlToFormat( 'Y-m-d' ) )
		->setFormatter( Format::dateFormatToSql('Y-m-d' ) )
		->validator( Validate::notEmpty(
							ValidateOptions::inst()
							->message( '*Obrigatório' )
							) ),
		Field::inst( 'tbPassageiro.cpf' ),
		Field::inst( 'tbPassageiro.rg' ),
		Field::inst( 'tbPassageiro.orgaoemissor' ),
		Field::inst( 'tbPassageiro.logradouro' )
			->validator( Validate::dateFormat( 'H:i' ) )
			->getFormatter( Format::datetime( 'H:i:s', 'H:i' ) )
			->setFormatter( Format::datetime( 'H:i', 'H:i:s' ) ),
		Field::inst( 'tbPassageiro.numero' ),
		Field::inst( 'tbPassageiro.bairro' ),
		Field::inst( 'tbPassageiro.cep' ),
		Field::inst( 'tbPassageiro.cidade' ),
		Field::inst( 'tbPassageiro.uf' )
	)
	->process( $_POST )
	->json();
