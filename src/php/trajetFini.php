<?php

session_start();

function checkUserIsDriver($bdd) {
    $query = 'SELECT * FROM trajet WHERE id_trajet=' . $_POST['id_trajet'];
    echo $query;
    $reponse = $bdd->query($query);
    while ($donnees = $reponse->fetch()) {
        if ($_SESSION['ID_USER'] == $donnees['chauffeur']) {
            return TRUE;
        } return false;
    }
}

try {
    $bdd = new PDO('mysql:host=localhost;dbname=shareyourtime;charset=utf8', 'root', '');
} catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
}
$query = 'UPDATE trajet '
        . 'SET est_fini=TRUE '
        . 'WHERE id_trajet=' . $_POST['id_trajet'];
echo $query;
if (checkUserIsDriver($bdd)) {
    $bdd->exec($query);
}
header('Location: mes_trajets.php');
exit();
