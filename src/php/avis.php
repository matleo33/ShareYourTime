<?php session_start(); ?>
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
        <script src="../BootStrap/js/bootstrap.min.js"></script>

        <title>Share Your Time</title>
    </head>
    <body>
        <?php include 'navbar.include.php'; ?>
        <?php include 'modal_connexion.include.php' ?>
        <?php include 'modal_inscription.include.php' ?>
        <?php
        if (isset($_SESSION['ID_USER'])) {
            if (isset($_GET['id_trajet'])) {
                ?>
                <div class="container-fluid col-sm-8 col-sm-offset-2">
                    <h1>Avis</h1>
                    <?php
                    try {
                        $bdd = new PDO('mysql:host=localhost;dbname=shareyourtime;charset=utf8', 'root', '');
                    } catch (Exception $e) {
                        die('Erreur : ' . $e->getMessage());
                    }
                    $reponse = $bdd->query('SELECT * '
                            . 'FROM covoiturage INNER JOIN users on covoiturage.users=users.id_users '
                            . 'WHERE trajet = ' . $_GET['id_trajet']);
                    while ($donnees = $reponse->fetch()) {
                        ?>
                        <div class="voyageurAvis">
                            <img src="../img/imageProfil.png" alt="imageProfil" />
                            NOTE
                            <input type="textarea" />
                            <button>Signaler</button>
                        </div>
                    </div>
                    <?php
                }
            } else {
                echo "<p>Désolé, le trajet que vous recherchez n'existe pas</p>";
                echo "<p><a href='index.php'>Cliquez-ici</a> pour revenir à la page d'accueil</p>";
            }
        } else {
            echo 'Désolé vous ne pouvez pas emettre d\'avis si vous n\'êtes pas connecté.';
        }
        ?> 
    </body>
</html>