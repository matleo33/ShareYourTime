<?php
define('pagencours', $_SERVER['PHP_SELF'], true);
$page = explode("/", pagencours);
?>

<link href="./../css/style.css" rel="stylesheet">
<nav class="navbar navbar-default navbar-fixed-top">
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
            <style>
                .ui-autocomplete {
                    position: absolute;
                    top: 100%;
                    left: 0;
                    z-index: 1000;
                    float: left;
                    display: none;
                    min-width: 160px;
                    _width: 160px;
                    padding: 4px 0;
                    margin: 2px 0 0 0;
                    list-style: none;
                    background-color: #ffffff;
                    border-color: #ccc;
                    border-color: rgba(0, 0, 0, 0.2);
                    border-style: solid;
                    border-width: 1px;
                    -webkit-border-radius: 5px;
                    -moz-border-radius: 5px;
                    border-radius: 5px;
                    -webkit-box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
                    -moz-box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
                    box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
                    -webkit-background-clip: padding-box;
                    -moz-background-clip: padding;
                    background-clip: padding-box;
                    *border-right-width: 2px;
                    *border-bottom-width: 2px;
                }
                .ui-autocomplete .ui-menu-item > a.ui-corner-all {
                    display: block;
                    padding: 3px 15px;
                    clear: both;
                    font-weight: normal;
                    line-height: 18px;
                    color: #555555;
                    white-space: nowrap;
                }
                .ui-autocomplete .ui-menu-item > a.ui-corner-all.ui-state-hover, .ui-autocomplete .ui-menu-item > a.ui-corner-all.ui-state-active {
                    color: #ffffff;
                    text-decoration: none;
                    background-color: #0088cc;
                    border-radius: 0px;
                    -webkit-border-radius: 0px;
                    -moz-border-radius: 0px;
                    background-image: none;
                }
                .ui-autocomplete .ui-menu-item:hover {
                    background-color: RGB(69,164,247);
                    color: white;
                }
            </style>
            <ul class="nav navbar-nav navbar-right">
                <form class="form-inline navbar-form navbar-left">
                    <div class="form-group inline-form col-sm-1 col-md-12">
                        <input class="form-control mr-sm-2" type="text" placeholder="Recherche trajet" id="tags">
                        <button class="btn btn-primary" type="submit">Rechercher</button>
                    </div>
                </form>
                <li class="nav-item" data-toggle="modal" data-target="#modalConnexion"><a href="#">Connexion</a></li>
                <li class="nav-item" data-toggle="modal" data-target="#modalInscription"><a href="#">Inscription</a></li>
            </ul>
        </div>
    </div>
</nav>