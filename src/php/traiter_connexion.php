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
$email = htmlspecialchars($_POST["inputEmailConnexion"]);
$pass = htmlspecialchars($_POST["inputPasswordConnexion"]);

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

    $stmt = $conn->prepare("SELECT id_users, prenom FROM users WHERE mail= ? AND  mot_de_passe= ?");
    $stmt->execute(array($email, $pass));

    $res = $stmt->fetch();
    if ($res) {
        $url = end($pageorigin);
        session_start();
        $_SESSION["ID_USER"] = $res[0];
        setcookie('NOM_USER', $res[1]);
        $_COOKIE["NOM_USER"] = $res[1];
        $conn = null;
        header("Location: " . $url);
    } else {
        $url = "erreur.php";
        header("Location: " . $url);
    }
} catch (PDOException $e) {
    $url = "erreur2.php";
    header("Location: " . $url);
}

?>


