<?php
//header('Content-type: text/html; charset=UTF-8');
include '../config/idBdd.php';
$objet = $_REQUEST['term'] .'%';
$mySql  =  new mysqli($host_name_gram, $user_name_gram, $password_gram, $database_gram);
if (mysqli_connect_errno()) {
    die('<p>La connexion au serveur MySQL a échoué: '.mysqli_connect_error().'</p>');
}

$requete = mysqli_prepare($mySql, 'SELECT distinct a.id, a.texte as objet FROM `mots`a where a.texte like ? LIMIT 0, 20');
mysqli_stmt_bind_param($requete, "s", $objet);
mysqli_stmt_execute($requete);
mysqli_stmt_bind_result($requete, $donnees['id'], $donnees['objet']);

$retrievedObjet = array(); // on créé le tableau
while (mysqli_stmt_fetch($requete)) {
    array_push($retrievedObjet, array(id => $donnees['id'], value=> $donnees['objet'])) ;
}
echo utf8_encode(json_encode($retrievedObjet));
mysqli_stmt_close($requete);
