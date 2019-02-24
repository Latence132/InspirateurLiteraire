// A $( document ).ready() block.
$(document).ready(function() {
  console.log("ready 2 !!");
  var sujet = "peuImporte";
  var objet = "peuImporte";
  $("#spinner").addClass("invisible");
  //init no subjectpeuImporte
  $("#sujetAjax").val(2);
  //choose subject autocomplete en fonction de l'auteur
  $("#chooseSubject").click(function(e) {
    if ($("input[name=sujetRadio]:checked").val() === "nomCommun") {
      //console.log("idNomCommunSujet! : " + $("input[name=sujetRadio]:checked").val());
      $("#sujet").val("nom commun");
      $("#sujetAjax").val(1); // 0 chien, chat, hommes,
    } else if ($("input[name=sujetRadio]:checked").val() === "nomPronom") {
      //deactivate input pronom
      //console.log("Pronom subject selected!");
      $("#sujet").val("pronom");
      $("#sujetAjax").val(0); // 0 je, tu, il, nous, vous, ils
    } else {
      //no strain on the subject
      console.log("No subject selected!");
      //$("input[name=sujet]").prop('disabled', true);
      $("#sujet").val("peu importe");
      $("#sujetAjax").val(2); // no subject in the request
    }
  });
  //choose object
  $("#chooseObject").click(function(e) {
    console.log("choose objet");
    if ($("input[name=objetRadio]:checked").val() === "NoObject") {
      //console.log("idNomCommunSujet! : " + $("input[name=sujetRadio]:checked").val());
      $("#objet").val("nom commun");
      $("#objetAjax").val(0); // 0 pas d'objet,
    } else if ($("input[name=objetRadio]:checked").val() === "nomCommun") {
      //deactivate input pronom
      //console.log("Pronom subject selected!");
      $("#objet").val("pas d'objet");
      $("#objetAjax").val(1); // 0 je, tu, il, nous, vous, ils ou rien
    } else {
      //no strain on the subjectobject
      console.log("No objet selected!");
      //$("input[name=sujet]").prop('disabled', true);
      $("#objet").val("peu importe");
      $("#objetAjax").val(2); // no subject in the request
    }
  });
  //find sentences
  $("#idBtnRecherche").click(function(e) {
    e.preventDefault();
    $("#spinner").removeClass("invisible");
    // $("#spinner").addClass('visible')
    var auteur = $("#idAuteur").val();
    var verbe = $("#idVerbeAjax").val();
    sujet = $("#sujetAjax").val();
    objet = $("#objetAjax").val();
    var request = sujet.toString() + objet.toString();
    console.log("idAuteur : ", auteur,"idVerbe : ", verbe,"id sujet :" + $("#sujetAjax").val(),"request : ",request);
    //Author

    //auteur == 999 => all authors
    //auteur == ? => one author

    //verbe == ? => one verbe

    //subject == O => pronom, subject == O
    //subject == 1 => common name, subject <> O
    //subject == 2 =>Peu importe, no request on object

    //object == O => pronom, pas d'objet, object == O
    //object == 1 => common name, Object nom commun, object <> 0
    //object == 2 => peu importe,  no request on object

  

    $.ajax({
      type: "POST",
      url: "modules/Inspirateur/index.php",
      // Passage des données au fichier PHP
      data: {
        auteur: auteur,
        verbe: verbe,
        request: request
      },
      // Type de données reçue par jQuery
      //dataType: "json",

      // La trasaction s'est bien terminée
      success: function(result) {
        $("#spinner").addClass("invisible");
        console.log("debut success ", result);
       $('<ul class="list-group "><li class="list-group-item" style="background-color: rgb(231,231,231);"><div class="row"><div class="col-xs-8 col-md-8">Texte</div><div class="col-xs-2 col-md-2">Ouvrage</div><div class="col-xs-2 col-md-2">Auteur</div></div></li>' + result + "</ul>" ).appendTo("#idResultat");
      },
      

      error: function(jqxhr, typeErreur, objJSONErreur) {
        alert("Type erreur : " + typeErreur + " => " + objJSONErreur);
      }
    });
  });
  //Réinitialiser
  $("#BtnReiniti").click(function(e) {
    $(".list-group-item").empty();
    console.log("réinitialiser");
  });
});
