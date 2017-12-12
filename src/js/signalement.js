/*
 function test() {
 var valeur_radio = $('input[name="exampleRadios"]:checked').val();
 var id = "exampleRadios" + valeur_radio;
 document.getElementById(id).;

 }*/

$(document).ready(function (e) {
    //e.preventDefault();
    $("#exampleRadios1").click(function () {
        document.getElementById("exampleRadios1").setAttribute("checked", "checked");
        document.getElementById("exampleRadios2").setAttribute("checked", "");
        document.getElementById("exampleRadios3").setAttribute("checked", "");
        document.getElementById("exampleRadios4").setAttribute("checked", "");
        document.getElementById("exampleRadios5").setAttribute("checked", "");
        document.getElementById("exampleRadios6").setAttribute("checked", "");
        return true; // permet de ne pas recharger la page
    });
});

$(document).ready(function (e) {
    //e.preventDefault();
    $("#exampleRadios2").click(function () {
        document.getElementById("exampleRadios1").setAttribute("checked", "");
        document.getElementById("exampleRadios2").setAttribute("checked", "checked");
        document.getElementById("exampleRadios3").setAttribute("checked", "");
        document.getElementById("exampleRadios4").setAttribute("checked", "");
        document.getElementById("exampleRadios5").setAttribute("checked", "");
        document.getElementById("exampleRadios6").setAttribute("checked", "");
        return true; // permet de ne pas recharger la page
    });
});

$(document).ready(function (e) {
    //e.preventDefault();
    $("#exampleRadios3").click(function () {
        document.getElementById("exampleRadios1").setAttribute("checked", "");
        document.getElementById("exampleRadios2").setAttribute("checked", "");
        document.getElementById("exampleRadios3").setAttribute("checked", "checked");
        document.getElementById("exampleRadios4").setAttribute("checked", "");
        document.getElementById("exampleRadios5").setAttribute("checked", "");
        document.getElementById("exampleRadios6").setAttribute("checked", "");
        return true; // permet de ne pas recharger la page
    });
});

$(document).ready(function (e) {
    //e.preventDefault();
    $("#exampleRadios4").click(function () {
        document.getElementById("exampleRadios1").setAttribute("checked", "");
        document.getElementById("exampleRadios2").setAttribute("checked", "");
        document.getElementById("exampleRadios3").setAttribute("checked", "");
        document.getElementById("exampleRadios4").setAttribute("checked", "checked");
        document.getElementById("exampleRadios5").setAttribute("checked", "");
        document.getElementById("exampleRadios6").setAttribute("checked", "");
        return true; // permet de ne pas recharger la page
    });
});

$(document).ready(function (e) {
    //e.preventDefault();
    $("#exampleRadios5").click(function () {
        document.getElementById("exampleRadios1").setAttribute("checked", "");
        document.getElementById("exampleRadios2").setAttribute("checked", "");
        document.getElementById("exampleRadios3").setAttribute("checked", "");
        document.getElementById("exampleRadios4").setAttribute("checked", "");
        document.getElementById("exampleRadios5").setAttribute("checked", "checked");
        document.getElementById("exampleRadios6").setAttribute("checked", "");
        return true; // permet de ne pas recharger la page
    });
});

$(document).ready(function (e) {
    //e.preventDefault();
    $("#exampleRadios6").click(function () {
        document.getElementById("exampleRadios1").setAttribute("checked", "");
        document.getElementById("exampleRadios2").setAttribute("checked", "");
        document.getElementById("exampleRadios3").setAttribute("checked", "");
        document.getElementById("exampleRadios4").setAttribute("checked", "");
        document.getElementById("exampleRadios5").setAttribute("checked", "");
        document.getElementById("exampleRadios6").setAttribute("checked", "checked");
        return true; // permet de ne pas recharger la page
    });
});
