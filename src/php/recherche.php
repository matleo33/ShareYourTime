<!DOCTYPE html>
<html lang="fr">

    <head>
        <meta charset="UTF-8">
        <link href="./../css/style.css" rel="stylesheet">

        <!-- Bootstrap-->
        <link rel="stylesheet" href="./../BootStrap/css/bootstrap.min.css">
        <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
        <script src="../js/recherche.js"></script>
        <script src="../BootStrap/js/bootstrap.min.js"></script>

        <title>Share Your Time</title>
    </head>

    <body>
        <?php include 'navbar.include.php'; ?><br/>
        <?php include 'modal_connexion.include.php' ?>
        <?php include 'modal_inscription.include.php' ?>
        <?php
        if (isset($_GET['nomEvent'])) {
            
        } else {
            
        }
        /*
         * To change this license header, choose License Headers in Project Properties.
         * To change this template file, choose Tools | Templates
         * and open the template in the editor.
         */
        ?>
        <div class="col-sm-12">
            <h1 class="text-center">RECHERCHE</h1>
        </div>
        <div class="col-sm-12 text-center">
            <div class="col-sm-6">
                <input placeholder="Nom de l'événement"<?php
        if (isset($_GET['nomEvent'])) {
            echo "value=\"" . $_GET['nomEvent'] . "\"";
        }
        ?>
                       ></input></div>
            <div class="com-sm-6">
                <button onclick="rechercheGlobale()">Rechercher</button>
            </div>
            <div class="col-sm-3">
                <p onclick="displayRechercheTotale()">Options avancées</p>
            </div>
            <div class="col-sm-9">
            </div>
        </div>
        <?php include 'footer.include.php'; ?>
    </body>
</html>