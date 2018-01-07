<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function derniersAvis($bdd, $id_user) {
    $vide = TRUE;
    $reponse = $bdd->query('SELECT * '
            . 'FROM avis INNER JOIN users ON avis.emetteur = users.id_users '
            . 'WHERE recepteur=' . $id_user
            . ' LIMIT 0,3');
    while ($donnees = $reponse->fetch()) {
        $vide = FALSE;
        ?>
        <div class="col-sm-12 container-fluid" style="margin: 10px 0;">
            <div class="col-sm-3">
                <?php
                if ($donnees['lien_photo'] == NULL) {
                    ?>
                    <img class="photoProfilAvis" src="../img/imageProfil2.PNG" alt="photoProfil" />
                    <?php
                } else {
                    ?> 
                    <img class="photoProfilAvis" src="../../images/<?php echo $donnees['lien_photo'] ?>" alt="photoProfil" />
                    <?php
                }
                ?>
            </div>
            <div class="col-sm-6">
                <h4>
                    <?php echo $donnees['nom'] . ' ' . $donnees['prenom'] ?>
                </h4>
                <p>
                    <?php
                    for ($i = 0; $i < $donnees['note']; ++$i) {
                        echo '★';
                    }
                    for ($j = 0; $j < 10 - $donnees['note']; ++$j) {
                        echo '☆';
                    }
                    ?>
                </p>
                <p> <?php echo $donnees['description']; ?></p>
            </div>
        </div>
        <?php
    }
    if ($vide == TRUE) {
        ?>
        <p>Pas d'avis pour cet utilisateur</p>
        <?php
    }
}
