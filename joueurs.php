<?php
session_start();
$_SESSION['token'] = crypt("access",date("m.d.y"));
include(__DIR__.'/func/getContact.php');
$langue = isSet($_SESSION['lang'])?$_SESSION['lang']:"fr";

$contactsArray = getContact($langue);

include(__DIR__.'/func/default.php');
include(__DIR__.'/func/getPageElements.php');
$pageElements = getPageElements($langue, getDefaultValues());

include(__DIR__.'/func/getJoueurs.php');
$joueurs = getJoueurs($langue);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no"/>
  <title>
  <?php
    echo html_entity_decode($pageElements['titre']);
  ?>
  </title>
  <!-- CSS  -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link href="css/materialize.min.css" type="text/css" rel="stylesheet" media="screen,projection"/>
  <link href="css/style.css" type="text/css" rel="stylesheet" media="screen,projection"/>  
</head>
<body>
  <nav class="white" role="navigation">
    <div class="nav-wrapper container">
      <a id="logo-container" href="/" class="brand-logo"><img id="logo" src="logo.png"/></a>
      <ul class="right hide-on-med-and-down">
      <?php        
        echo "<li><a href=\"joueurs.php\">".html_entity_decode($pageElements['menu1'])."</a></li>";
        echo "<li><a href=\"#\">".html_entity_decode($pageElements['menu2'])."</a></li>";
        echo "<li><a href=\"#\">".html_entity_decode($pageElements['menu3'])."</a></li>";
      ?>      
      </ul>
      <ul id="nav-mobile" class="side-nav">
      <?php        
        echo "<li><a href=\"joueurs.php\">".html_entity_decode($pageElements['menu1'])."</a></li>";
        echo "<li><a href=\"#\">".html_entity_decode($pageElements['menu2'])."</a></li>";
        echo "<li><a href=\"#\">".html_entity_decode($pageElements['menu3'])."</a></li>";
      ?>  
      </ul>
      <a href="#" data-activates="nav-mobile" class="button-collapse"><i class="material-icons">menu</i></a>
    </div>
  </nav>
  <nav>
    <div class="nav-wrapper teal">
        <a href="#" class="brand-logo center white-text">
        <?php 
          echo html_entity_decode($pageElements['menu1']);
        ?>
        </a>
    </div>
  </nav>

  <div class="row margin-top">
  <?php  
  foreach($joueurs as $joueur) {
  ?>
    <div class="col l4 m6 s12">
      <div class="card">
        <div class="card-image waves-effect waves-block waves-light">
        <?php
          echo "<img class=\"activator\" src=\"upload/".$joueur['image']."\" style=\"width:auto;padding:15px\">";
        ?>
        </div>
        <div class="card-content">
          <span class="card-title activator grey-text text-darken-4">
          <?php
            echo html_entity_decode($joueur['nom']);
          ?>
          <i class="material-icons right">more_vert</i></span>
          <p>
          <?php
            echo "<a target=\"_blank\" href=\"".html_entity_decode($joueur['cible'])."\">";
            echo html_entity_decode($joueur['lien'])."</a>";
          ?>
          </p>
        </div>
        <div class="card-reveal">
          <span class="card-title grey-text text-darken-4">
          <?php
            echo html_entity_decode($joueur['nom']);
          ?>
          <i class="material-icons right">close</i></span>
          <p>
          <?php
            echo html_entity_decode($joueur['description']);
          ?>
          </p>
        </div>
      </div>
    </div>
  <?php     
  } 
  ?>
  </div>
   <!--  Scripts-->
  <script src="js/jquery-2.2.4.min.js"></script>
  <script src="js/materialize.min.js"></script>
  <script src="js/init.js"></script>

  <footer class="page-footer teal">
    <div class="container">
      <div class="row">
        <div class="col l6 s12">
          <h5 class="white-text">
            <?php
              echo html_entity_decode($pageElements['pied_titre']);
            ?>
          </h5>
          <p class="grey-text text-lighten-4" style="line-height: 1.5">
            <?php
              echo html_entity_decode($pageElements['pied_texte']);
            ?>
          </p>
        </div>
        <div class="col l6 s12">
          <h5 class="white-text">
           <?php
              echo html_entity_decode($pageElements['contact_titre']);
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
          echo html_entity_decode($pageElements['popup']);
        ?>
        </p>
      </div>
    </div>
  </footer>
  </body>
</html>