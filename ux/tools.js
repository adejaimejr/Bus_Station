function sendMessage(url, params, success, failure){
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4) {
          if(this.status == 200){
              var resp = JSON.parse(xhttp.responseText);
              success(resp);
          } else {
              if(this.status == 302){
                alert("Sua sessão foi expirada. Por favor, realize o login novamente");
                document.location = "/Bus_Station/login.html";
              } else {
                failure(resp);
              }
          };
      };
    };

    xhttp.open("POST", url, true);
    xhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhttp.send(params);
  }

  function convertCGI(obj){
      var str = "";
      for (var key in obj) {
          if (str != "") {
              str += "&";
          }
          str += key + "=" + encodeURIComponent(obj[key]);
      }
      return str;
  }

  function verificaPerfil(isRoot, success, failure){
      sendMessage((isRoot ? "" : "../") + "verificaPerfil.php", {}, success, failure);
  }

  function applyPerfils(isRoot){
    verificaPerfil(isRoot, function(perfil){
        if(perfil.result){
            if(!perfil.filial){
                $("#mbMenuEmpresa").hide();
                $("#menuEmpresa").hide();
            }
            if(!perfil.usuario){
                $("#mbMenuUsuario").hide();
                $("#menuUsuario").hide();
            }
            if(!perfil.passageiro){
                $("#mbMenuPassageiro").hide();
                $("#menuPassageiro").hide();
            }
            if(!perfil.onibus){
                $("#mbMenuOnibus").hide();
                $("#menuOnibus").hide();
            }
            if(!perfil.rotas){
                $("#mbMenuRotas").hide();
                $("#menuRotas").hide();
            }
            if(!perfil.motorista){
                $("#mbMenuMotorista").hide();
                $("#menuMotorista").hide();
            }
            if(!perfil.tarifas){
                $("#mbMenuTarifas").hide();
                $("#menuTarifas").hide();
            }
            if(!perfil.pagamento){
                $("#mbMenuPagamento").hide();
                $("#menuPagamento").hide();
            }
            if(!perfil.viagem){
                $("#mbMenuViagem").hide();
                $("#menuViagem").hide();
            }
            if(!perfil.passagem){
                $("#mbMenuPassagem").hide();
                $("#menuPassagem").hide();
            }
            if(!perfil.dashboard){
                $("#mbMenuDashboard").hide();
                $("#menuDashboard").hide();
                $("#dashboard").hide();
                $("#menuPrincipal").hide();
            }
            if(!perfil.tributacao){
                $("#mbMenuTributacao").hide();
                $("#menuTributacao").hide();
            }
            if(!perfil.relatorios){
                $("#mbMenuRelatorios").hide();
                $("#menuRelatorios").hide();
            }
            if(!perfil.onibus && !perfil.rotas && !perfil.tarifas && !perfil.motorista){
                $("#mbMnOnibus").hide();
                $("#mnOnibus").hide();
            }

            if(!perfil.empresa && !perfil.usuarios && !perfil.tributacao &&
                !perfil.onibus && !perfil.rotas && !perfil.tarifas && !perfil.motorista &&
                !perfil.passageiro && !perfil.pagamento){
                $("#menuCadastros").hide();
            }

            if(!perfil.passagem && !perfil.relatorios){
                $("#menuVendas").hide();
            }
        } else {
            alert("Não foi possivel acessar o servidor");
            window.location = "login.html";
        }
      }, function(){

      });
  }
