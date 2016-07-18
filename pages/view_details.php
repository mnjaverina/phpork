<!-- * PROTOTYPE PORK TRACEABILITY SYSTEM * Copyright © 2014 UPLB. --> 
<!DOCTYPE HTML> 
<html lang="en"> 
	<?php 
		session_start(); 
		if(!isset($_SESSION['username']) || !isset($_SESSION['password'])) {
			header("Location: /phpork/in"); 
		}
		require_once "../connect.php"; 
		require_once "../inc/dbinfo.inc"; 
		include "../inc/functions.php";
		
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
		<div class="page-header" data-trigger= "hover" data-toggle="tooltip" title="Click to go back to home page which is 'View', 'Insert' and 'Customize' " data-placement="bottom"> 
	      <a href="/phpork/encoder/home" >
	        <img class="img-responsive" src="<?php echo HOST;?>/phpork/images/Header1.png"> 
	      </a>
    	</div>
		<form class="form-horizontal col-xs-10 col-sm-10 col-md-10 col-lg-10"  method="post" action="/phpork/out" style="width:50%; float:right;"> 
	      <div class="form-group logout" > 
	        <input type="text" class="col-xs-6 col-sm-5" readonly style="text-align: left; border: 2px solid; border-color: #83b26a;" value="<?php echo $_SESSION['username'];?>"> 
	        <div class="col-xs-1 col-sm-1" style="left: -1%;"> 
	          <button type="submit" class="btn btn-primary btn-sm" >Logout</button> 
	        </div> 
	      </div> 
	    </form>  
		
		<!--PIG DETAILS-->	
		<div class="pigdet-maindiv">	
			<!--VIEW PIG DETAILS-->	
			<div class="img-pig">
				<img class="img-responsive" src="<?php echo HOST;?>/phpork/images/pig1.jpg">
			</div>
				
			<div id="viewPig" style="display: inline-block;">
				<div class="info" id="viewPigDetails">
				</div>
				<br/>
				<div class="col-md-2 col-centered imgHolder1">
					<button id="editPigButton" class="imgBtn">
						<img class="img-responsive" src="<?php echo HOST;?>/phpork/images/Edit.png"> 
						<span>Edit Pig</span>
					</button>
				</div>
				<div class="col-md-2 col-centered imgHolder">
					<button id="changePig" class="imgBtn">
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
				<div class="col-md-2 col-centered imgHolder4">
					<button id="saveEditPig" class="imgBtn">
						<img class="img-responsive" src="<?php echo HOST;?>/phpork/images/Save.png"> 
						<span> Save</span>
					</button>
				</div>
				<div class="col-md-2 col-centered imgHolder5">
					<button id="cancelEditPig" class="imgBtn">
						<img class="img-responsive" src="<?php echo HOST;?>/phpork/images/Cancel.png"> 
						<span> Cancel</span>
					</button>
				</div>
			</div>
			<!--EDIT PIG DETAILS-->
		</div>	

		<!--Icons-->
		<div class="icons-maindiv"> 
			<div class="col-md-2 col-centered icons-img">
				<button id="movement" class="imgBtn">
			       <img class="img-responsive" id="movement" src="<?php echo HOST;?>/phpork/images/Movement.png">
			    </button>
			</div>
			<br/>
			<div class="col-md-2 col-centered icons-img1">
			    <button id="medication" class="imgBtn">
			        <img class="img-responsive"  src="<?php echo HOST;?>/phpork/images/Medications.png">
			    </button>
			</div>
			<br/>
			<div class="col-md-2 col-centered icons-img1">
			    <button id="feeds" class="imgBtn">
			        <img class="img-responsive" src="<?php echo HOST;?>/phpork/images/Feeds2.png">
			    </button> 
			</div>
			<br/>
			<div class="col-md-2 col-centered icons-img1">
			    <button id="weight" class="imgBtn">
			        <img class="img-responsive" src="<?php echo HOST;?>/phpork/images/Weight.png">
			    </button>
			</div>
			<br/>
			<div class="col-md-2 col-centered icons-img1">
			    <button id="backToPig" class="imgBtn">
			        <img class="img-responsive" src="<?php echo HOST;?>/phpork/images/Arrow Left.png">
			    </button> 
			</div>	
		</div>
		<!--Icons-->

		<!--VIEWS-->
		<div class="content-maindiv">
			<!--view movement-->
			<div id="viewMovement" style="display: inline-block;">
			    <div id="viewMovementDetails" class="mvmnt-div">
			    	<div id="pigMovementInfo">
			    	</div>
			    	<button id="visualizeButton">Visualize</button>
			    	<div class="col-md-2 col-centered imgHolder3">
					    <button id="mvmntRprt" class="imgBtn" data-toggle="modal" data-target="#myModalReportMvmnt">
					        <img class="img-responsive" src="<?php echo HOST;?>/phpork/images/Download Report.png">
					        <span> Download Report</span>
					    </button>
				    </div>
			    	<div class="mvmnt-table">
				    	<table class="table table-striped table1">
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
					<div class="mvmnt-table">
						<table class="table table-striped table1">
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
			    </div>
			    <div id="viewMovementGraph" style="display: none;" > 
			    	<div class="col-md-2 col-centered imgHolder6">
					    <button id="backToMovement" class="imgBtn">
					        <img class="img-responsive" src="<?php echo HOST;?>/phpork/images/Arrow Left.png"> 
					        <span> Back</span>
					    </button>
				    </div>
			    	<div id="linechart_values">
			    	</div> 
			    </div>
			</div> 
			<!--view movement-->

			<!--MEDICATION-->
			<div id="viewMeds" style="display: none;"> 
				<!--view medication-->
				<div id="viewMedsInfo" class="med-div">
				    <div class="col-md-2 col-centered imgHolder9">
					     <button id="editMedsButton" class="imgBtn">
					            <img class="img-responsive" src="<?php echo HOST;?>/phpork/images/Edit.png">
					            <span> Edit Medication</span>
					        </button>
				    </div>
				    <div class="col-md-2 col-centered imgHolder7">
					        <button id="insertMedsButton" class="imgBtn">
					            <img class="img-responsive" src="<?php echo HOST;?>/phpork/images/Insert Medications.png">
					            <span> Insert Medication</span>
					        </button>
				    </div>
				    <div id="lastMedInfo">
					    <label>Last medication given: </label><br/>
				    </div>
				    <div class="med-table">
					    <table class="table table-striped table2">
							<thead>
							    <tr>
							    	<th>Medication Name</th>
							    	<th>Medication Type</th>
							    	<th>Quantity</th>
							    	<th>Date Given</th>
							    </tr>
							</thead>
							<tbody id="viewMedsBody">
							</tbody>
						</table>
					</div>
					<div class="col-md-2 col-centered imgHolder8">
					    <button id ="medsRprt" class="imgBtn" data-toggle="modal" data-target="#myModalReportMeds">
					        <img class="img-responsive" src="<?php echo HOST;?>/phpork/images/Download Report.png">
					        <span> Download Report</span>
					    </button>
				    </div>
				</div> <!--END view medication-->
				
				<!--edit medication-->
				<div id="editMedsDetails" style="display: none;"> 
					<div class="med-div">
					   	<div class="col-md-2 col-centered imgHolder9">
						    <button id="saveEditMeds" class="imgBtn"> 
						        <img class="img-responsive" src="<?php echo HOST;?>/phpork/images/Save.png"> 
						        <span> Save Medication</span>
						    </button>
					   	</div>
					   	<div class="col-md-2 col-centered imgHolder7">
						    <button id="cancelEditMeds" class="imgBtn">
						        <img class="img-responsive" src="<?php echo HOST;?>/phpork/images/Cancel.png">
						        <span> Cancel Medication</span>
						    </button>
					   	</div>
					    <div id="lastMedInfoEdit">
						    <label>Last medication given: </label><br/>
					    </div>
					    <div class="med-table">
						    <table class="table table-striped table2">
								<thead>
								    <tr>
								      <th>Medication Name</th>
								      <th>Medication Type</th>
								      <th>Edit to</th>
								    </tr>
								</thead>
								<tbody id="editMedsBody">
								</tbody>
							</table>
						</div>
					</div>
				</div> <!--END edit medication-->

				<!--insert medication-->
				<div id="insertMedsDetails" style="display: none;"> 
				    <div class="med-div">
				    	<div class="col-md-2 col-centered imgHolder10">
					       <button id="saveInsertMeds" class="imgBtn">
					            <img class="img-responsive" src="<?php echo HOST;?>/phpork/images/Insert.png">
					            <span>Insert</span>
					        </button>
				    	</div>
				   		<div class="col-md-2 col-centered imgHolder11">
					        <button id="backToMeds" class="imgBtn">
					            <img class="img-responsive" src="<?php echo HOST;?>/phpork/images/Arrow Left.png">
					            <span>Back</span>
					        </button>
				    	</div>
				    	<div id="insertMedsBody" class="insert-div">
		 					<select name="selChoice"  id="selectMedchoice" class="select-insert">
		 						<option value="" disabled selected>Select if per pen or per pig..</option> 
			 					<option value="perpen"> Select per pen</option>
			 					<option value="perpig">Select per pig</option>
			 				</select>
			 				<br/>
				 			<div id="insertperPen" style="display: none;">
				 				<input type="checkbox" value="selectAllPen" onchange='checkAllPen(this)' >Select All Pens</input>
				 				<br/>
				 			</div>
				 			<div id="insertperPig" style="display: none;">
				 				<input type="checkbox" value="selectAllPig" onchange='checkAllPig(this)' >Select All Pigs</input>
				 				<br/>
				 			</div>
							<div>
								<table class="table table-striped table5" id="insertMeds"> 
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
					</div>
				</div> <!--END insert medication-->
			</div> <!--END MEDICATION-->
			
			<!--FEEDS-->
			<div id="viewFeeds" style="display: none;"> 
				<!--view feeds-->
				<div id="viewFeedsInfo" class="med-div">
					<div class="col-md-2 col-centered imgHolder9">
						<button id="editFeedsButton" class="imgBtn">
					            <img class="img-responsive" src="<?php echo HOST;?>/phpork/images/Edit.png">
					            <span> Edit Feeds</span>
					        </button>
					</div>
					<div class="col-md-2 col-centered imgHolder7">
					        <button id="insertFeedsButton" data-toggle="modal" data-target="#modalInsertFeeds" class="imgBtn">
					            <img class="img-responsive" src="<?php echo HOST;?>/phpork/images/Insert Feeds.png">
					            <span> Insert Feeds</span>
					        </button>
				    </div>
					<div id="lastFeedInfo">
						<label>Last feed given: </label><br/>
						
					</div>
					<div class="med-table">
						<table class="table table-striped table2">
							<thead>
								<tr>
								    <th>Feed Name</th>
								    <th>Feed Type</th>
								    <th>Quantity</th>
								    <th>Production Date</th>
								    <th>Date Given</th>
								</tr>
							</thead>
							<tbody id="viewFeedsBody">
							</tbody>
						</table>
					</div>
					<div class="col-md-2 col-centered imgHolder8">
						<button id ="feedsRprt" class="imgBtn" data-toggle="modal" data-target="#myModalReportFeeds">
					        <img class="img-responsive" src="<?php echo HOST;?>/phpork/images/Download Report.png">
					        <span> Download Report</span>
					    </button>
					</div>
				</div> <!--END view feeds-->

				<!--edit feeds-->
				<div id="editFeeds" style="display: none;"> 
				    <div class="med-div">
				    	<div class="col-md-2 col-centered imgHolder9">
					        <button id="saveEditFeeds" class="imgBtn"> 
					            <img class="img-responsive" src="<?php echo HOST;?>/phpork/images/Save.png">
					            <span> Save Feed</span>
					        </button>
				    	</div>
				   		<div class="col-md-2 col-centered imgHolder7">
					        <button id="cancelEditFeeds" class="imgBtn">
					            <img class="img-responsive" src="<?php echo HOST;?>/phpork/images/Cancel.png"> 
					            <span> Cancel Feed</span>
					        </button>
				    	</div>
				    	<div id="lastFeedInfoEdit">
					    	<label>Last feed type: </label><br/>
				    	</div>
				    	<div class="med-table">
					    	<table class="table table-striped table2">
							  <thead>
							    <tr class="tr_feeds">
							      <th>Feed Name</th>
							      <th>Feed Type</th>
							      <th>Production Date</th>
							      <th>Edit to</th>
							    </tr>
							  </thead>
							  <tbody id="editFeedsBody">
							  </tbody>
							</table>
						</div>
					</div>
				</div> <!--END edit feeds-->

				<!-- insert feeds --> 
				<div id="insertFeedsDetails" style="display: none;"> 
				    <div class="med-div">
				    	<div class="col-md-2 col-centered imgHolder10">
					       <button id="saveInsertFeeds" class="imgBtn">
					            <img class="img-responsive" src="<?php echo HOST;?>/phpork/images/Insert.png"> 
					            <span>Insert</span>
					        </button>
				    	</div>
				   		<div class="col-md-2 col-centered imgHolder11">
					        <button id="backToFeeds" class="imgBtn">
					            <img class="img-responsive" src="<?php echo HOST;?>/phpork/images/ArroW Left.png"> 
					            <span>Back</span>
					        </button>
				    	</div>
				    	<div id="insertFeedsBody" class="insert-div">
		 					<select name="selChoice"  id="selectFeedchoice" class="select-insert">
		 						<option value="" disabled selected>Select if per pen or per pig..</option> 
			 					<option value="perpenF"> Select per pen</option>
			 					<option value="perpigF">Select per pig</option>
			 				</select>
			 				<div id="insertperPenF" style="display: none;">
			 					<input type="checkbox" value="selectAllPen" onchange='checkAllPenF(this)' >Select All Pens</input>
			 					<br/>
			 				</div>
			 				<div id="insertperPigF" style="display: none;">
			 					<input type="checkbox" value="selectAllPig" onchange='checkAllPigF(this)' >Select All Pigs</input>
			 					<br/>
			 				</div>
							<div>
								<table class="table table-striped table4" id="insertFeeds"> 
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
					</div>
				</div> <!-- END insert feeds -->
			</div> <!--END FEEDS-->
			

			<!--WEIGHT-->
			<div id="viewWeight" style="display: none;">
				<!--view weight-->
			    <div id="viewWeightInfo" class="weight-div">
			    	<div class="col-md-2 col-centered imgHolder12">
				    	<button id ="weightRprt" class="imgBtn" data-toggle="modal" data-target="#myModalReportWeight">
					        <img class="img-responsive" src="<?php echo HOST;?>/phpork/images/Download Report.png">
					        <span> Download Report</span>
					    </button>
					</div>
					<div class="col-md-2 col-centered imgHolder13">
					    <button id="insertWeightButton" class="imgBtn">
							<img class="img-responsive" src="<?php echo HOST;?>/phpork/images/Weight.png"> 
							<span> Insert Weight</span>
						</button>
					</div>
					<div id="weightGraph" class="weight-graph"></div>
					<div id="columnchart_values" style="margin: 0px;"> </div>
				</div> <!--END view weight-->
				
				<!-- insert weight -->
				<div id="insertWeightDetails" style="display: none;"> 
				    <div class="med-div">
				    	<div class="col-md-2 col-centered imgHolder10">
					       <button id="saveInsertWeight" class="imgBtn">
					            <img class="img-responsive" src="<?php echo HOST;?>/phpork/images/Insert.png"> 
					            <span>Insert</span>
					        </button>
				    	</div>
				   		<div class="col-md-2 col-centered imgHolder11">
					        <button id="backToWeight" class="imgBtn">
					            <img class="img-responsive" src="<?php echo HOST;?>/phpork/images/Arrow Left.png">
					            <span>Back</span>
					        </button>
				    	</div>
				    	<div id="insertMedsBody" class="insert-div">
		 					<select name="selChoice"  id="selectWeightchoice" class="select-insert">
		 						<option value="" disabled selected>Select if per batch or per pig..</option> 
			 					<option value="perbatch"> Select per batch</option>
			 					<option value="perpigW">Select per pig</option>
			 				</select>
			 				<div id="insertperBatch" style="display: none;">
			 					<input type="checkbox" value="selectAllBatch" onchange='checkAllBatchW(this)' >Select All Batches</input>
			 					<br/>
			 				</div>
			 				<div id="insertperPigW" style="display: none;">
			 					<input type="checkbox" value="selectAllPig" onchange='checkAllPigW(this)' >Select All Pigs</input>
			 					<br/>
			 				</div>
							<div>
								<table class="table table-striped table6" id="insertWeight"> 
									<tr> 
										<td> Weight: 
											<input type="number" id="addWeight" name="medQty" min="0.01"  step="0.01" style="color:black;border-radius:5px;height:25px;"/> &nbsp; kg
										</td>
									</tr>
									<tr>
										<td> Weight type:
											<input type="text" id="addWeightType"></input>
										</td>

									</tr>
									<tr> 
										<td> Date Weighed: <input type="date" class="form-control" id="dateWeighed" aria-describedby="basic-addon3" placeholder="mm/dd/yyyy"/>
										</td>
									</tr>
									<tr> 
										<td> Time Weighed: <input type="time" class="form-control" id="timeWeighed" aria-describedby="basic-addon3"/>
										</td>
									</tr>
								</table>
							</div>
		 				</div>
					</div>
				</div><!--END insert weight-->
			</div> <!--END WEIGHT-->
		</div>
		<!--END VIEWS-->

		<!--REPORTS-->
		<!-- Modal for Movement Details Report-->
		<div id="myModalReportMvmnt" class="modal fade" role="dialog">
		    <div class="modal-dialog">
		        <div class="modal-content">
			        <div class="modal-header">
			            <button type="button" class="close" data-dismiss="modal" id="close">&times;</button>
			            <h4 class="modal-title">Download Movement Details Report</h4>
			        </div>
			        <div class="modal-body"> 
					    <div class="input-group">
					        <span class="input-group-addon" id="basic-addon3">From: </span>
					        <input style="height: 5%;" type="date" class="form-control" id="from" aria-describedby="basic-addon3" required>
						</div>
				    	<br/>
				        <div class="input-group">
				            <span class="input-group-addon" id="basic-addon3">To: </span>
				            <input style="height: 5%;" type="date" class="form-control" id="to" aria-describedby="basic-addon3" required>
				        </div>
			        </div>
			        <div class="modal-footer">
			        	<button type="submit" class="btn btn-default" data-dismiss="modal" id="gen_mvmntrprt">Download</button>
			        </div>
		        </div>
		    </div>
	    </div>

	    <!-- Modal for Medication Details Report-->
	    <div id="myModalReportMeds" class="modal fade" role="dialog" >
		    <div class="modal-dialog">
		        <div class="modal-content">
			        <div class="modal-header">
			        	<button type="button" class="close" data-dismiss="modal" id="close">&times;</button>
			            <h4 class="modal-title">Download Medication Details Report</h4>
			        </div>
			        <div class="modal-body"> 
				        <div class="input-group">
				            <span class="input-group-addon" id="basic-addon3">From: </span>
				            <input style="height: 5%;" type="date" class="form-control" id="fromMeds" aria-describedby="basic-addon3" required>
				        </div>
				        <br/>
				        <div class="input-group">
				            <span class="input-group-addon" id="basic-addon3">To: </span>
				            <input style="height: 5%;" type="date" class="form-control" id="toMeds" aria-describedby="basic-addon3" required>
				        </div>
			        </div>
			        <div class="modal-footer">
			            <button type="submit" class="btn btn-default" data-dismiss="modal" id="gen_medsrprt">Download</button>
			        </div>
		        </div>
		    </div>
	    </div>

	    <!-- Modal for Feed Details Report-->
	    <div id="myModalReportFeeds" class="modal fade" role="dialog" >
		    <div class="modal-dialog">
		        <div class="modal-content"> 
			        <div class="modal-header">
			            <button type="button" class="close" data-dismiss="modal" id="close">&times;</button>
			            <h4 class="modal-title">Download Feed Details Report</h4>
			        </div>
			        <div class="modal-body"> 
			            <div class="input-group">
				            <span class="input-group-addon" id="basic-addon3">From: </span>
				            <input style="height: 5%;" type="date" class="form-control" id="fromFeeds" aria-describedby="basic-addon3" required>
				        </div>
				        <br/>
				        <div class="input-group">
				            <span class="input-group-addon" id="basic-addon3">To: </span>
				            <input style="height: 5%;" type="date" class="form-control" id="toFeeds" aria-describedby="basic-addon3" required>
				        </div> 
			        </div>
			        <div class="modal-footer">
			            <button type="submit" class="btn btn-default" data-dismiss="modal" id="gen_feedsrprt">Download</button>
			        </div>
		        </div>
		    </div>
	    </div>

	     <!-- Modal for Weight Details Report-->
	    <div id="myModalReportWeight" class="modal fade" role="dialog" >
		    <div class="modal-dialog">
		        <div class="modal-content"> <!-- Modal content-->
			        <div class="modal-header">
			            <button type="button" class="close" data-dismiss="modal" id="close">&times;</button>
			            <h4 class="modal-title">Download Weight Details Report</h4>
			        </div>
			        <div class="modal-body"> 
				        <div class="input-group">
				            <span class="input-group-addon" id="basic-addon3">From: </span>
				            <input style="height: 5%;" type="date" class="form-control" id="fromWeight" aria-describedby="basic-addon3" required>
				        </div>
				        <br/>
				        <div class="input-group">
				            <span class="input-group-addon" id="basic-addon3">To: </span>
				            <input style="height: 5%;" type="date" class="form-control" id="toWeight" aria-describedby="basic-addon3" required>
				        </div>
			        </div>
			        <div class="modal-footer">
			            <button type="submit" class="btn btn-default" data-dismiss="modal" id="gen_weightrprt">Download</button>
			          </div>
			        </div>
		    	</div>
	    	</div>
	    </div>

		<div class="page-footer"> 
			Prototype Pork Traceability System || Copyright &copy; 2014 - <?php echo date("Y");?> UPLB || funded by PCAARRD 
		</div> 

