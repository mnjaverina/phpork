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
		<link rel="stylesheet" href="<?php echo HOST;?>/phpork/css/style_details.css"> 
		<link rel="stylesheet" href="<?php echo HOST;?>/phpork/css/style_amcharts.css" type="text/css">

       <script src="<?php echo HOST;?>/phpork/js/amcharts/amcharts.js" type="text/javascript"></script>
        <script src="<?php echo HOST;?>/phpork/js/amcharts/serial.js" type="text/javascript"></script>
        <script src="<?php echo HOST;?>/phpork/js/jquery.js"></script> 
		<script src="<?php echo HOST;?>/phpork/js/jquery-latest.min.js" type="text/javascript"></script> 
	    
	    <script src="<?php echo HOST;?>/phpork/js/bootstrap.js" type="text/javascript"></script> 
		</head> 

	<body> 
		<div class="page-header"> 
	      	<a href="<?php echo HOST;?>/phpork/home">
	        <img class="img-responsive" src="<?php echo HOST;?>/phpork/css/images/Header1.png"> 
	      	</a>
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
		
		<!--PIG DETAILS-->	
		<div style="border: 4px solid; border-color: #bb1d24; border-radius: 10px; margin: 20px; margin-left: 110px; max-width: 20%; margin-top: 4%; max-height: 50%; padding: 1%; float: left; padding-top: 0px; padding-bottom: 1%;">	
			<!--VIEW PIG DETAILS-->	
			<div style="width: 50%; height: 50%; margin-left: 25%; margin-top: 10%; margin-bottom: 2%;">
				<img class="img-responsive" src="<?php echo HOST;?>/phpork/images/pig1.jpg">
			</div>
				
			<div id="viewPig" style="display: inline-block;">
				<div class="info" id="viewPigDetails">
				</div>
				<br/>
				<div class="col-md-2 col-centered imgHolder1" style="height: 15%; width: 15%; margin-top: 2%; padding: 0px; margin-left: 20%;">
					<button id="editPigButton" style="background-color: white; border: none;">
						<img class="img-responsive" src="<?php echo HOST;?>/phpork/images/Edit.png"> 
						<span>Edit Pig</span>
					</button>
				</div>
				<div class="col-md-2 col-centered imgHolder" style="height: 15%; width: 15%; float: right; margin-top: 5px; padding: 0px; margin-right: 33%;">
					<button id="changePig" style="background-color: white; border: none;">
						<img class="img-responsive"  src="<?php echo HOST;?>/phpork/images/Pig.png"> 
						<span>   Change Pig</span>
					</button>
				</div>
			</div>
			<!--VIEW PIG DETAILS-->	

			<!--EDIT PIG DETAILS-->
			<div id="editPigDetails" style="display: none;">	
				<div class="info" id="pigInfo">
				</div>
				<div class="col-md-2 col-centered imgHolder1" style="height: 15%; width: 15%; margin-top: 2%; padding: 0px; margin-left: 20%;">
					<a id="viewPigDetails" class="" href="/phpork/details/view/pigDetails">
						<img class="img-responsive" src="<?php echo HOST;?>/phpork/images/Save.png"> 
						<span> Save</span>
					</a>
				</div>
				<div class="col-md-2 col-centered imgHolder" style="height: 15%; width: 15%; float: right; margin-top: 5px; padding: 0px; margin-right: 33%;">
					<button id="cancelEditPig" style="background-color: white; border: none;">
						<img class="img-responsive" src="<?php echo HOST;?>/phpork/images/Cancel.png"> 
						<span> Cancel</span>
					</button>
				</div>
			</div>
			<!--EDIT PIG DETAILS-->
		</div>	

		<!--Icons-->
		<div style="float: left; max-width: 13%; max-height: 30%; margin-right: 0px; margin-top: 2%; padding-left: 1%; padding-right: 0px;"> 
			<div class="col-md-2 col-centered" style="height: 75%; width: 75%; margin-right: 0px;">
				<button id="movement" style="background-color: white; border: none; outline: none;">
			       <img class="img-responsive" id="movement" src="<?php echo HOST;?>/phpork/images/Feeds2.png">
			    </button>
			</div>
			<br/>
			<div class="col-md-2 col-centered" style="height: 75%; width: 75%;">
			    <button id="medication" style="background-color: white; border: none; outline: none;">
			        <img class="img-responsive"  src="<?php echo HOST;?>/phpork/images/Medications.png">
			    </button>
			</div>
			<br/>
			<div class="col-md-2 col-centered" style="height: 75%; width: 75%;">
			    <button id="feeds1" style="background-color: white; border: none; outline: none;">
			        <img class="img-responsive" src="<?php echo HOST;?>/phpork/images/Feeds2.png">
			    </button> 
			</div>
			<br/>
			<div class="col-md-2 col-centered" style="height: 75%; width: 75%;">
			    <button id="weight" style="background-color: white; border: none; outline: none;">
			        <img class="img-responsive" src="<?php echo HOST;?>/phpork/images/Feeds2.png">
			    </button>
			</div>
			<br/>
			<div class="col-md-2 col-centered" style="height: 75%; width: 75%;">
			    <button id="backToPig" style="background-color: white; border: none; outline: none;">
			        <img class="img-responsive" src="<?php echo HOST;?>/phpork/images/Arrow Left.png">
			    </button> 
			</div>	
		</div>
		<!--Icons-->

		<!--VIEWS-->
		<div style="max-width: 100%; max-height: 100%; margin-left: 39%; margin-top: 2%; margin-right: 2%; padding-right: 0px; padding: 2%; padding-top: 1%;">
			<!--view movement-->
			<div id="viewMovement" style="display: inline-block;">
			    <div style="max-width: 100%; padding-top: 0%; padding-left: 0px; margin-right: 12%; margin-top: 0px; margin: 2%; margin-left: 0px;">
			    	<label>Currently:	House# Pen#</label>
			    	<button>Visualize</button>
			    	<br/><br/> 
			    	<div style="margin: 0px; max-width: 100%;">
				    	<table class="table table-striped">
						  <thead>
						    <tr>
						      <th>Date</th>
						      <th>Time</th>
						      <th>Location</th>
						    </tr>
						  </thead>
						  <tbody id="viewMovementBody">
						  </tbody>
						</table>
					</div>
					<br/>
					<div style="margin: 0px; max-width: 100%;">
						<table class="table table-striped">
						  <thead>
						    <tr>
						      <th>Pig id</th>
						      <th>Info</th>
						    </tr>
						  </thead>
						  <tbody id="pigsByPenInfo"> 
						  </tbody>
						</table>
					</div>
					<div class="col-md-2 col-centered imgHolder2" style="height: 8%; width: 8%; float: right; margin-right: 8%; margin-top: 1%;">
					    <a href="#">
					        <img class="img-responsive" src="<?php echo HOST;?>/phpork/images/Download Report.png"> <!--movement-->
					        <span> Download Report</span>
					    </a>
				    </div>
			    </div>
			</div> 
			<!--view movement-->

			<!--view meds-->
			<div id="viewMeds" style="display: none;"> 
				<div id="viewMedsInfo" style="margin-left: 0%; max-width: 100%; padding-top: 2%; padding-left: 0px; margin-right: 2%; margin-top: 5%; display: inline-block;">
				    <div class="col-md-2 col-centered imgHolder2" style="height: 8%; width: 8%; float: right; margin-right: 8%; margin-top: 1%;">
					     <button id="editMedsButton">
					            <img class="img-responsive" src="<?php echo HOST;?>/phpork/images/Edit.png"> <!--movement-->
					            <span> Edit Medication</span>
					        </button>
				    </div>
				    <div class="col-md-2 col-centered imgHolder2" style="height: 8%; width: 8%; float: right; margin-right: 5%; margin-top: 1%;">
					        <button id="insertMedsButton">
					            <img class="img-responsive" src="<?php echo HOST;?>/phpork/images/Insert Medications.png"> <!--modal-->
					            <span> Insert Medication</span>
					        </button>
				    </div>
				    <div>
					    <label>Last medication given: </label><br/>
					    <label>Name: </label><br/>
					    <label>Type: </label>
				    </div>
				    <br/>
				    <div style="margin: 0px;">
					    <table class="table table-striped">
							<thead>
							    <tr>
							    	<th>Medication Name</th>
							    	<th>Medication Type</th>
							    	<th>Quantity</th>
							    	<th>Date Given</th>
							    </tr>
							</thead>
							<tbody id="viewMedsBody" style="height: 25%;">
							</tbody>
						</table>
					</div>
					<br/>
					<div class="col-md-2 col-centered imgHolder2" style="height: 8%; width: 8%; float: right; margin-right: 8%; margin-top: 8%;">
					    <a href="#">
					        <img class="img-responsive" src="<?php echo HOST;?>/phpork/images/Download Report.png"> <!--movement-->
					        <span> Download Report</span>
					    </a>
				    </div>
				</div>
				<div id="editMedsDetails" style="display: none;"> 
				    <div style="margin-left: 15%; max-width: 100%; padding-top: 2%; padding-left: 0px; margin-right: 13%; margin-top: 0px;">
				    	<div class="col-md-2 col-centered imgHolder2" style="height: 8%; width: 8%; float: right; margin-right: 8%; margin-top: 1%;">
					        <a id="viewMedDetails" class="" href="/phpork/viewDetails/view/meds"> 
					            <img class="img-responsive" src="<?php echo HOST;?>/phpork/images/Save.png"> <!--movement-->
					            <span> Save</span>
					        </a>
				    	</div>
				   		<div class="col-md-2 col-centered imgHolder2" style="height: 8%; width: 8%; float: right; margin-right: 5%; margin-top: 1%;">
					        <button id="cancelEditMeds">
					            <img class="img-responsive" src="<?php echo HOST;?>/phpork/images/Cancel.png"> <!--movement-->
					            <span> Cancel</span>
					        </button>
				    	</div>
				    	<div>
					    	<label>Last medication given: </label><br/>
					    	<label>Name: </label><br/>
					    	<label>Type: </label>
				    	</div>
				    	<br/>
				    	<div style="margin: 0px;">
					    	<table class="table table-striped t_feeds">
							  <thead>
							    <tr class="tr_feeds">
							      <th>Medication Name</th>
							      <th>Medication Type</th>
							      <th>Edit to</th>
							    </tr>
							  </thead>
							  <tbody class="tb_feeds" id="editMedsBody">
							   
							  </tbody>
							</table>
						</div>
					</div>
				</div> <!--edit meds-->
				<!-- insert meds -->
				<div id="insertMedsDetails" style="display: none;"> 
				    <div style="margin-left: 15%; max-width: 100%; padding-top: 2%; padding-left: 0px; margin-right: 13%; margin-top: 0px;">
				    	<div class="col-md-2 col-centered imgHolder2" style="height: 8%; width: 8%; float: right; margin-right: 8%; margin-top: 1%;">
					       <button id="saveInsertMeds">
					            <img class="img-responsive" src="<?php echo HOST;?>/phpork/images/Save.png"> <!--movement-->
					            <span> Save</span>
					        </button>
				    	</div>
				   		<div class="col-md-2 col-centered imgHolder2" style="height: 8%; width: 8%; float: right; margin-right: 5%; margin-top: 1%;">
					        <button id="backToMeds">
					            <img class="img-responsive" src="<?php echo HOST;?>/phpork/images/Cancel.png"> <!--movement-->
					            <span>Back</span>
					        </button>
				    	</div>
				    	<br/>
				    	<div style="width:100% !important;" id="insertMedsBody" style="width: 50%;">
		 					<select name="selChoice"  id="selectMedchoice" style="color:black; border-radius:5px;width:30%;align:center; ">
		 						<option value="" disabled selected>Select if per pen or per pig..</option> 
			 					<option value="perpen"> Select per pen</option>
			 					<option value="perpig">Select per pig</option>
			 				</select>
			 				<br/>
			 				<br/>
			 				<div id="insertperPen" style="display: none;">
			 					<input type="checkbox" value="selectAllPen" onchange='checkAllPen(this)' >Select All Pens</input>
			 					<br/>
			 					<br/>
			 				</div>
			 				<div id="insertperPig" style="display: none;">
			 					<input type="checkbox" value="selectAllPig" onchange='checkAllPig(this)' >Select All Pigs</input>
			 					<br/>
			 					<br/>
			 				</div>
							<div>
								<table class="table table-striped table-bordered" id="insertMeds"> 
									<tr> 
										<td> Last Medication Given: 
											<select name="selectMeds" id="selectMeds" style="color:black;border-radius:5px;"> 
												<option value="" disabled selected>Select medication...</option> 
											</select> 
										</td>
									</tr>
									<tr>
										<td> Medication type:
											<input type="text" readonly id="medType"></input>
										</td>

									</tr>
									<tr> 
										<td> Date Given: <input type="date" class="form-control" id="dateMedGiven" aria-describedby="basic-addon3" placeholder="mm/dd/yyyy"/>
										</td>
									</tr>
									<tr> 
										<td> Time Given: <input type="time" class="form-control" id="timeMedGiven" aria-describedby="basic-addon3"/>
										</td>
									</tr>
									<tr>
								<td>
									Quantity: <input type="number" id="medQty" name="medQty" min="0"  step="0.01" style="color:black;border-radius:5px;height:25px;"/> &nbsp;&nbsp; 
									<select style="color:black;border-radius:5px;" name="selUnit" id="qtyUnit">
										<option value = "cc"> cc</option>
										<option value="ml">ml</option>
										<option value="kg">kg</option>
									</select>
								</td>
							</tr>
								</table>
							</div>

		 				</div>
				    	<br/>
				    	
					</div>
				</div>
				<!-- insert meds -->
			</div>
			<!--view meds-->

			<!--view feeds-->
			<div id="viewFeeds" style="display: none;"> 
				<div id="viewFeedsInfo" style="margin-left: 0%; max-width: 100%; padding-top: 2%; padding-left: 0px; margin-right: 2%; margin-top: 5%; display: inline-block;">
					<div class="col-md-2 col-centered imgHolder2" style="height: 8%; width: 8%; float: right; margin-right: 8%; margin-top: 1%;">
						<button id="editFeedsButton">
					            <img class="img-responsive" src="<?php echo HOST;?>/phpork/images/Edit.png"> <!--movement-->
					            <span> Edit Feeds</span>
					        </button>
					</div>
					<div class="col-md-2 col-centered imgHolder2" style="height: 8%; width: 8%; float: right; margin-right: 5%; margin-top: 1%;">
					        <button id="insertFeedsButton" data-toggle="modal" data-target="#modalInsertFeeds">
					            <img class="img-responsive" src="<?php echo HOST;?>/phpork/images/Insert Feeds.png"> <!--modal-->
					            <span> Insert Feeds</span>
					        </button>
				    </div>
					<div>
						<label>Last feed given: </label><br/>
						<label>Feed name: </label><br/>
						<label>Feed type: </label>
					</div>
					<br/>
					<div style="margin: 0px;">
						<table class="table table-striped">
							<thead>
								<tr>
								    <th>Feed Name</th>
								    <th>Feed Type</th>
								    <th>Quantity</th>
								    <th>Production Date</th>
								    <th>Date Given</th>
								</tr>
							</thead>
							<tbody id="viewFeedsBody" style="height: 25%;">
							</tbody>
						</table>
					</div>
					<br/>
					<div class="col-md-2 col-centered imgHolder2" style="height: 8%; width: 8%; float: right; margin-right: 8%; margin-top: 8%;">
						<a href="#">
						    <img class="img-responsive" src="<?php echo HOST;?>/phpork/images/Download Report.png"> 
						    <span> Download Report</span>
						</a>
					</div>
				</div>

				<div id="editFeeds" style="display: none;"> 
				
				    <div style="margin-left: 15%; max-width: 100%; padding-top: 2%; padding-left: 0px; margin-right: 13%; margin-top: 0px;">
				    	<div class="col-md-2 col-centered imgHolder2" style="height: 8%; width: 8%; float: right; margin-right: 8%; margin-top: 1%;">
					        <a id="viewFeedDetails" class="" href="/phpork/viewDetails/view/feeds"> 
					            <img class="img-responsive" src="<?php echo HOST;?>/phpork/images/Save.png"> <!--movement-->
					            <span> Save Feed</span>
					        </a>
				    	</div>
				   		<div class="col-md-2 col-centered imgHolder2" style="height: 8%; width: 8%; float: right; margin-right: 5%; margin-top: 1%;">
					        <button id="cancelEditFeeds">
					            <img class="img-responsive" src="<?php echo HOST;?>/phpork/images/Cancel.png"> <!--movement-->
					            <span> Cancel</span>
					        </button>
				    	</div>
				    	<div>
					    	<label>Last feed type: </label><br/>
					    	<label>Feed name: </label><br/>
					    	<label>Feed type: </label>
				    	</div>
				    	<br/>
				    	<div style="margin: 0px;">
					    	<table class="table table-striped t_feeds">
							  <thead>
							    <tr class="tr_feeds">
							      <th>Feed Name</th>
							      <th>Feed Type</th>
							      <th>Production Date</th>
							      <th>Edit to</th>
							    </tr>
							  </thead>
							  <tbody class="tb_feeds" id="editFeedsBody">
							    
							  </tbody>
							</table>
						</div>
					</div>
				</div> <!--edit feeds-->
				<!-- insert feeds -->
				<div id="insertFeedsDetails" style="display: none;"> 
				    <div style="margin-left: 15%; max-width: 100%; padding-top: 2%; padding-left: 0px; margin-right: 13%; margin-top: 0px;">
				    	<div class="col-md-2 col-centered imgHolder2" style="height: 8%; width: 8%; float: right; margin-right: 8%; margin-top: 1%;">
					       <button id="saveInsertFeeds">
					            <img class="img-responsive" src="<?php echo HOST;?>/phpork/images/Save.png"> <!--movement-->
					            <span> Save</span>
					        </button>
				    	</div>
				   		<div class="col-md-2 col-centered imgHolder2" style="height: 8%; width: 8%; float: right; margin-right: 5%; margin-top: 1%;">
					        <button id="backToFeeds">
					            <img class="img-responsive" src="<?php echo HOST;?>/phpork/images/Cancel.png"> <!--movement-->
					            <span>Back</span>
					        </button>
				    	</div>
				    	<br/>
				    	<div style="width:100% !important;" id="insertFeedsBody" style="width: 50%;">
		 					<select name="selChoice"  id="selectFeedchoice" style="color:black; border-radius:5px;width:30%;align:center; ">
		 						<option value="" disabled selected>Select if per pen or per pig..</option> 
			 					<option value="perpenF"> Select per pen</option>
			 					<option value="perpigF">Select per pig</option>
			 				</select>
			 				<br/>
			 				<br/>
			 				<div id="insertperPenF" style="display: none;">
			 					<input type="checkbox" value="selectAllPen" onchange='checkAllPenF(this)' >Select All Pens</input>
			 					<br/>
			 					<br/>
			 				</div>
			 				<div id="insertperPigF" style="display: none;">
			 					<input type="checkbox" value="selectAllPig" onchange='checkAllPigF(this)' >Select All Pigs</input>
			 					<br/>
			 					<br/>
			 				</div>
							<div>
								<table class="table table-striped table-bordered" id="insertFeeds"> 
									<tr> 
										<td> Last Feed Given: 
											<select name="selectFeeds" id="selectFeeds" style="color:black;border-radius:5px;"> 
												<option value="" disabled selected>Select feeds...</option> 
											</select> 
										</td>
									</tr>
									<tr>
										<td> Feed type:
											<input type="text" readonly id="feedType"></input>
										</td>

									</tr>
									<tr> 
										<td> Production Date : <input type="date" class="form-control" id="prodDate" aria-describedby="basic-addon3" placeholder="mm/dd/yyyy"/>
										</td>
									</tr>
									<tr> 
										<td> Date Given: <input type="date" class="form-control" id="dateFeedGiven" aria-describedby="basic-addon3" placeholder="mm/dd/yyyy"/>
										</td>
									</tr>
									<tr> 
										<td> Time Given: <input type="time" class="form-control" id="timeFeedGiven" aria-describedby="basic-addon3"/>
										</td>
									</tr>
									<tr>
								<td>
									Quantity: <input type="number" id="feedQty" name="medQty" min="0"  step="0.01" style="color:black;border-radius:5px;height:25px;"/> &nbsp; <span>kg</span> 
								</td>
							</tr>
								</table>
							</div>

		 				</div>
				    	<br/>
				    	
					</div>
				</div>
				<!-- insert feeds -->
			</div> 
			<!--view feeds-->

			<!--view weight-->
			<div id="viewWeight" style="display: none;">
			    <div style="max-width: 100%; padding-top: 0%; padding-left: 0px; margin-right: 12%; margin-top: 0px; margin: 2%; margin-left: 0px;">
			    	<button>Insert Weight</button>
			    </div>
			</div> 
			<!--view weight-->

			
		</div>
		<!--VIEWS-->

		<div class="page-footer"> 
			Prototype Pork Traceability System || Copyright &copy; 2014 - <?php echo date("Y");?> UPLB || funded by PCAARRD 
		</div> 

	<div>
	  <?php
        $pig = $_GET['pig'];
        $pen = $_GET['pen'];
        $house =$_GET['house'];
        $farm = $_GET['location'];
        echo "<input type='hidden' value='$pig' name='pig' id='pigid'/>";
        echo "<input type='hidden' value='$pen' name='pig' id='penid'/>"; 
        echo "<input type='hidden' value='$house' name='pig' id='houseid'/>"; 
        echo "<input type='hidden' value='$farm' name='pig' id='farmid'/>"; 
         
      ?>
    </div>

	
	<script type="text/javascript"> 
      $(document).ready(function () {
      	var pig_id = $('#pigid').val();
      	var pen_id = $('#penid').val();
      	var house_id = $('#houseid').val();
      	var farm_id = $('#farmid').val();

      	 $.ajax({
	        url: '/phpork/gateway/pig.php',
	        type: 'post',
	        data : {
	          getPigDetails: '1',
	          pig_id: pig_id
	        },
	        success: function (data) { 
	          var data = jQuery.parseJSON(data); 
	            $("#viewPigDetails").append($("<label></label>").text("Pig id:                  "  +data[0].pid));
	            $("#viewPigDetails").append($("<br/>"));
	             $("#viewPigDetails").append($("<label></label>").text("Gender:                 "  +data[0].gender));
	            $("#viewPigDetails").append($("<br/>"));  
	             $("#viewPigDetails").append($("<label></label>").text("Breed:                  "  +data[0].br_name));
	            $("#viewPigDetails").append($("<br/>")); 
	             $("#viewPigDetails").append($("<label></label>").text("RFID:                   "  +data[0].rfid_tag));
	            $("#viewPigDetails").append($("<br/>")); 
	            $("#viewPigDetails").append($("<label></label>").text("Status:                  "  +data[0].pig_stat));
	            $("#viewPigDetails").append($("<br/>")); 
	            $("#viewPigDetails").append($("<hr>").attr("style", "border-color: #9ecf95;")); 
	            $("#viewPigDetails").append($("<span></span>").text("Farm:                       "  +data[0].loc_name));
	            $("#viewPigDetails").append($("<br/>")); 
	            $("#viewPigDetails").append($("<span></span>").text("Farrowing Date:            "  +data[0].far_date));
	            $("#viewPigDetails").append($("<br/>")); 
	            $("#viewPigDetails").append($("<span></span>").text("Weight:                  "  +data[0].weight+ "kg"));
	            $("#viewPigDetails").append($("<br/>")); 
	             $("#viewPigDetails").append($("<hr>").attr("style", "border-color: #9ecf95;")); 
	            $("#viewPigDetails").append($("<span></span>").text("Parents:                       "));
	            $("#viewPigDetails").append($("<br/>")); 
	            $("#viewPigDetails").append($("<span></span>").text("Boar:            "  +data[0].boar));
	            $("#viewPigDetails").append($("<br/>")); 
	            $("#viewPigDetails").append($("<span></span>").text("Sow:                  "  +data[0].sow));
	            $("#viewPigDetails").append($("<br/>"));         
	        }    
	      });
		
		$.ajax({
	        url: '/phpork/gateway/pig.php',
	        type: 'post',
	        data : {
	          getPigDetails: '1',
	          pig_id: pig_id
	        },
	        success: function (data) { 
	          var data = jQuery.parseJSON(data); 
	              $("#pigInfo").append($("<label></label>").text("Pig id:                  "  +data[0].pid));
	              $("#pigInfo").append($("<br/>"));
	              $("#pigInfo").append($("<label></label>").text("Gender:                 "  +data[0].gender));
	              $("#pigInfo").append($("<br/>"));  
	              $("#pigInfo").append($("<label></label>").text("Breed:                  "  +data[0].br_name));
	              $("#pigInfo").append($("<br/>"));  
	              $("#pigInfo").append($("<label></label>").text("Farrowing Date:         "  +data[0].far_date));
	              $("#pigInfo").append($("<br/>"));
	              $("#pigInfo").append($("<label></label>").text("Farm Location:         "  +data[0].loc_name));
                  $("#pigInfo").append($("<hr>").attr("style", "border-color: #9ecf95;"));
                  $("#pigInfo").append($("<label></label>").text("Status: "));
                  $("#pigInfo").append($("<input></input)").attr("type", "text").attr("id","editStatus").attr("value", data[0].pig_stat));
                  $("#pigInfo").append($("<br/>"));
                  $("#pigInfo").append($("<label></label>").text("RFID: "));
                  $("#pigInfo").append($("<input></input)").attr("type", "text").attr("id","editRFID").attr("value", data[0].rfid_tag));
                  $("#pigInfo").append($("<br/>"));
                  $("#pigInfo").append($("<label></label>").text("Weight: "));
                  $("#pigInfo").append($("<input></input)").attr("type", "text").attr("id","editWeight").attr("value", data[0].weight));
                  $("#pigInfo").append($("<label></label>").text("kg"));
                  $("#pigInfo").append($("<br/>"));
                  $("#pigInfo").append($("<label></label>").text("Weight Type: "));
                  $("#pigInfo").append($("<input></input)").attr("type", "text").attr("id","editWeightType").attr("value", data[0].weight_type));
                  $("#pigInfo").append($("<hr>").attr("style", "border-color: #9ecf95;"));
                  $("#pigInfo").append($("<span></span>").text("Parents:                       "));
		          $("#pigInfo").append($("<br/>")); 
		          $("#pigInfo").append($("<span></span>").text("Boar:            "  +data[0].boar));
		          $("#pigInfo").append($("<br/>")); 
		          $("#pigInfo").append($("<span></span>").text("Sow:                  "  +data[0].sow));
		          $("#pigInfo").append($("<br/>")); 
						
	        }    
	      });
		
		$.ajax({
	        url: '/phpork/gateway/feeds.php',
	        type: 'post',
	        data : {
	          ddl_feedRecord: '1',
	          pig: pig_id
	        },
	        success: function (data) { 
	          var data = jQuery.parseJSON(data); 
	           for(i=0;i<data.length;i++){
	           		$("#viewFeedsBody").append($("<tr><td>" +data[i].fname+ "</td><td>" +data[i].ftype+ "</td><td>" +data[i].qty+ "</td><td>" +data[i].proddate+ "</td><td>" +data[i].date_given+ "</td></tr>"));
	           		

	           }
	        }    
	      });
		$.ajax({
	        url: '/phpork/gateway/feeds.php',
	        type: 'post',
	        data : {
	          ddl_feedRecordEdit: '1',
	          pig: pig_id
	        },
	        success: function (data) { 
	          var data = jQuery.parseJSON(data); 
	           for(i=0;i<data.length;i++){
	           		$("#editFeedsBody").append($("<tr><td>" +data[i].fname+ "</td><td>" +data[i].ftype+ "</td><td>"  +data[i].proddate+ "</td><td><select style='color: black; width: 50%' id='lastFeed'></select></td></tr>"));
	           }
	        }    
	      });
		$.ajax({
			url: '/phpork/gateway/feeds.php',
			type: 'post',
			data : {
			 ddl_feeds: '1'
			},
			success: function (data) { 
			   var data = jQuery.parseJSON(data); 
			      for(i=0;i<data.length;i++){
			        $("#lastFeed").append($("<option></option>").attr("value",data[i].feed_id)
			          .attr("name","feeds")
			          .text(data[i].feed_name)); 
			      }

			    } 
			});


		$.ajax({
	        url: '/phpork/gateway/meds.php',
	        type: 'post',
	        data : {
	          ddl_medRecord: '1',
	          pig: pig_id
	        },
	        success: function (data) { 
	          var data = jQuery.parseJSON(data); 
	           for(i=0;i<data.length;i++){
	           		$("#viewMedsBody").append($("<tr><td>" +data[i].mname+ "</td><td>" +data[i].mtype+ "</td><td>" +data[i].qty+ "</td><td>" +data[i].date_given+ "</td></tr>"));
	           		

	           }
	        }    
	      });

		$.ajax({
	        url: '/phpork/gateway/meds.php',
	        type: 'post',
	        data : {
	          ddl_medRecordEdit: '1',
	          pig: pig_id
	        },
	        success: function (data) { 
	          var data = jQuery.parseJSON(data); 
	           for(i=0;i<data.length;i++){
	           		$("#editMedsBody").append($("<tr><td>" +data[i].mname+ "</td><td>" +data[i].mtype+ "</td><td><select style='color: black; width: 50%' id='lastMed'></select></td></tr>"));
	           }
	        }    
	      });
		$.ajax({
			url: '/phpork/gateway/feeds.php',
			type: 'post',
			data : {
			 ddl_meds: '1'
			},
			success: function (data) { 
			   var data = jQuery.parseJSON(data); 
			      for(i=0;i<data.length;i++){
			        $("#lastMed").append($("<option></option>").attr("value",data[i].med_id)
			          .attr("name","meds")
			          .text(data[i].med_name)); 
			      }

			    } 
			});

		$.ajax({
	        url: '/phpork/gateway/movement.php',
	        type: 'post',
	        data : {
	          getWeekDateMvmnt: '1',
	          pig: pig_id
	        },
	        success: function (data) { 
	          var data = jQuery.parseJSON(data); 
	           for(i=0;i<data.length;i++){
	           		//$("#movementInfo").append($("<label>Currently:	House " ++ "Pen " ++ "</label>"));
	           		$("#viewMovementBody").append($("<tr><td>" +data[i].date+ "</td><td>" +data[i].timeMoved+ "</td><td>Pen " +data[i].pen+ "</td></tr>"));
	           		

	           }
	        }    
	      });

		$.ajax({
	        url: '/phpork/gateway/pig.php',
	        type: 'post',
	        data : {
	          getPigsByPen: '1',
	          pen: pen_id
	        },
	        success: function (data) { 
	          var data = jQuery.parseJSON(data); 
	           for(i=0;i<data.length;i++){
	           		if(data[i].pig_id != pig_id){
	           			$("#pigsByPenInfo").append($("<tr><td>" +data[i].lbl+ "</td><td> <button id=\"getPigInfo\" style='color:black;' onclick=\"viewPig(" +data[i].pig_id+ ")\"> Info </button>  </td></tr>"));
	           		}
	           	}
	        }    
	      });

		 $.ajax({
			        url: '/phpork/gateway/pen.php',
			        type: 'post',
			        data : {
			          ddl_notMortalityPen: '1',
			          house: house_id
			        },
			        success: function (data) { 
			          var data = jQuery.parseJSON(data);
			          for(i=0;i<data.length;i++){
			             $('#insertperPen').append($('<input type="checkbox" class="penclass" value="'+data[i].pen_id+'">'+data[i].pen_no+'</input>'));
			             $('#insertperPen').append($('<br/>'));

			             $('#insertperPenF').append($('<input type="checkbox" class="penclassF" value="'+data[i].pen_id+'">'+data[i].pen_no+'</input>'));
			             $('#insertperPenF').append($('<br/>'));
			            }
								
			        }    
			      });
		$.ajax({
			        url: '/phpork/gateway/pig.php',
			        type: 'post',
			        data : {
			          getPigsByPen: '1',
			          pen: pen_id
			        },
			        success: function (data) { 
			          var data = jQuery.parseJSON(data);
			          for(i=0;i<data.length;i++){
			             $('#insertperPig').append($('<input type="checkbox" class="pigclass" value="'+data[i].pig_id+'">'+data[i].lbl+'</input>'));
			             $('#insertperPig').append($('<br/>'));

			             $('#insertperPigF').append($('<input type="checkbox" class="pigclassF" value="'+data[i].pig_id+'">'+data[i].lbl+'</input>'));
			             $('#insertperPigF').append($('<br/>'));

		            }
								
			        }    
			      });


        $('#changePig').on("click",function() {
          window.location ="/phpork/pages/farm";
        });

         $('#editPigButton').on("click",function() {
           $('#viewPig').attr("style", "display: none");
            $('#editPigDetails').attr("style", "display: inline-block");

        });
 		
 		$('#cancelEditPig').on("click",function() {
           $('#viewPig').attr("style", "display: inline-block");
           $('#editPigDetails').attr("style", "display: none");

        });

 		$('#movement').on("click",function() {
          
          $('#viewMovement').attr("style", "display: inline-block");
          $('#viewMeds').attr("style", "display: none");
           $('#viewFeeds').attr("style", "display: none");
            //$('#viewWeight').attr("style", "display: none");
        });

        /*view meds */

         $('#medication').on("click",function() {
          $('#viewMeds').attr("style", "display: inline-block");
          $('#viewMedsInfo').attr("style", "display: inline-block");
          $('#editMedsDetails').attr("style", "display: none");
          $('#insertMedsDetails').attr("style", "display: none");
          $('#viewMovement').attr("style", "display: none");
          $('#viewFeeds').attr("style", "display: none");
            //$('#viewWeight').attr("style", "display: none");
        });

         $('#editMedsButton').on("click",function() {
           $('#viewMedsInfo').attr("style", "display: none");
            $('#editMedsDetails').attr("style", "display: inline-block");
             $('#insertMedsDetails').attr("style", "display: none");

        });


        $('#cancelEditMeds').on("click",function() {
           $('#viewMedsInfo').attr("style", "display: inline-block");
            $('#editMedsDetails').attr("style", "display: none");

        });
        $('#insertMedsButton').on("click",function() {
           $('#viewMedsInfo').attr("style", "display: none");
            $('#editMedsDetails').attr("style", "display: none");
            $('#insertMedsDetails').attr("style", "display: inline-block");

        });

         $('#selectMedchoice').on("change",function() {
         	var choice = $('#selectMedchoice').val();
         	console.log(choice);
	          if(choice === "perpen"){
	          	$('#insertperPen').attr("style", "display: inline-block");
	          	$('#insertperPig').attr("style", "display: none");

	          }else if(choice=== "perpig"){
	          	$('#insertperPig').attr("style", "display: inline-block");
	          	$('#insertperPen').attr("style", "display: none");

	          }
        });

         $('#backToMeds').on("click",function() {
           $('#viewMedsInfo').attr("style", "display: inline-block");
            $('#editMedsDetails').attr("style", "display: none");
            $('#insertMedsDetails').attr("style", "display: none");

        });


        

		 $.ajax({
          url: '/phpork/gateway/meds.php',
          type: 'post',
          data : {
           ddl_meds: '1'
          },
          success: function (data) { 
             var data = jQuery.parseJSON(data); 
                for(i=0;i<data.length;i++){
                  $("#selectMeds").append($("<option></option>").attr("value",data[i].med_id)
                    .attr("name","meds")
                    .text(data[i].med_name)); 
                }
                   
              } 
          
        });

		 $('#selectMeds').on("change", function() {
               
                 var med = $("#selectMeds").val(); 
                  
                  $.ajax({
                    url: '/phpork/gateway/meds.php',
                    type: 'post',
                    data : {
                      getMedsDetails: '1',
                      med: med
                    },
                    success: function (data) { 
                       var data = jQuery.parseJSON(data); 
                        $("#medType").attr("value", data[0].mtype); 
                          
                     }
                  });
         });

		 $('#saveInsertMeds').on("click", function(){
		 	var lastMed = $('#selectMeds').val();
		 	var medType = $('#medType').val();
		 	var dateGiven = $('#dateMedGiven').val();
		 	var timeGiven = $('#timeMedGiven').val();
		 	var medQuantity = $('#medQty').val();
		 	var qtyUnit = $('#qtyUnit').val();

		 	var choice = $('#selectMedchoice').val();

		 	if(choice === "perpen"){

		 		var checkedPen = document.getElementsByClassName('penclass');
		 		var selPen = [];

		 		for(var i=0;i<checkedPen.length; i++){
		 			if(checkedPen[i].checked){
		 				selPen.push($(checkedPen[i]).val());
		 			}
		 		}
		 		
			 	 $.ajax({
	                    url: '/phpork/gateway/meds.php',
	                    type: 'post',
	                    data : {
	                     subMed: '1',
	                     selectMeds: lastMed,
						 medDate: dateGiven,
			             medTime: timeGiven, 
		                 medQty: medQuantity,
			             selUnit: qtyUnit,
			             pensel: selPen
	                    },
	                    success: function (data) { 
	                       var data = jQuery.parseJSON(data); 
	                       alert("Added!");
	                     }
	                  });


		 	}else if(choice === "perpig"){
		 		var checkedPig = document.getElementsByClassName('pigclass');
		 		var selPig = [];

		 		for(var i=0;i<checkedPig.length; i++){
		 			if(checkedPig[i].checked){
		 				console.log($(checkedPig[i]).val(0));
		 				selPig.push($(checkedPig[i]).val());
		 			}
		 		}


		 	 $.ajax({
                    url: '/phpork/gateway/meds.php',
                    type: 'post',
                    data : {
                     subMed: '1',
                     selectMeds: lastMed,
					 medDate: dateGiven,
		             medTime: timeGiven, 
	                 medQty: medQuantity,
		             selUnit: qtyUnit,
		             pigpen: selPig
                    },
                    success: function (data) { 
                      
                      alert("Added!"); 
                          
                     }
                  });


		 	}


		 });

		 


         /*view meds */

         /*view feeds*/
          $('#feeds1').on("click",function() {
          	$('#viewFeeds').attr("style", "display: inline-block");
          	$('#viewFeedsInfo').attr("style", "display: inline-block");
            $('#editFeeds').attr("style", "display: none");
          	$('#viewMovement').attr("style", "display: none");
          	 $('#viewMeds').attr("style", "display: none");

          	 //lamnan yun LAst Feed
        });
          $('#editFeedsButton').on("click",function() {
           $('#viewFeedsInfo').attr("style", "display: none");
            $('#editFeeds').attr("style", "display: inline-block");
            $('#insertFeedsDetails').attr("style", "display: none");

        });

        $('#cancelEditFeeds').on("click",function() {
           $('#viewFeedsInfo').attr("style", "display: inline-block");
            $('#editFeeds').attr("style", "display: none");

        });

        $('#insertFeedsButton').on("click",function() {
           $('#viewFeedsInfo').attr("style", "display: none");
            $('#editFeedsDetails').attr("style", "display: none");
            $('#insertFeedsDetails').attr("style", "display: inline-block");

        });

         $('#selectFeedchoice').on("change",function() {
         	var choice1 = $('#selectFeedchoice').val();
         	console.log(choice1);
	          if(choice1 === "perpenF"){
	          	$('#insertperPenF').attr("style", "display: inline-block");
	          	$('#insertperPigF').attr("style", "display: none");

	          }else if(choice1=== "perpigF"){
	          	$('#insertperPigF').attr("style", "display: inline-block");
	          	$('#insertperPenF').attr("style", "display: none");

	          }
        });

         $('#backToFeeds').on("click",function() {
           $('#viewFeedsInfo').attr("style", "display: inline-block");
            $('#editFeedsDetails').attr("style", "display: none");
            $('#insertFeedsDetails').attr("style", "display: none");

        });

         $.ajax({
          url: '/phpork/gateway/feeds.php',
          type: 'post',
          data : {
           ddl_feeds: '1'
          },
          success: function (data) { 
             var data = jQuery.parseJSON(data); 
                for(i=0;i<data.length;i++){
                  $("#selectFeeds").append($("<option></option>").attr("value",data[i].feed_id)
                    .attr("name","feeds")
                    .text(data[i].feed_name)); 
                }
                   
              } 
          
        });

         $('#selectFeeds').on("change", function() {
               
                 var feed = $("#selectFeeds").val(); 
                  
                  $.ajax({
                    url: '/phpork/gateway/Feeds.php',
                    type: 'post',
                    data : {
                      getFeedsDetails: '1',
                      feed: feed
                    },
                    success: function (data) { 
                       var data = jQuery.parseJSON(data); 
                        $("#feedType").attr("value", data[0].ftype); 
                          
                     }
                  });
         });

         $('#saveInsertFeeds').on("click", function(){
		 	var lastFeed = $('#selectFeeds').val();
		 	var feedType = $('#feedType').val();
		 	var feedProdDate = $('#prodDate').val();
		 	var dateFeedGiven = $('#dateFeedGiven').val();
		 	var timeFeedGiven = $('#timeFeedGiven').val();
		 	var feedQuantity = $('#feedQty').val();
		 	
		 	var choice = $('#selectFeedchoice').val();

		 	if(choice === "perpenF"){

		 		var checkedPenF = document.getElementsByClassName('penclassF');
		 		var selPen = [];

		 		for(var i=0;i<checkedPenF.length; i++){
		 			if(checkedPenF[i].checked){
		 				selPen.push($(checkedPenF[i]).val());
		 			}
		 		}
		 		
			 	 $.ajax({
	                    url: '/phpork/gateway/feeds.php',
	                    type: 'post',
	                    data : {
	                    addFeeds: '1',
	                    selectFeeds: lastFeed,
						fdate: dateFeedGiven, 
						ftime: timeFeedGiven, 
						feedtypeDate: feedProdDate, 
						feedQty: feedQuantity,
						pensel: selPen
	                    },
	                    success: function (data) { 
	                       var data = jQuery.parseJSON(data); 
	                       alert("Added!");
	                     }
	                  });


		 	}else if(choice === "perpigF"){
		 		var checkedPigF = document.getElementsByClassName('pigclassF');
		 		var selPig = [];

		 		alert("pig");
		 		for(var i=0;i<checkedPigF.length; i++){
		 			if(checkedPigF[i].checked){
		 				console.log($(checkedPigF[i]).val());
		 				selPig.push($(checkedPigF[i]).val());
		 			}
		 		}


		 	 $.ajax({
                    url: '/phpork/gateway/feeds.php',
                    type: 'post',
                    data : {
                      addFeeds: '1',
	                  selectFeeds: lastFeed,
					  fdate: dateFeedGiven, 
					  ftime: timeFeedGiven,
					  feedtypeDate: feedProdDate, 
					  feedQty: feedQuantity,
					  pigpen: selPig
                    },
                    success: function (data) { 
                      alert("Added!"); 
                          
                     }
                  });


		 	}


		 });

        
          $('#backToPig').on("click",function() {
           window.location ="/phpork/farm/house/pen/pig/" +farm_id+ "/" +house_id+ "/" +pen_id+ "/" +pig_id;
        });


            
       
      }); 
		function checkAllPig(ele) {
 			 var checkboxes = document.getElementsByClassName('pigclass'); 
 			 if (ele.checked) { 
 			 	for (var i = 0; i < checkboxes.length; i++) {
 			 	 if (checkboxes[i].type == 'checkbox') { 
 			 	 	checkboxes[i].checked = true; 
 			 	 } 
 			 	} 
 			 } else {
 			 	for (var i = 0; i < checkboxes.length; i++) {  
 			 		if (checkboxes[i].type == 'checkbox') { 
 			 			checkboxes[i].checked = false; 
 			 		} 
 			 	} 
 			 } 
 			} 
 			function checkAllPen(ele) {
 			 var checkboxes = document.getElementsByClassName('penclass'); 
 			 if (ele.checked) { 
 			 	for (var i = 0; i < checkboxes.length; i++) {
 			 	 if (checkboxes[i].type == 'checkbox') { 
 			 	 	checkboxes[i].checked = true; 
 			 	 } 
 			 	} 
 			 } else {
 			 	for (var i = 0; i < checkboxes.length; i++) {  
 			 		if (checkboxes[i].type == 'checkbox') { 
 			 			checkboxes[i].checked = false; 
 			 		} 
 			 	} 
 			 } 
 			}

 		function checkAllPigF(ele) {
 			 var checkboxes = document.getElementsByClassName('pigclassF'); 
 			 if (ele.checked) { 
 			 	for (var i = 0; i < checkboxes.length; i++) {
 			 	 if (checkboxes[i].type == 'checkbox') { 
 			 	 	checkboxes[i].checked = true; 
 			 	 } 
 			 	} 
 			 } else {
 			 	for (var i = 0; i < checkboxes.length; i++) {  
 			 		if (checkboxes[i].type == 'checkbox') { 
 			 			checkboxes[i].checked = false; 
 			 		} 
 			 	} 
 			 } 
 			} 
 			function checkAllPenF(ele) {
 			 var checkboxes = document.getElementsByClassName('penclassF'); 
 			 if (ele.checked) { 
 			 	for (var i = 0; i < checkboxes.length; i++) {
 			 	 if (checkboxes[i].type == 'checkbox') { 
 			 	 	checkboxes[i].checked = true; 
 			 	 } 
 			 	} 
 			 } else {
 			 	for (var i = 0; i < checkboxes.length; i++) {  
 			 		if (checkboxes[i].type == 'checkbox') { 
 			 			checkboxes[i].checked = false; 
 			 		} 
 			 	} 
 			 } 
 			}  
		
		function viewPig(pig){
		 	$.ajax({
	        url: '/phpork/gateway/pig.php',
	        type: 'post',
	        data : {
	          getPigDetails: '1',
	          pig_id: pig
	        },
	        success: function (data) { 
	          var data = jQuery.parseJSON(data); 
	             window.location ="/phpork/view/farm/house/pen/pig/" +data[0].loc_id+ "/" +data[0].h_id+ "/" +data[0].p_name+ "/" +data[0].pid;
						
	        }    
	      });


		 }

		var chart = AmCharts.makeChart("linechart_values", {
				 	"dataLoader": {
				    	"url": "/phpork/gateway.php?mvmntChart=1&pig="+<?php echo $_GET['pig']; ?>
					},
				  	"type": "serial",
				    "theme": "light",
				    "marginTop":0,
				    "marginRight": 80,
				    "valueAxes": [{
				        "axisAlpha": 0,
				        "position": "left"
				    }],
				    "graphs": [{
				        "id":"g1",
				        "balloonText": "Location: [[move]]<br><b><span style='font-size:14px;'>Date: [[date]]</span></b>",
				        "bullet": "round",
				        "bulletSize": 8,         
				        "lineColor": "#83b26a",
				        "lineThickness": 2,
				        "negativeLineColor": "#d1655d",
				        "type": "smoothedLine",
				        "valueField": "x"
				    }],
				    "chartScrollbar": {
				        "graph":"g1",
				        "gridAlpha":0,
				        "color":"#bb4230",
				        "scrollbarHeight":55,
				        "backgroundAlpha":0,
				        "selectedBackgroundAlpha":0.1,
				        "selectedBackgroundColor":"#bb4230",
				        "graphFillAlpha":0,
				        "autoGridCount":true,
				        "selectedGraphFillAlpha":0,
				        "graphLineAlpha":0.2,
				        "graphLineColor":"#c2c2c2",
				        "selectedGraphLineColor":"#bb4230",
				        "selectedGraphLineAlpha":1

				    },
				    "chartCursor": {
				        "cursorAlpha": 0,
				        "valueLineEnabled":true,
				        "valueLineBalloonEnabled":true,
				        "valueLineAlpha":0.5,
				        "fullWidth":true,
				        "categoryBalloonColor": "#83b26a"
				    },
				    "categoryField": "week",
				    "categoryAxis": {	
				        "minorGridAlpha": 0.1,
				        "minorGridEnabled": true,
				        "title": "Weeks"
				    },
				    "export": {
				        "enabled": false
				    }
				});
    </script> 

	</body> 
</html>
