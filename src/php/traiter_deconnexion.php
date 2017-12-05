<?php
session_start();
$url="index.php";
$_SESSION["ID_USER"] = array();
session_destroy();
header("Location: ".$url);
?>