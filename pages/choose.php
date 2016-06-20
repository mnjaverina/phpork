<!DOCTYPE HTML> 
<html lang = "en">
  <?php 
   session_start(); 
  require_once "../connect.php"; 
  require_once "../inc/dbinfo.inc"; 

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
    <link rel="stylesheet" href="<?php echo HOST;?>/phpork/css/style_choose.css"> 
   </head>
  
   <body>
      <head> 
    <meta charset="utf-8"> 
    <meta name="viewport" content="width=device-width, initial-scale=1"> 
    <title>Pork Traceability System</title> 
    <link rel="stylesheet" href="<?php echo HOST;?>/phpork/css/bootstrap.css"> 
    <link rel="stylesheet" href="<?php echo HOST;?>/phpork/css/bootstrap.min.css"> 
    <link rel="stylesheet" href="<?php echo HOST;?>/phpork/css/bootstrap-theme.css"> 
    <link rel="stylesheet" href="<?php echo HOST;?>/phpork/css/bootstrap-theme.min.css"> 
    <link rel="stylesheet" href="<?php echo HOST;?>/phpork/css/style2_nonnavbar.css"> 
    <script src="<?php echo HOST;?>/phpork/js/jquery-latest.min.js" type="text/javascript"></script> 
  </head> 
  <body> 
    <div class="container">

      <div class="page-header"> 
      <img class="img-responsive" src="<?php echo HOST;?>/phpork/css/images/Header1.png"> 
    </div> 

     <form class="form-horizontal col-xs-10 col-sm-10 col-md-10 col-lg-10"  method="post" action="logout.php" style="width:50%;float:right;"> 
      <div class="form-group logout" > 
        <input type="text" class="col-xs-6 col-sm-5" readonly style="text-align: left; border: 2px solid; border-color: #83b26a;" value="<?php echo $_SESSION['username'];?>"> 
        <div class="col-xs-1 col-sm-1" style="left: -1%;"> 
          <button type="submit" class="btn btn-primary btn-sm">Logout</button> 
        </div> 
      </div> 
    </form> 
    <div class="menu">
      <div style="max-height: 100%; max-width: 100%; overflow: auto; text-align: center; padding: 5%;">
        <h2>Choose what to show panel</h2><br/> 
        <div class="list-group list">
          <form method="post" action="#">
            
                  <?php   
                    $arrayOfChoices = array("VIEW", "INSERT", "EDIT", "CHOICE 4");
                    foreach ($arrayOfChoices as $choice){
                      echo "<div class=\"[ form-group ]\">";
                      echo "<input type=\"checkbox\" name=\"fancy-checkbox-default\" id=\"fancy-checkbox-default\" autocomplete=\"off\"/>";
                      echo "<div class=\"[ btn-group ]\">";
                      echo "<label for=\"fancy-checkbox-default\" class=\"[ btn btn-default ]\">";
                      echo "<span class=\"[ glyphicon glyphicon-ok ]\"></span>";
                      echo "<span> </span>";
                      echo "</label>";
                   //   echo"<label for=\"fancy-checkbox-default\" class=\"[ btn btn-default active ]\">";
                      echo "<input type=\"text\" name=\"list[]\" class=\"list-group-item\" value=\"$choice\"/>";
                      echo "</label>";
                      echo "</div>";
                      echo "</div>";

                    }
                  ?>
          
          <br/>
          <button class="btn btn-primary btn-lg" id="get-checked-data" value="done" name ="done">DONE</button>
        </form>
          <?php
            if(isset($_POST['done'])){
              if(!empty($_POST['list'])){
                $choices = $_POST['list'];
                if(!empty($_SESSION['list'])){
                  echo "not empty<br/>";
                }else{
                  $_SESSION['list'] = $choices;
                  foreach( $_SESSION['list'] as $c){
                    echo "<script> console.log(\"$c\"); </script>";

                  }
                }
              }
            }
          ?>
      </div> 
    </div>

   
      
    </div>
     <div class="page-footer"> 
      Prototype Pork Traceability System || Copyright &copy; 2014 - <?php echo date("Y");?> UPLB || funded by PCAARRD 
    </div>


 </body>
</html>