<?php
function getContact($langue) {
 
	$contactArray = array();
	
	ob_start();
	include(__DIR__.'/../admin/config.php');

	$sql="SELECT * FROM contact WHERE langue='".$langue."' ORDER BY position";
	$resultContact=mysqli_query($dbC, $sql);

	while($valueContact = mysqli_fetch_assoc($resultContact)) {	 
		$contactArray[] = $valueContact;
	}

	ob_end_flush();    
	return $contactArray;
}
?>