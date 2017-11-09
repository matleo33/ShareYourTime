<?php
define('pagencours', $_SERVER['PHP_SELF'], true);
$page = explode("/", pagencours);
?>

<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar"
                    aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Barre de navigation déroulante</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">Share Your Time</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <li class="nav-item <?php if (end($page) == "index.php") {
                    echo 'active';
                } ?>">
                    <a href="index.php">Accueil</a></li>
                <li class="nav-item <?php if (end($page) == "proposer_trajet.php") {
                    echo 'active';
                } ?>">
                    <a href="proposer_trajet.php">Proposer trajet</a></li>
                <li class="nav-item <?php if (end($page) == "creer_evenement.php") {
                    echo 'active';
                } ?>">
                    <a href="creer_evenement.php">Créer événement</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <form class="form-inline navbar-form navbar-left">
                    <div class="form-group inline-form col-sm-1 col-md-12">
                        <input class="form-control mr-sm-2" type="text" placeholder="Rechercher">
                        <button class="btn btn-outline-success" type="submit">Rechercher</button>
                    </div>
                </form>
                <li class="nav-item"><a href="">Connexion</a></li>
            </ul>
        </div>
    </div>
</nav>
<script src="../js/jquery-3.2.1.min.js"></script>