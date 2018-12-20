<?php
    require 'session.php';
    require 'utils.php';
    require 'sefaz.php';

    date_default_timezone_set('America/Manaus');    

    Log::$phpFile = "emitirPassagem.php";
    Log::$logLevel = LogLevel::Info;

    // Verifica a sessão
    /*if (!isSessionOK()) {
        return false;
    }*/

    $config = parse_ini_file("config.ini", true);

    // Configuracao da base mysql
    $dbLogConnectionConfig = $config["DBLogConnectionConfig"];
    $dbLogServer = $dbLogConnectionConfig["DBServer"];
    $dbLogUser = $dbLogConnectionConfig["DBUser"];
    $dbLogPassword = $dbLogConnectionConfig["DBPassword"];
    $dbLogDatabase = $dbLogConnectionConfig["DBDatabase"];

    // General Config
    $generalCfg = $config["GeneralConfig"];
    $applicationVersion = $generalCfg["applicationVersion"]; 
    $mysqlDateFormat = $generalCfg["mysqlDateFormat"];

    // BPe Config
    $bpeConfig = $config["BPeConfig"];
    $bpeConfig_TAR = $bpeConfig["TAR"];


    $passagemTeste = $bpeConfig["PassagemTeste"];    

    /* teste */
    $_POST["viagem"] = '{"id":"65","origemCidade":"Boa Vista","origemUF":"AM","origemMunicipioIBGE":"1302603","destinoCidade":"Manaus","destinoUF":"AM","destinoMunicipioIBGE":"1302603","horariopartida":"08:00:00","meiapassagem":"90.00","normal":"180.00","pedagio":"0.00","promocional":"140.00","seguro":"0.00","dataviagem":"2018-12-21"}';
    $_POST["poltronas"] = '[{"poltrona":10,' .
        '"passagem":"' . $passagemTeste . '","tipoServicoBPe":"3","polContainer":"3","passageiro":{"cpf":"11111111111","cnpj":"","tipoDocumento":"1","numeroDocumento":"teste","ie":"","idEstrangeiro":"","dtNasc":"2018-10-01","nome":"teste","email":"teste@teste.com","fone":"999999999","emergencia":"999999999","logradouro":"teste","numero":"100","complemento":"teste","cep":"99999999","bairro":"teste","cidade":"2","uf":"RR","observacao":"teste","tarifa":1,"valorTarifa":180,"dataviagem":"2018-01-26","horario":"08:00:00","nacionalidade":0,"nomeCidade":"Boa Vista","municipioIBGE":"1400100","pais":"1058","nomePais":"Brasil","tarifaDescr":"Tarifa Normal","descontoporc":"0","tpDesconto":"0","valDesconto":0}}]';
    $_POST["pagamentos"] = '[{"pagamentoIndex":1,"formaPag":"0","prazo":"0","bandeira":"01","valorParcela":"180","valParTotal":"180","valTroco":0}]';
    $_POST["comprador"] = '{"cpf":"11111111111","cnpj":"","tipoDocumento":"","numeroDocumento":"","ie":"","idEstrangeiro":"","dtNasc":"","nome":"teste","email":"teste@teste.com","fone":"999999999","emergencia":"","logradouro":"teste","numero":"100","complemento":"teste","cep":"99999999","bairro":"teste","cidade":"2","uf":"RR","observacao":"","tarifa":0,"valorTarifa":0,"dataviagem":"","horario":"","tipoComprador":0,"nacionalidade":0,"tipoContribuicaoICMS":0,"nomeCidade":"Boa Vista","municipioIBGE":"1400100","pais":"1058","nomePais":"Brasil"}';


    //$viagem["origemUF"] = "AM"; // UF de início da viagem deve ser igual a UF do emitente do BP-e // teste
    //$viagem["origemMunicipioIBGE"] = "1302603"; // teste
    // Data/hora de emissao do BP-e posterior a data/hora de recebimento

    /* fim do teste */
    




















    Log::debug(LogLevel::Info, "<<< ".json_encode($_POST));
    /*
    $poltronas = json_decode($_POST["poltronas"], false);
    Log::debug(LogLevel::Info, "<<< --- poltronas: ".json_encode($poltronas));
    Log::debug(LogLevel::Info, "<<< poltrona0: ".json_encode($poltronas[0]));
    
    $poltrona0 = json_encode($poltronas[0], true);
    $poltrona0 = json_decode($poltrona0, true);

    $poltrona1 = json_encode($poltronas[1], true);
    $poltrona1 = json_decode($poltrona1, true);

    $poltrona2 = json_encode($poltronas[2], true);
    $poltrona2 = json_decode($poltrona2, true);

    
    Log::debug(LogLevel::Info, "<<< poltrona0.poltrona: ".$poltrona0["poltrona"]);
    Log::debug(LogLevel::Info, "<<< poltrona1.poltrona: ".$poltrona1["poltrona"]);
    Log::debug(LogLevel::Info, "<<< poltrona2.poltrona: ".$poltrona2["poltrona"]);

    Log::debug(LogLevel::Info, "<<< poltrona0.passageiro: ".json_encode($poltrona0["passageiro"]));
    Log::debug(LogLevel::Info, "<<< poltrona1.passageiro: ".json_encode($poltrona1["passageiro"]));
    Log::debug(LogLevel::Info, "<<< poltrona2.passageiro: ".json_encode($poltrona2["passageiro"]));

    Log::debug(LogLevel::Info, "<<< poltrona0.valorTarifa: ".json_encode($poltrona0["passageiro"]["valorTarifa"]));
    Log::debug(LogLevel::Info, "<<< poltrona1.valorTarifa: ".json_encode($poltrona1["passageiro"]["valorTarifa"]));
    Log::debug(LogLevel::Info, "<<< poltrona2.valorTarifa: ".json_encode($poltrona2["passageiro"]["valorTarifa"]));





    $pagamentos = json_decode($_POST["pagamentos"], false);
    Log::debug(LogLevel::Info, "<<< --- pagamentos: ".json_encode($pagamentos));
    Log::debug(LogLevel::Info, "<<< pagamento0: ".json_encode($pagamentos[0]));
    
    $pagamento0 = json_encode($pagamentos[0], true);
    $pagamento0 = json_decode($pagamento0, true);

    $pagamento1 = json_encode($pagamentos[1], true);
    $pagamento1 = json_decode($pagamento1, true);

    $pagamento2 = json_encode($pagamentos[2], true);
    $pagamento2 = json_decode($pagamento2, true);

    
    Log::debug(LogLevel::Info, "<<< pagamento0.pagamentoIndex: ".$pagamento0["pagamentoIndex"]);
    Log::debug(LogLevel::Info, "<<< pagamento1.pagamentoIndex: ".$pagamento1["pagamentoIndex"]);
    Log::debug(LogLevel::Info, "<<< pagamento2.pagamentoIndex: ".$pagamento2["pagamentoIndex"]);

    Log::debug(LogLevel::Info, "<<< pagamento0.valorParcela: ".json_encode($pagamento0["valorParcela"]));
    Log::debug(LogLevel::Info, "<<< pagamento1.valorParcela: ".json_encode($pagamento1["valorParcela"]));
    Log::debug(LogLevel::Info, "<<< pagamento2.valorParcela: ".json_encode($pagamento2["valorParcela"]));

    Log::debug(LogLevel::Info, "<<< pagamento0.valParTotal: ".json_encode($pagamento0["valParTotal"]));
    Log::debug(LogLevel::Info, "<<< pagamento1.valParTotal: ".json_encode($pagamento1["valParTotal"]));
    Log::debug(LogLevel::Info, "<<< pagamento2.valParTotal: ".json_encode($pagamento2["valParTotal"]));




*/  


