<?php
function blocks($blocks) {
  foreach ($blocks as $key => $block) {
    if($block['type']==1) {
      echo '<div class="parallax-container valign-wrapper">';
        echo '<div class="section no-pad-bot">';
          echo '<div class="container">';
            echo '<div class="row center">';
              echo '<h4 class="header col s12 textImage">';
                echo html_entity_decode($block['texte']);
              echo '</h4>';
            echo '</div>';
          echo '</div>';
        echo '</div>';
        echo '<div class="parallax">';
          echo '<img style="opacity: 0.8;filter: alpha(opacity=80);" ';
          echo 'src="'.$block['image'].'" ';
          echo 'alt="Unsplashed background img">';
        echo '</div>';
      echo '</div>';
    } else {
      echo '<div class="container">';
        echo '<div class="section">';
          echo '<div class="row">';
            echo '<div class="col s12 center">';
              echo '<h3><i class="mdi-content-send brown-text"></i></h3>';
              echo '<h5>';
                  echo html_entity_decode($block['titre']);
              echo '</h5>';
              echo html_entity_decode($block['texte']);
            echo '</div>';
          echo '</div>';
        echo '</div>';
      echo '</div>';
    }
  }
}
?>
