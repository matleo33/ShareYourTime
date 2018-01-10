<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
/**
 * Retourne vrai si l'utilisateur à eu des avis, faux sinon
 * @param $bdd
 * @param $id_user
 * @return bool
 */
function getHasNote($bdd, $id_user) {
    $reponse = $bdd->query('Select * FROM avis WHERE recepteur='.$id_user);
    while($donnees = $reponse->fetch())
    {
        return TRUE;
    }
    return FALSE;
}

/**
 * Retourne la moyenne de toutes les notes du recepteur
 * @param $bdd
 * @param $id_user
 * @return mixed
 */
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