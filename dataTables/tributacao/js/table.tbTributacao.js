
/*
 * Editor client script for DB table tbTributacao
 * Created by http://editor.datatables.net/generator
 */

(function($){

	//MASCARAMENTO

	//MASCARAMENTO ICMS
		var icmsMaskBehavior = function (val) {
	    return '990,00%';
	},
	icmsOptions = {
	        onKeyPress: function(val, e, field, options) {
	        field.mask(icmsMaskBehavior.apply({}, arguments), options);
	    }
	};
	//MASCARAMENTO OUTROS IMPOSTOS
		var outrosimpMaskBehavior = function (val) {
	    return '990,00%';
	},
	outrosimpOptions = {
	        onKeyPress: function(val, e, field, options) {
	        field.mask(outrosimpMaskBehavior.apply({}, arguments), options);
	    }
	};

$(document).ready(function() {
	var editor = new $.fn.dataTable.Editor( {
		ajax: '../dataTables/tributacao/php/table.tbTributacao.php',
		table: '#tbTributacao',
//Traduçao
		i18n: {
			create: {
					button: "Add",
					title:  "Adicionar Tributação",
					submit: "Adicionar"
			},
        edit: {
            button: "Alterar",
            title:  "Alterar Tributação",
            submit: "Alterar"
        },
				remove: {
            button: "Apagar",
            title:  "Apagar Tributação",
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
		//Dados da tabela Tributação
		fields: [
			{
				label: "Tributa&ccedil;&atilde;o:",
				name: "tbTributacao.nome"
			},
			{
				label: "Aliquota ICMS:",
				name: "tbTributacao.icmsAliquota",
				attr:  {
		        placeholder: '11,50%'
    				}
			},
			{
				label: "outros Impostos:",
				name: "tbTributacao.outrosImpostos",
				attr:  {
		        placeholder: '11,50%'
					}
			},
			{
				label: "CST:",
				name: "tbTributacao.CST"
			}
		]
	} );

//Conversao de dados para gravar no banco
		//ICMS ALIQUOTA
		editor.on( 'preSubmit', function ( e, data, action ) {
	  $.each( data.data, function ( key, values ) {
			var value = data.data[ key ][ 'tbTributacao' ]['icmsAliquota' ];
			value = value.replace('%', '').replace(',', '.');
	    data.data[ key ][ 'tbTributacao' ]['icmsAliquota' ] = value;
	  } );
	} );
	//ICMS ALIQUOTA
	editor.on( 'preSubmit', function ( e, data, action ) {
	$.each( data.data, function ( key, values ) {
		var value = data.data[ key ][ 'tbTributacao' ]['outrosImpostos' ];
		value = value.replace('%', '').replace(',', '.');
		data.data[ key ][ 'tbTributacao' ]['outrosImpostos' ] = value;
	} );
} );

	var table = $('#tbTributacao').DataTable( {
		ajax: '../dataTables/tributacao/php/table.tbTributacao.php',
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

					//Dados da tabela Tributação
					columns: [
						{
							data: "tbTributacao.nome"
						},
						{
							data: "tbTributacao.icmsAliquota",
							render: $.fn.dataTable.render.number( '.', ',', 2, '', '%' )
						},
						{
							data: "tbTributacao.outrosImpostos",
							render: $.fn.dataTable.render.number( '.', ',', 2, '', '%' )
						},
						{
							data: "tbTributacao.CST"
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

	//MASCARAMENTO ICMS
	editor.one(`open`, function(e, mode, action) {
			editor.field(`tbTributacao.icmsAliquota`).input().addClass(`icms-number`);
			$(`.icms-number`).mask(icmsMaskBehavior, {reverse: true}, icmsOptions);
	});
	//MASCARAMENTO OUTROS IMPOSTOS
	editor.one(`open`, function(e, mode, action) {
			editor.field(`tbTributacao.outrosImpostos`).input().addClass(`outrosimp-number`);
			$(`.outrosimp-number`).mask(outrosimpMaskBehavior, {reverse: true}, outrosimpOptions);
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
