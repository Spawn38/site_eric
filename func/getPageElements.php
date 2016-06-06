<?php
function getPageElements($langue, $elementArray) {

	ob_start();
	include(__DIR__.'/../admin/config.php');

	$sql="SELECT label,simple,value FROM pageelement WHERE langue='".$langue."' and admin='0'" ;
	$resultElements=mysqli_query($dbC, $sql);

	while($valueElements = mysqli_fetch_assoc($resultElements)) {
		$key = $valueElements['label'];
		$elementArray[$key] = $valueElements;
	}

	ob_end_flush();
	return $elementArray;
}
?>
