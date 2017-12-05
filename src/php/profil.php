<?php session_start() ?>
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
        <?php
        if (isset($_GET['id_profil'])) {
            try {
                $bdd = new PDO('mysql:host=localhost;dbname=shareyourtime;charset=utf8', 'root', '');
            } catch (Exception $e) {
                die('Erreur : ' . $e->getMessage());
            }
            $reponse = $bdd->query('SELECT *, COUNT(*) '
                    . 'FROM users INNER JOIN trajet on trajet.chauffeur = users.id_users '
                    . 'WHERE users.id_users=' . $_GET['id_profil']);
            while ($donnees = $reponse->fetch()) {
                ?>

                <!-- Photo de profil -->    
                <div class="col-sm-4">
                    <img src="../img/imageProfil.png" alt="photoProfil" />
                </div>
                <!-- Informations -->    
                <div class="col-sm-4">
                    <h1>Nom Prénom</h1>
                    <p>Mail : <?php echo $donnees['mail'] ;?></p>
                    <p>Tel : <?php echo $donnees['num_telephone'] ;?></p>
                    <p>Nombre de trajets en tant que conducteur : <?php echo $donnees['COUNT(*)'] ?></p>
                    <p>Nombre de trajets en tant que passager : </p>
                    <p>Nombre d'événements organisés : </p>
                    <p>Note sous forme d'étoiles</p>
                    <p>Description modifiable</p>
                </div>
                <!-- Caractéristiques trajets -->    
                <div class="col-sm-4">
                    <h1>Caractéristiques trajets</h1>
                    <p>Scrollbar entre timide et bavard</p>
                    <p>Animaux autorisés : décision</p>
                    <p>Fumeurs autorisés : décision</p>
                    <p>Musique autorisée : décision</p>
                    <h1>Derniers Avis</h1>
                    <img src="" alt="photo utilisateur" />
                    <p>Note sous forme d'étoiles</p>
                    <p>Commentaires</p>
                    <img src="" alt="photo utilisateur" />
                    <p>Note sous forme d'étoiles</p>
                    <p>Commentaires</p>
                </div>

                <?php
            }
        } else {
            ?>
            <h1 class="text-center">Profil non-trouvé, veuillez-vous rendre sur la page d'accueil en cliquant <a href='index.php'>ici</a>.</h1>
            <?php
        }
        ?>

        <?php include 'footer.include.php'; ?>

        <script src="../BootStrap/js/bootstrap.min.js"></script>
    </body>


</html>

<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

