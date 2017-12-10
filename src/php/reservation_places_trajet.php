<?php
include 'getPlacesRestantesTrajet.php';
session_start();

function verificationChamps() {
    //isset + bons types
    if ((isset($_POST['idTrajet']) && isset($_POST['idReservant']) && isset($_POST['nombrePlacesReservees'])) != TRUE) {
        echo 'pas set';
        return FALSE;
    }
    if(($_POST['idTrajet'])<=0 || $_POST['idReservant']<=0 || $_POST['nombrePlacesReservees'] <0) {
        echo "pas sup 0";
        return FALSE;
    }
    return TRUE;
}

function verificationConditions($bdd) {
    //nb places reservees <= nbplacesdispo
    if (GetPlacesRestantesTrajet($bdd, $_POST['idTrajet']) < $_POST['nombrePlacesReservees']) {
        echo 'Trop de places réservées';
        return FALSE;
    }
    return TRUE;
}

try {
    $bdd = new PDO('mysql:host=localhost;dbname=shareyourtime;charset=utf8', 'root', '');
} catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
}
if (verificationChamps() && verificationConditions($bdd)) {
    $query = 'INSERT INTO covoiturage(trajet, users, nb_place_res) '
            . 'VALUES( \'' . $_POST['idTrajet'] . '\', \'' . $_POST['idReservant'] . '\', \'' . $_POST['nombrePlacesReservees'] . '\')';
    echo $query;
    $bdd->exec($query);
}

/*<form method="post" action="reservationPlacesTrajet.php">
                            <input type="number" min="0" max="<?php echo $donnees['nb_place']; ?>" style="width: 50px;" />
                            <button>Je reserve</button>
                            </form>*/