<?php
/**
 * Created by PhpStorm.
 * User: yonnel
 * Date: 17/11/2017
 * Time: 16:21
 */
session_start();
try
{
    $bdd = new PDO('mysql:host=localhost;dbname=shareyourtime;charset=utf8', 'root', '');

    $requete = $bdd->prepare('INSERT INTO events(nom, description,lien_photo,date_debut,date_fin,adresse,lien_fb,lien_billet,createur)
              VALUES(:nom, :description, :lien_photo, :date_debut, :date_fin, :adresse, :lien_fb, :lien_billet, :createur)');
    $requete->execute(array(
        'nom' => $_SESSION['nom_event'],
        'description' => $_GET['description'],
        'lien_photo' => null,
        'date_debut' => $_GET['date_debut'],
        'date_fin' => $_GET['date_fin'],
        'adresse' => $_GET['adressAutoComplete'],
        'lien_fb' => null,
        'lien_billet' => null,
        'createur' => $_SESSION["ID_USER"]));//TODO Recupèrer l'id de l'utilisateur connecté


    $reponse = $bdd->query('SELECT id_events '
        . 'FROM events '
        . 'WHERE nom=\'' .$_SESSION['nom_event'] . '\'');
    while ($donnees = $reponse->fetch()) {
        $id_event = $donnees[0];

        echo $id_event;

        break;
    }
    unset($_SESSION['nom_event']);
    header('Location: evenement.php?id_events='.$id_event);
}
catch (Exception $e)
{
    die('Erreur : ' . $e->getMessage());
}

