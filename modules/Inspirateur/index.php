<?php
 include 'config/idBdd.php';
 include 'modele/Inspirateur.php';

$bddTextes =  new mysqli($host_name_textes, $user_name_textes, $password_textes, $database_textes);
if (mysqli_connect_errno()) {
    die('<p>La connexion au serveur MySQL a échoué: '.mysqli_connect_error().'</p>');
}
$bddGram =  new mysqli($host_name_gram, $user_name_gram, $password_gram, $database_gram);
if (mysqli_connect_errno()) {
    die('<p>La connexion au serveur MySQL a échoué: '.mysqli_connect_error().'</p>');
}
if (isset($_POST['auteur'])) {
    $auteurTemp = htmlspecialchars($_POST['auteur']);
    $verbeTemp = htmlspecialchars($_POST['verbe']);
    $requestTemp = htmlspecialchars($_POST['request']);
    if(is_numeric($verbeTemp)) {
        $resultat = phrasesAVSO($bddTextes, $auteurTemp, $verbeTemp, $requestTemp);
    } else {
        $verbeTemp = convertVerbeToId($bddGram,$verbeTemp);
        $resultat = phrasesAVSO($bddTextes, $auteurTemp, $verbeTemp, $requestTemp);
    }
    
    echo $resultat ;
} else {
    //header('Content-type: text/html; charset=UTF-8');
    include 'vues/accueil.php';
}
