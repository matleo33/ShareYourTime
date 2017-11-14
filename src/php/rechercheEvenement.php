<?php
try
{
    $bdd = new PDO('mysql:host=localhost;dbname=shareyourtime;charset=utf8', 'root', '');
}
catch (Exception $e)
{
    die('Erreur : ' . $e->getMessage());
}

$response = $bdd->query('SELECT id_events '
    . 'FROM events '
    . 'WHERE nom=\'' .$_POST['eventName'] . '\'');
if($response != 0)
{
    header("Location: evenement.php?id_events=" + $response['id_events']);
}

?>