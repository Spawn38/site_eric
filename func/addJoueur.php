<?php
session_start();
header("Content-Type: text/json; charset=utf8");
include('checkLogin.php');

if( !isSet($_POST['nomjoueur']) || 
    !isSet($_POST['block']) || 
    !isSet($_SESSION['login']) || 
    !isSet($_SESSION['password']) || 
    !checkLogin($_SESSION['login'], $_SESSION['password'])) {  

    echo json_encode(array(
        'success' => false,
        'reason' => 'acces interdit'
       ));
    return;
}

try {			
	ob_start();
    include(__DIR__.'/../admin/config.php');

    $nomSafe = htmlentities($_POST['nomjoueur']);
    $blockSafe = htmlentities($_POST['block']);
    $lienSafe = htmlentities($_POST['lienjoueur']);
    $cibleSafe = htmlentities($_POST['ciblejoueur']);
    $imageSafe = htmlentities($_POST['imagejoueur']);
    $langue = isSet($_POST['langue'])?$_POST['langue']:"fr";

    $sql = "INSERT INTO joueurs (nom, description, lien, cible, image, langue) VALUES
    ('".$nomSafe."', '".$blockSafe."', '".$lienSafe."', 
    '".$cibleSafe."', '".$imageSafe."', '".$_POST['langue']."')";


	$res = mysqli_query($dbC, $sql);         
    $idJoueur = mysqli_insert_id($dbC);    
    ob_end_flush();

    if($res) {
	  echo json_encode(array(
        'success' => true,
        'id' => $idJoueur
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