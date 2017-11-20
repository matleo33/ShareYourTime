<?php
/**
 * Created by PhpStorm.
 * User: yonnel
 * Date: 17/11/2017
 * Time: 16:21
 */
try
{
    $bdd = new PDO('mysql:host=localhost;dbname=shareyourtime;charset=utf8', 'root', '');

    $requete = $bdd->prepare('INSERT INTO events(nom, description,date_debut,date_fin,adresse,lien_fb,lien_billet,createur)
              VALUES(:nom, :description, :date_debut, :date_fin, :adresse, :lien_fb, :lien_billet, :createur)');
    $requete->execute(array(
        'nom' => $_GET['nom'],
        'description' => $_GET['description'],
        'date_debut' => $_GET['date_debut'],
        'date_fin' => $_GET['date_fin'],
        'adresse' => $_GET['adresse'],
        'lien_fb' => null,
        'lien_billet' => null,
        'createur' => 1));//TODO Recupèrer l'id de l'utilisateur connecté
}
catch (Exception $e)
{
    die('Erreur : ' . $e->getMessage());
}

