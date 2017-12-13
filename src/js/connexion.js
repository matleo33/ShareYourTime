$(document).ready(function() {
    $("#formConnexion").submit(function () {
        $.ajax(
            {url: "traiter_connexion.php",
                success: function (data) {
                    if (data != 0) {
                        var array = document.referrer.split("/");
                        var taille = array.length;
                        window.location.replace(array[taille-1]);
                    } else {
                        var node = document.createElement("div");
                        node.setAttribute("class","alert alert-danger");
                        var boutonFermeture = document.createElement("a");
                        boutonFermeture.setAttribute("href","#");
                        boutonFermeture.setAttribute("class","close");
                        boutonFermeture.setAttribute("data-dismiss","alert");
                        boutonFermeture.setAttribute("aria-label","close");
                        var bouton = document.createTextNode("x"); //TODO optionnel remplacer par &times;
                        boutonFermeture.appendChild(bouton);
                        node.appendChild(boutonFermeture);
                        var textnode = document.createTextNode("Adresse mail et/ou mot de passe erroné(s)");
                        node.appendChild(textnode);
                        document.getElementById("divPassword").appendChild(node);
                    }
                },
                error: function (data) {
                    alert(data);
                },
                data: $(this).serialize()
        });
        return false;
    });
});
