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
          echo '<div class="col s12 center">';
              echo htmlspecialchars_decode($pageElements['engagement_titre']['value'], ENT_QUOTES);
          echo '</div>';
      echo '</div>';

      echo "<style>";
      foreach ($engagements as $key => $engagement) {
        if($engagement['image']!="") {
          $idEng = "engagement".$engagement['idengagement'];
          echo "#".$idEng." {\n";
          echo "background-image: url('".htmlspecialchars_decode($engagement['image'], ENT_QUOTES)."') }\n";
        }
      }
      echo "</style>";

      $i=0;
      foreach ($engagements as $key => $engagement) {
        $fondClass ="";
        $idEng = "engagement".$engagement['idengagement'];
        if($engagement['image']!="") {
          $fondClass =" fondMain";
        }

        if($i%$engagementsColNumber == 0) {
          echo '<div class="row">';
        }

        echo '<div class="col s12 '.'m'.$nbColumn.$fondClass.'">';
          echo '<div class="icon-block">';
            echo '<h2 class="center brown-text">';
              echo '<i class="material-icons">';
                echo htmlspecialchars_decode($engagement['icone'], ENT_QUOTES);
              echo '</i>';
            echo '</h2>';
            echo '<div>';
              echo htmlspecialchars_decode($engagement['titre'], ENT_QUOTES);
            echo '</div>';
            echo '<div class="'.$fondClass.'" id="'.$idEng.'">';
              echo htmlspecialchars_decode($engagement['block'], ENT_QUOTES);
            echo '</div>';
          echo '</div>';
        echo '</div>';

        if($i%$engagementsColNumber == ($engagementsColNumber-1)) {
          echo '</div>';
        }
        $i++;
      }
    }
    echo '</div>';
  echo '</div>';
}
?>
