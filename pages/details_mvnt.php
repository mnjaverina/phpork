<!-- * PROTOTYPE PORK TRACEABILITY SYSTEM * Copyright © 2014 UPLB. --> 
<!DOCTYPE HTML> 
<html lang="en"> 
<?php 
	session_start(); 
	require_once "../connect.php"; 
	require_once "../inc/dbinfo.inc"; 
	/*if(!isset($_SESSION['username']) || !isset($_SESSION['password'])) {
		header("Location: login.php"); 
	} */
	include "../inc/functions.php";
	/*include "mvmnt.php";  
	include "../inc/pigdet.php"; 
	 $pig = new pigdet_functions();
	$db = new phpork_functions ();
	$m = new mvmnt_functions();
	$w = "";
	$w1="";
	if(isset($_POST['subEdit'])){
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
				$w1 = $newweight;
				
			}elseif ( $_POST['ed_weighttype']!= "") {
				$db->updatePigWeight($_GET['pig'],$prevweight[0],$prevweight[1],$remarks);  
				$w = $prevweight[0];
				
			}else{
				$db->updatePigWeight($_GET['pig'],$prevweight[0],$prevweight[1],$prevremarks[2]);  
				$w = $prevweight[0];
				
			} 
			
		} 
		$db->updatePigDetails($_GET['pig'],$newuser,$newstat); 
		$db->updateRFIDdetails($_GET['pig'],$newrfid,$prevrfid[1],$plabel); 
		$db->insertEditHistory($w,$prevuser,$_GET['pig'],$prevstat,$prevrfid[0]); 
		echo "<script>alert('Successfully updated!');</script>";
	}  */
