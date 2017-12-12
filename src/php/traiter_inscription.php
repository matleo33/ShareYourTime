<?php

$origin = $_SERVER["HTTP_REFERER"];
$pageorigin = explode("/", $origin);
if(end($pageorigin) == "") {
    array_push($pageorigin, "index.php");
}

$servername = "localhost";
$dbname = "shareyourtime";
$username = "root";
$password = "";

$firstName = htmlspecialchars($_POST["inputFirstName"]);
$name = htmlspecialchars($_POST["inputName"]);
$email = htmlspecialchars($_POST["inputMail"]);
$pass = htmlspecialchars($_POST["inputPassword"]);
$checkPassword = htmlspecialchars($_POST["inputCheckPassword"]);
$age = htmlspecialchars($_POST["inputAge"]);
$number = htmlspecialchars($_POST["inputNumber"]);
$type = htmlspecialchars($_POST["inputType"]);
$address = htmlspecialchars($_POST["inputAddress"]);
$pc = htmlspecialchars($_POST["inputPC"]);
$city = htmlspecialchars($_POST["inputCity"]);
$phoneNumber = htmlspecialchars($_POST["inputPhoneNumber"]);

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

    $stmt = $conn->prepare("INSERT INTO `users` (`nom`, `prenom`, `mail`, `mot_de_passe`, `age`,
 `numero_adresse`, `type_adresse`, `nom_adresse`, `cp`, `ville`, `num_telephone`) 
  VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?);");
    $stmt->execute(array($name, $firstName, $email, $pass, $age, $number, $type, $address, $pc, $city, $phoneNumber));

    session_start();
    $conn = null;

    $url = end($pageorigin);
    header("Location: " . $url);

    /*
    $res = $stmt->fetch();
    if ($res) {
        $url = "index.php";
        session_start();
        $_SESSION["ID_USER"] = $res[0];
        setcookie('NOM_USER', $res[1]);
        $_COOKIE["NOM_USER"] = $res[1];
        $pdo = null;
        header("Location: " . $url);
    } else {
        $url = "erreur.php";
        header("Location: " . $url);
    }*/
} catch (PDOException $e) {
    $url = "erreur2.php";
    header("Location: " . $url);
}

?>


