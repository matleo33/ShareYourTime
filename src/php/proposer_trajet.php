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
        <?php include 'navbar.include.php'; ?>

        <div class="container col-lg-offset-3 col-lg-6 col-md-offset-3 col-md-6 col-sm-offset-2 col-sm-8 col-xs-12" id="divProposerTrajet">
            <h1 id="titreBlanc">PROPOSER UN TRAJET</h1>
            <form action="proposer_trajet_envoi.php" method="post" id="formTrajet">
                <?php
                $nomEvenement = NULL;
                $villeEvenement = NULL;
                $dateDebut = NULL;
                $adresse = NULL;
                if (isset($_GET['id_events']))
                    $idEvenement = $_GET['id_events'];
                else
                    $idEvenement = NULL;
                try {
                    $bdd = new PDO('mysql:host=localhost;dbname=shareyourtime;charset=utf8', 'root', '');
                } catch (Exception $e) {
                    die('Erreur : ' . $e->getMessage());
                }
                if ($idEvenement != NULL) {
                    $reponse = $bdd->query('SELECT nom, ville, date_debut, adresse '
                            . 'FROM events '
                            . 'WHERE id_events=' . $idEvenement);
                    while ($donnees = $reponse->fetch()) {
                        $nomEvenement = $donnees['nom'];
                        $villeEvenement = $donnees['ville'];
                        $dateDebut = $donnees['date_debut'];
                        $adresse = $donnees['adresse'];
                    }
                    $reponse->closeCursor(); // Termine le traitement de la requête
                }
                ?>
                <div class="col-sm-12">
                    <input class="form-control" type="text" name="eventName" required="required" id="eventName" placeholder="Evénement concerné" value="<?php
                    if ($nomEvenement != NULL) {
                        echo $nomEvenement;
                    }
                    ?>"/>
                </div>
                <input type="submit" id="submitEventName" class="btn btn-primary" value="Suivant"/>
            </form>
            <form>
                <div class="col-sm-12">
                    <div class="col-sm-10 col-sm-offset-1 groupeDateLieu">
                        <div class="col-sm-8">
                            <input class="form-control" type="text" name="villeDepart" required="required" id="villeDepart" placeholder="Ville de départ"/>
                        </div>
                        <div class='col-sm-4 input-group date datetimepicker'>
                            <input type='text' id="date_fin" name="date_depart" class="form-control" required="required" placeholder="Date départ + heure" />
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-calendar"></span>
                            </span>
                        </div>
                        <div class="col-sm-8">
                            <input class="form-control" type="text" name="lieuDepart" required="required" id="lieuDepart" placeholder="Lieu de départ"/>
                        </div>
                    </div>
                    <div class="col-sm-10 col-sm-offset-1 groupeDateLieu">
                        <div class="col-sm-8">
                            <input class="form-control" type="text" name="villeArrivee" required="required" id="villeArrivee" placeholder="Ville d'arrivée" value="<?php
                            if ($villeEvenement != NULL) {
                                echo $villeEvenement;
                            }
                            ?>"/>
                        </div>
                        <div class='col-sm-4 input-group date datetimepicker'>
                            <input type='text' id="date_fin" name="date_arrivee" class="form-control" required="required" placeholder="Date arrivée + heure" value="<?php
                            if ($dateDebut != NULL) {
                                echo $dateDebut;
                            }
                            ?>"/>
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-calendar"></span>
                            </span>
                        </div>
                        <div class="col-sm-8">
                            <input class="form-control" type="text" name="lieuArrivee" required="required" id="lieuArrivee" placeholder="Lieu d'arrivée" value="<?php
                            if ($adresse != NULL) {
                                echo $adresse;
                            }
                            ?>"/>
                        </div>
                    </div>
                    <div class="col-sm-10 col-sm-offset-1">
                        <div class="input-group">
                            <div class="col-sm-10" id="ajoutEtape"> 
                                Ajouter une étape
                            </div>
                            <span onclick="ajouterEtape()" class="input-group-addon">
                                <span class="glyphicon glyphicon-plus"></span>
                            </span>
                        </div>
                    </div>
                    <div class="col-sm-10 col-sm-offset-1 groupeDateLieu">
                        <div class="col-sm-8">
                            <input class="form-control" type="text" name="villeDepart" required="required" id="villeDepart" placeholder="Ville etape"/>
                        </div>
                        <div class='col-sm-4 input-group date datetimepicker'>
                            <input type='text' id="date_passage" name="date_passage" class="form-control" required="required" placeholder="Heure passage" />
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-calendar"></span>
                            </span>
                        </div>
                        <div class="col-sm-8">
                            <input class="form-control" type="text" name="lieuPassage" required="required" id="lieuPassage" placeholder="Lieu de passage"/>
                        </div>
                    </div>
                    <div class="col-sm-10 col-sm-offset-1 infosComplementairesProposerTrajet">
                        <div class="col-sm-6">
                            <input class="form-control elementInfoComp" type="number" min="1" name="nbPlaces" required="required" id="nbPlaces" placeholder="Nombre de places"/>
                        </div>
                        <div class="col-sm-6">
                            <input class="form-control elementInfoComp" type="number" min="0" name="retardTolere" required="required" id="retardTolere" placeholder="Retard toléré"/>
                        </div>
                        <div class="col-sm-6">
                            <input class="form-control elementInfoComp" type="text" name="contactPrivilegie" required="required" id="contactPrivilegie" placeholder="Contact privilégié"/>
                        </div>
                        <div class="col-sm-6">
                            <select class="form-control elementInfoComp" id="autoroute" >
                                <option selected disabled>Autoroute</option>
                                <option>Oui</option>
                                <option>Non</option>
                            </select>
                        </div>
                    </div>
                </div>
                <input type="submit" id="submitEventName" class="btn btn-primary" value="Créer trajet"/>
            </form>

        </div>

        <?php include('footer.include.php'); ?>
        <script src="../BootStrap/js/bootstrap.min.js"></script>
    </body>

</html>