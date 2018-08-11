<?php
require 'utils.php';
require 'session.php';

Log::$phpFile = "login.php";
Log::$logLevel = LogLevel::Info;

Log::debug(LogLevel::Info, "--- loading config.ini");

$config = parse_ini_file("config.ini", true);

Log::debug(LogLevel::Info, "--- loading params");
    
// Configuracao da base
$dbLogConnectionConfig = $config["DBLogConnectionConfig"];    
$dbLogServer = $dbLogConnectionConfig["DBServer"];
$dbLogUser = $dbLogConnectionConfig["DBUser"];
$dbLogPassword = $dbLogConnectionConfig["DBPassword"];
$dbLogDatabase = $dbLogConnectionConfig["DBDatabase"];   

$usuario = $_POST["usuario"];
$senha = $_POST["senha"];

// General Config
$generalCfg = $config["GeneralConfig"];
if($generalCfg != ''){
    Log::$logLevel = $generalCfg["logLevel"]; 
}

// cria a sessão
createSession();

$result = false;
$serverMsg = '';

$conn = null;

try {
    Log::debug(LogLevel::Info, "--- mysql connecting");

    $conn = mysqli_connect($dbLogServer, $dbLogUser, $dbLogPassword, $dbLogDatabase);
    if (mysqli_connect_errno()) {
        Log::debug(LogLevel::Error, "MySQL Connect Log failed: ".mysqli_connect_error());
        header("location:login.html");
        return false;
    }      
    
    mysqli_set_charset($conn,"utf8");
    mysqli_autocommit($conn, TRUE);

    try {
        $select = 'select senha, id, perfil from tbusuarios where login="'.$usuario.'"';
        $logQuery = mysqli_query($conn, $select);
        if (!$logQuery) {
            Log::debug(LogLevel::Error, "mysqli_query - ".mysqli_error($conn));
            header("location:login.html");
            // destroy a sessão
            session_destroy();        
            return false;
        }        
        
        $num_rows = mysqli_num_rows($logQuery);
        if($num_rows > 0){
            $logDataset = mysqli_fetch_array($logQuery, MYSQLI_BOTH);
            $hash = $logDataset["senha"];
            /*if(validate_pw($password, $hash)){ // todo: habilitar para criptografar*/
            if($senha == $hash){
                // grava na sessão*/
                setSession($logDataset["id"]);
                setSessionVar("perfil", $logDataset["perfil"]);
                header("location:index.html");
                $result = true;
            } else {
                header("location:login.html");
            }        
        } else {
            header("location:login.html");
        }        
    } catch(Exception $e) {
        // destroy a sessão
        session_destroy();    
        header("location:login.html");
        return false;
    }   
} finally {
    if($conn){
        mysqli_close($conn);
    }

    if(!$result){
        // destroy a sessão
        session_destroy();        
    }    
} 

?>