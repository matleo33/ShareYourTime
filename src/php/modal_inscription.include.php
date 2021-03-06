<!-- Modal -->
<div class="modal fade" id="modalInscription" role="dialog">
    <div class="modal-dialog modal-md" style="width:500px;">

        <!-- Contenu du modal -->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Inscription</h4>
            </div>
            <!-- Formulaire d'inscription -->
            <form method="post" action="traiter_inscription.php">
                <div class="form-group col-sm-12" id="divFirstName">
                    <div class="col-sm-1" style="color:#F62">*</div>
                    <div class="col-sm-10">
                    <input type="text" class="form-control" id="inputFirstName" name="inputFirstName"
                           placeholder="Prénom" required>
                </div>
                </div>
                <div class="form-group col-sm-12">
                    <div class="col-sm-1" style="color:#F62">*</div>
                    <div class="col-sm-10"><input type="text" class="form-control col-sm-10" id="inputName" name="inputName" placeholder="Nom" required></div>
                </div>
               <div class="form-group col-sm-12">
                    
                        <div class="col-sm-1" style="color:#F62">*</div>
                        <div class="col-sm-10">
                        <input type="email" class="form-control" id="inputMail" name="inputMail"
                               placeholder="prenom.nom@etu.u-bordeaux.fr" required>
                    </div>
                </div>
                <div class="form-group col-sm-12">
                    
                        <div class="col-sm-1" style="color:#F62">*</div>
                        <div class="col-sm-10">
                        <input type="password" class="form-control" data-toggle="tooltip" data-placement="left" title="Ecris ce quy'il faut" id="inputPassword" name="inputPassword" pattern='^.*(?=.{8,})(?=.*[a-zA-Z])(?=.*\d)(?=.*[!#$%&?"]).*$'
                               placeholder="Mot de passe" required>
                    </div>
                </div>
               <div class="form-group col-sm-12">
                    
                        <div class="col-sm-1" style="color:#F62">*</div>
                        <div class="col-sm-10">
                        <input type="password" class="form-control" id="inputCheckPassword" name="inputCheckPassword"
                               placeholder="Répétez votre mot de passe" required>
                    </div>
                </div>
                <div class="form-group col-sm-6">
                    
                        <div class="col-sm-1" style="color:#F62">*</div>
                        <div class="col-sm-8">
                        <input type="text" class="form-control" id="inputNumber" name="inputNumber" placeholder="N°"
                               required>
                    </div>
                </div>
                <div class="form-group col-sm-6">
                    <div class="col-sm-1" style="color:#F62">*</div>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="inputType" name="inputType" placeholder="Type rue"
                               required>
                    </div>
                </div>
                <div class="form-group col-sm-12">
                    
                        <div class="col-sm-1" style="color:#F62">*</div>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="inputAddress" name="inputAddress" placeholder="Adresse"
                               required>
                    </div>
                </div>
                <div class="form-group col-sm-6">
                    <div class="col-sm-1" style="color:#F62">*</div>
                    <div class="col-sm-8">
                    <input type="text" class="form-control" id="inputPC" name="inputPC" placeholder="CP" required>
                    </div>
                </div>
                <div class="form-group col-sm-6">
                    <div class="col-sm-1" style="color:#F62">*</div>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="inputCity" name="inputCity" placeholder="Ville"
                               required>
                    </div>
                </div>
                <div class="form-group col-sm-12">
                    <div class="col-sm-1" style="color:#F62">*</div>
                    <div class="col-sm-10">
                        <input type="tel" class="form-control" id="inputPhoneNumber" name="inputPhoneNumber"
                               placeholder="Numéro de téléphone" required>
                    </div>
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
<script>
    $(document).ready(function(){
        $('[data-toggle="tooltip"]').tooltip();
    });
</script>