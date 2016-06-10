<?php
function banner($pageElements) {
?>
  <div id="index-banner" class="parallax-container">
    <div class="section no-pad-bot">
      <div class="container">
        <div class="row center">
          <h1 class="header center teal-text text-lighten-2">
          <?php
            echo html_entity_decode($pageElements['principal']['value']);
          ?>
          </h1>
        </div>
        <div class="row center">
          <a onClick="openContact()" class="btn-large waves-effect waves-light teal lighten-1">
          <?php
            echo html_entity_decode($pageElements['bouton_contact']['value']);
          ?>
          </a>
        </div>
      </div>
    </div>
    <div class="parallax">
    <?php
    echo '<img style="opacity: 0.8;filter: alpha(opacity=80);" src="';
    echo html_entity_decode($pageElements['img_banner']['value']);
    echo '" alt="Unsplashed background">'
    ?>
    </div>
  </div>
<?php
}
?>
