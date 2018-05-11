<!-- Modal -->
<div class="modal fade" id="modalInscription" role="dialog">
    <div class="modal-dialog modal-sm">

        <!-- Contenu du modal -->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Inscription</h4>
            </div>
            <!-- Formulaire d'inscription -->
            <form method="post" action="traiter_inscription.php">
                <div class="form-group col-sm-10 col-sm-offset-1" id="divFirstName"><span style="color:#F62">*</span>
                    <input type="text" class="form-control" id="inputFirstName" name="inputFirstName"
                           placeholder="Prénom" required>
                </div>
                <div class="form-group col-sm-9 col-sm-offset-1"><span class="col-sm-1" style="color:#F62">*</span>
                    <input type="text" class="form-control" id="inputName" name="inputName" placeholder="Nom" required>
                </div>
                <div class="form-group col-sm-10 col-sm-offset-1"><span style="color:#F62">*</span>
                    <input type="email" class="form-control" id="inputMail" name="inputMail"
                           placeholder="prenom.nom@etu.u-bordeaux.fr" required>
                </div>
                <div class="form-group col-sm-10 col-sm-offset-1"><span style="color:#F62">*</span>
                    <input type="password" class="form-control" id="inputPassword" name="inputPassword" pattern='^.*(?=.{8,})(?=.*[a-zA-Z])(?=.*\d)(?=.*[!#$%&?"]).*$'
                           placeholder="Mot de passe" required>
                </div>
                <div class="form-group col-sm-10 col-sm-offset-1"><span style="color:#F62">*</span>
                    <input type="password" class="form-control" id="inputCheckPassword" name="inputCheckPassword"
                           placeholder="Répétez votre mot de passe" required>
                </div>
                <div class="form-group col-sm-4 col-sm-offset-1"><span style="color:#F62">*</span>
                    <input type="text" class="form-control" id="inputNumber" name="inputNumber" placeholder="N°"
                           required>
                </div>
                <div class="form-group col-sm-6"><span style="color:#F62">*</span>
                    <input type="text" class="form-control" id="inputType" name="inputType" placeholder="Type rue"
                           required>
                </div>
                <div class="form-group col-sm-10 col-sm-offset-1"><span style="color:#F62">*</span>
                    <input type="text" class="form-control" id="inputAddress" name="inputAddress" placeholder="Adresse"
                           required>
                </div>
                <div class="form-group col-sm-4 col-sm-offset-1"><span style="color:#F62">*</span>
                    <input type="text" class="form-control" id="inputPC" name="inputPC" placeholder="CP" required>
                </div>
                <div class="form-group col-sm-6"><span style="color:#F62">*</span>
                    <input type="text" class="form-control" id="inputCity" name="inputCity" placeholder="Ville"
                           required>
                </div>
                <div class="form-group col-sm-10 col-sm-offset-1"><span style="color:#F62">*</span>
                    <input type="tel" class="form-control" id="inputPhoneNumber" name="inputPhoneNumber"
                           placeholder="Numéro de téléphone" required>
                </div>
                <div class="form-group col-sm-10 col-sm-offset-1">
                    <input type="date" id="inputBirthDate" name="inputBirthDate" class="form-control">
                </div>
                <div class="modal-footer">
                    <input type="submit" class="btn btn-default center-block" value="Inscription"
                           id="inputInscription"/>
                    <span style="color:#F62">* : obligatoire</span>
                </div>
            </form>
        </div>
    </div>
</div>
