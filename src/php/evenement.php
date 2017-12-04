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
                    <div class="col-sm-4">
                        IMAGEEVENEMENT
                    </div>
                    <div class="col-sm-1" >
                    </div>
                    <div class="col-sm-6">
                        <h1 class="text-center"><?php echo $donnees['nom']; ?></h1>
                        <p class="text-center descriptionEvenement"><?php echo $donnees['description']; ?></p>
                        <div>
                            <p>Adresse : <?php echo $donnees['adresse']; ?></p>
                            <p>Dates : <br /><?php echo $donnees['date_debut'] . ' <br /> ' . $donnees['date_fin']; ?></p>
                            <div class="text_right"><a href="<?php echo $donnees['lien_fb']; ?>"><img class='logo' src='../img/facebook.png'/></a>
                                <a href="<?php echo $donnees['lien_billet']; ?>"><img class='logo' src='../img/ticket.png'/></a></div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12" style="margin-top: 50px;">

                    <?php
                }

                function getTrajets($bdd, string $id_event) {
                    $reponseTrajets = $bdd->query('SELECT id_trajet, nom, prenom, ville_depart, lieu_depart, prix_tot, personnalite, autoroute FROM trajet INNER JOIN users on trajet.chauffeur = users.id_users WHERE evenement=\'' . $id_event . '\'');
                    while ($donneesTrajet = $reponseTrajets->fetch()) {
                        ?>
                        <div class="col-sm-12" style="margin-bottom: 50px;">
                            <div class="col-sm-2">
                                IMAGECHAUFFEUR
                            </div>
                            <div class="col-sm-1">
                            </div>
                            <div class="col-sm-8 trajetEvenement">
                                <div class="col-sm-6">
                                    <h3 class="nomChauffeurTrajetEvenement">
                                        <?php
                                        echo $donneesTrajet['nom'] . ' ' . $donneesTrajet['prenom'];
                                        ?>
                                    </h3>
                                    <p>Depart : <?php echo $donneesTrajet['ville_depart'] . ', ' . $donneesTrajet['lieu_depart']; ?></p>
                                    <p>Prix : <?php echo $donneesTrajet['prix_tot'] . ' €'; ?></p>
                                    <p>Note chauffeur : <?php
                                        for ($i = 0; $i < $donneesTrajet['personnalite']; ++$i) {
                                            echo '★';
                                        }
                                        for ($j = 0; $j < 10 - $donneesTrajet['personnalite']; ++$j) {
                                            echo '☆';
                                        }
                                        ?></p>
                                </div>
                                <div class="col-sm-1">
                                </div>
                                <div class="col-sm-2">
                                    <?php
                                    if ($donneesTrajet['autoroute']) {
                                        echo "<img class=\"logoAutoroute\" src=\"../img/autoroute.png\" alt=\"autouroute : oui\"/ />";
                                    }
                                    ?>
                                </div>
                                <div class="col-sm-1">
                                </div>
                                <div class="col-sm-2">
                                    <a href="./trajet.php?id_trajet=<?php echo $donneesTrajet['id_trajet'] ?>"><button>Voir détails</button></a>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                }

                getTrajets($bdd, $id_event);
                $reponse->closeCursor(); // Termine le traitement de la requête
            }
            ?>
            <?php /* inclure menu nav */ ?>
            <div class="col-sm-12">
                <div class="col-sm-4">
                </div>
                <div class="col-sm-4">
                    <a href="./recherche.php"><button>Recherche détaillée</button></a>
                    <button>Evénement terminé</button>
                </div>
                <div class="col-sm-4">
                </div>
            </div>
        </div>
        <?php include 'footer.include.php'; ?>
    </body>
</html>