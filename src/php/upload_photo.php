<?php
session_start();

include("ftp.php"); //TODO inclure le fichier contentant les variables de connexion au ftp

// Initialisation des variables à propos de la photo
$dossier = '../../images/';
$fichier = basename($_FILES['nouvellePhoto']['name']);
$extensions = array('.png', '.jpg', '.jpeg', '.PNG', '.JPG', '.JPEG');
$extension = strrchr($_FILES['nouvellePhoto']['name'], '.');
$taille_maxi = 1000000;
$taille = filesize($_FILES['nouvellePhoto']['tmp_name']);
$user = $_SESSION["ID_USER"];


//Vérifications de sécurité
if (!in_array($extension, $extensions)) //Si l'extension n'est pas dans le tableau
{
    $erreur = 'Vous devez uploader un fichier de type png, jpeg ou jpg';
}
if ($taille > $taille_maxi) {
    $erreur = 'Le fichier est trop gros';
}
if (!isset($erreur)) //S'il n'y a pas d'erreur, on ex
{
    $servername = "localhost";
    $dbname = "shareyourtime";
    $username = "root";
    $password = "D0nald&Ch@uve";

    //Modification du nom du fichier (pour éviter les répétitions de nom)
    $nom_fichier = md5(uniqid(rand(), true));
    $nom_fichier .= $extension;

    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

    $req = $conn->prepare("SELECT lien_photo FROM users WHERE id_users = ?");
    $req->execute(array($user));
    $res = $req->fetch();

    //Si une photo existe déjà, on la supprime
    if ($res[0]) {
        unlink("../../images/" . $res[0] . "");
    }

    $stmt = $conn->prepare("UPDATE users SET lien_photo = ? WHERE id_users = ?");
    $stmt->execute(array($nom_fichier, $user));

    //Mise en ligne de la photo
    if (move_uploaded_file($_FILES['nouvellePhoto']['tmp_name'], $dossier . $nom_fichier))
    {
        echo 'Upload effectué avec succès !';
    } else
    {
        echo 'Echec de l\'upload !';
    }


    $pdo = null;
    $url = "profil.php?id_profil=".$user;
    header("Location: " . $url);
} else {
    echo $erreur;
}

//ftp_close($ftp);

?>