<?php
try {
    $bdd = new PDO('mysql:host=localhost;dbname=shareyourtime;charset=utf8', 'root', 'D0nald&Ch@uve');
} catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
}
$array = array();
$reponse = $bdd->query('SELECT nom '
    . 'FROM events ');
while ($data = $reponse->fetch()) {
    array_push($array, $data[0].=",");
}
$tab_size = sizeof($array);
for ($i = 0; $i < $tab_size; $i++) {
    echo $array[$i];
}

?>