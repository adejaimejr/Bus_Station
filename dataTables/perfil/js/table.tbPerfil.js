
/*
 * Editor client script for DB table tbPerfil
 * Created by http://editor.datatables.net/generator
 */

(function($){

$(document).ready(function() {
	var editor = new $.fn.dataTable.Editor( {
		ajax: '../dataTables/perfil/php/table.tbPerfil.php',
		table: '#tbPerfil',
		//Traduçao
				i18n: {
					create: {
							button: "Add",
							title:  "Permissões de usuário",
							submit: "Adicionar"
					},
		        edit: {
		            button: "Alterar",
		            title:  "Permissões de usuário",
		            submit: "Alterar"
		        },
						remove: {
		            button: "Apagar",
		            title:  "Permissões de usuário",
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
				label: "Nome Perfil:",
				name: "tbPerfil.nome"
			},
			{
				label: "Dashboard:",
				name: "tbPerfil.tbDashboard",
				type: "select",
				options: [
					{ label: "SIM", value: 1 },
				        { label: "NAO",    value: 0 }
				]
			},
			{
				label: "Empresa:",
				name: "tbPerfil.tbFilial",
				type: "select",
				options: [
					{ label: "SIM", value: 1 },
				        { label: "NAO",    value: 0 }
				]
			},
			{
				label: "Tributação:",
				name: "tbPerfil.tbTributacao",
				type: "select",
				options: [
					{ label: "SIM", value: 1 },
				        { label: "NAO",    value: 0 }
				]
			},
			{
				label: "Usu&aacute;rio:",
				name: "tbPerfil.tbUsuario",
				type: "select",
				options: [
					{ label: "SIM", value: 1 },
				        { label: "NAO",    value: 0 }
				]
			},
			{
				label: "Passageiro:",
				name: "tbPerfil.tbPassageiro",
				type: "select",
				options: [
					{ label: "SIM", value: 1 },
				        { label: "NAO",    value: 0 }
				]
			},
			{
				label: "&Ocirc;nibus:",
				name: "tbPerfil.tbOnibus",
				type: "select",
				options: [
					{ label: "SIM", value: 1 },
				        { label: "NAO",    value: 0 }
				]
			},
			{
				label: "Rotas:",
				name: "tbPerfil.tbRotas",
				type: "select",
				options: [
					{ label: "SIM", value: 1 },
				        { label: "NAO",    value: 0 }
				]
			},
			{
				label: "Motorista:",
				name: "tbPerfil.tbMotorista",
				type: "select",
				options: [
					{ label: "SIM", value: 1 },
				        { label: "NAO",    value: 0 }
				]
			},
			{
				label: "Tarifas:",
				name: "tbPerfil.tbTarifas",
				type: "select",
				options: [
					{ label: "SIM", value: 1 },
				        { label: "NAO",    value: 0 }
				]
			},
			{
				label: "Pagamento:",
				name: "tbPerfil.tbPagamento",
				type: "select",
				options: [
					{ label: "SIM", value: 1 },
				        { label: "NAO",    value: 0 }
				]
			},
			{
				label: "Passagem:",
				name: "tbPerfil.tbPassagem",
				type: "select",
				options: [
					{ label: "SIM", value: 1 },
				        { label: "NAO",    value: 0 }
				]
			},
			{
				label: "Relatorios:",
				name: "tbPerfil.tbRelatorios",
				type: "select",
				options: [
					{ label: "SIM", value: 1 },
				        { label: "NAO",    value: 0 }
				]
			}
		]
	} );

	var table = $('#tbPerfil').DataTable( {
		ajax: '../dataTables/perfil/php/table.tbPerfil.php',
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

//Definicao da coluna
  columnDefs: [ {
    targets: 1,
    render: function ( data, type, row, meta ) {
			if(data == 0){
				return "NAO";
			}
			return "SIM";
    }
  },
	{
    targets: 2,
    render: function ( data, type, row, meta ) {
			if(data == 0){
				return "NAO";
			}
			return "SIM";
    }
  },
	{
    targets: 3,
    render: function ( data, type, row, meta ) {
			if(data == 0){
				return "NAO";
			}
			return "SIM";
    }
  },
	{
    targets: 4,
    render: function ( data, type, row, meta ) {
			if(data == 0){
				return "NAO";
			}
			return "SIM";
    }
  },
	{
    targets: 5,
    render: function ( data, type, row, meta ) {
			if(data == 0){
				return "NAO";
			}
			return "SIM";
    }
  },
	{
    targets: 6,
    render: function ( data, type, row, meta ) {
			if(data == 0){
				return "NAO";
			}
			return "SIM";
    }
  }
],

					//Dados da tabela usuarios
		columns: [
			{
				data: "tbPerfil.nome"
			},
			{
				data: "tbPerfil.tbDashboard"
			},
			{
				data: "tbPerfil.tbPassageiro"
			},
			{
				data: "tbPerfil.tbTarifas"
			},
			{
				data: "tbPerfil.tbPagamento"
			},
			{
				data: "tbPerfil.tbPassagem"
			},
			{
				data: "tbPerfil.tbRelatorios"
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
