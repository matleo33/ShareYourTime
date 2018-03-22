<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

session_start();

try {
    $bdd = new PDO('mysql:host=localhost;dbname=shareyourtime;charset=utf8', 'root', 'D0nald&Ch@uve');
} catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
}
if ($_POST['animaux'] == 'Non') {
    $animaux = 'false';
} else {
    $animaux = 'true';
}

if ($_POST['fumeur'] == 'Non') {
    $fumeur = 'false';
} else {
    $fumeur = 'true';
}

if ($_POST['musique'] == 'Non') {
    $musique = 'false';
} else {
    $musique = 'true';
}

$query = 'UPDATE users '
        . 'SET animaux=\'' . $animaux . '\', fumeur=\'' . $fumeur . '\', musique=\'' . $musique . '\' '
        . 'WHERE id_users=' . $_SESSION['ID_USER'];
echo $query;
$bdd->exec($query);
header('Location: profil.php?id_profil=' . $_SESSION['ID_USER']);
exit();
