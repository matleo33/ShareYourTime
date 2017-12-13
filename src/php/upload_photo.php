<?php
session_start();

//include("ftp.php"); //TODO inclure le fichier contentant les variables de connexion au ftp

$dossier = '../../images/';
$fichier = basename($_FILES['nouvellePhoto']['name']);
$extensions = array('.png', '.jpg', '.jpeg', '.PNG', '.JPG', '.JPEG');
$extension = strrchr($_FILES['nouvellePhoto']['name'], '.');
$taille_maxi = 1000000;
$taille = filesize($_FILES['nouvellePhoto']['tmp_name']);
$user = $_SESSION["ID_USER"];
//Début des vérifications de sécurité...
if (!in_array($extension, $extensions)) //Si l'extension n'est pas dans le tableau
{
    $erreur = 'Vous devez uploader un fichier de type png, jpeg ou jpg';
}
if ($taille > $taille_maxi) {
    $erreur = 'Le fichier est trop gros';
}
if (!isset($erreur)) //S'il n'y a pas d'erreur, on upload le fichier
{
    $servername = "localhost";
    $dbname = "shareyourtime";
    $username = "root";
    $password = "";

    $nom_fichier = md5(uniqid(rand(), true));
    $nom_fichier .= $extension;

    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

    $req = $conn->prepare("SELECT lien_photo FROM users WHERE id_users = ?");
    $req->execute(array($user));
    $res = $req->fetch();

    if ($res[0]) {
        unlink("../../images/" . $res[0] . "");
    }

    $stmt = $conn->prepare("UPDATE users SET lien_photo = ? WHERE id_users = ?");
    $stmt->execute(array($nom_fichier, $user));


    if (move_uploaded_file($_FILES['nouvellePhoto']['tmp_name'], $dossier . $nom_fichier)) // Renvoie true en cas de succès
    {
        echo 'Upload effectué avec succès !';
    } else //Sinon la fonction renvoie FALSE
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