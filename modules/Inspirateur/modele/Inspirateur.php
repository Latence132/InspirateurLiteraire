<?php

function toutLesAuteurs($bddTextes) {
    //mysqli_set_charset($bddTextes, 'utf8');
    $requete = mysqli_query($bddTextes, 'SELECT * FROM auteurs');
    while ($donnees =  mysqli_fetch_assoc($requete)) {
        echo  utf8_encode("<option value=". $donnees['id'] .">". $donnees['nom'] . "</option>");
    }
    mysqli_free_result($requete);
}

function phraseBindVerbe($sql,$bddTextes,$verbeTemp){
    $requete = mysqli_prepare( 
        $bddTextes,
        $sql
    );
    mysqli_stmt_bind_param($requete, "i", $verbeTemp);
    mysqli_stmt_bind_result($requete, $donnees['texte'], $donnees['titre'], $donnees['nom']);
    $requete->store_result();//Transfers a result set from a prepared statement
    $count=$requete->num_rows;
    if ($count >= 1) {
        while (mysqli_stmt_fetch($requete)) {
            echo utf8_encode('<li class="list-group-item row"><div class="row"><div class="col-xs-8 col-md-8">' . $donnees['texte']. '</div><div class="col-xs-2 col-md-2">' . $donnees['titre'] . '</div><div class="col-xs-2 col-md-2"><div class="col-xs-2 col-md-2">' . $donnees['nom'] .'</div></div></li>') ;
        }
    } else {
        echo utf8_encode('<li class="list-group-item">Pas de resultats</li>') ;
    }
    mysqli_stmt_close($requete);
}

function phraseBindAuthorVerbe($sql,$bddTextes,$auteurTemp,$verbeTemp){
    $requete = mysqli_prepare( 
        $bddTextes,
        $sql
    );
    mysqli_stmt_bind_param($requete, "ii", $auteurTemp, $verbeTemp);
    mysqli_stmt_execute($requete);
    mysqli_stmt_bind_result($requete, $donnees['texte'], $donnees['titre'], $donnees['nom']);
    $requete->store_result();//Transfers a result set from a prepared statement
    $count=$requete->num_rows;
    if ($count >= 1) {
        while (mysqli_stmt_fetch($requete)) {
            echo utf8_encode('<li class="list-group-item"><div class="row"><div class="col-xs-8 col-md-8">' . $donnees['texte']. '</div><div class="col-xs-2 col-md-2">' . $donnees['titre'] . '</div><div class="col-xs-2 col-md-2"><div class="col-xs-2 col-md-2">' . $donnees['nom'] .'</div></div></li>') ;
        }
    } else {
        echo utf8_encode('<li class="list-group-item">Pas de resultats</li>') ;
    }
    mysqli_stmt_close($requete);
}

