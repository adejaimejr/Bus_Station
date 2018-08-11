<?php

/*
 * Editor server script for DB table tbUsuarios
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
$db->sql( "CREATE TABLE IF NOT EXISTS `tbUsuarios` (
	`id` int(10) NOT NULL auto_increment,
	`nome` varchar(40),
	`cpf` varchar(14),
	`nascimento` date,
	`email` varchar(40),
	`telefone` varchar(15),
	`login` varchar(20),
	`senha` varchar(20),
	`perfil` tinyint(4),
	PRIMARY KEY( `id` )
);" );

// Build our Editor instance and process the data coming from _POST
Editor::inst( $db, 'tbUsuarios', 'id' )
	->fields(
		Field::inst( 'tbUsuarios.nome' )
					->validator( Validate::minLen(
										5,
										ValidateOptions::inst()
										->message( 'Inválido' )
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
		Field::inst( 'tbUsuarios.cpf' )
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
		Field::inst( 'tbUsuarios.nascimento' )
								->validator( Validate::dateFormat( 'Y-m-d' ) )
								->getFormatter( Format::dateSqlToFormat( 'Y-m-d' ) )
								->setFormatter( Format::dateFormatToSql('Y-m-d' ) )
								->validator( Validate::notEmpty(
													ValidateOptions::inst()
													->message( '*Obrigatório' )
													) ),
		Field::inst( 'tbUsuarios.email' )
					->validator( Validate::email(
			        ValidateOptions::inst()
							->message( 'Por favor insira um endereço de e-mail' )
			            ->allowEmpty( false )
			            ->optional( false )
			    ) ),
		Field::inst( 'tbUsuarios.telefone' )
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
		Field::inst( 'tbUsuarios.login' )
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
		Field::inst( 'tbUsuarios.senha' )
							->validator( Validate::minLen(
												6,
												ValidateOptions::inst()
												->message( 'Mínimo de 6 caracteres' )
												) )
							->validator( Validate::maxLen(
												20,
												ValidateOptions::inst()
												->message( 'Máximo de 20 caracteres' )
												) )
				/*			->validator( Validate::unique(
												ValidateOptions::inst()
												->message( 'Já existe' )
												) )  */
							->validator( Validate::notEmpty(
												ValidateOptions::inst()
												->message( '*Obrigatório' )
												) ),
		//INICIO - Tabela que será puxado os dados - tbtributacao
				Field::inst( 'tbUsuarios.perfil' )
				->options( Options::inst()
					->table( 'tbPerfil' )
					->value( 'id' )
					->label( 'nome' )
				)
							->validator( Validate::dbValues() )
							->validator( Validate::notEmpty(
												ValidateOptions::inst()
												->message( '*Obrigatório' )
												) ),
			Field::inst( 'tbPerfil.nome' )
			//FIM - Tabela que será puxado os dados
		)
		//JOIN DADOS
		->leftJoin( 'tbPerfil', 'tbPerfil.id', '=', 'tbUsuarios.perfil' )
			->process( $_POST )
			->json();
