<?php
session_start();
header("Content-Type: text/json; charset=utf8");
include('checkLogin.php');
if(!isSet($_POST['label']) || !isSet($_SESSION['login']) || !isSet($_SESSION['password']) || !checkLogin($_SESSION['login'], $_SESSION['password'])) {
	echo json_encode(array(
		'success' => false,
		'reason' => 'acces interdit'
		));
	return;
}

try {
	ob_start();
    include(__DIR__.'/../admin/config.php');

    $valueSafe = htmlspecialchars($_POST['value'], ENT_QUOTES	);
    $labelSafe = htmlspecialchars($_POST['label'], ENT_QUOTES	);
		$imageSafe = htmlspecialchars($_POST['image'], ENT_QUOTES	);
		$simpleSafe = htmlspecialchars($_POST['simple'], ENT_QUOTES	);
    $langue = (isSet($_POST['langue']) && !empty($_POST['langue']))? $_POST['langue'] : "fr";

    if(!$valueSafe) {
		$sql="DELETE FROM pageelement WHERE label = '".$labelSafe."' and langue = '".$langue."'";

    } else {
		$sql="SELECT * FROM pageelement WHERE label = '".$labelSafe."' and  langue = '".$langue."'";
		$res = mysqli_query($dbC, $sql);
		$count=mysqli_num_rows($res);
		if ($count == 1) {
     		$sql="UPDATE pageelement SET value = '".$valueSafe."' WHERE
   				label = '".$labelSafe."' and  langue = '".$langue."'";
   		} else {
   			$sql="INSERT INTO pageelement(value,label,langue,image,simple) values ('".$valueSafe."','".$labelSafe."','".$langue."','".$imageSafe."','".$simpleSafe."')";
   		}
    }

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
