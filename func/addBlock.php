<?php
session_start();
header("Content-Type: text/json; charset=utf8");
include('checkLogin.php');

if( !isSet($_POST['typeBlock']) ||
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

    $typeBlockSafe = htmlspecialchars($_POST['typeBlock'], ENT_QUOTES);
    $fondBlockFormSafe = htmlspecialchars($_POST['fondBlockForm'], ENT_QUOTES);
    $textBlockFormSafe = htmlspecialchars($_POST['textBlockForm'], ENT_QUOTES);
    $titreBlockFormSafe = htmlspecialchars($_POST['titreBlockForm'], ENT_QUOTES);
    $valueBlockFormSafe = htmlspecialchars($_POST['valueBlockForm'], ENT_QUOTES);
    $langue = (isSet($_POST['langue']) && !empty($_POST['langue']))? $_POST['langue'] : "fr";

    $res = mysqli_query($dbC, "SELECT max(ordre) as ordre FROM block");
    $val = mysqli_fetch_assoc($res);

    $ordre = intval($val['ordre'])+1;

    if($typeBlockSafe) {
      $sql = "INSERT INTO block (texte, image, ordre, type, langue) VALUES
      ('".$textBlockFormSafe."', '".$fondBlockFormSafe."', '".$ordre."',
      '".$typeBlockSafe."', '".$langue."')";
    } else {
      $sql = "INSERT INTO block (titre, texte, ordre, type, langue) VALUES
      ('".$titreBlockFormSafe."', '".$valueBlockFormSafe."', '".$ordre."',
      '".$typeBlockSafe."', '".$langue."')";
    }

	  $res = mysqli_query($dbC, $sql);
    $idBlock = mysqli_insert_id($dbC);
    ob_end_flush();

    if($res) {
	  echo json_encode(array(
        'success' => true,
        'id' => $idBlock
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
