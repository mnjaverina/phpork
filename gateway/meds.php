<?php
	include "../inc/functions.php"; 
	
	$db = new phpork_functions (); 

	if(isset($_POST['subMed'])){
		$medid = $_POST['selectMeds']; 
		$medDate = $_POST['medDate']; 
		$medTime = $_POST['medTime']; 
		$qty = $_POST['medQty'];
		$unit = $_POST['selUnit'];
		$sparray = array();
		if (isset($_POST['pensel'])) {
			foreach ($_POST['pensel'] as $key) {
				$sparray = $db->ddl_perpen($key);
				
			}
			$fqty = $qty/sizeof($sparray);
			
			$medqty = number_format($fqty, 2, '.', ',');
			foreach ($_POST['pensel'] as $key) {
				$sparray = $db->ddl_perpen($key);
				foreach ($sparray as $a ) {
					
					$db->addMeds($medid,$medDate,$medTime,$a,$medqty,$unit); 
				
				}
				
				
			}

		}
		if (isset($_POST['pigpen'])) {
			$pigsize = sizeof($_POST['pigpen']);
			$fqty = $qty/$pigsize;
			foreach($_POST['pigpen'] as $pid){
				$db->addMeds($medid,$medDate,$medTime,$pid,$fqty,$unit);  					
			} 
		}
	} 
	
	if(isset($_POST['med']) && isset($_POST['getMedType'])){
		$med = $_POST['med']; 
		$mtype[] =  $db->getMedType($med); 
		echo json_encode($mtype); 
	} 
	if(isset($_GET['getMedsDetails'])){
		$med = $_GET['med']; 
		echo json_encode($db->getMedsDetails($med)); 
		//localhost/phpork2/gateway/meds.php?getMedsDetails=1&med=1
	} 
	if(isset($_GET['getMedsTransDetails'])){
		$med = $_GET['med']; 
		echo json_encode($db->getMedsTransDetails($med)); 
		//localhost/phpork2/gateway/meds.php?getMedsTransDetails=1&med=1
	} 
	if(isset($_GET['ddl_medRecordEdit'])){
		$pid = $_GET['pig']; 
		echo json_encode($db->ddl_medRecordEdit($pid)); 
		//localhost/phpork2/gateway/meds.php?ddl_medRecordEdit=1&pig=1
	} 
	if(isset($_GET['ddl_medRecord'])){
		$pid = $_GET['pig']; 
		echo json_encode($db->ddl_medRecord($pid)); 
		//localhost/phpork2/gateway/meds.php?ddl_medRecord=1&pig=1
	} 

?>