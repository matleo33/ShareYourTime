<?php session_start(); ?>
<!DOCTYPE html>
<html lang="fr">

    <head>
        <meta charset="UTF-8">
        <link href="./../css/style.css" rel="stylesheet">
        <link rel="stylesheet" href="//netdna.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css">

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
        <?php include 'modal_signalement.include.php' ?>
        <?php
        if (isset($_SESSION['ID_USER'])) {
            if (isset($_GET['id_trajet'])) {
                ?>
                <?php
                try {
                    $bdd = new PDO('mysql:host=localhost;dbname=shareyourtime;charset=utf8', 'root', 'D0nald&Ch@uve');
                } catch (Exception $e) {
                    die('Erreur : ' . $e->getMessage());
                }
                $reponse = $bdd->query('SELECT * '
                        . 'FROM covoiturage INNER JOIN trajet on trajet.id_trajet=covoiturage.trajet INNER JOIN users on trajet.chauffeur=users.id_users '
                        . 'WHERE trajet.chauffeur!= ' . $_SESSION['ID_USER'] . ' AND users=' . $_SESSION['ID_USER'] . ' AND trajet = ' . $_GET['id_trajet']);
                while ($donnees = $reponse->fetch()) {
                    if ($donnees['id_users'] != $_SESSION['ID_USER']) {
                        ?>
                        <div class="container-fluid col-sm-10 col-sm-offset-1 col-lg-8 col-lg-offset-2" style="color:white; text-align: center; background-color:rgb(69,164,247); border-radius: 5px;">
                            <h1>Avis conducteur</h1>
                            <div class="voyageurAvis col-sm-12">
                                <div class="col-sm-3">
                                    <div class="col-sm-12">
                                        <?php if ($donnees['lien_photo'] == NULL) { ?>
                                            <img class="photoProfilAvis" src="../img/imageProfil2.PNG" alt="photoProfil" />
                                            <?php
                                        } else {
                                            ?> 
                                            <img class="photoProfilAvis" src="../../images/<?php echo $donnees['lien_photo'] ?>" alt="photoProfil" />
                                            <?php
                                        }
                                        ?>
                                    </div>
                                    <div class="col-sm-12">
                                        <?php
                                        echo $donnees['nom'] . ' ' . $donnees['prenom'];
                                        ?>
                                    </div>
                                </div>
                                <div class="col-sm-9">
                                    <div class="col-sm-12">
                                        <form method="post" action="getAvis.php">
                                            <div class="row">
                                                <div class="stars">
                                                    <input class="star star-5" id="star-5" type="radio" name="star"/>
                                                    <label class="star star-5" for="star-5"></label>
                                                    <input class="star star-4" id="star-4" type="radio" name="star"/>
                                                    <label class="star star-4" for="star-4"></label>
                                                    <input class="star star-3" id="star-3" type="radio" name="star"/>
                                                    <label class="star star-3" for="star-3"></label>
                                                    <input class="star star-2" id="star-2" type="radio" name="star"/>
                                                    <label class="star star-2" for="star-2"></label>
                                                    <input class="star star-1" id="star-1" type="radio" name="star"/>
                                                    <label class="star star-1" for="star-1"></label>
                                                    <input hidden id="emetteur" name="emetteur" value="<?php echo $_SESSION['ID_USER']; ?>" />
                                                    <input hidden id="cible" name="recepteur" value="<?php echo $donnees['id_users']; ?>" />
                                                </div>
                                                <div class="col">
                                                    <textarea maxlength="255" id="description" name="description" class="form-control" placeholder="Avis" type="textarea" style="width: 100%; max-width: none; resize: none;"></textarea>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col">
                                                    <input type="submit" style="margin-top: 10px; margin-bottom: 10px;" class="btn btn-primary" value="Valider Avis"/>
                                                </div>
                                                <div class="col">
                                                    <input type="button" style="margin-top: 10px; margin-bottom: 10px;" class="btn btn-primary" data-toggle="modal" data-target="#modalSignalement" value="Signaler"/>
                                                </div>
                                            </div>

                                        </form>
                                    </div>
                                </div>

                            </div>

                            <?php
                        }
                    }
                } else {
                    echo "<p>Désolé, le trajet que vous recherchez n'existe pas</p>";
                    echo "<p><a href='index.php'>Cliquez-ici</a> pour revenir à la page d'accueil</p>";
                }
            } else {
                echo 'Désolé vous ne pouvez pas emettre d\'avis si vous n\'êtes pas connecté.';
                echo "<p><a href='index.php'>Cliquez-ici</a> pour revenir à la page d'accueil</p>";
            }
            ?>
        </div>
    </div>
    <?php include 'footer.include.php'; ?>
</body>
</html>