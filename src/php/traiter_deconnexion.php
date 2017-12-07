<?php
$origin = $_SERVER["HTTP_REFERER"];
$pageorigin = explode("/", $origin);
if(end($pageorigin) == "") {
    array_push($pageorigin, "index.php");
}
session_start();
$url=end($pageorigin);
$_SESSION["ID_USER"] = array();
setcookie('NOM_USER');
session_destroy();
header("Location: ".$url);
?>