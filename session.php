<?php

function createSession(){
    $timeout = 20 * 60; // 20 minutos

    session_start([
        'cookie_lifetime' => $timeout //,
        //'read_and_close'  => true // apenas se não for alterar a sessão
    ]);

    $_SESSION['last_action'] = time();
    return true;
}

function destroySession(){
    session_start();
    session_destroy();
    unset($_SESSION);
}

//Redireciona timeout sessao
function raiseExpirationSession(){
    $sapi_type = php_sapi_name();
    if (substr($sapi_type, 0, 3) == 'cgi')
        header("Status: 302 Authentication timeout");
    else
        header("HTTP/1.1 302 Authentication timeout");
    return false;
/*
    $data = [
        'result' => false,
        'serverMsg' => 'Sessão expirada. Por favor, realize o login novamente.'
    ];

    header('Content-Type: application/json');
    echo json_encode($data);
    return false;*/
}

function setSession($userId){
    $_SESSION['connected'] = 'true';
    $_SESSION['userid'] = $userId;
}

function setSessionVar($name, $value){
    $_SESSION[$name] = $value;
}

function getSessionVar($name){
    return $_SESSION[$name];
}

function getUserIdFromSession(){
    return $_SESSION['userid'];
}

function isSessionOK(){
    //Start our session.
    session_start();

    if(!isset($_SESSION['connected']) || $_SESSION['connected'] != 'true'){
        session_unset();
        session_destroy();
        raiseExpirationSession();
        return false;
    }

    //Expire the session if user is inactive for 30
    //minutes or more.
    $expireAfter = 20 * 60; // 20 minutos

    //Check to see if our "last action" session
    //variable has been set.
    if(isset($_SESSION['last_action'])){

        //Figure out how many seconds have passed
        //since the user was last active.
        $secondsInactive = time() - $_SESSION['last_action'];

        //Convert our minutes into seconds.
        $expireAfterSeconds = $expireAfter;

        //Check to see if they have been inactive for too long.
        if($secondsInactive >= $expireAfterSeconds){
            //User has been inactive for too long.
            //Kill their session.
            session_unset();
            session_destroy();
            raiseExpirationSession();
            return false;
        }

    }

    //Assign the current timestamp as the user's
    //latest activity
    $_SESSION['last_action'] = time();
    return true;
}
?>
