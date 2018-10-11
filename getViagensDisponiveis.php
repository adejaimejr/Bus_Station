<?php
    require 'session.php';
    require 'utils.php';

    Log::$phpFile = "getViagensDisponiveis.php";
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
    $viagensDisponiveis = [];
    $datasDisponiveis = [];
    try {
        Log::debug(LogLevel::Info, "mysql connecting");

        $logConn = mysqli_connect($dbLogServer, $dbLogUser, $dbLogPassword, $dbLogDatabase);
        if (mysqli_connect_errno()) {
            Log::debug(LogLevel::Error, "MySQL Connect Log failed: ".mysqli_connect_error());
            return false;
        }

        mysqli_set_charset($logConn,"utf8");

        Log::debug(LogLevel::Info, "mysql setting");
        mysqli_autocommit($logConn, TRUE);

        $select = 'select ' .
            'r.id,  ' .
            'o.cidade origemCidade,  ' .
            'o.uf origemUF, ' .
            'd.cidade destinoCidade,   ' .
            'd.uf destinoUF, ' .
            'horariopartida,  ' .
            'v.dataviagem, ' .
            't.meiapassagem,  ' .
            't.normal,  ' .
            't.pedagio,  ' .
            't.promocional,  ' .
            't.seguro  ' .
            'from tbviagens_rotas r ' .
            'inner join location o on (o.id = origem) ' .
            'inner join location d on (d.id = destino) ' .
            'inner join tbviagem v on (v.rota = r.id) ' .
            'inner join tbviagens_tarifas t on (t.id = v.tarifa) ';

        Log::debug(LogLevel::Info, "select: ".$select);

        $logQuery = mysqli_query($logConn, $select);
        if (!$logQuery) {
            Log::debug(LogLevel::Error, "mysqli_query - ".mysqli_error($logConn));
            header("location:login.html");
            // destroy a sessão
            session_destroy();
            return false;
        }

        $dataViagem = '';

        while($logDataset = mysqli_fetch_array($logQuery, MYSQLI_BOTH)){
            $newRow = array(  
                'id' => $logDataset["id"],
                'origemCidade' =>  utf8_encode($logDataset["origemCidade"]),
                'origemUF' =>  utf8_encode($logDataset["origemUF"]),
                'destinoCidade' =>  utf8_encode($logDataset["destinoCidade"]),
                'destinoUF' =>  utf8_encode($logDataset["destinoUF"]),
                'horariopartida' => $logDataset["horariopartida"],
                'meiapassagem' => $logDataset["meiapassagem"],
                'normal' => $logDataset["normal"],
                'pedagio' => $logDataset["pedagio"],
                'promocional' => $logDataset["promocional"],
                'seguro' => $logDataset["seguro"],
                'dataviagem' => $logDataset["dataviagem"]
            );
            
            array_push($viagensDisponiveis, $newRow);
            if($dataViagem == "" || $dataViagem != $logDataset["dataviagem"]){
                $dataViagem = $logDataset["dataviagem"];
                array_push($datasDisponiveis, $dataViagem);
            }

        }

        $result = true;
    } finally {
        if($logConn){
            mysqli_close($logConn);
        }
    }

    $data = [
        'result' => $result,
        'viagensDisponiveis' => $viagensDisponiveis,
        'datasDisponiveis' => $datasDisponiveis
    ];

    header('Content-Type: application/json');
    Log::debug(LogLevel::Info, ">>> ".json_encode($data));

    echo json_encode($data);
    Log::debug(LogLevel::Info, "--- out");
    return true;
?>
