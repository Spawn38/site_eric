<?php
function popup($pageElements){
?>
<div id="messagepopup" class="footer-copyright z-depth-1 popupIndex" onClick="onHidePopup()">
    <table class="popup">
      <tr>
        <td>
          <?php
            echo "<img id=\"logo-min\" src=\"".html_entity_decode($pageElements['logo']['value'])."\"/>";
          ?>
        </td>
        <td >
          <span>
          <?php
            echo html_entity_decode($pageElements['popup']['value']);
          ?>
          </span>
        </td>
      </tr>
    </table>
</div>
<?php
}
?>
