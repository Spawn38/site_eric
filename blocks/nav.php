<?php
function navigation($pageElements,$active ="") {
  $menu = array(
      'menu1' => html_entity_decode($pageElements['menu1']['value']),
      'menu2' => html_entity_decode($pageElements['menu2']['value']),
      'menu3' => html_entity_decode($pageElements['menu3']['value'])
    );
  echo '<nav class="white" role="navigation">';
    echo '<div class="nav-wrapper container">';
        echo '<a id="logo-container" href="/" class="brand-logo">';
          echo '<img id="logo" src="'.html_entity_decode($pageElements['logo']['value']).'"/>';
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
        foreach($key as $element) {
          if(strcmp($menu,$active)==0) {
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
