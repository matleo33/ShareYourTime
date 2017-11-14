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

    <title>Share Your Time</title>
</head>

<body>
<?php include 'navbar.include.php'; ?>
<div class="container col-lg-offset-3 col-lg-6 col-md-offset-3 col-md-6 col-sm-offset-2 col-sm-8 col-xs-12" style="text-align: center;background-color: RGB(69,164,247)">
    <h1 style="color: white">CREER EVENEMENT</h1>
    <form id="formRecherche">
        <div class="form-group">
            <input class="form-control" type="text" name="eventName" id="eventName" placeholder="Nom de l'événement"/>
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
    $(document).ready(function(e) {
        e.preventDefault();
        $("#formRecherche").submit(function () {
            $.get("rechercheEvenement.php",$(this).serialize(),function(texte){
                $("#containerCreation").css("visibility", "visible");
            });
            return false; // permet de ne pas recharger la page
        });
    });
</script>


<script src="../BootStrap/js/bootstrap.min.js"></script>
</body>

</html>