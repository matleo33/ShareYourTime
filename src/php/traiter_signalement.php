<?php
session_start();
$origin = $_SERVER["HTTP_REFERER"];
$pageorigin = explode("/", $origin);
if(end($pageorigin) == "") {
    array_push($pageorigin, "index.php");
}

$servername = "localhost";
$dbname = "shareyourtime";
$username = "jmcbordeaux_root";
$password = "D0nald&Ch@uve";

$choix = $_POST["exampleRadios"];
$message = htmlspecialchars($_POST["message"]);
$emetteur = $_SESSION["ID_USER"];
$cible = 1; //TODO Mettre l'id de l'utilissateur que l'on souhaite signaler

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

    $stmt = $conn->prepare("INSERT INTO `signalement` (`emetteur`, `cible`, `libelle`, `description`) VALUES (?, ?, ?, ?)");
    $stmt->execute(array($emetteur, '1', $choix, $message));


    $conn = null;

    $url = end($pageorigin);
    header("Location: " . $url);


} catch (PDOException $e) {
    $url = end($pageorigin);
    header("Location: " . $url);
}

?>


