<?php

/*
 * Editor server script for DB table tbTarifas
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
$db->sql( "CREATE TABLE IF NOT EXISTS `tbTarifas` (
	`id` int(10) NOT NULL auto_increment,
	`nome` varchar(40),
	`normal` decimal(9,2),
	`promocional` decimal(9,2),
	`meiapassagem` decimal(9,2),
	`pedagio` decimal(9,2),
	`seguro` decimal(9,2),
	PRIMARY KEY( `id` )
);" );

// Build our Editor instance and process the data coming from _POST
Editor::inst( $db, 'tbTarifas', 'id' )
	->fields(
		Field::inst( 'tbTarifas.nome' ),
		Field::inst( 'tbTarifas.normal' ),
		Field::inst( 'tbTarifas.promocional' ),
		Field::inst( 'tbTarifas.meiapassagem' ),
		Field::inst( 'tbTarifas.pedagio' ),
		Field::inst( 'tbTarifas.seguro' )
	)
	->process( $_POST )
	->json();
