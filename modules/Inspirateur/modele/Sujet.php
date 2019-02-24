<?php
//header('Content-type: text/html; charset=UTF-8');
include '../config/idBdd.php';
$sujet = $_REQUEST['term'] .'%';
$mySql  =  new mysqli($host_name_gram, $user_name_gram, $password_gram, $database_gram);
if (mysqli_connect_errno()) {
    die('<p>La connexion au serveur MySQL a échoué: '.mysqli_connect_error().'</p>');
}

$requete = mysqli_prepare($mySql, 'SELECT  distinct a.id, a.texte as sujet FROM `mots`a where a.texte like ? LIMIT 0, 20');
mysqli_stmt_bind_param($requete, "s", $sujet);
mysqli_stmt_execute($requete);
mysqli_stmt_bind_result($requete, $donnees['id'], $donnees['sujet']);

$retrievedSujet = array(); // on créé le tableau
while (mysqli_stmt_fetch($requete)) {
    array_push($retrievedSujet, array(id => $donnees['id'], value=> $donnees['sujet'])) ;
}
echo utf8_encode(json_encode($retrievedSujet));
mysqli_stmt_close($requete);
