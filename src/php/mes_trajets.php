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

        <!-- Library DateTimePicker -->
        <link href="../BootStrap/css/bootstrap-datetimepicker.min.css" rel="stylesheet" media="screen">
        <script type="text/javascript" src="../BootStrap/js/bootstrap-datetimepicker.js" charset="UTF-8"></script>
        <script type="text/javascript" src="../BootStrap/js/locales/bootstrap-datetimepicker.fr.js" charset="UTF-8"></script>

        <title>Share Your Time</title>
    </head>

    <body>
        <?php
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
                        . 'FROM trajet INNER JOIN users on trajet.chauffeur=users.id_users '
                        . 'WHERE users.id_users = ' . $_SESSION['ID_USER']);
                while ($donnees = $reponse->fetch()) {
                    ?>
                    <table class="table table-bordered table-hover table-dark">
                        <thead>
                            <tr class="bg-primary">
                                <th colspan="2">
                                    <?php
                                    echo $donnees['ville_depart'] . ' - ' . $donnees['ville_arrivee'] . ' - ' . $donnees['date_depart'] . ' - ';
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
                                <th>
                                    <input onclick="" type="button" class="btn btn-primary" value="Terminer" />
                                    <input onclick="" type="button" class="btn btn-primary" value="+" />
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php for ($i = 0; $i < getNbReservants($bdd, $donnees["id_trajet"]); $i++) { 
                                $reponseParticipants = $bdd->query('SELECT * '
                                        . 'FROM covoiturage INNER JOIN users on covoiturage.users = users.id_users '
                                        . 'WHERE trajet='.$donnees['id_trajet']);
                                while($donneesParticipants = $reponseParticipants->fetch()) {
                                ?>
                                <tr>
                                    <td>
                                        <img src="../img/imageProfil.png" alt="photoProfil" />
                                    </td>
                                    <td colspan="2">
                                        <p><?php echo $donneesParticipants['nom'].' '.$donneesParticipants['prenom'];?></p>
                                        <p>Nombre places réservées : <?php echo $donneesParticipants['nb_place_res'];?></p>
                                    </td>
                                </tr>
                            <?php }
                            
                            }?>
                        </tbody>
                    </table>    
                    <?php
                }
            }
            ?>
        </div>

        <?php include 'footer.include.php'; ?>
    </body>
</html>