<?php session_start();?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <link href="./../css/style.css" rel="stylesheet">

    <!-- Bootstrap-->
    <link rel="stylesheet" href="./../BootStrap/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="../js/recherche.js"></script>
    <script src="../BootStrap/js/bootstrap.min.js"></script>

    <style>
        .input-symbol-euro {
            position: relative;
            display: inline-block;
            width: 50%;
        }
        .input-symbol-euro input {
            padding-right: 15px;
            width: 100%;
        }
        .input-symbol-euro:after {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            margin: auto;
            content:"€";
            right: 20px;
        }

        .form-control {
            display: block;
            height: 34px;
            padding: 6px 12px;
            font-size: 14px;
            line-height: 1.42857143;
            color: #555;
            background-color: #fff;
            background-image: none;
            border: 1px solid #ccc;
            border-radius: 4px;
            -webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, .075);
            box-shadow: inset 0 1px 1px rgba(0, 0, 0, .075);
            -webkit-transition: border-color ease-in-out .15s, -webkit-box-shadow ease-in-out .15s;
            -o-transition: border-color ease-in-out .15s, box-shadow ease-in-out .15s;
            transition: border-color ease-in-out .15s, box-shadow ease-in-out .15s;
        }
        .form-control:focus {
            border-color: #66afe9;
            outline: 0;
            -webkit-box-shadow: inset 0 1px 1px rgba(0,0,0,.075), 0 0 8px rgba(102, 175, 233, .6);
            box-shadow: inset 0 1px 1px rgba(0,0,0,.075), 0 0 8px rgba(102, 175, 233, .6);
        }

        .form-control[disabled],
        .form-control[readonly],
        fieldset[disabled] .form-control {
            cursor: not-allowed;
            background-color: #eee;
            opacity: 1;
        }
    </style>


    <title>Share Your Time</title>
</head>

<body>
<?php include 'navbar.include.php'; ?><br/>
<?php include 'modal_connexion.include.php' ?>
<?php include 'modal_inscription.include.php' ?>
<div class="container-fluid">
<div class="col-sm-12">
    <h1 class="text-center">RECHERCHE</h1>
</div>
<div class="col-sm-12 text-center">
    <div class="col-sm-3 col-sm-offset-2">
        <input id="nom_event" name="nom_event" placeholder="Nom de l'événement"<?php
        if (isset($_GET['nomEvent'])) {
            echo "value=\"" . $_GET['nomEvent'] . "\"";
        }
        ?>
        /></div>
    <div class="col-sm-6">
        <button id="recherche_evenement">Rechercher</button>
    </div>
    <div class="col-sm-3 col-sm-offset-2">
        <a id="optionAvancee" href="#" onclick="activerOptionAvancee()">Options avancées</a>
    </div>

</div>


<div class="col-sm-12">
    <form method="post" action="recherche_avancee_covoiturage.php" id="optionAvanceeForm" style="display: none"><!-- A ne pas mettre dans la feuille de style sinon le JS ne fonctione pas -->
        <div class="col-sm-12">
            <div class="col-sm-6">
                <input id="ville_depart" name="ville_depart" placeholder="Ville de départ"/>
            </div>
            <div class="col-sm-6">
                <input id="ville_arrivee" name="ville_arrivee" placeholder="Ville d'arrivée"/>
            </div>
        </div>
        <div class="col-sm-12">
            <div class="col-sm-3">
                <label for="date_depart">Date de départ</label>
            </div>
            <div class="input-group date">
                <input type="date" id="date_depart" name="date_depart" class="form-control">
            </div>

            <div class="col-sm-3">
                <label for="date_arrivee">Date d'arrivée</label>
            </div>
            <div class="input-group date">
                <input type="date" id="date_arrivee" name="date_arrivee" class="form-control">
            </div>

        </div>
        <div class="col-sm-12">
            <div class="col-sm-6">
                <label for="nombre_voyageur">Nombre de voyageur(s)</label>
                <input id="nombre_voyageur" type="number" name="nombre_voyageur"/>
            </div>
            <div class="col-sm-6">
                        <span class="input-symbol-euro">
                        <input type="number" name="prix" min="0" step="1" class="form-control"  />
                    </span>
            </div>
        </div>

        <div class="col-sm-12">
            <div class="radio">
                <label><input type="radio" class="optpeageradio" name="optpeageradio" value="avecpeage">Avec péage</label>
            </div>
            <div class="radio">
                <label><input type="radio" class="optpeageradio" name="optpeageradio" value="sanspeage">Sans péage</label>
            </div>
            <div class="radio">
                <label><input type="radio" class="optpeageradio" name="optpeageradio" value="pasimportantpeage" checked>Pas important</label>
            </div>
        </div>
        <input id="validateForm" type="button" value="Rechercher" />

    </form>
