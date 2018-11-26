<?php
    require 'session.php';
    require 'utils.php';
    require 'sefaz.php';

    Log::$phpFile = "verificarPassagem.php";
    Log::$logLevel = LogLevel::Info;

    // Verifica a sessão
    if (!isSessionOK()) {
        return false;
    }

    $config = parse_ini_file("config.ini", true);

    // Configuracao da base mysql
    $dbLogConnectionConfig = $config["DBLogConnectionConfig"];
    $dbLogServer = $dbLogConnectionConfig["DBServer"];
    $dbLogUser = $dbLogConnectionConfig["DBUser"];
    $dbLogPassword = $dbLogConnectionConfig["DBPassword"];
    $dbLogDatabase = $dbLogConnectionConfig["DBDatabase"];

    Log::debug(LogLevel::Info, "<<< ".json_encode($_POST));








    // Verifica o status da passagem 
    $sefaz = new Sefaz();
    $token = "UyBBIEluZm9ybeF0aWNhajJCTUs=";
    $nsNRec = 27;
    $CNPJ = "63679351000190";
    $retorno = $sefaz->consultarStatusProcessamento($token, $CNPJ, $nsNRec);
    echo $retorno;



    


    // Download da passagem 
    /*$sefaz = new Sefaz();
    $token = "UyBBIEluZm9ybeF0aWNhajJCTUs=";
    $tpDown = "XP"; // X - XML; P - PDF; XP - XML E PDF
    $chBPe = "13100863679351000190630010000000011382653070"; // Isso é o resultado do status (consultarStatusProcessamento) relativo ao nsNRec
    $tpAmb = "2"; // 2 - homologação; 1 - produção
    $retorno = $sefaz->downloadBPe($token, $chBPe, $tpDown, $tpAmb);
    echo $retorno;*/
    
    //var_dump($retorno);
    //Log::debug(LogLevel::Info, "curl executado: " + $retorno);
    return;
?>
