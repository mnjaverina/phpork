<?php
	include "../inc/functions.php"; 
	
	$db = new phpork_functions (); 
	if(isset($_GET['getWeekDateMvmnt'])){
		$pid = $_GET['pig'];
		$mvmnt = $db->getWeekDateMvmnt($pid); 
		echo json_encode($mvmnt);
		//localhost/phpork2/gateway/movement.php?getWeekDateMvmnt=1&pig=1
						
	}

?>