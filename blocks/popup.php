<?php
function popup($pageElements){
?>
<div id="messagepopup" class="footer-copyright z-depth-1 popupIndex" onClick="onHidePopup()">
    <table class="popup">
      <tr>
        <td>
          <?php
            echo "<img id=\"logo-min\" src=\"".htmlspecialchars_decode($pageElements['logo']['value'], ENT_QUOTES)."\"/>";
          ?>
        </td>
        <td >
          <span>
          <?php
            echo htmlspecialchars_decode($pageElements['popup']['value'], ENT_QUOTES);
          ?>
          </span>
        </td>
      </tr>
    </table>
</div>
<?php
}
?>