/***************** TESTE EMISSÃO DE PASSAGEM ************************************/
/******* PRIMEIRA ETAPA: MANDAR O DOCUMENTO E RECEBER O NUMERO DO RECIBO NSNREC */

/**** TOKEN: UyBBIEluZm9ybeF0aWNhajJCTUs= *****/

/* TRATAMENTO DE PACOTE */
$poltronas = json_decode($_POST["poltronas"], false);
Log::debug(LogLevel::Info, "<<< --- poltronas: ".json_encode($poltronas));
/*Log::debug(LogLevel::Info, "<<< poltrona0: ".json_encode($poltronas[0]));

for($i = 0; $i < $poltronas.length; $i++){
    $i = 0; // teste

    $poltrona = json_encode($poltronas[$i], true);
    $poltrona = json_decode($poltrona, true);
}

Log::debug(LogLevel::Info, "Passageiro: ".json_encode($poltrona["passageiro"]));
Log::debug(LogLevel::Info, "CPF: ".$poltrona["passageiro"]["cpf"]);*/

$viagem = json_decode($_POST["viagem"], true);

$comprador = json_decode($_POST["comprador"], true);

/* FIM DO TRATAMENTO DE PACOTE */

Log::debug(LogLevel::Info, "Executando curl");

$token = "UyBBIEluZm9ybeF0aWNhajJCTUs=";
$tpConteudo = "json";

// data da emissão
$dataEmissao = date("c");  

// formata a data do embarque
$dt = DateTime::createFromFormat("Y-m-d h:i:s", $viagem["dataviagem"] . " " . $viagem["horariopartida"]);
$dataEmbarque = $dt->format("c");

// formata a data de validade - adiciona um ano
$dt = strtotime('+ 1 year', strtotime($dataEmissao));
$dataValidade = date('c', $dt);


//$dataEmissao = "2018-12-13T20:44:00-03:00"; // TESTE quando manda 13/12/2018 está gerando erro no servidor


/*
FORMA DE PAGAMENTO
"pagamentos":"[{\"pagamentoIndex\":1,\"formaPag\":\"2\",\"prazo\":\"0\",\"valorParcela\":\"10\",\"valParTotal\":\"10\"},
{\"pagamentoIndex\":2,\"formaPag\":\"1\",\"prazo\":\"0\",\"valorParcela\":\"10\",\"valParTotal\":\"10\"},
{\"pagamentoIndex\":3,\"formaPag\":\"0\",\"prazo\":\"0\",\"valorParcela\":\"10\",\"valParTotal\":\"10\"},
{\"pagamentoIndex\":4,\"formaPag\":\"2\",\"prazo\":\"3\",\"valorParcela\":\"20\",\"valParTotal\":60}]"}
*/

/* Tipos de pagamento BPe
01-Dinheiro;
02-Cheque;
03-Cartão de Crédito;
04-Cartão de Débito;
05-Vale Transportel;
99 - Outros
*/

class EmitirPassagemException extends Exception {    
}

$serverMsg = "";
$result = false;
$pdfBilhete = "";

