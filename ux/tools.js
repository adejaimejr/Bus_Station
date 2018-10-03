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

function getViagensDisponiveis(isRoot, success, failure){
    sendMessage((isRoot ? "" : "../") + "getViagensDisponiveis.php", {}, success, failure);
}

function applyViagensDisponiveis(isRoot){
  getViagensDisponiveis(isRoot, function(resp){
    if(resp.result){
        viagens = resp.viagensDisponiveis;
        var viagensHTML = "<option value='-1'>Selecione a Rota</option>";
        viagens.forEach(viagem => {
            viagensHTML = viagensHTML + "<option value='" + viagem.id + "'>" + 
                viagem.horariopartida + " - " +
                viagem.origemCidade + "-" +
                viagem.origemUF +  " - " +
                viagem.destinoCidade +  "-" +
                viagem.destinoUF
                "</option>";
        });

        var elModel = document.getElementById("rotas");
        elModel.innerHTML = viagensHTML;

        elModel.addEventListener("change", function(e){
          e.preventDefault();
          if(e.currentTarget.selectedIndex >= 1){
            var horario = viagens[e.currentTarget.selectedIndex-1].horariopartida;
            document.getElementById("viagemHorario1").innerHTML = horario;
            document.getElementById("viagemHorario2").innerHTML = horario;

            applyPoltronas(false, e.currentTarget.value);
          } else {
              document.getElementById("viagemHorario1").innerHTML = "00:00:00";
              document.getElementById("viagemHorario2").innerHTML = "00:00:00";

              clearPoltronas();
          }
        });

        clearPoltronas();

      } else {
          alert("Não foi possivel verificar as viagens");
          window.location = "login.html";
      }
    }, function(){
    });
}

function getPoltronas(isRoot, rota, success, failure){
    sendMessage((isRoot ? "" : "../") + "getPoltronas.php", {rota: rota}, success, failure);
}

function clearPoltronas(){
    poltronas = [];
    poltronasLivres = ["1", "2", "3"];
    poltronasOcupadas = [];      

    for(var i = 1; i <= 56; i++){
        if(i < 10){
            el = document.getElementById("ida_0" + i);
        } else {
            el = document.getElementById("ida_" + i);
        }
        el.className = "ocupada";
    };

    poltronasLivres.forEach(polContainer => {
        document.getElementById('poltronaContainer' + polContainer).hidden = true;
        document.getElementById('resumoContainer' + polContainer).hidden = true;
    });

    var total = 0;
    document.getElementById('valorTotal').innerText = 'R$' + total;
    document.getElementById('valorTotalEmitir').innerText = 'R$' + total;          
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
