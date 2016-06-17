<?php
session_start();
header("Content-Type: text/json; charset=utf8");
include('checkLogin.php');

if( !isSet($_POST['idreference']) ||
    !isSet($_POST['textrefrence']) ||
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
    $idreferenceSafe = htmlspecialchars($_POST['idreference'], ENT_QUOTES);
    $textrefrenceSafe = htmlspecialchars($_POST['textrefrence'], ENT_QUOTES);
    $imagereferenceSafe = htmlspecialchars($_POST['imagereference'], ENT_QUOTES);
    $langue = (isSet($_POST['langue']) && !empty($_POST['langue']))? $_POST['langue'] : "fr";

    $sql = "UPDATE reference set texte = '".$textrefrenceSafe."', image = '".$imagereferenceSafe."'
       WHERE langue = '".$langue."' and idreference ='".$idreferenceSafe."'";

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
