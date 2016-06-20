<!DOCTYPE html>
<html lang="en">
<?php 
   session_start(); 
  require_once "../connect.php"; 
  require_once "../inc/dbinfo.inc"; 
  if(!isset($_SESSION['username']) || !isset($_SESSION['password'])) {
    header("Location: login.php"); 
  }
  include "../inc/functions.php"; 
  $db = new phpork_functions (); 
?> 

<head> 
    <meta charset="utf-8"> 
    <meta name="viewport" content="width=device-width, initial-scale=1"> 
    <title>Pork Traceability System</title> 
    <link rel="stylesheet" href="../css/bootstrap.css">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/bootstrap-theme.css">
    <link rel="stylesheet" href="../css/bootstrap-theme.min.css">
    <link rel="stylesheet" href="../css/bootstrap-responsive.css">
    <script src="../js/jquery-2.1.4.js" type="text/javascript"></script> 
    <script src="../js/jquery-latest.js" type="text/javascript"></script> 
    <script src="../js/jquery.min.js" type="text/javascript"></script> 
    <script src="../js/bootstrap.js" type="text/javascript"></script> 
    <script src="../js/bootstrap.min.js" type="text/javascript"></script> 
    <script src="../js/jquery.min.js"></script> 
    <script src="../js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="../css/select.css"> 
  </head> 
  <body> 
    <div class="page-header"> 
      <img class="img-responsive" src="../css/images/Header1.png"> 
    </div>

    <form class="form-horizontal col-xs-10 col-sm-10 col-md-10 col-lg-10"  method="post" action="logout.php" style="width:50%;float:right;"> 
      <div class="form-group logout" > 
        <input type="text" class="col-xs-6 col-sm-5" readonly style="text-align: left; border: 2px solid; border-color: #83b26a;" value="<?php echo $_SESSION['username'];?>"> 
        <div class="col-xs-1 col-sm-1" style="left: -1%;"> 
          <button type="submit" class="btn btn-primary btn-sm" >Logout</button> 
        </div> 
      </div> 
    </form> 

    <div class="row row-centered pos">
            <div class="col-md-2 col-centered" style="height: 9%; width: 9%; margin-right: 2%;">
              <img src="../images/icons/feeds.png" class="img-responsive">
            </div>

            <div class="col-md-2 col-centered" style="height: 9%; width: 9%; margin-right: 2%;">
              <img src="../images/icons/feeds.png" class="img-responsive">
            </div>

            <div class="col-md-2 col-centered" style="height: 9%; width: 9%; margin-right: 2%;">
              <img src="../images/Select Pen.png" class="img-responsive">
            </div>

            <div class="col-md-2 col-centered" style="height: 9%; width: 9%; margin-right: 2%;">
              <img src="../images/Select Pig.png" class="img-responsive">
            </div>
      </div>

      <div class="row row-centered pos1">
        <div style="background-color: #efe8bd; max-width: 30%; max-height: 100%; margin-left: 33%; margin-bottom: 50px; margin-top: 30px; padding: 30px; border-radius: 30px;">
            <span class="custom-dropdown2"> 
            <select id="dropdown"> 
                <?php 
                  $arr_house = $db->ddl_house($_GET['location']); 
                  foreach ($arr_house as $key => $array) {
                    echo "<option value='".$array['house_id']."' id='h_id' >House  ".$array['house_no']." </option>"; 
                  } 
                ?> 
              </select> 
            </span> 
            <br/> <br/>
             <button type="button" class="btn btn-default btn-md" onclick="window.location.href='select_house.php'">
              <span class="glyphicon glyphicon-chevron-left" aria-hidden="true" data-toggle="modal" data-target="#myModal"></span>Back
          </button>
          <button type="button" class="btn btn-default btn-md" onclick="window.location.href='select_pig.php'">
            Next<span class="glyphicon glyphicon-chevron-right" aria-hidden="true" data-toggle="modal" data-target="#myModal"></span>
          </button>
        </div>
        
      
    </div>

    <div class="page-footer"> 
      Prototype Pork Traceability System || Copyright &copy; 2014 - <?php echo date("Y");?> UPLB ||funded by PCAARRD 
    </div>
</body>

</html>