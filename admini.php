<?php
session_start();
include(__DIR__.'/func/checkLogin.php');
if(!isSet($_SESSION['login']) || !isSet($_SESSION['password']) || !checkLogin($_SESSION['login'], $_SESSION['password'])) {
    header("location:admin.php");
}

$langue = isSet($_SESSION['lang'])?$_SESSION['lang']:"fr";
$onglet = isSet($_GET['onglet'])?$_GET['onglet']:"0";

include(__DIR__.'/func/getContact.php');
$contacts = getContact($langue);

include(__DIR__.'/func/default.php');
include(__DIR__.'/func/getPageElements.php');
$pageElements = getPageElements($langue, getDefaultValues());

include(__DIR__.'/func/getEngagements.php');
$engagements = getEngagements($langue);

include(__DIR__.'/func/getEngagementsNumber.php');
$engagementsNumber = getEngagementsNumber();

include(__DIR__.'/func/getJoueurs.php');
$joueurs = getJoueurs($langue);

include(__DIR__.'/func/getBlocks.php');
$blockArray = getBlocks($langue);

include(__DIR__.'/func/getReferences.php');
$referencesArray = getReferences($langue);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no"/>
  <title>
  <?php
    echo htmlspecialchars_decode($pageElements['titre']['value'], ENT_QUOTES)." - admin";
  ?>
  </title>
  <!-- CSS  -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link href="css/materialize.min.css" type="text/css" rel="stylesheet" media="screen,projection"/>
  <link href="css/style.css" type="text/css" rel="stylesheet" media="screen,projection"/>
