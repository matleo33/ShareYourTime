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
        <script src="../js/trouver_evenement.js"></script>
        <script src="../js/datetimepicker.js"></script>
        <script src="../js/connexion.js"></script>

        <meta charset="UTF-8">
        <link href="./../css/style.css" rel="stylesheet">
        <script src="../BootStrap/js/bootstrap.min.js"></script>

        <!-- Library DateTimePicker -->
        <link href="../BootStrap/css/bootstrap-datetimepicker.min.css" rel="stylesheet" media="screen">
        <script type="text/javascript" src="../BootStrap/js/bootstrap-datetimepicker.js" charset="UTF-8"></script>
        <script type="text/javascript" src="../BootStrap/js/locales/bootstrap-datetimepicker.fr.js" charset="UTF-8"></script>

        <title>Share Your Time</title>
    </head>

    <body>
        <div class="container-fluid">
            <?php
            $cpt = 0;
            $vide = TRUE;
            include 'navbar.include.php';
            if (isset($_SESSION['ID_USER'])) {
                include 'getNbReservants.php';
                try {
                    $bdd = new PDO('mysql:host=localhost;dbname=shareyourtime;charset=utf8', 'root', '');
                } catch (Exception $e) {
                    die('Erreur : ' . $e->getMessage());
                }
                ?>
                <div class="container col-lg-offset-3 col-lg-6 col-md-offset-3 col-md-6 col-sm-offset-2 col-sm-8 col-xs-12" id="divMesTrajets">
                    <?php
                    $reponse = $bdd->query('SELECT * '
                            . 'FROM trajet INNER JOIN users on trajet.chauffeur=users.id_users INNER JOIN events on events.id_events = trajet.evenement '
                            . 'WHERE users.id_users = ' . $_SESSION['ID_USER']);
                    while ($donnees = $reponse->fetch()) {
                        $vide = FALSE;
                        ?>
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr class="bg-primary" style="background-color : rgb(69, 164, 247);">
                                    <th colspan="3">
                                        <?php
                                        echo $donnees['nom'] . ' - ' . $donnees['ville_depart'] . ' - ' . $donnees['ville_arrivee'] . ' - ' . strftime("%e / %m / %Y, %H : %M", strtotime($donnees['date_depart'])) . ' - ';
                                        switch ($donnees['est_fini']) {
                                            case 0: {
                                                    echo "Pret";
                                                    break;
                                                }
                                            default : {
                                                    echo "Terminé";
                                                    break;
                                                }
                                        }
                                        ?>
                                    </th>
                                    <th style="text-align: right;">
                                        <?php if ($donnees['est_fini'] == FALSE) { ?>
                                            <form method="post" action="trajetFini.php" style="display:inline">
                                                <input hidden name="id_trajet" id="id_trajet" value="<?php echo $donnees['id_trajet']; ?>" />
                                                <input style="background-color : rgb(69, 164, 247);" type="submit" class="btn btn-primary" value="Trajet terminé" disabled/>
                                            </form>
                                            <?php
                                        }
                                        ?>
                                        <button type="button" aria-expanded="false" aria-controls="tabody<?php
                                        $cpt++;
                                        echo $cpt;
                                        ?>" data-toggle="collapse" data-target="#tabody<?php echo $cpt; ?>, #tabody2<?php echo $cpt; ?>" class="btn btn-primary" style="background-color : rgb(69, 164, 247);">
                                            +
                                        </button>
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="collapse" id="tabody<?php echo $cpt; ?>" >
                                <tr style="font-weight : bold;">
                                    <td style="width:25%;" colspan="2">Infos</td>
                                    <td style="width:37.5%;">Depart</td>
                                    <td style="width:37.5%;">Arrivée</td>
                                </tr>
                                <tr> 
                                    <td colspan="2">Date</td>
                                    <td><?php echo strftime("%e / %m / %Y", strtotime($donnees['date_depart'])); ?></td>
                                    <td><?php echo strftime("%e / %m / %Y", strtotime($donnees['date_arrivee'])); ?></td>
                                </tr>
                                <tr> 
                                    <td colspan="2">Heure</td>
                                    <td>Heure depart</td>
                                    <td><?php echo strftime("%H : %M", strtotime($donnees['date_depart'])); ?></td>
                                </tr>
                                <tr> 
                                    <td colspan="2">Ville</td>
                                    <td>Ville depart</td>
                                    <td>Ville arrivee</td>
                                </tr>
                                </tbody>
                            <tbody class="collapse" id="tabody2<?php echo $cpt; ?>">
                                <tr style="font-weight : bold;">
                                    <td>Covoitureurs</td>
                                    <td>Nom</td>
                                    <td>Prenom</td>
                                    <td>Nombre places réservées</td>
                                </tr>
                                <?php
                                $reponseParticipants = $bdd->query('SELECT * '
                                        . 'FROM covoiturage INNER JOIN users on covoiturage.users = users.id_users '
                                        . 'WHERE trajet=' . $donnees['id_trajet']);
                                while ($donneesParticipants = $reponseParticipants->fetch()) {
                                    ?>
                                    <tr>
                                        <td>
                                            <?php if ($donneesParticipants['lien_photo'] == NULL) { ?>
                                                <img class="photoProfilTrajet" src="../img/imageProfil2.PNG" alt="photoProfil" />
                                                <?php
                                            } else {
                                                ?> 
                                                <img class="photoProfilTrajet" src="../../images/<?php echo $donneesParticipants['lien_photo'] ?>" alt="photoProfil" />
                                                <?php
                                            }
                                            ?>
                                        </td>
                                        <td>
                                            <p><?php echo $donneesParticipants['nom'] ?></p>
                                        </td>
                                        <td>
                                            <p><?php echo $donneesParticipants['prenom']; ?></p>
                                        </td>
                                        <td>
                                            <p><?php echo $donneesParticipants['nb_place_res']; ?></p>
                                        </td>
                                        
                                    </tr>

                                    <?php
                                }
                                ?>
                            </tbody>
                        </table>    
                        <?php
                    }
                    if ($vide == TRUE) {
                        ?>
                    <h1 class="text-center">Désolé, mais vous n'avez pas encore effectué de trajet avec Share Your Time, peut-être devriez vous en organiser un ;)</h1>
                    <?php
                    }
                } else {
                    ?>
                    <h1 class="text-center">Désolé, mais vous devez être connecté pour accéder à cette page.</h1>
                    <?php
                }
                ?>
            </div>
        </div>
        <?php include 'footer.include.php'; ?>
    </body>
</html>