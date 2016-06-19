<?php
function banner($pageElements) {
?>
  <div id="index-banner" class="parallax-container">
    <div class="section no-pad-bot">
      <div class="container">
        <div class="row center">
          <h1 class="header center teal-text text-lighten-2">
          <?php
            echo htmlspecialchars_decode($pageElements['principal']['value']);
          ?>
          </h1>
        </div>
        <div class="row center">
          <a onClick="openContact()" class="btn-large waves-effect waves-light teal lighten-1">
          <?php
            echo htmlspecialchars_decode($pageElements['bouton_contact']['value'], ENT_QUOTES);
          ?>
          </a>
        </div>
      </div>
    </div>
    <div class="parallax">
    <?php
    echo '<img class="parallaxImg" src="';
    echo htmlspecialchars_decode($pageElements['img_banner']['value'], ENT_QUOTES);
    echo '" alt="Unsplashed background">'
    ?>
    </div>
  </div>
<?php
}
?>
