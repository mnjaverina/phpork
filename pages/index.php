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
    <link rel="stylesheet" href="<?php echo HOST;?>/phpork/css/style_index.css"> 
    <script src="<?php echo HOST;?>/phpork/js/jquery-latest.min.js" type="text/javascript"></script> 
  </head> 
  <body> 
    <div class="page-header"> 
      <img class="img-responsive" src="<?php echo HOST;?>/phpork/css/images/Header1.png"> 
    </div> 

    <form class="form-horizontal col-xs-10 col-sm-10 col-md-10 col-lg-10"  method="post" action="/phpork/out" style="width:50%; float:right;"> 
      <div class="form-group logout" > 
        <input type="text" class="col-xs-6 col-sm-5" readonly style="text-align: left; border: 2px solid; border-color: #83b26a;" value="<?php echo $_SESSION['username'];?>"> 
        <div class="col-xs-1 col-sm-1" style="left: -1%;"> 
          <button type="submit" class="btn btn-primary btn-sm" >Logout</button> 
        </div> 
      </div> 
    </form> 

    <div class="menu"> 
      <div class="col-md-2 col-centered" style="height: 16%; width: 16%; margin-right: 9%; margin-left: 15%;"> 
        <a href="/phpork/pages/farm">
          <img class="img-responsive" src="<?php echo HOST;?>/phpork/images/View.png">
          <div>
            <h1 style="text-align: center; color: #bb1d24; ">VIEW</h1>
            <h3 style="text-align: center; color: #bb1d24;">Allows you to view the pigs and their individual information.</h3>
          </div>
        </a> 
      </div> 
      <div class="col-md-2 col-centered" style="height: 16%; width: 16%; margin-right: 9%;"> 
        <a href="/phpork/addPig/pigDetails">
          <img class="img-responsive" src="<?php echo HOST;?>/phpork/images/Insert.png">
          <div>
            <h1 style="text-align: center; color: #bb1d24;">INSERT</h1>
            <h3 style="text-align: center; color: #bb1d24;">Allows you to insert new pigs and their information.</h3>
          </div>
        </a> 
      </div>
      <div class="col-md-2 col-centered" style="height: 16%; width: 16%; margin-right: 0px;"> 
        <a href="/phpork/customize">
          <img class="img-responsive" src="<?php echo HOST;?>/phpork/images/Customize.png">
          <div style="margin-left: -20%">
            <h1 style="text-align: center; color: #bb1d24;">CUSTOMIZE</h1>
            </div>
            <div style:"margin-left: 10%;">
            <h3 style="text-align: center; color: #bb1d24;">Allows you to choose what details will be displayed.</h3>
          </div>
          
        </a> 
      </div> 
    </div> 
  
    <div class="page-footer"> 
      Prototype Pork Traceability System || Copyright &copy; 2014 - <?php echo date("Y");?> UPLB || funded by PCAARRD 
    </div>
  </body>
</html>
