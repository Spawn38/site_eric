<?php
session_start();
header("Content-Type: text/json; charset=utf8");
include('checkLogin.php');
if(!isSet($_POST['idjoueur']) || !isSet($_SESSION['login']) || !isSet($_SESSION['password']) || !checkLogin($_SESSION['login'], $_SESSION['password'])) {  
	echo json_encode(array(
		'success' => false,
		'reason' => 'acces interdit'
		));
	return; 
}

try {			
	ob_start();
    include(__DIR__.'/../admin/config.php');

	$idjoueur = htmlentities($_POST['idjoueur']);
  	$nomSafe = htmlentities($_POST['nomjoueur']);
    $blockSafe = htmlentities($_POST['block']);
    $lienSafe = htmlentities($_POST['lienjoueur']);
    $cibleSafe = htmlentities($_POST['ciblejoueur']);
    $imageSafe = htmlentities($_POST['image']);
    $langue = isSet($_POST['langue'])?$_POST['langue']:"fr";

    $sql="UPDATE joueurs SET nom = '".$nomSafe."', 
    description = '".$blockSafe."', lien = '".$lienSafe."', 
    cible = '".$cibleSafe."', image  = '".$imageSafe."'
    WHERE idjoueur = '".$idjoueur."' and  langue = '".$langue."'";

	$res = mysqli_query($dbC, $sql);
      
    ob_end_flush();
    if($res) {
		echo json_encode(array(
	        'success' => true	        	        
	    ));
	} else {
	    echo json_encode(array(
	        'success' => false,
	        'reason' => $sql
	    ));
	}
	
} catch(Exception $ex){
    echo json_encode(array(
        'success' => false,
        'reason'  => $ex->getMessage(),
    ));
}
?>