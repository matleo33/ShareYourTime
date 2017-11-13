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
        display_event($donnees['nom'], 10, 10, "https://www.facebook.com", "https://www.bg.fr");
    }
    $reponse->closeCursor(); // Termine le traitement de la requête
}

get_three_best_event($bdd);
?>
<?php

//Faire fonction qui, avec les infos en parametre, affiche un évènement 
function display_event(string $name, int $nb_people, int $price, string $facebook_link, string $ticketing_link) {
    echo "<div class='important_event'>"
    . "<div class='image'>"
    . "<img src='" . /* Ici mettre code pour avoir image. */ "' />"
    . "</div>"
    . "<div>"
    . "<div>"
    . $name
    . "</div>"
    . "<div>Nombre de covoiturages : "
    . $nb_people
    . "</div>"
    . "<div>A partir de "
    . $price
    . " €"
    . "</div>"
    . "<button>J'y vais"
    . "</button>"
    . "</div>"
    . "<div>"
    . "<ul><li>"
    . "<a href" . $facebook_link . "><img src='image facebook'/></a></li><li> "
    . "<a href" . $ticketing_link . "><img src='image billetterie'/></a></li></ul> "
    . "</div>";
}

//Appeler la fonction trois fois
for ($int = 0; $int < 3; $int++) {
    //display_event($name, $int, $price, $facebook_link, $ticketing_link);
}
?>