<?php
include 'getEtapes.php';

function getTrajets($bdd, string $id_event, $page)
{
    if (isset($_GET['page'])) {
        $page = $_GET['page'];
    } else {
        $page = 0;
    }
    $reponseTrajets = $bdd->query('SELECT id_trajet, lien_photo, id_users, nom, prenom, ville_depart, lieu_depart, ville_arrivee, lieu_arrive, prix_tot, personnalite, autoroute '
        . 'FROM trajet INNER JOIN users on trajet.chauffeur = users.id_users '
        . 'WHERE evenement=\'' . $id_event . '\' '
        . 'LIMIT ' . ($page * 2) . ',2');
    while ($donneesTrajet = $reponseTrajets->fetch()) {
        $note = 5;
        $hasNote = getHasNote($bdd, $donneesTrajet['id_users']);
        if ($hasNote) {
            $note = getNote($bdd, $donneesTrajet['id_users']);
        }
        ?>
        <div class="col-sm-12" id="divCovoiturage">
            <div class="col-xs-12 col-sm-12 col-lg-2" style="margin-top: 10px">
                <?php if ($donneesTrajet['lien_photo'] == NULL) { ?>
                    <img class="photoProfilTrajet" src="../img/imageProfil2.PNG" alt="photoProfil"/>
                    <?php
                } else {
                    ?>
                    <img class="photoProfilTrajet" src="../../images/<?php echo $donneesTrajet['lien_photo'] ?>"
                         alt="photoProfil"/>
                    <?php
                }
                ?>
            </div>
            <div class="col-lg-8 col-lg-offset-1 col-sm-12 col-xs-12 trajetEvenement" style="margin-top: 30px">
                <div class="col-sm-6">
                    <span class="nomChauffeurTrajetEvenement" style="margin-left: 14%">
                        <?php
                        echo $donneesTrajet['nom'] . ' ' . $donneesTrajet['prenom'];
                        ?>
                    </span>
                    <p>Depart
                        : <?php echo $donneesTrajet['ville_depart'] . ', ' . $donneesTrajet['lieu_depart']; ?></p>
                    <p>Arrivée
                        : <?php echo $donneesTrajet['ville_arrivee'] . ', ' . $donneesTrajet['lieu_arrive']; ?></p>
                    <p>Prix : <?php echo $donneesTrajet['prix_tot'] . ' €'; ?></p>
                    <p>Note chauffeur : <?php
                        if ($hasNote) {
                        ?>
                        <span style="font-size:150%; color:
                            <?php
                        if ($note >= 9) {
                            echo 'gold;';
                        } else if ($note >= 7) {
                            echo 'silver;';
                        } else if ($note >= 5)
                            echo '#614E1A;';
                        else {
                            echo 'red;';
                        }
                        ?>">
                                      <?php
                                      for ($i = 0; $i < $note; ++$i) {
                                          echo '★';
                                      }
                                      for ($j = 0; $j < 10 - $note; ++$j) {
                                          echo '☆';
                                      }
                                      ?>
                            </span>
                        <?php
                        } else {
                            echo 'Inconnue';
                        }
                        ?></span></p>
                </div>

                <div class="col-sm-2 col-sm-offset-1">
                    <?php
                    if ($donneesTrajet['autoroute']) {
                        ?>
                        <img class="logoAutoroute" src="../img/autoroute.png" alt="autouroute : oui"/>
                        <?php
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
