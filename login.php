<!DOCTYPE HTML> 
<html lang = "en">
    <?php 
   session_start(); 
   if(isset($_SESSION['username']) && isset($_SESSION['password'])){
         header("Location: index.php"); 
   } 
   require_once "connect.php"; 
   require_once "/inc/dbinfo.inc"; 
   require_once "/inc/dbinfo.inc"; 

   if(count($_POST)>0){
      $result = mysqli_query($con, "SELECT user_id,user_name,password FROM user WHERE user_name='" . $_POST["username"]."' and password = '". $_POST["password"]."'") or die ( mysqli_error ( $con ) ); 
      $row = mysqli_fetch_row($result); 
      if($row != null){
         $_SESSION["user_id"] = $row[0]; 
         $_SESSION["username"] = $row[1]; 
         $_SESSION["password"] = $row[2]; 
         header("Location: index.php"); 
      }else{
         echo "<script> alert('Invalid username/password!'); </script>"; 
      } 
      mysqli_free_result($result); 
      mysqli_close($con); 
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
      <link rel="stylesheet" href="<?php echo HOST;?>/phpork/css/bootstrap-responsive.css">
      <script src="<?php echo HOST;?>/phpork/js/jquery-2.1.4.js" type="text/javascript"></script> 
      <script src="<?php echo HOST;?>/phpork/js/jquery-latest.js" type="text/javascript"></script> 
      <script src="<?php echo HOST;?>/phpork/js/jquery.min.js" type="text/javascript"></script> 
      <script src="<?php echo HOST;?>/phpork/js/bootstrap.js" type="text/javascript"></script> 
      <script src="<?php echo HOST;?>/phpork/js/bootstrap.min.js" type="text/javascript"></script> 
      <script src="<?php echo HOST;?>/phpork/js/jquery.min.js"></script> 
      <script src="<?php echo HOST;?>/phpork/js/bootstrap.min.js"></script>
      
      <link rel="stylesheet" href="<?php echo HOST;?>/phpork/css/style.css">
   </head>
  
   <body>
        <div class="container">
          <div class="row row-right pos3">
            <div class="col-md-2 col-centered" style="height: 10%; width: 13%;">
                  <img src="<?php echo HOST;?>/phpork/css/images/qrcode.png" class="img-responsive">
            </div>
          </div>

           <div class="row row-centered pos1">
              <div class="col-sm-6 col-md-4 col-centered" style="background-color: #bb1d24; border-radius: 25px; padding-top: 1%">
                <img src="<?php echo HOST;?>/phpork/css/images/logo.jpg" class="img-responsive">
                <div class="form-group form-group-sm input-group">
                  <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                  <input class="form-control" type="username" name='username' placeholder="Username"/>     
                </div>
                  
                <div class="form-group form-group-sm input-group">
                  <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                  <input class="form-control" type="password" name='password' placeholder="Password"/>     
                </div>

                <button type="submit" class="submit" name="loginFlag">
                  <i class="fa fa-long-arrow-right">
                    <img src="<?php echo HOST;?>/phpork/css/images/arrow.png" id="arrow_img">
                  </i>
                </button>    
              </div>
            </div>
            
          <div class="row row-centered pos2">
            <div class="col-md-2 col-centered" style="height: 10%; width: 10%;">
              <img src="<?php echo HOST;?>/phpork/images/logos/ADSC logo.jpg" class="img-responsive">
            </div>

            <div class="col-md-2 col-centered" style="height: 10%; width: 10%;">
              <img src="<?php echo HOST;?>/phpork/images/logos/ICS logo.png" class="img-responsive">
            </div>

            <div class="col-md-2 col-centered" style="height: 10%; width: 10%;">
              <img src="<?php echo HOST;?>/phpork/images/logos/PCAARRD logo.png" class="img-responsive">
            </div>

            <div class="col-md-2 col-centered" style="height: 10%; width: 10%;">
              <img src="<?php echo HOST;?>/phpork/images/logos/UPLB logo.png" class="img-responsive">
            </div>
          </div>
      </div>   
  </body>
</html>