
/*
 * Editor client script for DB table tbTarifas
 * Created by http://editor.datatables.net/generator
 */

(function($){


	//MASCARAMENTO

	//MASCARAMENTO Dinheiro R$
		var dinheiroMaskBehavior = function (val) {
	    return '999.999.999.999.990,00';
	},
	dinheiroOptions = {
	        onKeyPress: function(val, e, field, options) {
	        field.mask(dinheiroMaskBehavior.apply({}, arguments), options);
	    }
	};

$(document).ready(function() {
	var editor = new $.fn.dataTable.Editor( {
		ajax: '../dataTables/tarifas/php/table.tbTarifas.php',
		table: '#tbTarifas',
		//Traduçao
				i18n: {
					create: {
							button: "Add",
							title:  "Adicionar Tarifa",
							submit: "Adicionar"
					},
						edit: {
								button: "Alterar",
								title:  "Alterar Tarifa",
								submit: "Alterar"
						},
						remove: {
								button: "Apagar",
								title:  "Apagar Tarifa",
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
				//Input dados na Tarifas
		fields: [
			{
				label: "Nome:",
				name: "tbTarifas.nome"
			},
			{
				label: "Normal:",
				name: "tbTarifas.normal"
			},
			{
				label: "Promocional:",
				name: "tbTarifas.promocional"
			},
			{
				label: "Meia Passagem:",
				name: "tbTarifas.meiapassagem"
			},
			{
				label: "Pedagio:",
				name: "tbTarifas.pedagio"
			},
			{
				label: "Seguro:",
				name: "tbTarifas.seguro"
			}
		]
	} );

	var table = $('#tbTarifas').DataTable( {
		ajax: '../dataTables/tarifas/php/table.tbTarifas.php',
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
					//Select dados da tabela Tarifas
		columns: [
			{
				data: "tbTarifas.nome"
			},
			{
				data: "tbTarifas.normal"
			},
			{
				data: "tbTarifas.promocional"
			},
			{
				data: "tbTarifas.meiapassagem"
			},
			{
				data: "tbTarifas.pedagio"
			},
			{
				data: "tbTarifas.seguro"
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

	//MASCARAMENTO Dinheiro R$
	editor.one(`open`, function(e, mode, action) {
			editor.field(`tbTarifas.normal`).input().addClass(`dinheiro-number`);
			$(`.dinheiro-number`).mask(dinheiroMaskBehavior, {reverse: true}, dinheiroOptions);
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
