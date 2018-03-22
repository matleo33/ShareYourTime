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
$query = 'UPDATE users '
        . 'SET animaux=\''. $_POST['animaux'] .'\', fumeur=\''.$_POST['fumeur'].'\', musique=\''. $_POST['musique'] . '\' '
        . 'WHERE id_users=' . $_SESSION['ID_USER'];
echo $query;
$bdd->exec($query);
header('Location: profil.php?id_profil=' . $_SESSION['ID_USER']);
exit();
