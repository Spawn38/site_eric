<?php
session_start();
header("Content-Type: text/json; charset=utf8");
include('checkLogin.php');
if(!isSet($_POST['idcontact']) || !isSet($_SESSION['login']) || !isSet($_SESSION['password']) || !checkLogin($_SESSION['login'], $_SESSION['password'])) {
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

   	$sql="UPDATE contact SET value = '".$valueSafe."', label = '".$labelSafe."' WHERE idcontact = ".$_POST['idcontact'];
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
