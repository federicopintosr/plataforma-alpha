<?php

ini_set("session.cookie_lifetime", "3600");
ini_set("session.gc_maxlifetime", "3600");
if (!isset($_SESSION)) {
    session_start();
}

if (!isset($_SESSION['username'])) {
    echo "<h1>Regístrese</h1>" .
    "<br><a  href='../index.php'>Volver </a>".
    //header("Location: ".$_SERVER['HTTP_REFERER']);
    exit();
}
$inactivo = 3600;

if (isset($_SESSION['tiempo'])) {
    $vida_session = time() - $_SESSION['tiempo'];
    if ($vida_session > $inactivo) {
        session_destroy();
        header("Location: ../index.php");
    }
}

$_SESSION['tiempo'] = time();

