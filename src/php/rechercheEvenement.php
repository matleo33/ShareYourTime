<?php
session_start();
try
{
    $bdd = new PDO('mysql:host=localhost;dbname=shareyourtime;charset=utf8', 'root', '');
}
catch (Exception $e)
{
    die('Erreur : ' . $e->getMessage());
}

$reponse = $bdd->query('SELECT id_events '
    . 'FROM events '
    . 'WHERE nom=\'' .$_GET['eventName'] . '\'');

$_SESSION['nom_event'] = $_GET['eventName'];
while ($donnees = $reponse->fetch()) {
    $id_event = $donnees[0];
    echo $id_event;

    break;
}

?>