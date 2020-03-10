<?php
function gestionnaireDeConnexion() {
    $pdo = null;
    try {
        $pdo = new PDO(
            'mysql:host=localhost;port=3308;dbname=tholdi', 'root', 'root', array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8")
        );
    } catch (PDOException $err) {
        $messageErreur = $err->getMessage();
        error_log($messageErreur, 0);
    }
    return $pdo;
}

// --LISTE DES VILLES
function listeVilles() {
    $lesVilles = array();
    $pdo = gestionnaireDeConnexion();
    
    if ($pdo != NULL)
    {
        $req = "select * from VILLE order by nomVille";
        $pdoStatement = $pdo->query($req);
        $lesVilles = $pdoStatement->fetchAll(PDO::FETCH_ASSOC);
    }
    
    return $lesVilles;
}

// --LISTE DES TYPES DE CONTAINER
function listeTypesContainer() {
    $lesTypesContainer = array();
    $pdo = gestionnaireDeConnexion();
    
    if ($pdo != NULL)
    {
        $req = "select * from TYPE_CONTAINER order by typeContainer";
        $pdoStatement = $pdo->query($req);
        $lesTypesContainer = $pdoStatement->fetchAll(PDO::FETCH_ASSOC);
    }
    
    return $lesTypesContainer;
}

// --LISTE DES RESERVATION
function listeReservation() {
    $lesReservation = array();
    $pdo = gestionnaireDeConnexion();

    if ($pdo != NULL) {
        $req = "SELECT *
                FROM RESERVATION
                ORDER BY codeReservation";
        $pdoStatement = $pdo->query($req);
        $lesReservation = $pdoStatement->fetchAll(PDO::FETCH_ASSOC);
    }

    return $lesReservation;
}

// --RECAPITULATIF DE LA RESERVATION
function recapitulatifReservation($codeReservation) {
    $recap = array();
    $pdo = gestionnaireDeConnexion();
    
    if ($pdo != NULL)
    {
        $req = "SELECT dateDebutReservation, dateFinReservation, codeVilleMiseDispo, codeVilleRendre, dateReservation, volumeEstime, typeContainer, qteReserver
        FROM RESERVER as R, RESERVATION as RE
        WHERE RE.codeReservation = $codeReservation
        AND R.codeReservation = $codeReservation";

        $pdoStatement = $pdo->query($req);
        $recap = $pdoStatement->fetchAll(PDO::FETCH_ASSOC);
    }
    
    return $recap;
}

// --RECUPERER LE NOM DE LA VILLE
function recupNomVille($codeVille) {
    $recup = array();
    $pdo = gestionnaireDeConnexion();

    if ($pdo != NULL) {
        $req = "SELECT nomVille
                FROM VILLE
                WHERE codeVille = $codeVille";

        $pdoStatement = $pdo->query($req);
        $recup = $pdoStatement->fetchAll(PDO::FETCH_ASSOC);
        $result = $recup[0]['nomVille'];
    }

    return $result;
}

// --RECUPERER LE NOM DU TYPE CONTAINER

function recupLibelleTypeContainer($typeContainer) {
    $recup = array();
    $pdo = gestionnaireDeConnexion();

    if ($pdo != NULL) {
        $req = "SELECT libelleTypeContainer 
                FROM TYPE_CONTAINER
                WHERE typeContainer = '$typeContainer'";

        $pdoStatement = $pdo->query($req);
        $recup = $pdoStatement->fetchAll(PDO::FETCH_ASSOC);
        $result = $recup[0]['libelleTypeContainer'];
    }

    return $result;
}

// --CREATION DE LA RESERVATION
function creerReservation($codeVilleMiseDispo, $codeVilleRendre, $dateDebutReservation,
                            $dateFinReservation, $volumeEstime) {
    $pdo = gestionnaireDeConnexion();

    if ($pdo != NULL)
    {
        $req = $pdo->prepare("INSERT INTO RESERVATION(codeVilleMiseDispo, codeVilleRendre, dateDebutReservation, dateFinReservation, volumeEstime, codeDevis, codeClient, dateReservation)
                              VALUES (?, ?, ?, ?, ?, 4, 5, CURDATE())");

        $req->execute(array($codeVilleMiseDispo, $codeVilleRendre, $dateDebutReservation, $dateFinReservation, $volumeEstime));

        $codeReservation = $pdo->lastInsertId();
        
        return $codeReservation;
    }
}

// --RESERVER
function reserver($codeReservation, $typeContainer, $qteReserver) {
    $pdo = gestionnaireDeConnexion();

    if ($pdo != NULL)
    {
        $req = $pdo->prepare("INSERT INTO RESERVER (codeReservation, typeContainer, qteReserver) "
                            . "VALUES (?, ?, ?)");

        $req->execute(array($codeReservation, $typeContainer, $qteReserver));
    }
}


// --TRADUCTION CODE TYPE CONTAINER --> LIBELLÉ
function getTypeContainerLabel($codeTypeContainer) {
    $pdo = gestionnaireDeConnexion();
    
    if ($pdo != NULL)
    {
        $req = "SELECT * FROM TYPECONTAINER ORDER BY typeContainer";
        $pdoStatement = $pdo->query($req);
        $lesTypesContainer = $pdoStatement->fetchAll(PDO::FETCH_ASSOC);
    }
    
    return $lesTypesContainer;
}

function verification($user, $mdp) {
    $compteExistant = false;
    $pdo = gestionnaireDeConnexion();

    if ($pdo != null) {
        $sql = "SELECT count(*) AS nb
                FROM PERSONNE
                WHERE login = :user AND mdp = :mdp";

        $prep = $pdo->prepare($sql);
        $prep->bindParam(':user', $user, PDO::PARAM_STR);
        $prep->bindParam(':mdp', $mdp, PDO::PARAM_STR);
        $prep->execute();

        $resultat = $prep->fetch();

        if ($resultat["nb"] == 1) {
            $compteExistant = true;
        }

        $prep->closeCursor();
    }

    return $compteExistant;
}

function jointure($valeur, $table, $selCol, $whereCol) {
    $resultat = array();
    $pdo = gestionnaireDeConnexion();

    if ($pdo != NULL) {
        $sql = "SELECT *
                FROM $table
                WHERE $whereCol = $valeur";
        $pdoStatement = $pdo->query($sql);
        $resultat = $pdoStatement->fetch(PDO::FETCH_ASSOC);
    }

    return $resultat;
}
?>