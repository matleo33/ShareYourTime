$(function () {

    var availableTags = [];

    // On remplit le tableau avec tous les nom d'événements existants dans la base de données
    $(document).ready(function () {
        //e.preventDefault();
        $.get("get_events.php", $(this).serialize(), function (texte) {
            var arrayOfStrings = texte.split(",");
            for (var i = 0; i < arrayOfStrings.length-1; i++) {
                availableTags.push(arrayOfStrings[i]);
            }
        });
        return false; // Permet de ne pas recharger la page
    });

    // Sélection des noms qui correspondent aux entrées de l'utilisateur
    $("#tags").autocomplete({
        source: function (request, response) {
            var matcher = new RegExp("^" + $.ui.autocomplete.escapeRegex(request.term), "i");
            response($.grep(availableTags, function (item) {
                return matcher.test(item);
            }))
        }
    });
});

// Réalisation de l'autocomplétion sur la page
$(document).ready(function(e) {
    //e.preventDefault();
    $("#formRechercheNavbar").submit(function () {
        $.get("rechercheEvenement.php",$(this).serialize(),function(id){
            var currentLocation =  document.location.href;
            currentLocation = currentLocation.substring( 0 ,currentLocation.lastIndexOf( "src" ) );
            if(id == '')
            {
                currentLocation += 'src/php/recherche.php?nomEvent=' + document.getElementById("tags").value;
            }
            else
            {
                currentLocation += 'src/php/evenement.php?id_events=' + id;
            }
            window.location.href = currentLocation ;
        });
        return false; // Permet de ne pas recharger la page
    });
});

window.onresize = function () {
    $("#tags").autocomplete("close");
}
