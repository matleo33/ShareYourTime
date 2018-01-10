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

    $jsondecode = json_decode($_POST['mesEtapes']);//Recupère les etapes envoyés sous forme de json
    $taillejson = count($jsondecode);
    $compteur_num_etape = 1;
    //Pour chaque etapes dans notre json
    for($i=0;$i<$taillejson-1;$i++)
    {
        //on vérifie que la ligne du json voulu n'est pas null. Si on a supprimé un ligne dans le forme précédement
        //elle peut-être égale à null et que le prix entrée n'est pas négatif
        if($jsondecode[$i] != null && $jsondecode[$i][3]>=0)
        {
            $requete = $bdd->prepare('INSERT INTO etape(num_etape,trajet,ville,lieu,date,prix)
              VALUES(:num_etape,:trajet,:ville,:lieu,:date_etape,:prix)');
            $requete->execute(array('num_etape' => $compteur_num_etape,
                'trajet' => $jsondecode[$taillejson-1][0],//la dernière valeur de notre json correspond à l'id du trajet
                'ville' => $jsondecode[$i][0],
                'lieu' => $jsondecode[$i][1],
                'date_etape' => $jsondecode[$i][2],
                'prix' => $jsondecode[$i][3]));

            $compteur_num_etape++;
        }
    }
    echo $jsondecode[$taillejson-1][0];
}
catch (Exception $e)
{
    die('Erreur : ' . $e->getMessage());
}
?>