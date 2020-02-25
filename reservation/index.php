<?php
include_once '../_gestionBase.inc.php';
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Reservation</title>
    </head>

    <body>
        <?php if (isset($_GET['erreurDate']) && isset($_GET['erreurVille'])): ?>
        <p>Veuillez entrer une date valide!</p>
        <p>La ville de départ ne peut pas être pareil que la ville d'arrivée</p><br>

        <?php elseif (isset($_GET['erreurDate'])): ?>
        <p>Veuillez entrer une date valide!</p><br>

        <?php elseif (isset($_GET['erreurVille'])): ?>
        <p>La ville de départ ne peut pas être pareil que la ville d'arrivée</p><br>
        <?php endif; ?>

        <form action="index.traitement.php" method="post">
            <label for="dateDebutReservation">Date de départ</label>
            <input type="date" name="dateDebutReservation" id="dateDebutReservation"><br>

            <label for="dateFinReservation">Date de fin</label>
            <input type="date" name="dateFinReservation" id="dateFinReservation"><br>

            <label for="volumeEstime">Volume estimé</label>
            <input type="number" name="volumeEstime" id="volumeEstime" pattern="[0-9]" min="0" max="9999"><br>

            <label for="codeVilleMiseDispo">Ville de départ</label>
            <select name="codeVilleMiseDispo" id="codeVilleMiseDispo">
                <?php
                $listeVilles = listeVilles();
                foreach ($listeVilles as $ville):
                ?>

                <option value="<?php echo $ville['codeVille'] ?>">
                    <?php echo $ville['nomVille'] ?>
                </option>

                <?php endforeach; ?>
            </select><br>
            
            <label for="codeVilleRendre">Ville d'arrivé </label>
            <select name="codeVilleRendre" id="codeVilleRendre">
                <?php
                    $listeVilles = listeVilles();
                    foreach ($listeVilles as $ville):
                ?>
                <option value="<?php echo $ville['codeVille'] ?>"><?php echo $ville['nomVille'] ?></option>
                <?php endforeach; ?>
            </select><br>

            <input type="submit" value="Valider">
        </form>
    </body>
</html>