</head>
<body>
  <nav>
    <div class="nav-wrapper teal">
      <a href="#" class="brand-logo center white-text" >Administration</a>
      <ul id="nav-mobile" class="right">
        <li><a class="waves-effect waves-light btn" href="#" onClick="exportConfig()">Export</a></li>
        <li><a class="waves-effect waves-light btn" href="/func/logout.php">Deconnexion</a></li>
      </ul>
      <div id="nav-mobile" class="left" style="margin-left:15px" >
        <ul>
          <input name="group1" type="radio" id="test1" checked/>
          <label class="white-text" style="padding-right: 15px;" for="test1">Fr</label>
          <input name="group1" type="radio" id="test2" />
          <label class="white-text" for="test2">En</label>
        </ul>
      </div>
    </div>
  </nav>

  <div id="loading" class="container center margin-top">
    <div class="preloader-wrapper big active">
      <div class="spinner-layer spinner-teal-only">
        <div class="circle-clipper left">
          <div class="circle"></div>
        </div>
      </div>
    </div>
    <h4>Chargement...</h4>
  </div>

  <div class="row" id="main" style="display:none" >
    <div class="col s12 margin-top">
      <ul class="tabs">
        <?php
        $titre = array("admin1" => "Principale", "admin2" => "Contact",
          "admin3" => "Engagements", "admin4" => "Blocks", "admin5" => htmlspecialchars_decode($pageElements['menu1']['value'], ENT_QUOTES),
          "admin6" => htmlspecialchars_decode($pageElements['menu2']['value'], ENT_QUOTES));
        $i=0;
        foreach($titre as $id => $menu ) {
          echo "<li  class=\"tab col s3\"><a ";
          if($onglet == $i) {
            echo "class = \"active\"";
          }
          echo " href=\"#$id\">$menu</a></li>";
          $i++;
        }
        ?>
      </ul>
    </div>
    <div id="admin1" class="col s12">
      <table class="bordered highlight admin"
        style="line-height:normal;color:black;margin:15px;width:100%"
        id="tabContact">
        <thead>
          <tr>
            <th data-field="id">Element</th>
            <th data-field="name">Valeur</th>
            <th data-field="name">Actions</th>
          </tr>
        </thead>
        <tbody>
        <?php
        foreach ( $pageElements as $key => $element) {
          echo '<tr>';
            echo '<td>'.htmlspecialchars_decode($key, ENT_QUOTES).'</td>';
            echo '<td style="white-space: pre-wrap; width:60%" id="element'.htmlspecialchars_decode($key, ENT_QUOTES).'">';
              if($element['image']==1) {
                echo '<img src="'.htmlspecialchars_decode($element['value'], ENT_QUOTES).'" class="logo"/>';
              } else {
                echo htmlspecialchars_decode($element['value'], ENT_QUOTES);
              }
            echo '</td>';
            echo '<td>';
              echo "<a class=\"waves-effect waves-light btn\" style=\"margin-right:15px\"
                onClick=\"editElementForm('".$key."','".$element['simple']."','".$element['image']."')\">Edit</a>";
              echo "<a class=\"waves-effect waves-light btn\"
                onClick=\"resetElementForm('".$key."')\">Reset</a>";
            echo '</td>';
          echo '</tr>';
        }
        ?>
        </tbody>
      </table>

      <div id="modalElementForm" class="modal">
        <div class="modal-content">
          <h5 class="white-text center-align card-panel teal">Page principale</h5>
          <form class="col s12" id="elementFormAdmin">
            <div class="row">
              <div class="input-field col s12">
                <input id="labelElementForm" type="text" disabled>
                <label for="labelElementForm">Element</label>
              </div>
            </div>
            <div class="row" id="editComplex">
              <div class="input-field col s12">
                <textarea id="valueElementForm" ></textarea>
              </div>
            </div>
            <div class="row" id="editSimple">
              <div class="input-field col s12">
                <input id="simpelValueElementForm" type="text" class="validate">
                <label for="simpelValueElementForm">Texte</label>
              </div>
            </div>
            <div class="row right">
                <button class="btn waves-effect waves-light" type="submit" name="action">Enregistrer
                </button>
                <a onCLick="$('#modalElementForm').closeModal();" class="waves-effect waves-teal btn-flat">Annuler</a>
            </div>
            <input type="hidden" id="simpleElementForm" name="simpleElementForm" value=""/>
            <input type="hidden" id="imageElementForm" name="imageElementForm" value=""/>
            <input type="hidden" id="idElementForm" name="idElementForm" value=""/>
          </form>
        </div>
      </div>
    </div>
    <div id="admin2" class="col s12">

      <table class="bordered highlight admin"
        style="line-height:normal;color:black;margin:15px;width:100%"
        id="tabContact">
        <thead>
          <tr>
            <th data-field="id">Label</th>
            <th data-field="name">Valeur</th>
            <th data-field="name">Actions</th>
          </tr>
        </thead>
        <tbody>
        <?php

        foreach ( $contacts as $key => $value) {
          echo '<tr id="contact'.$value["idcontact"].'">';
            echo '<td>';
              echo htmlspecialchars_decode($value["label"], ENT_QUOTES);
            echo '</td>';
            echo '<td style="white-space: pre-wrap; width:60%">';
              echo htmlspecialchars_decode($value["value"], ENT_QUOTES);
            echo '</td>';
            echo '<td>';
              echo "<a class=\"waves-effect waves-light btn\" style=\"margin-right:15px\"
                onClick=\"editContactForm(".$value["idcontact"].",'".$value["label"]."','".$value["value"]."')\"
              >Edit</a>";
              echo "<a class=\"waves-effect waves-light btn\" onClick=\"supprContactForm(".$value["idcontact"].")\">Suppr</a>";
            echo "</td>";
          echo "</tr>";
        }
        ?>
        </tbody>
      </table>

      <div class="row">
        <form class="col s12">
          <a class="waves-effect waves-light btn" onClick="addContactForm()">Ajouter</a>
        </form>
      </div>
      <div id="modalContactForm" class="modal">
        <div class="modal-content">
          <h5 class="white-text center-align card-panel teal">Contact</h5>
          <form class="col s12" id="contactFormAdmin">
            <div class="row">
              <div class="input-field col s12">
                <input id="labelContactForm" type="text" class="validate" required>
                <label for="labelContactForm">Label</label>
              </div>
            </div>
            <div class="row">
              <div class="input-field col s12">
                <textarea id="valueContactForm" ></textarea>
              </div>
            </div>
            <div class="row right">
                <button class="btn waves-effect waves-light" type="submit" name="action">Enregistrer
                </button>
                <a onCLick="$('#modalContactForm').closeModal();" class="waves-effect waves-teal btn-flat">Annuler</a>
            </div>
            <input type="hidden" id="idContactForm" name="idContactForm" value=""/>
            <input type="hidden" id="actionContactForm" name="actionContactForm" value=""/>
          </form>
        </div>
      </div>
    </div>
    <div id="admin3" class="col s12">
      <div class="row margin-top">
        <center>
          <span style="padding-right:15px">Nombre maximum de colonnes</span>
          <a onClick="removeEngagementsNumber()" class="btn-floating btn-small waves-effect waves-light teal"><i class="material-icons">remove</i></a>
          <a class="btn-flat">
            <span id="numberEngagement" style="font-size:2.5rem">
              <?php
                echo $engagementsNumber;
              ?>
            </span>
          </a>
          <a onClick="addEngagementsNumber()" class="btn-floating btn-small waves-effect waves-light teal"><i class="material-icons">add</i></a>
        </center>
      </div>
      <div class="row">
      <?php
        foreach($engagements as $engagement) {

          $idEng = "engagement".$engagement['idengagement'];
          if($engagement['image']!="") {
            echo "<style>";
              echo "#".$idEng.":before {";
              echo "background-image: url('".htmlspecialchars_decode($engagement['image'], ENT_QUOTES)."') }";
            echo "</style>";
          }

          echo "<div class=\"col s12\">";
            echo "<div class=\"card\">";
            if($engagement['image']!="") {
              echo "<div class=\"card-content fond\" id=\"".$idEng."\">";
            } else {
              echo "<div class=\"card-content\" id=\"".$idEng."\">";
            }
                echo "<i class=\"material-icons prefix\">".htmlspecialchars_decode($engagement['icone'], ENT_QUOTES)."</i>";
                echo "<span class=\"card-title\">".htmlspecialchars_decode($engagement['titre'], ENT_QUOTES)."</span>";
                echo "<div>";
                  echo htmlspecialchars_decode($engagement['block'], ENT_QUOTES);
                echo "</div>";
              echo "</div>";
              echo "<div class=\"card-action\">";
                echo "<a class=\"waves-effect black-text waves-teal btn-flat\"
                  onClick=\"editEngagementForm(".$engagement['idengagement'].",'".$engagement['image']."')\">Edition</a>";
                echo "<a class=\"waves-effect black-text waves-teal btn-flat\"
                  onClick=\"deleteEngagementForm(".$engagement['idengagement'].")\">Suppression</a>";
          echo "</div></div></div>";
        }
      ?>
      </div>
      <div id="modalEngagementForm" class="modal">
        <div class="modal-content">
          <h5 class="white-text center-align card-panel teal">Engagement</h5>
          <form class="col s12" id="engagementFormAdmin">
            <div class="row">
              <div class="input-field col s12">
                <label for="titreEngagementForm">titre</label><br/>
                <p id="titreEngagementForm" ></p>
              </div>
            </div>
            <div class="row">
              <div class="input-field col s12">
                <input style="width:95%" onBlur="updateIcon()" id="iconeEngagementForm" type="text" class="validate"313>
                <label for="iconeEngagementForm">icone</label>
                <i id="iconEngagement" class="material-icons prefix"></i>
              </div>
            </div>
            <div class="row">
              <div class="input-field col s12">
                <input id="fondEngagementForm" type="text" class="validate">
                <label for="fondEngagementForm">image fond (opacité à effectuer sur l'image)</label>
              </div>
            </div>
            <div class="row">
              <div class="input-field col s12">
                <textarea id="valueEngagementForm" ></textarea>
              </div>
            </div>
            <div class="row right">
                <button class="btn waves-effect waves-light" type="submit" name="action">Enregistrer
                </button>
                <a class="waves-effect waves-teal btn-flat"
                   href="https://design.google.com/icons/#ic_delete_forever"
                   target="_blank">Icones</a>
                <a onCLick="$('#modalEngagementForm').closeModal();" class="waves-effect waves-teal btn-flat">Annuler</a>
            </div>
            <input type="hidden" id="idEngagementForm" name="idEngagementForm" value=""/>
            <input type="hidden" id="actionEngagementForm" name="actionEngagementForm" value=""/>
          </form>
        </div>
      </div>
      <div class="row">
        <form class="col s12">
          <a class="waves-effect waves-light btn" onClick="addEngagementForm()">Ajouter</a>
        </form>
      </div>
    </div>
    <div id="admin4" class="row">
      <div class="col s12 sort-scroll-container" data-animation-duration="1000" data-css-easing="ease-in-out" data-keep-still=true data-fixed-elements-selector=".navigation">
        <style>
        <?php
        foreach ( $blockArray as $block) {
          if($block['type']==1) {
            echo '#block'.$block['idblock'].':before';
            echo "{\n";
              echo "background-image: url('".htmlspecialchars_decode($block['image'], ENT_QUOTES)."')";
            echo "}\n";
          }
        }
        ?>
        </style>
        <?php
        foreach ( $blockArray as $block) {
          $fondAdmin ='';
          if($block['type']==1) {
            $fondAdmin = 'fondAdmin';
          }

          echo '<div class="sort-scroll-element card noBackGround">';
          echo '<input type="hidden" id="idBlock" value="'.$block['idblock'].'"/>';
          echo '<div class="center card-content '.$fondAdmin.'" id="block'.$block['idblock'].'">';
          if($block['type']==1) {
            echo '<h4 class="textImage">'.htmlspecialchars_decode($block['texte'], ENT_QUOTES).'</h4>';
          } else {
            echo '<span class="card-title">'.htmlspecialchars_decode($block['titre'], ENT_QUOTES).'</span>';
            echo '<div>'.htmlspecialchars_decode($block['texte'], ENT_QUOTES).'</div>';
          }
          echo '</div>';
            echo '<div class="card-action backGroundWhite">';
              echo '<a class="waves-effect black-text waves-teal btn-flat" ';
                echo "onClick=\"editBlockForm(".$block['idblock'].", ".$block['type'].", '".$block['image']."')\"";
                echo '>Edition</a>';
              echo '<a class="waves-effect black-text waves-teal btn-flat" ';
                echo "onClick=\"deleteBlockForm(".$block['idblock'].")\"";
                echo '>Suppression</a>';
              echo '<a class="sort-scroll-button-up"><i class="material-icons">arrow_upward</i></a>';
              echo '<a class="sort-scroll-button-down"><i class="material-icons">arrow_downward</i></a>';
            echo '</div>';
          echo '</div>';
        }
        ?>
      </div>
      <div class="row">
        <form class="col s12">
          <a class="waves-effect waves-light btn" onClick="addBlockForm()">Ajouter</a>
        </form>
      </div>
      <div id="modalBlockForm" class="modal">
        <div class="modal-content">
          <h5 class="white-text center-align card-panel teal">Blocks</h5>
          <form class="col s12" id="blockFormAdmin" enctype="multipart/form-data">
            <div class="row">
              <div class="switch">
                <label>
                    Texte
                  <input type="checkbox" id="typeBlock" onClick="changeTypeBlock()">
                  <span class="lever"></span>
                    Image
                </label>
              </div>
            </div>
            <div id="blockImage">
              <div class="row">
                <div class="input-field col s12">
                  <input id="fondBlockForm" type="text" class="validate">
                  <label for="fondBlockForm">image fond (opacité automatique sur l'image)</label>
                </div>
              </div>
              <div class="row">
                <div class="input-field col s12">
                  <textarea id="textBlockForm" class="validate materialize-textarea"></textarea>
                  <label for="textBlockForm">Texte</label>
                </div>
              </div>
            </div>
            <div id="blockTexte">
              <div class="row">
                <div class="input-field col s12">
                  <input id="titreBlockForm" type="text" class="validate">
                  <label for="titreBlockForm">Titre</label>
                </div>
              </div>
              <div class="row">
                <div class="input-field col s12">
                  <textarea id="valueBlockForm" ></textarea>
                </div>
              </div>
            </div>
            <div class="row right">
              <button class="btn waves-effect waves-light" type="submit" name="action">Enregistrer</button>
              <a onCLick="$('#modalBlockForm').closeModal();" class="waves-effect waves-teal btn-flat">Annuler</a>
            </div>
            <input type="hidden" id="idBlockForm" name="idBlockForm" value=""/>
            <input type="hidden" id="actionBlockForm" name="actionBlockForm" value=""/>
          </form>
        </div>
      </div>
    </div>
    <div id="admin5" class="col s12">
        <div class="row">
        <?php
        foreach ( $joueurs as $joueur) {
          echo "<div class=\"col s12\">";
            echo "<div class=\"card\">";
              echo "<div class=\"card-image\" id=\"imageJoueur".$joueur['idjoueur']."\">";
                echo "<img class=\"activator\" src=\"".$joueur['image']."\" style=\"width:auto;padding:15px\"/>";
              echo "</div>";
              echo "<div class=\"card-content \" id=\"joueur".$joueur['idjoueur']."\">";
                echo "<span class=\"card-title\">".htmlspecialchars_decode($joueur['nom'], ENT_QUOTES)."</span>";
                echo "<br/><a target=\"_blank\" href=\"".htmlspecialchars_decode($joueur['cible'], ENT_QUOTES)."\">";
                echo htmlspecialchars_decode($joueur['lien'], ENT_QUOTES)."</a>";
                echo "<p>".htmlspecialchars_decode($joueur['description'], ENT_QUOTES)."</p>";
              echo "</div>";
              echo "<div class=\"card-action\">";
                echo "<a class=\"waves-effect black-text waves-teal btn-flat\"
                  onClick=\"editJoueurForm(".$joueur['idjoueur'].")\">Edition</a>";
                echo "<a class=\"waves-effect black-text waves-teal btn-flat\"
                  onClick=\"deleteJoueurForm(".$joueur['idjoueur'].")\">Suppression</a>";
          echo "</div></div></div>";
        }
        ?>
        </div>
      <div class="row">
        <form class="col s12">
          <a class="waves-effect waves-light btn" onClick="addJoueurForm()">Ajouter</a>
        </form>
      </div>

      <div id="modalJoueurForm" class="modal">
        <div class="modal-content">
          <h5 class="white-text center-align card-panel teal">Joueurs</h5>
          <form class="col s12" id="joueurFormAdmin" enctype="multipart/form-data">
            <div class="row">
              <div class="input-field col s12">
                <input id="nomJoueurForm" type="text" class="validate" required>
                <label for="nomJoueurForm">Nom prénom</label>
              </div>
            </div>
            <div class="row">
              <div class="input-field col s6">
                <input id="lienJoueurForm" type="text" class="validate" >
                <label for="lienJoueurForm">lien</label>
              </div>
              <div class="input-field col s6">
                <input id="cibleJoueurForm" type="text" class="validate" >
                <label for="cibleJoueurForm">cible</label>
              </div>
            </div>

            <div class="file-field input-field">
              <div class="btn" id="file-upload">
                <span>Image</span>
                <input type="file" name="file">
              </div>
              <div class="file-path-wrapper">
                <input id="imageJoueur" class="file-path validate" type="text">
              </div>
              <div class="progress">
                  <div id="progress-image" class="determinate"></div>20%
              </div>
            </div>
            <div class="row">
              <div class="input-field col s12">
                <textarea id="valueJoueurForm" ></textarea>
              </div>
            </div>
            <div class="row right">
                <button class="btn waves-effect waves-light" type="submit" name="action">Enregistrer
                </button>
                <a onCLick="$('#modalJoueurForm').closeModal();" class="waves-effect waves-teal btn-flat">Annuler</a>
            </div>
            <input type="hidden" id="idJoueurForm" name="idJoueurForm" value=""/>
            <input type="hidden" id="actionJoueurForm" name="actionJoueurForm" value=""/>       <input type="hidden" name="MAX_FILE_SIZE" value="500000"/>
          </form>
        </div>
      </div>
    </div>

    <div id="admin6" class="col s12">
      <div class="row">
        <table class="bordered highlight admin"
          style="line-height:normal;color:black;margin:15px;width:100%"
          id="tabReference">
          <thead>
            <tr>
              <th data-field="name">Logo</th>
              <th data-field="name">Texte</th>
              <th data-field="name">Actions</th>
            </tr>
          </thead>
          <tbody>
          <?php
          foreach ( $referencesArray as $element) {
            echo '<tr id="reference'.htmlspecialchars_decode($element['idreference'], ENT_QUOTES).'">';
              echo '<td><img src="'.htmlspecialchars_decode($element['image'], ENT_QUOTES).'" class="logo"/></td>';
              echo '<td style="white-space: pre-wrap; width:60%">';
                  echo '<span>'.htmlspecialchars_decode($element['texte'], ENT_QUOTES).'</span>';
              echo '</td>';
              echo '<td>';
                echo "<a class=\"waves-effect waves-light btn\" style=\"margin-right:15px\"
                  onClick=\"editReferenceForm('".$element['idreference']."')\">Edit</a>";
                echo "<a class=\"waves-effect waves-light btn\"
                  onClick=\"deleteReferenceForm('".$element['idreference']."')\">Suppr</a>";
              echo '</td>';
            echo '</tr>';
          }
          ?>
          </tbody>
        </table>
      </div>
      <div class="row">
        <form class="col s12">
          <a class="waves-effect waves-light btn" onClick="addReferenceForm()">Ajouter</a>
        </form>
      </div>

      <div id="modalReferenceForm" class="modal">
        <div class="modal-content">
          <h5 class="white-text center-align card-panel teal">Références</h5>
          <form class="col s12" id="referenceFormAdmin">
            <div class="row">
              <div class="input-field col s12">
                <input id="imageReference" type="text" class="validate" required>
                <label for="imageReference">Logo</label>
              </div>
            </div>
            <div class="row">
              <div class="input-field col s12">
                <input id="textRefrenceForm" type="text" class="validate"  required>
                <label for="textRefrenceForm">Texte</label>
              </div>
            </div>
            <div class="row right">
                <button class="btn waves-effect waves-light" type="submit" name="action">Enregistrer
                </button>
                <a onCLick="$('#modalReferenceForm').closeModal();" class="waves-effect waves-teal btn-flat">Annuler</a>
            </div>
            <input type="hidden" id="idReferenceForm" name="idReferenceForm" value=""/>
            <input type="hidden" id="actionReferenceForm" name="actionReferenceForm" value=""/>
          </form>
        </div>
      </div>
    </div>
  </div>

  <?php
  echo "<input type=\"hidden\" id=\"langue\" name=\"langue\" value=\"".$langue."\"/>";
  ?>
  <!--  Scripts-->
  <script src="js/jquery-2.2.4.min.js"></script>
  <script src='js/tinymce.min.js'></script>
  <script src="js/materialize.min.js"></script>
  <script src="js/dmuploader.min.js"></script>
  <script src="js/jquery.sortScroll.min"></script>
  <script src="js/admininit.js"></script>
  <script src="js/blocks.js"></script>
  <script src="js/engagements.js"></script>
  <script src="js/joueurs.js"></script>
  <script src="js/contacts.js"></script>
  <script src="js/elements.js"></script>
  <script src="js/references.js"></script>
  </body>
</html>
