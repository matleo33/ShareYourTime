<?php
//Faire fonction qui retourne les 3 plus gros évènements
try {
    $bdd = new PDO('mysql:host=localhost;dbname=shareyourtime;charset=utf8', 'root', '');
} catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
}

function get_three_best_event($bdd) {
    $reponse = $bdd->query('SELECT events.id_events, events.lien_photo, events.nom, events.lien_fb, events.lien_billet, COUNT(id_trajet)'
            . 'FROM users INNER JOIN trajet ON users.id_users=trajet.chauffeur RIGHT OUTER JOIN events ON trajet.evenement = events.id_events '
            . 'WHERE events.est_fini=FALSE '
            . 'GROUP BY events.id_events '
            . 'ORDER BY COUNT(trajet.evenement) DESC '
            . 'LIMIT 0,3');
    while ($donnees = $reponse->fetch()) {
        $reponse2 = $bdd->query('SELECT MIN(prix_tot), count(*) FROM `trajet` WHERE evenement= \'' . $donnees['id_events'] . '\'');
        $prix_min = "unknown";
        $nb_covoit = 0;
        while ($donnees2 = $reponse2->fetch()) {
            $prix_min = $donnees2[0];
            $nb_covoit = $donnees2[1];
        }
        display_event($donnees['nom'], $donnees['lien_photo'], $nb_covoit, $prix_min, $donnees['lien_fb'], $donnees['lien_billet'], $donnees['id_events']);
    }
    $reponse->closeCursor(); // Termine le traitement de la requête
}

get_three_best_event($bdd);
?>
<?php

//Faire fonction qui, avec les infos en parametre, affiche un évènement 
function display_event(string $name, $lien_photo, int $nb_people, $price, string $facebook_link, string $ticketing_link, string $id_event) {
    ?>
<div class='important_event col-sm-12'>
        <div class='image_top_3_event col-sm-2 col-sm-offset-1'>
            <img class="<?php
            if ($lien_photo != NULL) {
                echo "photoProfilEvent";
            }
            ?>" src="../../images/<?php echo $lien_photo ?>" alt="Photo Evenement"/>
        </div>
        <div class="informations_event col-sm-7 col-sm-offset-1">
            <div>
                <div class="border">
                    <p class="text_left" style="font-size : 150%;">
                        <?php echo $name; ?>
                    </p>
                    <?php
                    if ($price != NULL && $price != "unknown") {
                        ?>
                        <h2 class="text_right">A partir de
                            <?php
                            echo $price;
                            ?>
                            €</h2>
                        <?php
                    } else {
                        ?>
                        <div class="text_right">Pas de covoiturage <br />
                            <a href=./proposer_trajet.php?id_events=<?php echo $id_event; ?>>(Proposez le votre ?)</a>
                        </div>
                        <?php
                    }
                    ?>
                    <p class="text_left">Nombre de covoiturages : 
                        <?php echo $nb_people; ?>
                    </p>
                    <div class="text-right">
                        <a class="bouton_fixe_droite" href=./evenement?id_events=<?php echo $id_event; ?>>
                            <button>J'y vais</button>
                        </a>
                    </div>
                </div>
            </div>
            <div class='icones'>
                <a href="<?php
                if ($facebook_link != NULL) {
                    echo $facebook_link;
                    ?>" target=\"_blank\" rel="noopener noreferrer">
                        <img class='logo' src='../img/facebook.png'/>
                    </a>
                    <a href="
                    <?php
                } else {
                    ?>
                       #" target=\"_blank\" rel="noopener noreferrer">
                        <img class='logo' src='../img/facebook.png'/>
                    </a>
                    <a href="
                    <?php
                }
                if ($ticketing_link != NULL) {
                    echo $ticketing_link;
                    ?>
                       " target="_blank" rel="noopener noreferrer">
                        <img class='logo' src='../img/ticket.png'/>
                    </a>
                    <?php
                } else {
                    ?>
                    #" target="_blank" rel="noopener noreferrer">
                    <img class='logo' src='../img/ticket.png'/>
                    </a>
                    <?php
                }
                ?>
            </div>
        </div>
    </div>
<?php
}
