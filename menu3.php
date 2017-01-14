<?php
session_start();
$_SESSION['token'] = crypt("access",date("m.d.y"));

include(__DIR__.'/func/lang.php');
$langue = getLang();

include(__DIR__.'/func/getContact.php');
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
    echo '<meta name="description" content="'.htmlspecialchars_decode($pageElements['description']['value'], ENT_QUOTES).'">';
    echo '<meta name="keywords" content="'.htmlspecialchars_decode($pageElements['keywords']['value'], ENT_QUOTES).'">';
    echo '<title>'.htmlspecialchars_decode($pageElements['titre']['value'], ENT_QUOTES).'</title>';
  ?>

  <!-- CSS  -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link href="css/materialize.min.css" type="text/css" rel="stylesheet" media="screen,projection"/>
  <link href="css/style.css" type="text/css" rel="stylesheet" media="screen,projection"/>
</head>
<body>
  <?php
    navigation($pageElements,'menu3');
  ?>

  <div class="valign-wrapper teal logo">
    <div class="center-align fullwidth">
      <a href="#" class=" brand-logo center white-text">
      <?php
        echo '<h4>'.htmlspecialchars_decode($pageElements['menu3']['value'], ENT_QUOTES).'</h4>';
      ?>
      </a>
    </div>
  </div>

  <div class="row margin-top fullwidth">
    <?php
      echo '<p>'.htmlspecialchars_decode($pageElements['descr_menu3']['value'], ENT_QUOTES).'</p>';
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
