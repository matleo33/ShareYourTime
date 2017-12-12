<?php
session_start();
$origin = $_SERVER["HTTP_REFERER"];
$pageorigin = explode("/", $origin);
if(end($pageorigin) == "") {
    array_push($pageorigin, "index.php");
}

$servername = "localhost";
$dbname = "shareyourtime";
$username = "root";
$password = "";
$email = htmlspecialchars($_GET["inputEmailConnexion"]);
$pass = htmlspecialchars($_GET["inputPasswordConnexion"]);

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

    $stmt = $conn->prepare("SELECT id_users, prenom FROM users WHERE mail= ? AND  mot_de_passe= ?");
    $stmt->execute(array($email, $pass));

    $res = $stmt->fetch();
    if ($res) {
        //$url = end($pageorigin);
        $_SESSION["ID_USER"] = $res[0];
        setcookie('NOM_USER', $res[1]);
        $_COOKIE["NOM_USER"] = $res[1];
        echo $res[0];
        //header("Location: " . $url);
    } else {
        echo "0";
        //$url = end($pageorigin);
        //header("Location: " . $url);
    }
} catch (PDOException $e) {
    $url = "erreur2.php";
    header("Location: " . $url);
}
$conn = null;

?>


