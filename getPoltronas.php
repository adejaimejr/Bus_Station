<?php
    require 'session.php';
    require 'utils.php';

    Log::$phpFile = "getPoltronas.php";
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

    $result = false;
    $rota = 57;
    $poltronas = [];
    try {
        //$rota = $_POST["rota"];

        Log::debug(LogLevel::Info, "mysql connecting");

        $logConn = mysqli_connect($dbLogServer, $dbLogUser, $dbLogPassword, $dbLogDatabase);
        if (mysqli_connect_errno()) {
            Log::debug(LogLevel::Error, "MySQL Connect Log failed: ".mysqli_connect_error());
            return false;
        }

        mysqli_set_charset($logConn,"utf8");

        Log::debug(LogLevel::Info, "mysql setting");
        mysqli_autocommit($logConn, TRUE);

        $select = 'select tbviagens_passagens.id as passagem, numero, tbviagens_passagens.disponivel, tbviagens_poltronas.tipoServicoBPe from tbviagem ' .
            'inner join tbviagens_passagens on (viagem = tbviagem.id) ' .
            'inner join tbviagens_poltronas on (poltrona = tbviagens_poltronas.id) ' .
            'where rota = '.$rota;

        Log::debug(LogLevel::Info, "select: ".$select);

        $logQuery = mysqli_query($logConn, $select);
        if (!$logQuery) {
            Log::debug(LogLevel::Error, "mysqli_query - ".mysqli_error($logConn));
            header("location:login.html");
            // destroy a sessão
            session_destroy();
            return false;
        }

        while($logDataset = mysqli_fetch_array($logQuery, MYSQLI_BOTH)){
            $newRow = array(  
                'passagem' => $logDataset["passagem"],
                'numero' =>  utf8_encode($logDataset["numero"]),
                'disponivel' => $logDataset["disponivel"] == "1",
                'tipoServicoBPe' => $logDataset["tipoServicoBPe"]
            );
            
            array_push($poltronas, $newRow);              
        }

        $result = true;
    } finally {
        if($logConn){
            mysqli_close($logConn);
        }
    }

    $data = [
        'result' => $result,
        'poltronas' => $poltronas
    ];

    header('Content-Type: application/json');
    Log::debug(LogLevel::Info, ">>> ".json_encode($data));

    echo json_encode($data);
    Log::debug(LogLevel::Info, "--- out");
    return true;
?>
