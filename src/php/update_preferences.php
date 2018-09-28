<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

session_start();

try {
    $bdd = new PDO('mysql:host=localhost;dbname=jmcbordeaux_shareyourtime;charset=utf8', 'jmcbordeaux_root', 'D0nald&Ch@uve');
} catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
}
if ($_POST['animaux'] == 'Non') {
    $animaux = '0';
} else {
    $animaux = '1';
}

if ($_POST['fumeur'] == 'Non') {
    $fumeur = '0';
} else {
    $fumeur = '1';
}

if ($_POST['musique'] == 'Non') {
    $musique = '0';
} else {
    $musique = '1';
}

$query = 'UPDATE users '
        . 'SET animaux=\'' . $animaux . '\', fumeur=\'' . $fumeur . '\', musique=\'' . $musique . '\' '
        . 'WHERE id_users=' . $_SESSION['ID_USER'];
echo $query;
$bdd->exec($query);
header('Location: profil.php?id_profil=' . $_SESSION['ID_USER']);
exit();
