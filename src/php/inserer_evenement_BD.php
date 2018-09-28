<?php
/**
 * Created by PhpStorm.
 * User: yonnel
 * Date: 17/11/2017
 * Time: 16:21
 */
session_start();
try {
    $dossier = '../../images_events/';
    $fichier = basename($_FILES['nouvellePhoto']['name']);
    echo "Fichier \n";
    echo $fichier;
    $extensions = array('.png', '.jpg', '.jpeg', '.PNG', '.JPG', '.JPEG');
    $extension = strrchr($_FILES['nouvellePhoto']['name'], '.');
    $taille_maxi = 10000000;
    $taille = filesize($_FILES['nouvellePhoto']['tmp_name']);
    $user = $_SESSION["ID_USER"];

    $nom_event = $_SESSION["nom_event"];
    $description = $_POST["description"];
    $date_debut = $_POST["date_debut"];
    $date_fin = $_POST["date_fin"];
    $adresse = htmlspecialchars($_POST["adressAutoComplete"]);
    $adresse_facebook = htmlspecialchars($_POST["lien_fb"]);
    $lien_billeterie = $_POST["lien_billet"];
    $id_user = $_SESSION["ID_USER"];

//Début des vérifications de sécurité...
    if ($fichier != "") {
        echo "Fichier";
        if (!in_array($extension, $extensions)) //Si l'extension n'est pas dans le tableau
        {
            $erreur = 'Vous devez uploader un fichier de type png, jpg ou jpeg.';
        }
        if ($taille > $taille_maxi) {
            $erreur = 'Le fichier est trop gros';
        }
        $nom_fichier = md5(uniqid(rand(), true));
        $nom_fichier .= $extension;
    } else {
        $nom_fichier = "";
    }

    if (!isset($erreur)) {
        $servername = "localhost";
        $dbname = "jmcbordeaux_shareyourtime";
        $username = "jmcbordeaux_root";
        $password = "D0nald&Ch@uve";



        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password, array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\''));


        if (move_uploaded_file($_FILES['nouvellePhoto']['tmp_name'], $dossier . $nom_fichier) || !is_null($fichier)) // Renvoie true en cas de succès
        {
            $stmt = $conn->prepare("INSERT INTO events(nom, description,lien_photo,date_debut,date_fin,adresse,lien_fb,lien_billet,est_fini,createur) VALUES (?, ?, ?, ?, ?, ?, ?, ?, 0, ?)");
        }

        $stmt->execute(array($nom_event, $description, $nom_fichier, $date_debut, $date_fin, $adresse, $adresse_facebook, $lien_billeterie, $id_user));
        echo 'Upload effectué avec succès !';

    } else //Sinon la fonction renvoie FALSE
    {
        echo 'Echec de l\'upload !';
        echo $erreur;
    }

    $reponse = $conn->query('SELECT id_events '
        . 'FROM events '
        . 'WHERE nom=\'' . $_SESSION['nom_event'] . '\'');
    while ($donnees = $reponse->fetch()) {
        $id_event = $donnees[0];

        echo $id_event;

        $conn = null;
        header('Location: evenement.php?id_events=' . $id_event);

        break;

    }
} catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
}



/*$bdd = new PDO('mysql:host=localhost;dbname=shareyourtime;charset=utf8', 'root', '');

    $query = 'INSERT INTO events(nom, description,lien_photo,date_debut,date_fin,adresse,lien_fb,lien_billet,createur) '
            . 'VALUES( \'' . $_SESSION['nom_event'] . '\', \'' . $_POST['description'] . '\', null, \'' . $_POST['date_debut'] . '\', \'' . $_POST['date_fin'] .
            '\', \'' . $_POST['adressAutoComplete'] . '\', null,null, \'' . $_SESSION['ID_USER'] . '\')';
    echo $query;
    try {
    $bdd->exec($query);
    } catch (Exception $e) {
        die('Erreur : ' . $e->getMessage());
    }

/* $requete = $bdd->prepare('INSERT INTO events(nom, description,lien_photo,date_debut,date_fin,adresse,lien_fb,lien_billet,createur)
          VALUES(:nom, :description, :lien_photo, :date_debut, :date_fin, :adresse, :lien_fb, :lien_billet, :createur)');
$requete->execute(array(
    'nom' => $_SESSION['nom_event'],
    'description' => $_POST['description'],
    'lien_photo' => null,
    'date_debut' => $_POST['date_debut'],
    'date_fin' => $_POST['date_fin'],
    'adresse' => $_POST['adressAutoComplete'],
    'lien_fb' => null,
    'lien_billet' => null,
    'createur' => $_SESSION['ID_USER']));  //TODO Recupèrer l'id de l'utilisateur connecté


$reponse = $bdd->query('SELECT id_events '
    . 'FROM events '
    . 'WHERE nom=\'' .$_SESSION['nom_event'] . '\'');
while ($donnees = $reponse->fetch()) {
    $id_event = $donnees[0];

    echo $id_event;

    break;
}
unset($_SESSION['nom_event']);
header('Location: evenement.php?id_events='.$id_event);*/


