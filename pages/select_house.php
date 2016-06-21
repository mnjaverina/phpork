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
            <div class="col-md-2 col-centered" style="height: 8%; width: 8%; margin-right: 11%; margin-left: 0px;">
              <img src="<?php echo HOST;?>/phpork/images/icons/feeds.png" class="img-responsive">
            </div>

            <div class="col-md-2 col-centered" style="height: 8%; width: 8%; margin-right: 11%;">
              <img src="<?php echo HOST;?>/phpork/images/Select House.png" class="img-responsive">
            </div>

            <div class="col-md-2 col-centered" style="height: 8%; width: 8%; margin-right: 11%;">
              <img src="<?php echo HOST;?>/phpork/images/Select Pen.png" class="img-responsive">
            </div>

            <div class="col-md-2 col-centered" style="height: 8%; width: 8%; margin-right: 0px;">
              <img src="<?php echo HOST;?>/phpork/images/Select Pig.png" class="img-responsive">
            </div>
      </div>

      <div class="step-content active col-xs-12"> 
        <?php 
          $l = $_GET['location']; 
          echo "<input type='hidden' value='$l' name='loc' id='locid'/>"; 
        ?>
      </div>

    <div class="row row-centered pos1 col-xs-12 col-sm-12 col-md-12 col-lg-12">
       <div style="max-width: 50%; height: 230px; margin-left: 25%; margin-top: 30px; padding: 20px; border-radius: 30px; border: 5px solid; border-color: #9ecf95;">
        <span class="custom-dropdown2"> 
            <select id="dropdown"> 
                <?php 
                  $arr_house = $db->getHouseByLoc($_GET['location']);
                   echo "<option selected=\"true\" disabled=\"disabled\">Select House</option>"; 
                  foreach ($arr_house as $key => $array) {
                    echo "<option value='".$array['h_id']."' id='h_id' >House  ".$array['h_no']." </option>";

                  } 
                  echo "<option value=\"House\">Add House</option>";  
                ?> 
              </select> 
            </span> 
            <br/> <br/>  <br/> <br/>
             <button type="button" class="btn btn-default btn-md" id="back">
              <span class="glyphicon glyphicon-chevron-left" aria-hidden="true" data-toggle="modal" data-target="#myModal">Back</span>
          </button>
         <button type="button" class="btn btn-default btn-md" id="next">
                <span class="glyphicon glyphicon-chevron-right" aria-hidden="true" data-toggle="modal" data-target="#myModal">Next</span>
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
          var house = $("#dropdown").val(); 
          var location = $('#locid').val();

           if(house == null){
            alert("Select an option");
          }else if(house != "House"){ 
            window.location = "/phpork/farm/house/"+location+"/"+house; 
          }else{
            console.log("Bahay Kubo kahit munti.. " +house);
          }


        }); 
        $('#back').on("click",function() {
          window.location = "/phpork/pages/farm"; 
        }); 
      }); 
    </script> 
</body>

</html>