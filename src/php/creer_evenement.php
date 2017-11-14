<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <link href="./../css/style.css" rel="stylesheet">

    <!-- Bootstrap-->
    <link rel="stylesheet" href="./../BootStrap/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>

    <title>Share Your Time</title>
</head>

<body>
<?php include 'navbar.include.php'; ?>
<div class="container col-lg-offset-3 col-lg-6 col-md-offset-3 col-md-6 col-sm-offset-2 col-sm-8 col-xs-12" style="text-align: center;background-color: RGB(69,164,247)">
    <h1 style="color: white">CREER EVENEMENT</h1>
    <form action="rechercheEvenement.php" method="post" id="formRecherche">
        <div class="form-group">
            <input class="form-control" id="eventName" placeholder="Nom de l'événement"/>
        </div>
        <input type="submit" id="submitEventName" class="btn btn-primary" value="Suivant"/>
    </form>
    <span id="msg_all"></span>
</div>
<div class="container col-lg-offset-3 col-lg-6 col-md-offset-3 col-md-6 col-sm-offset-2 col-sm-8 col-xs-12" id="containerCreation" style="text-align: center;background-color: RGB(69,164,247);visibility: hidden">
    <form action="rechercheEvenement.php" method="post" id="formRechercheSuite">
        <div class="form-group">
            <input class="form-control" placeholder="Nom de l'événement"/>
        </div>
        <input type="submit" class="btn btn-primary" value="Suivant"/>
    </form>
</div>

<script>
$(function () {
    $('#formRecherche').submit(function (event) {
        var eventName = $('#eventName').val();
        if(eventName == "")
        {
            $('#msg_all').html("Merci de remplir le champ");
        }
        else
        {
            $.ajax({
                type : "POST",
                url: $(this).attr("action"),
                data: $(this).serialize(),
                success : function() {
                    $("#containerCreation").css("visibility", "visible");

                },
                error: function() {
                    $("#formRecherche").html("<p>Erreur d'appel, le formulaire ne peut pas fonctionner</p>");
                }
            });
        }
        return false;
    });
});
</script>

<script src="../BootStrap/js/bootstrap.min.js"></script>
</body>

</html>