<div class="container">
  <div class="row">
    <div class=" col-xs-9 col-md-9">
      <h1>Inspirateur littéraire</h1>
    </div>
  </div>

  <form id="idForm">
    <div class="row">
      <!-- auteur -->
      <div class="col-xs-12 col-md-6">
        <label for="auteur">Choisissez un Auteur</label>
        <select class="custom-select" id="idAuteur" name="auteur">
          <?php toutLesAuteurs($bddTextes); ?>
          <option value="999">Tous</option>
        </select>
      </div>

      <!-- verbe -->
      <div class="col-xs-12 col-md-6">
        <div class="ui-widget">
          <label for="idVerbe">Verbe</label>
          <input type="string" name="idVerbe" class="form-control" id="idVerbe" placeholder="Verbe">
          <input type="string" name="idVerbeAjax" class="form-control" id="idVerbeAjax" placeholder="Verbe">
          <!-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> -->
        </div>
      </div>
    </div>

    <!-- sujet -->
    <div class="row">
      <div class="col-xs-12 col-md-6">
        <!-- radio button for choosing what kind of subject -->
        <div id="chooseSubject" class="form-group" >
          <label class="form-check-label" for="sujetRadio">Sujet</label><br/>
          <div class="form-check d-inline-flex">
            <input class="form-check-input" type="radio" name="sujetRadio" id="idNomCommunSujet" value="nomCommun">
            <label class="form-check-label" for="idNomCommunSujet">Nom commun</label>
          </div>
          <div class="form-check d-inline-flex">
            <input class="form-check-input" type="radio" name="sujetRadio" id="idPronomSujet" value="nomPronom">
            <label class="form-check-label" for="idPronomSujet">Pronom</label>
          </div>
          <div class="form-check d-inline-flex">
            <input class="form-check-input" type="radio" name="sujetRadio" id="idPeuImporteSujet" value="peuImporte" checked>
            <label class="form-check-label" for="idPeuImporteSujet">Peu importe</label>
          </div>
        </div>
        <!-- if idNomCommunSujet or idPronomSujet choosen the user has to write the subject in the input  -->
        <input type="string" name="sujet" class="form-control" id="sujet" placeholder="Sujet" disabled>
        <input type="string" name="sujetAjax" class="form-control" id="sujetAjax" placeholder="Sujet" disabled>
      </div>

      <!-- Objet -->
      <div class="col-xs-12 col-md-6">
        <div id="chooseObject" class="form-group">
          <label class="form-check-label" for="objetRadio">Objet</label><br/>
          <div class="form-check d-inline-flex">
            <input class="form-check-input" type="radio" name="objetRadio" id="idNomCommunObjet" value="nomCommun">
            <label class="form-check-label" for="idNomCommunObjet">
              Nom commun
            </label>
          </div>
          <div class="form-check d-inline-flex">
            <input class="form-check-input" type="radio" name="objetRadio" id="idnoneObjet" value="NoObject">
            <label class="form-check-label" for="idnoneObjet">Aucun
            </label>
          </div>
          <div class="form-check d-inline-flex">
            <input class="form-check-input" type="radio" name="objetRadio" id="idPeuImporteObjet" value="peuImporte" checked>
            <label class="form-check-label" for="idPeuImporteObjet">Peu importe
            </label>
          </div>
        </div>
        <!-- if idNomCommunSujet or idPronomSujet choosen the user has to write the subject in the input  -->
        <input type="string" name="objet" class="form-control" id="objet" placeholder="Objet" disabled>
        <input type="string" name="objetAjax" class="form-control" id="objetAjax" placeholder="Objet" disabled>
      </div>
    </div>
    <button id="idBtnRecherche" class="btn btn-primary mt-1" name="recherche" value="true">Rechercher</button>
    <button id="BtnReiniti" class="btn btn-warning mt-1" name="reinit" value="true">Réinitialiser</button>
  </form>

</div>
