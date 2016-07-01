<?php
	
	
	include "../inc/functions.php"; 
	
	$db = new phpork_functions (); 
	
	if(isset($_POST['ddl_location'])){
		$arr_house = $db->ddl_location(); 
		echo json_encode($arr_house);
		//localhost/phpork2/gateway/location.php?ddl_location=1
						
	}
	
	if(isset($_GET['getLocDetails'])){
		$loc_id = $_GET['loc'];
		$arr_house = $db->getLocDetails($loc_id); 
		echo json_encode($arr_house);
		//localhost/phpork2/gateway/location.php?getLocDetails=1&loc=1
						
	}
	if(isset($_GET['getHousePenByLoc'])){
		$loc_id = $_GET['loc'];
		$arr_house = $db->getHousePenByLoc($loc_id); 
		echo json_encode($arr_house);
		//localhost/phpork2/gateway/location.php?getHousePenByLoc=1&loc=1
						
	}
?>