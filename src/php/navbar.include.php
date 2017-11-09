<?php define('pagencours', $_SERVER['PHP_SELF'], true)
echo pagencours?>

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
                <li class="nav-item active"><a href="index.php">Accueil</a></li>
                <li class="nav-item"><a href="proposer_trajet.php">Proposer trajet</a></li>
                <li class="nav-item"><a href="creer_evenement.php">Créer événement</a></li>
            </ul>
        </div>
    </div>
</nav>