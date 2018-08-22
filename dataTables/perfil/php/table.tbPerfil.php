<?php

/*
 * Editor server script for DB table tbPerfil
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
$db->sql( "CREATE TABLE IF NOT EXISTS `tbPerfil` (
	`id` int(10) NOT NULL auto_increment,
	`nome` varchar(20),
	`tbDashboard` tinyint(4),
	`tbFilial` tinyint(4),
	`tbTributacao` tinyint(4),
	`tbUsuario` tinyint(4),
	`tbPassageiro` tinyint(4),
	`tbOnibus` tinyint(4),
	`tbRotas` tinyint(4),
	`tbMotorista` tinyint(4),
	`tbViagem` tinyint(4),
	`tbTarifas` tinyint(4),
	`tbPagamento` tinyint(4),
	`tbPassagem` tinyint(4),
	`tbRelatorios` tinyint(4),
	PRIMARY KEY( `id` )
);" );

// Build our Editor instance and process the data coming from _POST
Editor::inst( $db, 'tbPerfil', 'id' )
	->fields(
		Field::inst( 'tbPerfil.nome' )
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
							->validator( Validate::unique(
												ValidateOptions::inst()
												->message( 'Já existe' )
												) )
							->validator( Validate::notEmpty(
												ValidateOptions::inst()
												->message( '*Obrigatório' )
												) ),
		Field::inst( 'tbPerfil.tbDashboard' ),
		Field::inst( 'tbPerfil.tbFilial' ),
		Field::inst( 'tbPerfil.tbTributacao' ),
		Field::inst( 'tbPerfil.tbUsuario' ),
		Field::inst( 'tbPerfil.tbPassageiro' ),
		Field::inst( 'tbPerfil.tbOnibus' ),
		Field::inst( 'tbPerfil.tbViagem' ),
		Field::inst( 'tbPerfil.tbRotas' ),
		Field::inst( 'tbPerfil.tbMotorista' ),
		Field::inst( 'tbPerfil.tbTarifas' ),
		Field::inst( 'tbPerfil.tbPagamento' ),
		Field::inst( 'tbPerfil.tbPassagem' ),
		Field::inst( 'tbPerfil.tbRelatorios' )
	)
	->process( $_POST )
	->json();
