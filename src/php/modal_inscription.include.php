<!-- Modal -->
<div class="modal fade" id="modalInscription" role="dialog">
    <div class="modal-dialog modal-sm">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Inscription</h4>
            </div>
            <form method="post" action="traiter_inscription.php">
                <div class="form-group col-sm-10 col-sm-offset-1" id="divFirstName">
                    <input type="text" class="form-control" id="inputFirstName" name="inputFirstName"
                           placeholder="Prénom" required>
                </div>
                <div class="form-group col-sm-10 col-sm-offset-1">
                    <input type="text" class="form-control" id="inputName" name="inputName" placeholder="Nom" required>
                </div>
                <div class="form-group col-sm-10 col-sm-offset-1">
                    <input type="email" class="form-control" id="inputMail" name="inputMail"
                           placeholder="prenom.nom@etu.u-bordeaux.fr" required>
                </div>
                <div class="form-group col-sm-10 col-sm-offset-1">
                    <input type="password" class="form-control" id="inputPassword" name="inputPassword"
                           placeholder="Mot de passe" required>
                </div>
                <div class="form-group col-sm-10 col-sm-offset-1">
                    <input type="password" class="form-control" id="inputCheckPassword" name="inputCheckPassword"
                           placeholder="Répétez votre mot de passe" required>
                </div>
                <!--
                <div class="form-group col-sm-10 col-sm-offset-1">
                    <input type="number" min="0" class="form-control" id="inputAge" name="inputAge" placeholder="Âge" required>
                </div>-->
                <div class="form-group col-sm-4 col-sm-offset-1">
                    <input type="text" class="form-control" id="inputNumber" name="inputNumber" placeholder="N°"
                           required>
                </div>
                <div class="form-group col-sm-6">
                    <input type="text" class="form-control" id="inputType" name="inputType" placeholder="Type rue"
                           required>
                </div>
                <div class="form-group col-sm-10 col-sm-offset-1">
                    <input type="text" class="form-control" id="inputAddress" name="inputAddress" placeholder="Adresse"
                           required>
                </div>
                <div class="form-group col-sm-4 col-sm-offset-1">
                    <input type="text" class="form-control" id="inputPC" name="inputPC" placeholder="CP" required>
                </div>
                <div class="form-group col-sm-6">
                    <input type="text" class="form-control" id="inputCity" name="inputCity" placeholder="Ville"
                           required>
                </div>
                <div class="form-group col-sm-10 col-sm-offset-1">
                    <input type="tel" class="form-control" id="inputPhoneNumber" name="inputPhoneNumber"
                           placeholder="Numéro de téléphone" required>
                </div>
                <div class="form-group col-sm-10 col-sm-offset-1">
                    <input type="date" id="inputBirthDate" name="inputBirthDate" class="form-control">
                </div>
                <div class="modal-footer">
                    <input type="submit" class="btn btn-default center-block" value="Inscription"
                           id="inputInscription"/>
                </div>
            </form>

        </div>

    </div>
</div>
