<?php
session_start();
$_SESSION['token'] = crypt("access",date("m.d.y"));
include(__DIR__.'/func/getContact.php');
$langue = isSet($_SESSION['lang'])?$_SESSION['lang']:"fr";

$contactsArray = getContact($langue);

include(__DIR__.'/func/default.php');
include(__DIR__.'/func/getPageElements.php');
$pageElements = getPageElements($langue, getDefaultValues());

include(__DIR__.'/func/getEngagements.php');
$engagementsArray = getEngagements($langue);

include(__DIR__.'/func/getEngagementsNumber.php');
$engagementsColNumber = getEngagementsNumber();

include(__DIR__.'/func/getBlocks.php');
$blockArray = getBlocks($langue);

include(__DIR__.'/blocks/nav.php');
include(__DIR__.'/blocks/banner.php');
include(__DIR__.'/blocks/contact.php');
include(__DIR__.'/blocks/popup.php');
include(__DIR__.'/blocks/footer.php');
include(__DIR__.'/blocks/engagements.php');
include(__DIR__.'/blocks/blocks.php');
?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no"/>
  <title>
  <?php
    echo html_entity_decode($pageElements['titre']['value']);
  ?>
  </title>
  <!-- CSS  -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link href="css/materialize.min.css" type="text/css" rel="stylesheet" media="screen,projection"/>
  <link href="css/style.css" type="text/css" rel="stylesheet" media="screen,projection"/>
</head>
<body>
  <?php
    navigation($pageElements);
    banner($pageElements);
    engagements($pageElements, $engagementsArray, $engagementsColNumber);
    blocks($blockArray);
    footer($pageElements, $contactsArray);
    popup($pageElements);
  ?>

  <!--  Scripts-->
  <script src="js/jquery-2.2.4.min.js"></script>
  <script src="js/materialize.min.js"></script>
  <script src="js/init.js"></script>

  <?php
    contact($pageElements);
  ?>
</body>
</html>
