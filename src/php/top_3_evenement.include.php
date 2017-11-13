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
        display_event($donnees['nom'], 10, $prix_min, $donnees['lien_fb'], $donnees['lien_billet']);
    }
    $reponse->closeCursor(); // Termine le traitement de la requête
}

get_three_best_event($bdd);
?>
<?php

//Faire fonction qui, avec les infos en parametre, affiche un évènement 
function display_event(string $name, int $nb_people, int $price, string $facebook_link, string $ticketing_link) {
    echo "<div class='important_event'>"
    . "<div class='image col-sm-2'>"
    . "<img src='" . /* Ici mettre code pour avoir image. */ "' alt='image' />"
    . "</div>"
    . "<div class=\"col-sm-12\">"
    . "<div class=\"col-sm-6\">"
    . "<div>"
    . $name
    . "</div>"
    . "<div>Nombre de covoiturages : "
    . $nb_people
    . "</div>"
    . "</div>"
    . "<div>A partir de "
    . $price
    . " €"
    . "</div>"
    . "<a href=#><button>J'y vais"
    . "</button></a>"
    . "</div>"
    . "<div class='icones'>"
    . "<a href=" . $facebook_link . "><img class='logo' src='../img/facebook.png'/></a> "
    . "<a href=" . $ticketing_link . "><img class='logo' src='../img/ticket.png'/></a> "
    . "</div>";
}

//Appeler la fonction trois fois
for ($int = 0; $int < 3; $int++) {
    //display_event($name, $int, $price, $facebook_link, $ticketing_link);
}
?>