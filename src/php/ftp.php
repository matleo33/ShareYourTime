<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
echo "Coucou";
//$ftp_server = "shareyourtime.u-bordeaux.fr";
$ftp_server = "localhost";
echo $ftp_server;
try
{
$ftp = ftp_connect($ftp_server);
} catch (Exception $e) {
echo "Erreur" . $e->getMessage();
}
echo "Coucou";
if (ftp_login($ftp, "Administrateur", "D0nald&Ch@uve"))
{
	echo "Connecté";
} else
{
echo "Pas connecté";
}
?>