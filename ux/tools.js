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

function getPoltronas(isRoot, rota, success, failure){
    sendMessage((isRoot ? "" : "../") + "getPoltronas.php", {rota: rota}, success, failure);
}

function applyPoltronas(isRoot, rota){
  getPoltronas(isRoot, rota, function(resp){
      if(resp.result){
          var poltronas = resp.poltronas;
          poltronas.forEach(poltrona => {
              var el = null;
              if(poltrona.numero < 10){
                el = document.getElementById("ida_0" + poltrona.numero);
              } else {
                el = document.getElementById("ida_" + poltrona.numero);
              }
              if(el){
                  if(poltrona.disponivel){
                    el.className = "livre";
                  } else {
                    el.className = "ocupada";
                  }
              } else {
                  console.log("poltrona: " + poltrona.numero + " não encontrada ");
              }
          });
      } else {
          alert("Não foi possivel verificar as poltronas");
          window.location = "login.html";
      }
    }, function(){
    });
}
