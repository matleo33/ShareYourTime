<?php

$origin = $_SERVER["HTTP_REFERER"];
$pageorigin = explode("/", $origin);
if (end($pageorigin) == "") {
    array_push($pageorigin, "index.php");
}
session_start();
$servername = "localhost";
$dbname = "shareyourtime";
$username = "root";
$password = "D0nald&Ch@uve";
$email = $_GET["inputReinitEmail"];

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

    $stmt = $conn->prepare("SELECT id_users FROM users WHERE mail= ?");
    $stmt->execute(array($email));

    $res = $stmt->fetch();
    if($res) {
        $conn = null;
        $url = end($pageorigin);
        echo $res[0];
    } else {
        echo 0;
    }


} catch (PDOException $e) {
    $url = "erreur2.php";
    header("Location: " . $url);
}

?>


