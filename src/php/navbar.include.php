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
                <!-- Vérification si la page index.php est la page active -->
                <li class="nav-item <?php if (end($page) == "index.php") { echo 'active'; } ?>">
                    <a href="<?php if (end($page) == "index.php") { echo '#'; } else { echo 'index.php'; } ?>">Accueil</a></li>
                <!-- Vérification si la page proposer_trajet.php est la page active -->
                <li class="nav-item <?php if (end($page) == "proposer_trajet.php") {echo 'active'; } ?>">
                    <a href="<?php if (end($page) == "proposer_trajet.php") { echo '#'; } else { echo 'proposer_trajet.php'; } ?>">Proposer trajet</a></li>
                <!-- Vérification si la page creer_evenement.php est la page active -->
                <li class="nav-item <?php if (end($page) == "creer_evenement.php") { echo 'active'; } ?>">
                    <a href="<?php if (end($page) == "creer_evenement.php") { echo '#'; } else { echo 'creer_evenement.php'; } ?>">Créer événement</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <form class="form-inline navbar-form navbar-left">
                    <div class="form-group inline-form col-sm-1 col-md-12">
                        <input class="form-control mr-sm-2" type="text" placeholder="Recherche trajet" id="tags">
                        <button class="btn btn-outline-success" type="submit">Rechercher</button>
                    </div>
                </form>
                <li class="nav-item" data-toggle="modal" data-target="#modalConnexion"><a href="#">Connexion</a></li>
                <li class="nav-item" data-toggle="modal" data-target="#modalInscription"><a href="#">Inscription</a></li>
            </ul>
        </div>
    </div>
</nav>
<?php include 'modal_connexion.include.php' ?>
<?php include 'modal_inscription.include.php' ?>