<?php

/*
 * Editor server script for DB table tbviagem
 * Created by http://editor.datatables.net/generator
 */

// DataTables PHP library and database connection
include( "lib/DataTables.php" );

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
	`data_saida` date,
	`data_chegada` date,
	`hora_chegada` time,
	`hora_saida` time,
	`destino_rotas` tinyint(4),
	`origem_rotas` tinyint(4),
	`normal_tarifa` decimal(9,2),
	`promocional_tarifa` decimal(9,2),
	`meiapassagem_tarifa` decimal(9,2),
	`pedagio_tarifa` decimal(9,2),
	`seguro_tarifa` decimal(9,2),
	`poltronas_01` tinyint(4),
	`poltronas_02` tinyint(4),
	`poltronas_03` tinyint(4),
	`poltronas_04` tinyint(4),
	`poltronas_05` tinyint(4),
	`poltronas_06` tinyint(4),
	`poltronas_07` tinyint(4),
	`poltronas_08` tinyint(4),
	`poltronas_09` tinyint(4),
	`poltronas_10` tinyint(4),
	`poltronas_11` tinyint(4),
	`poltronas_12` tinyint(4),
	`poltronas_13` tinyint(4),
	`poltronas_14` tinyint(4),
	`poltronas_15` tinyint(4),
	`poltronas_16` tinyint(4),
	`poltronas_17` tinyint(4),
	`poltronas_18` tinyint(4),
	`poltronas_19` tinyint(4),
	`poltronas_20` tinyint(4),
	`poltronas_21` tinyint(4),
	`poltronas_22` tinyint(4),
	`poltronas_23` tinyint(4),
	`poltronas_24` tinyint(4),
	`poltronas_25` tinyint(4),
	`poltronas_26` tinyint(4),
	`poltronas_27` tinyint(4),
	`poltronas_28` tinyint(4),
	`poltronas_29` tinyint(4),
	`poltronas_30` tinyint(4),
	`poltronas_31` tinyint(4),
	`poltronas_32` tinyint(4),
	`poltronas_33` tinyint(4),
	`poltronas_34` tinyint(4),
	`poltronas_35` tinyint(4),
	`poltronas_36` tinyint(4),
	`poltronas_37` tinyint(4),
	`poltronas_38` tinyint(4),
	`poltronas_39` tinyint(4),
	`poltronas_40` tinyint(4),
	`poltronas_41` tinyint(4),
	`poltronas_42` tinyint(4),
	`poltronas_43` tinyint(4),
	`poltronas_44` tinyint(4),
	`poltronas_45` tinyint(4),
	`poltronas_46` tinyint(4),
	`poltronas_47` tinyint(4),
	`poltronas_48` tinyint(4),
	`poltronas_49` tinyint(4),
	`poltronas_50` tinyint(4),
	`poltronas_51` tinyint(4),
	`poltronas_52` tinyint(4),
	`poltronas_53` tinyint(4),
	`poltronas_54` tinyint(4),
	`poltronas_55` tinyint(4),
	`poltronas_56` tinyint(4),
	PRIMARY KEY( `id` )
);" );

