<?php
session_start();

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
        $_SESSION["ID_USER"] = $res[0];
        setcookie('NOM_USER', $res[1]);
        $_COOKIE["NOM_USER"] = $res[1];
        echo $res[0];
    } else {
        echo "0";
    }
} catch (PDOException $e) {
    $url = "erreur2.php";
    header("Location: " . $url);
}
$conn = null;

?>


