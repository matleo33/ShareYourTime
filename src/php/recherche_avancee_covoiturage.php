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

    $requete = "SELECT DISTINCT users.nom, prenom, ville_depart, date_depart, ville_arrivee, date_arrivee, autoroute, prix_tot, personnalite FROM users INNER JOIN trajet INNER JOIN events";

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
            $donnees["personnalite"]);
        array_push($covoit_event,$$compt);
        $compt++;
    }
    echo json_encode(array_values($covoit_event));
    //var_dump($covoit_event, json_encode($covoit_event));

}
catch (Exception $e)
{
    die('Erreur : ' . $e->getMessage());
}


?>