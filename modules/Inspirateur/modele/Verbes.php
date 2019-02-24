<?php
//header('Content-type: text/html; charset=UTF-8');
include '../config/idBdd.php';
$verbe = $_REQUEST['term'] .'%';
$mySql  =  new mysqli($host_name_gram, $user_name_gram, $password_gram, $database_gram);
if (mysqli_connect_errno()) {
    die('<p>La connexion au serveur MySQL a échoué: '.mysqli_connect_error().'</p>');
}

$requete = mysqli_prepare($mySql, 'SELECT distinct a.id, a.texte as verbe FROM `mots` a inner join `formes` b on a.id = b.mot where a.texte like ? and b.categorie=1 and b.temps=10');
mysqli_stmt_bind_param($requete, "s", $verbe);
mysqli_stmt_execute($requete);
mysqli_stmt_bind_result($requete, $donnees['id'], $donnees['verbe']);

$retrievedVerb = array(); // on créé le tableau
while (mysqli_stmt_fetch($requete)) {
    array_push($retrievedVerb, array(id => $donnees['id'], value=>  $donnees['verbe'])) ;
}
echo utf8_encode(json_encode($retrievedVerb));
mysqli_stmt_close($requete);
