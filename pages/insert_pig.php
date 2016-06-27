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
    <link rel="stylesheet" href="<?php echo HOST;?>/phpork/css/style_insert_pig.css">

    <script src="<?php echo HOST;?>/phpork/js/jquery-2.1.4.js" type="text/javascript"></script> 
    <script src="<?php echo HOST;?>/phpork/js/jquery-latest.js" type="text/javascript"></script> 
    <script src="<?php echo HOST;?>/phpork/js/jquery.min.js" type="text/javascript"></script> 
    <script src="<?php echo HOST;?>/phpork/js/bootstrap.js" type="text/javascript"></script> 
    <script src="<?php echo HOST;?>/phpork/js/jquery.min.js"></script> 
    <script src="<?php echo HOST;?>/phpork/js/bootstrap.min.js"></script>
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

   <!--Pig Details/ ito po yung 1-->
   <div class="pigs">
    <?php 
            if(!isset($_GET['detail']) || $_GET['detail']=='1'){
          ?> 
          <script> 
            $('#pigDetails').addClass("active-nav"); 
          </script> 
      <div class="content" style="margin-left: 25%; margin-top: 5%;"> 
        <ul class="step-indicator"> 
          <li class="each-step active"></li> 
          <li class="each-step"></li> 
          <li class="each-step"></li> 
        </ul> 
      </div> 
  

      <div class="row row-centered pos1 col-xs-12 col-sm-12 col-md-12 col-lg-12">
        
        <div class="lowerPanel">
          <h3><span class="label">Pig Details</span></h3>
          <div style="max-width: 40%;">
            <div class="input-group">
              <span class="input-group-addon" id="basic-addon3">Pig id: </span>
              <input type="text" class="form-control" id="basic-url" aria-describedby="basic-addon3">
            </div>
             <br/>
            <div class="input-group">
              <span class="input-group-addon" id="basic-addon3">Farrowing Date: </span>
              <input type="text" class="form-control" id="basic-url" aria-describedby="basic-addon3" placeholder="mm/dd/yyyy">
            </div>
            <br/>
            <div class="input-group">
              <span class="input-group-addon" id="basic-addon3">Week farrowed: </span>
              <input type="text" class="form-control" id="basic-url" aria-describedby="basic-addon3">
            </div>
            <br/>
            <div class="input-group">
              <span class="input-group-addon" id="basic-addon3">Status: </span>
              <input type="text" class="form-control" id="basic-url" aria-describedby="basic-addon3">
            </div>
            <br/>
            <div class="input-group">
              <span class="input-group-addon" id="basic-addon3">Farm: </span>
              <input type="text" class="form-control" id="basic-url" aria-describedby="basic-addon3">
            </div>
            <br/>
            <div class="input-group">
              <span class="input-group-addon" id="basic-addon3">House: </span>
              <input type="text" class="form-control" id="basic-url" aria-describedby="basic-addon3">
            </div>
          </div>

          <div style="float: right; max-width: 40%; margin-top: -33.5%;">
            <div class="input-group">
              <span class="input-group-addon" id="basic-addon3">Pen: </span>
              <input type="text" class="form-control" id="basic-url" aria-describedby="basic-addon3">
            </div>
            <br/>
            <div class="input-group">
              <span class="input-group-addon" id="basic-addon3">RFID: </span>
              <input type="text" class="form-control" id="basic-url" aria-describedby="basic-addon3">
            </div>
            <br/>
            <div class="input-group">
              <span class="input-group-addon" id="basic-addon3">Gender: </span>
              <input type="text" class="form-control" id="basic-url" aria-describedby="basic-addon3">
            </div>
            <br/>
            <div class="input-group">
              <span class="input-group-addon" id="basic-addon3">Parents: </span>
              <input type="text" class="form-control" id="basic-url" aria-describedby="basic-addon3">
            </div>
            <br/>
            <div class="input-group">
              <span class="input-group-addon" id="basic-addon3">Weight: </span>
              <input type="text" class="form-control" id="basic-url" aria-describedby="basic-addon3">
            </div>
            <br/>
            <div class="input-group">
              <span class="input-group-addon" id="basic-addon3">Weight Type: </span>
              <input type="text" class="form-control" id="basic-url" aria-describedby="basic-addon3">
            </div>
          </div>
          <br/>
        </div>
        <br/>
        <a id="feedDetails" class="" href="/phpork/addPig/Feeds">
          <button type="button" class="btn1" id="N2">
            Next <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
          </button>
        </a>
      </div> 
    </div>

     <!--Feed Details//ito po yung 2-->
     <div class="feed">
     <?php 
           } else if(!isset($_GET['detail']) || $_GET['detail']=='2'){
          ?> 
       <script> 
            $('#feedDetails').addClass("active-nav"); 
          </script> 
    
     <div class="content" style="margin-left: 25%; margin-top: 5%;"> 
    <ul class="step-indicator"> 
      <li class="each-step active"></li> 
      <li class="each-step active"></li> 
      <li class="each-step"></li> 
    </ul> 
  </div> 

    <div class="row row-centered pos1 col-xs-12 col-sm-12 col-md-12 col-lg-12">
      
       <div class="lowerPanel1">
          <h3><span class="label">Feed Details</span></h3>
          <br/>
        <div style="max-width: 80%; margin-left: 12%;">  
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
        </div>
        <br/>
      
        </div>
         <br/>
        
        <a id="pigDetails" class=""  href="/phpork/addPig/pigDetails">
          <button type="button" class="btn1" id="N2">
            <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span> Back
          </button>
        </a>
        
        
        <a id="medDetails" class="" href="/phpork/addPig/Meds">
          <button type="button" class="btn1" id="N2">
            Next <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
          </button>
        </a>
        
    </div> 
  </div>

    <!--Medication Details // ito po yung 3-->
    <div class="meds">
      <?php 
           } else if(!isset($_GET['detail']) || $_GET['detail']=='3'){
          ?>
       <script> 
            $('#medDetails').addClass("active-nav"); 
          </script> 
    
         <div class="content" style="margin-left: 25%; margin-top: 5%;"> 
        <ul class="step-indicator"> 
          <li class="each-step active"></li> 
          <li class="each-step active"></li> 
          <li class="each-step active"></li> 
        </ul> 
      </div> 
    <div class="row row-centered pos1 col-xs-12 col-sm-12 col-md-12 col-lg-12">
      
       <div class="lowerPanel1">
          <br/>
          <h3><span class="label">Medication Details</span></h3>
          <br/>
          <div div style="max-width: 80%; margin-left: 12%;">
            <div class="input-group">
              <span class="input-group-addon" id="basic-addon3">Last medication given: </span>
              <input type="text" class="form-control" id="basic-url" aria-describedby="basic-addon3">
            </div>
              <br/>
              <div class="input-group">
                <span class="input-group-addon" id="basic-addon3">Medication type: </span>
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
            </div>
             <br/>
      </div>
      <br/>
     
      <a id="feedDetails" class="" href="/phpork/addPig/Feeds">
          <button type="button" class="btn1" id="N2">
            <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span> Back
          </button>
      </a>
        
        <br/> <br/>
        <button type="button" class="btn1" id="insert">
        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Insert Pig Details
        </button>
    </div>
  </div>
    
    <?php
      }
    ?>
   
    <div class="page-footer"> 
      Prototype Pork Traceability System || Copyright &copy; 2014 - <?php echo date("Y");?> UPLB || funded by PCAARRD 
    </div>  
  </body>
</html>