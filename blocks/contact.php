<?php
function contact($pageElements) {
?>
<div id="modalContact" class="modal">
  <div class="modal-content">
    <h5 class="white-text center-align card-panel teal">
      <?php
        echo html_entity_decode($pageElements['formulaire_titre']['value']);
      ?>
    </h5>
    <form class="col s12" id="contactForm">
      <div class="row">
        <div class="input-field col s12">
          <input id="name" type="text" class="validate" required>
          <label id="name" for="name">
          <?php
            echo html_entity_decode($pageElements['nom']['value']);
          ?>
          </label>
        </div>
      </div>
      <div class="row">
        <div class="input-field col s12">
          <input id="email" type="email" class="validate" required>
          <label for="email">
          <?php
            echo html_entity_decode($pageElements['email']['value']);
          ?>
          </label>
        </div>
      </div>
      <div class="row">
        <div class="input-field col s12">
          <textarea id="message" class="materialize-textarea"></textarea>
          <label for="message">
          <?php
            echo html_entity_decode($pageElements['message']['value']);
          ?>
          </label>
        </div>
      </div>
      <div class="row right">
          <button class="btn waves-effect waves-light" type="submit" name="action">
          <?php
            echo html_entity_decode($pageElements['envoyer']['value']);
          ?>
            <i class="material-icons right">email</i>
          </button>
          <a onClick="resetForm()" class="waves-effect waves-green btn-flat">
          <?php
            echo html_entity_decode($pageElements['annuler']['value']);
          ?>
          </a>
      </div>
    </form>
  </div>
</div>
<?php
}
?>
