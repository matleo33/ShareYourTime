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
</div>

<div class="container col-lg-offset-3 col-lg-6 col-md-offset-3 col-md-6 col-sm-offset-2 col-sm-8 col-xs-12" id="containerCreation" style="text-align: center;background-color: RGB(69,164,247);visibility: hidden">
    <form id="formRechercheSuite">
        <div class="form-group">
            <div class="input-group image-preview">
                <input type="text" class="form-control image-preview-filename" required="required" placeholder="Photo de l'événement" disabled="disabled"> <!-- don't give a name === doesn't send on POST/GET -->
                <span class="input-group-btn">
                    <!-- image-preview-clear button -->
                    <button type="button" class="btn btn-default image-preview-clear" style="display:none;">
                        <span class="glyphicon glyphicon-remove"></span> Supprimer
                    </button>
                    <!-- image-preview-input -->
                    <div class="btn btn-default image-preview-input">
                        <span class="glyphicon glyphicon-folder-open"></span>
                        <span class="image-preview-input-title">Parcourir</span>
                        <input type="file" accept="image/png, image/jpeg, image/gif" name="input-file-preview"/> <!-- rename it -->
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
            <textarea id="description" name="description" class="form-control" required="required" placeholder="Description"
                      style="max-width: 650px"></textarea>
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
    var eventName;
    $(document).ready(function(e) {
        //e.preventDefault();
        $("#formRecherche").submit(function () {
            $.get("rechercheEvenement.php",$(this).serialize(),function(texte){
                if(texte != '')
                {
                    //TODO Changer l'adresse en utilisant les variables PHP pour récupérer le chemin complet
                    var currentLocation =  document.location.href;
                    currentLocation = currentLocation.substring( 0 ,currentLocation.lastIndexOf( "src" ) );
                    currentLocation += 'src/php/evenement.php?id_events=' + texte;
                    window.location.href = currentLocation ;
                    //window.location.href = 'http://localhost:63342/ShareYourTime/src/php/evenement.php?id_events=' + texte;
                }
                else
                {
                    $("#containerCreation").css("visibility", "visible");
                    $("#eventName").attr("disabled","disabled");//TODO Faire avec readonly au lieu de disabled
                    eventName = $("#eventName").val();
                }

            });
            return false; // permet de ne pas recharger la page
        });
    });
    $(document).ready(function(e) {
        //e.preventDefault();
        $("#formRechercheSuite").submit(function () {
            $.ajax({
                url : "inserer_evenement_BD.php",
                type : 'GET',//Impossible à faire marcher en POST
                data : 'nom=' + eventName +
                '&description=' + $("#description").val() +
                '&date_debut=' + $("#date_debut").val() +
                '&date_fin=' + $("#date_fin").val() +
                '&lien_fb=' + $("#lien_fb").val() +
                '&lien_billet=' + $("#lien_billet").val() +
                '&adresse=' + $("#adressAutoComplete").val(),
                dataType : 'html',
                success : function(){
                    //TODO Creer le pop-up indiquant la création de l'event et permettant d'y accéder
                },
                error : function () {
                    //TODO Faire ce qu'il faut lorsque qu'il y a une erreur dans la réponse du PHP
                }
            });
            return false;
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

<script>
    $(document).on('click', '#close-preview', function(){
        $('.image-preview').popover('hide');
        // Hover befor close the preview
        $('.image-preview').hover(
            function () {
                $('.image-preview').popover('show');
            },
            function () {
                $('.image-preview').popover('hide');
            }
        );
    });

    $(function() {
        // Create the close button
        var closebtn = $('<button/>', {
            type:"button",
            text: 'x',
            id: 'close-preview',
            style: 'font-size: initial;',
        });
        closebtn.attr("class","close pull-right");
        // Set the popover default content
        $('.image-preview').popover({
            trigger:'manual',
            html:true,
            title: "<strong>Aperçu</strong>"+$(closebtn)[0].outerHTML,
            content: "There's no image",
            placement:'bottom'
        });
        // Clear event
        $('.image-preview-clear').click(function(){
            $('.image-preview').attr("data-content","").popover('hide');
            $('.image-preview-filename').val("");
            $('.image-preview-clear').hide();
            $('.image-preview-input input:file').val("");
            $(".image-preview-input-title").text("Parcourir");
        });
        // Create the preview image
        $(".image-preview-input input:file").change(function (){
            var img = $('<img/>', {
                id: 'dynamic',
                width:250,
                height:200
            });
            var file = this.files[0];
            var reader = new FileReader();
            // Set preview image into the popover data-content
            reader.onload = function (e) {
                $(".image-preview-input-title").text("Changer");
                $(".image-preview-clear").show();
                $(".image-preview-filename").val(file.name);
                img.attr('src', e.target.result);
                $(".image-preview").attr("data-content",$(img)[0].outerHTML).popover("show");
            }
            reader.readAsDataURL(file);
        });
    });
</script>


<script src="../BootStrap/js/bootstrap.min.js"></script>
</body>

</html>