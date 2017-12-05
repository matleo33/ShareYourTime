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
            $reponse = $bdd->query('SELECT *, COUNT(*) '
                    . 'FROM trajet INNER JOIN users on trajet.chauffeur = users.id_users INNER JOIN etape on trajet.id_trajet = etape.trajet '
                    . 'WHERE id_trajet = ' . $_GET['id_trajet'])
            ;
            ' GROUP BY trajet.id_trajet';
            while ($donnees = $reponse->fetch()) {
                echo "<div class=\"nomTrajet\">";
                echo "<div class=\"text-center col-sm-12\">";
                echo "<h1>" . $donnees['ville_depart'] . " - " . $donnees['ville_arrivee'] . ' ' . $donnees['prix_tot'] . " €</h1>";
                echo "</div>";
                echo "</div>";
                ?>
                <div class="infosTrajet">
                    <div class="col-sm-2">
                    </div>
                    <div class="col-sm-8 text-center">
                        <div class="col-sm-6">
                            <img src="ba" alt="photo chauffeur" />
                        </div>
                        <div class="col-sm-6">
                            <p><?php echo $donnees['prenom'] . ' ' . $donnees['nom']; ?></p>
                            <p><?php echo $donnees['num_telephone']; ?></p>
                            <p><?php echo $donnees['mail']; ?></p>
                            <p><?php
                                for ($i = 0; $i < $donnees['personnalite']; ++$i) {
                                    echo '★';
                                }
                                for ($j = 0; $j < 10 - $donnees['personnalite']; ++$j) {
                                    echo '☆';
                                }
                                ?></p>
                        </div>
                        <div class="col-sm-6">
                            <div class="col-sm-12">
                                <div class="col-sm-4 aroundedText">
                                    Ville de départ
                                </div>
                                <div class="col-sm-8">
                                    <p>Lieu de rdv</p>
                                    <p>Heure de rdv</p>
                                </div>
                            </div>
                            <?php for ($i = 0; $i < $donnees['COUNT(*)']; ++$i) { ?>
                                <div class="col-sm-12">
                                    <div class="col-sm-4 aroundedText">
                                        Ville etape
                                    </div>
                                    <div class="col-sm-8">
                                        <p>Lieu de rdv</p>
                                        <p>Heure de rdv</p>
                                    </div>
                                </div>
                            <?php } ?>
                            <div class="col-sm-12">
                                <div class="col-sm-4 aroundedText">
                                    Ville d'arrivée
                                </div>
                                <div class="col-sm-8">
                                    <p>Lieu de rdv</p>
                                    <p>Heure d'arrivée</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6" style="height: inherit; border: black solid 1px;">
                            <p>Retard toléré : <?php echo $donnees['retard']; ?> minutes</p>
                            <p>Pensez à me contacter pour plus d'informations !</p>
                        </div>
                    </div>
                    <div class="col-sm-2">
                    </div>
                    <div class="col-sm-12">
                        <div class="col-sm-2">
                            Autoroute
                        </div>
                        <div class="col-sm-4">
                            Il reste <?php echo $donnees['nb_place']; ?> place<?php if ($donnees['nb_place'] > 1) echo 's'; ?>
                        </div>
                        <div class="col-sm-5">
                            <input type="number" min="0" max="<?php echo $donnees['nb_place']; ?>" style="width: 50px;" />
                            <button>Je reserve</button>
                        </div>
                        <div class="col-sm-1">
                            <button>Signaler</button>
                        </div>
                    </div>
                </div>
                <?php
            }
        } else {
            echo "<div class=\"text-center nomTrajet\">";
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

