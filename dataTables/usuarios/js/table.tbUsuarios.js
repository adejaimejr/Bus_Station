
/*
 * Editor client script for DB table tbUsuarios
 * Created by http://editor.datatables.net/generator
 */

(function($){


		//MASCARAMENTO

		//MASCARAMENTO CPF
			var cpfMaskBehavior = function (val) {
		    return '000.000.000-00';
		},
		cpfOptions = {
		        onKeyPress: function(val, e, field, options) {
		        field.mask(cpfMaskBehavior.apply({}, arguments), options);
		    }
		};
		//MASCARAMENTO TELEFONE
			var mobileMaskBehavior = function (val) {
		    return '(00) 0000-00009';
		},
		celularOptions = {
		        onKeyPress: function(val, e, field, options) {
		        field.mask(mobileMaskBehavior.apply({}, arguments), options);
		    }
		};


$(document).ready(function() {
	var editor = new $.fn.dataTable.Editor( {
		ajax: '../dataTables/usuarios/php/table.tbUsuarios.php',
		table: '#tbUsuarios',
		//Traduçao
				i18n: {
					create: {
							button: "Add",
							title:  "Adicionar Usuário",
							submit: "Adicionar"
					},
		        edit: {
		            button: "Alterar",
		            title:  "Alterar Usuário",
		            submit: "Alterar"
		        },
						remove: {
		            button: "Apagar",
		            title:  "Apagar Usuário",
		            submit: "Apagar",
		            confirm: {
		                _: "Tem certeza de que deseja excluir %d registros?",
		                1: "Tem certeza de que deseja excluir 1 registro?"
		            }
		        },
						multi: {
				        title: "Muliplos Valores",
				        info: "Os itens selecionados contêm valores diferentes para essa entrada. Para editar e definir todos os itens para essa entrada com o mesmo valor, clique ou toque aqui, caso contrário, eles manterão seus valores individuais.",
				        restore: "Desfazer mudanças",
				        noMulti: "Esta entrada pode ser editada individualmente, mas não parte de um grupo."
		    },
						datetime: {
		            previous: 'Anterior',
		            next:     'Próximo',
		            months:   [ 'Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro' ],
		            weekdays: [ 'Dom', 'Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'Sab' ],
								amPm: [ 'AM', 'PM' ],
		        },
						error: {
		            system: "Ocorreu um erro, entre em contato com o administrador do sistema"
		        }
		    },
				//Dados da tabela Usuarios
		fields: [
			{
				label: "Nome Usuario:",
				name: "tbUsuarios.nome"
			},
			{
				label: "CPF:",
				name: "tbUsuarios.cpf",
				attr:  {
		        placeholder: '000.000.000-00'
    				}
			},
			{
				label: "Data de Nascimento:",
				name: "tbUsuarios.nascimento",
				type: "date",
				format: "DD-MM-YYYY"
			},
			{
				label: "E-mail:",
				name: "tbUsuarios.email",
				attr:  {
		        placeholder: 'teste@gmail.com'
    				}
			},
			{
				label: "telefone:",
				name: "tbUsuarios.telefone",
				attr:  {
		        placeholder: '(00) 00000-0000'
    				}
			},
			{
				label: "login:",
				name: "tbUsuarios.login"
			},
			{
				label: "Senha:",
				name: "tbUsuarios.senha",
				type: "password",
				attr:  {
		        placeholder: '******'
    				}
			},
			{
				label: "Perfil:",
				name: "tbUsuarios.perfil",
				type: "select",
				placeholder: "--Selecionar Perfil--"
			}
		]
	} );

	var table = $('#tbUsuarios').DataTable( {
		ajax: '../dataTables/usuarios/php/table.tbUsuarios.php',
		select: true,
		lengthChange: false,
	//	scrollY: 250,
	language: {
							processing:     "Processando...",
							search:         "Pesquisar&nbsp;:",
							lengthMenu:     "_MENU_ resultados por página",
							info:           "_START_ até _END_ de _TOTAL_ registros",
//								info:           "Mostrando de _START_ até _END_ de _TOTAL_ registros",
							infoEmpty:      "Nenhum registro",
							infoFiltered:   "(Filtrados de _MAX_ registros)",
							infoPostFix:    "",
							loadingRecords: "Carregando...",
							zeroRecords:    "Nenhum registro encontrado",
							emptyTable:     "Nenhum registro encontrado",
							select: {
								rows: {
													_: "|&nbsp;&nbsp;%d Registros Selecionados",
													0: "",
													1: "|&nbsp;&nbsp;1 Registro Selecionado"
											}
							},
							buttons: {
									print:     "Imprimir"
							},
							paginate: {
									first:      "Próximo",
									previous:   "Anterior",
									next:       "Primeiro",
									last:       "Último"
							},
							aria: {
									sortAscending:  ": Ordenar colunas de forma ascendente",
									sortDescending: ": Ordenar colunas de forma descendente"
							}
					},
					//Dados da tabela usuarios
		columns: [
			{
				data: "tbUsuarios.nome"
			},
			{
				data: "tbUsuarios.cpf"
			},
			{
				data: "tbUsuarios.email"
			},
			{
				data: "tbUsuarios.login"
			},
			{
				data: "tbPerfil.nome"
			}
		]
	} );

	//Botoes
	new $.fn.dataTable.Buttons( table, [
		{ extend: "create", editor: editor },
		{ extend: "editSingle",   editor: editor },
		{ extend: "removeSingle", editor: editor },
		{ extend: "excel", editor: editor },
		{ extend: "pdf", editor: editor },
		{ extend: "print", editor: editor }
	] );

	table.buttons().container()
		.appendTo( $('.col-md-6:eq(0)', table.table().container() ) );

	//MASCARAMENTO CPF
	editor.one(`open`, function(e, mode, action) {
			editor.field(`tbUsuarios.cpf`).input().addClass(`cpf-number`);
			$(`.cpf-number`).mask(cpfMaskBehavior, cpfOptions);
	});
	//MASCARAMENTO TELEFONE
	editor.one(`open`, function(e, mode, action) {
			editor.field(`tbUsuarios.telefone`).input().addClass(`mobile-number`);
			$(`.mobile-number`).mask(mobileMaskBehavior, celularOptions);
	});
	editor.on("onSubmitError", function(e, xhr, err, thrown, data){
		console.log("onSubmitError");
		if(xhr.status == 302){
			alert("Sessão expirada. Por favor, logue novamente.");
			document.location.href = "../login.html";
		}
	});

	table.on("onSubmitError", function(e, xhr, err, thrown, data){
		console.log("onSubmitError");
		if(xhr.status == 302){
			alert("Sessão expirada. Por favor, logue novamente.");
			document.location.href = "../login.html";
		}
	});
} );

}(jQuery));