<!--Script-->
	
	<div>
	  <?php
        $pig = $_GET['pig'];
        $pen = $_GET['pen'];
        $house =$_GET['house'];
        $farm = $_GET['location'];
        $u = $_SESSION['user_id']; 
        echo "<input type='hidden' value='$u' name='user' id='userId'/>";
        echo "<input type='hidden' value='$pig' name='pig' id='pigid'/>";
        echo "<input type='hidden' value='$pen' name='pig' id='penid'/>"; 
        echo "<input type='hidden' value='$house' name='pig' id='houseid'/>"; 
        echo "<input type='hidden' value='$farm' name='pig' id='farmid'/>"; 
         
      ?>
    </div>

	<script src="<?php echo HOST;?>/phpork/js/amcharts/plugins/dataloader/dataloader.min.js" type="text/javascript"></script>
	<script type="text/javascript"> 
      $(document).ready(function () {
      	var pig_id = $('#pigid').val();
      	var pen_id = $('#penid').val();
      	var house_id = $('#houseid').val();
      	var farm_id = $('#farmid').val();
      	var editedMedications =[];
      	var editedFeeds =[];

      	 $.ajax({
	        url: '/phpork/gateway/pig.php',
	        type: 'post',
	        data : {
	          getPigDetails: '1',
	          pig_id: pig_id
	        },
	        success: function (data) { 
	          var data = jQuery.parseJSON(data); 
	            $("#viewPigDetails").append($("<label></label>").text("Pig label:                  "  +data[0].label));
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
	            $("#viewPigDetails").append($("<label></label>").text("Parents:                       "));
	            $("#viewPigDetails").append($("<br/>")); 
	            $("#viewPigDetails").append($("<span></span>").text("Boar:            "  +data[0].boar));
	            $("#viewPigDetails").append($("<br/>")); 
	            $("#viewPigDetails").append($("<span></span>").text("Sow:                  "  +data[0].sow));
	            $("#viewPigDetails").append($("<br/>"));         
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
	        url: '/phpork/gateway/movement.php',
	        type: 'post',
	        data : {
	          getWeekDateMvmnt: '1',
	          pig: pig_id
	        },
	        success: function (data) { 
	          var data = jQuery.parseJSON(data); 
	           for(i=0;i<data.length;i++){
           			$("#viewMovementBody").append($("<tr><td>" +data[i].date+ "</td><td>" +data[i].time_moved+ "</td><td>Pen " +data[i].pen+ "</td></tr>"));
	           		

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

			             $('#insertperPigW').append($('<input type="checkbox" class="pigclassW" value="'+data[i].pig_id+'">'+data[i].lbl+'</input>'));
			             $('#insertperPigW').append($('<br/>'));

		            }
								
			        }    
			      });
		 $.ajax({
			        url: '/phpork/gateway/pig.php',
			        type: 'post',
			        data : {
			          ddl_batch: '1',
			         
			        },
			        success: function (data) { 
			          var data = jQuery.parseJSON(data);
			          for(i=0;i<data.length;i++){
			             $('#insertperBatch').append($('<input type="checkbox" class="batchclass" value="'+data[i].batch+'">'+data[i].batch+'</input>'));
			             $('#insertperBatch').append($('<br/>'));

			            }
								
			        }    
			      });

		

		$.ajax({
	        url: '/phpork/gateway/meds.php',
	        type: 'post',
	        data : {
	          getLastMed: '1',
	          pig: pig_id
	        },
	        success: function (data) { 
	          var data = jQuery.parseJSON(data); 
	           $("#lastMedInfo").append($("<label>Name: "+data[0].medname+"</label><br/><label>Type: "+data[0].med_type+"</label>"));
	           $("#lastMedInfoEdit").append($("<label>Name: "+data[0].medname+"</label><br/><label>Type: "+data[0].med_type+"</label>"));
	        }    
	            
	      });

		$.ajax({
	        url: '/phpork/gateway/feeds.php',
	        type: 'post',
	        data : {
	          getLastFeed: '1',
	          pig: pig_id
	        },
	        success: function (data) { 
	          var data = jQuery.parseJSON(data); 
	           $("#lastFeedInfo").append($("<label>Name: "+data.feedname+"</label><br/><label>Type: "+data.feed_type+"</label>"));
	           $("#lastFeedInfoEdit").append($("<label>Name: "+data.feedname+"</label><br/><label>Type: "+data.feed_type+"</label>"));
	        }    
	            
	      });


        $('#changePig').on("click",function() {
          window.location ="/phpork/pages/farm";
        });

         $('#editPigButton').on("click",function() {
           $('#viewPig').attr("style", "display: none");
           $('#editPigDetails').attr("style", "display: inline-block");

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
	              $("#pigInfo").append($("<label></label>").text("Pig label:                  "  +data[0].label));
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
                  $("#pigInfo").append($("<input></input)").attr("type", "hidden").attr("id","prevStatus").attr("value", data[0].pig_stat));
                  $("#pigInfo").append($("<select id='editStatus'><option value='"+data[0].pig_stat+"' selected>Currently: "+data[0].pig_stat+"</option></option><option value='weaning'>Weaning</option><option value='growing'>Growing</option></option><option value='sow'>Sow</option></option><option value='boar'>Boar</option></option><option value='sick'>Sick</option><option value='dead'>Dead</option><option value='slaughtered'>Slaugthered</option></select>"));
                  $("#pigInfo").append($("<br/>"));
                  $("#pigInfo").append($("<label></label>").text("RFID: "));
                  $("#pigInfo").append($("<input></input)").attr("type", "hidden").attr("id","prevRfid").attr("value", data[0].rfid_tag));
                  $("#pigInfo").append($("<input></input)").attr("type", "hidden").attr("id","pigLabel").attr("value", data[0].rfid_label));
                  $("#pigInfo").append($("<select id='editRFID'><option value='"+data[0].rfid_tag+"' selected>Currently: "+data[0].rfid_tag+"</option></select>"));
                  $("#pigInfo").append($("<br/>"));
                  $("#pigInfo").append($("<label></label>").text("Weight: "));
                  $("#pigInfo").append($("<input></input)").attr("type", "hidden").attr("id","weightRecordId").attr("value", data[0].record_id));
                  $("#pigInfo").append($("<input></input)").attr("type", "hidden").attr("id","prevWeight").attr("value", data[0].weight));
                  $("#pigInfo").append($("<input></input)").attr("type", "number").attr("id","editWeight").attr("value", data[0].weight));
                  $("#pigInfo").append($("<label></label>").text("kg"));
                  $("#pigInfo").append($("<br/>"));
                  $("#pigInfo").append($("<label></label>").text("Weight Type: "));
                  $("#pigInfo").append($("<input></input)").attr("type", "hidden").attr("id","prevWeightType").attr("value", data[0].weight_type));
                  $("#pigInfo").append($("<input></input)").attr("type", "text").attr("id","editWeightType").attr("value", data[0].weight_type));
                  $("#pigInfo").append($("<hr>").attr("style", "border-color: #9ecf95;"));
                  $("#pigInfo").append($("<label></label>").text("Parents                       "));
		          $("#pigInfo").append($("<br/>")); 
		          $("#pigInfo").append($("<span></span>").text("Boar:            "  +data[0].boar));
		          $("#pigInfo").append($("<br/>")); 
		          $("#pigInfo").append($("<span></span>").text("Sow:                  "  +data[0].sow));
		          $("#pigInfo").append($("<br/>")); 

		          $.ajax({
		            type: "post", 
		            url: "/phpork/gateway/pig.php", 
		            data: {
		              getinsertRFID: '1',
		              pig: pig_id
		            }, 
		          success: function (data) { 
		             var data = jQuery.parseJSON(data); 
		                for(i=0;i<data.length;i++){
		                  $("#editRFID").append($("<option></option>").attr("value",data[i].t_id)
		                    .text(data[i].t_rfid)); 
		                }
                   
              		} 
          
        		});

						
	        }    
	      });

        $('#saveEditPig').on("click",function() {
           var prevStatus = $('#prevStatus').val();
           var newStatus = $('#editStatus').val();
           var prevRFID = $('#prevRfid').val();
           var newRFID = $('#editRFID').val();
           var prevWeight = $('#prevWeight').val();
           var newWeight = $('#editWeight').val();
           var prevWeightType = $('#prevWeightType').val();
           var newWeightType = $('#editWeightType').val();
           var user_id = $('#userId').val();
           var pigLabel = $('#pigLabel').val();
           var weightrecord = $('#weightRecordId').val();

           $.ajax({
	        url: '/phpork/gateway/pig.php',
	        type: 'post',
	        data : {
	          updatePig: '1',
	          pig: pig_id,
	          user: user_id,
	          stat: newStatus
	        },
	        success: function (data) { 
	          
	           console.log("pig status updated");

	            $.ajax({
			        url: '/phpork/gateway/pig.php',
			        type: 'post',
			        data : {
			          updateRFID: '1',
			          pig: pig_id,
					  rfid: newRFID,
		              prevRFID: prevRFID,
					  label: pigLabel
			        },
			        success: function (data) { 
			           
			           console.log("pig rfid updated");


			            $.ajax({
					        url: '/phpork/gateway/pig.php',
					        type: 'post',
					        data : {
					          updatePigWeight: '1',
					          pig: pig_id,
							  weight: newWeight,
				              record_id: weightrecord,
							  remarks: newWeightType
					        },
					        success: function (data) { 
					           
					           console.log("pig weight updated");

					            $.ajax({
							        url: '/phpork/gateway/pig.php',
							        type: 'post',
							        data : {
							          editHistory: '1',
							          user: user_id,
							          pig: pig_id,
							          prevStatus: prevStatus,
							          stat: newStatus,
							          prevRFID: prevRFID,
							          rfid: newRFID,
									  prevWeight: prevWeight,
									  weight: newWeight, 
									  prevWeightType: prevWeightType,
									  weightType: newWeightType
							        },
							        success: function (data) { 
							          
							           console.log("edit history");
							           location.reload();

							          
					        }    
					      });
					          
			        }    
			      });

			          
	        }    
	      });

		}


        });
      });
 		
 		$('#cancelEditPig').on("click",function() {
           $('#viewPig').attr("style", "display: inline-block");
           $('#editPigDetails').attr("style", "display: none");

        });

        /*view movement*/

 		$('#movement').on("click",function() {
          $('#viewMovement').attr("style", "display: inline-block");
          $('#viewMovementDetails').attr("style", "display: inline-block");
          $('#viewMovementGraph').attr("style", "display: none");
          $('#viewMeds').attr("style", "display: none");
          $('#viewFeeds').attr("style", "display: none");
          $('#viewWeight').attr("style", "display: none");
        });

        $.ajax({
	        url: '/phpork/gateway/pig.php',
	        type: 'post',
	        data : {
	          getCurrentHouse: '1',
	          pig: pig_id
	        },
	        success: function (data) { 
	          var data = jQuery.parseJSON(data); 
	           $("#pigMovementInfo").append($("<label>Currently:	           House  "+data[0].house+"      Pen  "+data[0].pen+" </label>"));
	        }    
	      });

        $('#visualizeButton').on("click",function() {
          
          $('#viewMovementDetails').attr("style", "display: none");
          $('#viewMovementGraph').attr("style", "display: inline-block");
         
        });

         $('#backToMovement').on("click",function() {
          $('#viewMovementDetails').attr("style", "display: inline-block");
          $('#viewMovementGraph').attr("style", "display: none");
           
        });
        /*view Movement*/

        /*view meds */

         $('#medication').on("click",function() {
          $('#viewMeds').attr("style", "display: inline-block");
          $('#viewMedsInfo').attr("style", "display: inline-block");
          $('#editMedsDetails').attr("style", "display: none");
          $('#insertMedsDetails').attr("style", "display: none");
          $('#viewMovement').attr("style", "display: none");
          $('#viewFeeds').attr("style", "display: none");
          $('#viewWeight').attr("style", "display: none");
        });

         $('#editMedsButton').on("click",function() {
           $('#viewMedsInfo').attr("style", "display: none");
            $('#editMedsDetails').attr("style", "display: inline-block");
             $('#insertMedsDetails').attr("style", "display: none");

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
	          ;
	           for(i=0;i<data.length;i++){

	           		$("#editMedsBody").append($("<tr><td>" +data[i].mname+ "</td><td>" +data[i].mtype+ "</td><td><select style='color: black; width: 50%' id='selectmedication"+i+"'>"));

	           		$.ajax({
						url: '/phpork/gateway/meds.php',
						type: 'post',
						data : {
						 ddl_meds: '1'
						},
						success: function (data) { 
						   var data = jQuery.parseJSON(data); 
						      for(j=0;j<data.length;j++){
						      	
						       $("#selectmedication" +j).append($("<option></option>").attr("value", data[j].med_id)
						          .attr("name","meds")
						          .text(data[j].med_name)); 
						      }

						    } 
						});
	           		$("#editMedsBody").append($("</select></td><td><input type='hidden' value='"+data[i].mr_id+"' id='med"+data[i].mr_id+"'></td></tr>"));


	           		$("#selectmedication" +i).on("change", function(){
	           			var editedMeds = {};
	           			editedMeds['medid'] = $('#selectmedication'+i).val();
	           			editedMeds['mrid'] = $('#med'+data[i].mr_id).val();

	           			editedMedications.push(editedMeds);


	           		});

	           }
	        }    
	      });

         $('#saveEditMeds').on("click",function() {

		 	
		 	var user = $("#user_id").val();

		 	$.each(editedMedications, function(key, value) {
		 			var mrid = value.mrid;
		 			var med_id = value.medid;

		 			 $.ajax({
	                    url: '/phpork/gateway/meds.php',
	                    type: 'post',
	                    data : {
	                      updateMeds: '1',
		                  mrid: mrid,
		                  med_id: med_id,
		                  user: user
	                    },
	                    success: function (data) { 
	                      alert("Added!"); 
	                      location.reload();

	                          
	                     }
	                  });

		 		});

		 
          

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
	          	$('#insertperPen').attr("class", "insertTMed");
	          	$('#insertperPig').attr("style", "display: none");

	          }else if(choice=== "perpig"){
	          	$('#insertperPig').attr("style", "display: inline-block");
	          	$('#insertperPig').attr("class", "insertTMed");
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
	                       alert("Added!");
	                       location.reload();
	                       $('#medication').click();
	                     }
	                  });


		 	}else if(choice === "perpig"){
		 		var checkedPig = document.getElementsByClassName('pigclass');
		 		var selPig = [];

		 		for(var i=0;i<checkedPig.length; i++){
		 			if(checkedPig[i].checked){
		 				console.log($(checkedPig[i]).val());
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
	                       location.reload();
	                       $('#medication').click("true");
                          
                     }
                  });


		 	}


		 });
         /*view meds */

         /*view feeds*/
          $('#feeds').on("click",function() {
          	$('#viewFeeds').attr("style", "display: inline-block");
          	$('#viewFeedsInfo').attr("style", "display: inline-block");
            $('#editFeeds').attr("style", "display: none");
            $('#insertFeedsDetails').attr("style", "display: none");
          	$('#viewMovement').attr("style", "display: none");
          	$('#viewMeds').attr("style", "display: none");
          	 $('#viewWeight').attr("style", "display: none");

        });

         $('#editFeedsButton').on("click",function() {
           $('#viewFeedsInfo').attr("style", "display: none");
            $('#editFeeds').attr("style", "display: inline-block");
            $('#insertFeedsDetails').attr("style", "display: none");

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

	           		$("#editFeedsBody").append($("<tr><td>" +data[i].fname+ "</td><td>" +data[i].ftype+ "</td><td>"+data[i].proddate+"<td><select style='color: black; width: 50%' id='selectfeed"+i+"'>"));

	           		$.ajax({
						url: '/phpork/gateway/feeds.php',
						type: 'post',
						data : {
						 ddl_feeds: '1'
						},
						success: function (data) { 
						   var data = jQuery.parseJSON(data); 
						      for(j=0;j<data.length;j++){
						      	
						       $("#selectfeed" +j).append($("<option></option>").attr("value", data[j].feed_id)
						          .attr("name","feeds")
						          .text(data[j].feed_name)); 
						      }

						    } 
						});
	           		$("#editFeedsBody").append($("</select></td><td><input type='hidden' value='"+data[i].ft_id+"' id='feed"+data[i].ft_id+"'></td></tr>"));


	           		$("#selectfeed" +i).on("change", function(){
	           			var editedFeeds = {};
	           			editedFeeds['fid'] = $('#selectfeed'+i).val();
	           			editedFeeds['ft_id'] = $('#feed'+data[i].ft_id).val();

	           			editedMedications.push(editedFeeds);


	           		});

	           }
	        }    
	      });

         $('#saveEditFeeds').on("click",function() {

		 	
		 	var user = $("#user_id").val();

		 	$.each(editedFeeds, function(key, value) {
		 			var ft_id = value.ft_id;
		 			var fid = value.fid;

		 			 $.ajax({
	                    url: '/phpork/gateway/feeds.php',
	                    type: 'post',
	                    data : {
	                      updateFeeds: '1',
		                  fid: fid,
		                  ft_id: ft_id,
		                  user: user
	                    },
	                    success: function (data) { 
	                      alert("Added!"); 
	                      location.reload();

	                          
	                     }
	                  });

		 		});

		 
          

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
	          	$('#insertperPenF').attr("class", "insertTFeed");
	          	$('#insertperPigF').attr("style", "display: none");

	          }else if(choice1=== "perpigF"){
	          	$('#insertperPigF').attr("style", "display: inline-block");
	          	$('#insertperPigF').attr("class", "insertTFeed");
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
	                       
	                       alert("Added!");
	                        location.reload();

	                     }
	                  });


		 	}else if(choice === "perpigF"){
		 		var checkedPigF = document.getElementsByClassName('pigclassF');
		 		var selPig = [];

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
                       location.reload();

                          
                     }
                  });


		 	}


		 });
	
	/*view Weight*/

		$('#weight').on("click",function() {
          $('#viewMeds').attr("style", "display: none");
          $('#viewMovement').attr("style", "display: none");
          $('#viewFeeds').attr("style", "display: none");
          $('#viewWeight').attr("style", "display: inline-block");
          $('#viewWeightInfo').attr("style", "display: inline-block");
          $('#insertWeightDetails').attr("style", "display: none");
        });

        
        $('#insertWeightButton').on("click",function() {
           $('#viewWeightInfo').attr("style", "display: none");
           $('#insertWeightDetails').attr("style", "display: inline-block");

        });

         $('#selectWeightchoice').on("change",function() {
         	var choice = $('#selectWeightchoice').val();
         	console.log(choice);
	          if(choice === "perbatch"){
	          	$('#insertperBatch').attr("style", "display: inline-block");
	          	$('#insertperBatch').attr("class", "insertTMed");
	          	$('#insertperPigW').attr("style", "display: none");

	          }else if(choice=== "perpigW"){
	          	$('#insertperPigW').attr("style", "display: inline-block");
	          	$('#insertperPigW').attr("class", "insertTMed");
	          	$('#insertperBatch').attr("style", "display: none");

	          }
        });

         $('#backToWeight').on("click",function() {
           $('#viewWeightInfo').attr("style", "display: inline-block");
            $('#insertWeightDetails').attr("style", "display: none");

        });


		 $('#saveInsertWeight').on("click", function(){
		 	var weight = $('#addWeight').val();
		 	var weightType = $('#addWeightType').val();
		 	var dateWeighed = $('#dateWeighed').val();
		 	var timeWeighed = $('#timeWeighed').val();

		 	var choice = $('#selectWeightchoice').val();
		 	var user = $('#userId').val();

		 	if(choice === "perbatch"){

		 		var checkedBatch = document.getElementsByClassName('batchlass');
		 		var selBatch = [];

		 		for(var i=0;i<checkedBatch.length; i++){
		 			if(checkedBatch[i].checked){
		 				console.log($(checkedBatch[i]).val());
		 				selBatch.push($(checkedBatch[i]).val());
		 			}
		 		}
		 		
			 	 $.ajax({
	                    url: '/phpork/gateway/pig.php',
	                    type: 'post',
	                    data : {
	                     insertWeight: '1',
	                     weight: weight,
						 weightType: weightType,
			             dateWeighed: dateWeighed, 
		                 timeWeighed: timeWeighed,
			             user: user,
			             batchsel: selBatch
	                    },
	                    success: function (data) { 
	                       alert("Added!");
	                        location.reload();

	                       
	                     }
	                  });


		 	}else if(choice === "perpigW"){
		 		var checkedPig = document.getElementsByClassName('pigclassW');
		 		var selPig = [];

		 		for(var i=0;i<checkedPig.length; i++){
		 			if(checkedPig[i].checked){
		 				console.log($(checkedPig[i]).val());
		 				selPig.push($(checkedPig[i]).val());
		 			}
		 		}


		 	 $.ajax({
	                    url: '/phpork/gateway/pig.php',
	                    type: 'post',
	                    data : {
	                     insertWeight: '1',
	                     weight: weight,
						 weightType: weightType,
			             dateWeighed: dateWeighed, 
		                 timeWeighed: timeWeighed,
			             user: user,
			             pigsel: selPig
	                    },
	                    success: function (data) { 
	                       alert("Added!");
	                       location.reload($('#weight').click());

	                       
	                     }
	                  });

		 	}


		 });
         /*view meds */

        
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
 			function checkAllPigW(ele) {
 			 var checkboxes = document.getElementsByClassName('pigclassW'); 
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
 			function checkAllBatchW(ele) {
 			 var checkboxes = document.getElementsByClassName('batchclass'); 
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
		
		 $('#mvmntRprt').on("click",function() {
		 	e.preventDefault();
            $('#myModalReportMvmnt').modal('show');
        });
        $('#gen_mvmntrprt').on("click",function(){
          var from = $('#from').val();
          var to = $('#to').val();
          var pig = $('#pigid').val(); 
          if((from != '') && (to != '') && (pig != '') ){
            $.ajax({
              url: '/phpork/gateway/movement.php',
              type: 'post',
              data : {
                getMvmntDetails: '1',
                from: from,
                to: to,
                pig: pig
              },
              success: function (data) { 
                var data = jQuery.parseJSON(data); 
                  alert("Generated movement report! Saved in Desktop.");  
                }
            });
          }
          window.location = "/phpork/encoder_home";
        });
        /* report meds*/
        $('#medsRprt').on("click",function() {
        	e.preventDefault();
            $('#myModalReportMeds').modal('show');
        });
        
        $('#gen_medsrprt').on("click",function(){
          var from = $('#fromMeds').val();
          var to = $('#toMeds').val();
          var pig = $('#pigid').val(); 
          if((from != '') && (to != '') && (pig != '') ){
            $.ajax({
              url: '/phpork/gateway/meds.php',
              type: 'post',
              data : {
                getMedsReport: '1',
                from: from,
                to: to,
                pig: pig
              },
              success: function (data) { 
                var data = jQuery.parseJSON(data); 
                  alert("Generated medication report! Saved in Desktop.");  
                }
            });
          }
          window.location = "/phpork/encoder_home";
        });
        /* report feeds*/
        $('#feedsRprt').on("click",function() {
        	e.preventDefault();
            $('#myModalReportFeeds').modal('show');
        });
        
        $('#gen_feedsrprt').on("click",function(){
          var from = $('#fromFeeds').val();
          var to = $('#toFeeds').val();
          var pig = $('#pigid').val(); 
          
          if((from != '') && (to != '') && (pig != '') ){
            $.ajax({
              url: '/phpork/gateway/feeds.php',
              type: 'post',
              data : {
                getFeedReport: '1',
                from: from,
                to: to,
                pig: pig
              },
              success: function (data) { 
                var data = jQuery.parseJSON(data); 
                  alert("Generated feed report! Saved in Desktop.");  
                }
            });
          }
          window.location = "/phpork/encoder_home";
        }); 
         /* report feeds*/
        $('#weightRprt').on("click",function() {
        	e.preventDefault();
            $('#myModalReportWeight').modal('show');
        });
        
        $('#gen_weightrprt').on("click",function(){
          var from = $('#fromWeight').val();
          var to = $('#toWeight').val();
          var pig = $('#pigid').val(); 
          
          if((from != '') && (to != '') && (pig != '') ){
            $.ajax({
              url: '/phpork/gateway/pig.php',
              type: 'post',
              data : {
                getWeightReport: '1',
                from: from,
                to: to,
                pig: pig
              },
              success: function (data) { 
                var data = jQuery.parseJSON(data); 
                  alert("Generated weight report! Saved in Desktop.");  
                }
            });
          }
          window.location = "/phpork/encoder_home";
        });     
       
      //}); 
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
				    	"url": "/phpork/gateway/movement.php?mvmntChart=1&pig="+<?php echo $_GET['pig']; ?>
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
			
			var chart = AmCharts.makeChart("columnchart_values", {
				  "type": "serial",
				 
				  "dataLoader": {
				    "url": "/phpork/gateway/pig.php?weightChart=1&pig="+<?php echo $_GET['pig']; ?>
				  },
				  "valueAxes": [{
				    "gridColor": "#b44230",
				    "gridAlpha": 0.2,
				    "dashLength": 0,
				    "title": "Weight"
				  }],
				  "gridAboveGraphs": true,
				  "startDuration": 1,
				  "graphs": [{
				    "balloonText": "Date: [[year]]: <br><b><span style='font-size:14px;'>Weight: [[value]]</span></b>",
				    "fillAlphas": 0.8,
				    "lineAlpha": 0.2,
				    "type": "column",
				     "colorField": "color",
				    "valueField": "weight"
				  }],
				  "chartCursor": {
				    "categoryBalloonEnabled": false,
				    "cursorAlpha": 0,
				    "zoomable": false
				  },
				  "categoryField": "week",
				  "categoryAxis": {
				    "gridPosition": "start",
				    "gridAlpha": 0,
				    "tickPosition": "start",
				    "tickLength": 20,
				    "title": "Weeks"
				  }
				});

			function setDataSet(dataset_url) {
			  AmCharts.loadFile(dataset_url, {}, function(data) {
			    chart.dataProvider = AmCharts.parseJSON(data);
			    chart.validateData();
			  });
			}
    </script> 

	</body> 
</html>
