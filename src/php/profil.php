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
        <!-- <script src="../js/editer.js"></script> -->
        <script src="../js/connexion.js"></script>

        <title>Share Your Time</title>
    </head>

    <body>
        <?php include 'navbar.include.php'; ?><br/>
        <?php
        include 'getNote.php';
        if (isset($_GET['id_profil'])) {
            try {
                $bdd = new PDO('mysql:host=localhost;dbname=shareyourtime;charset=utf8', 'root', 'D0nald&Ch@uve');
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
                $hasNote = getHasNote($bdd, $donnees['id_users']);
                if ($hasNote) {
                    $note = getNote($bdd, $donnees['id_users']);
                }
                ?>

                <!-- Photo de profil -->    
                <div class="col-sm-4">
                    <?php if ($donnees['lien_photo'] == NULL) { ?>
                        <img class="photoProfil" src="../img/imageProfil2.PNG" alt="photoProfil" />
                        <?php
                    } else {
                        ?> 
                        <img class="photoProfil" src="../../images/<?php echo $donnees['lien_photo'] ?>" alt="photoProfil" />
                        <?php
                    }
                    if (isset($_SESSION['ID_USER']) && ($_SESSION['ID_USER'] == $donnees['id_users'])) {
                        ?>
                        <form method="post" action="upload_photo.php" enctype="multipart/form-data">
                            <input name="nouvellePhoto" id="nouvellePhoto" type="file" accept="image/jpeg, image/png, image/jpg"/>
                            <button type="submit">Enregistrer</button>
                        </form>
                        <?php
                    }
                    ?>
                </div>
                <!-- Informations -->    
                <div class="col-sm-4">
                    <h1><?php echo $donnees['nom'] . ' ' . $donnees['prenom'] ?></h1>
                    <p>Mail : <?php echo $donnees['mail']; ?></p>
                    <p>Tel : <?php echo $donnees['num_telephone']; ?></p>
                    <p>Contact préférentiel : <?php 
                                            if (isset($donnees['contact_pref'])) {
                                    echo $donnees['contact_pref'];
                                } else {
                                    echo "Aucun";
                                }
                                ?></p>
                    <p>Nombre de trajets en tant que conducteur : <?php echo $donnees['COUNT(trajet.id_trajet)'] ?></p>
                    <p>Nombre d'événements organisés : <?php
                        while ($donnees2 = $reponse2->fetch()) {
                            echo $donnees2['COUNT(*)'];
                        }
                        ?></p>
                    <p>Note :
                        <span style="font-size:150%; color:
                        <?php
                        if ($note >= 9) {
                            echo 'gold;';
                        } else if ($note >= 7) {
                            echo 'silver;';
                        } else if ($note >= 5)
                            echo '#614E1A;';
                        else {
                            echo 'red;';
                        }
                        ?>">
                                  <?php
                                  for ($i = 0; $i < $note; ++$i) {
                                      echo '★';
                                  }
                                  for ($j = 0; $j < 10 - $note; ++$j) {
                                      echo '☆';
                                  }
                                  ?>
                        </span></p>
                    <p>Description : </p>
                    <?php
                    if (isset($_SESSION['ID_USER']) && ($_SESSION['ID_USER'] == $donnees['id_users'])) {
                        ?>
                        <form method="post" action="modifierDescription.php">
                            <textarea maxlength="255" id="description" name="description" class="form-control" placeholder="Description" type="textarea" style="max-width: 90%; min-width: 90%; min-height: 50px;" ><?php echo $donnees['biographie']; ?></textarea>
                            <button type="submit">Editer</button>
                        </form>
                        <?php
                    } else {
                        echo '<p>' . $donnees['biographie'] . '</p>';
                    }
                    ?>
                </div>
                <!-- Caractéristiques trajets -->    
                <div class="col-sm-4">
                    <h1>Caractéristiques trajets</h1>
                    <div class="col-sm-6 col-sm-offset-6 col-sm-pull-6 text-center">
                        <span>Bavardise : </span>
                    </div>
                    <div class="scrollbar col-sm-6 col-sm-offset-6 col-sm-pull-6">
                        <div style="width: 
                        <?php
                        echo $note * 10;
                        ?>%; height:23px; background-color: 
                             <?php
                             if ($note * 10 < 25) {
                                 echo "red";
                             } else if ($note * 10 < 50) {
                                 echo "orange";
                             } else if ($note * 10 < 75) {
                                 echo "yellow";
                             } else {
                                 echo "green";
                             }
                             ?>">

                        </div>
                    </div>
                    <?php
                    if (isset($_SESSION['ID_USER'])) {
                        ?>
                        <form method="post" action="update_preferences.php">
                            <p>Animaux autorisés : 
                                <select name="animaux">
                                    <option <?php
                                    if ($donnees['animaux'] == TRUE) {
                                        echo " selected ";
                                    }
                                    ?>>Oui</option>
                                    <option <?php
                                    if ($donnees['animaux'] == FALSE) {
                                        echo " selected ";
                                    }
                                    ?>>Non</option>
                                </select>
                            </p>
                            <p>Fumeurs autorisés : 
                                <select name="fumeur">
                                    <option <?php
                                    if ($donnees['fumeur'] == TRUE) {
                                        echo "selected";
                                    }
                                    ?>>Oui</option>
                                    <option <?php
                                    if ($donnees['fumeur'] == FALSE) {
                                        echo "selected";
                                    }
                                    ?>>Non</option>
                                </select>
                            </p>
                            <p>Musique autorisée :
                                <select name="musique">
                                    <option <?php
                                    if ($donnees['musique'] == TRUE) {
                                        echo "selected";
                                    }
                                    ?>>Oui</option>
                                    <option <?php
                                    if ($donnees['musique'] == FALSE) {
                                        echo "selected";
                                    }
                                    ?>>Non</option>
                                </select>
                            </p>
                            <button type="submit">Valider préférences</button>
                        </form>
                        <?php
                    } else {
                        ?>
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
                        <?php
                    }
                    ?>
                    <h1>Derniers Avis</h1>
                    <?php
                    include 'derniers_avis.php';
                    derniersAvis($bdd, $donnees['id_users']);
                    ?>
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

