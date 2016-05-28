<?php
function getEngagements($langue) {
 
	ob_start();
	include(__DIR__.'/../admin/config.php');
	$engagementArray = array();

	$sql="SELECT * FROM engagement WHERE langue='".$langue."'";
	$resultEngagements=mysqli_query($dbC, $sql);

	while($valueElements = mysqli_fetch_assoc($resultEngagements)) {	 		
		$engagementArray[] = $valueElements;
	}

	ob_end_flush();    
	return $engagementArray;
}
?>