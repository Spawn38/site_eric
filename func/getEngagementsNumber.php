<?php
function getEngagementsNumber() {

	ob_start();
	include(__DIR__.'/../admin/config.php');
	$engagementNumber = 2;
	$langue = (isSet($_POST['langue']) && !empty($_POST['langue']))? $_POST['langue'] : "fr";

	$sql="SELECT * FROM pageelement WHERE admin='1' and label='engagement_number' and langue='".$langue."'";
	$engagementNumberQuery=mysqli_query($dbC, $sql);
	$valueElements = mysqli_fetch_assoc($engagementNumberQuery);
  if(isSet($valueElements['value'])) {
    $engagementNumber = $valueElements['value'];
  }
	ob_end_flush();
	return $engagementNumber;
}
?>
