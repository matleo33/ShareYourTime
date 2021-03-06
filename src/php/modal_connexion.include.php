<!-- Modal -->
<div class="modal fade" id="modalConnexion" role="dialog">
    <div class="modal-dialog modal-sm">

        <!-- Contenu du modal -->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Connexion</h4>
            </div>
            <!-- Formulaire de connexion -->
            <form method="post" id="formConnexion">
                <div class="form-group col-sm-10 col-sm-offset-1" id="divMail">
                    <label for="inputEmail">Adresse mail</label>
                    <input type="email" class="form-control" id="inputEmailConnexion" name="inputEmailConnexion" placeholder="Email" required>
                </div>
                <div class="form-group col-sm-10 col-sm-offset-1" id="divPassword">
                    <label for="inputPassword">Password</label>
                    <input type="password" class="form-control" id="inputPasswordConnexion" name="inputPasswordConnexion"
                           placeholder="Mot de passe" required>
                </div>
                <!-- Appel du formulaire mot de passe oublié -->
                <div class="modal-footer">
                    <input type="submit" class="btn btn-default center-block" value="Connexion" id="inputConnexion"/>
                    <span data-dismiss="modal" data-toggle="modal" data-target="#modalMdpOublie"><a href="#">Mot de passe oublié</a></span>
                </div>
            </form>
        </div>

    </div>
</div>
