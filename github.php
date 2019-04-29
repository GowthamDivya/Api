<?php
require('includes/config.php');
//collect values from the url
$memberID = trim($_GET['id']);
$active = trim($_GET['status']);
//if id is number and the active token is not empty carry on
if(is_numeric($memberID) && !empty($active)){
	//update users record set the active column to Yes where the memberID and active value match the ones provided in the array
	$stmt = $db->prepare("UPDATE doctors SET status = '1' WHERE id= :id AND status = :status");
	$stmt->execute(array(
		':id' => $id,
		':status' => $status
	));
	//if the row was updated redirect the user
	if($stmt->rowCount() == 1){
		//redirect to login page
		echo "Your account is activated.";
		exit;
	} else {
		echo "Your account could not be activated."; 
	}
	
}
?>