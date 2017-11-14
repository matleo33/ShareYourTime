$(function () {
    var availableTags = [
        "Reggae Sun Ska",
        "Electrobeach",
        "Garorock",
        "Ferias de Bayonne",
        "PSG - OM",
        "Roland Garros",
        "France - Nouvelle Zélande"
    ];

    $( "#tags" ).autocomplete({
        source: function (request, response) {
            var matcher = new RegExp("^"+$.ui.autocomplete.escapeRegex(request.term), "i");
            response($.grep(availableTags, function (item) {
                return matcher.test(item);
            }))
        }
    });
} );

window.onresize = function() {
    $( "#tags" ).autocomplete( "close" );
}

function search () {
    var event = document.getElementById("tags").value;
    var link = "../php/" + event + ".php";
    window.open(event);
}