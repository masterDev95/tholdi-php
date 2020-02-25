<?php
include_once "../_gestionBase.inc.php";

session_start();

$recap = recapitulatifReservation($_SESSION["codeReservation"]);

$dateDebutReserv = $recap[0]['dateDebutReservation'];
$dateDebutReserv = date("d/m/Y", strtotime($dateDebutReserv));
$dateFinReserv = $recap[0]['dateFinReservation'];
$dateFinReserv = date("d/m/Y", strtotime($dateFinReserv));

$villeDepart = recupNomVille($recap[0]['codeVilleMiseDispo']);
$villeArrive = recupNomVille($recap[0]['codeVilleRendre']);

$volumeEstime = $recap[0]['volumeEstime'];

?>

<!DOCTYPE html>
<html>
    <head>
        <title>Recapitulatif</title>
        <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    </head>

    <body>
        <p>Date de début de réservation: <?php echo $dateDebutReserv ?> </p>
        <p>Date de fin de réservation: <?php echo $dateFinReserv ?> </p>
        <p>Nom de la ville de départ: <?php echo $villeDepart ?> </p>
        <p>Nom de la ville d'arrivée: <?php echo $villeArrive ?> </p>
        <p>Volume estimé: <?php echo $volumeEstime ?> </p>
        <p>Types de container: </p>
        <ul>
            <?php foreach ($recap as $reservation): ?>
            <?php $libelleTypeContainer = recupLibelleTypeContainer($reservation['typeContainer']) ?>
            <li> <?php echo $libelleTypeContainer . ": " . $reservation['qteReserver'] ?> </li>
            <?php endforeach; ?>
        </ul>
        
    </body>
</html>