<?php
function getBlocks($langue) {

	ob_start();
	include(__DIR__.'/../admin/config.php');
	$blockArray = array();

	$sql="SELECT * FROM block WHERE langue='".$langue."' order by ordre";
  	$resultBlocks=mysqli_query($dbC, $sql);

	while($valueElements = mysqli_fetch_assoc($resultBlocks)) {
		$blockArray[] = $valueElements;
	}

	ob_end_flush();
	return $blockArray;
}
?>
