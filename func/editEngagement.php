<?php
session_start();
header("Content-Type: text/json; charset=utf8");
include('checkLogin.php');

if( !isSet($_POST['idengagement']) ||
    !isSet($_POST['titre']) ||
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
    $langue = (isSet($_POST['langue']) && !empty($_POST['langue']))? $_POST['langue'] : "fr";
	  ob_start();
    include(__DIR__.'/../admin/config.php');

    $titreSafe = htmlspecialchars($_POST['titre'], ENT_QUOTES);
    $iconeSafe = htmlspecialchars($_POST['icone'], ENT_QUOTES);
    $blockSafe = htmlspecialchars($_POST['block'], ENT_QUOTES);
    $imageSafe = htmlspecialchars($_POST['image'], ENT_QUOTES);
    $langue = isSet($_POST['langue'])?$_POST['langue']:"fr";

    $sql = "UPDATE engagement SET titre = '".$titreSafe."', icone = '".$iconeSafe."',
    block = '".$blockSafe."', image = '".$imageSafe."' where
    langue = '".$langue."' and idengagement = '".$_POST['idengagement']."'";

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
