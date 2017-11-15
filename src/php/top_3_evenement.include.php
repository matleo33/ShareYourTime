<?php

//Faire fonction qui retourne les 3 plus gros évènements
try {
    $bdd = new PDO('mysql:host=localhost;dbname=shareyourtime;charset=utf8', 'root', '');
} catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
}

function get_three_best_event($bdd) {
    $reponse = $bdd->query('SELECT * '
            . 'FROM events '
            . 'WHERE est_fini=FALSE '
            . 'LIMIT 0,2');
    while ($donnees = $reponse->fetch()) {
        $reponse2 = $bdd->query('SELECT MIN(prix_tot) FROM `trajet` WHERE evenement= \'' . $donnees['id_events'] . '\'');
        while($donnees2 = $reponse2->fetch())
        {
                $prix_min = $donnees2[0];
        }
        display_event($donnees['nom'], 10, $prix_min, $donnees['lien_fb'], $donnees['lien_billet'], $donnees['id_events']);
    }
    $reponse->closeCursor(); // Termine le traitement de la requête
}

get_three_best_event($bdd);
?>
<?php

//Faire fonction qui, avec les infos en parametre, affiche un évènement 
function display_event(string $name, int $nb_people, int $price, string $facebook_link, string $ticketing_link, string $id_event) {
    echo "<div class='important_event'>"
    . "<div class=\"col-sm-1\"></div>"
    . "<div class='image_top_3_event col-sm-3'>"
    . "<img src='" . /* Ici mettre code pour avoir image. */ "' alt='image' />"
    . "</div>"
    . "<div class=\"col-sm-1\"></div>"
    . "<div class=\"informations_event col-sm-6\">"
    . "<div>"
    . "<div class=\"border\">"
    . "<p class=\"text_left\">"
    . $name
    . "</p>"
    . "<h2 class=\"text_right\">A partir de "
    . $price
    . " €"
    . "</h2>"
    . "<p class=\"text_left\">Nombre de covoiturages : "
    . $nb_people
    . "</p>"
    . "<div class=\"text-right\">"
    . "<a class=\"bouton_fixe_droite\" href=./evenement?id_events=".$id_event."><button>J'y vais"
    . "</button></a>"
    . "</div>"
    . "</div>"
    . "</div>"
    . "<div class='icones'>"
    . "<a href=" . $facebook_link . "target=\"_blank\" rel=\"noopener noreferrer\"><img class='logo' src='../img/facebook.png'/></a> "
    . "<a href=" . $ticketing_link . "target=\"_blank\" rel=\"noopener noreferrer\"><img class='logo' src='../img/ticket.png'/></a> "
    . "</div>"
    . "</div>"
    . "<div class=\"col-sm-1\"></div>"
    . "</div>";
}
?>