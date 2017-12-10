//à renommer de façon plus cohérente

$(document).on('click', '#close-preview', function(){
    $('.image-preview').popover('hide');
    // Hover befor close the preview
    $('.image-preview').hover(
        function () {
            $('.image-preview').popover('show');
        },
        function () {
            $('.image-preview').popover('hide');
        }
    );
});

$(function() {
    // Create the close button
    var closebtn = $('<button/>', {
        type:"button",
        text: 'x',
        id: 'close-preview',
        style: 'font-size: initial;',
    });
    closebtn.attr("class","close pull-right");
    // Set the popover default content
    $('.image-preview').popover({
        trigger:'manual',
        html:true,
        title: "<strong>Aperçu</strong>"+$(closebtn)[0].outerHTML,
        content: "Il n'y a pas d'image",
        placement:'bottom'
    });
    // Clear event
    $('.image-preview-clear').click(function(){
        $('.image-preview').attr("data-content","").popover('hide');
        $('.image-preview-filename').val("");
        $('.image-preview-clear').hide();
        $('.image-preview-input input:file').val("");
        $(".image-preview-input-title").text("Parcourir");
    });
    // Create the preview image
    $(".image-preview-input input:file").change(function (){
        var img = $('<img/>', {
            id: 'dynamic',
            width:250,
            height:200
        });
        var file = this.files[0];
        var reader = new FileReader();
        // Set preview image into the popover data-content
        reader.onload = function (e) {
            $(".image-preview-input-title").text("Changer");
            $(".image-preview-clear").show();
            $(".image-preview-filename").val(file.name);
            img.attr('src', e.target.result);
            $(".image-preview").attr("data-content",$(img)[0].outerHTML).popover("show");
        }

        reader.readAsDataURL(file);
    });
});

function goToEvent(id)
{
    var currentLocation =  document.location.href;
    currentLocation = currentLocation.substring( 0 ,currentLocation.lastIndexOf( "src" ) );
    currentLocation += 'src/php/evenement.php?id_events=' + id;
    window.location.href = currentLocation ;
}

var eventName;
$(document).ready(function(e) {
    //e.preventDefault();
    $("#formRecherche").submit(function () {
        $.get("rechercheEvenement.php",$(this).serialize(),function(id){
            if(id != '')
            {
                goToEvent(id);
                //window.location.href = 'http://localhost:63342/ShareYourTime/src/php/evenement.php?id_events=' + texte;
            }
            else
            {
                $("#containerCreation").css("visibility", "visible");
                $("#eventName").attr("disabled","disabled");//TODO Faire avec readonly au lieu de disabled
                eventName = $("#eventName").val();
            }

        });
        return false; // permet de ne pas recharger la page
    });
});
/*$(document).ready(function(e) {
 //e.preventDefault();
 $("#formRechercheSuite").submit(function () {
 $.ajax({
 url : "inserer_evenement_BD.php",
 type : 'GET',//Impossible à faire marcher en POST
 data : 'nom=' + eventName +
 '&description=' + $("#description").val() +
 '&lien_photo=' + 'modifneeded' +
 '&date_debut=' + $("#date_debut").val() +
 '&date_fin=' + $("#date_fin").val() +
 '&lien_fb=' + $("#lien_fb").val() +
 '&lien_billet=' + $("#lien_billet").val() +
 '&adresse=' + $("#adressAutoComplete").val(),
 dataType : 'html',
 success : function(id){
 goToEvent(id);
 //TODO Creer le pop-up indiquant la création de l'event et permettant d'y accéder
 //TODO afficher message d'erreur si id est = ''
 },
 error : function () {
 //TODO Faire ce qu'il faut lorsque qu'il y a une erreur dans la réponse du PHP
 }
 });
 return false;
 });
 });*/