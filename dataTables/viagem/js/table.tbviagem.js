
/*
 * Editor client script for DB table tbviagem
 * Created by http://editor.datatables.net/generator
 */

(function($){

$(document).ready(function() {
	var editor = new $.fn.dataTable.Editor( {
		ajax: '../dataTables/viagem/php/table.tbviagem.php',
		table: '#tbviagem',
		//Traduçao
				i18n: {
					create: {
							button: "Add",
							title:  "Cadastrar Viagens",
							submit: "Adicionar"
					},
		        edit: {
		            button: "Alterar",
		            title:  "Alterar Viagens",
		            submit: "Alterar"
		        },
						remove: {
		            button: "Apagar",
		            title:  "Apagar Viagens",
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
				//Dados da tabela Viagem
		fields: [
			{
                label: "Rota:",
                name: "tbviagem.rota",
                type: "select",
                placeholder: "Selecione a Rota"
			},
			{
                label: "Ônibus:",
                name: "tbviagem.onibus",
                type: "select",
                placeholder: "Selecione o Ônibus"
            },
			{
                label: "Tarifa:",
                name: "tbviagem.tarifa",
                type: "select",
                placeholder: "Selecione a Tarifa"
            },
			{
                label: "Motorista:",
                name: "tbviagem.motorista",
                type: "select",
                placeholder: "Selecione o Motorista"
            }				
			
			/*{
				"label": "Data Saida:",
				"name": "data_saida",
				"type": "datetime",
				"format": "ddd, D MMM YY"
			},
			{
				"label": "Data Chegada:",
				"name": "data_chegada",
				"type": "datetime",
				"format": "ddd, D MMM YY"
			},
			{
				"label": "Hora Chegada:",
				"name": "hora_chegada",
				"type": "datetime",
				"format": "HH:mm"
			},
			{
				"label": "Hora Saida:",
				"name": "hora_saida",
				"type": "datetime",
				"format": "HH:mm"
			},
			{
				"label": "Cidade Destino:",
				"name": "destino_rotas"
			},
			{
				"label": "Cidade Origem:",
				"name": "origem_rotas"
			},
			{
				"label": "Tarifa Normal:",
				"name": "normal_tarifa"
			},
			{
				"label": "Tarifa Promocional:",
				"name": "promocional_tarifa"
			},
			{
				"label": "Meia Passagem:",
				"name": "meiapassagem_tarifa"
			},
			{
				"label": "Pedagio:",
				"name": "pedagio_tarifa"
			},
			{
				"label": "Seguro:",
				"name": "seguro_tarifa"
			}, {
                label: "Rota:",
                name: "tbviagem.rota",
                type: "select",
                placeholder: "Selecione a Rota"
            }*/
		]
	} );

	var editor2 = new $.fn.dataTable.Editor( {
		ajax: '../dataTables/viagem/php/table.tbviagem2.php',
		table: '#tbviagem',
		//Traduçao
				i18n: {
					create: {
							button: "Add",
							title:  "Cadastrar Viagens",
							submit: "Adicionar"
					},
		        edit: {
		            button: "Alterar",
		            title:  "Alterar Viagens",
		            submit: "Alterar"
		        },
						remove: {
		            button: "Apagar",
		            title:  "Apagar Viagens",
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
				//Dados da tabela Viagem
		fields: [	
/*			{
				"label": "Data Saida:",
				"name": "data_saida",
				"type": "datetime",
				"format": "ddd, D MMM YY"
			},
			{
				"label": "Data Chegada:",
				"name": "data_chegada",
				"type": "datetime",
				"format": "ddd, D MMM YY"
			},
			{
				"label": "Hora Chegada:",
				"name": "hora_chegada",
				"type": "datetime",
				"format": "HH:mm"
			},
			{
				"label": "Hora Saida:",
				"name": "hora_saida",
				"type": "datetime",
				"format": "HH:mm"
			},
			{
				"label": "Cidade Destino:",
				"name": "destino_rotas"
			},
			{
				"label": "Cidade Origem:",
				"name": "origem_rotas"
			},
			{
				"label": "Tarifa Normal:",
				"name": "normal_tarifa"
			},
			{
				"label": "Tarifa Promocional:",
				"name": "promocional_tarifa"
			},
			{
				"label": "Meia Passagem:",
				"name": "meiapassagem_tarifa"
			},
			{
				"label": "Pedagio:",
				"name": "pedagio_tarifa"
			},
			{
				"label": "Seguro:",
				"name": "seguro_tarifa"
			},*/{
                label: "Rota:",
                name: "tbviagem.rota"
			},{
                label: "Onibus:",
                name: "tbviagens_onibus.marca"
			},
			{
                label: "Horario Partida:",
                name: "tbviagens_rotas.horariopartida"
            },{
                label: "Horario Chegada:",
                name: "tbviagens_rotas.horariochegada"
            },{
                label: "Tarifa Normal:",
                name: "tbviagens_tarifas.normal"
            }
		]
	} );

	var table = $('#tbviagem').DataTable( {
		ajax: '../dataTables/viagem/php/table.tbviagem.php',
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
					//Dados da tabela Viagem
		columns: [
			{
				"data": "tbviagens_rotas.horariopartida"
			},
			{
				"data": "tbviagens_rotas.horariochegada"
			},
			{
				"data": "tbviagens_onibus.marca"/*,
				render: function ( data, type, row ) {
					
					alert(JSON.stringify(row));
					return '$'+ data;
				}*/
			},
			{
				"data": "tbviagens_tarifas.nome"
			},
			{
				"data": "tbviagens_tarifas.normal"
			},
			{
				"data": "tbviagens_motorista.nome"
			}			

		/*	{
				"data": "data_saida"
			},
			{
				"data": "data_chegada"
			},
			{
				"data": "hora_chegada"
			},
			{
				"data": "hora_saida"
			},
			{
				"data": "destino_rotas"
			},
			{
				"data": "origem_rotas"
			},
			{
				"data": "normal_tarifa"
			},
			{
				"data": "promocional_tarifa"
			},
			{
				"data": "meiapassagem_tarifa"
			}*/
		],
		select: true,
		lengthChange: false
	} );

	//Botoes
	new $.fn.dataTable.Buttons( table, [
		{ extend: "create", editor: editor },
		{ extend: "editSingle",   editor: editor2 },
		{ extend: "removeSingle", editor: editor },
		{ extend: "excel", editor: editor },
		{ extend: "pdf", editor: editor },
		{ extend: "print", editor: editor }
	] );

	table.buttons().container()
		.appendTo( $('.col-md-6:eq(0)', table.table().container() ) );

} );

}(jQuery));
