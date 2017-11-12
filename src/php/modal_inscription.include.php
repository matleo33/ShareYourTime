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
                    <input type="text" class="form-control" id="inputFirstName" placeholder="Prénom">
                </div>
                <div class="form-group col-sm-10 col-sm-offset-1">
                    <input type="text" class="form-control" id="inputName" placeholder="Nom">
                </div>
                <div class="form-group col-sm-10 col-sm-offset-1">
                    <input type="email" class="form-control" id="inputMail" placeholder="prenom.nom@etu.u-bordeaux.fr">
                </div>
                <div class="form-group col-sm-10 col-sm-offset-1">
                    <input type="password" class="form-control" id="inputPassword" placeholder="Mot de passe">
                </div>
                <div class="form-group col-sm-10 col-sm-offset-1">
                    <input type="password" class="form-control" id="inputCheckPassword" placeholder="Répétez votre mot de passe">
                </div>
                <div class="form-group col-sm-10 col-sm-offset-1">
                    <input type="number" min="0" class="form-control" id="inputAge" placeholder="Âge">
                </div>
                <div class="form-group col-sm-4 col-sm-offset-1">
                    <input type="text" class="form-control" id="inputNumber" placeholder="N°">
                </div>
                <div class="form-group col-sm-6">
                    <input type="text" class="form-control" id="inputType" placeholder="Type rue">
                </div>
                <div class="form-group col-sm-10 col-sm-offset-1">
                    <input type="text" class="form-control" id="inputAddress" placeholder="Adresse">
                </div>
                <div class="form-group col-sm-4 col-sm-offset-1">
                    <input type="text" class="form-control" id="inputPC" placeholder="CP">
                </div>
                <div class="form-group col-sm-6">
                    <input type="text" class="form-control" id="inputCity" placeholder="Ville">
                </div>
                <div class="form-group col-sm-10 col-sm-offset-1">
                    <input type="tel" class="form-control" id="inputPhoneNumber" placeholder="Numéro de téléphone">
                </div>
            </form>
            <div class="modal-footer">
                <button type="button" class="btn btn-default center-block" data-dismiss="modal" style="margin-bottom: 10px">Inscription</button>
            </div>
        </div>

    </div>
</div>
