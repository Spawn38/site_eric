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
$engagements = getEngagements($langue);

include(__DIR__.'/func/getEngagementsNumber.php');
$engagementsNumber = getEngagementsNumber();

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
  <nav class="white" role="navigation">
    <div class="nav-wrapper container">
      <a id="logo-container" href="/" class="brand-logo"><img id="logo" src="logo.png"/></a>
      <ul class="right hide-on-med-and-down">
      <?php
        if(strlen(html_entity_decode($pageElements['menu1']['value']))) {
          echo "<li><a href=\"joueurs.php\">".html_entity_decode($pageElements['menu1']['value'])."</a></li>";
        }
        if(strlen(html_entity_decode($pageElements['menu2']['value']))) {
          echo "<li><a href=\"#\">".html_entity_decode($pageElements['menu2']['value'])."</a></li>";
        }
        if(strlen(html_entity_decode($pageElements['menu3']['value']))) {
          echo "<li><a href=\"#\">".html_entity_decode($pageElements['menu3']['value'])."</a></li>";
        }
      ?>
      </ul>
      <ul id="nav-mobile" class="side-nav">
      <?php
        if(strlen(html_entity_decode($pageElements['menu1']['value']))) {
          echo "<li><a href=\"joueurs.php\">".html_entity_decode($pageElements['menu1']['value'])."</a></li>";
        }
        if(strlen(html_entity_decode($pageElements['menu2']['value']))) {
          echo "<li><a href=\"#\">".html_entity_decode($pageElements['menu2']['value'])."</a></li>";
        }
        if(strlen(html_entity_decode($pageElements['menu3']['value']))) {
          echo "<li><a href=\"#\">".html_entity_decode($pageElements['menu3']['value'])."</a></li>";
        }
      ?>
      </ul>
      <a href="#" data-activates="nav-mobile" class="button-collapse"><i class="material-icons">menu</i></a>
    </div>
  </nav>

  <div id="index-banner" class="parallax-container">
    <div class="section no-pad-bot">
      <div class="container">
        <div class="row center">
          <h1 class="header center teal-text text-lighten-2">
          <?php
            echo html_entity_decode($pageElements['principal']['value']);
          ?>
          </h1>
        </div>
        <div class="row center">
          <a onClick="openContact()" class="btn-large waves-effect waves-light teal lighten-1">
          <?php
            echo html_entity_decode($pageElements['bouton_contact']['value']);
          ?>
          </a>
        </div>
      </div>
    </div>
    <div class="parallax"><img style="opacity: 0.8;filter: alpha(opacity=80);" src="images5.jpg" alt="Unsplashed background"></div>
  </div>
  <div class="container">
    <div class="section">
    <?php
      $i=0;
      $j=0;
      $nbEnagements = count($engagements);
      if($nbEnagements) {

        echo "<div class=\"row\">";
            echo "<div class=\"col s12\">";
              echo "<h4 class=\"header center\">";
                echo html_entity_decode($pageElements['engagement_titre']['value']);
              echo "</h4>";
            echo "</div>";
        echo "</div>";

        echo "<div class=\"row\">";
        while ($i < $nbEnagements)
        {
          $nbColumn = 2;
          if($engagementsNumber) {
            $nbColumn = 12 / $engagementsNumber;
          }

          echo "<div class=\"col s12 m".$nbColumn."\">";
            echo "<div class=\"icon-block\">";
              echo "<h2 class=\"center brown-text\"><i class=\"material-icons\">";
                echo html_entity_decode($engagements[$i]['icone']);
              echo "</i></h2>";
              echo "<h5 class=\"center\">";
                echo html_entity_decode($engagements[$i]['titre']);
              echo "</h5>";
              echo html_entity_decode($engagements[$i]['block']);
            echo "</div>";
          echo "</div>";

          $i++;
          $j++;
        }
        echo "</div>";
      }
    ?>
    </div>
  </div>

  <div class="parallax-container valign-wrapper">
    <div class="section no-pad-bot">
      <div class="container">
        <div class="row center">
          <h4 class="header col s12 textImage">
          <?php
          echo html_entity_decode($pageElements['titre_image1']['value']);
          ?>
          </h4>
        </div>
      </div>
    </div>
    <div class="parallax"><img style="opacity: 0.8;filter: alpha(opacity=80);" src="images2.jpg" alt="Unsplashed background img 2"></div>
  </div>

  <div class="container">
    <div class="section">

      <div class="row">
        <div class="col s12 center">
          <h3><i class="mdi-content-send brown-text"></i></h3>
          <h5>
            <?php
              echo html_entity_decode($pageElements['titre_texte1']['value']);
            ?>
          </h5>
          <?php
            echo html_entity_decode($pageElements['texte1']['value']);
          ?>
        </div>
      </div>

    </div>
  </div>

  <div class="parallax-container valign-wrapper">
    <div class="section no-pad-bot">
      <div class="container">
        <div class="row center">
          <h4 class="header col s12 textImage">
          <?php
            echo html_entity_decode($pageElements['titre_image2']['value']);
          ?>
          </h4>
        </div>
      </div>
    </div>
    <div class="parallax"><img style="opacity: 0.8;filter: alpha(opacity=80);" src="images6.jpg" alt="Unsplashed background img 3"></div>
  </div>

  <div class="container">
    <div class="section">

      <div class="row">
        <div class="col s12 center">
          <h3><i class="mdi-content-send brown-text"></i></h3>
          <h5>
            <?php
              echo html_entity_decode($pageElements['titre_texte2']['value']);
            ?>
          </h5>
          <?php
            echo html_entity_decode($pageElements['texte2']['value']);
          ?>
        </div>
      </div>

    </div>
  </div>

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
    <div id="messagepopup" class="footer-copyright z-depth-1" style="position: fixed;
    bottom: 10px;
    width: 80%;
    border: 1px solid #00796b;
    background-color : white;
    left: 10%;  border-radius: 10px 10px 10px 10px; z-index :3;