</div>

<div class="col-sm-12" id="resultForm">

</div>


    <div class="modal fade" id="myModal" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Pas d'événement correspondant</h4>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>

        </div>
    </div>

</div>

<?php include 'footer.include.php'; ?>
</body>
</html>
<script>
    $(document).ready(function () {
        $("#validateForm").click(function () {
            var nom_event = $("#nom_event").val();
            var data_get = $("#optionAvanceeForm").serialize();
            if(nom_event != '')
            {
                data_get+="&nom_event=" + nom_event;
            }
            alert(data_get);
            $.ajax({
                type:"GET",
                data: data_get,//$("#optionAvanceeForm").serialize() + "&nom_event=" +$("#nom_event").value,
                contentType:"application/json",
                dataType:"json",
                url:"recherche_avancee_covoiturage.php",
                success:function (data) {
                    document.getElementById("resultForm").innerHTML = '';
                    for($i=0; $i<data.length; $i++)
                    {
                        var id_div_trajet ="trajet" + $i;
                        document.getElementById("resultForm").innerHTML += '<div class="col-sm-8 col-sm-offset-2 trajetEvenement" id="' + id_div_trajet + '" style="margin-top: 50px">' +
                            '<div class="col-sm-6">' +
                            '<h3 class="nomChauffeurTrajetEvenement">' +
                            data[$i][0] + ' ' + data[$i][1] + '</h3>' +
                            '<p>Depart : ' + data[$i][3] + ' à ' + data[$i][4] + '</p>' +
                            '<p>Arrivé : ' + data[$i][5] + ' à ' + data[$i][6] + '</p>' +
                            '<p>Prix : ' + data[$i][8] + '€</p>' +
                            '<p id="note' + $i + '">Note du chauffeur : </p></div>';


                        for($j=0;$j<10;$j++)
                        {
                            if($j<data[$i][2])
                            {
                                $("#note"+$i).append('★');
                            }
                            else
                            {
                                $("#note"+$i).append('☆');
                            }
                        }
                        if(data[$i][7] == 1)
                        {
                            $("#"+id_div_trajet).append('<div class="col-sm-2 col-sm-offset-1">' +
                                '<img class="logoAutoroute" src="../img/autoroute.png" alt="autouroute : oui" />' +
                                '</div>');
                        }
                        $("#"+id_div_trajet).append('<div class="col-sm-2">' +
                            '<a href="./trajet.php?id_trajet=' + data[$i][9] + '"><button>Voir détails</button></a>' +
                            '</div> </div>');
                    }
                },
                error:function (data) {
                    alert(data);
                }
            });
            return false;
        })
    });
</script>
<script>
    function activerOptionAvancee() {
        if(document.getElementById("optionAvanceeForm").style.display == "none")
        {
            document.getElementById("optionAvanceeForm").style.display = 'block';
        }
        else
        {
            document.getElementById("optionAvanceeForm").style.display = 'none';
        }

    }
</script>
<script>
    $(document).ready(function(e) {
        //e.preventDefault();
        $("#recherche_evenement").click(function () {
            $.get("rechercheEvenement.php","eventName="+$("#nom_event").val(),function(id){
                if(id != '')
                {
                    var currentLocation =  document.location.href;
                    currentLocation = currentLocation.substring( 0 ,currentLocation.lastIndexOf( "src" ) );
                    currentLocation += 'src/php/evenement.php?id_events=' + id;
                    window.location.href = currentLocation ;
                }
                else
                {
                    $("#myModal").modal('show');
                }
            });
            return false; // permet de ne pas recharger la page
        });
    });
</script>