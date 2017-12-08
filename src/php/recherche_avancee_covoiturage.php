<?php
/**
 * Created by PhpStorm.
 * User: yonnel
 * Date: 06/12/2017
 * Time: 10:05
 */

session_start();
$covoit_event = array();
$compt = 1;
try
{
    $bdd = new PDO('mysql:host=localhost;dbname=shareyourtime;charset=utf8', 'root', '');

    $requete = "SELECT DISTINCT users.nom, prenom, ville_depart, date_depart, ville_arrivee, date_arrivee, autoroute, prix_tot, personnalite, id_trajet FROM trajet INNER JOIN covoiturage INNER JOIN users INNER JOIN events ";

    if($_GET['optpeageradio'] == 'pasimportantpeage')
    {
        $requete .= 'WHERE 1 ';
    }
    else if ($_GET['optpeageradio'] == 'avecpeage')
    {
        $requete .= 'WHERE trajet.autoroute == 1 ';
    }
    else if ($_GET['optpeageradio'] == 'sanspeage')
    {
        $requete .= 'WHERE trajet.autoroute == 0 ';
    }

    if($_GET['ville_depart'] != '')
    {
        $requete .= "&& trajet.ville_depart = '". $_GET['ville_depart']. "' ";
    }
    if($_GET['ville_arrivee'] != '')
    {
        $requete .= "&& trajet.ville_arrivee = '". $_GET['ville_arrivee']. "' ";
    }

    if($_GET['prix'] != '')
    {
        $requete .= "&& trajet.prix_tot =". $_GET['prix']. " ";
    }

    if($_GET['nombre_voyageur'] != '')
    {
        $requete .= "&& ".  $_GET['nombre_voyageur'] . " <= trajet.nb_place - covoiturage.nb_place_res ";
    }


    $reponse = $bdd->query($requete);

    while ($donnees = $reponse->fetch()) {
        $$compt = array();
        array_push($$compt, $donnees["nom"],
            $donnees["prenom"],
            $donnees["ville_depart"],
            $donnees["date_depart"],
            $donnees["ville_arrivee"],
            $donnees["date_arrivee"],
            $donnees["autoroute"],
            $donnees["prix_tot"],
            $donnees["personnalite"],
            $donnees["id_trajet"]);
        array_push($covoit_event,$$compt);
        $compt++;
    }
    echo json_encode(array_values($covoit_event));
}
catch (Exception $e)
{
    die('Erreur : ' . $e->getMessage());
}


?>