" onClick="onHidePopup()">
        <table class="popup">
          <tr>
            <td>
              <img src="logo.png" height="30px"/>
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

  <!--  Scripts-->
  <script src="js/jquery-2.2.4.min.js"></script>
  <script src="js/materialize.min.js"></script>
  <script src="js/init.js"></script>

  <div id="modalContact" class="modal">
    <div class="modal-content">
      <h5 class="white-text center-align card-panel teal">
        <?php
          echo html_entity_decode($pageElements['formulaire_titre']['value']);
        ?>
      </h5>
      <form class="col s12" id="contactForm">
        <div class="row">
          <div class="input-field col s12">
            <input id="name" type="text" class="validate" required>
            <label id="name" for="name">
            <?php
              echo html_entity_decode($pageElements['nom']['value']);
            ?>
            </label>
          </div>
        </div>
        <div class="row">
          <div class="input-field col s12">
            <input id="email" type="email" class="validate" required>
            <label for="email">
            <?php
              echo html_entity_decode($pageElements['email']['value']);
            ?>
            </label>
          </div>
        </div>
        <div class="row">
          <div class="input-field col s12">
            <textarea id="message" class="materialize-textarea"></textarea>
            <label for="message">
            <?php
              echo html_entity_decode($pageElements['message']['value']);
            ?>
            </label>
          </div>
        </div>
        <div class="row right">
            <button class="btn waves-effect waves-light" type="submit" name="action">
            <?php
              echo html_entity_decode($pageElements['envoyer']['value']);
            ?>
              <i class="material-icons right">email</i>
            </button>
            <a onClick="resetForm()" class="waves-effect waves-green btn-flat">
            <?php
              echo html_entity_decode($pageElements['annuler']['value']);
            ?>
            </a>
        </div>
      </form>
    </div>
  </div>
  </body>
</html>
