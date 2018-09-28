<?php

session_start();
try {
    $bdd = new PDO('mysql:host=localhost;dbname=shareyourtime;charset=utf8', 'jmcbordeaux_root', 'D0nald&Ch@uve');
} catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
}

function verificationConditions($bdd) {
    $donnees = $bdd->query('SELECT * FROM events INNER JOIN users on events.createur=users.id_users '
            . 'WHERE id_users=' . $_SESSION['ID_USER'] . ' AND events.id_events=' . $_POST['id_event']);
    while ($reponse = $donnees->fetch()) {
        return TRUE;
    }
    return FALSE;
}

if (verificationConditions($bdd)) {
    $query = 'UPDATE events SET est_fini=TRUE '
            . 'WHERE id_events=' . $_POST['id_event'];

    echo $query;
    $bdd->exec($query);
    header('Location: evenement.php?id_events=' . $_POST['id_event']);
    exit();
}