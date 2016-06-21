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
    <link href="http://getbootstrap.com/2.3.2/assets/css/bootstrap-responsive.css" rel="stylesheet" />
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

    <div class="row row-centered pos col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <div class="col-md-2 col-centered" style="height: 8%; width: 8%; margin-right: 11%; margin-left: 0px;">
              <img src="../images/icons/feeds.png" class="img-responsive">
            </div>

            <div class="col-md-2 col-centered" style="height: 8%; width: 8%; margin-right: 11%;">
              <img src="../images/icons/feeds.png" class="img-responsive">
            </div>

            <div class="col-md-2 col-centered" style="height: 8%; width: 8%; margin-right: 11%;">
              <img src="../images/icons/feeds.png" class="img-responsive">
            </div>

            <div class="col-md-2 col-centered" style="height: 8%; width: 8%; margin-right: 0px;">
              <img src="../images/icons/feeds.png" class="img-responsive">
            </div>
      </div>

    <div class="row row-centered pos1 col-xs-12 col-sm-12 col-md-12 col-lg-12">
       <div style="max-width: 50%; height: 230px; margin-left: 25%; margin-top: 30px; padding: 50px; border-radius: 30px; border: 5px solid; border-color: #9ecf95;">
          <button type="button" class="btn btn-default btn-lg" onclick="window.location.href='view_pig_details.php'">
              <span class="glyphicon glyphicon-ok" aria-hidden="true"></span> View Pig Details
            </button> 
            <br /><br/>  <br />
              <button type="button" class="btn btn-default btn-md" onclick="window.location.href='select_pig.php'">
                <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>Back
            </button>
        </div>
    </div>

    <div class="page-footer"> 
      Prototype Pork Traceability System || Copyright &copy; 2014 - <?php echo date("Y");?> UPLB ||funded by PCAARRD 


    </div>
</body>

</html>