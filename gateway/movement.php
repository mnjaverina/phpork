<?php
	include "../inc/functions.php"; 
	
	$db = new phpork_functions (); 
	if(isset($_POST['getWeekDateMvmnt'])){
		$pid = $_POST['pig'];
		$mvmnt = $db->getWeekDateMvmnt($pid); 
		echo json_encode($mvmnt);
		//localhost/phpork2/gateway/movement.php?getWeekDateMvmnt=1&pig=1
						
	}
	if(isset($_POST['getMvmntDetails'])){
		$pid = $_POST['pig'];
		$from = $_POST['from'];
		$to = $_POST['to'];
		$mvmnt = $db->getMvmntDetails($pid,$from,$to); 
		echo json_encode($mvmnt);
		//localhost/phpork2/gateway/movement.php?getWeekDateMvmnt=1&pig=1
						
	}

?>