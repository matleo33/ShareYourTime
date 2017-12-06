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

<div class="col-sm-12">
    <h1 class="text-center">RECHERCHE</h1>
</div>
<div class="col-sm-12 text-center">
    <div class="col-sm-3 col-sm-offset-2">
        <input placeholder="Nom de l'événement"<?php
        if (isset($_GET['nomEvent'])) {
            echo "value=\"" . $_GET['nomEvent'] . "\"";
        }
        ?>
        /></div>
    <div class="col-sm-6">
        <button onclick="rechercheGlobale()">Rechercher</button>
    </div>
    <div class="col-sm-3 col-sm-offset-2">
        <a id="optionAvancee" href="#" onclick="activerOptionAvancee()">Options avancées</a>
    </div>

</div>


<div class="col-sm-12">
    <form method="post" id="optionAvanceeForm" style="display: none"><!-- A ne pas mettre dans la feuille de style sinon le JS ne fonctione pas -->
        <div class="col-sm-12">
            <div class="col-sm-6">
                <input placeholder="Ville de départ"/>
            </div>
            <div class="col-sm-6">
                <input placeholder="Ville d'arrivée"/>
            </div>
        </div>
        <div class="col-sm-12">
            <div class="col-sm-3">
                <label for="date_depart">Date de départ</label>
            </div>
            <div class='input-group date datetimepicker col-sm-3'>
                <input type='text' id="date_depart" name="date_depart" class="form-control" placeholder="Date de départ + heure"/>
                <span class="input-group-addon">
                    <span class="glyphicon glyphicon-calendar"></span>
                    </span>
            </div>

            <div class="col-sm-3">
                <label for="date_arrivee">Date d'arrivée</label>
            </div>
            <div class='input-group date datetimepicker col-sm-3'>
                <input type='text' id="date_arrivee" name="date_arrivee" class="form-control" placeholder="Date d'arrivée + heure"/>
                <span class="input-group-addon">
                    <span class="glyphicon glyphicon-calendar"></span>
                    </span>
            </div>
        </div>
        <div class="col-sm-12">
            <div class="col-sm-6">
                <label for="nombre_voyageur">Nombre de voyageur(s)</label>
                <input id="nombre_voyageur" type="number" name="nombre_voyageur"/>
            </div>
            <div class="col-sm-6">
                        <span class="input-symbol-euro">
                        <input type="number" value="0" min="0" step="1" class="form-control"  />
                    </span>
            </div>
        </div>

        <div class="col-sm-12">
            <div class="form-check">
                <label class="form-check-label">
                    <input class="form-check-input" type="radio" name="avec_peage_checkbox" id="avec_peage_checkbox" value="avec_peage" checked>
                    Avec péage
                </label>
            </div>
            <div class="form-check">
                <label class="form-check-label">
                    <input class="form-check-input" type="radio" name="sans_peage_checkbox" id="sans_peage_checkbox" value="sans_peage">
                    Sans péage
                </label>
            </div>
            <div class="form-check disabled">
                <label class="form-check-label">
                    <input class="form-check-input" type="radio" name="pas_important_peage_checkbox" id="pas_important_peage_checkbox" value="pas_important" disabled>
                    Pas d'importance
                </label>
            </div>
        </div>
        <input type="submit" value="Rechercher" />

    </form>
</div>



<?php include 'footer.include.php'; ?>
</body>
</html>
<script>
    $(document).ready(function () {
        $("#optionAvanceeForm").submit(function () {
            $.ajax({
                type:"POST",
                data: $(this).serialize(),
                contentType:"application/json",
                dataType:"json",
                url:"recherche_avancee_covoiturage.php",
                success:function (data) {
                    alert(data.length)
                    //alert(data[0][1]);
                },
                error:function () {

                }
            });
            return false;
        })
    });
    /*$.post("recherche_avancee_covoiturage.php", function(data){
    }, "json");*/
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
<script type="text/javascript">
    $(function () {
        $('.datetimepicker').datetimepicker({
            //language : 'fr' //TODO Insertion ne marche pas si la date est au format FR
        });
    });
</script>