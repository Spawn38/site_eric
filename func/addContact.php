<?php
session_start();
header("Content-Type: text/json; charset=utf8");
include('checkLogin.php');

if( !isSet($_POST['label']) ||
    !isSet($_POST['value']) ||
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

    $valueSafe = htmlspecialchars($_POST['value'], ENT_QUOTES);
    $labelSafe = htmlspecialchars($_POST['label'], ENT_QUOTES);
    $langue = (isSet($_POST['langue']) && !empty($_POST['langue']))? $_POST['langue'] : "fr";
    $sql = "INSERT INTO contact(label,value,langue) VALUE ('".$labelSafe."', '".$valueSafe."', '".$langue."')";

	$res = mysqli_query($dbC, $sql);
    $idContact = mysqli_insert_id($dbC);
    ob_end_flush();

    if($res) {
	  echo json_encode(array(
        'success' => true,
        'id' => $idContact
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
