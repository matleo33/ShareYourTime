<?php

session_start();

try {
    $bdd = new PDO('mysql:host=localhost;dbname=shareyourtime;charset=utf8', 'root', 'D0nald&Ch@uve');
} catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
}
$query = 'UPDATE users '
        . 'SET biographie=\''. $_POST['description'] . '\' '
        . 'WHERE id_users=' . $_SESSION['ID_USER'];
echo $query;
$bdd->exec($query);
header('Location: profil.php?id_profil=' . $_SESSION['ID_USER']);
exit();
