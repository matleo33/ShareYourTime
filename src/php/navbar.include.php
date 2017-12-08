<?php
define('pagencours', $_SERVER['PHP_SELF'], true);
$page = explode("/", pagencours);
?>

<?php include 'modal_connexion.include.php' ?>
<?php include 'modal_inscription.include.php' ?>
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
            <a class="navbar-brand" href="<?php if (end($page) == "index.php") {
                echo '#';
            } else {
                echo 'index.php';
            } ?>"><img src="../img/logo.png" class="iconeNavbar" alt="Share Your Time"/></a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <!-- Vérification si la page index.php est la page active -->
                <li class="nav-item <?php if (end($page) == "index.php") {
                    echo 'active';
                } ?>">
                    <a href="<?php if (end($page) == "index.php") {
                        echo '#';
                    } else {
                        echo 'index.php';
                    } ?>">Accueil</a></li>
                <!-- Vérification si la page proposer_trajet.php est la page active -->
                <li class="nav-item <?php if (end($page) == "proposer_trajet.php") {
                    echo 'active';
                } ?>">
                    <a href="<?php if (end($page) == "proposer_trajet.php") {
                        echo '#';
                    } else {
                        echo 'proposer_trajet.php';
                    } ?>">Proposer trajet</a></li>
                <!-- Vérification si la page creer_evenement.php est la page active -->
                <li class="nav-item <?php if (end($page) == "creer_evenement.php") {
                    echo 'active';
                } ?>">
                    <a href="<?php if (end($page) == "creer_evenement.php") {
                        echo '#';
                    } else {
                        echo 'creer_evenement.php';
                    } ?>">Créer événement</a></li>
            </ul>

            <?php
            if (isset($_SESSION["ID_USER"])) {
                echo '<ul class="nav navbar-nav navbar-right">';
                echo '<li class="dropdown">';
                echo '<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">';
                echo $_COOKIE["NOM_USER"] .= " ";
                echo '<span class="caret"></span></a>';
                echo '<ul class="dropdown-menu">';
                echo '<li><a href="profil.php?id_profil=' . $_SESSION["ID_USER"] . '">Profil</a></li>';
                echo '<li><a href="#">Mes trajets</a></li>';
                echo '<li><a href="traiter_deconnexion.php">Déconnexion</a></li>';
                echo '</ul>';
                echo '</li>';
                echo '</ul>';
            } else {
                echo '<ul class="nav navbar-nav navbar-right">';
                echo '<li class="nav-item" data-toggle="modal" data-target="#modalInscription"><a href="#">Inscription</a></li>';
                echo '<li class="nav-item" data-toggle="modal" data-target="#modalConnexion"><a href="#">Connexion</a></li>';
                echo '</ul>';
            }
            ?>
            <ul class="nav navbar-nav navbar-right">
                <form class="form-inline navbar-form" id="formRechercheNavbar">
                    <div class="form-group inline-form col-sm-1 col-md-12">
                        <input name="eventName" class="form-control mr-sm-2" type="text"
                               placeholder="Recherche événement" id="tags">
                        <button class="btn btn-primary" type="submit">Rechercher</button>
                    </div>
                </form>
            </ul>
        </div>
    </div>
</nav>

<script>

</script>