<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function derniersAvis($bdd, $id_user) {
    $reponse = $bdd->query('SELECT * '
            . 'FROM avis INNER JOIN users ON avis.emetteur = users.id_users '
            . 'WHERE recepteur=' . $id_user
            . ' LIMIT 0,2');
    while ($donnees = $reponse->fetch()) {
        echo "<div class=\"col-sm-12\">";
        if ($donnees['lien_photo'] == NULL) {
            ?>
            <img class="photoProfilAvis" src="../img/imageProfil2.PNG" alt="photoProfil" />
            <?php
        } else {
            ?> 
            <img class="photoProfilAvis" src="../../images/<?php echo $donnees['lien_photo'] ?>" alt="photoProfil" />
            <?php
        }
        echo "<h4 class=\"col-qm-6\">" . $donnees['nom'] . ' ' . $donnees['prenom'] . "</h4>";
        for ($i = 0; $i < $donnees['note']; ++$i) {
            echo '★';
        }
        for ($j = 0; $j < 10 - $donnees['note']; ++$j) {
            echo '☆';
        }
        echo '</div>';
        echo "<p>" . $donnees['description'] . "</p>";
        return 0;
    }
    echo "<p>Pas d'avis pour cet utilisateur</p>";
}
