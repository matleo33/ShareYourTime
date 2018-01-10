<?php session_start(); ?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="iso-8859-1" />
    <link href="./../css/style.css" rel="stylesheet">

    <!-- Bootstrap-->
    <link rel="stylesheet" href="./../BootStrap/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="../js/recherche.js"></script>
    <script src="../js/chercher_adresse.js"></script>
    <script src="../js/connexion.js"></script>

    <!-- Library DateTimePicker -->
    <link href="../BootStrap/css/bootstrap-datetimepicker.min.css" rel="stylesheet" media="screen">
    <script type="text/javascript" src="../BootStrap/js/bootstrap-datetimepicker.js" charset="UTF-8"></script>
    <script type="text/javascript" src="../BootStrap/js/locales/bootstrap-datetimepicker.fr.js"
            charset="UTF-8"></script>

    <title>Share Your Time</title>
</head>

<body>
<?php include 'navbar.include.php'; ?>
    <div class="container-fluid">
<?php include 'carousel.include.php'; ?>
<?php include 'top_3_evenement.include.php'; ?>
    </div>
<?php include 'footer.include.php'; ?>

<script src="../BootStrap/js/bootstrap.min.js"></script>
<script src="../js/datetimepicker.js"></script>
</body>


</html>