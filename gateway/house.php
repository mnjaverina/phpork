<?php
	
	
	include "../inc/functions.php"; 
	
	$db = new phpork_functions (); 
	if(isset($_GET['addHouseName'])){
		$hno = $_GET['hno'];
		$hname = $_GET['hname'];
		$fxn = $_GET['fxn'];
		$loc_id = $_GET['loc'];
		echo json_encode($db->addHouseName($hno,$hname,$fxn,$loc_id)); 
		//localhost/phpork2/gateway/house.php?addHouseName=1&hno=1&hname=House1&fxn=weaning&loc_id=3
	} 
	if(isset($_GET['ddl_house'])){
		$arr_house = $db->ddl_house(); 
		echo json_encode($arr_house);
		//localhost/phpork2/gateway/house.php?ddl_house=1
						
	}
	if(isset($_GET['getHouseByLoc'])){
		$loc_id = $_GET['loc'];
		$arr_house = $db->getHouseByLoc($loc_id); 
		echo json_encode($arr_house);
		//localhost/phpork2/gateway/house.php?getHouseByLoc=1&loc=1
						
	}
	if(isset($_GET['getHouseDetails'])){
		$h_id = $_GET['house'];
		$arr_house = $db->getHouseDetails($h_id); 
		echo json_encode($arr_house);
		//localhost/phpork2/gateway/house.php?getHouseDetails=1&house=1
						
	}
?>