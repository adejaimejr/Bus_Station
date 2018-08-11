
/*
 * Editor client script for DB table tbOnibus
 * Created by http://editor.datatables.net/generator
 */

(function($){

	//MASCARAMENTO

	//MASCARAMENTO PLACA
		var placaMaskBehavior = function (val) {
			return 'MMM-0000';
	},
	placaOptions = {
					onKeyPress: function(val, e, field, options) {
					field.mask(placaMaskBehavior.apply({}, arguments), options);
			}
	};
	//MASCARAMENTO POLTRONA
		var poltronaMaskBehavior = function (val) {
			return '00';
	},
	poltronaOptions = {
					onKeyPress: function(val, e, field, options) {
					field.mask(poltronaMaskBehavior.apply({}, arguments), options);
			}
	};
	//MASCARAMENTO ANO FABRICACAO
		var anofabricacaoMaskBehavior = function (val) {
			return '0000';
	},
	anofabricacaoOptions = {
					onKeyPress: function(val, e, field, options) {
					field.mask(anofabricacaoMaskBehavior.apply({}, arguments), options);
			}
	};
	//MASCARAMENTO CHASSI
		var chassiMaskBehavior = function (val) {
			return '0MMMM00MM00000000';
	},
	chassiOptions = {
					onKeyPress: function(val, e, field, options) {
					field.mask(chassiMaskBehavior.apply({}, arguments), options);
			}
	};
	//MASCARAMENTO RENAVAM
		var renavamMaskBehavior = function (val) {
			return '0000.000000-0';
	},
	renavamOptions = {
					onKeyPress: function(val, e, field, options) {
					field.mask(renavamMaskBehavior.apply({}, arguments), options);
			}
	};
	//MASCARAMENTO QUILOMETRAGEM
		var quilomeMaskBehavior = function (val) {
			return '##0 KM';
	},
	quilomeOptions = {
					onKeyPress: function(val, e, field, options) {
					field.mask(quilomeMaskBehavior.apply({}, arguments), options);
			}
	};

$(document).ready(function() {
	var editor = new $.fn.dataTable.Editor( {
		ajax: '../dataTables/onibus/php/table.tbOnibus.php',
		table: '#tbOnibus',
		//Traduçao
				i18n: {
					create: {
							button: "Add",
							title:  "Adicionar Onibus",
							submit: "Adicionar"
					},
						edit: {
								button: "Alterar",
								title:  "Alterar Onibus",
								submit: "Alterar"
						},
						remove: {
								button: "Apagar",
								title:  "Apagar Onibus",
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
				label: "Placa:",
				name: "tbOnibus.placa",
				attr:  {
		        placeholder: 'XXX-0000'
    				}
			},
			{
				label: "Classe:",
				name: "tbOnibus.classe",
				attr:  {
		        placeholder: 'SEMI LUXO'
    				}
			},
			{
				label: "Poltronas:",
				name: "tbOnibus.poltronas",
				attr:  {
		        placeholder: '42'
    				}
			},
			{
				label: "Ano de Fabricacao:",
				name: "tbOnibus.anofabricacao",
				attr:  {
		        placeholder: '2017'
    				}
			},
			{
				label: "Chassi:",
				name: "tbOnibus.chassi",
				attr:  {
		        placeholder: '9BWHE21JX24060960'
    				}
			},
			{
				label: "Renavam:",
				name: "tbOnibus.renavam",
				attr:  {
		        placeholder: '0000.000000-0'
    				}
			},
			{
				label: "Marca:",
				name: "tbOnibus.marca"
			},
			{
				label: "Modelo:",
				name: "tbOnibus.modelo"
			},
			{
				label: "Vencimento IPVA:",
				name: "tbOnibus.vencimentoipva",
				type: "date",
				format: "DD-MM-YYYY"
			},
			{
				label: "Quilometragem:",
				name: "tbOnibus.quilometragem"
			}
		]
	} );


	var table = $('#tbOnibus').DataTable( {
		ajax: '../dataTables/onibus/php/table.tbOnibus.php',
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
					//Select dados da tabela Onibus
		columns: [
			{
				data: "tbOnibus.placa"
			},
			{
				data: "tbOnibus.classe"
			},
			{
				data: "tbOnibus.poltronas"
			},
			{
				data: "tbOnibus.vencimentoipva",
				//Visualizar data
				render: function ( data, type, row ) {
        var dateSplit = data.split('-');
        return type === "display" || type === "filter" ?
            dateSplit[2] +'-'+ dateSplit[1] +'-'+ dateSplit[0] :
            data;
    }
			},
			{
				data: "tbOnibus.quilometragem",
				render: $.fn.dataTable.render.number( '.', ',', 0, '', ' KM' )
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

	//MASCARAMENTO PLACA
	editor.one(`open`, function(e, mode, action) {
			editor.field(`tbOnibus.placa`).input().addClass(`placa-number`);
			$(`.placa-number`).mask(placaMaskBehavior, {
				translation:  {
					'M': {
						pattern: /[A-Z]/,
					}}}, placaOptions);
	});
	//MASCARAMENTO POLTRONA
	editor.one(`open`, function(e, mode, action) {
			editor.field(`tbOnibus.poltronas`).input().addClass(`poltrona-number`);
			$(`.poltrona-number`).mask(poltronaMaskBehavior, poltronaOptions);
	});
	//MASCARAMENTO ANO FABRICACAO
	editor.one(`open`, function(e, mode, action) {
			editor.field(`tbOnibus.anofabricacao`).input().addClass(`anofabricacao-number`);
			$(`.anofabricacao-number`).mask(anofabricacaoMaskBehavior, anofabricacaoOptions);
	});
	//MASCARAMENTO CHASSI
	editor.one(`open`, function(e, mode, action) {
			editor.field(`tbOnibus.chassi`).input().addClass(`chassi-number`);
			$(`.chassi-number`).mask(chassiMaskBehavior, {
				translation:  {
					'M': {
						pattern: /[A-Z]/,
				}}}, chassiOptions);
	});
	//MASCARAMENTO Renavam
	editor.one(`open`, function(e, mode, action) {
			editor.field(`tbOnibus.renavam`).input().addClass(`renavam-number`);
			$(`.renavam-number`).mask(renavamMaskBehavior, renavamOptions);
	});
	//MASCARAMENTO QUILOMETRAGEM
	editor.one(`open`, function(e, mode, action) {
			editor.field(`tbOnibus.quilometragem`).input().addClass(`quilome-number`);
			$(`.quilome-number`).mask(quilomeMaskBehavior, {reverse: true}, quilomeOptions);
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
