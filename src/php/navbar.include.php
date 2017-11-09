<?php
define('pagencours', $_SERVER['PHP_SELF'], true);
$page = explode("/", pagencours);
?>

<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Barre de navigation déroulante</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">Share Your Time</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <li class="nav-item <?php if(end($page) == "index.php") { echo 'active' ; }?>">
                    <a href="index.php">Accueil</a></li>
                <li class="nav-item <?php if(end($page) == "proposer_trajet.php") { echo 'active' ; }?>">
                    <a href="proposer_trajet.php">Proposer trajet</a></li>
                <li class="nav-item <?php if(end($page) == "creer_evenement.php") { echo 'active' ; }?>">
                    <a href="creer_evenement.php">Créer événement</a></li>
            </ul>
            <form class="form-inline my-2 my-lg-0">
                <input class="form-control mr-sm-2" type="text" placeholder="Rechercher">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Rechercher</button>
            </form>
        </div>
    </div>
</nav>
<script src="../js/jquery-3.2.1.min.js"></script>