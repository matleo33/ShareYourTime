<?php
include 'getEtapes.php';
function getTrajets($bdd, string $id_event, $page) {
    if (isset($_GET['page'])) {
        $page = $_GET['page'];
    } else {
        $page = 0;
    }
    $reponseTrajets = $bdd->query('SELECT id_trajet, id_users, nom, prenom, ville_depart, lieu_depart, prix_tot, personnalite, autoroute '
            . 'FROM trajet INNER JOIN users on trajet.chauffeur = users.id_users '
            . 'WHERE evenement=\'' . $id_event . '\' '
            . 'LIMIT ' . ($page * 2) . ',' . (($page * 2) + 2));
    while ($donneesTrajet = $reponseTrajets->fetch()) {
        $note = 5;
        $hasNote = getHasNote($bdd, $donneesTrajet['id_users']);
        if ($hasNote) {
            $note = getNote($bdd, $donneesTrajet['id_users']);
        }
        ?>
        <div class="col-sm-12" id="divCovoiturage">
            <div class="col-sm-2">
                IMAGECHAUFFEUR
            </div>
            <div class="col-sm-8 col-sm-offset-1 trajetEvenement">
                <div class="col-sm-6">
                    <span class="nomChauffeurTrajetEvenement">
                        <?php
                        echo $donneesTrajet['nom'] . ' ' . $donneesTrajet['prenom'];
                        ?>
                    </span>
                    <p>Depart : <?php echo $donneesTrajet['ville_depart'] . ', ' . $donneesTrajet['lieu_depart']; ?></p>
                    <p>Prix : <?php echo $donneesTrajet['prix_tot'] . ' €'; ?></p>
                    <p>Note chauffeur : <?php
                        if ($hasNote) {
                            for ($i = 0; $i < $note; ++$i) {
                                echo '★';
                            }
                            for ($j = 0; $j < 10 - $note; ++$j) {
                                echo '☆';
                            }
                        } else {
                            echo 'Inconnue';
                        }
                        ?></p>
                </div>

                <div class="col-sm-2 col-sm-offset-1">
        <?php
        if ($donneesTrajet['autoroute']) {
            echo "<img class=\"logoAutoroute\" src=\"../img/autoroute.png\" alt=\"autouroute : oui\"/ />";
        }
        ?>
                </div>
                <div class="col-sm-2 col-sm-offset-1">
                    <a class="boutonDetailEvenement"
                       href="./trajet.php?id_trajet=<?php echo $donneesTrajet['id_trajet'] ?>">
                        <button>Voir détails</button>
                    </a>
                </div>
                <?php getEtapes($bdd, $donneesTrajet['id_trajet']); ?>
            </div>
        </div>
        <?php
    }
}
