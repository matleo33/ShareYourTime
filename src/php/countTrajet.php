<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function countTrajet($bdd, $id_event) {
    $reponse = $bdd->query('Select COUNT(*) FROM trajet WHERE evenement='.$id_event);
    while($donnees = $reponse->fetch())
    {
        return $donnees['COUNT(*)'];
    }
    return 0;
}