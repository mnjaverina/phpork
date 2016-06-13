<?php

	//require_once "inc/dbinfo.inc"; 
	include "../inc/functions.php"; 
	//include "inc/pigdet.php"; 
	$db = new phpork_functions (); 
	//$pig = new pigdet_functions (); 
	if(isset($_GET['addPigFlag'])){
		$pid = $_GET['new_pid']; 
		$pbdate = $_GET['pbdate']; 
		$pweekfar = $_GET['pweekfar']; 
		$pfarm = $_GET['ploc']; 
		$pstatus = $_GET['selStat']; 
		$phouse = $_GET['selHouse']; 
		$ppen = $_GET['selPen']; 
		$prfid = $_GET['prfid']; 
		$pgender = $_GET['pgender']; 
		$pbreed = $_GET['pbreed']; 
		$pboar = $_GET['pboar']; 
		$psow = $_GET['psow']; 
		$pfoster = $_GET['pfoster'];
		$pweight = $_GET['pweight']; 
		$user = $_GET['user_id']; 
		$fid = $_GET['selectFeeds']; 
		$fdate = $_GET['fdate']; 
		$ftime = $_GET['ftime']; 
		$medid = $_GET['selectMeds']; 
		$medDate = $_GET['medDate'];
		$medTime = $_GET['medTime']; 
		$proddate = $_GET['fprodDate']; 
		$remarks = $_GET['pweighttype']; 
		$fqty = $_GET['fqty'];
		$mqty = $_GET['mqty'];
		$unit = $_GET['selUnit'];
		echo json_encode($db->addPig($pid,$pbdate,$pweekfar,$ppen,$pgender,$pbreed,$pboar,$psow,$pfoster,$pstatus,$user)); 
		$db->addPigWeight($pid,$pweight,$remarks); 
		$db->addFeeds($fid,$fdate,$ftime,$pid,$proddate,$fqty); 
		$db->addMeds($medid,$medDate,$medTime,$pid,$mqty,$unit);
		$db->updatepigRFID($pid,$prfid); 
		//echo "<script>alert('Added successfully!');</script>"; 
		//localhost/phpork2/gateway/pig.php?addPigFlag=1&new_pid=104&pbdate=2016-04-12&pweekfar=8&ploc=2&selStat=Weaning&selHouse=2&selPen=8&prfid=104&pgender='M'&pbreed=1&pboar=64&psow=E4LY.6547&pfoster=''&pweight=12.12&user_id=1&selectFeeds=2&fdate=2016-04-12&ftime=08:00:00&selectMeds=3&medDate=2016-04-04&medTime=08:00:00&fprodDate=2016-04-04&pweighttype=weaning&fqty=12.12&mqty=31.08&selUnit=kg
		
	} 
	if(isset($_GET['addPigWeight'])){
		$lname = $_GET['lname'];
		$addr = $_GET['addr'];
		echo json_encode($db->addLocationName($lname,$addr)); 
		//localhost/phpork2/gateway/location.php?addLocationName=1&lname=Farm4&addr=antipolo
	} 
	if(isset($_GET['getPigDetails'])){
		$pid = $_GET['pig_id'];
		echo json_encode($db->getPigDetails($pid));
		//http://localhost/phpork2/gateway/pig.php?getPigDetails=1&pig_id=1
	}
	if(isset($_GET['getPigWeightDetails'])){
		$pid = $_GET['pig_id'];
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
	
	if(isset($_GET['getPigsByPen'])){
		$pid = $_GET['pen'];
		echo json_encode($db->getPigsByPen($pid));
		//http://localhost/phpork2/gateway/pig.php?getPigsByPen=1&pen=5
	}
	if(isset($_GET['getPigLabel'])){
		$pid = $_GET['pig'];
		echo json_encode($db->getPigLabel($pid));
		//http://localhost/phpork2/gateway/pig.php?getPigLabel=1&pig=1
	}
	if(isset($_GET['getinsertRFID'])){
		$pid = $_GET['pig'];
		echo json_encode($db->getinsertRFID($pid));
		//http://localhost/phpork2/gateway/pig.php?getinsertRFID=1&pig=1
	}
	if(isset($_GET['getUserEdited'])){
		$pid = $_GET['pig'];
		echo json_encode($db->getUserEdited($pid));
		//http://localhost/phpork2/gateway/pig.php?getUserEdited=1&pig=1
	}
	if(isset($_GET['ddl_sow'])){
		echo json_encode($db->ddl_sow());
		//http://localhost/phpork2/gateway/pig.php?ddl_sow=1
	}
	if(isset($_GET['ddl_boar'])){
		echo json_encode($db->ddl_boar());
		//http://localhost/phpork2/gateway/pig.php?ddl_boar=1
	}
	if(isset($_GET['ddl_foster'])){
		echo json_encode($db->ddl_foster());
		//http://localhost/phpork2/gateway/pig.php?ddl_foster=1
	}
	if(isset($_GET['ddl_pig'])){
		
		echo json_encode($db->ddl_pig());
		//http://localhost/phpork2/gateway/pig.php?ddl_pig=1
	}
	if(isset($_GET['ddl_breeds'])){
		
		echo json_encode($db->ddl_breeds());
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
	
?>   