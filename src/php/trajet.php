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
        <script src="../js/connexion.js"></script>
        <script src="../BootStrap/js/bootstrap.min.js"></script>

        <title>Share Your Time</title>
    </head>

    <body>
    <div class="container-fluid">
        <?php include 'navbar.include.php'; ?>
        <?php include 'modal_connexion.include.php' ?>
        <?php include 'modal_inscription.include.php' ?>
        <?php include 'modal_signalement.include.php' ?>
        <?php
        include 'getPlacesRestantesTrajet.php';
        include 'getNote.php';
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
                if ($donnees['id_users'] != NULL) {
                    $note = 5;
                    $hasNote = getHasNote($bdd, $donnees['id_users']);
                    if ($hasNote) {
                        $note = getNote($bdd, $donnees['id_users']);
                    }
                    $placesRestantes = GetPlacesRestantesTrajet($bdd, $_GET['id_trajet']);
                    ?>
                    <div class="col-sm-8 col-sm-offset-2 trajet" style="color : white">
                        <div class="nomTrajet">
                            <div class="text-center col-sm-12">
                                <?php
                                echo "<h1>" . $donnees['ville_depart'] . " - " . $donnees['ville_arrivee'] . ' ' . $donnees['prix_tot'] . " €</h1>";
                                ?>
                            </div>
                        </div>
                        <div class="infosTrajet">
                            <div class="col-sm-12 text-center">
                                <div class="col-sm-3 col-sm-offset-3">
                                    <?php if ($donnees['lien_photo'] == NULL) { ?>
                                        <img class="photoProfilTrajet" src="../img/imageProfil2.PNG" alt="photoProfil" />
                                        <?php
                                    } else {
                                        ?> 
                                        <img class="photoProfilTrajet" src="../../images/<?php echo $donnees['lien_photo'] ?>" alt="photoProfil" />
                                        <?php
                                    }
                                    ?>
                                </div>
                                <div class = "col-sm-3">
                                    <p><?php echo $donnees['prenom'] . ' ' . $donnees['nom'];
                        ?></p>
                                    <p><?php echo $donnees['num_telephone']; ?></p>
                                    <p><?php echo $donnees['mail']; ?></p>
                                    <p><?php
                            if ($hasNote) {
                                for ($i = 0; $i < $note; ++$i) {
                                    echo '★';
                                }
                                for ($j = 0; $j < 10 - $note; ++$j) {
                                    echo '☆';
                                }
                            } else {
                                echo 'Note inconnue';
                            }
                                    ?></p>
                                </div>

                                <div class="col-sm-6">
                                    <div class="col-sm-12">
                                        <h4 style="text-align: left;">Depart :</h4>
                                        <div class="col-sm-4">
                                            <?php echo $donnees['ville_depart']; ?>
                                        </div>
                                        <div class="col-sm-8">
                                            <p><?php echo $donnees['lieu_depart']; ?></p>
                                            <p><?php echo strftime("%e / %m / %Y, <br /> %H : %M", strtotime($donnees['date_depart'])); ?></p>
                                        </div>
                                    </div>
                                    <?php
                                    //Affichage des étapes
                                    for ($i = 0; $i < $donnees['COUNT(*)']; ++$i) {
                                        ?>
                                        <div class="col-sm-12">
                                            <h4 style="text-align: left;">Etape <?php echo $i + 1; ?> :</h4>
                                            <div class="col-sm-4">
                                                <p><?php echo $donnees['ville']; ?></p>
                                            </div>
                                            <div class="col-sm-8">
                                                <p><?php echo $donnees['lieu']; ?></p>
                                                <p><?php echo strftime("%e / %m / %Y, <br /> %H : %M", strtotime($donnees['date'])); ?></p>
                                            </div>
                                        </div>
                                    <?php } ?>
                                    <div class="col-sm-12">
                                        <h4 style="text-align: left;">Arrivee :</h4>
                                        <div class="col-sm-4">
                                            <?php echo $donnees['ville_arrivee']; ?>
                                        </div>
                                        <div class="col-sm-8">
                                            <p><?php echo $donnees['lieu_arrive']; ?></p>
                                            <p><?php echo strftime("%e / %m / %Y, <br /> %H : %M", strtotime($donnees['date_arrivee'])); ?></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6 informationsRetard">
                                    <p>Retard toléré : <?php echo $donnees['retard']; ?> minutes</p>
                                    <p>Pensez à me contacter pour plus d'informations !</p>
                                </div>
                            </div>
                            <div class="col-sm-12" style="padding-top: 25px; padding-bottom: 10px;">
                                <div class="col-sm-2">
                                    <?php
                                    if ($donnees['autoroute'] == true) {
                                        echo '<img src="../img/autoroute.png" class="logoAutoroute" />';
                                    }
                                    ?>
                                </div>
                                <div class="col-sm-4">
                                    <?php 
                                    //Affichage du nombre de places restantes
                                    if ($placesRestantes == 0) 
                                    {
                                        ?> Il n'y a plus de places
                                       <?php 
                                    } else {
                                    ?>
                                    Il reste <?php echo $placesRestantes; ?> place<?php
                        if ($placesRestantes > 1) {
                            echo 's';
                        }
                                    }
                                    ?>
                                </div>
                                <?php
                                if (isset($_SESSION['ID_USER'])) {
                                    ?>
                                    <div class="col-sm-4" style="color: #333;">
                                        <form method="post" action="reservation_places_trajet.php">
                                            <input type="hidden" name="idTrajet" id="idTrajet" value="<?php echo $donnees['id_trajet']; ?>" />
                                            <input type="hidden" name="idReservant" id="idReservant" value="<?php echo $_SESSION['ID_USER']; ?>" />
                                            <input type="hidden" name="location" id="location" value="<?php echo $_SERVER['REQUEST_URI']; ?>" />
                                            <input class="placesReservees" name="nombrePlacesReservees" id="nombrePlacesReservees" type="number" min="0" max="<?php echo $placesRestantes; ?>" style="width: 50px;" />
                                            <button class="boutonReservation">Je reserve</button>
                                        </form>
                                    </div>

                                    <div class="col-sm-2">
                                        <input type="button" class="btn btn-default" data-toggle="modal" data-target="#modalSignalement" value="Signaler"/>
                                    </div>
                                    <?php
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                    <?php
                } else { //Valable pour quelque problème que ce soit
                    ?>
        <div class="text-center nomTrajet">
                <h2>Désolé, nous n'avons pas pu trouver le trajet en question, merci de vous rediriger vers la page d'accueil.</h2>
                <a href=\"index.php\"><button>Cliquez ici</button></a>
            </div>
        <?php
                }
            }
        } else { //Si le trajet demandé n'existe pas
            ?>
            <div class="text-center nomTrajet">
                <h2>Désolé, nous n'avons pas pu trouver le trajet en question, merci de vous rediriger vers la page d'accueil.</h2>
                <a href=\"index.php\"><button>Cliquez ici</button></a>
            </div>
            <?php
        }
        ?>
    </div>
        <?php include 'footer.include.php'; ?>
    </body>
</html>