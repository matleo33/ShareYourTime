<?php
try
{
$bdd = new PDO('mysql:host=localhost;dbname=shareyourtime;charset=utf8', 'root', '');
}
catch (Exception $e)
{
    die('Erreur : ' . $e->getMessage());
}
if($_POST["inputPassword"] == $_POST["inputCheckPassword"] 
        && $_POST["inputName"] != NULL 
        && $_POST["inputFirstName"] != NULL
        && $_POST["inputMail"] != NULL
        && $_POST["inputPassword"] != NULL) {
    $requete = $bdd->prepare('INSERT INTO users(nom, prenom, mail, mot_de_passe, age, numero_adresse, type_adresse, nom_adresse, cp, ville, num_telephone)'
            . ' VALUES(:nom, :prenom, :mail, :mot_de_passe, :age, :numero_adresse, :type_adresse, :nom_adresse, :cp, :ville, :num_telephone)');
    $requete->execute(array(
       'nom' => $_POST["inputName"],
       'prenom' => $_POST["inputFirstName"],
       'mail' => $_POST["inputMail"],
       'mot_de_passe' => $_POST["inputPassword"],
       'age' => $_POST["inputAge"],
        'numero_adresse' => $_POST["inputNumber"],
        'type_adresse' => $_POST["inputType"],
        'nom_adresse' => $_POST["inputAddress"],
        'cp' => $_POST["inputPC"],
        'ville' => $_POST["inputCity"],
        'num_telephone' => $_POST["inputPhoneNumber"]
    ));
}
?>
