<?php
function navigation($pageElements,$active ="") {
  $menu = array(
      'engagements' => htmlspecialchars_decode($pageElements['menu0']['value'], ENT_QUOTES),
      'menu1' => htmlspecialchars_decode($pageElements['menu1']['value'], ENT_QUOTES),
      'menu2' => htmlspecialchars_decode($pageElements['menu2']['value'], ENT_QUOTES),
      'menu3' => htmlspecialchars_decode($pageElements['menu3']['value'], ENT_QUOTES)
    );
  echo '<nav class="white" role="navigation">';
    echo '<div class="nav-wrapper container">';
        echo '<a id="logo-container" href="/" class="brand-logo">';
          echo '<img id="logo" src="'.htmlspecialchars_decode($pageElements['logo']['value'], ENT_QUOTES).'"/>';
        echo '</a>';
      echo '<ul class="right hide-on-med-and-down">';
        foreach($menu as $key => $element) {
          if(strcmp($key,$active)==0) {
            echo '<li class="active">';
          } else {
            echo '<li>';
          }
          echo '<a href="'.$key.'.php">'.$element.'</a></li>';
        }
      echo '</ul>';
      echo '<ul id="nav-mobile" class="side-nav">';
        foreach($menu as $key => $element) {
          if(strcmp($key,$active)==0) {
            echo '<li class="active">';
          } else {
            echo '<li>';
          }
          echo '<a href="'.$key.'.php">'.$element.'</a></li>';
        }
      echo '</ul>';
      echo '<a href="#" data-activates="nav-mobile" class="button-collapse"><i class="material-icons">menu</i></a>';
    echo '</div>';
  echo '</nav>';
}
?>
