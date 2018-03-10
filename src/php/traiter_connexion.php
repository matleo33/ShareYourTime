<?php
$origin = $_SERVER["HTTP_REFERER"];
$pageorigin = explode("/", $origin);
if(end($pageorigin) == "") {
    array_push($pageorigin, "index.php");
}
$url=end($pageorigin);

session_start();

$servername = "localhost";
$dbname = "shareyourtime";
$username = "root";
$password = "D0nald&Ch@uve";
$email = htmlspecialchars($_GET["inputEmailConnexion"]);
$pass = htmlspecialchars($_GET["inputPasswordConnexion"]);

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password, array (PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\''));

    $stmt = $conn->prepare("SELECT id_users, prenom FROM users WHERE mail= ? AND  mot_de_passe= ?");
    $stmt->execute(array($email, $pass));

    $res = $stmt->fetch();
    if ($res) {
        $_SESSION["ID_USER"] = $res[0];
        setcookie('NOM_USER', $res[1]);
        $_COOKIE["NOM_USER"] = $res[1];
        echo $res[0];
        header("Location: ".$url);
    } else {
        echo "0";
    }
} catch (PDOException $e) {
    header("Location: ".$url);
}
$conn = null;

?>


