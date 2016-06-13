<?php
	require_once "connect.php"; 
	require_once "inc/dbinfo.inc"; 
	include "inc/functions.php"; 
	include "inc/pigdet.php"; 
	$db = new phpork_functions (); 
	$pig = new pigdet_functions (); 

	if(isset($_POST['addPig'])){
		$pid = $_POST['new_pid']; 
		$pbdate = $_POST['pbdate']; 
		$pweekfar = $_POST['pweekfar']; 
		$pfarm = $_POST['ploc']; 
		$pstatus = $_POST['selStat']; 
		$phouse = $_POST['selHouse']; 
		$ppen = $_POST['selPen']; 
		$prfid = $_POST['prfid']; 
		$pgender = $_POST['pgender']; 
		$pbreed = $_POST['pbreed']; 
		$pboar = $_POST['pboar']; 
		$psow = $_POST['psow']; 
		$pfoster = $_POST['pfoster'];
		$pweight = $_POST['pweight']; 
		$user = $_SESSION['user_id']; 
		$fid = $_POST['selectFeeds']; 
		$fdate = $_POST['fdate']; 
		$ftime = $_POST['ftime']; 
		$medid = $_POST['selectMeds']; 
		$medDate = $_POST['medDate'];
		$medTime = $_POST['medTime']; 
		$proddate = $_POST['fprodDate']; 
		$remarks = $_POST['pweighttype']; 
		$fqty = $_POST['fqty'];
		$mqty = $_POST['mqty'];
		$unit = $_POST['selUnit'];
		echo json_encode($db->addPig($pid,$pbdate,$pweekfar,$pfarm,$phouse,$ppen,$prfid,$pgender,$pbreed,$pboar,$psow,$pfoster,$pweight,$pstatus,$user));
		$db->addPigWeight($pid,$pweight,$remarks); 
		$db->addFeeds($fid,$fdate,$ftime,$pid,$proddate,$fqty); 
		$db->addMeds($medid,$medDate,$medTime,$pid,$mqty,$unit);
		$db->updatepigRFID($pid,$prfid); 

	}
	if(isset($_POST['editPig'])){

		$newweight = $_POST['ed_weight']; 
		$newuser = $_SESSION['user_id']; 
		$newrfid = $_POST['ed_rfid']; 
		$newstat = $_POST['ed_status']; 
		$prevweight = $pig->getWeight($_GET['pig']); 
		$prevuser = $pig->getUserEdited($_GET['pig']); 
		$prevstat = $pig->getStatus($_GET['pig']); 
		$prevrfid = $pig->getRFID($_GET['pig']); 
		$plabel = $pig->getLabel($_GET['pig']); 
		$remarks = $_POST['ed_weighttype']; 
		$prevremarks = $pig->getPrevRemarks($_GET['pig']); 
		if(isset($_POST['ed_weight'])){
			if ($_POST['ed_weight']!= "") {

				$db->updatePigWeight($_GET['pig'],$newweight,$prevweight[1],$prevremarks[2]);  
				
			}elseif ( $_POST['ed_weighttype']!= "") {
				$db->updatePigWeight($_GET['pig'],$prevweight[0],$prevweight[1],$remarks);  
				
				
			}else{
				$db->updatePigWeight($_GET['pig'],$prevweight[0],$prevweight[1],$prevremarks[2]);  
				
				
			} 
			$w = $prevweight[0];
		} 
		$db->updatePigDetails($_GET['pig'],$newuser,$newstat); 
		$db->updateRFIDdetails($_GET['pig'],$newrfid,$prevrfid[1],$plabel); 
		$db->insertEditHistory($w,$prevuser,$_GET['pig'],$prevstat,$prevrfid[0]); 
	
	}

	if (isset($_GET['npig']) && isset($_GET['insertnewpid'])) {
		$npid = $_GET['npig']; 
		$rfid[] = $pig->getinsertRFID($npid); 
		echo json_encode($rfid); 
	} 
	if(isset($_POST['loc']) && isset($_POST['insertpigphp'])){
		$loc = $_POST['loc']; 
		$arr_house = $db->ddl_house($loc); 
		
		echo json_encode($arr_house); 
	} 
	if(isset($_POST['house']) && isset($_POST['insertpigphp'])){
		$house = $_POST['house']; 
		$arr_pen = $db->ddl_pen($house); 
		echo json_encode($arr_pen); 
	} 
	if(isset($_POST['week']) && isset($_POST['insertpigphp'])){
		$date = $_POST['week']; 
		$week = ceil( date( 'j', strtotime( $date ) ) / 7 ); 
		$year = date('Y',strtotime($date)); 
		$month = date('F',strtotime($date)); 
		$ddate = $month.' '.$year; 
		$arweek['week'] = $week; 
		$arweek['date'] =$ddate; 
		$arr_week[] = $arweek; 
		echo json_encode($arr_week); 
	} 

	if(isset($_GET['getPigDetails'])){
		$id = $_GET['pig_id'];
		echo json_encode($db->getPigDetails($id));
	}
	if (isset($_GET['getPigWeight'])) {
		$id = $_GET['pig_id'];
		echo json_encode($db->getPigWeight($id));	
	}
	if (isset($_GET['getPigFeeds'])) {
		$id = $_GET['pig_id'];
		echo json_encode($db->getPigFeeds($id));		
	}

?>