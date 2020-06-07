<!doctype html>
<html lang="fr">
  <head>
    <!-- Required meta tags -->
    <meta charset="UTF-8" http-equiv="Content-Type" content="text/html;">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <!-- <link rel="stylesheet" href="/resources/demos/style.css"> -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
    <style>
      #idVerbeAjax, #sujetAjax, #objetAjax, #sujet, #objet  {
        display: none;
      }
      html {
        font-size: 1rem;
      }
      h1, .h1 { font-size: 2rem; }

    @include media-breakpoint-up(sm) {
      html {
        font-size: 0.7rem;
      }
    }

    @include media-breakpoint-up(md) {
      html {
        font-size: 1rem;
      }
    }

    @include media-breakpoint-up(lg) {
      html {
        font-size: 1rem;
      }
    }
    </style>

    <script type="text/javascript">
    $(function () {
      //autocomplete retriving verbe
      $("#idVerbe").autocomplete({
        source: function (request, response) {
          $.ajax({
            url: "modules/Inspirateur/modele/Verbes.php",
            dataType: "json",
            data: {
              term: request.term.toLowerCase()
            },
            success: function (data) {
              response(data);
            }
          });
        },
        minLength: 2,
        select: function (event, ui) {
          $("#idVerbeAjax").val(ui.item.id);
        },
      });

    });
    </script>
    <title>Insipirateur litéraire</title>
  </head>
  <body id="mainWrapper">
    <?php
    include 'Composants/formulaire.php';
    include 'Composants/resultat.php';
    ?>

    <!-- Optional JavaScript -->


    <script src="modules/Inspirateur/JS/js4.js"></script>
  </body>
</html>
