/*$(document).ready(function(e) {
    $("#formConnexion").submit(function () {
        $.get("traiter_connexion.php", $(this).serialize(), function (id) {
            if (id != 0) {
                window.location.replace("index.php");
            } else {
                document.getElementById("inputPasswordConnexion");

            }
        });
        return false;
    });
});*/

$(document).ready(function() {
    $("#formConnexion").submit(function () {
        $.ajax(
            {url: "traiter_connexion.php",
                success: function (data) {
                    if (data != 0) {
                        window.location.replace("index.php");
                    } else {
                        var node = document.createElement("div");
                        node.setAttribute("class","alert alert-danger");
                        var boutonFermeture = document.createElement("a");
                        boutonFermeture.setAttribute("href","#");
                        boutonFermeture.setAttribute("class","close");
                        boutonFermeture.setAttribute("data-dismiss","alert");
                        boutonFermeture.setAttribute("aria-label","close");
                        var bouton = document.createTextNode("x"); //TODO remplacer par &times;
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