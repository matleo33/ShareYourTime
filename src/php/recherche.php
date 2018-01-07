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
    <script src="../js/connexion.js"></script>

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
        <button id="recherche_evenement">Rechercher l'événement</button>
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
        <input id="validateForm" type="button" value="Rechercher des trajets" onclick="lancer_recherche()" />

    </form>

</div>

    <div class="col-sm-12" id="select_order" style="visibility: hidden">
        <select id="mode_order" onchange="lancer_recherche()">
            <option value="date_dep_ASC" selected>Date de départ croissant</option>
            <option value="date_dep_DESC">Date de départ décroissant</option>
            <option value="date_arr_DESC">Date d'arrivée décroissant</option>
            <option value="date_arr_ASC">Date d'arrivée croissant</option>
            <option value="prix_DESC">Prix décroissant</option>
            <option value="prix_ASC">Prix croissant</option>
            <option value="note_DESC">Note chauffeur décroissant</option>
            <option value="note_ASC">Note chauffeur croissant</option>
        </select>
    </div>

<div class="col-sm-12" id="resultForm">

</div>


    <div class="modal fade" id="myModal" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-body">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Pas d'événenement correspondant</h4>
                </div>
            </div>

        </div>
    </div>

    <div class="modal fade" id="modal_trajet_empty" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-body">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Pas de trajet correspondant</h4>
                </div>
            </div>

        </div>
    </div>

</div>

<?php include 'footer.include.php'; ?>
</body>
</html>
<script>
    function lancer_recherche(innerhtml) {
        var nom_event = $("#nom_event").val();
        var data_get = $("#optionAvanceeForm").serialize();
        if(nom_event != '')
        {
            data_get+="&nom_event=" + nom_event;
        }
        var select = document.getElementById("mode_order");
        var value = select.options[select.selectedIndex].value;
        data_get+="&mode_order=" + value;

        if(innerhtml != null)
        {
            data_get+="&page="+innerhtml;
        }
        $.ajax({
            type:"GET",
            data: data_get,//$("#optionAvanceeForm").serialize() + "&nom_event=" +$("#nom_event").value,
            contentType:"application/json",
            dataType:"json",
            url:"recherche_avancee_covoiturage.php",
            success:function (data) {
                $("#select_order").css("visibility", "visible");
                document.getElementById("resultForm").innerHTML = '';
                if(data.length == 0)
                {
                    $("#modal_trajet_empty").modal('show');
                }
                for($i=0; $i<data.length-1; $i++)
                {
                    if(data[$i][10] != null)
                    {
                        document.getElementById("resultForm").innerHTML += '<div class="col-xs-12 col-sm-12 col-lg-2">'+
                            '<img class="photoProfilTrajet" src="../../images/'+data[$i][10]+'" alt="photoProfil" /></div>';
                    }
                    else
                    {
                        document.getElementById("resultForm").innerHTML += '<div class="col-xs-12 col-sm-12 col-lg-2">'+
                            '<img class="photoProfilTrajet" src="../img/imageProfil2.PNG" alt="photoProfil" /></div>';
                    }
                    var id_div_trajet ="trajet" + $i;
                    document.getElementById("resultForm").innerHTML += '<div class="col-lg-8 col-lg-offset-1 col-sm-12 col-xs-12 trajetEvenement" id="' + id_div_trajet + '" style="margin-top: 50px">' +
                        '<div class="col-sm-6">' +
                        '<span class="nomChauffeurTrajetEvenement">' +
                        data[$i][0] + ' ' + data[$i][1] + '</span>' +
                        '<p>Depart : ' + data[$i][3] + ' à ' + data[$i][4] + '</p>' +
                        '<p>Arrivé : ' + data[$i][5] + ' à ' + data[$i][6] + '</p>' +
                        '<p>Prix : ' + data[$i][8] + '€</p>' +
                        '<p>Note du chauffeur : <span id="note' + $i + '" style="font-size:150%;"></span></p></div>';

                    //Si la note du chauffeur est connue
                    if(data[$i][2] != "inconnue")
                    {
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
                        //On set la couleur des étoiles en fonction de la note
                        if(data[$i][2]>=9)
                        {
                            $("#note"+$i).css('color', 'gold');

                        }
                        else if(data[$i][2]>=7)
                        {
                            $("#note"+$i).css('color', 'silver');
                        }
                        else if(data[$i][2]>=5)
                        {
                            $("#note"+$i).css('color', '614E1A');
                        }
                        else
                        {
                            $("#note"+$i).css('color', 'red');
                        }
                    }
                    else
                    {
                        $("#note"+$i).append('Inconnue');
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
                document.getElementById("resultForm").innerHTML += '<ul class="pagination" id="pages"></ul>';
                for($k=1; $k<data[data.length-1]+1; $k++)
                {
                    $('#pages').append('<li><a onclick="lancer_recherche(this.innerHTML)" style="cursor: pointer">'+$k+'</a></li>')
                }
            },
            error:function (data) {
                alert(data);
            }
        });
        return false;
    }

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