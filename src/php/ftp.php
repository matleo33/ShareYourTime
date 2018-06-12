<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$ftp_server = "shareyourtime.u-bordeaux.fr";
echo $ftp_server;
try
{
$ftp = ftp_connect($ftp_server);
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