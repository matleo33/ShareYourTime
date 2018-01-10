<!-- Modal -->
<div class="modal fade" id="modalSignalement" role="dialog">
    <div class="modal-dialog modal-md">

        <!-- Contenu du modal -->
        <div class="modal-content">
            <!-- Formulaire d'envoi d'un signalement -->
            <form method="post" id="formSignalement" action="traiter_signalement.php">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title text-center">Signalement</h4>
                </div>
                <div class="form-check col-sm-offset-1 col-sm-10" id="divSignalement">
                    <label class="form-check-label">
                        <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios1"
                               value="1" checked style="margin-top: 10px"> <!-- TODO mettre le style dans le CSS mais je veux pas de merge stp -->
                        Un problème sur l'annonce ou le profil
                    </label>
                </div>
                <div class="form-check col-sm-offset-1 col-sm-10">
                    <label class="form-check-label">
                        <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios2"
                               value="2" checked>
                        Prix ou méthode douteuse
                    </label>
                </div>
                <div class="form-check col-sm-offset-1 col-sm-10">
                    <label class="form-check-label">
                        <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios3"
                               value="3" checked>
                        Comportement dangereux
                    </label>
                </div>
                <div class="form-check col-sm-offset-1 col-sm-10">
                    <label class="form-check-label">
                        <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios4"
                               value="4" checked>
                        Attitude négative
                    </label>
                </div>
                <div class="form-check col-sm-offset-1 col-sm-10">
                    <label class="form-check-label">
                        <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios5"
                               value="5" checked>
                        Trajet non réalisé
                    </label>
                </div>
                <div class="form-check col-sm-offset-1 col-sm-10">
                    <label class="form-check-label">
                        <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios6"
                               value="6" checked>
                        Autre
                    </label>
                </div>
                <div class="form-group col-sm-offset-1 col-sm-10">
                    <textarea class="form-control" id="message-text" name="message"></textarea>
                </div>

                <div class="modal-footer">
                    <input type="submit" class="btn btn-default center-block" value="Signaler" id="inputSignalement"/>
                </div>
            </form>
        </div>

    </div>
</div>
