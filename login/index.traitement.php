<?php
session_start();
include_once '../_gestionBase.inc.php';

if (isset($_REQUEST["logout"])) {
    session_unset();
}

if (isset($_REQUEST["user"]) && isset($_REQUEST["mdp"])) {
    $resultat = verification($_REQUEST["user"], $_REQUEST["mdp"]);
    

    if ($resultat == true) {
        $_SESSION["user"] = $_REQUEST["user"];
    }
}

 header("location: ./");

?>
