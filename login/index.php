<?php session_start(); ?>

<!DOCTYPE html>
<html>
    <head>
        <title>Wesh logue toi</title>
        <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    </head>

    <body>
        <?php if (!isset($_SESSION["user"])): ?>

        <form action="index.traitement.php" method="post">
            <input type="text" name="user" id="user">
            <input type="password" name="mdp" id="mdp">
            <input type="submit" value="Valider">
        </form>

        <?php else: ?>

        <p><?php echo $_SESSION["user"] ?></p>
        <p><a href="index.traitement.php?logout=1">DECONNEXION</a></p>

        <?php endif; ?>
    </body>
</html>