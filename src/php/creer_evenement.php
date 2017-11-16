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
<div class="container col-lg-offset-3 col-lg-6 col-md-offset-3 col-md-6 col-sm-offset-2 col-sm-8 col-xs-12" style="text-align: center;background-color: RGB(69,164,247)">
    <h1 style="color: white">CREER EVENEMENT</h1>
    <form id="formRecherche">
        <div class="form-group">
            <input class="form-control" type="text" name="eventName" required="required" id="eventName" placeholder="Nom de l'événement"/>
        </div>
        <input type="submit" id="submitEventName" class="btn btn-primary" value="Suivant"/>
    </form>
    <span id="msg_all"></span>
</div>

<div class="container col-lg-offset-3 col-lg-6 col-md-offset-3 col-md-6 col-sm-offset-2 col-sm-8 col-xs-12" id="containerCreation" style="text-align: center;background-color: RGB(69,164,247);visibility: hidden">
    <form action="rechercheEvenement.php" method="post" id="formRechercheSuite">
        <div class="form-group">
            <input class="form-control" placeholder="Nom de l'événement"/>
            <input class="form-control" id="adressAutoComplete" placeholder="Adresse evenement"/>
        </div>
        <div class='input-group date datetimepicker'>
            <input type='text' class="form-control" placeholder="Date debut + heure"/>
            <span class="input-group-addon">
                <span class="glyphicon glyphicon-calendar"></span>
            </span>
        </div>
        <div class='input-group date datetimepicker'>
            <input type='text' class="form-control" placeholder="Date fin + heure"/>
            <span class="input-group-addon">
                <span class="glyphicon glyphicon-calendar"></span>
            </span>
        </div>
        <input type="submit" class="btn btn-primary" value="Créer"/>
    </form>
</div>


<script type="text/javascript">
    $(function () {
        $('.datetimepicker').datetimepicker({
            locale: 'fr'
        });
    });
</script>

<script>
    $(document).ready(function(e) {
        //e.preventDefault();
        $("#formRecherche").submit(function () {
            $.get("rechercheEvenement.php",$(this).serialize(),function(texte){
                if(texte != '')
                {
                    window.location.href = 'http://localhost:63342/ShareYourTime/src/php/evenement.php?id_events=' + texte;
                }
                else
                {
                    $("#containerCreation").css("visibility", "visible");
                    $("#eventName").attr("disabled","disabled");
                }

            });
            return false; // permet de ne pas recharger la page
        });
    });
</script>

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

<script src="../BootStrap/js/bootstrap.min.js"></script>
</body>

</html>