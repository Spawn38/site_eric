<?php
session_start();
header("Content-Type: text/json; charset=utf8");
include('checkLogin.php');
if(!isSet($_POST['idjoueur']) || !isSet($_SESSION['login']) || !isSet($_SESSION['password']) || !checkLogin($_SESSION['login'], $_SESSION['password'])) {
  	echo json_encode(array(
        'success' => false,
        'reason'  => 'acces interdit',
    ));
}

try {
	ob_start();
    include(__DIR__.'/../admin/config.php');

    $sql="DELETE FROM joueurs where idjoueur = ".$_POST['idjoueur'];
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
