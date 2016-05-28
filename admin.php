<?php
session_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
    <title>SPRA - Association spécialisée en Conseil et Management</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  	<link href="css/materialize.min.css" type="text/css" rel="stylesheet" media="screen,projection"/>
  	<link href="css/style.css" type="text/css" rel="stylesheet" media="screen,projection"/>  
</head>
<body>
  <div class="container center" style="top:15px">
    <div class="col s6 teal z-depth-1">
      <h4 style="color:white">Administration</h4>
    </div>
  </div>
  <div class="container center">
    <div class="col s6">
      <div class="card-panel left-align">
      	<form name="loginForm" id="loginForm" method="POST" action="check_login.php">
        <?php
            $msg = $_GET['msg'];
            if($msg!='') {
          ?>
          <div class="row" style="color: red">
          <?php
            echo '<p class="center">'.$msg.'</p>';
          ?>
          </div>
          <?php
          }
          ?>
      		<div class="row">
            <div class="input-field col s12">
              <input name="login" id="login" type="text" class="validate" required>
              <label for="login">Login</label>
            </div>
          </div>
          <div class="row">
            <div class="input-field col s12">
              <input name="pwd" id="pwd" type="password" class="validate" required>
              <label for="pwd">Mot de passe</label>
            </div>
          </div>
          <div class="row center">
            <div class="col s12">
          	  <button class="btn waves-effect waves-light" type="submit" name="action">Login
                <i class="material-icons right">vpn_key</i>
              </button>        
              <a onClick="$('#loginForm').get(0).reset();" class="waves-effect waves-green btn-flat">Annuler</a>			
            </div>
      		</div>
      	</form>
      </div>
    </div>
  </div>

  <script src="js/jquery-2.2.4.min.js"></script>
  <script src="js/materialize.min.js"></script>
</body>
</html>