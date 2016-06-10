<?php
function engagements($pageElements, $engagements, $engagementsColNumber)
{

  $nbColumn = 2;
  if($engagementsColNumber) {
    $nbColumn = 12 / $engagementsColNumber;
  }

  $nbEnagements = count($engagements);

  echo '<div class="container">';
    echo '<div class="section">';
    if($nbEnagements) {
      echo '<div class="row">';
          echo '<div class="col s12">';
            echo '<h4 class="header center">';
              echo html_entity_decode($pageElements['engagement_titre']['value']);
            echo '</h4>';
          echo '</div>';
      echo '</div>';

      echo "<style>";
      foreach ($engagements as $key => $engagement) {
        if($engagement['image']!="") {
          $idEng = "engagement".$engagement['idengagement'];
          echo "#".$idEng." {\n";
          echo "background-image: url('".html_entity_decode($engagement['image'])."') }\n";
        }
      }
      echo "</style>";

      echo '<div class="row">';

      foreach ($engagements as $key => $engagement) {
        $fondClass ="";
        $idEng = "engagement".$engagement['idengagement'];
        if($engagement['image']!="") {
          $fondClass =" fondMain";
        }

        echo '<div class="col s12 '.'m'.$nbColumn.$fondClass.'">';
          echo '<div class="icon-block">';
            echo '<h2 class="center brown-text">';
              echo '<i class="material-icons">';
                echo html_entity_decode($engagement['icone']);
              echo '</i>';
            echo '</h2>';
            echo '<h5 class="center">';
              echo html_entity_decode($engagement['titre']);
            echo '</h5>';
            echo '<div class="'.$fondClass.'" id="'.$idEng.'">';
              echo html_entity_decode($engagement['block']);
            echo '</div>';
          echo '</div>';
        echo '</div>';
      }
      echo '</div>';
    }
    echo '</div>';
  echo '</div>';
}
?>
