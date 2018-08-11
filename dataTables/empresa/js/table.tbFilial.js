
/*
 * Editor client script for DB table tbFilial
 * Created by http://editor.datatables.net/generator
 */

(function($){

//MASCARAMENTO

//MASCARAMENTO CNPJ
	var cnpjMaskBehavior = function (val) {
    return '00.000.000/0000-00';
},
cnpjOptions = {
        onKeyPress: function(val, e, field, options) {
        field.mask(cnpjMaskBehavior.apply({}, arguments), options);
    }
};
//MASCARAMENTO IE
	var ieMaskBehavior = function (val) {
    return '99999999-0';
},
ieOptions = {
        onKeyPress: function(val, e, field, options) {
        field.mask(ieMaskBehavior.apply({}, arguments), options);
    }
};
//MASCARAMENTO TELEFONE
	var mobileMaskBehavior = function (val) {
    return val.replace(/\D/g, '').length === 11	 ? '(00) 00000-0000' : '(00) 0000-00009';
},
celularOptions = {
        onKeyPress: function(val, e, field, options) {
        field.mask(mobileMaskBehavior.apply({}, arguments), options);
    }
};
//MASCARAMENTO CEP
	var cepMaskBehavior = function (val) {
    return '00000-000';
},
cepOptions = {
        onKeyPress: function(val, e, field, options) {
        field.mask(cepMaskBehavior.apply({}, arguments), options);
    }
};

//Tabela
$(document).ready(function() {
	var editor = new $.fn.dataTable.Editor( {
		ajax: '../dataTables/empresa/php/table.tbFilial.php',
		table: '#tbFilial',
		i18n: {
			create: {
					button: "Add",
					title:  "Adicionar Empresa",
					submit: "Adicionar"
			},
        edit: {
            button: "Alterar",
            title:  "Alterar Empresa",
            submit: "Alterar"
        },
				remove: {
            button: "Apagar",
            title:  "Apagar Empresa",
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
		//Dados da tabela
		fields: [
			{
				label: "Raz&atilde;o Social:",
				name: "tbFilial.razao"
			},
			{
				label: "CNPJ:",
				name: "tbFilial.cnpj",
				attr:  {
		        placeholder: '00.000.000/0000-00'
    				}
			},
			{
				label: "Inscri&ccedil;&atilde;o Estadual:",
				name: "tbFilial.ie",
				attr:  {
		        placeholder: '00000000-0'
    				}
			},
			{
				label: "Telefone:",
				name: "tbFilial.telefone",
				attr:  {
		        placeholder: '(00) 0000-0000'
    				}
			},
			{
				label: "Logradouro:",
				name: "tbFilial.logradouro"
			},
			{
				label: "N&uacute;mero:",
				name: "tbFilial.numero"
			},
			{
				label: "Bairro:",
				name: "tbFilial.bairro"
			},
			{
				label: "Cep:",
				name: "tbFilial.cep",
				attr:  {
		        placeholder: '00000-000'
    				}
			},
			{
				label: "Cidade:",
				name: "tbFilial.cidade",
				type: "select",
				placeholder: "--Informe a CIDADE--"
			},
			{
				label: "UF:",
				name: "tbFilial.uf",
				type: "select",
				placeholder: "--Informe a UF--"
			},
			{
				label: "Tributa&ccedil;&atilde;o:",
				name: "tbFilial.tributacao",
				type: "select",
				placeholder: "--Informe a Tributação--"
			}
		]
	} );

	var table = $('#tbFilial').DataTable( {
		ajax: '../dataTables/empresa/php/table.tbFilial.php',
		select: true,
		lengthChange: false,
		scrollY: 250,	
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
						//Dados da tabela
						columns: [
							{
								data: "tbFilial.razao"
							},
							{
								data: "tbFilial.cnpj"
							},
							{
								data: "tbFilial.telefone"
							},
							{
								//Dados Tabela location
								data: "l2.cidade"
							},
							{
								//Dados Tabela location
								data: "l1.uf"
							},
							{
								//Dados Tabela tbtributacao
								data: "tbtributacao.nome"
							}
						]
	} );

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

	//MASCARAMENTO CNPJ
	editor.one(`open`, function(e, mode, action) {
			editor.field(`tbFilial.cnpj`).input().addClass(`cnpj-number`);
			$(`.cnpj-number`).mask(cnpjMaskBehavior, cnpjOptions);
	});
	//MASCARAMENTO IE
	editor.one(`open`, function(e, mode, action) {
			editor.field(`tbFilial.ie`).input().addClass(`ie-number`);
			$(`.ie-number`).mask(ieMaskBehavior, ieOptions);
	});
	//MASCARAMENTO TELEFONE
	editor.one(`open`, function(e, mode, action) {
			editor.field(`tbFilial.telefone`).input().addClass(`mobile-number`);
			$(`.mobile-number`).mask(mobileMaskBehavior, celularOptions);
	});
	//MASCARAMENTO CEP
	editor.one(`open`, function(e, mode, action) {
			editor.field(`tbFilial.cep`).input().addClass(`cep-number`);
			$(`.cep-number`).mask(cepMaskBehavior, cepOptions);
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
