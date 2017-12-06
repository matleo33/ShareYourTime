<!-- Modal -->
<div class="modal fade" id="modalInscription" role="dialog">
    <div class="modal-dialog modal-sm">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Inscription</h4>
            </div>
            <form method="post" action="inscription.php">
                <div class="form-group col-sm-10 col-sm-offset-1" style="margin-top: 20px">
                    <input type="text" class="form-control" id="inputFirstName" name="inputFirstName" placeholder="Prénom">
                </div>
                <div class="form-group col-sm-10 col-sm-offset-1">
                    <input type="text" class="form-control" id="inputName" name="inputName" placeholder="Nom">
                </div>
                <div class="form-group col-sm-10 col-sm-offset-1">
                    <input type="email" class="form-control" id="inputMail" name="inputMail" placeholder="prenom.nom@etu.u-bordeaux.fr">
                </div>
                <div class="form-group col-sm-10 col-sm-offset-1">
                    <input type="password" class="form-control" id="inputPassword" name="inputPassword" placeholder="Mot de passe">
                </div>
                <div class="form-group col-sm-10 col-sm-offset-1">
                    <input type="password" class="form-control" id="inputCheckPassword" name="inputCheckPassword" placeholder="Répétez votre mot de passe">
                </div>
                <div class="form-group col-sm-10 col-sm-offset-1">
                    <input type="number" min="0" class="form-control" id="inputAge" name="inputAge" placeholder="Âge">
                </div>
                <div class="form-group col-sm-4 col-sm-offset-1">
                    <input type="text" class="form-control" id="inputNumber" name="inputNumber" placeholder="N°">
                </div>
                <div class="form-group col-sm-6">
                    <input type="text" class="form-control" id="inputType" name="inputType" placeholder="Type rue">
                </div>
                <div class="form-group col-sm-10 col-sm-offset-1">
                    <input type="text" class="form-control" id="inputAddress" name="inputAddress" placeholder="Adresse">
                </div>
                <div class="form-group col-sm-4 col-sm-offset-1">
                    <input type="text" class="form-control" id="inputPC" name="inputPC" placeholder="CP">
                </div>
                <div class="form-group col-sm-6">
                    <input type="text" class="form-control" id="inputCity" name="inputCity" placeholder="Ville">
                </div>
                <div class="form-group col-sm-10 col-sm-offset-1">
                    <input type="tel" class="form-control" id="inputPhoneNumber" name="inputPhoneNumber" placeholder="Numéro de téléphone">
                </div>
            </form>
            <div class="modal-footer">
                <button type="button" class="btn btn-default center-block" data-dismiss="modal" style="margin-bottom: 10px">Inscription</button>
            </div>
        </div>

    </div>
</div>