try {

    $pagamentos = json_decode($_POST["pagamentos"], false);

    /* REGISTRO DOS DADOS NA BASE **********************************************************************************************/

    Log::debug(LogLevel::Info, "--- mysql connecting");

    $conn = mysqli_connect($dbLogServer, $dbLogUser, $dbLogPassword, $dbLogDatabase);
    if (mysqli_connect_errno()) {
        Log::debug(LogLevel::Error, "MySQL Connect Log failed: ".mysqli_connect_error());
        throw new EmitirPassagemException("Erro no servidor, verifique com o Administrador.");
    }      

    Log::debug(LogLevel::Info, "--- mysql setting");
    mysqli_autocommit($conn, TRUE);

    /*VALIDA OS DADOS DO COMPRADOR*/

    // Valida o nome - obrigatório
    $comprador["nome"] = trim($comprador["nome"]);
    if($comprador["nome"] == ""){
        throw new EmitirPassagemException("Nome do comprador é obrigatório");
    }
    if(strlen($comprador["nome"]) < 2){
        throw new EmitirPassagemException("O nome do comprador precisa ter pelo menos 2 caracteres");
    }
    if(strlen($comprador["nome"]) > 60){
        throw new EmitirPassagemException("O nome do comprador tem o tamanho máximo de 60 caracteres");
    }

    // Valida o CNPJ - obrigatório
    if($comprador["tipoComprador"] == "1"){ // 0 - pessoa física; 1 - pessoa jurídica
        $comprador["cnpj"] = trim($comprador["cnpj"]);    
        if($comprador["cnpj"] == ""){
            throw new EmitirPassagemException("CNPJ do comprador é obrigatório");
        }
        $comprador["cnpj"] = str_replace(".", "", $comprador["cnpj"]);
        $comprador["cnpj"] = str_replace("/", "", $comprador["cnpj"]);
        $comprador["cnpj"] = str_replace("-", "", $comprador["cnpj"]);
        if(!is_numeric($comprador["cnpj"])){
            throw new EmitirPassagemException("CNPJ do comprador aceita apenas números");
        }
        $comprador["cnpj"] = str_pad($comprador["cnpj"], 14, "0", STR_PAD_LEFT);
        if(strlen($comprador["cnpj"]) != 14){
            throw new EmitirPassagemException("O CNPJ do comprador precisa ter 14 caracteres numéricos - tamanho: " . strlen($comprador["cnpj"]));
        }
    } else { // pessoa física
        $comprador["cnpj"] = str_repeat("0", 14); // preenche com zeros para pessoa física
    }

    // Valida o CPF - obrigatório
    $comprador["cpf"] = trim($comprador["cpf"]);
    if($comprador["tipoComprador"] == "0"){ // 0 - pessoa física; 1 - pessoa jurídica
        if($comprador["cpf"] == ""){
            throw new EmitirPassagemException("CPF do comprador é obrigatório");
        }
        $comprador["cpf"] = str_replace(".", "", $comprador["cpf"]);
        $comprador["cpf"] = str_replace("-", "", $comprador["cpf"]);
        if(!is_numeric($comprador["cpf"])){
            throw new EmitirPassagemException("CPF do comprador aceita apenas números");
        }
        $comprador["cpf"] = str_pad($comprador["cpf"], 11, "0", STR_PAD_LEFT);
        if(strlen($comprador["cpf"]) != 11){
            throw new EmitirPassagemException("O CPF do comprador precisa ter 11 caracteres numéricos - tamanho: " . strlen($comprador["cpf"]));
        }
    }

    // Valida o IdEstrangeiro - é obrigatório somente se for estrangeiro
    $comprador["idEstrangeiro"] = trim($comprador["idEstrangeiro"]);
    if($comprador["nacionalidade"] == "1"){ // 0 - brasileira; 1 - estrangeira
        if($comprador["idEstrangeiro"] == ""){
            throw new EmitirPassagemException("A identificação de estrangeiro do comprador é obrigatória");
        }        
        if(strlen($comprador["idEstrangeiro"]) > 60){
            throw new EmitirPassagemException("A identificação de estrangeiro do comprador tem o tamanho máximo de 60 caracteres");
        }
    }

    // Valida a Inscrição Estadual - opcional
    $comprador["ie"] = trim($comprador["ie"]);
    if(strlen($comprador["ie"]) > 60){
        throw new EmitirPassagemException("A inscrição estadual do comprador tem o tamanho máximo de 14 caracteres");
    }
    if($comprador["tipoComprador"] == "1"){ // 0 - pessoa física; 1 - pessoa jurídica
        if($comprador["tipoContribuicaoICMS"] == "1"){ // 1 - Não é contribuinte do ICMS
            $comprador["ie"] = "";
        } else if($comprador["tipoContribuicaoICMS"] == "2"){ // 2 - Contribuinte do ICMS
            if($comprador["idEstrangeiro"] == ""){
                throw new EmitirPassagemException("A inscrição estadual é obrigatória para o tipo de contribuição de ICMS informada");
            }            
        } else if($comprador["tipoContribuicaoICMS"] == "3"){ // 3 - É contribuinte do ICMS Isento de inscrição no cadastro de contribuintes do ICMS
            $comprador["ie"] = "ISENTO";
        } else {
            throw new EmitirPassagemException("Tipo de contribuição do ICMS inválida. Verifique com o administrador.");
        }
    }

    // Valida o Logradouro - obrigatório
    $comprador["logradouro"] = trim($comprador["logradouro"]);
    if($comprador["logradouro"] == ""){
        throw new EmitirPassagemException("Logradouro do comprador é obrigatório");
    }
    if(strlen($comprador["logradouro"]) > 255){
        throw new EmitirPassagemException("O logradouro do comprador tem o tamanho máximo de 255 caracteres");
    }

    // Valida o Número - obrigatório
    $comprador["numero"] = trim($comprador["numero"]);
    if($comprador["numero"] == ""){
        throw new EmitirPassagemException("Número do endereço do comprador é obrigatório");
    }
    if(strlen($comprador["numero"]) > 60){
        throw new EmitirPassagemException("O número do endereço do comprador tem o tamanho máximo de 60 caracteres");
    }

    // Valida o Complemento - opcional
    $comprador["complemento"] = trim($comprador["complemento"]);
    if(strlen($comprador["complemento"]) > 60){
        throw new EmitirPassagemException("O complemento do endereço do comprador tem o tamanho máximo de 60 caracteres");
    }

    // Valida o Bairro - obrigatório
    $comprador["bairro"] = trim($comprador["bairro"]);
    if($comprador["bairro"] == ""){
        throw new EmitirPassagemException("Bairro do comprador é obrigatório");
    }
    if(strlen($comprador["bairro"]) > 60){
        throw new EmitirPassagemException("O bairro do comprador tem o tamanho máximo de 60 caracteres");
    }

    // Valida o Município IBGE - obrigatório
    $comprador["municipioIBGE"] = trim($comprador["municipioIBGE"]);
    if($comprador["municipioIBGE"] == ""){
        throw new EmitirPassagemException("Município do comprador é obrigatório");
    }
    if(strlen($comprador["municipioIBGE"]) != 7){
        throw new EmitirPassagemException("O código do município do comprador precisa ter 7 números. Verifique com o Administrador.");
    }

    // Valida o CEP - opcional
    $comprador["cep"] = trim($comprador["cep"]);
    $comprador["cep"] = str_replace("-", "", $comprador["cep"]);
    if(!is_numeric($comprador["cep"])){
        throw new EmitirPassagemException("CEP do comprador aceita apenas números");
    }
    if(strlen($comprador["cep"]) > 8){
        throw new EmitirPassagemException("O cep do comprador precisa ter 8 números.");
    }
    if(strlen($comprador["cep"]) > 0){    
        $comprador["cep"] = str_pad($comprador["cep"], 8, "0", STR_PAD_LEFT);
    }

    // Valida o pais - opcional
    $comprador["pais"] = trim($comprador["pais"]);
    if(!is_numeric($comprador["pais"])){
        throw new EmitirPassagemException("País do comprador aceita apenas números");
    }
    if(strlen($comprador["pais"]) > 4){
        throw new EmitirPassagemException("O país do comprador precisa ter no máximo 4 números. Verifique com o Administrador");
    }

    // Valida o fone - opcional
    $comprador["fone"] = trim($comprador["fone"]);
    if($comprador["fone"] != ""){
        $comprador["fone"] = str_replace(" ", "", $comprador["fone"]);
        $comprador["fone"] = str_replace("-", "", $comprador["fone"]);
        $comprador["fone"] = str_replace("(", "", $comprador["fone"]);
        $comprador["fone"] = str_replace(")", "", $comprador["fone"]);
        if(!is_numeric($comprador["fone"])){
            throw new EmitirPassagemException("O telefone do comprador aceita apenas números");
        }   
        if(strlen($comprador["fone"]) < 7){
            throw new EmitirPassagemException("O telefone do comprador precisa ter no mínimo 7 números.");
        }    
        if(strlen($comprador["fone"]) > 12){
            throw new EmitirPassagemException("O telefone do comprador precisa ter no máximo 12 números.");
        }    
    }

    // Valida o email - opcional
    $comprador["email"] = trim($comprador["email"]);
    if($comprador["email"] != ""){
        if(strlen($comprador["email"]) > 60){
            throw new EmitirPassagemException("O e-mail do comprador precisa ter no máximo 60 caracteres.");
        }    
    }
    
    /*Registro do comprador na base*/

    $stmt = mysqli_prepare($conn, 'insert into tbpassagens_comprador (nome, cnpj, cpf, IdEstrangeiro, InscricaoEstadual, logradouro, ' . 
        'numero, complemento, bairro, cidade, cep, pais, telefone, email, tipoComprador, estrangeiro, tipoContribuicaoICMS) values( ' .
        '?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)') or die(mysqli_error($conn)); 
        
    if(!mysqli_stmt_bind_param($stmt, 'sssssssssisissiii', 
            $comprador["nome"], 
            $comprador["cnpj"], 
            $comprador["cpf"], 
            $comprador["idEstrangeiro"], 
            $comprador["ie"], 
            $comprador["logradouro"], 
            $comprador["numero"], 
            $comprador["complemento"], 
            $comprador["bairro"], 
            $comprador["municipioIBGE"], 
            $comprador["cep"], 
            $comprador["pais"], 
            $comprador["fone"], 
            $comprador["email"],
            $comprador["tipoComprador"],
            $comprador["nacionalidade"],
            $comprador["tipoContribuicaoICMS"])){
        $error = mysqli_error($conn);
        Log::debug(LogLevel::Error, " bind error: ".$error);        
        throw new EmitirPassagemException("Erro no servidor, tente novamente ou saia do sistema e entre novamente.");
    }    

    if(!mysqli_stmt_execute($stmt)){
        $error = mysqli_error($conn);
        Log::debug(LogLevel::Error, " error: ".$error);
        throw new EmitirPassagemException("Erro no servidor, tente novamente ou saia do sistema e entre novamente.");
    }


    /***************************************************************************************************************************/


    /* GERAÇÃO DAS PASSAGENS */

    $bpePagtos = [];

    $valTroco = 0;

    $i = 0;
    while(array_key_exists($i, $pagamentos)){
        $pagamento = json_encode($pagamentos[$i], true);
        $pagamento = json_decode($pagamento, true);
        $formaPag = $pagamento["formaPag"];    
        if($formaPag == "0"){ // 0 - dinheiro
            $bpeFormaPag = "01"; // 01 - dinheiro
            $valTroco += $pagamento["valTroco"];
        } else if($formaPag == "1"){ // 1 - cartão de débito
            $bpeFormaPag = "04"; // 04 - cartão de débito
        } else if($formaPag == "2"){ // 2 - cartão de crédito
            $bpeFormaPag = "03"; // 03 - cartão de crédito
        } else {
            Log::debug(LogLevel::Error, "Forma de pagamento inválida: " . $formaPag);
            throw new EmitirPassagemException("Forma de pagamento inválida");
        }

        $newItem = array(  
            "tPag" => $bpeFormaPag, // Forma de Pagamento:01-Dinheiro;02-Cheque;03-Cartão de Crédito;04-Cartão de Débito;05-Vale Transportel;99 - Outros
            "vPag" => number_format($pagamento["valParTotal"], 2), // Valor do Pagamento
            "card" =>  [ // Grupo de Cartões
                "tpIntegra" => "2", // OK FIXO - Tipo de Integração do processo de pagamento com o sistema de automação da empresa 1=Pagamento integrado com o sistema de automação da empresa Ex. equipamento TEF , Comercio Eletronico 2=Pagamento não integrado com o sistema de automação da empresa Ex: equipamento POS
                //"CNPJ" => "", // CNPJ da credenciadora de cartão de crédito/débito - para tpIntegra=2 não informar o CNPJ
                "tBand" => $pagamento["bandeira"] // Bandeira da operadora de cartão de crédito/débito:01–Visa; 02–Mastercard; 03–American Express; 04–Sorocred; 05 - Elo; 06 - Diners;99–Outros
                //"cAut" => "" // Número de autorização da operação cartão de crédito/débito - para tpIntegra=2 não informar o cAut
            ]                
        );
        
        array_push($bpePagtos, $newItem);
        $i++;   
    }

    // FORMATA valTroco
    $valTrocoStr = number_format($valTroco, 2, '.', '');

    // geração do cBP - Código numérico que compõe a Chave de Acesso. - Código aleatório gerado pelo emitente, com o objetivo de evitar acessos indevidos ao documento.
    // GERA O CÓDIGO ALEATÓRIO DE 8 POSICOES (cBP)
    $cBP = mt_rand(11111111, 99999999);
    $valor = $cBP;
    $peso = 2; // COMEÇA COM PESO 2 E VAI ATÉ 9
    $resultCalc = 0;
    for($i = 0; $i < 8; $i++){
        $rest = $valor % 10;
        $resultCalc += ($rest * $peso); 
        $valor = $valor - $rest;
        $valor = $valor / 10;
        $peso++;
    }

    // CALCULA O DIGITO VERIFICADOR (DV)
    $resto = $resultCalc % 11;
    $dv = 11 - $resto;
    if($dv == 0 || $dv == 1){
        $dv = 0;
    }

    try {
        Log::debug(LogLevel::Info, "mysql connecting");

        $conn = mysqli_connect($dbLogServer, $dbLogUser, $dbLogPassword, $dbLogDatabase);
        if (mysqli_connect_errno()) {
            Log::debug(LogLevel::Error, "MySQL Connect Log failed: ".mysqli_connect_error());
            return false;
        }

        mysqli_set_charset($conn,"utf8");

        Log::debug(LogLevel::Info, "mysql setting");
        mysqli_autocommit($conn, TRUE);

        $select = 'select ' .
            'id,  ' .
            'nome,  ' .
            'icmsAliquota ' .
            'from tbviagens_tributacao ' .
            'where CST = "00" and viagem = ' . $viagem["id"];

        Log::debug(LogLevel::Info, "select: ".$select);

        $query = mysqli_query($conn, $select);
        if (!$query) {
            Log::debug(LogLevel::Error, "mysqli_query - ".mysqli_error($conn));
            header("location:login.html");
            // destroy a sessão
            session_destroy();
            return false;
        }

        $dataset = mysqli_fetch_array($query, MYSQLI_BOTH);

        $icmsAliquota = $dataset["icmsAliquota"];   
        
        Log::debug(LogLevel::Info, "montando o BPe...");

        // monta o BPe pra transmitir
        $i = 0;
        while(array_key_exists($i, $poltronas)){
            $poltrona = json_encode($poltronas[$i], true);
            $poltrona = json_decode($poltrona, true);

            $valorPago = $viagem["normal"] - $poltrona["passageiro"]["valDesconto"];

            // Cálculo do ICMS
            $vBC = $valorPago;
            $vICMS = $valorPago * $icmsAliquota / 100;

            // FORMATA O valorTarifa
            $valorTarifa = number_format($poltrona["passageiro"]["valorTarifa"], 2, '.', '');

            // FORMATA O valorPago
            $valorPago = number_format($valorPago, 2, '.', '');

            // FORMATA O tpDesconto
            $tpDesconto = str_pad($poltrona["passageiro"]["tpDesconto"], 2, "0", STR_PAD_LEFT);

            // FORMATA O vDesconto
            $vDesconto = number_format($poltrona["passageiro"]["valDesconto"], 2, '.', '');

            // FORMATA O vICMS
            $vICMS = number_format($vICMS, 2, '.', '');

            // FORMATA O pICMS
            $pICMS = number_format($icmsAliquota, 2, '.', '');

            // Montagem do pacote BPe
            $BPe = [
                "infBPe" =>  [
                    "versao" => "1.00", // OK FIXO Versão do leiaute
                    //"id"   => "BPe...", // Identificador da tag a ser assina. do BP-e e precedida do literal "BPe" [NAO PRECISA PORQUE A API vai inserir automaticamente]
                    "ide" =>  [ // Identificação do BP-e
                        "cUF" => "13", // DOMINIO D1 - Código da UF do emitente do BP-e - 13 Amazonas
                        "tpAmb" => "2", // Tipo do Ambiente (1-Producao; 2-Homologacao)
                        "mod" => "63", // OK FIXO - Modelo do Bilhete de Passagem - Utilizar o código 63 para identificação do BP-e
                        "serie" => "1", // Série do documento fiscal
                        "nBP" => $poltrona["passagem"], // Número do bilhete de passagem - Número que identifica o bilhete 1 a 999999999.
                        "cBP" => $cBP, // Código numérico que compõe a Chave de Acesso. - Código aleatório gerado pelo emitente, com o objetivo de evitar acessos indevidos ao documento.
                        "cDV" => $dv, // Digito verificador da chave de acesso
                        "modal" => "1", // OK FIXO - Modalidade de transporte - 1 - Rodoviário; 3 - Aquaviário; 4 - Ferroviário.
                        "dhEmi" => $dataEmissao, // Data e hora de emissão do Bilhete de Passagem - Formato AAAA-MMDDTHH:MM:DD TZD
                        "tpEmis" => "1", // OK FIXO - Forma de emissão do Bilhete (Normal ou Contingência Off-Line) - 1 - Normal; 2 - Contingência Off-Line
                        "verProc" => $applicationVersion, // Versão do processo de emissão - Informar a versão do aplicativo emissor de BP-e.
                        "tpBPe" => "0", // Tipo do BP-e - (0 - BP-e normal; 3 - BP-e substituição)
                        "indPres" => "1", // Indicador de presença do comprador no estabelecimento comercial no momento da operação. 1=Operação presencial não embarcado; 2=Operação não presencial, pela Internet; 3=Operação não presencial, Teleatendimento; 4=BP-e em operação com entrega a domicílio; 5=Operação presencial embarcada; 9=Operação não presencial, outros.
                        "UFIni" => $viagem["origemUF"], // DOMINIO D6 - Sigla da UF Início da Viagem
                        "cMunIni" => $viagem["origemMunicipioIBGE"], // Código do município do início da viagem - 1400100 Boa Vista - 1302603 Manaus
                        "UFFim" => $viagem["destinoUF"], // DOMINIO D6 - Sigla da UF do Fim da Viagem
                        "cMunFim" => $viagem["destinoMunicipioIBGE"] // Código do município do fim da viagem - 1400100 Boa Vista - 1302603 Manaus
                        //"dhCont" => "2010-08-19T13:00:15-03:00", // Data e Hora da entrada em contingência - Informar a data e hora no formato AAAA-MMDDTHH:MM:SS
                        //"xJust" => "" // Justificativa da entrada em contingência
                    ],
                    "emit" =>  [ // Identificação do Emitente do BP-e
                        "CNPJ" => "63679351000190", // OK FIXO - CNPJ do emitente - 63679351000190 - DANTAS TRANSPORTES E INSTALACOES LTDA
                        "IE" => "54021588", // OK FIXO - Inscrição Estadual do emitemte
                        //"IEST" => "", // OK FIXO - Inscrição Estadual do Substituto Tributário
                        "xNome" => "DANTAS TRANSPORTES E INSTALACOES LTDA", // OK FIXO - Razão social ou Nome do emitente
                        "xFant" => "A DANTAS TRANSPORTES", // OK FIXO - Nome fantasia do emitente
                        "IM" => "4420601", // OK FIXO - Inscrição Municipal
                        "CNAE" => "4929902", // OK FIXO - CNAE Fiscal
                        "CRT" => "3", // OK FIXO - Código de Regime Tributário. - 1 – Simples Nacional; 2 – Simples Nacional – excesso de sublimite de receita bruta; 3 – Regime Normal
                        "enderEmit" =>  [ // Endereço do emitente
                            "xLgr" => "RUA UTINGA", // OK FIXO - Logradouro
                            "nro" => "310", // OK FIXO - Número
                            //"xCpl" => "", // OK FIXO - Complemento
                            "xBairro" => "LIRIO DO VALE", // OK FIXO - Bairro
                            "cMun" => "1302603", // OK FIXO - Código do município (utilizar a tabela do IBGE)
                            "xMun" => "MANAUS", // OK FIXO - Nome do município
                            "CEP" => "69038286", // OK FIXO - CEP
                            "UF" => "AM", // DOMINIO D6 - OK FIXO - Sigla da UF
                            "Fone" => "92 33062903", // OK FIXO - Telefone
                            "Email" => "dantast@argo.com.br" // OK FIXO - Endereço de E-mail
                        ],
                        "TAR" => $bpeConfig_TAR // Termo de Autorização de Serviço Regular - emitente do BP-e junto à ANTT para exercer a atividade
                    ],
                    "Comp" =>  [ // Identificação do Comprador do BP-e
                        "xNome" => $comprador["nome"], // Razão social ou Nome do comprado
                        "CNPJ" => $comprador["cnpj"], // Número do CNPJ
                        "CPF" => $comprador["cpf"], // Número do CPF
                        "idEstrangeiro" => $comprador["idEstrangeiro"], // Identificador do comprador em caso de comprador estrangeiro
                        "IE" => $comprador["ie"], // Inscrição Estadual
                        "enderComp" =>  [ // Endereço do comprador
                            "xLgr" => $comprador["logradouro"], // Logradouro
                            "nro" => $comprador["numero"], // Número
                            "xCpl" => $comprador["complemento"], // Complemento
                            "xBairro" => $comprador["bairro"], // Bairro
                            "cMun" => $comprador["municipioIBGE"], // Código do município (utilizar a tabela do IBGE), informar 9999999 para operações com o exterior
                            "xMun" => $comprador["nomeCidade"], // Nome do município, informar EXTERIOR para operações com o exterior.
                            "CEP" => $comprador["cep"], // CEP
                            "UF" => $comprador["uf"], // DOMINIO D5 - Sigla da UF, informar EX para operações com o exterior.
                            "cPais" => $comprador["pais"], // Código do país (BACEN)
                            "xPais" => $comprador["nomePais"], // Nome do país
                            "Fone" => $comprador["fone"], // Telefone
                            "Email" => $comprador["email"] // Endereço de E-mail
                        ]                
                    ]/*,
                    "agencia" =>  [ // Identificação da agência/preposto/terceiro que comercializou o BP-e
                        "xNome" => "", // Razão social ou Nome da Agência
                        "CNPJ" => "", // Número do CNPJ
                        "enderAgencia" =>  [ // Endereço da agência
                            "xLgr" => "", // Logradouro
                            //"nro" => "",
                            "Nro" => "", // Número
                            "xCpl" => "", // Complemento
                            "xBairro" => "", // Bairro
                            "cMun" => "", // município (utilizar a tabela do IBGE)
                            "xMun" => "", // Nome do município
                            "CEP" => "", // CEP 
                            "UF" => "", // Sigla da UF
                            "Fone" => "", // Telefone
                            "Email" => "" // Endereço de E-mail
                        ]
                    ],*/
            /*        "infBPeSub" =>  [ // Substituição para remarcação e/ou transferência
                        "chBPe" => "", // Chave do Bilhete de Passagem Substituido
                        "tpSub" => "" // Tipo de Substituição
                    ]*/,
                    "infPassagem" =>  [ // Informações do detalhamento da Passagem
                        "cLocOrig" => $viagem["origemUF"], // Código da Localidade de Origem - 1400100 Boa Vista - 1302603 Manaus
                        "xLocOrig" => $viagem["origemMunicipioIBGE"], // Descrição da Localidade de Origem
                        "cLocDest" => $viagem["destinoUF"],  // Código da Localidade de Destino - 1400100 Boa Vista - 1302603 Manaus
                        "xLocDest" => $viagem["destinoMunicipioIBGE"], // Descrição da Localidade de Destino
                        "dhEmb" => $dataEmbarque, // Data e hora de embarque
                        "dhValidade" => $dataValidade, // Data e hora de validade
                        "infPassageiro" =>  [ // Informações do passageiro
                            "xNome" => $poltrona["passageiro"]["nome"], // Nome do Passageiro
                            "CPF" => $poltrona["passageiro"]["cpf"], // Número do CPF
                            "tpDoc" => $poltrona["passageiro"]["tipoDocumento"], // Tipo do Documento de identificação
                            "nDoc" => $poltrona["passageiro"]["numeroDocumento"], // Número do Documento do passageiro
                            "dNasc" => $poltrona["passageiro"]["dtNasc"], // Data de Nascimento yyyy-mm-dd
                            "Fone" => $poltrona["passageiro"]["fone"], // Telefone
                            "Email" => $poltrona["passageiro"]["email"] // Endereço de E-mail
                        ]
                    ],
                    "infViagem" =>  [ // Grupo de informações da viagem do BP-e
            /*>>>*/            "cPercurso" => "0", // Código do percurso da viagem
            /*>>>*/            "xPercurso" => "teste", // Descrição do Percurso da viagem
                        "tpViagem" => "00", // Tipo de Viagem - 00-regular, 01-extra
                        "tpServ" => $poltrona["tipoServicoBPe"], // Tipo de Serviço
                        "tpAcomodacao" => "1", // FIXO - Tipo de Acomodação - 1-Assento/poltrona; 2-Rede; 3-Rede com ar-condicionado; 4-cabine; 5-outros
                        "tpTrecho" => "1", // FIXO - Tipo de trecho da viagem - 1-Normal; 2-Trecho Inicial; 3-Conexão
                        //"dhConexao" => "", // Data e hora da conexão Informar se tpTrecho = 3
                        //"Prefixo" => "", // Prefixo da linha
                        "Poltrona" => $poltrona["poltrona"], // Número da Poltrona / assento / cabine
                        //"Plataforma" => "", // Plataforma/carro/barco de Embarque
                        "dhViagem" => $dataEmbarque
                    ]/*,
                    "infTravessia" =>  [ // Informações do transporte aquaviário de travessia
                        "tpVeiculo" => "3", // Tipo do veículo transportado - 1-Vazio; 2-Carregado; 3-Não se aplica
                        "sitVeiculo" => "" // Situação do veículo transportado
                    ]*/,
                    "infValorBPe" =>  [ // Informações dos valores do Bilhete de Passagem
                        "vBP" => $valorTarifa, // Valor do Bilhete de Passagem (ex: 1.00)
                        "vDesconto" => $vDesconto, // Valor do desconto concedido ao comprador
                        "vPgto" => $valorPago, // Valor pago pelo BP-e (vBP - vDesconto)
                        "vTroco" => $valTrocoStr, // Valor do troco
                        //"tpDesconto" => $tpDesconto, // Tipo de desconto/benefício para o BP-e (SERÁ PROCESSADO LOGO ABAIXO)
                        //"xDesconto" => $poltrona["passageiro"]["tarifaDescr"], // Descrição do tipo de desconto/benefício concedido
                        "Comp" =>  [ // Componentes do Valor do Bilhete
                            [
                            "tpComp" => "01", // Tipo do Componente
                            "vComp" => $valorTarifa // Valor do componente
                            ]
                        ]
                    ],
                    "imp" =>  [ // Informações relativas aos Impostos
                        "ICMS" =>  [ // Informações relativas ao ICMS
                            "ICMS00" =>  [ // Prestação sujeito à tributação normal do ICMS
                                "CST" => "00", // OK FIXO - classificação Tributária do Serviço
                                "vBC" => $valorPago, // OK VARIAVEL - Valor da BC do ICMS
                                "pICMS" => $pICMS, // OK VARIAVEL - Alíquota do ICMS - Exemplo: 12.00
                                "vICMS" => $vICMS // OK CALCULADO - Valor do ICMS - Exemplo 12.00
                            ]/*,
                            "ICMS20" =>  [ // Prestação sujeito à tributação com redução de BC do ICMS
                                "CST" => "", // Classificação Tributária do serviço
                                "pRedBC" => "", // Percentual de redução da BC
                                "vBC" => "", // Valor da BC do ICMS
                                "pICMS" => "", // Alíquota do ICMS
                                "vICMS" => "" // Valor do ICMS
                            ],
                            "ICMS45" =>  [ // ICMS Isento, não Tributado ou diferido
                                "CST" => "40" // Classificação Tributária do Serviço
                            ],
                            "ICMS90" =>  [ // ICMS Outros
                                "CST" => "", // Classificação Tributária do Serviço
                                "pRedBC" => "", // Percentual de redução da BC
                                "vBC" => "", // Valor da BC do ICMS
                                "pICMS" => "", // Alíquota do ICMS
                                "vICMS" => "", // Valor do ICMS
                                "vCred" => "" // Valor do Crédito Outorgado/Presumido
                            ],
                            "ICMSOoutraUF" =>  [ // ICMS devido à UF de início da viagem, quando diferente da UF do emitente
                                "CST" => "", // Classificação Tributária do Serviço
                                "pRedBCOutraUF" => "", // Percentual de redução da BC
                                "vBCOutraUF" => "", // Valor da BC do ICMS
                                "pICMSOutraUF" => "", // Alíquota do ICMS
                                "vICMSOutraUF" => "" // Valor do ICMS devido outra UF
                            ],
                            "ICMSSN" =>  [ // Simples Nacional
                                "CST" => "", // Classificação Tributária do Serviço
                                "indSN" => "" // Indica se o contribuinte é Simples Nacional 1=Sim
                            ],
                            "vTotTrib" => "", // Valor Total dos Tributos
                            "infAdFisco" => "", // Informações adicionais de interesse do Fisco
                            "ICMSUFFim" =>  [ // Informações do ICMS de partilha com a UF de término do serviço de transporte na operação interestadual
                                "vBCUFFim" => "", // Valor da BC do ICMS na UF fim da viagem
                                "pFCPUFFim" => "", // Percentual do ICMS relativo ao Fundo de Combate à pobreza (FCP) na UF fim da viagem
                                "pICMSUFFim" => "", // Alíquota interna da UF fim da viagem
                                "pICMSInter" => "", // Alíquota interestadual das UF envolvidas
                                "pICMSInterPart" => "", // Percentual provisório de partilha entre os estados
                                "vFCPUFim" => "", // Valor do ICMS relativo ao Fundo de Combate á Pobreza (FCP) da UF fim da viagem
                                "vICMSUFFim" => "", // Valor do ICMS de partilha para a UF fim da viagem
                                "vICMSUFIni" => "" // Valor do ICMS de partilha para a UF início da viagem
                            ]             */
                        ]
                    ],
                    "pag" =>  $bpePagtos /*,
                    "autXML" =>  [ // Autorizados para download do XML do DF-e
                        "CNPJ" => "", // CNPJ do autorizado
                        "CPF" => "" // CPF do autorizado
                    ],
                    "infAdic" =>  [ // Informações Adicionais
                        "infAdFisco" => "", // Informações adicionais de interesse do Fisco
                        "infCpl" => "" // Informações complementares de interesse do Contribuinte
                ]*//*,
                    "infBPeSupl" =>  [ // Informações suplementares do BP-e [NAO PRECISA PORQUE A API vai inserir automaticamente]
                        "qrCodBPe" => "", // Texto com o QR-Code impresso no DABPE
                        "boardPassBPe" => "" // Texto contendo o boarding Pass impresso no DABPE (padrão PDF417)
                    ]*/
                ]
            ];

            // Trata o tpDesconto
            if($tpDesconto != "00"){
                $BPe["infBPe"]["infValorBPe"]["tpDesconto"] = $tpDesconto;
                $BPe["infBPe"]["infValorBPe"]["xDesconto"] = $poltrona["passageiro"]["tarifaDescr"];
            }

            // Monta o conteudo BPe pra transmitir
            $conteudo = [
                "BPe" => $BPe
            ];



            /************************/
            // enviado: string(1621) "{"BPe":{"infBPe":{"versao":"1.00","ide":{"cUF":"13","tpAmb":"2","mod":"63","serie":"1","nBP":"1","cBP":"","cDV":"","modal":"1","dhEmi":"2010-08-19T13:00:15-03:00","tpEmis":"1","verProc":"1","tpBPe":"0","indPres":"1","UFIni":"13","cMunIni":"1302603","UFFim":"RR","cMunFim":"1400100"},"emit":{"CNPJ":"63679351000190","IE":"1234567890","IEST":"1234567890","xNome":"DANTAS TRANSPORTES E INSTALACOES LTDA","xFant":"A DANTAS TRANSPORTES","IM":"0123456789","CNAE":"1234567","CRT":"3","enderEmit":{"xLgr":"teste","nro":"0","xCpl":"0","xBairro":"Teste","cMun":"1302603","xMun":"Teste","CEP":"00000000","UF":"AM","Fone":"","Email":""},"TAR":"0"},"Comp":{"xNome":"","CNPJ":"","CPF":"","idEstrangeiro":"","IE":"","enderComp":{"xLgr":"","Nro":"","xCpl":"","xBairro":"","cMun":"","xMun":"","CEP":"","UF":"","cPais":"1058","xPais":"Brasil","Fone":"","Email":""}},"infPassagem":{"cLocOrig":"0","xLocOrig":"teste","cLocDest":"0","xLocDest":"teste","dhEmb":"2010-08-19T13:00:15-03:00","infPassageiro":{"xNome":"Teste","CPF":"11111111111","tpDoc":"5","nDoc":"1234","dNasc":"2010-08-19","Fone":"","Email":""}},"infViagem":{"cPercurso":"0","xPercurso":"teste","tpViagem":"00","tpServ":"1","tpAcomodacao":"1","tpTrecho":"1","Prefixo":"","Poltrona":"","Plataforma":"","dhViagem":"2010-08-19T13:00:15-03:00"},"infValorBPe":{"vBP":"1.00","vDesconto":"0.00","vPgto":"1.00","vTroco":"0.00","tpDesconto":"99","xDesconto":"teste","Comp":[{"tpComp":"01","vComp":"0.50"},{"tpComp":"02","vComp":"0.50"}]},"imp":{"ICMS":{"ICMS45":{"CST":"40"}}},"pag":{"tPag":"01","vPag":"1.00","card":{"tpIntegra":"2","CNPJ":"11111111111111","tBand":"01","cAut":"0"}}}}}"
            // recebido: {"status":200,"motivo":"BP-e enviado para Sefaz","nsNRec":4}
            /************************/

            $conteudo = json_encode($conteudo);
            //var_dump($conteudo);
            Log::debug(LogLevel::Info, "xml BPe de saída: " . $conteudo);

            // Transmite o XML do BPe
            $sefaz = new Sefaz();
            $retorno = $sefaz->emitirNFe($token, $conteudo, $tpConteudo);
            //echo $retorno;
            //var_dump($retorno);
            Log::debug(LogLevel::Info, "resposta do BPe: " . $retorno);

            $resp = json_decode($retorno);

            Log::debug(LogLevel::Info, "resposta do BPe Status: " . $resp->status);

            // {"status":200,"motivo":"BP-e enviado para Sefaz","nsNRec":71}


            // Verifica o status
            // Verifica o status da passagem 

            if($resp->status == 200){
                while(true){
                    $nsNRec = $resp->nsNRec; 

                    
                    
                    //$nsNRec = 68; // APENAS TESTE




                    $CNPJ = "63679351000190";
                    $retorno = $sefaz->consultarStatusProcessamento($token, $CNPJ, $nsNRec);
                    Log::debug(LogLevel::Info, "resposta da verificação do BPe: " . $retorno);
                    $respVer = json_decode($retorno);
                    Log::debug(LogLevel::Info, "resposta do BPe Status: " . $respVer->status);

                    // {"status":200,"motivo":"Consulta realizada com sucesso","chBPe":"13181263679351000190630010000000261941679690","cStat":"0","xMotivo":"Documento em Processamento","nProt":"","dhRecbto":"2018-12-20T12:42:24-02:00"}

                    if($respVer->status == 200){
                        // {"status":200,"motivo":"Consulta realizada com sucesso","chBPe":"13181263679351000190630010000000261941679690","cStat":"539","xMotivo":"Rejeição: Duplicidade de BP-e, com diferença na Chave de Acesso [chBPe:13181263679351000190630010000000261937711348][nProt:313180000000251][dhAut:2018-12-17T14:59:21-02:00]"}
                        if($respVer->cStat == 100){
                            Log::debug(LogLevel::Info, "resposta da verificação do BPe OK");

                            // Download da passagem 
                            $tpDown = "XP"; // X - XML; P - PDF; XP - XML E PDF
                            $chBPe = $respVer->chBPe;
                            $tpAmb = "2"; // 2 - homologação; 1 - produção
                            $retorno = $sefaz->downloadBPe($token, $chBPe, $tpDown, $tpAmb);                            

                            Log::debug(LogLevel::Info, "resposta do download do BPe: " . $retorno);

                            $respDownload = json_decode($retorno);

                            if($respDownload->status == 200){
                                Log::debug(LogLevel::Info, "download do BPe OK");
                                $pdfBilhete = $respDownload->pdf;
                                $result = true;
                            } else {
                                $serverMsg = $respVer->xMotivo;
                            }
                            break;
                        } else if($respVer->cStat == 0){
                            Log::debug(LogLevel::Info, "resposta da verificação do BPe: " . $respVer->xMotivo);
                        } else {
                            $serverMsg = $respVer->xMotivo;
                            break;
                        }                    
                    } else {                    
                        $serverMsg = $respVer->motivo;
                        break;
                    }
                }
                if($result){
                    break;
                }
            } else {
                $serverMsg = $resp->motivo;
                break;
            }


            $i++;    
        }


    } finally {
        if($conn){
            mysqli_close($conn);
        }
    }


} catch(EmitirPassagemException $e) {
    $serverMsg = $e->getMessage();
    $result = false;
}

$data = [
    'result' => $result,
    'serverMsg' => $serverMsg,
    'pdfBilhete' => $pdfBilhete
];

header('Content-Type: application/json');
Log::debug(LogLevel::Info, ">>> ".json_encode($data));

echo json_encode($data);
Log::debug(LogLevel::Info, "--- out");
return true;
?>
