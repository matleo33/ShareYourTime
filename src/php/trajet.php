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
        try {
            $bdd = new PDO('mysql:host=localhost;dbname=shareyourtime;charset=utf8', 'root', '');
        } catch (Exception $e) {
            die('Erreur : ' . $e->getMessage());
        }
        if (isset($_GET['id_trajet'])) {
            $reponse = $bdd->query('SELECT * '
                    . 'FROM trajet INNER JOIN users on trajet.chauffeur = users.id_users '
                    . 'WHERE id_trajet = ' . $_GET['id_trajet']);
            while ($donnees = $reponse->fetch()) {
                echo "<div class=\"text-center col-sm-12\">";
                echo "<h1>" . $donnees['ville_depart'] . " - " . $donnees['ville_arrivee'] . "</h1>";
                ?>
        <div class="col-sm-3">
        </div>
        <div class="col-sm-6">
            <div class="col-sm-6">
                <img src="ba" alt="photo chauffeur" />
            </div>
            <div class="col-sm-6">
                <p><?php echo $donnees['prenom'] . ' ' .$donnees['nom'];?></p>
                <p><?php echo $donnees['num_telephone'];?></p>
                <p><?php echo $donnees['mail'];?></p>
                <p><?php
                                        for ($i = 0; $i < $donnees['personnalite']; ++$i) {
                                            echo '★';
                                        }
                                        for ($j = 0; $j < 10 - $donnees['personnalite']; ++$j) {
                                            echo '☆';
                                        }
                                        ?></p>
            </div>
        </div>
        <div class="col-sm-3">
        </div>
        <?php
                echo "</div>";
            }
        } else {
            echo "<div class=\"text-center\">";
            echo "<h2>Désolé, nous n'avons pas pu trouver le trajet en question, merci de vous rediriger "
            . "vers la page d'accueil.</h2>";
            echo "<a href=\"index.php\"><button>Cliquez ici</button></a>";
            echo "</div>";
        }
        ?>
        <?php include 'footer.include.php'; ?>
    </body>
</html>
<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

