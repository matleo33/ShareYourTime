<!DOCTYPE html>
<html lang="fr">

    <head>
        <meta charset="UTF-8">
        <link href="./../css/style.css" rel="stylesheet">

        <!-- Bootstrap-->
        <link rel="stylesheet" href="./../BootStrap/css/bootstrap.min.css">
        <script src="https://code.jquery.com/jquery-1.12.4.js"></script>

        <title>Share Your Time</title>
    </head>

    <body>
        <?php include 'navbar.include.php'; ?>

        <div class="container col-lg-offset-3 col-lg-6 col-md-offset-3 col-md-6 col-sm-offset-2 col-sm-8 col-xs-12" style="text-align: center;background-color: RGB(69,164,247)">
            <h1 style="color: white">PROPOSER UN TRAJET</h1>
            <form action="proposer_trajet_envoi.php" method="post" id="formTrajet">
                <?php
                $nomEvenement = NULL;
                if (isset($_GET['id_events']))
                    $idEvenement = $_GET['id_events'];
                else
                   $idEvenement = NULL;
                try {
                    $bdd = new PDO('mysql:host=localhost;dbname=shareyourtime;charset=utf8', 'root', '');
                } catch (Exception $e) {
                    die('Erreur : ' . $e->getMessage());
                }
                if ($idEvenement != NULL) {
                $reponse = $bdd->query('SELECT nom '
                        . 'FROM events '
                        . 'WHERE id_events=' . $idEvenement);
                while ($donnees = $reponse->fetch()) {
                    $nomEvenement = $donnees['nom'];
                }
                $reponse->closeCursor(); // Termine le traitement de la requête
                }
                ?>
                <table class="table-bordered">
                    <tr>
                        <td>
                            Nom événement : 
                        </td>
                        <td>
                        <?php 
                        if ($nomEvenement != NULL)
                            echo $nomEvenement;
                        ?>    
                        </td>
                    </tr>
                    <tr>
                        <td>Ville de depart</td>
                        <td rowspan="2">Date + heure</td>
                    </tr>
                    <tr>
                        <td>Lieu du rdv</td>
                    </tr>
                </table>
                <table class="table-bordered">
                    <tr>
                        <td>Ville d'arrivée</td>
                        <td rowspan="2">Date + heure</td>
                    </tr>
                    <tr>
                        <td>Lieu du point d'arrivée</td>
                    </tr>
                </table>

                <input type="submit" id="submitEventName" class="btn btn-primary" value="Suivant"/>
            </form>
        </div>


        <?php include('footer.include.php');?>
        <script src="../BootStrap/js/bootstrap.min.js"></script>
    </body>

</html>