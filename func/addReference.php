<?php
session_start();
header("Content-Type: text/json; charset=utf8");
include('checkLogin.php');

if( !isSet($_POST['textrefrence']) ||
    !isSet($_POST['imagereference']) ||
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

    $textrefrenceSafe = htmlspecialchars($_POST['textrefrence'], ENT_QUOTES);
    $imagereferenceSafe = htmlspecialchars($_POST['imagereference'], ENT_QUOTES);
    $langue = (isSet($_POST['langue']) && !empty($_POST['langue']))? $_POST['langue'] : "fr";

    $sql = "INSERT INTO reference (texte, image,langue) VALUES
      ('".$textrefrenceSafe."', '".$imagereferenceSafe."','".$langue."')";

    $res = mysqli_query($dbC, $sql);
    $idReference = mysqli_insert_id($dbC);
    ob_end_flush();

    if($res) {
	  echo json_encode(array(
        'success' => true,
        'id' => $idReference
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
