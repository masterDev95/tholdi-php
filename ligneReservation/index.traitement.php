<?php
include_once '../_gestionBase.inc.php';

session_start();

if (!empty($_SESSION["panier"])) {
    for ($i=0; $i < count($_SESSION["panier"]["id_article"]); $i++) { 
        reserver($_SESSION["codeReservation"], $_SESSION["panier"]["id_article"][$i], $_SESSION["panier"]["qte"][$i]);
    }

    header("location:../recapitulatif");
}

?>
