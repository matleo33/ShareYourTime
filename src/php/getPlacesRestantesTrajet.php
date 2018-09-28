<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

try {
    $bdd = new PDO('mysql:host=localhost;dbname=shareyourtime;charset=utf8', 'jmcbordeaux_root', 'D0nald&Ch@uve');
} catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
}

function GetPlacesRestantesTrajet($bdd, $id_trajet) {
    $placesReservees = 0;
    $placesRestantes = 0;
    $reponse = $bdd->query('SELECT SUM(nb_place_res) '
                    . 'FROM covoiturage '
                    . 'WHERE trajet = ' . $id_trajet);
    while($donnees = $reponse->fetch()) {
        $placesReservees = $donnees['SUM(nb_place_res)'];
    }
    $reponse->closeCursor();
    $reponse = $bdd->query('SELECT nb_place '
                    . 'FROM trajet '
                    . 'WHERE id_trajet = ' . $id_trajet);
    while($donnees = $reponse->fetch()) {
        $placesRestantes = $donnees['nb_place'] - $placesReservees;
    }
    $reponse->closeCursor();
    return $placesRestantes;
    
}