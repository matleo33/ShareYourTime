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
                $bdd = new PDO('mysql:host=localhost;dbname=shareyourtime;charset=utf8', 'root', '');
            } catch (Exception $e) {
                die('Erreur : ' . $e->getMessage());
            }
            if ($id_event != NULL) {
                $reponse = $bdd->query('SELECT * '
                        . 'FROM events '
                        . 'WHERE id_events = ' . $id_event);
                while ($donnees = $reponse->fetch()) {
                    ?>
                    <div class="col-sm-12">
                        <div class="col-sm-4 col-sm-offset-1">
                            IMAGEEVENEMENT
                        </div>
                        <div class="col-sm-4 col-sm-offset-1">
                            <h1 class="text-center"><?php echo $donnees['nom']; ?></h1>
                            <p class="descriptionEvenement"><?php echo $donnees['description']; ?></p>
                            <div>
                                <p>Adresse : <?php echo $donnees['adresse']; ?></p>
                                <p>Dates : <br/><?php echo strftime("%e / %m / %Y, %H : %M",strtotime($donnees['date_debut'])) . ' <br /> ' . strftime("%e / %m / %Y, %H : %M",strtotime($donnees['date_fin'])); ?></p>
                                <div class="text_right"><a href="<?php echo $donnees['lien_fb']; ?>"><img class='logo'
                                                                                                          src='../img/facebook.png'/></a>
                                    <a href="<?php echo $donnees['lien_billet']; ?>"><img class='logo' src='../img/ticket.png'/></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12" id="divTrajet">

                        <?php
                    }

                   

                    getTrajets($bdd, $id_event, 0);
                    $reponse->closeCursor(); // Termine le traitement de la requête
                }
                ?>
                <div class="text-center">
                    <?php
                    //Menu Nav entre trajets
                    $nbTrajets = countTrajet($bdd, $id_event);
                    for ($i = 0; $i <= $nbTrajets / 2; ++$i) {
                        echo "<a href=\"evenement.php?id_events=" . $id_event . "&page=" . $i . "\">" . ($i + 1) . "</a> ";
                    }
                    ?>
                </div>
                <div class="col-sm-12">
                    <div class="col-sm-6 col-sm-offset-3 text-center">
                        <a href="./proposer_trajet.php?id_events=<?php echo $_GET['id_events']; ?>"><button>Proposez votre trajet</button></a>
                        <a href="./recherche.php"><button>Recherche détaillée</button></a>
                        <?php
                        if (isset($_SESSION['ID_USER']) && $donnees['createur'] == $_SESSION['ID_USER']) {
                            echo '<button>Evénement terminé</button>';
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include 'footer.include.php'; ?>
</body>
</html>