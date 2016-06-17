<?php
session_start();
header("Content-Type: text/json; charset=utf8");
include('checkLogin.php');

if( !isSet($_POST['number']) ||
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
    $langue = (isSet($_POST['langue']) && !empty($_POST['langue']))? $_POST['langue'] : "fr";
  	ob_start();
    include(__DIR__.'/../admin/config.php');

    $numberSafe = htmlspecialchars($_POST['number'], ENT_QUOTES);

    $sql = "UPDATE pageelement SET value = '".$numberSafe."' where
    langue = '".$langue."' and label='engagement_number'";

	  $res = mysqli_query($dbC, $sql);

    ob_end_flush();

    if($res) {
	  echo json_encode(array(
        'success' => true,
        'sql' => $sql
       ));
    } else {
	    echo json_encode(array(
	        'success' => false,
          'reason' => mysqli_error($dbC)
	    ));
   }

} catch(Exception $ex){
    echo json_encode(array(
        'success' => false,
        'reason'  => $ex->getMessage(),
    ));
}
?>
