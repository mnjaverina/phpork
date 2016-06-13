<!DOCTYPE HTML> 
<html lang = "en">
   <?php

   if(isset($_SESSION['userid'])) {
      header("Location: ../pages/index.php"); 
   } 
   include "../inc/functions.php";
   require_once "../inc/dbinfo.inc"; 
   
   if(isset($_GET['loginFailed'])){
     if($_GET['loginFailed']=="1"){
       ?>
       <script>
        error_alert("Incorrect Username or Password!");
       </script>
       <?php
     }
   }
   ?> 
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>Pork Traceability System</title>
      <link rel="stylesheet" href="<?php echo HOST;?>/phpork/css/bootstrap.css">
      <link rel="stylesheet" href="<?php echo HOST;?>/phpork/css/bootstrap.min.css">
      <link rel="stylesheet" href="<?php echo HOST;?>/phpork/css/bootstrap-theme.css">
      <link rel="stylesheet" href="<?php echo HOST;?>/phpork/css/bootstrap-theme.min.css">
      <script src="<?php echo HOST;?>/phpork/js/jquery-2.1.4.js" type="text/javascript"></script> 
      <script src="<?php echo HOST;?>/phpork/js/jquery-latest.js" type="text/javascript"></script> 
      <script src="<?php echo HOST;?>/phpork/js/jquery.min.js" type="text/javascript"></script> 
      <script src="<?php echo HOST;?>/phpork/js/bootstrap.js" type="text/javascript"></script> 
      <script src="<?php echo HOST;?>/phpork/js/bootstrap.min.js" type="text/javascript"></script> 
      <script src="<?php echo HOST;?>/phpork/js/jquery.min.js"></script> 
      <script src="<?php echo HOST;?>/phpork/js/bootstrap.min.js"></script> 
      <link rel="stylesheet" href="<?php echo HOST;?>/phpork/css/reset.css">
      <link rel="stylesheet" href="<?php echo HOST;?>/phpork/css/style.css">
   </head>
   <body style="background-color:white;">
      <div id="qr_code"> 
         <img src="<?php echo HOST;?>/phpork/css/images/qrcode.png"  class="img-responsive"> 
      </div>
      <div id="login_header" style="margin-bottom: 1%;"> 
         <img src="<?php echo HOST;?>/phpork/css/images/log2.png" class="img-responsive"> 
      </div>
      <form class = "form-horizontal login" style="align:center" action="../gateway/auth.php" method = "post"  autocomplete = "off">
         <fieldset>
            <div class="input" style=""> 
               <input type="text" placeholder="Username" class="user_name" name="username" required /> 
               <img src="<?php echo HOST;?>/phpork/css/images/user.png" id="input_img"> 
               <span><i class="fa fa-envelope-o"></i></span> 
            </div>
            <div class="input"> 
               <input type="password" placeholder="Password" class="password" name="password" required /> 
               <img src="<?php echo HOST;?>/phpork/css/images/lock.png" id="input_img"> 
               <span><i class="fa fa-lock"></i></span> 
            </div>
            <button type="submit" class="submit" name="loginFlag">
               <i class="fa fa-long-arrow-right">
                  <img src="<?php echo HOST;?>/phpork/css/images/arrow.png" id="arrow_img">
               </i>
            </button> 
         </fieldset>
      </form>
       <script src="<?php echo HOST;?>/phpork/js/javascript.js"></script> 
       <script src='http://localhost/phpork/js/jquery.min.js'></script> 
     
   </body>
</html>