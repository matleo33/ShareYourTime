<?php

function getEtapes($bdd, string $id_trajet) {
    $reponseEtapes = $bdd->query('SELECT * '
            . 'FROM trajet INNER JOIN etape on trajet.id_trajet = etape.trajet '
            . 'WHERE id_trajet=\'' . $id_trajet . '\' ');
    while ($donneesEtape = $reponseEtapes->fetch()) {
        ?>
        <div class="col-sm-8 col-sm-offset-2" id="divEtape">
            <?php
            echo 'Etape ' . $donneesEtape['num_etape'] . ' : ' . $donneesEtape['ville'] . ', ' . $donneesEtape['lieu'];
            ?>
        </div>
        <?php
    }
}
?>
