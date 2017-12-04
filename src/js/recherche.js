$(function () {

    var availableTags = [];

    $(document).ready(function () {
        //e.preventDefault();
        $.get("get_events.php", $(this).serialize(), function (texte) {
            var arrayOfStrings = texte.split(",");
            for (var i = 0; i < arrayOfStrings.length-1; i++) {
                availableTags.push(arrayOfStrings[i]);
            }
        });
        return false; // permet de ne pas recharger la page
    });

    $("#tags").autocomplete({
        source: function (request, response) {
            var matcher = new RegExp("^" + $.ui.autocomplete.escapeRegex(request.term), "i");
            response($.grep(availableTags, function (item) {
                return matcher.test(item);
            }))
        }
    });
});

window.onresize = function () {
    $("#tags").autocomplete("close");
}

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
        return false; // permet de ne pas recharger la page
    });
});