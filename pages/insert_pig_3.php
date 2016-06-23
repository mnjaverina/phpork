<!DOCTYPE html>
<html lang="en">
<?php 
   session_start(); 
  require_once "../connect.php"; 
  require_once "../inc/dbinfo.inc"; 
  if(!isset($_SESSION['username']) || !isset($_SESSION['password'])) {
    header("Location: login.php"); 
  }
  include "../functions.php"; 
  $db = new phpork_functions (); 
?> 

<head> 
    <meta charset="utf-8"> 
    <meta name="viewport" content="width=device-width, initial-scale=1"> 
    <title>Pork Traceability System</title> 

    <link rel="stylesheet" href="<?php echo HOST;?>/phpork/css/bootstrap.css">
    <link rel="stylesheet" href="<?php echo HOST;?>/phpork/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo HOST;?>/phpork/css/bootstrap-theme.css">
    <link rel="stylesheet" href="<?php echo HOST;?>/phpork/css/bootstrap-theme.min.css">
    <link rel="stylesheet" href="<?php echo HOST;?>/phpork/css/bootstrap-responsive.css">
    <script src="<?php echo HOST;?>/phpork/js/jquery-2.1.4.js" type="text/javascript"></script> 
    <script src="<?php echo HOST;?>/phpork/js/jquery-latest.js" type="text/javascript"></script> 
    <script src="<?php echo HOST;?>/phpork/js/jquery.min.js" type="text/javascript"></script> 
    <script src="<?php echo HOST;?>/phpork/js/bootstrap.js" type="text/javascript"></script> 
    <script src="<?php echo HOST;?>/phpork/js/jquery.min.js"></script> 
    <script src="<?php echo HOST;?>/phpork/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="<?php echo HOST;?>/phpork/css/style_insert_pig.css"> 

  </head> 
  <body> 
    
 <div class="page-header"> 
      <a href="<?php echo HOST;?>/phpork/pages/index.php">
      <img class="img-responsive" src="<?php echo HOST;?>/phpork/css/images/Header1.png"> 
    </a>
    </div>

    <form class="form-horizontal col-xs-10 col-sm-10 col-md-10 col-lg-10"  method="post" action="/phpork/out" style="width:50%;float:right;"> 
      <div class="form-group logout" > 
        <input type="text" class="col-xs-6 col-sm-5" readonly style="text-align: left; border: 2px solid; border-color: #83b26a;" value="<?php echo $_SESSION['username'];?>"> 
        <div class="col-xs-1 col-sm-1" style="left: -1%;"> 
          <button type="submit" class="btn btn-primary btn-sm" >Logout</button> 
        </div> 
      </div> 
    </form> 

   <div class="content" style="margin-left: 15%; margin-top: 5%;"> 
		<ul class="step-indicator"> 
		<li class="each-step active"></li> 
		<li class="each-step active"></li> 
		<li class="each-step active"></li> 
		<li class="each-step"></li> 
		</ul> 
	</div> 
	

    <div class="row row-centered pos1 col-xs-12 col-sm-12 col-md-12 col-lg-12">
       <div class="lowerPanel">
       		<h3><span class="label">Feed Details</span></h3>
       		<br/>
       		<div class="input-group">
			  <span class="input-group-addon" id="basic-addon3">Last feed: </span>
			  <input type="text" class="form-control" id="basic-url" aria-describedby="basic-addon3">
			</div>
			<br/>
			<div class="input-group">
			  <span class="input-group-addon" id="basic-addon3">Feed Type: </span>
			  <input type="text" class="form-control" id="basic-url" aria-describedby="basic-addon3">
			</div>
			<br/>
			<div class="input-group">
			  <span class="input-group-addon" id="basic-addon3">Production date of feed: </span>
			  <input type="text" class="form-control" id="basic-url" aria-describedby="basic-addon3" placeholder="mm/dd/yyyy">
			</div>
			<br/>
			<div class="input-group">
			  <span class="input-group-addon" id="basic-addon3">Date and time given: </span>
			  <input type="text" class="form-control" id="basic-url" aria-describedby="basic-addon3">
			</div>
			<br/>
			<div class="input-group">
			  <span class="input-group-addon" id="basic-addon3">Quantity: </span>
			  <input type="text" class="form-control" id="basic-url" aria-describedby="basic-addon3">
			</div>
			<br/>
			
        </div>
        <br/>
         <button type="button" class="btn2" id="back"  onclick="window.location.href='insert_pig_2.php'">
              <span class="glyphicon glyphicon-chevron-left" aria-hidden="true" data-toggle="modal" data-target="#myModal"></span> Back
          </button>
         <button type="button" class="btn2" id="next"  onclick="window.location.href='insert_pig_4.php'">
                Next <span class="glyphicon glyphicon-chevron-right" aria-hidden="true" data-toggle="modal" data-target="#myModal"></span>
            </button>
    </div>


    <div class="page-footer"> 
      Prototype Pork Traceability System || Copyright &copy; 2014 - <?php echo date("Y");?> UPLB || funded by PCAARRD 
    </div>

    

   

</body>

</html>
