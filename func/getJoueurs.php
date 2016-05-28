<?php
function getJoueurs($langue) {
 
	$joueursArray = array();
	
	ob_start();
	include(__DIR__.'/../admin/config.php');

	$sql="SELECT * FROM joueurs WHERE langue='".$langue."'";
	$resultContact=mysqli_query($dbC, $sql);

	while($valueJoueur = mysqli_fetch_assoc($resultContact)) {	 
		$joueursArray[] = $valueJoueur;
	}

	ob_end_flush();    
	return $joueursArray;
}
?>