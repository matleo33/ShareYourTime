<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <link href="./../css/style.css" rel="stylesheet">

    <!-- Bootstrap-->
    <link rel="stylesheet" href="./../BootStrap/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="../js/recherche.js"></script>

    <title>Share Your Time</title>
</head>

<body>
<?php include 'navbar.include.php'; ?><br/>
<?php include 'modal_connexion.include.php' ?>
<?php include 'modal_inscription.include.php' ?>
<?php
$id_event = $_GET['id_events'];
try {
    $bdd = new PDO('mysql:host=localhost;dbname=shareyourtime;charset=utf8', 'root', '');
} catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
}
$reponse = $bdd->query('SELECT * '
            . 'FROM events '
            . 'WHERE id_events = ' . $id_event);
    while ($donnees = $reponse->fetch()) {
        ?>
<h1><?php echo $donnees['nom'];?></h1>
<div>Description : <?php echo $donnees['description'];?></div>
<div>Adresse : <?php echo $donnees['adresse'];?></div>
        <?php
    }
    $reponse->closeCursor(); // Termine le traitement de la requête
?>