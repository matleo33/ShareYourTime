<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
function getHasNote($bdd, $id_user) {
    $reponse = $bdd->query('Select * FROM avis WHERE recepteur='.$id_user);
    while($donnees = $reponse->fetch())
    {
        return TRUE;
    }
    return FALSE;
}

function getNote($bdd, $id_user) {
    $reponse = $bdd->query('SELECT AVG(avis.note) '
            . 'FROM avis '
            . 'WHERE recepteur='.$id_user);
    while($donnees = $reponse->fetch())
    {
        return $donnees['AVG(avis.note)'];
    }
}
?>