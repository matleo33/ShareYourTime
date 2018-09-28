<?php
/**
 * Created by PhpStorm.
 * User: yonnel
 * Date: 06/12/2017
 * Time: 10:05
 */
session_start();
include 'getNote.php';
$covoit_event = array();//tableau qui va contenir tout les valeurs des evenement et que l'on va retourner à notre méthode ajax
$compt = 1; //compteur permettant d'incrementer les valeurs dans le tableau
$evenementParPage=3;//Nombre d'événement que l'on veut afficher par page
$conditionsRequete = "";//Contient la partie de la requete correspondant au WHERE
try
{
    $bdd = new PDO('mysql:host=localhost;dbname=jmcbordeaux_shareyourtime;charset=utf8', 'jmcbordeaux_root', 'D0nald&Ch@uve');//Connexion à la BDD

    $requete = "SELECT DISTINCT evenement, chauffeur, ville_depart, date_depart, ville_arrivee, date_arrivee, autoroute, prix_tot, id_trajet FROM trajet INNER JOIN covoiturage ";

    //GESTION DES CONDITIONS
    if($_GET['optpeageradio'] == 'pasimportantpeage')
    {
        $conditionsRequete .='WHERE 1 ';
    }
    else if ($_GET['optpeageradio'] == 'avecpeage')
    {
        $conditionsRequete .= 'WHERE trajet.autoroute = 1 ';
    }
    else if ($_GET['optpeageradio'] == 'sanspeage')
    {
        $conditionsRequete .= 'WHERE trajet.autoroute = 0 ';
    }

    if($_GET['ville_depart'] != '')
    {
        $conditionsRequete .= "&& trajet.ville_depart = '". $_GET['ville_depart']. "' ";
    }
    if($_GET['ville_arrivee'] != '')
    {
        $conditionsRequete .= "&& trajet.ville_arrivee = '". $_GET['ville_arrivee']. "' ";
    }

    if($_GET['prix'] != '')
    {
        $conditionsRequete .= "&& trajet.prix_tot =". $_GET['prix']. " ";
    }

    if($_GET['nombre_voyageur'] != '')
    {
        $conditionsRequete .= "&& ".  $_GET['nombre_voyageur'] . " <= trajet.nb_place - covoiturage.nb_place_res ";
    }

    if($_GET['date_depart'] != '')
    {
        $date_depart_fr = $_GET['date_depart'];
        $date_depart_us = date('Y-m-d', strtotime(str_replace('/', '-', $date_depart_fr)));
        $conditionsRequete.= "&& CAST(date_depart AS DATE) =\"". $date_depart_us . "\" ";
    }

    if($_GET['date_arrivee'] != '')
    {
        $date_arrivee_fr = $_GET['date_arrivee'];
        $date_arrivee_us = date('Y-m-d', strtotime(str_replace('/', '-', $date_arrivee_fr)));
        $conditionsRequete.= "&& CAST(date_arrivee AS DATE) =\"". $date_arrivee_us . "\" ";
    }

    if(isset($_GET["nom_event"]))
    {
        $conditionsRequete.= "&& trajet.evenement = (SELECT events.id_events FROM events WHERE events.nom = '".$_GET["nom_event"]."') ";
    }

    $requete.=$conditionsRequete; // On ajoute les conditions créés précédemement à la requete

    //Gestion des ORDER BY qu'on ajoute à la requete
    switch ($_GET["mode_order"])
    {
        case "date_dep_ASC":
            $requete.= "ORDER BY date_depart ASC ";
            break;
        case "date_dep_DESC":
            $requete.= "ORDER BY date_depart DESC ";
            break;
        case "date_arr_DESC":
            $requete.= "ORDER BY date_arrivee DESC ";
            break;
        case "date_arr_ASC":
            $requete.= "ORDER BY date_arrivee ASC ";
            break;
        case "prix_DESC":
            $requete.= "ORDER BY prix_tot DESC ";
            break;
        case "prix_ASC":
            $requete.= "ORDER BY prix_tot ASC ";
            break;
        case "note_DESC":
            $requete.= "ORDER BY (SELECT AVG(avis.note) FROM avis WHERE avis.recepteur=trajet.chauffeur) DESC ";
            break;
        case "note_ASC":
            $requete.= "ORDER BY (SELECT AVG(avis.note) FROM avis WHERE avis.recepteur=trajet.chauffeur) ASC ";
            break;
    }

    //GESTION DE LA PAGINATION
    $retour_total = "SELECT DISTINCT COUNT(DISTINCT trajet.id_trajet) AS total FROM trajet INNER JOIN covoiturage ";
    $retour_total.= $conditionsRequete;//On compte le nombre total de trajet avec les condtions récupérées précédemment
    $result = $bdd->query($retour_total);
    $donnees_total = $result->fetch();
    $total=$donnees_total['total'];//Contient de le nombre de trajet

    $nombreDePages=ceil($total/$evenementParPage);//Calcul le nombre de pages nécessaire pour la pagination

    if(isset($_GET['page'])) // Si la variable $_GET['page'] existe...
    {
        $pageActuelle=intval($_GET['page']);

        if($pageActuelle>$nombreDePages) // Si la valeur de $pageActuelle (le numéro de la page) est plus grande que $nombreDePages...
        {
            $pageActuelle=$nombreDePages;
        }
    }
    else // Sinon
    {
        $pageActuelle=1; // La page actuelle est la n°1
    }

    $premiereEntree=($pageActuelle-1)*$evenementParPage;

    //On ajoute la LIMIT à la requete pour la pagination
    $requete.= "LIMIT ".$premiereEntree.", ".$evenementParPage;

    $reponse = $bdd->query($requete);

    //On parcours les résultats de la requete
    while ($donnees = $reponse->fetch()) {

        $$compt = array();//On créé un nouveau tableau qui a pour nom la valeur du compteur
        $requete2 = "SELECT users.nom, prenom, id_users, lien_photo FROM users WHERE id_users = ".$donnees["chauffeur"];
        $reponse2 = $bdd->query($requete2);

        $donnees_user = $reponse2->fetch();

        //On récupére la note de l'utilisateur
        //Si pas de note, la valeur va être égale à "inconnue"
        $note_chauffeur = "inconnue";
        if(getHasNote($bdd,$donnees_user["id_users"])==TRUE)
        {
            $note_chauffeur = getNote($bdd,$donnees_user["id_users"]);
        }

        //Si la requete pour récupérer les valeurs de l'utilisateur fonctionne
        if($donnees_user)
        {
            //On push dans le tableau les valeurs permettant d'afficher tout les informations liées au trajet et au chauffeur
            array_push($$compt, $donnees_user[0],
                $donnees_user["prenom"],
                $note_chauffeur);

            array_push($$compt,
                $donnees["ville_depart"],
                $donnees["date_depart"],
                $donnees["ville_arrivee"],
                $donnees["date_arrivee"],
                $donnees["autoroute"],
                $donnees["prix_tot"],
                $donnees["id_trajet"],
                $donnees_user["lien_photo"]);
            array_push($covoit_event,$$compt);//On ajoute se tableau à notre tableau d'événement
            $compt++;//On incremente le compteur
        }


    }
    array_push($covoit_event,$nombreDePages);//La derniere valeur de notre tableau des trajets va contenir le nombre de page pourla pagination
    echo json_encode(array_values($covoit_event));//On renvoir le tableau sous forme de json
}
catch (Exception $e)
{
    //die('Erreur : ' . $e->getMessage());
    echo $e->getMessage();
}

?>