function phrasesAVSO($bddTextes,$auteurTemp, $verbeTemp,$requestTemp)
{       switch ($requestTemp) {
    case "00":
      // request on verbe and author
      //subject == O => pronom, subject == O
      //object == O => pronom, pas d'objet, object == O
      //auteur == 999 => all authors
      if($auteurTemp == 999){
        $sql = 'SELECT DISTINCT a.texte, c.titre, d.nom FROM phrases a inner join indexsvo b on a.id = b.phrase inner join ouvrages c on a.ouvrage = c.id inner join auteurs d on d.id = b.auteur WHERE b.verbe = ?  and b.sujet = 0 and b.objet = 0';
        phraseBindVerbe($sql,$bddTextes ,$verbeTemp);
    } else {
      //auteur == ? => one author
      $sql = 'SELECT DISTINCT a.texte, c.titre, d.nom FROM phrases a inner join indexsvo b on a.id = b.phrase inner join ouvrages c on a.ouvrage = c.id inner join auteurs d on d.id = b.auteur WHERE b.auteur = ? and b.verbe = ? and b.sujet = 0 and b.objet = 0';
      phraseBindAuthorVerbe($sql,$bddTextes,$auteurTemp,$verbeTemp);
    }
      break;
    case "01":
      // request on verbe and author,
      //subject == O => pronom, subject == O
      //object == 1 => common name, Object nom commun, object <> 0
      //auteur == 999 => all authors
        if($auteurTemp == 999){
            $sql ='SELECT DISTINCT a.texte, c.titre, d.nom FROM phrases a inner join indexsvo b on a.id = b.phrase inner join ouvrages c on a.ouvrage = c.id inner join auteurs d on d.id = b.auteur WHERE b.verbe = ?  and b.sujet = 0 and b.objet <> 0';
            phraseBindVerbe($sql,$bddTextes ,$verbeTemp);
        } else {
            $sql ='SELECT DISTINCT a.texte, c.titre, d.nom FROM phrases a inner join indexsvo b on a.id = b.phrase inner join ouvrages c on a.ouvrage = c.id inner join auteurs d on d.id = b.auteur WHERE b.auteur = ? and b.verbe = ? and b.sujet = 0 and b.objet <> 0';
            phraseBindAuthorVerbe($sql,$bddTextes,$auteurTemp,$verbeTemp);
        }
      break;
    case "02":
      // request on verbe and author,
      //subject == O => pronom, subject == O
      //object == 2 => peu importe,  no request on object
      //auteur == 999 => all authors
        if($auteurTemp == 999){
            $sql ='SELECT DISTINCT a.texte, c.titre, d.nom FROM phrases a inner join indexsvo b on a.id = b.phrase inner join ouvrages c on a.ouvrage = c.id inner join auteurs d on d.id = b.auteur WHERE b.verbe = ?  and b.sujet = 0';
            phraseBindVerbe($sql,$bddTextes ,$verbeTemp);
        } else {
            $sql ='SELECT DISTINCT a.texte, c.titre, d.nom FROM phrases a inner join indexsvo b on a.id = b.phrase inner join ouvrages c on a.ouvrage = c.id inner join auteurs d on d.id = b.auteur WHERE b.auteur = ? and b.verbe = ? and b.sujet = 0';
            phraseBindAuthorVerbe($sql,$bddTextes,$auteurTemp,$verbeTemp);
        }
      break;
    case "10":
      // request on verbe and author
      //subject == 1 => common name, subject <> O
      //object == O => pronom, pas d'objet, object == O
      //auteur == 999 => all authors
        if($auteurTemp == 999){
            $sql ='SELECT DISTINCT a.texte, c.titre, d.nom FROM phrases a inner join indexsvo b on a.id = b.phrase inner join ouvrages c on a.ouvrage = c.id inner join auteurs d on d.id = b.auteur WHERE b.verbe = ?  and b.sujet <> 0 and b.objet = 0';
            phraseBindVerbe($sql,$bddTextes ,$verbeTemp);
        } else {
            $sql ='SELECT DISTINCT a.texte, c.titre, d.nom FROM phrases a inner join indexsvo b on a.id = b.phrase inner join ouvrages c on a.ouvrage = c.id inner join auteurs d on d.id = b.auteur WHERE b.auteur = ? and b.verbe = ? and b.sujet <> 0 and b.objet = 0';
            phraseBindAuthorVerbe($sql,$bddTextes,$auteurTemp,$verbeTemp);
        }
        break;
    case "11":
      // request on verbe and author
      //subject == 1 => common name, subject <> O
      //object == 1 => common name, Object nom commun, object <> 0
      //auteur == 999 => all authors
      if($auteurTemp == 999){
            $sql ='SELECT DISTINCT a.texte, c.titre, d.nom FROM phrases a inner join indexsvo b on a.id = b.phrase inner join ouvrages c on a.ouvrage = c.id inner join auteurs d on d.id = b.auteur WHERE b.verbe = ?  and b.sujet <> 0 and b.objet <> 0';
            phraseBindVerbe($sql,$bddTextes ,$verbeTemp);
        } else {
            $sql ='SELECT DISTINCT a.texte, c.titre, d.nom FROM phrases a inner join indexsvo b on a.id = b.phrase inner join ouvrages c on a.ouvrage = c.id inner join auteurs d on d.id = b.auteur WHERE b.auteur = ? and b.verbe = ? and b.sujet <> 0 and b.objet <> 0';
            phraseBindAuthorVerbe($sql,$bddTextes,$auteurTemp,$verbeTemp);
        }
      break;
    case "12":
      // request on verbe and author
      //subject == 1 =>Peu importe, no request on object
      //object == 2 => peu importe,  no request on object
      //auteur == 999 => all authors
        if($auteurTemp == 999){
            $sql ='SELECT DISTINCT a.texte, c.titre, d.nom FROM phrases a inner join indexsvo b on a.id = b.phrase inner join ouvrages c on a.ouvrage = c.id inner join auteurs d on d.id = b.auteur WHERE b.verbe = ?  and b.sujet <> 0';
            phraseBindVerbe($sql,$bddTextes ,$verbeTemp);
        } else {
            $sql ='SELECT DISTINCT a.texte, c.titre, d.nom FROM phrases a inner join indexsvo b on a.id = b.phrase inner join ouvrages c on a.ouvrage = c.id inner join auteurs d on d.id = b.auteur WHERE b.auteur = ? and b.verbe = ? and b.sujet <> 0';
            phraseBindAuthorVerbe($sql,$bddTextes,$auteurTemp,$verbeTemp);
        }

      break;
    case "20":
      // request on verbe and author
      //subject == 2 =>Peu importe, no request on object
      //object == O => pronom, pas d'objet, object == O
      //auteur == 999 => all authors

        if($auteurTemp == 999){
            $sql ='SELECT DISTINCT a.texte, c.titre, d.nom FROM phrases a inner join indexsvo b on a.id = b.phrase inner join ouvrages c on a.ouvrage = c.id inner join auteurs d on d.id = b.auteur WHERE b.verbe = ?  and b.objet = 0';
            phraseBindVerbe($sql,$bddTextes ,$verbeTemp);
        } else {
            $sql ='SELECT DISTINCT a.texte, c.titre, d.nom FROM phrases a inner join indexsvo b on a.id = b.phrase inner join ouvrages c on a.ouvrage = c.id inner join auteurs d on d.id = b.auteur WHERE b.auteur = ? and b.verbe = ?  and b.objet = 0';
            phraseBindAuthorVerbe($sql,$bddTextes,$auteurTemp,$verbeTemp);
        }

      break;
    case "21":
      // request on verbe and author
      //subject == 2 =>Peu importe, no request on object
      //object == 1 => common name, Object nom commun, object <> 0
      //auteur == 999 => all authors
        if($auteurTemp == 999){
            $sql ='SELECT DISTINCT a.texte, c.titre, d.nom FROM phrases a inner join indexsvo b on a.id = b.phrase inner join ouvrages c on a.ouvrage = c.id inner join auteurs d on d.id = b.auteur WHERE b.verbe = ?  and b.objet <> 0';
            phraseBindVerbe($sql,$bddTextes ,$verbeTemp);
        } else {
            $sql ='SELECT DISTINCT a.texte, c.titre, d.nom FROM phrases a inner join indexsvo b on a.id = b.phrase inner join ouvrages c on a.ouvrage = c.id inner join auteurs d on d.id = b.auteur WHERE b.auteur = ? and b.verbe = ?  and b.objet <> 0';
            phraseBindAuthorVerbe($sql,$bddTextes,$auteurTemp,$verbeTemp);
        }
      break;
    case "22":
      // request on verbe and author
      //subject == 2 =>Peu importe, no request on object
      //object == 2 => peu importe,  no request on object
      //auteur == 999 => all authors
      if($auteurTemp == 999){
        $sql ='SELECT DISTINCT a.texte, c.titre, d.nom FROM phrases a inner join indexsvo b on a.id = b.phrase inner join ouvrages c on a.ouvrage = c.id inner join auteurs d on d.id = b.auteur WHERE b.verbe = ? ';
        phraseBindVerbe($sql,$bddTextes ,$verbeTemp);
    } else {
        $sql ='SELECT DISTINCT a.texte, c.titre, d.nom FROM phrases a inner join indexsvo b on a.id = b.phrase inner join ouvrages c on a.ouvrage = c.id inner join auteurs d on d.id = b.auteur WHERE b.auteur = ? and b.verbe = ?';
        phraseBindAuthorVerbe($sql,$bddTextes,$auteurTemp,$verbeTemp);
    }
      break;
    default:
        break;
  }
}
