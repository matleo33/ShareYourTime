<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <link href="./../css/style.css" rel="stylesheet">

    <!-- Bootstrap-->
    <link rel="stylesheet" href="./../BootStrap/css/bootstrap.min.css">


    <title>Share Your Time</title>
</head>

<body>
<?php include 'navbar.include.php'; ?><br/>
<?php include 'carousel.include.php'; ?>
<?php include 'top_3_evenement.include.php'; ?>
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
<a rel="license" href="http://creativecommons.org/licenses/by-nc-nd/3.0/fr/"><img alt="Licence Creative Commons" style="border-width:0" src="https://i.creativecommons.org/l/by-nc-nd/3.0/fr/88x31.png" /></a><br />Ce(tte) œuvre est mise à disposition selon les termes de la <a rel="license" href="http://creativecommons.org/licenses/by-nc-nd/3.0/fr/">Licence Creative Commons Attribution - Pas d’Utilisation Commerciale - Pas de Modification 3.0 France</a>.
</body>



</html>