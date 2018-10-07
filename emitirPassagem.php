<?php
    require 'session.php';
    require 'utils.php';

    Log::$phpFile = "emitirPassagem.php";
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


    $result = false;
    $viagensDisponiveis = [];
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
                'seguro' => $logDataset["seguro"]
            );
            
            array_push($viagensDisponiveis, $newRow);              
        }

        $result = true;
    } finally {
        if($logConn){
            mysqli_close($logConn);
        }
    }

    $data = [
        'result' => $result,
        'viagensDisponiveis' => $viagensDisponiveis
    ];

    header('Content-Type: application/json');
    Log::debug(LogLevel::Info, ">>> ".json_encode($data));

    echo json_encode($data);
    Log::debug(LogLevel::Info, "--- out");
    return true;
?>
