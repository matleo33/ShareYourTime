<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$ftp = ftp_ssl_connect("http://shareyourtime.u-bordeaux.fr", 21);
ftp_login($ftp, "root", "D0nald&Ch@uve");
?>