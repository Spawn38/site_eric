<?php
function footer($pageElements, $contactsArray) {
?>
  <footer class="page-footer teal">
    <div class="container">
      <div class="row">
        <div class="col l6 s12">
          <h5 class="white-text">
            <?php
              echo html_entity_decode($pageElements['pied_titre']['value']);
            ?>
          </h5>
          <p class="grey-text text-lighten-4" style="line-height: 1.5">
            <?php
              echo html_entity_decode($pageElements['pied_texte']['value']);
            ?>
          </p>
        </div>
        <div class="col l6 s12">
          <h5 class="white-text">
           <?php
              echo html_entity_decode($pageElements['contact_titre']['value']);
            ?>

          </h5>
          <table style="line-height: 0; white-space: nowrap;">
            <?php
              foreach ($contactsArray as $contact) {
                echo "<tr>";
                  echo "<td>";
                    echo "".html_entity_decode($contact['label']);
                  echo "</td>";
                  echo "<td>";
                    echo "".html_entity_decode($contact['value']);
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
          echo html_entity_decode($pageElements['popup']['value']);
        ?>
        </p>
      </div>
    </div>
  </footer>
<?php
}
?>
