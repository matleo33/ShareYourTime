<?php
session_start();

function verificationChamps() {
    //isset + bons types
    if ((isset($_POST['emetteur']) && isset($_POST['cible']) && isset($_POST['star-1'])) != TRUE) {
        echo 'pas set';
        return FALSE;
    }
    if (($_POST['idTrajet']) <= 0 || $_POST['idReservant'] <= 0 || $_POST['nombrePlacesReservees'] < 0) {
        echo "pas sup 0";
        return FALSE;
    }
    return TRUE;
}

function verificationConditions($bdd) {
    // les deux sont sur un trajet
    if (GetPlacesRestantesTrajet($bdd, $_POST['idTrajet']) < $_POST['nombrePlacesReservees']) {
        echo 'Trop de places réservées';
        return FALSE;
    }
    return TRUE;
}

function verificationAvisPrealable($bdd) {
    $query = 'SELECT * FROM avis WHERE emetteur=' . $_POST['emetteur'] . ' AND recepteur=' . $_POST['recepteur'] . ' AND description=\'' . $_POST['description'] .'\'';
    echo $query;
    $donnees = $bdd->query($query);
    while ($reponse = $donnees->fetch()) {
        return TRUE;
    }
    return FALSE;
}

function getNbPlacesRes($bdd,$trajet,$user) {
    $reponse = $bdd->query('SELECT * FROM covoiturage WHERE trajet=' . $_POST['idTrajet'] . ' AND users=' . $_POST['idReservant']);
    while ($donnees = $reponse->fetch()) {
        return $donnees['nb_place_res'];
    }
}

function defineNote() {
    if (isset($_POST['star-5'])) {
        return 10;
    }
    if (isset($_POST['star-4'])) {
        return 8;
    }
    if (isset($_POST['star-3'])) {
        return 6;
    }
    if (isset($_POST['star-2'])) {
        return 4;
    }
    if (isset($_POST['star-1'])) {
        return 2;
    } else {
        return 0;
    }
}

try {
    $bdd = new PDO('mysql:host=localhost;dbname=shareyourtime;charset=utf8', 'root', 'D0nald&Ch@uve');
} catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
}
//if (verificationChamps() && verificationConditions($bdd)) {
    $note = defineNote();
    if (!verificationAvisPrealable($bdd)) {
        $query = 'INSERT INTO avis(emetteur, recepteur, note, description) '
                . 'VALUES(' . $_POST['emetteur'] . ', ' . $_POST['recepteur'] . ', ' . $note . ', \'' . $_POST['description'].'\')';
    }
   /* } else {
        $placesAreserver = getNbPlacesRes($bdd,$_POST['idTrajet'],$_POST['idReservant']) + $_POST['nombrePlacesReservees'];
        $query = 'UPDATE covoiturage SET nb_place_res = ' . $placesAreserver
                . ' WHERE trajet=' . $_POST['idTrajet'] . ' AND users=' . $_POST['idReservant'];
    }*/
    echo $query;
    $bdd->exec($query);
    header('Location: index.php');
    exit();
//}