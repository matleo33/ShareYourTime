<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$mysqli = new mysqli("147.210.216.23", "root", "D0nald&Ch@uve", "shareyourtime");
if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}

echo $mysqli->host_info . "\n";

/*$ftp_server = "147.210.216.23";
echo $ftp_server;
try
{
    echo "avant";
$ftp = ftp_connect($ftp_server);
echo "après";
echo "Pas de soucis";
} catch (Exception $e) {
echo "Erreur" . $e->getMessage();
}

if (ftp_login($ftp, "ShareFTP", "D0nald&M@l"))
{
	echo "Connecté";
} else {
echo "Pas connecté";
}
?>