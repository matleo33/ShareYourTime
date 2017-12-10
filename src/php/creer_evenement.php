<?php session_start(); ?>
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
    <script src="../js/datetimepicker.js"></script>
    <script src="../js/creer_evenement.js"></script>

    <!-- API Google -->
    <script src="https://maps.googleapis.com/maps/api/js?libraries=places&amp;key=AIzaSyC5VG6abk2Aio0RS7MBAbbN8N-FZxTrD84" type="text/javascript"></script>


    <!-- Library DateTimePicker -->
    <link href="../BootStrap/css/bootstrap-datetimepicker.min.css" rel="stylesheet" media="screen">
    <script type="text/javascript" src="../BootStrap/js/bootstrap-datetimepicker.js" charset="UTF-8"></script>
    <script type="text/javascript" src="../BootStrap/js/locales/bootstrap-datetimepicker.fr.js" charset="UTF-8"></script>

    <title>Share Your Time</title>
</head>

<body>
<?php include 'navbar.include.php'; ?>
<div class="container col-lg-offset-3 col-lg-6 col-md-offset-3 col-md-6 col-sm-offset-2 col-sm-8 col-xs-12" id="divRecherche">
    <h1 id="titreBlanc">CREER EVENEMENT</h1>
    <form id="formRecherche">
        <div class="form-group">
            <input class="form-control" type="text" name="eventName" required="required" id="eventName" placeholder="Nom de l'événement"/>
        </div>
        <input type="submit" id="submitEventName" class="btn btn-primary" value="Suivant"/>
    </form>
</div>

<div class="container col-lg-offset-3 col-lg-6 col-md-offset-3 col-md-6 col-sm-offset-2 col-sm-8 col-xs-12" id="containerCreation">
    <form id="formRechercheSuite" method="get" action="inserer_evenement_BD.php">
        <div class="form-group">
            <div class="input-group image-preview">
                <input type="text" class="form-control image-preview-filename" required="required" placeholder="Photo de l'événement" disabled="disabled"> <!-- don't give a name === doesn't send on POST/GET -->
                <span class="input-group-btn">
                    <!-- image-preview-clear button -->
                    <button type="button" id="boutonSupprimer" class="btn btn-default image-preview-clear">
                        <span class="glyphicon glyphicon-remove"></span> Supprimer
                    </button>
                    <!-- image-preview-input -->
                    <div class="btn btn-default image-preview-input">
                        <span class="glyphicon glyphicon-folder-open"></span>
                        <span class="image-preview-input-title">Parcourir</span>
                        <input type="file" id="lien_photo" accept="image/png, image/jpeg, image/gif" name="input-file-preview"/> <!-- rename it -->
                    </div>
                </span>
            </div>
            <input class="form-control" id="adressAutoComplete"  name="adressAutoComplete" required="required" placeholder="Adresse evenement"/>
            <div class='input-group date datetimepicker'>
                <input type='text' id="date_debut" name="date_debut" class="form-control" required="required" placeholder="Date debut + heure"/>
                <span class="input-group-addon">
                    <span class="glyphicon glyphicon-calendar"></span>
                </span>
            </div>
            <div class='input-group date datetimepicker'>
                <input type='text' id="date_fin" name="date_fin" class="form-control" required="required" placeholder="Date fin + heure"/>
                <span class="input-group-addon">
                    <span class="glyphicon glyphicon-calendar"></span>
                </span>
            </div>
            <!-- TODO réparer pattern facebook qui fonctionne pas -->
            <input id="lien_fb" name="lien_fb" class="form-control" pattern="[https://www.facebook.com/events/]{1-0}[/]" placeholder="Lien facebook">
            <input id="lien_billet" name="lien_billet" class="form-control" placeholder="Lien billeterie">
            <textarea id="description" name="description" class="form-control" required="required" placeholder="Description"></textarea>
        </div>
        <input type="submit" class="btn btn-primary" value="Créer"/>
    </form>
</div>

<!-- TODO Déplacer l'autocompletion GoogleMaps dans un fichier js -->
<script>
    function initializeAutocomplete(id) {
        var element = document.getElementById(id);
        if (element) {
            var autocomplete = new google.maps.places.Autocomplete(element, { types: ['geocode'] });
            google.maps.event.addListener(autocomplete, 'place_changed', onPlaceChanged);
        }
    }
    google.maps.event.addDomListener(window, 'load', function() {
        initializeAutocomplete('adressAutoComplete');
    });
</script>

<?php include 'footer.include.php';?>
<script src="../BootStrap/js/bootstrap.min.js"></script>
</body>

</html>