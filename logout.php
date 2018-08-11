<?php
require 'session.php';
require 'utils.php';

// destroy a sessão
destroySession();

header("location:login.html");
?>