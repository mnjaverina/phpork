<?php
	
	
	include "../inc/functions.php"; 
	
	$db = new phpork_functions (); 

	//add
	if(isset($_GET['addBreed'])){
		$bname = $_GET['breed_name'];
		echo json_encode($db->addBreed($bname)); 
		echo json_encode($db->userTransactionEdit($user, curdate(), curtime(), $add_id, 'breed', '-', $bname, '1')); 
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
	$prev_val = $_POST['prev_val'];
	$new_val = $_POST['new_val'];
	$user_id = $_POST['user_id'];
	$username = $_POST['user_name'];
	$password = $_POST['password'];
	$user_type = $_POST['user_type'];
	$date = curdate();
	$time = curtime();
	echo json_encode($db->userTransactionEdit($user, $date, $time, $user_id, 'user', $prev_val, $new_val, '2'));
	echo json_encode($db->updateUser($username,$password,$usertype, $user_id));
	//localhost/phpork/gateway/admin.php?addBreed=1&breed_name=Breed1
	}

	if(isset($_POST['editBreed'])){
	$user = $_POST['user'];
	$prev_bname = $_POST['prev_bname'];
	$bname = $_POST['breed_name'];
	$edit_id = $_POST['breed_id'];
	$date = curdate();
	$time = curtime();
	echo json_encode($db->userTransactionEdit($user, $date, $time, $edit_id, 'breed', $prev_bname, $bname, '2'));
	echo json_encode($db->addBreed($breed_name));
	//localhost/phpork/gateway/admin.php?addBreed=1&breed_name=Breed1
	}
	if(isset($POST['editParent'])){
		$user = $_POST['user'];
		$prev_lbl = $_POST['prev_parent'];
		$lbl = $POST['parent'];
		$prev_lbl_id = $_POST['prev_id'];
		$lbl_id = $POST['id'];
		$parent_id = $_POST['parent_id'];
		$date = curdate();
		$time = curtime();
		echo json_encode($db->userTransactionEdit($user, $date, $time, $parent_id, 'parent', $prev_lbl, $lbl, '2'));
		echo json_encode($db->userTransactionEdit($user, $date, $time, $parent_id, 'parent', $prev_lbl_id, $lbl_id, '2')); 
		echo json_encode($db->updateParent($parent_id, $lbl, $lbl_id)); 
		//localhost/phpork/gateway/admin.php?addParent=1&parent=boar&id=E34.921
	} 
	if(isset($_POST['editHouseName'])){
		$user = $_POST['user'];
		$prev_hno = $_POST['prev_hno'];
		$hno = $_POST['hno'];
		$prev_hname = $_POST['prev_hname'];
		$hname = $_POST['hname'];
		$prev_fxn = $_POST['prev_fxn'];
		$fxn = $_POST['fxn'];
		$prev_loc_id = $_POST['prev_loc'];
		$loc_id = $_POST['loc'];
		$house_id = $_POST['house_id'];
		echo json_encode($db->userTransactionEdit($user, $date, $time, $house_id, 'house', $prev_hname, $hname, '2'));
		echo json_encode($db->userTransactionEdit($user, $date, $time, $house_id, 'house', $prev_hno, $hno, '2'));
		echo json_encode($db->userTransactionEdit($user, $date, $time, $house_id, 'house', $prev_fxn, $fxn, '2'));
		echo json_encode($db->userTransactionEdit($user, $date, $time, $house_id, 'house', $prev_loc_id, $loc_id, '2'));
		echo json_encode($db->updateHouse($houseid, $hno, $hname, $loc_id, $fxn));
		//localhost/phpork2/gateway/house.php?addHouseName=1&hno=1&hname=House1&fxn=weaning&loc_id=3
	} 
	if(isset($_POST['editLocationName'])){
		$user = $_POST['user'];
		$prev_lname = $_POST['prev_lname'];
		$lname = $_POST['lname'];
		$prev_addr = $_POST['prev_addr'];
		$addr = $_POST['addr'];
		$loc_id = $_POST['loc_id'];
		$date = curdate();
		$time = curtime();
		echo json_encode($db->userTransactionEdit($user, $date, $time, $loc_id, 'farm', $prev_lname, $lname, '2'));
		echo json_encode($db->userTransactionEdit($user, $date, $time, $loc_id, 'farm', $prev_addr, $addr, '2'));
		echo json_encode($db->updateLocation($loc_id, $lname, $addr));
		//localhost/phpork2/gateway/location.php?addLocationName=1&lname=Farm4&addr=antipolo
	} 
	if(isset($_POST['editPenName'])){
		$user = $_POST['user'];
		$prev_penno = $_POST['prev_penno'];
		$penno = $_POST['penno'];
		$prev_fxn = $_POST['prev_fxn'];
		$fxn = $_POST['fxn'];
		$prev_h_id = $_POST['prev_h_id'];	
		$h_id = $_POST['h_id'];
		$prev_loc_id = $_POST['prev_loc_id'];	
		$loc_id = $_POST['loc_id'];
		$pen_id = $_pOST['pen_id'];
		$date = curdate();
		$time = curtime();
		echo json_encode($db->userTransactionEdit($user, $date, $time, $pen_id, 'pen', $prev_penno, $penno, '2'));
		echo json_encode($db->userTransactionEdit($user, $date, $time, $pen_id, 'pen', $prev_fxn, $fxn, '2'));
		echo json_encode($db->userTransactionEdit($user, $date, $time, $pen_id, 'pen', $prev_h_id, $h_id, '2'));
		echo json_encode($db->userTransactionEdit($user, $date, $time, $pen_id, 'pen', $prev_loc_id, $loc_id, '2'));
		echo json_encode($db->updatePen($pen_id, $penno, $loc_id, $h_id, $fxn));
		//localhost/phpork2/gateway/pen.php?addPenName=1&penno=1&fxn=weaning&h_id=5
	} 
	if(isset($_POST['editFeedName'])){
		$user = $_POST['user'];
		$prev_fname = $_POST['prev_fname'];
		$fname = $_POST['fname'];
		$prev_ftype = $_POST['prev_ftype'];
		$ftype = $_POST['ftype'];
		$feed_id = $_POST['feed_id'];
		$date = curdate();
		$time = curtime();
		echo json_encode($db->userTransactionEdit($user, $date, $time, $feed_id, 'feeds', $prev_fname, $fname, '2'));
		echo json_encode($db->userTransactionEdit($user, $date, $time, $feed_id, 'feeds', $prev_ftype, $ftype, '2'));
		echo json_encode($db->updateFeed($feed_id, $fname, $ftype));
		//localhost/phpork2/gateway/feeds.php?addFeedName=1&fname=feed&ftype=feedtype
	} 
	if(isset($_POST['editMedName'])){
		$user = $_POST['user'];
		$prev_mname = $_POST['prev_mname'];
		$mname = $_POST['mname'];
		$prev_mtype = $_POST['prev_mtype'];
		$mtype = $_POST['mtype'];
		$med_id = $_POST['med_id'];
		$date = curdate();
		$time = curtime();
		echo json_encode($db->userTransactionEdit($user, $date, $time, $med_id, 'meds', $prev_mname, $mname, '2'));
		echo json_encode($db->userTransactionEdit($user, $date, $time, $med_id, 'meds', $prev_mtype, $mtype, '2'));
		echo json_encode($db->updateMedication($med_id, $mname, $mtype)); 
		//localhost/phpork2/gateway/meds.php?addMedName=1&mname=med&mtype=medtype
	}
	
	if(isset($_POST['type'])){
		$name = $_POST['name_startsWith'];
		echo json_encode($db->searchUser($name));
	}

	if(isset($_POST['farm'])){
		$name = $_POST['name_startsWith'];
		echo json_encode($db->searchLoc($name));
		
}
	
?>