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
    $extensions = array('.png', '.jpg', '.jpeg', '.PNG', '.JPG', '.JPEG');
    $extension = strrchr($_FILES['nouvellePhoto']['name'], '.');
    $taille_maxi = 10000000;
    $taille = filesize($_FILES['nouvellePhoto']['tmp_name']);
    $user = $_SESSION["ID_USER"];

    $nom_event = $_SESSION["nom_event"];
    $description = $_POST["description"];
    //photo
    $date_debut = $_POST["date_debut"];
    $date_fin = $_POST["date_fin"];
    $adresse = htmlspecialchars($_POST["adressAutoComplete"]);
    //event facebook
    //lien billeterie
    $id_user = $_SESSION["ID_USER"];

//Début des vérifications de sécurité...
    if (!in_array($extension, $extensions)) //Si l'extension n'est pas dans le tableau
    {
        $erreur = 'Vous devez uploader un fichier de type png, jpg ou jpeg.';
    }
    if ($taille > $taille_maxi) {
        $erreur = 'Le fichier est trop gros';
    }

    if (!isset($erreur)) {
        $servername = "localhost";
        $dbname = "shareyourtime";
        $username = "root";
        $password = "";

        $nom_fichier = md5(uniqid(rand(), true));
        $nom_fichier .= $extension;

        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);



        if (move_uploaded_file($_FILES['nouvellePhoto']['tmp_name'], $dossier . $nom_fichier)) // Renvoie true en cas de succès
        {$stmt = $conn->prepare("INSERT INTO events(nom, description,lien_photo,date_debut,date_fin,adresse,lien_fb,lien_billet,createur) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt->execute(array($nom_event, $description, $nom_fichier, $date_debut, $date_fin, $adresse, null, null, $id_user));
            echo 'Upload effectué avec succès !';
        } else //Sinon la fonction renvoie FALSE
        {
            echo 'Echec de l\'upload !';
        }

        $pdo = null;
        //$url = "profil.php?id_profil=" . $user;
        //header('Location: evenement.php?id_events='.$id_event);

    } else {
        echo $erreur;
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


