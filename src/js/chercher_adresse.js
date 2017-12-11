$(document).ready(function(e) {
    //e.preventDefault();
    $("#formReinitMDP").submit(function () {
        $.get("chercher_adresse.php",$(this).serialize(),function(id){
            if(id != 0) {
                document.getElementById("tested").innerHTML = "Un mail a été envoyé, vérifiez votre boîte de réception";
            } else {
                document.getElementById("tested").innerHTML = "Cette adresse mail n'existe pas !";
            }
            /*var currentLocation =  document.location.href;
            currentLocation = currentLocation.substring( 0 ,currentLocation.lastIndexOf( "src" ) );
            window.location.href = currentLocation ;*/
        });
        return false; // permet de ne pas recharger la page
    });
});