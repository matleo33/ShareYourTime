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

    $("#eventName").autocomplete({
        source: function (request, response) {
            var matcher = new RegExp("^" + $.ui.autocomplete.escapeRegex(request.term), "i");
            response($.grep(availableTags, function (item) {
                return matcher.test(item);
            }))
        }
    });
});