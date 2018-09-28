<?php

session_start();


// Cette fonction sert à vérifier si l'utilisateur est le conducteur du trajet ou non.
// En effet, seul le chauffeur peut dire si  un trajet est fini ou non
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
    $bdd = new PDO('mysql:host=localhost;dbname=shareyourtime;charset=utf8', 'jmcbordeaux_root', 'D0nald&Ch@uve');
} catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
}
// La requête va permettre de modifier l'état du trajet
$query = 'UPDATE trajet '
        . 'SET est_fini=TRUE '
        . 'WHERE id_trajet=' . $_POST['id_trajet'];
if (checkUserIsDriver($bdd)) {
    $bdd->exec($query);
}
header('Location: mes_trajets.php');
exit();
