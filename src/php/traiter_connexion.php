<?php

$servername = "localhost";
$dbname = "shareyourtime";
$username = "root";
$password = "";
$email = htmlspecialchars($_POST["inputEmail"]) ;
$pass = htmlspecialchars($_POST["inputPassword"]) ;

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

    $stmt = $conn->prepare("SELECT id_users, prenom FROM users WHERE mail = '" . $email . "' AND  mot_de_passe = '". $pass ."'");
    $stmt->execute(array(
        ':email' => $_POST['inputEmail'],':pass' => $_POST['inputPassword']
    ));

    $res = $stmt->fetch();
    if($res) {
        $url="index.php";
        session_start();
        $_SESSION["ID_USER"] = $res[0];
        setcookie('NOM_USER', $res[1]);
        $_COOKIE["NOM_USER"] = $res[1];
        $pdo = null;
        header("Location: ".$url);
    } else {
        $url="erreur.php";
        header("Location: ".$url);
    }
}
catch(PDOException $e)
{
    $url="erreur2.php";
    header("Location: ".$url);
}

?>


