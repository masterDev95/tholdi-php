<?php
include_once '../_gestionBase.inc.php';

session_start();

if (isset($_POST['typeContainer'])) {
    $typeContainer = $_POST['typeContainer'];
    $qteReserver = intval($_POST['qteReserver']);

    $id_article = array_search($typeContainer, $_SESSION['panier']['id_article']);
    
    if ($id_article !== false) { 
        $_SESSION['panier']['qte'][$id_article] += $qteReserver;
    } else {
        array_push($_SESSION['panier']['id_article'], $typeContainer);
        array_push($_SESSION['panier']['qte'], $qteReserver);        
    }

    header("location:../ligneReservation");
}

?>
