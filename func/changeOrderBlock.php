<?php
session_start();
header("Content-Type: text/json; charset=utf8");
include('checkLogin.php');
if(!isSet($_POST['idBlock']) ||
	!isSet($_POST['initialOrder']) ||
	!isSet($_POST['destinationOrder']) ||
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

	  $idBlock = htmlspecialchars($_POST['idBlock'], ENT_QUOTES);
  	$initialOrder = htmlspecialchars($_POST['initialOrder'], ENT_QUOTES);
    $destinationOrder = htmlspecialchars($_POST['destinationOrder'], ENT_QUOTES);
    $langue = (isSet($_POST['langue']) && !empty($_POST['langue']))? $_POST['langue'] : "fr";

    $sql="UPDATE block SET ordre = '".$initialOrder."' WHERE ordre = '".$destinationOrder."'";
	  $res = mysqli_query($dbC, $sql);
		$sql2="UPDATE block SET ordre = '".$destinationOrder."' WHERE idblock = '".$idBlock."'";
		$res2 = mysqli_query($dbC, $sql2);

    ob_end_flush();
    if($res && $res2) {
		echo json_encode(array(
	        'success' => true
	    ));
	} else {
	    echo json_encode(array(
	        'success' => false,
	        'reason' => $sql.' '.$sql2
	    ));
	}

} catch(Exception $ex){
    echo json_encode(array(
        'success' => false,
        'reason'  => $ex->getMessage(),
    ));
}
?>
