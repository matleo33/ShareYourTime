<!-- Modal -->
<div class="modal fade" id="modalMdpOublie" role="dialog">
    <div class="modal-dialog modal-sm">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Mot de passe oublié</h4>
            </div>
            <form method="post" id="formReinitMDP">
                <div class="form-group col-sm-10 col-sm-offset-1" id="divMail">
                    <label for="inputReinitEmail">Adresse mail</label>
                    <input type="email" class="form-control" id="inputReinitEmail" name="inputReinitEmail" placeholder="Email">
                </div>

                <div class="modal-footer" id="divConfirm">
                    <p id="tested"></p>
                    <input id="buttonConfirm" class="btn btn-default center-block" type="submit" value="Confirmer" />
                    <!-- <button type="button" class="btn btn-default center-block" id="buttonConfirm" onclick="test();">Confirmer</button> -->
                    <!-- <input type="submit" class="btn btn-default center-block" value="Inscription" id="inputInscription"/> -->
                </div>
            </form>
        </div>

    </div>
</div>
