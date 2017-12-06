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
        <script src="../js/editer.js"></script>

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
            $reponse = $bdd->query('SELECT *, COUNT(trajet.id_trajet) '
                    . 'FROM users INNER JOIN trajet ON trajet.chauffeur = users.id_users '
                    . 'WHERE users.id_users=' . $_GET['id_profil']);
            $reponse2 = $bdd->query('SELECT COUNT(*) '
                    . 'FROM users INNER JOIN events ON users.id_users = events.createur '
                    . 'WHERE events.createur=' . $_GET['id_profil']);
            while ($donnees = $reponse->fetch()) {
                ?>

                <!-- Photo de profil -->    
                <div class="col-sm-4">
                    <img class="photoProfil" src="../img/imageProfil2.PNG" alt="photoProfil" />
                    <?php
                    if (isset($_SESSION['ID_USER']) && ($_SESSION['ID_USER'] == $donnees['id_users'])) {
                        echo '<form>';
                        echo '<input type="file"></input>';
                        echo '<button>Enregistrer</button>';
                        echo '</form>';
                    }
                    ?>
                </div>
                <!-- Informations -->    
                <div class="col-sm-4">
                    <h1><?php echo $donnees['nom'] . ' ' . $donnees['prenom'] ?></h1>
                    <p>Mail : <?php echo $donnees['mail']; ?></p>
                    <p>Tel : <?php echo $donnees['num_telephone']; ?></p>
                    <p>Nombre de trajets en tant que conducteur : <?php echo $donnees['COUNT(trajet.id_trajet)'] ?></p>
                    <p>Nombre d'événements organisés : <?php
                        while ($donnees2 = $reponse2->fetch()) {
                            echo $donnees2['COUNT(*)'];
                        }
                        ?></p>
                    <p><?php
                        echo 'Note : ';
                        for ($i = 0; $i < $donnees['personnalite']; ++$i) {
                            echo '★';
                        }
                        for ($j = 0; $j < 10 - $donnees['personnalite']; ++$j) {
                            echo '☆';
                        }
                        ?></p>
                    <?php
                    echo "Description : ";
                    if (isset($_SESSION['ID_USER']) && ($_SESSION['ID_USER'] == $donnees['id_users'])) {
                        echo '<p id="description">' . $donnees['description'] . '</p>';
                        echo '<p onclick="editer()">Editer<p>';
                    } else {
                        echo '<p>' . $donnees['description'] . '</p>';
                    }
                    ?>
                </div>
                <!-- Caractéristiques trajets -->    
                <div class="col-sm-4">
                    <h1>Caractéristiques trajets</h1>
                    <div class="col-sm-6 col-sm-offset-6 col-sm-pull-6 text-center">
                        <span style="float : left;">Désagréable</span>
                        <span>Neutre</span>
                        <span style="float : right;">Agréable</span>
                    </div>
                    <div class="scrollbar col-sm-6 col-sm-offset-6 col-sm-pull-6">
                        <div style="width: <?php echo $donnees['personnalite'] * 10 ?>%; height:23px; background-color: 
                        <?php
                        if ($donnees['personnalite'] * 10 < 25) {
                            echo "red";
                        } else if ($donnees['personnalite'] * 10 < 50) {
                            echo "orange";
                        } else if ($donnees['personnalite'] * 10 < 75) {
                            echo "yellow";
                        } else {
                            echo "green";
                        }
                        ?>">

                        </div>
                    </div>
                    <p>Animaux autorisés : 
                        <?php
                        if ($donnees['animaux'] == TRUE) {
                            echo "Oui";
                        } else {
                            echo "Non";
                        }
                        ?>
                    </p>
                    <p>Fumeurs autorisés : 
                        <?php
                        if ($donnees['fumeur'] == TRUE) {
                            echo "Oui";
                        } else {
                            echo "Non";
                        }
                        ?>
                    </p>
                    <p>Musique autorisée :
                        <?php
                        if ($donnees['musique'] == TRUE) {
                            echo "Oui";
                        } else {
                            echo "Non";
                        }
                        ?>
                    </p>
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

