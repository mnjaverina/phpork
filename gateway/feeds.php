<?php
	
	include "../inc/functions.php"; 
	
	$db = new phpork_functions (); 
	

	if(isset($_POST['addFeeds'])){
		$fid = $_POST['selectFeeds']; 
		$fdate = $_POST['fdate']; 
		$ftime = $_POST['ftime']; 
		$selpig = $_POST['selpig']; 
		$proddate = $_POST['feedtypeDate']; 
		$qty = $_POST['feedQty'];

		$sparray = array();
		

		if (isset($_POST['pensel'])) {
			foreach ($_POST['pensel'] as $key) {
				$sparray = $db->ddl_perpen($key);
				
				
				
			}
			$fqty = $qty/sizeof($sparray);
			
			$feedqty = number_format($fqty, 2, '.', ',');
			foreach ($_POST['pensel'] as $key) {
				$sparray = $db->ddl_perpen($key);
				foreach ($sparray as $a ) {
					
					echo json_encode($db->addFeeds($fid,$fdate,$ftime,$selpig,$proddate,$feedqty)); 
				
				}
			}

		}
		if (isset($_POST['pigpen'])) {

			$pigsize = sizeof($_POST['pigpen']);
			$fqty = $qty/$pigsize;
			foreach($_POST['pigpen'] as $pid){
				echo json_encode($db->addFeeds($fid,$fdate,$ftime,$pid,$proddate,$fqty)); 					
			} 
		}
//localhost/phpork2/gateway/feeds.php?addFeeds=1&selectFeeds=2&fdate=2016-03-05&ftime=08:00:00&feedtypeDate=2016-03-05&feedQty=0.20&selpig=1
	
	}
	if(isset($_POST['addFeedName'])){
		$fname = $_POST['fname'];
		$ftype = $_POST['ftype'];
		echo json_encode($db->addFeedName($fname,$ftype)); 
		//localhost/phpork/gateway/feeds.php?addFeedName=1&fname=feed&ftype=feedtype
	} 
	if(isset($_POST['getFeedsDetails'])){
		$feed = $_POST['feed']; 
		echo json_encode($db->getFeedsDetails($feed)); 
		//localhost/phpork/gateway/feeds.php?getFeedsDetails=1&feed=1
	} 
	if(isset($_GET['getFeedTransDetails'])){
		$feed = $_GET['feed']; 
		echo json_encode($db->getFeedTransDetails($feed)); 
		//localhost/phpork/gateway/feeds.php?getFeedTransDetails=1&feed=1
	} 
	if(isset($_POST['getFeedReport'])){
		$pig = $_POST['pig']; 
		$from = $_POST['from'];
		$to = $_POST['to'];
		echo json_encode($db->getFeedReport($pig,$from,$to)); 
		//localhost/phpork2/gateway/meds.php?getMedsDetails=1&med=1
	} 
	if(isset($_POST['ddl_feeds'])){
		$arr_feed = $db->ddl_feeds(); 
		echo json_encode($arr_feed);
		//localhost/phpork/gateway/feeds.php?ddl_feeds=1
						
	}
	if(isset($_POST['ddl_feedRecordEdit'])){
		$pid = $_POST['pig']; 
		echo json_encode($db->ddl_feedRecordEdit($pid)); 
		//localhost/phpork/gateway/feeds.php?ddl_feedRecordEdit=1&pig=1
	} 
	if(isset($_POST['ddl_feedRecord'])){
		$pid = $_POST['pig']; 
		echo json_encode($db->ddl_feedRecord($pid)); 
		//localhost/phpork/gateway/feeds.php?ddl_feedRecord=1&pig=1
	}
	if(isset($_POST['getLastFeed'])){
		$pid = $_POST['pig']; 
		echo json_encode($db->getLastFeed($pid)); 
		
	} 
?>