// Build our Editor instance and process the data coming from _POST
Editor::inst( $db, 'tbviagem', 'id' )
	->fields(
		Field::inst( 'data_saida' )
			->validator( Validate::dateFormat( 'D, j M y' ) )
			->getFormatter( Format::dateSqlToFormat( 'D, j M y' ) )
			->setFormatter( Format::dateFormatToSql( 'D, j M y' ) ),
		Field::inst( 'data_chegada' )
			->validator( Validate::dateFormat( 'D, j M y' ) )
			->getFormatter( Format::dateSqlToFormat( 'D, j M y' ) )
			->setFormatter( Format::dateFormatToSql( 'D, j M y' ) ),
		Field::inst( 'hora_chegada' )
			->validator( Validate::dateFormat( 'H:i' ) )
			->getFormatter( Format::datetime( 'H:i:s', 'H:i' ) )
			->setFormatter( Format::datetime( 'H:i', 'H:i:s' ) ),
		Field::inst( 'hora_saida' )
			->validator( Validate::dateFormat( 'H:i' ) )
			->getFormatter( Format::datetime( 'H:i:s', 'H:i' ) )
			->setFormatter( Format::datetime( 'H:i', 'H:i:s' ) ),
		Field::inst( 'destino_rotas' ),
		Field::inst( 'origem_rotas' ),
		Field::inst( 'normal_tarifa' ),
		Field::inst( 'promocional_tarifa' ),
		Field::inst( 'meiapassagem_tarifa' ),
		Field::inst( 'pedagio_tarifa' ),
		Field::inst( 'seguro_tarifa' ),
		Field::inst( 'poltronas_01' )
			->set( false ),
		Field::inst( 'poltronas_02' )
			->set( false ),
		Field::inst( 'poltronas_03' )
			->set( false ),
		Field::inst( 'poltronas_04' )
			->set( false ),
		Field::inst( 'poltronas_05' )
			->set( false ),
		Field::inst( 'poltronas_06' )
			->set( false ),
		Field::inst( 'poltronas_07' )
			->set( false ),
		Field::inst( 'poltronas_08' )
			->set( false ),
		Field::inst( 'poltronas_09' )
			->set( false ),
		Field::inst( 'poltronas_10' )
			->set( false ),
		Field::inst( 'poltronas_11' )
			->set( false ),
		Field::inst( 'poltronas_12' )
			->set( false ),
		Field::inst( 'poltronas_13' )
			->set( false ),
		Field::inst( 'poltronas_14' )
			->set( false ),
		Field::inst( 'poltronas_15' )
			->set( false ),
		Field::inst( 'poltronas_16' )
			->set( false ),
		Field::inst( 'poltronas_17' )
			->set( false ),
		Field::inst( 'poltronas_18' )
			->set( false ),
		Field::inst( 'poltronas_19' )
			->set( false ),
		Field::inst( 'poltronas_20' )
			->set( false ),
		Field::inst( 'poltronas_21' )
			->set( false ),
		Field::inst( 'poltronas_22' )
			->set( false ),
		Field::inst( 'poltronas_23' )
			->set( false ),
		Field::inst( 'poltronas_24' )
			->set( false ),
		Field::inst( 'poltronas_25' )
			->set( false ),
		Field::inst( 'poltronas_26' )
			->set( false ),
		Field::inst( 'poltronas_27' )
			->set( false ),
		Field::inst( 'poltronas_28' )
			->set( false ),
		Field::inst( 'poltronas_29' )
			->set( false ),
		Field::inst( 'poltronas_30' )
			->set( false ),
		Field::inst( 'poltronas_31' )
			->set( false ),
		Field::inst( 'poltronas_32' )
			->set( false ),
		Field::inst( 'poltronas_33' )
			->set( false ),
		Field::inst( 'poltronas_34' )
			->set( false ),
		Field::inst( 'poltronas_35' )
			->set( false ),
		Field::inst( 'poltronas_36' )
			->set( false ),
		Field::inst( 'poltronas_37' )
			->set( false ),
		Field::inst( 'poltronas_38' )
			->set( false ),
		Field::inst( 'poltronas_39' )
			->set( false ),
		Field::inst( 'poltronas_40' )
			->set( false ),
		Field::inst( 'poltronas_41' )
			->set( false ),
		Field::inst( 'poltronas_42' )
			->set( false ),
		Field::inst( 'poltronas_43' )
			->set( false ),
		Field::inst( 'poltronas_44' )
			->set( false ),
		Field::inst( 'poltronas_45' )
			->set( false ),
		Field::inst( 'poltronas_46' )
			->set( false ),
		Field::inst( 'poltronas_47' )
			->set( false ),
		Field::inst( 'poltronas_48' )
			->set( false ),
		Field::inst( 'poltronas_49' )
			->set( false ),
		Field::inst( 'poltronas_50' )
			->set( false ),
		Field::inst( 'poltronas_51' )
			->set( false ),
		Field::inst( 'poltronas_52' )
			->set( false ),
		Field::inst( 'poltronas_53' )
			->set( false ),
		Field::inst( 'poltronas_54' )
			->set( false ),
		Field::inst( 'poltronas_55' )
			->set( false ),
		Field::inst( 'poltronas_56' )
			->set( false )
	)
	->process( $_POST )
	->json();
