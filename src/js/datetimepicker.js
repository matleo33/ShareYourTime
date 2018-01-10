/*$(function () {
 $('.datetimepicker').datetimepicker({
 autoclose: true
 //language : 'fr' //TODO Insertion ne marche pas si la date est au format FR
 });
 });*/
//DateTimePicker de la page creer_evenement.php
$(function () {
    $('#datetimepicker_date_fin').datetimepicker({
        autoclose: true,
        startDate: new Date()
    });
});

$(function () {
    $('#datetimepicker_date_debut').datetimepicker({
        autoclose: true,
        startDate: new Date() //TODO Insertion ne marche pas si la date est au format FR
    });
});

$('#datetimepicker_date_debut').on('changeDate', function (e) {
    $('#datetimepicker_date_fin').datetimepicker('setStartDate', e.date);
});
$('#datetimepicker_date_fin').on('changeDate', function (e) {
    $('#datetimepicker_date_debut').datetimepicker('setEndDate', e.date);
});

