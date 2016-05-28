<?php
session_start();
header("Content-Type: text/json; charset=utf8");
include('checkLogin.php');

nomjoueur, lienjoueur,ciblejoueur, block, langue

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

    $titreSafe = htmlentities($_POST['titre']);
    $iconeSafe = htmlentities($_POST['icone']);
    $blockSafe = htmlentities($_POST['block']);

    $sql = "INSERT INTO engagement(titre,icone,block,langue) VALUE ('".$titreSafe."', '".$iconeSafe."', '".$blockSafe."', '".$_POST['langue']."')";

	$res = mysqli_query($dbC, $sql);         
    $idEngagement = mysqli_insert_id($dbC);    
    ob_end_flush();

    if($res) {
	  echo json_encode(array(
        'success' => true,
        'id' => $idEngagement
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