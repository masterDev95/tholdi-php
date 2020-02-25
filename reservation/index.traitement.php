<?php
include_once '../_gestionBase.inc.php';

$dateAuj = date('Y-m-d');

session_start();

if (isset($_POST['dateDebutReservation'])) {
    $codeVilleMiseDispo = $_POST['codeVilleMiseDispo'];
    $codeVilleRendre = $_POST['codeVilleRendre'];
    $dateDebutReservation = $_POST['dateDebutReservation'];
    $dateFinReservation = $_POST['dateFinReservation'];
    $volumeEstime = intval($_POST['volumeEstime']);

    $eval1 = $dateDebutReservation < $dateAuj || $dateFinReservation < $dateAuj;
    $eval1 = $eval1 || $dateDebutReservation > $dateFinReservation;
    $eval2 = $codeVilleMiseDispo == $codeVilleRendre;

    if ($eval1 && $eval2) {
        header("location:index.php?erreurDate=1&erreurVille=1");
        exit;
    }

    if ($eval1) {
        header("location:index.php?erreurDate=1");
        exit;
    }

    if ($eval2) {
        header("location:index.php?erreurVille=1");
        exit;
    }
    
    $reservation = creerReservation($codeVilleMiseDispo, $codeVilleRendre, $dateDebutReservation,
                $dateFinReservation, $volumeEstime);

    $_SESSION['codeReservation'] = $reservation;

    header("location:../ligneReservation");
}

?>
