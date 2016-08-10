<?php
	
	
	include "../inc/functions.php"; 
	
	$db = new phpork_functions (); 
	if(isset($_POST['addPenName'])){
		$penno = $_POST['penno'];
		$fxn = $_POST['fxn'];
		$h_id = $_POST['h_id'];
		$user = $_POST['user'];
		echo json_encode($db->addPenName($penno,$fxn,$h_id,$user)); 
		//localhost/phpork2/gateway/pen.php?addPenName=1&penno=1&fxn=weaning&h_id=5
	} 
	if(isset($_GET['ddl_pen'])){
		$arr_pen = $db->ddl_pen(); 
		echo json_encode($arr_pen);
		//localhost/phpork2/gateway/pen.php?ddl_pen=1
						
	}
	if(isset($_POST['ddl_notMortalityPen'])){
		$h_id = $_POST['house'];
		$arr_pen = $db->ddl_notMortalityPen($h_id); 
		echo json_encode($arr_pen);
		//localhost/phpork2/gateway/pen.php?ddl_notMortalityPen=1&house=1
						
	}
	if(isset($_POST['getPenByHouse'])){
		$h_id = $_POST['house'];
		$arr_pen = $db->getPenByHouse($h_id); 
		echo json_encode($arr_pen);
		//localhost/phpork2/gateway/pen.php?getPenByHouse=1&house=1
						
	}
	if(isset($_POST['getPenDetails'])){
		$h_id = $_POST['pen'];
		$arr_pen = $db->getPenDetails($h_id); 
		echo json_encode($arr_pen);
		//localhost/phpork2/gateway/pen.php?getPenDetails=1&pen=1
						
	}
?>