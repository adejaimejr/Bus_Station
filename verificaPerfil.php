<?php
    require 'session.php';
    require 'utils.php';

    Log::$phpFile = "index.php";
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
    $tbFilial = false;
    $tbUsuario = false;
    $tbPassageiro = false;
    $tbOnibus = false;
    $tbRotas = false;
    $tbMotorista = false;
    $tbTarifas = false;
    $tbPagamento = false;
    $tbPassagem = false;
    $tbDashboard = false;
    $tbTributacao = false;
    $tbRelatorios = false;
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

        $userId = getUserIdFromSession();
        $perfil = getSessionVar("perfil");

        $select = 'select tbFilial, tbUsuario, tbPassageiro, tbOnibus, tbRotas, tbMotorista, ' .
            ' tbTarifas, tbPagamento, tbPassagem, tbDashboard, tbTributacao, tbRelatorios ' .
            ' from tbUsuarios ' .
            ' inner join tbPerfil on (tbPerfil.id = tbUsuarios.perfil)' .
            ' where tbUsuarios.id="'.$userId.'"';
        $logQuery = mysqli_query($logConn, $select);
        if (!$logQuery) {
            Log::debug(LogLevel::Error, "mysqli_query - ".mysqli_error($logConn));
            header("location:login.html");
            // destroy a sessão
            session_destroy();
            return false;
        }

        $logDataset = mysqli_fetch_array($logQuery, MYSQLI_BOTH);
        $tbFilial = $logDataset["tbFilial"] == "1";
        $tbUsuario = $logDataset["tbUsuario"] == "1";
        $tbPassageiro = $logDataset["tbPassageiro"] == "1";
        $tbOnibus = $logDataset["tbOnibus"] == "1";
        $tbRotas = $logDataset["tbRotas"] == "1";
        $tbMotorista = $logDataset["tbMotorista"] == "1";
        $tbTarifas = $logDataset["tbTarifas"] == "1";
        $tbPagamento = $logDataset["tbPagamento"] == "1";
        $tbPassagem = $logDataset["tbPassagem"] == "1";
        $tbDashboard = $logDataset["tbDashboard"] == "1";
        $tbTributacao = $logDataset["tbTributacao"] == "1";
        $tbRelatorios = $logDataset["tbRelatorios"] == "1";

        $result = true;
    } finally {
        if($logConn){
            mysqli_close($logConn);
        }
    }

    $data = [
        'result' => $result,
        'filial' => $tbFilial,
        'usuario' => $tbUsuario,
        'passageiro' => $tbPassageiro,
        'onibus' => $tbOnibus,
        'rotas' => $tbRotas,
        'motorista' => $tbMotorista,
        'tarifas' => $tbTarifas,
        'pagamento' => $tbPagamento,
        'passagem' => $tbPassagem,
        'dashboard' => $tbDashboard,
        'tributacao' => $tbTributacao,
        'relatorios' => $tbRelatorios
    ];

    header('Content-Type: application/json');
    Log::debug(LogLevel::Info, ">>> ".json_encode($data));

    echo json_encode($data);
    Log::debug(LogLevel::Info, "--- out");
    return true;
?>
