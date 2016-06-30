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
	</head> 

	<body> 
		<div class="page-header"> <!-- banner --> 
			<img class="img-responsive" src="<?php echo HOST;?>/phpork/css/images/Header1.png"> 
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
			
			<!--view pig details--> 
			<div style="border: 4px solid; border-color: #bb1d24; border-radius: 10px; margin: 20px; margin-left: 110px; max-width: 20%; margin-top: 3%; max-height: 50%; padding: 2%; float: left; padding-top: 0px; padding-bottom: 1%;">
				
				<div style="width: 50%; height: 50%; margin-left: 25%; margin-top: 10%; margin-bottom: 2%;">
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
				    <a id="editPigDetails" class="" href="/phpork/details/edit/pigDetails">
				        <img class="img-responsive" src="<?php echo HOST;?>/phpork/images/Edit.png"> 
				        <span> Edit Pig</span>
				    </a>
				</div>
				<div class="col-md-2 col-centered imgHolder" style="height: 12%; width: 12%; float: right; margin-top: 5px; padding: 0px; margin-right: 33%;">
				    <a href="/phpork/pages/farm">
				        <img class="img-responsive" src="<?php echo HOST;?>/phpork/images/Pig.png"> 
				        <span> Change Pig</span>
				    </a>
				</div>
			</div>
			<!--view pig details-->

			<!--edit pig details--> 
			<div style="border: 4px solid; border-color: #bb1d24; border-radius: 10px; margin: 20px; margin-left: 110px; max-width: 20%; margin-top: 1%; max-height: 50%; padding: 2%; float: left; padding-top: 0px; padding-bottom: 1%;">
				
				<div style="width: 50%; height: 50%; margin-left: 25%; margin-top: 10%; margin-bottom: 2%;">
					<img class="img-responsive" src="<?php echo HOST;?>/phpork/images/pig1.jpg">
				</div>
			    	
				<div class="info">
					<label>Farm Location: </label><br/>
					<label>Pig id: </label><br/>
					<label>Farrowing Date: </label><br/>
					<label>Gender: </label><br/>
					<label>Breed: </label>
					<hr style="border-color: #9ecf95;">
					<span>Status: </span><input type="text" id="status" name="status"><br/> 
					<span>RFID: </span><input type="text" id="rfid" name="rfid"><br/> 
					<span>Weight: </span><input type="text" id="weight" name="weight"><br/> 
					<span>Weight type: </span><input type="text" id="weight_type" name="weight_type">
					<hr style="border-color: #9ecf95;">
					<span>Parents: </span><br/>
					<span>Boar: </span><br/>
					<span>Sow: </span>
				</div>
				<div class="col-md-2 col-centered imgHolder1" style="height: 12%; width: 12%; margin-top: 2%; padding: 0px; margin-left: 20%;">
					<a id="viewPigDetails" class="" href="/phpork/details/view/pigDetails">
					    <img class="img-responsive" src="<?php echo HOST;?>/phpork/images/Save.png"> 
					    <span> Save</span>
					</a>
				</div>
				<div class="col-md-2 col-centered imgHolder" style="height: 12%; width: 12%; float: right; margin-top: 5px; padding: 0px; margin-right: 33%;">
					<a id="viewPigDetails" class="" href="/phpork/details/view/pigDetails">
					    <img class="img-responsive" src="<?php echo HOST;?>/phpork/images/Cancel.png"> 
					    <span> Cancel</span>
					</a>
				</div>
			</div> 
			<!--edit pig details--> 

			<div style="max-width: 100%; max-height: 100%; margin-left: 30%; margin-top: 2%; padding-right: 0px; margin-right: 0px;">
				<div style="float: left; max-width: 15%; max-height: 30%;">
					<div class="col-md-2 col-centered" style="height: 70%; width: 70%;">
			            <a id="viewMvmntDetails" class="" href="/phpork/viewDetails/view/mvmnt">
			             	<img class="img-responsive" src="<?php echo HOST;?>/phpork/images/Feeds2.png"> <!--movement-->
			            </a>
			        </div>
			        <br/>
			        <div class="col-md-2 col-centered" style="height: 70%; width: 70%;">
			        	<a id="viewMedDetails" class="" href="/phpork/viewDetails/view/meds">
			        	<img class="img-responsive" src="<?php echo HOST;?>/phpork/images/Medications.png">
			        	</a>
			        </div>
			        <br/>
			        <div class="col-md-2 col-centered" style="height: 70%; width: 70%;">
			        	<a id="viewFeedDetails" class="" href="/phpork/viewDetails/view/feeds"> 
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


			     <!--view movement-->
			    <div>
			     	<?php 
					    if(!isset($_GET['section']) || $_GET['section']=='1'){
					?> 
					<script> 
					    $('#viewMvmntDetails').addClass("active-nav"); 
					</script> 
			    <div style="margin-left: 15%; max-width: 100%; padding-top: 0px; padding-left: 0px; margin-right: 13%; margin-top: 0px;">
			    	<label>Currently:	House# Pen#</label>
			    	<button>Visualize</button>
			    	<br/> 
			    	<div style="margin: 0px; max-width: 20%;">
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
						      <td>...</td>
						      <td>...</td>
						      <td>...</td>
						    </tr>
						    <tr>
						      <td>...</td>
						      <td>...</td>
						      <td>...</td>
						    </tr>
						    <tr>
						      <td>...</td>
						      <td>...</td>
						      <td>...</td>
						    </tr>
						    <tr>
						      <td>...</td>
						      <td>...</td>
						      <td>...</td>
						    </tr>
						    <tr>
						      <td>...</td>
						      <td>...</td>
						      <td>...</td>
						    </tr>
						    <tr>
						      <td>...</td>
						      <td>...</td>
						      <td>...</td>
						    </tr>
						    <tr>
						      <td>...</td>
						      <td>...</td>
						      <td>...</td>
						    </tr>
						    <tr>
						      <td>...</td>
						      <td>...</td>
						      <td>...</td>
						    </tr>
						  </tbody>
						</table>
					</div>
					<div style="margin: 0px; max-width: 40%; float: right;">
						<table class="table table-striped">
						  <thead>
						    <tr>
						      <th>Pig id</th>
						      <th>Info</th>
						    </tr>
						  </thead>
						  <tbody >
						    <tr>
						      <td>...</td>
						      <td>...</td>
						    </tr>
						    <tr>
						      <td>...</td>
						      <td>...</td>
						    </tr>
						     <tr>
						      <td>...</td>
						      <td>...</td>
						    </tr>
						    <tr>
						      <td>...</td>
						      <td>...</td>
						    </tr>
						    <tr>
						      <td>...</td>
						      <td>...</td>
						    </tr>
						    <tr>
						      <td>...</td>
						      <td>...</td>
						    </tr>
						     <tr>
						      <td>...</td>
						      <td>...</td>
						    </tr>
						    <tr>
						      <td>...</td>
						      <td>...</td>
						    </tr>
						  </tbody>
						</table>
				</div>
			    </div>
			</div> 
			<!--view movement-->

				<!--view meds-->
				<div> 
					<?php 
					    }else if(!isset($_GET['section']) || $_GET['section']=='2'){
					?> 
					<script> 
					    $('#viewMedDetails').addClass("active-nav"); 
					</script> 
				    <div style="margin-left: 15%; max-width: 100%; padding-top: 2%; padding-left: 0px; margin-right: 13%; margin-top: 0px;">
				    	<div class="col-md-2 col-centered imgHolder2" style="height: 8%; width: 8%; float: right; margin-right: 8%; margin-top: 1%;">
					        <a id="editMedDetails" class="" href="/phpork/viewDetails/edit/meds">
					            <img class="img-responsive" src="<?php echo HOST;?>/phpork/images/Edit.png"> <!--movement-->
					            <span> Edit Medication</span>
					        </a>
				    	</div>
				   		<div class="col-md-2 col-centered imgHolder2" style="height: 8%; width: 8%; float: right; margin-right: 5%; margin-top: 1%;">
					        <a href="#">
					            <img class="img-responsive" src="<?php echo HOST;?>/phpork/images/Insert Feeds.png"> <!--modal-->
					            <span> Insert Medication</span>
					        </a>
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
							      <th>Quantity</th>
							      <th>Date Given</th>
							    </tr>
							  </thead>
							  <tbody class="tb_feeds">
							    <tr  class="tr_feeds">
							      <td>...</td>
							      <td>...</td>
							      <td>...</td>
							      <td>...</td>
							    </tr>
							    <tr  class="tr_feeds">
							      <td>...</td>
							      <td>...</td>
							      <td>...</td>
							      <td>...</td>
							    </tr>
							    <tr  class="tr_feeds">
							      <td>...</td>
							      <td>...</td>
							      <td>...</td>
							      <td>...</td>
							    </tr>
							    <tr  class="tr_feeds">
							      <td>...</td>
							      <td>...</td>
							      <td>...</td>
							      <td>...</td>
							    </tr>
							    <tr  class="tr_feeds">
							      <td>...</td>
							      <td>...</td>
							      <td>...</td>
							      <td>...</td>
							    </tr>
							    <tr  class="tr_feeds">
							      <td>...</td>
							      <td>...</td>
							      <td>...</td>
							      <td>...</td>
							    </tr>
							    <tr  class="tr_feeds">
							      <td>...</td>
							      <td>...</td>
							      <td>...</td>
							      <td>...</td>
							    </tr>
							    <tr  class="tr_feeds">
							      <td>...</td>
							      <td>...</td>
							      <td>...</td>
							      <td>...</td>
							    </tr>
							  </tbody>
							</table>
						</div>
						<br/>
						<div class="col-md-2 col-centered imgHolder2" style="height: 8%; width: 8%; float: right; margin-right: 8%; margin-top: 1%;">
					        <a href="#">
					            <img class="img-responsive" src="<?php echo HOST;?>/phpork/images/Download Report.png"> <!--movement-->
					            <span> Download Report</span>
					        </a>
				    	</div>
					</div>
				</div>
				 <!--view meds-->

				<!--edit meds-->
				<div> 
					<?php 
					    }else if(!isset($_GET['section']) || $_GET['section']=='3'){
					?> 
					<script> 
					    $('#editMedDetails').addClass("active-nav"); 
					</script> 
				    <div style="margin-left: 15%; max-width: 100%; padding-top: 2%; padding-left: 0px; margin-right: 13%; margin-top: 0px;">
				    	<div class="col-md-2 col-centered imgHolder2" style="height: 8%; width: 8%; float: right; margin-right: 8%; margin-top: 1%;">
					        <a id="viewMedDetails" class="" href="/phpork/viewDetails/view/meds"> 
					            <img class="img-responsive" src="<?php echo HOST;?>/phpork/images/Save.png"> <!--movement-->
					            <span> Save</span>
					        </a>
				    	</div>
				   		<div class="col-md-2 col-centered imgHolder2" style="height: 8%; width: 8%; float: right; margin-right: 5%; margin-top: 1%;">
					        <a id="viewMedDetails" class="" href="/phpork/viewDetails/view/meds">
					            <img class="img-responsive" src="<?php echo HOST;?>/phpork/images/Cancel.png"> <!--movement-->
					            <span> Cancel</span>
					        </a>
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
							      <th>Action</th>
							    </tr>
							  </thead>
							  <tbody class="tb_feeds">
							    <tr  class="tr_feeds">
							      <td>...</td>
							      <td>...</td>
							      <td>...</td>
							      <td>...</td>
							    </tr>
							    <tr  class="tr_feeds">
							      <td>...</td>
							      <td>...</td>
							      <td>...</td>
							      <td>...</td>
							    </tr>
							    <tr  class="tr_feeds">
							      <td>...</td>
							      <td>...</td>
							      <td>...</td>
							      <td>...</td>
							    </tr>
							    <tr  class="tr_feeds">
							      <td>...</td>
							      <td>...</td>
							      <td>...</td>
							      <td>...</td>
							    </tr>
							    <tr  class="tr_feeds">
							      <td>...</td>
							      <td>...</td>
							      <td>...</td>
							      <td>...</td>
							    </tr>
							    <tr  class="tr_feeds">
							      <td>...</td>
							      <td>...</td>
							      <td>...</td>
							      <td>...</td>
							    </tr>
							    <tr  class="tr_feeds">
							      <td>...</td>
							      <td>...</td>
							      <td>...</td>
							      <td>...</td>
							    </tr>
							    <tr  class="tr_feeds">
							      <td>...</td>
							      <td>...</td>
							      <td>...</td>
							      <td>...</td>
							    </tr>
							  </tbody>
							</table>
						</div>
					</div>
				</div> 
				<!--edit meds-->

				<!-- Modal for insert meds-->
			    <div id="modalInsertMeds" class="modal fade" role="dialog">
			      <div class="modal-dialog">
			        <div class="modal-content"> <!-- Modal content-->
			          <div class="modal-header">
			            <button type="button" class="close" data-dismiss="modal" id="close">&times;</button>
			            <h4 class="modal-title">Medications</h4>
			          </div>
			          <div class="modal-body">
			          	<input type="text" class="form-control" id="hnum" aria-describedby="basic-addon3">
			          	<br/>
			            <div class="input-group">
			              <span class="input-group-addon" id="basic-addon3">Last medication given: </span>
			              <input type="text" class="form-control" id="hnum" aria-describedby="basic-addon3">
			            </div>
			            <br/>
			            <div class="input-group">
			              <span class="input-group-addon" id="basic-addon3">Date given: </span>
			              <input type="text" class="form-control" id="hname" aria-describedby="basic-addon3">
			            </div>
			            <br/>
			            <div class="input-group">
			              <span class="input-group-addon" id="basic-addon3">Time given: </span>
			              <input type="text" class="form-control" id="hname" aria-describedby="basic-addon3">
			            </div>
			            <br/>
			            <div class="input-group">
			              <span class="input-group-addon" id="basic-addon3">Quantity: </span>
			              <input type="text" class="form-control" id="hname" aria-describedby="basic-addon3">
			            </div>
			            <br/>
			          </div>
			          <div class="modal-footer">
			            <button type="button" class="btn btn-default" data-dismiss="modal" id="save">Insert Medications</button>
			          </div>
			        </div>
			      </div> 
			      <!-- Modal for insert meds-->

			      <!-- Modal for download report(meds)-->
			    	<div id="modalInsertMeds" class="modal fade" role="dialog">
				      <div class="modal-dialog">
				      	
				        <div class="modal-content"> <!-- Modal content-->
				          <div class="modal-header">
				            <button type="button" class="close" data-dismiss="modal" id="close">&times;</button>
				            <h4 class="modal-title">Reports for Medications</h4>
				          </div>
				          <div class="modal-body">
				            <div class="input-group">
				              <span class="input-group-addon" id="basic-addon3">Save as: </span>
				              <input type="text" class="form-control" id="hnum" aria-describedby="basic-addon3">
				            </div>
				            <br/>
				            <div class="input-group">
				              <span class="input-group-addon" id="basic-addon3">File extension: </span>
				              <input type="text" class="form-control" id="hname" aria-describedby="basic-addon3">
				            </div>
				            <br/>
				          </div>
				          <div class="modal-footer">
				            <button type="button" class="btn btn-default" data-dismiss="modal" id="save">Download</button>
				          </div>
				        </div>
			      	</div> 
			      	<!-- Modal for download report(meds)-->


			    <!--view feeds-->
				<div> 
					<?php 
					    }else if(!isset($_GET['section']) || $_GET['section']=='4'){
					?> 
					<script> 
					    $('#viewFeedDetails').addClass("active-nav"); 
					</script> 
				    <div style="margin-left: 15%; max-width: 100%; padding-top: 2%; padding-left: 0px; margin-right: 13%; margin-top: 0px;">
				    	<div class="col-md-2 col-centered imgHolder2" style="height: 8%; width: 8%; float: right; margin-right: 8%; margin-top: 1%;">
					        <a id="editFeedDetails" class="" href="/phpork/viewDetails/edit/feeds">
					            <img class="img-responsive" src="<?php echo HOST;?>/phpork/images/Edit.png"> <!--movement-->
					            <span> Edit Feed</span>
					        </a>
				    	</div>
				   		<div class="col-md-2 col-centered imgHolder2" style="height: 8%; width: 8%; float: right; margin-right: 5%; margin-top: 1%;">
					        <a href="#">
					            <img class="img-responsive" src="<?php echo HOST;?>/phpork/images/Insert Feeds.png"> <!--modal-->
					            <span> Insert Feed</span>
					        </a>
				    	</div>
				    	<div>
					    	<label>Last feed given: </label><br/>
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
							      <th>Quantity</th>
							      <th>Production Date</th>
							      <th>Date Given</th>
							    </tr>
							  </thead>
							  <tbody class="tb_feeds">
							    <tr  class="tr_feeds">
							      <td>...</td>
							      <td>...</td>
							      <td>...</td>
							      <td>...</td>
							      <td>...</td>
							    </tr>
							    <tr  class="tr_feeds">
							      <td>...</td>
							      <td>...</td>
							      <td>...</td>
							      <td>...</td>
							      <td>...</td>
							    </tr>
							    <tr  class="tr_feeds">
							      <td>...</td>
							      <td>...</td>
							      <td>...</td>
							      <td>...</td>
							      <td>...</td>
							    </tr>
							    <tr  class="tr_feeds">
							      <td>...</td>
							      <td>...</td>
							      <td>...</td>
							      <td>...</td>
							      <td>...</td>
							    </tr>
							    <tr  class="tr_feeds">
							      <td>...</td>
							      <td>...</td>
							      <td>...</td>
							      <td>...</td>
							      <td>...</td>
							    </tr>
							    <tr  class="tr_feeds">
							      <td>...</td>
							      <td>...</td>
							      <td>...</td>
							      <td>...</td>
							      <td>...</td>
							    </tr>
							    <tr  class="tr_feeds">
							      <td>...</td>
							      <td>...</td>
							      <td>...</td>
							      <td>...</td>
							      <td>...</td>
							    </tr>
							    <tr  class="tr_feeds">
							      <td>...</td>
							      <td>...</td>
							      <td>...</td>
							      <td>...</td>
							      <td>...</td>
							    </tr>
							  </tbody>
							</table>
						</div>
						<br/>
						<div class="col-md-2 col-centered imgHolder2" style="height: 8%; width: 8%; float: right; margin-right: 8%; margin-top: 1%;">
					        <a href="#">
					            <img class="img-responsive" src="<?php echo HOST;?>/phpork/images/Download Report.png"> <!--movement-->
					            <span> Download Report</span>
					        </a>
				    	</div>
					</div>
				</div> 
				<!--view feeds-->

				<!--edit feeds-->
				<div> 
					<?php 
					    }else if(!isset($_GET['section']) || $_GET['section']=='5'){
					?> 
					<script> 
					    $('#editFeedDetails').addClass("active-nav"); 
					</script> 
				    <div style="margin-left: 15%; max-width: 100%; padding-top: 2%; padding-left: 0px; margin-right: 13%; margin-top: 0px;">
				    	<div class="col-md-2 col-centered imgHolder2" style="height: 8%; width: 8%; float: right; margin-right: 8%; margin-top: 1%;">
					        <a id="viewFeedDetails" class="" href="/phpork/viewDetails/view/feeds"> 
					            <img class="img-responsive" src="<?php echo HOST;?>/phpork/images/Save.png"> <!--movement-->
					            <span> Save Feed</span>
					        </a>
				    	</div>
				   		<div class="col-md-2 col-centered imgHolder2" style="height: 8%; width: 8%; float: right; margin-right: 5%; margin-top: 1%;">
					        <a id="viewFeedDetails" class="" href="/phpork/viewDetails/view/feeds">
					            <img class="img-responsive" src="<?php echo HOST;?>/phpork/images/Cancel.png"> <!--movement-->
					            <span> Cancel Edit</span>
					        </a>
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
							      <th>Action</th>
							    </tr>
							  </thead>
							  <tbody class="tb_feeds">
							    <tr  class="tr_feeds">
							      <td>...</td>
							      <td>...</td>
							      <td>...</td>
							      <td>...</td>
							      <td>...</td>
							    </tr>
							    <tr  class="tr_feeds">
							      <td>...</td>
							      <td>...</td>
							      <td>...</td>
							      <td>...</td>
							      <td>...</td>
							    </tr>
							    <tr  class="tr_feeds">
							      <td>...</td>
							      <td>...</td>
							      <td>...</td>
							      <td>...</td>
							      <td>...</td>
							    </tr>
							    <tr  class="tr_feeds">
							      <td>...</td>
							      <td>...</td>
							      <td>...</td>
							      <td>...</td>
							      <td>...</td>
							    </tr>
							    <tr  class="tr_feeds">
							      <td>...</td>
							      <td>...</td>
							      <td>...</td>
							      <td>...</td>
							      <td>...</td>
							    </tr>
							    <tr  class="tr_feeds">
							      <td>...</td>
							      <td>...</td>
							      <td>...</td>
							      <td>...</td>
							      <td>...</td>
							    </tr>
							    <tr  class="tr_feeds">
							      <td>...</td>
							      <td>...</td>
							      <td>...</td>
							      <td>...</td>
							      <td>...</td>
							    </tr>
							    <tr  class="tr_feeds">
							      <td>...</td>
							      <td>...</td>
							      <td>...</td>
							      <td>...</td>
							      <td>...</td>
							    </tr>
							  </tbody>
							</table>
						</div>
					</div>
				</div> 
				<!--edit feeds-->

				<!-- Modal for insert feeds-->
			    <div id="modalInsertFeeds" class="modal fade" role="dialog">
			      <div class="modal-dialog">
			        <div class="modal-content"> <!-- Modal content-->
			          <div class="modal-header">
			            <button type="button" class="close" data-dismiss="modal" id="close">&times;</button>
			            <h4 class="modal-title">Feeds</h4>
			          </div>
			          <div class="modal-body">
			          	<input type="text" class="form-control" id="hnum" aria-describedby="basic-addon3">
			          	<br/>
			            <div class="input-group">
			              <span class="input-group-addon" id="basic-addon3">Last feed given: </span>
			              <input type="text" class="form-control" id="hnum" aria-describedby="basic-addon3">
			            </div>
			            <br/>
			            <div class="input-group">
			              <span class="input-group-addon" id="basic-addon3">Production date: </span>
			              <input type="text" class="form-control" id="hname" aria-describedby="basic-addon3">
			            </div>
			            <br/>
			            <div class="input-group">
			              <span class="input-group-addon" id="basic-addon3">Quantity: </span>
			              <input type="text" class="form-control" id="hname" aria-describedby="basic-addon3">
			            </div>
			            <br/>
			            <div class="input-group">
			              <span class="input-group-addon" id="basic-addon3">Date given: </span>
			              <input type="text" class="form-control" id="hname" aria-describedby="basic-addon3">
			            </div>
			            <br/>
			            <div class="input-group">
			              <span class="input-group-addon" id="basic-addon3">Time given: </span>
			              <input type="text" class="form-control" id="hname" aria-describedby="basic-addon3">
			            </div>
			            <br/>
			          </div>
			          <div class="modal-footer">
			            <button type="button" class="btn btn-default" data-dismiss="modal" id="save">Insert Feeds</button>
			          </div>
			        </div>
			      </div> 
			      <!-- Modal for insert feeds-->

			      <!-- Modal for download report(feeds)-->
			    	<div id="modalInsertFeeds" class="modal fade" role="dialog">
				      <div class="modal-dialog">
				        <div class="modal-content"> <!-- Modal content-->
				          <div class="modal-header">
				            <button type="button" class="close" data-dismiss="modal" id="close">&times;</button>
				            <h4 class="modal-title">Reports for Feeds</h4>
				          </div>
				          <div class="modal-body">
				            <div class="input-group">
				              <span class="input-group-addon" id="basic-addon3">Save as: </span>
				              <input type="text" class="form-control" id="hnum" aria-describedby="basic-addon3">
				            </div>
				            <br/>
				            <div class="input-group">
				              <span class="input-group-addon" id="basic-addon3">File extension: </span>
				              <input type="text" class="form-control" id="hname" aria-describedby="basic-addon3">
				            </div>
				            <br/>
				          </div>
				          <div class="modal-footer">
				            <button type="button" class="btn btn-default" data-dismiss="modal" id="save">Download</button>
				          </div>
				        </div>
			      	</div> 
			      	<!-- Modal for download report(feeds)-->

				 <?php
      				}
   				?>	
			</div>
		</div>
	
  
	
	<div class="page-footer"> 
		Prototype Pork Traceability System || Copyright &copy; 2014 - <?php echo date("Y");?> UPLB || funded by PCAARRD 
	</div> 

	</body> 
</html>