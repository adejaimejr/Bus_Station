<?php
    require 'session.php';
    require 'utils.php';

    Log::$phpFile = "getMunicipios.php";
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
    $municipios = [];
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
            'id,  ' .
            'cidade,  ' .
            'uf, ' .
            'municipioIBGE ' .
            'from location ' . 
            'order by cidade';

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
                'cidade' =>  utf8_encode($logDataset["cidade"]),
                'uf' =>  utf8_encode($logDataset["uf"]),
                'municipioIBGE' =>  $logDataset["municipioIBGE"]
            );
            
            array_push($municipios, $newRow);
        }

        $result = true;
    } finally {
        if($logConn){
            mysqli_close($logConn);
        }
    }

    $data = [
        'result' => $result,
        'municipios' => $municipios
    ];

    header('Content-Type: application/json');
    Log::debug(LogLevel::Info, ">>> ".json_encode($data));

    echo json_encode($data);
    Log::debug(LogLevel::Info, "--- out");
    return true;
?>
