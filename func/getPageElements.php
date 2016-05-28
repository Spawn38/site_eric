<?php
function getPageElements($langue, $elementArray) {
 
	ob_start();
	include(__DIR__.'/../admin/config.php');

	$sql="SELECT * FROM pageelement WHERE langue='".$langue."'";
	$resultElements=mysqli_query($dbC, $sql);

	while($valueElements = mysqli_fetch_assoc($resultElements)) {	 
		$key = $valueElements['label'];
		$elementArray[$key] = $valueElements['value'];
	}

	ob_end_flush();    
	return $elementArray;
}
?>