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

include(__DIR__.'/func/getJoueurs.php');
$joueurs = getJoueurs($langue);

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
    navigation($pageElements,'menu1');
  ?>

    <div class="valign-wrapper teal logo">
      <div class="center-align fullwidth">
        <a href="#" class=" brand-logo center white-text">
        <?php
          echo '<h4>'.htmlspecialchars_decode($pageElements['menu1']['value'], ENT_QUOTES).'</h4>';
        ?>
        </a>
      </div>
    </div>

  <div class="row margin-top fullwidth">
    <?php
      echo '<p>'.htmlspecialchars_decode($pageElements['descr_menu1']['value'], ENT_QUOTES).'</p>';
    ?>
  </div>

  <div class="row margin-top">
  <?php
  foreach($joueurs as $joueur) {
  ?>
    <div class="col l4 m6 s12">
      <div class="card">
        <div class="card-image waves-effect waves-block waves-light">
        <?php
          echo "<img class=\"activator\" src=\"".htmlspecialchars_decode($joueur['image'], ENT_QUOTES)."\" style=\"width:auto;padding:15px\">";
        ?>
        </div>
        <div class="card-content">
          <span class="card-title activator grey-text text-darken-4">
          <?php
            echo htmlspecialchars_decode($joueur['nom'], ENT_QUOTES);
          ?>
          <i class="material-icons right">more_vert</i></span>
          <p>
          <?php
            echo "<a target=\"_blank\" href=\"".htmlspecialchars_decode($joueur['cible'], ENT_QUOTES)."\">";
            echo htmlspecialchars_decode($joueur['lien'], ENT_QUOTES)."</a>";
          ?>
          </p>
        </div>
        <div class="card-reveal">
          <span class="card-title grey-text text-darken-4">
          <?php
            echo htmlspecialchars_decode($joueur['nom'], ENT_QUOTES);
          ?>
          <i class="material-icons right">close</i></span>
          <p>
          <?php
            echo htmlspecialchars_decode($joueur['description'], ENT_QUOTES);
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
