<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function getNbReservants($bdd, $id_trajet) {
    $reponse = $bdd->query('Select COUNT(*) '
            . 'FROM trajet INNER JOIN covoiturage on trajet.id_trajet=covoiturage.trajet '
            . 'WHERE trajet='.$id_trajet);
    while($donnees = $reponse->fetch())
    {
        return $donnees['COUNT(*)'];
    }
    return 0;
}