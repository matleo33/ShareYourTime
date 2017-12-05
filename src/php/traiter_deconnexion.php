<?php
session_start();
$url="index.php";
$_SESSION["ID_USER"] = array();
setcookie('NOM_USER');
session_destroy();
header("Location: ".$url);
?>