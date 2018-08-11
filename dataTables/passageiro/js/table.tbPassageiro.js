
/*
 * Editor client script for DB table tbPassageiro
 * Created by http://editor.datatables.net/generator
 */

(function($){

$(document).ready(function() {
	var editor = new $.fn.dataTable.Editor( {
		ajax: '../dataTables/passageiro/php/table.tbPassageiro.php',
		table: '#tbPassageiro',
		//Traduçao
				i18n: {
					create: {
							button: "Add",
							title:  "Adicionar Passageiro",
							submit: "Adicionar"
					},
						edit: {
								button: "Alterar",
								title:  "Alterar Passageiro",
								submit: "Alterar"
						},
						remove: {
								button: "Apagar",
								title:  "Apagar Passageiro",
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
				//Input dados na tabela
		fields: [
			{
				label: "Nome:",
				name: "tbPassageiro.nome"
			},
			{
				label: "E-mail:",
				name: "tbPassageiro.email"
			},
			{
				label: "Telefone:",
				name: "tbPassageiro.telefone"
			},
			{
				label: "Emerg&ecirc;ncia:",
				name: "tbPassageiro.emergencia"
			},
			{
				label: "CPF:",
				name: "tbPassageiro.cpf"
			},
			{
				label: "Data de Nascimento:",
				name: "tbPassageiro.nascimento",
				type: "date",
				format: "DD-MM-YYYY"
			},
			{
				label: "RG:",
				name: "tbPassageiro.rg"
			},
			{
				label: "&Oacute;rg&atilde;o Emissor:",
				name: "tbPassageiro.orgaoemissor"
			},
			{
				label: "Logradouro:",
				name: "tbPassageiro.logradouro",
				type: "datetime",
				format: "HH:mm"
			},
			{
				label: "N&uacute;mero:",
				name: "tbPassageiro.numero"
			},
			{
				label: "Bairro:",
				name: "tbPassageiro.bairro"
			},
			{
				label: "CEP:",
				name: "tbPassageiro.cep"
			},
			{
				label: "Cidade:",
				name: "tbPassageiro.cidade"
			},
			{
				label: "UF:",
				name: "tbPassageiro.uf"
			}
		]
	} );

	var table = $('#tbPassageiro').DataTable( {
		ajax: '../dataTables/passageiro/php/table.tbPassageiro.php',
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
					//Select dados da tabela Passageiro
		columns: [
			{
				data: "tbPassageiro.nome"
			},
			{
				data: "tbPassageiro.email"
			},
			{
				data: "tbPassageiro.telefone"
			},
			{
				data: "tbPassageiro.emergencia"
			},
			{
				data: "tbPassageiro.cpf"
			},
			{
				data: "tbPassageiro.rg"
			},
			{
				data: "tbPassageiro.cidade"
			},
			{
				data: "tbPassageiro.uf"
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
