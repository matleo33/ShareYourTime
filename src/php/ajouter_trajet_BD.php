<?php
/**
 * Created by PhpStorm.
 * User: yonnel
 * Date: 12/12/2017
 * Time: 19:14
 */
session_start();

try{
    $bdd = new PDO('mysql:host=localhost;dbname=shareyourtime;charset=utf8', 'root', '');

    $reponse = $bdd->query('SELECT id_events '
        . 'FROM events '
        . 'WHERE nom=\'' .$_GET['nom_event'] . '\'');
    $donnees = $reponse->fetch();

    if($donnees)
    {
        $requete = $bdd->prepare('INSERT INTO trajet(ville_depart, lieu_depart,date_depart,ville_arrivee,lieu_arrive,date_arrivee,nb_place,retard,contact,autoroute,prix_tot,est_fini,evenement,chauffeur)
              VALUES(:ville_depart, :lieu_depart, :date_depart, :ville_arrivee, :lieu_arrivee, :date_arrivee, :nb_place, :retard, :contact, :autoroute, :prix_tot, :est_fini, :evenement, :chauffeur)');
        $requete->execute(array(
            'ville_depart' => $_GET['villeDepart'],
            'lieu_depart' => $_GET['lieuDepart'],
            'date_depart' => $_GET['date_depart'],
            'ville_arrivee' => $_GET['villeArrivee'],
            'date_arrivee' => $_GET['date_arrivee'],
            'lieu_arrivee' => $_GET['lieuArrivee'],
            'nb_place' => $_GET['nbPlaces'],
            'retard' => $_GET['retardTolere'],
            'contact' => $_GET['contactPrivilegie'],
            'autoroute' => $_GET['autoroute'],
            'prix_tot' => $_GET['prix_tot'],
            'est_fini' => '0',
            'evenement' => $donnees[0],
        'chauffeur' => 1));//TODO Recupèrer l'id de l'utilisateur connecté$_SESSION["ID_USER"]

        echo $bdd->lastInsertId();
    }

}
catch (Exception $e)
{
    die('Erreur : ' . $e->getMessage());
}
?>