?> 
	<head> 
		<meta charset="utf-8"> 
		<meta name="viewport" content="width=device-width, initial-scale=1"> 
		<title>Pork Traceability System</title> 
		<link rel="stylesheet" href="<?php echo HOST;?>/phpork/css/bootstrap.css"> 
		<link rel="stylesheet" href="<?php echo HOST;?>/phpork/css/bootstrap.min.css"> 
		<link rel="stylesheet" href="<?php echo HOST;?>/phpork/css/bootstrap-theme.css"> 
		<link rel="stylesheet" href="<?php echo HOST;?>/phpork/css/bootstrap-theme.min.css"> 
		<link rel="stylesheet" href="<?php echo HOST;?>/phpork/css/style.css"> 
		<script src="<?php echo HOST;?>/phpork/js/jquery.js"></script> 
		<link rel="stylesheet" href="<?php echo HOST;?>/phpork/css/styles_navbar1.css"> <!-- main_css --> 
		<script src="<?php echo HOST;?>/phpork/js/jquery-latest.min.js" type="text/javascript"></script> 

		<!--am charts-->
		 <link rel="stylesheet" href="<?php echo HOST;?>/phpork/css/style_amcharts.css" type="text/css">
        <script src="<?php echo HOST;?>/phpork/js/amcharts/amcharts.js" type="text/javascript"></script>
        <script src="<?php echo HOST;?>/phpork/js/amcharts/serial.js" type="text/javascript"></script>
	</head> 
	<body> 
		<div class="page-header"> <!-- banner --> 
			<img class="img-responsive" src="<?php echo HOST;?>/phpork/css/images/header1.png"> 
		</div> 
		<br/>
		<form id="form-horizontal" class="form-horizontal col-xs-10 col-sm-10 col-md-10 col-lg-10"  method="post" action="/phpork/out" style="width:50%;float:right;"> <!-- form|upper right|user-logout --> 
			<div class="form-group logout" > 
				<input type="text" class="col-xs-6 col-sm-5" readonly style="text-align: left; border: 2px solid; border-color: #83b26a;" value="<?php echo $_SESSION['username'];?>"> 
				<div class="col-xs-1 col-sm-1" style="left: -1%;"> 
					<button type="submit" class="btn btn-primary btn-sm" >Logout</button> 
				</div> 
			</div> 
		</form> 
		<div style="width: 100%;">
			<div style="border: 4px solid; border-color: #bb1d24; border-radius: 10px; margin: 20px; margin-left: 110px; max-width: 20%; margin-top: 2%; max-height: 50%; padding: 2%; float: left; padding-right: 0px; padding-top: 0px; padding-bottom: 1%;">
				<div style="width: 50%; height: 50%; margin-left: 20%; margin-top: 10%; margin-bottom: 2%;">
					<img class="img-responsive" src="<?php echo HOST;?>/phpork/images/pig1.jpg">
				</div>
				<div class="info">
					<label>Pig id: </label><br/>
					<label>RFID: </label><br/>
					<label>Gender: </label><br/>
					<label>Breed: </label><br/>
					<label>Status: </label>
					<hr style="border-color: #9ecf95;">
					<span>Farm: </span><br/>
					<span>Farrowing Date: </span><br/>
					<span>Weight: </span>
					<hr style="border-color: #9ecf95;">
					<span>Parents: </span><br/>
					<span>Boar: </span><br/>
					<span>Sow: </span>
				</div>
				<div class="col-md-2 col-centered imgHolder1" style="height: 12%; width: 12%; margin-top: 2%; padding: 0px; margin-left: 20%;">
			        <a href="#">
			            <img class="img-responsive" src="<?php echo HOST;?>/phpork/images/Edit.png"> 
			            <span> Edit Pig</span>
			        </a>
			    </div>
			    <div class="col-md-2 col-centered imgHolder" style="height: 12%; width: 12%; float: right; margin-top: 5px; padding: 0px; margin-right: 33%;">
			        <a href="#">
			            <img class="img-responsive" src="<?php echo HOST;?>/phpork/images/Pig.png"> 
			            <span> Change Pig</span>
			        </a>
			    </div> 
			</div>
			<div style="max-width: 100%; max-height: 100%; margin-left: 30%; margin-top: 2%; padding-right: 0px; margin-right: 0px;">
				<div style="float: left; max-width: 15%; max-height: 30%;">
					<div class="col-md-2 col-centered" style="height: 70%; width: 70%;">
			             <a href="#">
			             	<img class="img-responsive" src="<?php echo HOST;?>/phpork/images/Feeds2.png"> <!--movement-->
			             </a>
			        </div>
			        <br/>
			        <div class="col-md-2 col-centered" style="height: 70%; width: 70%;">
			        	<a href="#">
			        	<img class="img-responsive" src="<?php echo HOST;?>/phpork/images/Medications.png">
			        	</a>
			        </div>
			        <br/>
			        <div class="col-md-2 col-centered" style="height: 70%; width: 70%;">
			        	<a href="#"> 
			             <img class="img-responsive" src="<?php echo HOST;?>/phpork/images/Feeds2.png"> 
			            </a>
			        </div>
			        <br/>
			        <div class="col-md-2 col-centered" style="height: 70%; width: 70%;">
			        	<a href="#">
			              <img class="img-responsive" src="<?php echo HOST;?>/phpork/images/Feeds2.png"> <!--weight-->
			            </a>
			        </div>
			        <br/>
			        <div class="col-md-2 col-centered" style="height: 70%; width: 70%;">
			        	<a href="#">
			              <img class="img-responsive" src="<?php echo HOST;?>/phpork/images/Arrow Left.png">
			            </a> 
			        </div>	
			    </div>

			    <!--div for movement-->
			    <div style="margin-left: 15%; max-width: 100%; padding-top: 0px; padding-left: 0px; margin-right: 13%; margin-top: 0px;">
			    	<label>Currently:	House# Pen#</label>
			    	<button>Visualize</button>
			    	<br/> 
			    	<div style="margin: 0px;">
				    	<table class="table table-striped">
						  <thead>
						    <tr>
						      <th>Date</th>
						      <th>Time</th>
						      <th>Location</th>
						    </tr>
						  </thead>
						  <tbody>
						    <tr>
						      <td>Mark</td>
						      <td>Otto</td>
						      <td>@mdo</td>
						    </tr>
						    <tr>
						      <td>Jacob</td>
						      <td>Thornton</td>
						      <td>@fat</td>
						    </tr>
						    <tr>
						      <td>Mark</td>
						      <td>Otto</td>
						      <td>@mdo</td>
						    </tr>
						    <tr>
						      <td>Jacob</td>
						      <td>Thornton</td>
						      <td>@fat</td>
						    </tr>
						    <tr>
						      <td>Mark</td>
						      <td>Otto</td>
						      <td>@mdo</td>
						    </tr>
						    <tr>
						      <td>Jacob</td>
						      <td>Thornton</td>
						      <td>@fat</td>
						    </tr>
						    <tr>
						      <td>Mark</td>
						      <td>Otto</td>
						      <td>@mdo</td>
						    </tr>
						    <tr>
						      <td>Jacob</td>
						      <td>Thornton</td>
						      <td>@fat</td>
						    </tr>
						  </tbody>
						</table>
					</div>
					<div style="margin: 0px;">
						<table class="table table-striped">
						  <thead>
						    <tr>
						      <th>Pig id</th>
						      <th>Info</th>
						    </tr>
						  </thead>
						  <tbody >
						    <tr>
						      <td>Mark</td>
						      <td>Otto</td>
						    </tr>
						    <tr>
						      <td>Jacob</td>
						      <td>Thornton</td>
						    </tr>
						     <tr>
						      <td>Mark</td>
						      <td>Otto</td>
						    </tr>
						    <tr>
						      <td>Jacob</td>
						      <td>Thornton</td>
						    </tr>
						    <tr>
						      <td>Mark</td>
						      <td>Otto</td>
						    </tr>
						    <tr>
						      <td>Jacob</td>
						      <td>Thornton</td>
						    </tr>
						     <tr>
						      <td>Mark</td>
						      <td>Otto</td>
						    </tr>
						    <tr>
						      <td>Jacob</td>
						      <td>Thornton</td>
						    </tr>
						  </tbody>
						</table>
				</div>
			    </div>

				</div>
			    </div>
			</div>
		</div>	
		
		<div class="page-footer"> 
			Prototype Pork Traceability System || Copyright &copy; 2014 - <?php echo date("Y");?> UPLB || funded by PCAARRD 
		</div> 
	</body> 
</html>