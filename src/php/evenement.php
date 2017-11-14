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
        <?php include 'navbar.include.php'; ?><br/>
        <?php include 'modal_connexion.include.php' ?>
        <?php include 'modal_inscription.include.php' ?>
        <?php
        $id_event = $_GET['id_events'];
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
                <h1><?php echo $donnees['nom']; ?></h1>
                <div>Description : <?php echo $donnees['description']; ?></div>
                <div>Adresse : <?php echo $donnees['adresse']; ?></div>
                <div>Date : <?php echo $donnees['date_debut'] . ' / ' . $donnees['date_fin']; ?></div>
                <div><a href="<?php echo $donnees['lien_fb']; ?>"><img class='logo' src='../img/facebook.png'/></a></div>
                <div><a href="<?php echo $donnees['lien_billet']; ?>"><img class='logo' src='../img/ticket.png'/></a></div>
                <div>
                    <?php
                }

                function getTrajets($bdd, string $id_event) {
                    $reponseTrajets = $bdd->query('SELECT * FROM trajet INNER JOIN users on trajet.chauffeur = users.id_users WHERE evenement=\'' . $id_event . '\'');
                    while ($donneesTrajet = $reponseTrajets->fetch()) {
                        ?>
                        <div>
                            <p>Nom : <?php echo $donneesTrajet['nom']; ?></p>
                            <p>Prénom : <?php echo $donneesTrajet['prenom']; ?></p>
                            <p>Depart : <?php echo $donneesTrajet['ville_depart'] . ', ' . $donneesTrajet['lieu_depart']; ?></p>
                            <p>Prix : <?php echo $donneesTrajet['prix_tot'] . ' €'; ?></p>
                            <p>Note chauffeur : <?php echo $donneesTrajet['personnalite']; ?></p>
                            <a href="#"><button>Voir détails</button></a>
                        </div>
                        <?php
                    }
                }

                getTrajets($bdd, $id_event);
                $reponse->closeCursor(); // Termine le traitement de la requête
            }
            ?>
            <?php /* inclure menu nav */ ?>
            <div>
                <a href="./recherche.php"><button>Recherche détaillée</button></a>
                <button>Evénement terminé</button>
            </div>
        </div>
    </body>
</html>