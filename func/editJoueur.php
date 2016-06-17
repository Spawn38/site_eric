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

	  $idjoueur = htmlspecialchars($_POST['idjoueur'], ENT_QUOTES);
  	$nomSafe = htmlspecialchars($_POST['nomjoueur'], ENT_QUOTES);
    $blockSafe = htmlspecialchars($_POST['block'], ENT_QUOTES);
    $lienSafe = htmlspecialchars($_POST['lienjoueur'], ENT_QUOTES);
    $cibleSafe = htmlspecialchars($_POST['ciblejoueur'], ENT_QUOTES);
    $imageSafe = htmlspecialchars($_POST['image'], ENT_QUOTES);
    $langue = (isSet($_POST['langue']) && !empty($_POST['langue']))? $_POST['langue'] : "fr";

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
