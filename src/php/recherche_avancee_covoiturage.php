<?php
/**
 * Created by PhpStorm.
 * User: yonnel
 * Date: 06/12/2017
 * Time: 10:05
 */
session_start();
include 'getNote.php';
$covoit_event = array();
$compt = 1;
//$nom_event = '';
try
{
    $bdd = new PDO('mysql:host=localhost;dbname=shareyourtime;charset=utf8', 'root', '');

    $requete = "SELECT DISTINCT evenement, chauffeur, ville_depart, date_depart, ville_arrivee, date_arrivee, autoroute, prix_tot, id_trajet FROM trajet INNER JOIN covoiturage ";

    if($_GET['optpeageradio'] == 'pasimportantpeage')
    {
        $requete .= 'WHERE 1 ';
    }
    else if ($_GET['optpeageradio'] == 'avecpeage')
    {
        $requete .= 'WHERE trajet.autoroute = 1 ';
    }
    else if ($_GET['optpeageradio'] == 'sanspeage')
    {
        $requete .= 'WHERE trajet.autoroute = 0 ';
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

    if($_GET['date_depart'] != '')
    {
        $date_depart_fr = $_GET['date_depart'];
        $date_depart_us = date('Y-m-d', strtotime(str_replace('/', '-', $date_depart_fr)));
        $requete.= "&& CAST(date_depart AS DATE) =\"". $date_depart_us . "\" ";
    }

    if($_GET['date_arrivee'] != '')
    {
        $date_arrivee_fr = $_GET['date_arrivee'];
        $date_arrivee_us = date('Y-m-d', strtotime(str_replace('/', '-', $date_arrivee_fr)));
        $requete.= "&& CAST(date_arrivee AS DATE) =\"". $date_arrivee_us . "\" ";
    }

    if(isset($_GET["nom_event"]))
    {
        $requete.= "&& trajet.evenement = (SELECT events.id_events FROM events WHERE events.nom = '".$_GET["nom_event"]."') ";
    }

    //Gestion des ORDER BY
    switch ($_GET["mode_order"])
    {
        case "date_dep_ASC":
            $requete.= "ORDER BY date_depart ASC";
            break;
        case "date_dep_DESC":
            $requete.= "ORDER BY date_depart DESC";
            break;
        case "date_arr_DESC":
            $requete.= "ORDER BY date_arrivee DESC";
            break;
        case "date_arr_ASC":
            $requete.= "ORDER BY date_arrivee ASC";
            break;
        case "prix_DESC":
            $requete.= "ORDER BY prix_tot DESC";
            break;
        case "prix_ASC":
            $requete.= "ORDER BY prix_tot ASC";
            break;
        case "note_DESC":
            $requete.= "ORDER BY (SELECT AVG(avis.note) FROM avis WHERE avis.recepteur=trajet.chauffeur) DESC";
            break;
        case "note_ASC":
            $requete.= "ORDER BY (SELECT AVG(avis.note) FROM avis WHERE avis.recepteur=trajet.chauffeur) ASC";
            break;
    }

    $reponse = $bdd->query($requete);

    while ($donnees = $reponse->fetch()) {

        $note_chauffeur = 0;
        $$compt = array();
        $requete2 = "SELECT users.nom, prenom, id_users FROM users WHERE id_users = ".$donnees["chauffeur"];
        $reponse2 = $bdd->query($requete2);

        $donnees_user = $reponse2->fetch();

        if(getHasNote($bdd,$donnees_user["id_users"])==TRUE)
        {
            $note_chauffeur = getNote($bdd,$donnees_user["id_users"]);
        }

        if($donnees_user)
        {
            array_push($$compt, $donnees_user[0],
                $donnees_user["prenom"],
                $note_chauffeur);

            array_push($$compt,
                $donnees["ville_depart"],
                $donnees["date_depart"],
                $donnees["ville_arrivee"],
                $donnees["date_arrivee"],
                $donnees["autoroute"],
                $donnees["prix_tot"],
                $donnees["id_trajet"]);
            array_push($covoit_event,$$compt);
            $compt++;
        }


    }
    echo json_encode(array_values($covoit_event));
}
catch (Exception $e)
{
    //die('Erreur : ' . $e->getMessage());
    echo $e->getMessage();
}

?>