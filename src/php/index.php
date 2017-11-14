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
<?php include 'carousel.include.php'; ?>
<?php include 'top_3_evenement.include.php'; ?>
<?php include 'footer.include.php'; ?>
<?php
try
{
$bdd = new PDO('mysql:host=localhost;dbname=shareyourtime;charset=utf8', 'root', '');
}
catch (Exception $e)
{
    die('Erreur : ' . $e->getMessage());
}
$reponse = $bdd->query('SELECT * FROM users');
while ($donnees = $reponse->fetch())

{

?>
    <p>
    <strong>Prenom</strong> : <?php echo $donnees['prenom']; ?><br />
    <strong>Nom</strong> :  <?php echo $donnees['nom']; ?>
    </p>
<?php
}
$reponse->closeCursor(); // Termine le traitement de la requête
?>

<script src="../BootStrap/js/bootstrap.min.js"></script>
</body>


</html>