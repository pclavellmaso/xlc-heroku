<?php

//include("model/bd.php");
include("model/debug.php");

session_start();


if (isset($_GET['accio'])) {
    $accio = $_GET['accio'];
} else if (isset($_POST['accio'])) {
    $accio = $_POST['accio'];
} else {
    $accio = null;
}


switch ($accio) {


    default:
        include('vista/inici.php');
        break;
}
?>