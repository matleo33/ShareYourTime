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
<div class="container-fluid">
        <div class="container col-lg-offset-3 col-lg-6 col-md-offset-3 col-md-6 col-sm-offset-2 col-sm-8 col-xs-12" id="divProposerTrajet">
            <h1 id="titreBlanc">PROPOSER UN TRAJET</h1>
            <form method="post" id="formTrajet">
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
                <input type="submit" id="submitEventName" class="btn btn-primary" value="Suivant" onclick="verification_event()"/>
                </form>
        </div>
    <div class="container col-lg-offset-3 col-lg-6 col-md-offset-3 col-md-6 col-sm-offset-2 col-sm-8 col-xs-12" id="divInfoTrajet" style="text-align: center;background-color: RGB(69, 164, 247);visibility: hidden;">
                <form id="information_trajet_form" >
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
                            <span onclick="afficherModalAjoutEtape()" class="input-group-addon" style="cursor: pointer;">
                                <span class="glyphicon glyphicon-plus"></span>
                            </span>
                        </div>
                        <div>
                            <table class="table table-bordered" style="background-color: white">
                                <thead>
                                <tr>
                                    <th>Ville</th>
                                    <th>Lieu</th>
                                    <th>Heure</th>
                                </tr>
                                </thead>
                                <tbody id="tableau_etape">

                                </tbody>
                            </table>
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
                <input type="submit" id="submitTrajet" class="btn btn-primary" value="Créer trajet"/>
            </form>

        </div>
</div>

        <div class="modal fade" id="modalAjoutEtape" role="dialog" data-keyboard="false" data-backdrop="static">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Ajout d'une étape</h4>
                    </div>
                    <form>
                        <div class="form-group col-sm-10 col-sm-offset-1" style="margin-top: 5px">
                            <input class="form-control" type="text" name="ville_depart" required="required" id="ville_depart" placeholder="Ville etape"/>
                        </div>
                        <div class="form-group col-sm-10 col-sm-offset-1">
                            <input class="form-control" type="text" name="lieuPassage" required="required" id="lieuPassage" placeholder="Lieu de passage"/>
                        </div>
                        <div class='form-group col-sm-10 col-sm-offset-1 input-group date datetimepicker'>
                            <input type='text' id="date_passage" name="date_passage" class="form-control" required="required" placeholder="Heure passage" />
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-calendar"></span>
                            </span>
                        </div>

                        <div class="modal-footer">
                            <input type="submit" class="btn btn-default center-block" onclick="ajouterEtape();return false;" value="Ajouter l'étape" id="inputConnexion"/>
                        </div>
                    </form>
                </div>

            </div>
        </div>

        <?php include('footer.include.php'); ?>
        <script src="../BootStrap/js/bootstrap.min.js"></script>
    </body>

</html>

<script>
    var etape = [];
    var compteur = 0;
    function afficherModalAjoutEtape() {
        $("#modalAjoutEtape").modal('show');
    }
    function ajouterEtape() {
        var newEtape = [];
        //var id_ligne_tr = "tr"+compteur;
        newEtape.push(document.getElementById("ville_depart").value,document.getElementById("lieuPassage").value,document.getElementById("date_passage").value)
        etape.push(newEtape);
        document.getElementById("tableau_etape").innerHTML += '<tr id="tr'+compteur+'"><td>'+document.getElementById("ville_depart").value+
            '</td><td>'+document.getElementById("lieuPassage").value+
            '</td><td>'+document.getElementById("date_passage").value+'</td><td>' +
             '<input type="button" onclick="supprimer_etape('+compteur+')"/></td></tr>';

    document.getElementById("ville_depart").value = '';
        document.getElementById("lieuPassage").value = '';
        document.getElementById("date_passage").value = '';
        $("#modalAjoutEtape").modal('hide');
        compteur++;
    }
    function supprimer_etape(id) {
        var obj = document.getElementById("tableau_etape");
        var old = document.getElementById("tr"+id);

        obj.removeChild(old);
        delete etape[id];
    }

    function verification_event() {
        $(document).ready(function(e) {
            $("#formTrajet").submit(function () {
                $.get("rechercheEvenement.php",$(this).serialize(),function(id){
                    if(id != '')
                    {
                        $("#divInfoTrajet").css("visibility", "visible");
                        $("#eventName").attr("disabled","disabled");//TODO Faire avec readonly au lieu de disabled
                        eventName = $("#eventName").val();

                        document.getElementById("formTrajet").removeChild(document.getElementById("submitEventName"));
                    }
                    else
                    {
                        var currentLocation =  document.location.href;
                        currentLocation = currentLocation.substring( 0 ,currentLocation.lastIndexOf( "src" ) );
                        currentLocation += 'src/php/creer_evenement.php?nom_event=' + $("#eventName").val();
                        window.location.href = currentLocation ;
                    }

                });
                return false; // permet de ne pas recharger la page
            });
        });

    }

</script>