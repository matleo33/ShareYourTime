<?php

include 'getPlacesRestantesTrajet.php';
session_start();

function verificationChamps() {
    //isset + bons types
    if ((isset($_POST['idTrajet']) && isset($_POST['idReservant']) && isset($_POST['nombrePlacesReservees'])) != TRUE) {
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
    //nb places reservees <= nbplacesdispo
    if (GetPlacesRestantesTrajet($bdd, $_POST['idTrajet']) < $_POST['nombrePlacesReservees']) {
        echo 'Trop de places réservées';
        return FALSE;
    }
    return TRUE;
}

function verificationReservationPrealable($bdd) {
    $donnees = $bdd->query('SELECT * FROM covoiturage WHERE trajet=' . $_POST['idTrajet'] . ' AND users=' . $_POST['idReservant']);
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

try {
    $bdd = new PDO('mysql:host=localhost;dbname=shareyourtime;charset=utf8', 'root', '');
} catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
}
if (verificationChamps() && verificationConditions($bdd)) {
    if (!verificationReservationPrealable($bdd)) {
        $query = 'INSERT INTO covoiturage(trajet, users, nb_place_res) '
                . 'VALUES( \'' . $_POST['idTrajet'] . '\', \'' . $_POST['idReservant'] . '\', \'' . $_POST['nombrePlacesReservees'] . '\')';
    } else {
        $placesAreserver = getNbPlacesRes($bdd,$_POST['idTrajet'],$_POST['idReservant']) + $_POST['nombrePlacesReservees'];
        $query = 'UPDATE covoiturage SET nb_place_res = ' . $placesAreserver
                . ' WHERE trajet=' . $_POST['idTrajet'] . ' AND users=' . $_POST['idReservant'];
    }
    echo $query;
    $bdd->exec($query);
    header('Location: ' . $_POST['location']);
    exit();
}