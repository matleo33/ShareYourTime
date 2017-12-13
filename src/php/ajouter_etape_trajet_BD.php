<?php
/**
 * Created by PhpStorm.
 * User: yonnel
 * Date: 12/12/2017
 * Time: 19:14
 */
session_start();

try{
    $bdd = new PDO('mysql:host=localhost;dbname=shareyourtime;charset=utf8', 'root', '');

    $jsondecode = json_decode($_POST['mesEtapes']);
    $taillejson = count($jsondecode);
    for($i=0;$i<$taillejson-1;$i++)
    {
        if($jsondecode[$i] != null)
        {
            $requete = $bdd->prepare('INSERT INTO etape(trajet,ville,lieu,date,prix)
              VALUES(:trajet,:ville,:lieu,:date_etape,:prix)');
            $requete->execute(array(
                'trajet' => $jsondecode[$taillejson-1][0],
                'ville' => $jsondecode[$i][0],
                'lieu' => $jsondecode[$i][1],
                'date_etape' => $jsondecode[$i][2],
                'prix' => $jsondecode[$i][3]));
        }
    }
    echo $jsondecode[$taillejson-1][0];
}
catch (Exception $e)
{
    die('Erreur : ' . $e->getMessage());
}
?>