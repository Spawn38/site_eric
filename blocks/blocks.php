<?php
function blocks($blocks) {
  foreach ($blocks as $key => $block) {
    if($block['type']==1) {
      echo '<div class="parallax-container valign-wrapper">';
        echo '<div class="section no-pad-bot">';
          echo '<div class="container">';
            echo '<div class="row center">';
              echo '<h4 class="header col s12 textImage">';
                echo htmlspecialchars_decode($block['texte'], ENT_QUOTES);
              echo '</h4>';
            echo '</div>';
          echo '</div>';
        echo '</div>';
        echo '<div class="parallax">';
          echo '<img class="parallaxImg" ';
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
                  echo htmlspecialchars_decode($block['titre'], ENT_QUOTES);
              echo '</h5>';
              echo htmlspecialchars_decode($block['texte'], ENT_QUOTES);
            echo '</div>';
          echo '</div>';
        echo '</div>';
      echo '</div>';
    }
  }
}
?>
