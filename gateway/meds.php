<?php
	include "../inc/functions.php"; 
	
	$db = new phpork_functions (); 

	if(isset($_POST['subMed'])){
		$medid = $_POST['selectMeds']; 
		$medDate = $_POST['medDate']; 
		$medTime = $_POST['medTime']; 
		$qty = $_POST['medQty'];
		$unit = $_POST['selUnit'];
		$user = $_POST['user'];
		$sparray = array();
		$size = 0;
		if (isset($_POST['pensel'])) {
			foreach ($_POST['pensel'] as $key) {
				$sparray = $db->ddl_perpen($key);
				$size = $size+ sizeof($sparray);
			}
			$fqty = $qty/$size;
			
			$medqty = number_format($fqty, 4, '.', ',');
			foreach ($_POST['pensel'] as $key) {
				$sparray = $db->ddl_perpen($key);
				foreach ($sparray as $a ) {
					
					$db->addMeds($medid,$medDate,$medTime,$a,$medqty,$unit,$user); 
				
				}
				
				
			}

		}
		if (isset($_POST['pigpen'])) {
			$pigsize = sizeof($_POST['pigpen']);
			$fqty = $qty/$pigsize;
			foreach($_POST['pigpen'] as $pid){
				$db->addMeds($medid,$medDate,$medTime,$pid,$fqty,$unit,$user);  					
			} 
		}
	} 
	if(isset($_POST['addMedName'])){
		$mname = $_POST['mname'];
		$mtype = $_POST['mtype'];
		$user = $_POST['user'];
		echo json_encode($db->addMedName($mname,$mtype,$user)); 
		//localhost/phpork2/gateway/meds.php?addMedName=1&mname=med&mtype=medtype
	} 
	if(isset($_POST['med']) && isset($_POST['getMedType'])){
		$med = $_POST['med']; 
		$mtype[] =  $db->getMedType($med); 
		echo json_encode($mtype); 
	} 
	if(isset($_POST['getMedsDetails'])){
		$med = $_POST['med']; 
		echo json_encode($db->getMedsDetails($med)); 
		//localhost/phpork2/gateway/meds.php?getMedsDetails=1&med=1
	} 
	if(isset($_POST['getMedsReport'])){
		$pig = $_POST['pig']; 
		$from = $_POST['from'];
		$to = $_POST['to'];
		echo json_encode($db->getMedsReport($pig,$from,$to)); 
		//localhost/phpork2/gateway/meds.php?getMedsDetails=1&med=1
	} 
	if(isset($_GET['getMedsTransDetails'])){
		$med = $_GET['med']; 
		echo json_encode($db->getMedsTransDetails($med)); 
		//localhost/phpork2/gateway/meds.php?getMedsTransDetails=1&med=1
	} 
	if(isset($_POST['ddl_meds'])){
		$arr_med = $db->ddl_meds(); 
		echo json_encode($arr_med);
		//localhost/phpork/gateway/meds.php?ddl_meds=1
						
	}
	if(isset($_POST['ddl_medRecordEdit'])){
		$pid = $_POST['pig']; 
		echo json_encode($db->ddl_medRecordEdit($pid)); 
		//localhost/phpork2/gateway/meds.php?ddl_medRecordEdit=1&pig=1
	} 
	if(isset($_POST['ddl_medRecord'])){
		$pid = $_POST['pig']; 
		echo json_encode($db->ddl_medRecord($pid)); 
		//localhost/phpork2/gateway/meds.php?ddl_medRecord=1&pig=1
	} 
	if(isset($_POST['getLastMed'])){
		$pid = $_POST['pig']; 
		echo json_encode($db->getLastMed($pid)); 
		//localhost/phpork2/gateway/meds.php?ddl_medRecord=1&pig=1
	} 
	if(isset($_POST['updateMeds'])){
		$mrid = $_POST['mrid']; 
		$medid = $_POST['med_id']; 
		$user = $_POST['user']; 
		echo json_encode($db->updateMeds($medid,$mrid,$user)); 
		//localhost/phpork2/gateway/meds.php?ddl_medRecord=1&pig=1
	} 
?>