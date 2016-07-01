<?php
	
	
	include "../inc/functions.php"; 
	
	$db = new phpork_functions (); 
	if(isset($_GET['addBreed'])){
		$bname = $_GET['breed_name'];
		echo json_encode($db->addBreed($bname)); 
		//localhost/phpork/gateway/admin.php?addBreed=1&breed_name=Breed1
	} 
	if(isset($_GET['addParent'])){
		$lbl = $_GET['parent'];
		$lbl_id = $_GET['id'];
		echo json_encode($db->addParent($lbl,$lbl_id)); 
		//localhost/phpork/gateway/admin.php?addParent=1&parent=boar&id=E34.921
	} 
	if(isset($_POST['addHouseName'])){
		$hno = $_POST['hno'];
		$hname = $_POST['hname'];
		$fxn = $_POST['fxn'];
		$loc_id = $_POST['loc'];
		echo json_encode($db->addHouseName($hno,$hname,$fxn,$loc_id)); 
		//localhost/phpork2/gateway/house.php?addHouseName=1&hno=1&hname=House1&fxn=weaning&loc_id=3
	} 
	if(isset($_POST['addLocationName'])){
		$lname = $_POST['lname'];
		$addr = $_POST['addr'];
		echo json_encode($db->addLocationName($lname,$addr)); 
		//localhost/phpork2/gateway/location.php?addLocationName=1&lname=Farm4&addr=antipolo
	} 
	if(isset($_POST['addPenName'])){
		$penno = $_POST['penno'];
		$fxn = $_POST['fxn'];
		$h_id = $_POST['h_id'];
		echo json_encode($db->addPenName($penno,$fxn,$h_id)); 
		//localhost/phpork2/gateway/pen.php?addPenName=1&penno=1&fxn=weaning&h_id=5
	} 
	if(isset($_GET['addFeedName'])){
		$fname = $_GET['fname'];
		$ftype = $_GET['ftype'];
		echo json_encode($db->addFeedName($fname,$ftype)); 
		//localhost/phpork2/gateway/feeds.php?addFeedName=1&fname=feed&ftype=feedtype
	} 
	if(isset($_GET['addMedName'])){
		$mname = $_GET['mname'];
		$mtype = $_GET['mtype'];
		echo json_encode($db->addMedName($mname,$mtype)); 
		//localhost/phpork2/gateway/meds.php?addMedName=1&mname=med&mtype=medtype
	} 
	
?>