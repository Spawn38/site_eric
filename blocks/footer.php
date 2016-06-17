<?php
function footer($pageElements, $contactsArray) {
?>
  <footer class="page-footer teal">
    <div class="container">
      <div class="row">
        <div class="col l6 s12">
          <h5 class="white-text">
            <?php
              echo htmlspecialchars_decode($pageElements['pied_titre']['value'], ENT_QUOTES);
            ?>
          </h5>
          <p class="grey-text text-lighten-4" style="line-height: 1.5">
            <?php
              echo htmlspecialchars_decode($pageElements['pied_texte']['value'], ENT_QUOTES);
            ?>
          </p>
        </div>
        <div class="col l6 s12">
          <h5 class="white-text">
           <?php
              echo htmlspecialchars_decode($pageElements['contact_titre']['value'], ENT_QUOTES);
            ?>

          </h5>
          <table style="line-height: 0; white-space: nowrap;">
            <?php
              foreach ($contactsArray as $contact) {
                echo "<tr>";
                  echo "<td>";
                    echo "".htmlspecialchars_decode($contact['label'], ENT_QUOTES);
                  echo "</td>";
                  echo "<td>";
                    echo "".htmlspecialchars_decode($contact['value'], ENT_QUOTES);
                  echo "</td>";
                echo "</tr>";
              }
            ?>
          </table>
        </div>
      </div>
    </div>
    <div class="footer-copyright center-align" style="height:auto">
      <div class="container">
        <p>
        <?php
          echo htmlspecialchars_decode($pageElements['popup']['value'], ENT_QUOTES);
        ?>
        </p>
      </div>
    </div>
  </footer>
<?php
}
?>
