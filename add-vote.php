<?php
function p(...$var) {
    echo '<pre>';
    foreach($var as $v) {
        var_dump($v);
    }
    echo '</pre>';
}

if(
    !isset($_POST['id'])        &&
    !isset($_POST['nom'])       &&
    !isset($_POST['prenom'])    &&
    !isset($_POST['rgpd'])
) {
    die();
}

$propals  = json_decode(file_get_contents('proposition.json'));
$date     = date('d/m/Y H:i:s');
$nom_vote = '';

foreach( $propals as  &$propal) {
    if($_POST['id'] == $propal->ID) {
        $propal->vote++;
        $nom_vote = $propal->nom;
    }
}

$ligneCSV = $_POST['id'] .';'. $nom_vote .';'. $date .';'.  $_POST['nom'] .';'. $_POST['prenom'] .';'. $_POST['rgpd'] . '
';

file_put_contents('./vote.csv', $ligneCSV, FILE_APPEND);

$fp = fopen('proposition.json', 'w');
fwrite($fp, json_encode($propals));
fclose($fp);

header('Location: https://cafe-des-familles.asheart.fr/merci.html');
