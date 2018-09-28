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
        <script src="../js/connexion.js"></script>
        <script src="../BootStrap/js/bootstrap.min.js"></script>

        <title>Share Your Time</title>
    </head>

    <body>
        <?php include 'navbar.include.php'; ?>
        <?php include 'modal_connexion.include.php' ?>
        <?php include 'modal_inscription.include.php' ?>
        <div class="container-fluid">
            <?php
            include 'getNote.php';
            include 'countTrajet.php';
            include 'getTrajets.php';
            if (isset($_GET['id_events'])) {
                $id_event = $_GET['id_events'];
            }
            try {
                $bdd = new PDO('mysql:host=localhost;dbname=jmcbordeaux_shareyourtime;charset=utf8', 'jmcbordeaux_root', 'D0nald&Ch@uve');
            } catch (Exception $e) {
                die('Erreur : ' . $e->getMessage());
            }
            if ($id_event != NULL) {
                $reponse = $bdd->query('SELECT * '
                        . 'FROM events '
                        . 'WHERE id_events = ' . $id_event);
                while ($donnees = $reponse->fetch()) {
                    $est_fini = $donnees['est_fini'];
                    $createur = $donnees['createur'];
                    ?>
                    <div class="col-sm-12">
                        <?php if ($donnees['lien_photo'] != NULL) { ?>
                            <div class="col-sm-4 col-sm-offset-1">
                                <img style="height: 200px;" src="../../images_events/<?php echo $donnees['lien_photo']?>" alt="photo évenement" />
                            </div>
                            <div class="col-sm-4 col-sm-offset-1">
                                <h1 class="text-center"><?php
                                    echo $donnees['nom'];
                                    if ($donnees['est_fini'] == true) {
                                        echo "<br/> (Evenement terminé)";
                                    }
                                    ?></h1>
                                <p class="descriptionEvenement"><?php echo $donnees['description']; ?></p>
                                <div>
                                    <p>Adresse : <?php echo $donnees['adresse']; ?></p>
                                    <p>Date debut : <?php echo strftime("%e / %m / %Y, %H : %M", strtotime($donnees['date_debut'])) ?></p>
                                    <p>Date fin : <?php echo strftime("%e / %m / %Y, %H : %M", strtotime($donnees['date_fin'])); ?></p>
                                    <div class="text_right"><a href="<?php echo $donnees['lien_fb']; ?>"><img class='logo'
                                                                                                              src='../img/facebook.png'/></a>
                                        <a href="<?php echo $donnees['lien_billet']; ?>"><img class='logo' src='../img/ticket.png'/></a>
                                    </div>
                                </div>
                            </div>
                            <?php
                        } else {
                            ?>
                            <div class="col-sm-12 col-lg-6 col-lg-offset-3">
                                <h1 class="text-center"><?php
                                    echo $donnees['nom'];
                                    if ($donnees['est_fini'] == true) {
                                        echo "<br/> (Evenement terminé)";
                                    }
                                    ?></h1>
                                <p class="descriptionEvenement"><?php echo $donnees['description']; ?></p>
                                <div class="col-xs-12 col-sm-6 col-lg-6">
                                    <p>Adresse : <?php echo $donnees['adresse']; ?></p>
                                    <p>Date debut : <?php echo strftime("%e / %m / %Y, %H : %M", strtotime($donnees['date_debut'])) ?></p>
                                    <p>Date fin : <?php echo strftime("%e / %m / %Y, %H : %M", strtotime($donnees['date_fin'])); ?></p>
                                </div>
                                <div class="col-lg-4 col-lg-offset-1 col-sm-12 col-xs-12" style="float: right;">
                                        <a href="<?php echo $donnees['lien_fb']; ?>">
                                            <img class='logo' src='../img/facebook.png'/>
                                        </a>
                                        <a href="<?php echo $donnees['lien_billet']; ?>">
                                            <img class='logo' src='../img/ticket.png'/>
                                        </a>
                                    </div>
                            </div>
                            <?php
                        }
                        ?>
                    </div>
                    <div class="col-sm-12" id="divTrajet">
                        <?php
                    }
                    //Permet d'afficher les trajets associés à l'évenement
                    getTrajets($bdd, $id_event, 0);
                    ?>
                    <div class="text-center col-sm-12">
                        <?php
                        //Menu Nav entre trajets
                        $nbTrajets = countTrajet($bdd, $id_event);
                        for ($i = 0; $i < $nbTrajets / 2; ++$i) {
                            echo "<a href=\"evenement.php?id_events=" . $id_event . "&page=" . $i . "\">" . ($i + 1) . "</a> ";
                        }
                        ?>
                    </div>
                    <div class="col-sm-12">
                        <div class="col-sm-6 col-sm-offset-3 text-center">
                            <a href="./proposer_trajet.php?id_events=<?php echo $_GET['id_events']; ?>"><button>Proposez votre trajet</button></a>
                            <a href="./recherche.php"><button>Recherche détaillée</button></a>
                            <?php
                            if (isset($_SESSION['ID_USER']) && ($createur == $_SESSION['ID_USER']) && $est_fini == FALSE) {
                                ?>
                                <div class="col-sm-6 col-sm-offset-3 text-center">
                                    <form method="post" action="terminerEvenement.php">
                                        <input type="hidden" name="idTrajet" id="idTrajet" value="<?php echo $donnees['id_trajet']; ?>" />
                                        <input type="hidden" name="id_event" id="id_event" value="<?php echo $id_event; ?>" />
                                        <button type="submit">Evénement terminé</button>
                                    </form>
                                </div>
                                <?php
                                $reponse->closeCursor(); // Termine le traitement de la requête
                            }
                        } else {
                            ?>
                            <h2>Nous sommes désolés, nous n'avons pas pu trouver l'événement recherché. <a href="index.php">Cliquez-ici</a> pour retrouner à la page d'accueil</h2>
                            <?php
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
        <?php include 'footer.include.php'; ?>
    </body>
</html>