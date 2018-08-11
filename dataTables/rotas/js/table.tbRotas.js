
/*
 * Editor client script for DB table tbRotas
 * Created by http://editor.datatables.net/generator
 */

(function($){

	//MASCARAMENTO Distancia
		var distanciaMaskBehavior = function (val) {
	    return '9000 KM';
	},
	distanciaOptions = {
	        onKeyPress: function(val, e, field, options) {
	        field.mask(distanciaMaskBehavior.apply({}, arguments), options);
	    }
	};

$(document).ready(function() {
	var editor = new $.fn.dataTable.Editor( {
		ajax: '../dataTables/rotas/php/table.tbRotas.php',
		table: '#tbRotas',
		//Traduçao
				i18n: {
					create: {
							button: "Add",
							title:  "Adicionar Rota",
							submit: "Adicionar"
					},
						edit: {
								button: "Alterar",
								title:  "Alterar Rota",
								submit: "Alterar"
						},
						remove: {
								button: "Apagar",
								title:  "Apagar Rota",
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
				label: "Origem:",
				name: "tbRotas.origem",
				type: "select",
				placeholder: "--Origem--"
			},
			{
				label: "UF Origem:",
				name: "tbRotas.uforigem",
				type: "select",
				placeholder: "--UF Origem--"
			},
			{
				label: "C&oacute;digo de Origem:",
				name: "tbRotas.codorigem",
				type: "select",
				placeholder: "--Codigo Origem--"
			},
			{
				label: "Destino:",
				name: "tbRotas.destino",
				type: "select",
				placeholder: "--Destino--"
			},
			{
				label: "UF Destino:",
				name: "tbRotas.ufdestino",
				type: "select",
				placeholder: "--UF Destino--"
			},
			{
				label: "C&oacute;digo de Destino:",
				name: "tbRotas.coddestino",
				type: "select",
				placeholder: "--Codigo Destino--"
			},
			{
				label: "Dist&acirc;ncia:",
				name: "tbRotas.distancia"
			},
			{
				label: "Hor&aacute;rio Partida:",
				name: "tbRotas.horariopartida",
				type: "datetime",
				format: "HH:mm",
				attr:  {
		        placeholder: '08:00'
    				}
			},
			{
				label: "Hor&aacute;rio Chegada:",
				name: "tbRotas.horariochegada",
				type: "datetime",
				format: "HH:mm",
				attr:  {
		        placeholder: '20:00'
    				}
			}
		]
	} );

	var table = $('#tbRotas').DataTable( {
		ajax: '../dataTables/rotas/php/table.tbRotas.php',
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
					//Select dados da tabela Rotas
		columns: [
			{
				data: "l2.cidade"
			},
			{
				data: "l1.uf"
			},
			{
				data: "l4.cidade"
			},
			{
				data: "l5.uf"
			},
			{
				data: "tbRotas.distancia",
				render: $.fn.dataTable.render.number( '.', ',', 0, '', ' KM' )
			},
			{
				data: "tbRotas.horariopartida",
				render: $.fn.dataTable.render.number( '', ':', 2, '', 'Hr' )
			},
			{
				data: "tbRotas.horariochegada",
				render: $.fn.dataTable.render.number( '', ':', 2, '', 'Hr' )
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

	//MASCARAMENTO Distancia
	editor.one(`open`, function(e, mode, action) {
			editor.field(`tbRotas.distancia`).input().addClass(`distancia-number`);
			$(`.distancia-number`).mask(distanciaMaskBehavior,  {reverse: true}, distanciaOptions);
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
