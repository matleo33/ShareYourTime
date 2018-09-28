<?php
/**
 * Created by PhpStorm.
 * User: yonnel
 * Date: 12/12/2017
 * Time: 19:14
 */
session_start();
/**
 * On vérifie que les données du formulaire envoyées sont correctes
 * @param $donnees
 * @return bool
 */
function donneesCorrectes() {
    if (!isset($_GET['villeDepart'])) {
        return FALSE;
    } else if (!isset ($_GET['lieuDepart'])) {
        return FALSE;
    } else if (!(isset($_GET['date_depart']) && strtotime($_GET['date_depart']) > strtotime ('now'))) {
        return FALSE;
    } else if (!isset ($_GET['villeArrivee'])) {
        return FALSE;
    } else if (!isset ($_GET['lieuArrivee'])) {
        return FALSE;
    } else if (!(isset ($_GET['date_arrivee']) && strtotime($_GET['date_arrivee']) > strtotime ($_GET['date_depart']))) {
        return FALSE;
    } else if (!(isset ($_GET['nbPlaces']) && $_GET['nbPlaces'] > 0)) {
        return FALSE;
    } else if (!isset ($_GET['autoroute'])) {
        return FALSE;
    } else if (!(isset ($_GET['prix_tot']) && $_GET['prix_tot'] > 0)) {
        return FALSE;
    }
    return TRUE;
}

try{
    $bdd = new PDO('mysql:host=localhost;dbname=shareyourtime;charset=utf8', 'jmcbordeaux_root', 'D0nald&Ch@uve');

    //On récupére l'id de notre event pour le lier au trajet
    $reponse = $bdd->query('SELECT id_events '
        . 'FROM events '
        . 'WHERE nom=\'' .$_GET['nom_event'] . '\'');
    $donnees = $reponse->fetch();

    if($donnees && donneesCorrectes())
    {
        $requete = $bdd->prepare('INSERT INTO trajet(ville_depart, lieu_depart,date_depart,ville_arrivee,lieu_arrive,date_arrivee,nb_place,retard,autoroute,prix_tot,est_fini,evenement,chauffeur)
              VALUES(:ville_depart, :lieu_depart, :date_depart, :ville_arrivee, :lieu_arrivee, :date_arrivee, :nb_place, :retard, :autoroute, :prix_tot, :est_fini, :evenement, :chauffeur)');
        $requete->execute(array(
            'ville_depart' => htmlspecialchars($_GET['villeDepart']),
            'lieu_depart' => htmlspecialchars($_GET['lieuDepart']),
            'date_depart' => htmlspecialchars($_GET['date_depart']),
            'ville_arrivee' => htmlspecialchars($_GET['villeArrivee']),
            'date_arrivee' => htmlspecialchars($_GET['date_arrivee']),
            'lieu_arrivee' => htmlspecialchars($_GET['lieuArrivee']),
            'nb_place' => htmlspecialchars($_GET['nbPlaces']),
            'retard' => htmlspecialchars($_GET['retardTolere']),
            'autoroute' => htmlspecialchars($_GET['autoroute']),
            'prix_tot' => htmlspecialchars($_GET['prix_tot']),
            'est_fini' => '0',//Init à 0 quand on le créé
            'evenement' => htmlspecialchars($donnees[0]),
        'chauffeur' => $_SESSION["ID_USER"]));

        echo $bdd->lastInsertId();//On renvoie l'id du trajet créé
    }

}
catch (Exception $e)
{
    die('Erreur : ' . $e->getMessage());
}
?>