<!-- Modal -->
<div class="modal fade" id="modalConnexion" role="dialog">
    <div class="modal-dialog modal-sm">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Connexion</h4>
            </div>
            <form method="post" action="traiter_connexion.php">
                <div class="form-group col-sm-10 col-sm-offset-1" style="margin-top: 10px">
                    <label for="inputEmail">Adresse mail</label>
                    <input type="email" class="form-control" id="inputEmail" name="inputEmail" placeholder="Email">
                </div>
                <div class="form-group col-sm-10 col-sm-offset-1">
                    <label for="inputPassword">Password</label>
                    <input type="password" class="form-control" id="inputPassword" name="inputPassword"
                           placeholder="Mot de passe">
                </div>
                <div class="modal-footer">
                    <input type="submit" class="btn btn-default center-block" value="Connexion" style="margin-bottom: 10px"/>
                    <a href="#">Mot de passe oublié</a>
                </div>
            </form>
        </div>

    </div>
</div>
