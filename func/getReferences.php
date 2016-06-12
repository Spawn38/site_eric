<?php
function getReferences($langue) {

	ob_start();
	include(__DIR__.'/../admin/config.php');
	$blockArray = array();

	$sql="SELECT * FROM reference WHERE langue='".$langue."'";
  	$resultBlocks=mysqli_query($dbC, $sql);

	while($valueElements = mysqli_fetch_assoc($resultBlocks)) {
		$blockArray[] = $valueElements;
	}

	ob_end_flush();
	return $blockArray;
}
?>
