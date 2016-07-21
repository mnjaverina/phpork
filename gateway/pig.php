<?php

	//require_once "inc/dbinfo.inc"; 
	include "../inc/functions.php"; 
	//include "inc/pigdet.php"; 
	$db = new phpork_functions (); 
	//$pig = new pigdet_functions (); 
	if(isset($_POST['addPigFlag'])){
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
		$user = $_POST['user_id']; 
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
		echo json_encode($db->addPig($pid,$pbdate,$pweekfar,$ppen,$pgender,$pbreed,$pboar,$psow,$pfoster,$pstatus,$user)); 
		$db->addPigWeight($pid,$pweight,$remarks); 
		$db->addFeeds($fid,$fdate,$ftime,$pid,$proddate,$fqty); 
		$db->addMeds($medid,$medDate,$medTime,$pid,$mqty,$unit);
		$db->updatepigRFID($pid,$prfid); 
		echo "<script>alert('Added successfully!');</script>"; 
		//localhost/phpork2/gateway/pig.php?addPigFlag=1&new_pid=104&pbdate=2016-04-12&pweekfar=8&ploc=2&selStat=Weaning&selHouse=2&selPen=8&prfid=104&pgender='M'&pbreed=1&pboar=64&psow=E4LY.6547&pfoster=''&pweight=12.12&user_id=1&selectFeeds=2&fdate=2016-04-12&ftime=08:00:00&selectMeds=3&medDate=2016-04-04&medTime=08:00:00&fprodDate=2016-04-04&pweighttype=weaning&fqty=12.12&mqty=31.08&selUnit=kg
		
	} 
	if(isset($_GET['addPigWeight'])){
		$lname = $_GET['lname'];
		$addr = $_GET['addr'];
		echo json_encode($db->addLocationName($lname,$addr)); 
		//localhost/phpork2/gateway/location.php?addLocationName=1&lname=Farm4&addr=antipolo
	} 
	if(isset($_POST['getPigDetails'])){
		$pid = $_POST['pig_id'];
		echo json_encode($db->getPigDetails($pid));
		//http://localhost/phpork2/gateway/pig.php?getPigDetails=1&pig_id=1
	}
	if(isset($_POST['getPigWeightDetails'])){
		$pid = $_POST['pig_id'];
		echo json_encode($db->getPigWeightDetails($pid));
		//http://localhost/phpork2/gateway/pig.php?getPigWeightDetails=1&pig_id=1
	}
	if(isset($_GET['getLastFeed'])){
		$pid = $_GET['pig_id'];
		echo json_encode($db->getLastFeed($pid));
		//http://localhost/phpork2/gateway/pig.php?getLastFeed=1&pig_id=1
	}
	if(isset($_GET['getLastMed'])){
		$pid = $_GET['pig_id'];
		echo json_encode($db->getLastMed($pid));
		//http://localhost/phpork2/gateway/pig.php?getLastMed=1&pig_id=1
	}
	if(isset($_GET['getPigFeedsDetails'])){
		$pid = $_GET['pig_id'];
		echo json_encode($db->getPigFeedsDetails($pid));
		//http://localhost/phpork2/gateway/pig.php?getPigFeedsDetails=1&pig_id=1
	}
	if(isset($_GET['getPigMedsDetails'])){
		$pid = $_GET['pig_id'];
		echo json_encode($db->getPigMedsDetails($pid));
		//http://localhost/phpork2/gateway/pig.php?getPigMedsDetails=1&pig_id=1
	}
	
	if(isset($_POST['getPigsByPen'])){
		$pid = $_POST['pen'];
		echo json_encode($db->getPigsByPen($pid));
		//http://localhost/phpork2/gateway/pig.php?getPigsByPen=1&pen=5
	}
	if(isset($_GET['getPigLabel'])){
		$pid = $_GET['pig'];
		echo json_encode($db->getPigLabel($pid));
		//http://localhost/phpork2/gateway/pig.php?getPigLabel=1&pig=1
	}
	if(isset($_POST['getinsertRFID'])){
		$pid = $_POST['pig'];
		echo json_encode($db->getinsertRFID($pid));
		//http://localhost/phpork2/gateway/pig.php?getinsertRFID=1&pig=1
	}
	if(isset($_GET['getUserEdited'])){
		$pid = $_GET['pig'];
		echo json_encode($db->getUserEdited($pid));
		//http://localhost/phpork2/gateway/pig.php?getUserEdited=1&pig=1
	}
	if(isset($_POST['getCurrentHouse'])){
		$pid = $_POST['pig'];
		echo json_encode($db->getCurrentHouse($pid));
		//http://localhost/phpork2/gateway/pig.php?getCurrentHouse=1&pig=1
	}
	
	if(isset($_POST['updatePig'])){
		$pid = $_POST['pig'];
		$user = $_POST['user'];
		$stat = $_POST['stat'];
		echo json_encode($db->updatePigDetails($pid, $user, $stat));
		//http://localhost/phpork2/gateway/pig.php?getUserEdited=1&pig=1
	}
	if(isset($_POST['updateRFID'])){
		$pid = $_POST['pig'];
		$rfid = $_POST['rfid'];
		$prevrfid = $_POST['prevRFID'];
		$label = $_POST['label'];
		echo json_encode($db->updateRFIDdetails($pid, $rfid, $prevrfid, $label));
		
	}
	if(isset($_POST['updatePigWeight'])){
		$pig_id = $_POST['pig'];
		$weight = $_POST['weight'];
		$record_id = $_POST['record_id'];
		$remarks = $_POST['remarks'];
		echo json_encode($db->updatePigWeight($pig_id, $weight, $record_id, $remarks));
		
	}

	if(isset($_POST['editHistory'])){
		$user = $_POST['user'];
		$pigid = $_POST['pig'];
		$prevWeekFar = $_POST['prevWeekFar'];
		$week_far = $_POST['week_far'];
		$prevStatus = $_POST['prevStatus'];
		$status = $_POST['stat'];
		$prevrfid = $_POST['prevRFID'];
		$rfid = $_POST['rfid'];
		$prevWeight = $_POST['prevWeight'];
		$weight = $_POST['weight'];
		$prevweighttype = $_POST['prevWeightType'];
		$weighttype = $_POST['weightType'];
		echo json_encode($db->insertEditHistory($user, $pigid,$prevWeekFar,$week_far, $prevStatus, $status, $prevrfid, $rfid,  $prevWeight, $weight, $prevweighttype, $weighttype));
		echo json_encode($db->updateWeekFar($pigid,$week_far));
	}

	if(isset($_POST['addParent'])){
		$lbl = $_POST['label'];
		$lbl_id = $_POST['label_id'];
		echo json_encode($db->addParent($lbl,$lbl_id)); 
		//localhost/phpork2/gateway/pig.php?addParent=1&lbl=sow&lbl_id=2345
	} 
	if(isset($_POST['addBreed'])){
		$br_name = $_POST['breed_name'];
		echo json_encode($db->addBreed($br_name)); 
		//localhost/phpork2/gateway/pig.php?addBreed=1&breed_name=Galore-White
	} 
	if(isset($_POST['ddl_sow'])){
		echo json_encode($db->ddl_sow());
		//http://localhost/phpork2/gateway/pig.php?ddl_sow=1
	}
	if(isset($_POST['ddl_boar'])){
		echo json_encode($db->ddl_boar());
		//http://localhost/phpork2/gateway/pig.php?ddl_boar=1
	}
	if(isset($_POST['ddl_foster'])){
		echo json_encode($db->ddl_foster());
		//http://localhost/phpork2/gateway/pig.php?ddl_foster=1
	}
	if(isset($_POST['ddl_parent'])){
		echo json_encode($db->ddl_parent());
		//http://localhost/phpork2/gateway/pig.php?ddl_foster=1
	}
	if(isset($_POST['getParentDetails'])){
		$parent = $_POST['parent'];
		echo json_encode($db->getParentDetails($parent));
		//http://localhost/phpork2/gateway/pig.php?ddl_foster=1
	}
	if(isset($_GET['ddl_pig'])){
		
		echo json_encode($db->ddl_pig());
		//http://localhost/phpork2/gateway/pig.php?ddl_pig=1
	}
	if(isset($_POST['ddl_breeds'])){
		echo json_encode($db->ddl_breeds());
		//http://localhost/phpork2/gateway/pig.php?ddl_breeds=1
	}
	if(isset($_POST['getBreed'])){
		$id = $_POST['breed_id'];
		echo json_encode($db->getBreed($id));
		//http://localhost/phpork2/gateway/pig.php?ddl_breeds=1
	}
	if(isset($_POST['ddl_batch'])){
		
		echo json_encode($db->ddl_batch());
		//http://localhost/phpork2/gateway/pig.php?ddl_breeds=1
	}
	if(isset($_GET['ddl_pigpen'])){
		$pig = $_GET['pig'];
		$pen = $_GET['pen'];
		$house = $_GET['house'];
		$loc = $_GET['location'];
		echo json_encode($db->ddl_pigpen($pig,$pen,$house,$loc));
		//http://localhost/phpork2/gateway/pig.php?ddl_pigpen=1&location=2&house=2&pen=6&pig=40
	}
	if(isset($_GET['ddl_pigpenall'])){
		$pig = $_GET['pig'];
		$pen = $_GET['pen'];
		$house = $_GET['house'];
		$loc = $_GET['location'];
		echo json_encode($db->ddl_pigpenall($pig,$pen,$house,$loc));
		//http://localhost/phpork2/gateway/pig.php?ddl_pigpenall=1&location=2&house=2&pen=6&pig=40
	}
	if(isset($_POST['insertWeight'])){
		$weight = $_POST['weight']; 
		$weightType = $_POST['weightType']; 
		$dateWeighed = $_POST['dateWeighed']; 
		$timeWeighed = $_POST['timeWeighed'];
		$user = $_POST['user'];
		$sparray = array();
		$size = 0;

		if (isset($_POST['batchsel'])) {
			foreach ($_POST['batchsel'] as $key) {
				$sparray = $db->ddl_perbatch($key);
				$size = $size+ sizeof($sparray);
			}
			$fqty = $weight/$size;
			
			$minWeight = number_format($fqty, 2, '.', ',');
			foreach ($_POST['batchsel'] as $key) {
				$sparray = $db->ddl_perbatch($key);
				foreach ($sparray as $a ) {
					
					$db->addWeight($dateWeighed, $timeWeighed, $minWeight, $weightType, $a, $user); 
				
				}
				
				
			}

		}
		if (isset($_POST['pigsel'])) {
			$pigsize = sizeof($_POST['pigsel']);
			$fqty = $weight/$pigsize;
			foreach($_POST['pigsel'] as $pid){
				$db->addWeight($dateWeighed, $timeWeighed, $fqty, $weightType, $pid, $user);  					
			} 
		}
	} 
	if (isset($_GET['mvmntChart'])) {
			$id = $_GET['pig'];
			echo json_encode($db->getWeekDateMvmnt($id));
		}
	if (isset($_GET['weightChart'])) {
		$id = $_GET['pig'];
		echo json_encode($db->getPigWeight($id));
	}
	if(isset($_POST['getWeightReport'])){
		$pig = $_POST['pig']; 
		$from = $_POST['from'];
		$to = $_POST['to'];
		echo json_encode($db->getWeightReport($pig,$from,$to)); 
		//localhost/phpork2/gateway/meds.php?getMedsDetails=1&med=1
	} 
	if(isset($_POST['ddl_inactiveRFID'])){
		echo json_encode($db->ddl_inactiveRFID());
	}

	
?>   