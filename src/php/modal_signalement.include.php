<!-- Modal -->
<div class="modal fade" id="modalSignalement" role="dialog">
    <div class="modal-dialog modal-md">

        <!-- Modal content-->
        <div class="modal-content">
            <form method="post" action="#">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title text-center">Signalement</h4>
                </div>
                <div class="form-check col-sm-offset-1 col-sm-10" id="divSignalement">
                    <label class="form-check-label">
                        <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios"
                               value="option1">
                        Un problème sur l'annonce ou le profil
                    </label>
                </div>
                <div class="form-check col-sm-offset-1 col-sm-10">
                    <label class="form-check-label">
                        <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios1"
                               value="option2">
                        Prix ou méthode douteuse
                    </label>
                </div>
                <div class="form-check col-sm-offset-1 col-sm-10">
                    <label class="form-check-label">
                        <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios2"
                               value="option3">
                        Comportement dangereux
                    </label>
                </div>
                <div class="form-check col-sm-offset-1 col-sm-10">
                    <label class="form-check-label">
                        <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios3"
                               value="option4">
                        Attitude négative
                    </label>
                </div>
                <div class="form-check col-sm-offset-1 col-sm-10">
                    <label class="form-check-label">
                        <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios4"
                               value="option5">
                        Trajet non réalisé
                    </label>
                </div>
                <div class="form-check col-sm-offset-1 col-sm-10">
                    <label class="form-check-label">
                        <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios5"
                               value="option6">
                        Autre
                    </label>
                </div>
                <div class="form-group col-sm-offset-1 col-sm-10">
                    <textarea class="form-control" id="message-text"></textarea>
                </div>

                <div class="modal-footer">
                    <input type="submit" class="btn btn-default center-block" value="Signaler" id="signalement"/>
                </div>
            </form>
        </div>

    </div>
</div>
