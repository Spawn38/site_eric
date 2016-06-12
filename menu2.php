<?php
session_start();
$_SESSION['token'] = crypt("access",date("m.d.y"));
include(__DIR__.'/func/getContact.php');
$langue = isSet($_SESSION['lang'])?$_SESSION['lang']:"fr";

$contactsArray = getContact($langue);

include(__DIR__.'/func/default.php');
include(__DIR__.'/func/getPageElements.php');
$pageElements = getPageElements($langue, getDefaultValues());

include(__DIR__.'/func/getReferences.php');
$references = getReferences($langue);

include(__DIR__.'/blocks/nav.php');
include(__DIR__.'/blocks/footer.php');
?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no"/>

  <?php
    echo '<meta name="description" content="'.html_entity_decode($pageElements['description']['value']).'">';
    echo '<meta name="keywords" content="'.html_entity_decode($pageElements['keywords']['value']).'">';
    echo '<title>'.html_entity_decode($pageElements['titre']['value']).'</title>';
  ?>

  <!-- CSS  -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link href="css/materialize.min.css" type="text/css" rel="stylesheet" media="screen,projection"/>
  <link href="css/style.css" type="text/css" rel="stylesheet" media="screen,projection"/>
</head>
<body>
  <?php
    navigation($pageElements,'menu2');
  ?>

  <div class="valign-wrapper teal logo">
    <div class="center-align fullwidth">
      <a href="#" class=" brand-logo center white-text">
      <?php
        echo '<h4>'.html_entity_decode($pageElements['menu2']['value']).'</h4>';
      ?>
      </a>
    </div>
  </div>

  <div class="row margin-top fullwidth">
    <?php
      echo '<p>'.html_entity_decode($pageElements['descr_menu2']['value']).'</p>';
    ?>
  </div>

  <div class="row margin-top">
  <?php
  foreach($references as $reference) {
  ?>
    <div class="col l4 m6 s12">
      <div class="card">
        <div class="card-image waves-effect waves-block waves-light">
        <?php
          echo "<img class=\"activator\" src=\"".$reference['image']."\" style=\"width:auto;padding:15px\">";
        ?>
        </div>
        <div class="card-content">
          <p>
          <?php
            echo "<a target=\"_blank\" href=\"".html_entity_decode($references['texte'])."\">";
          ?>
          </p>
        </div>
      </div>
    </div>
  <?php
  }
  ?>
  </div>
  <?php
      footer($pageElements, $contactsArray);
  ?>
   <!--  Scripts-->
  <script src="js/jquery-2.2.4.min.js"></script>
  <script src="js/materialize.min.js"></script>
  <script src="js/init.js"></script>
  </body>
</html>