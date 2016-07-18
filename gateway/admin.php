<?php
	
	
	include "../inc/functions.php"; 
	
	$db = new phpork_functions (); 
	if(isset($_GET['addBreed'])){
		$bname = $_GET['breed_name'];
		echo json_encode($db->addBreed($bname)); 
		echo json_encode($db->userTransactionEdit($user, curdate(), curtime(), $edit_id, 'breed', '-', $bname, '1')); 
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

	//edit
	if(isset($_POST['editUser'])){
	$user = $_POST['user'];
	$prev_uname = $_POST['prev_uname']
	$username = $_POST['user_name'];
	$prev_pword = $_POST['prev_pword']
	$password = $_POST['password'];
	$prev_utype = $_POST['prev_utype']
	$user_type = $_POST['user_type'];
	$user_id = $_POST['user_id'];
	$date = curdate();
	$time = curtime();
	echo json_encode($db->userTransactionEdit($user, $date, $time, $user_id, 'user', $prev_uname, $username, '2'));
	echo json_encode($db->userTransactionEdit($user, $date, $time, $user_id, 'user', $prev_utype, $user_type, '2'));
	echo json_encode($db->userTransactionEdit($user, $date, $time, $user_id, 'user', $prev_pword, $password, '2'));
	echo json_encode($db->updateUser($username,$password,$usertype, $user_id));
	//localhost/phpork/gateway/admin.php?addBreed=1&breed_name=Breed1
	}

	if(isset($_POST['editBreed'])){
	$user = $_POST['user'];
	$prev_bname = $_POST['prev_bname']
	$bname = $_POST['breed_name'];
	$edit_id = $_POST['breed_id'];
	$date = curdate();
	$time = curtime();
	echo json_encode($db->userTransactionEdit($user, $date, $time, $edit_id, 'breed', $prev_bname, $bname, '2')); 
	//localhost/phpork/gateway/admin.php?addBreed=1&breed_name=Breed1
	}
	if(isset($POST['editParent'])){
		$user = $_POST['user'];
		$prev_lbl = $_POST['prev_parent'];
		$lbl = $POST['parent'];
		$lbl_id = $POST['id'];
		$date = curdate();
		$time = curtime();
		echo json_encode($db->userTransactionEdit($user, $date, $time, $$lbl_id, 'parent', $lbl, '2')); 
		//localhost/phpork/gateway/admin.php?addParent=1&parent=boar&id=E34.921
	} 
	if(isset($_POST['editHouseName'])){
		$hno = $_POST['hno'];
		$hname = $_POST['hname'];
		$fxn = $_POST['fxn'];
		$loc_id = $_POST['loc'];
		echo json_encode($db->userTransactionEdit($hno,$hname,$fxn,$loc_id)); 
		//localhost/phpork2/gateway/house.php?addHouseName=1&hno=1&hname=House1&fxn=weaning&loc_id=3
	} 
	if(isset($_POST['editLocationName'])){
		$lname = $_POST['lname'];
		$addr = $_POST['addr'];
		echo json_encode($db->userTransactionEdit($lname,$addr)); 
		//localhost/phpork2/gateway/location.php?addLocationName=1&lname=Farm4&addr=antipolo
	} 
	if(isset($_POST['editPenName'])){
		$penno = $_POST['penno'];
		$fxn = $_POST['fxn'];
		$h_id = $_POST['h_id'];
		echo json_encode($db->userTransactionEdit($penno,$fxn,$h_id)); 
		//localhost/phpork2/gateway/pen.php?addPenName=1&penno=1&fxn=weaning&h_id=5
	} 
	if(isset($_GET['editFeedName'])){
		$fname = $_GET['fname'];
		$ftype = $_GET['ftype'];
		echo json_encode($db->userTransactionEdit($fname,$ftype)); 
		//localhost/phpork2/gateway/feeds.php?addFeedName=1&fname=feed&ftype=feedtype
	} 
	if(isset($_GET['editMedName'])){
		$mname = $_GET['mname'];
		$mtype = $_GET['mtype'];
		echo json_encode($db->userTransactionEdit($mname,$mtype)); 
		//localhost/phpork2/gateway/meds.php?addMedName=1&mname=med&mtype=medtype
	}
	
	
?>