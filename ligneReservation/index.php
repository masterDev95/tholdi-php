<?php
include_once "../_gestionBase.inc.php";

session_start();

if (!isset($_SESSION["panier"])) {
    $_SESSION["panier"] = array();
    $_SESSION['panier']['id_article'] = array();
    $_SESSION['panier']['qte'] = array();
}

?>

<!DOCTYPE html>
<html>
    <head>
        <title>Ligne de reservation</title>
        <link rel="stylesheet" href="../css/style.css">
        <meta charset="utf-8">
    </head>

    <body>
        <form action="ajouter.traitement.php" method="post">
            <label for="typeContainer">Type de container </label>
            <select name="typeContainer" id="typeContainer">
                <?php
                    $listeTypesContainer = listeTypesContainer();
                    foreach ($listeTypesContainer as $typesContainer):
                ?>

                <option value="<?php echo $typesContainer['typeContainer'] ?>"><?php echo $typesContainer['libelleTypeContainer'] ?></option>
                <?php endforeach; ?>

            </select><br>

            <label for="qteReserver">Quantité </label>
            <input type="number" name="qteReserver" id="qteReserver" pattern="[0-9]">

            <input type="submit" value="Ajouter">
        </form>

        <a href="index.traitement.php">Valider</a>

        <p>
        <?php
            var_dump($_SESSION["panier"]);
        ?>
        </p>

        <div id="panier">
            <ul>
                <li><span class="panier-article">lol:</span> <span class="panier-quantite">1</span></li>
            </ul>
        </div>

    </body>
</html>