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
    <script src="<?php echo HOST;?>/phpork/js/bootstrap.min.js" type="text/javascript"></script> 
    <script src="<?php echo HOST;?>/phpork/js/jquery.min.js"></script> 
    <script src="<?php echo HOST;?>/phpork/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="<?php echo HOST;?>/phpork/css/select.css"> 
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
    
   <div class="row row-centered pos col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <div class="col-md-2 col-centered" style="height: 10%; width: 10%; margin-right: 11%; margin-left: 0px;">
              <img src="<?php echo HOST;?>/phpork/images/Selected Farm.png" class="img-responsive">
            </div>

            <div class="col-md-2 col-centered" style="height: 10%; width: 10%; margin-right: 11%;">
              <img src="<?php echo HOST;?>/phpork/images/Selected House.png" class="img-responsive">
            </div>

            <div class="col-md-2 col-centered" style="height: 10%; width: 10%; margin-right: 11%;">
              <img src="<?php echo HOST;?>/phpork/images/Selected Pen.png" class="img-responsive">
            </div>

            <div class="col-md-2 col-centered" style="height: 10%; width: 10%; margin-right: 0px;">
              <img src="<?php echo HOST;?>/phpork/images/Select Pig.png" class="img-responsive">
            </div>
      </div>

       <div class="step-content active col-xs-12"> 
        <?php
        $p = $_GET['pen'];
          $h = $_GET['house'];
          $l = $_GET['location']; 
          echo "<input type='hidden' value='$l' name='loc' id='locid'/>"; 
          echo "<input type='hidden' value='$h' name='house' id='houseid'/>";
          echo "<input type='hidden' value='$p' name='pen' id='penid'/>"; 
        ?>
      </div>

    <div class="row row-centered pos1 col-xs-12 col-sm-12 col-md-12 col-lg-12">
       <div class="lowerPanel">
        <span class="custom-dropdown2"> 
            <select id="dropdown"> 
                 <?php 
                  $arr_pig = $db->getPigsByPen($_GET['pen']);
                   echo "<option selected=\"true\" disabled=\"disabled\">Select Pig</option>";  
                  foreach ($arr_pig as $key => $array) {
                    echo "<option value='".$array['pig_id']."' id='h_id' >Pig ".$array['pig_id']." </option>"; 
                  } 
                   echo "<option value=\"Pig\">Add Pig</option>";  
                ?> 
              </select> 
            </span> 
            <br/> <br/>  <br/> 
            <button type="button" class="btn1" id="back">
              <span class="glyphicon glyphicon-chevron-left" aria-hidden="true" data-toggle="modal" data-target="#myModal"></span> Back
          </button>
         <button type="button" class="btn1" id="next">
                Next <span class="glyphicon glyphicon-chevron-right" aria-hidden="true" data-toggle="modal" data-target="#myModal"></span>
            </button>
        </div>
    </div>

    <div class="page-footer"> 
      Prototype Pork Traceability System || Copyright &copy; 2014 - <?php echo date("Y");?> UPLB ||funded by PCAARRD 
    </div>

    <script src="<?php echo HOST;?>/phpork/js/jquery-latest.min.js" type="text/javascript"></script> 
    <script type="text/javascript"> 
      $(document).ready(function () {
        $('#next').on("click",function() {
          var pig = $("#dropdown").val();
          var penno = $("#penid").val();
          var houseno = $("#houseid").val(); 
          var location = $("#locid").val(); 

          if(pig == null){
            alert("Select an option");
          }else if(penno != "Pig"){ 
             window.location = "/phpork/farm/house/pen/pig/" +location+ "/" +houseno+ "/" +penno+ "/" +pig; 
          }else{ 
            console.log("Oink Oink Oink " +pig);
          }
        });

        $('#back').on("click",function() {
          var houseno = $("#houseid").val(); 
          var location = $("#locid").val(); 
          window.location = "/phpork/farm/house/" +location+ "/" +houseno; 
        }); 

      }); 
    </script> 

</body>

</html>