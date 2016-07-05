<!DOCTYPE HTML> 
<html lang = "en">
  <?php 
   session_start();

    require_once "../connect.php"; 
    require_once "../inc/dbinfo.inc"; 

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
    <link rel="stylesheet" href="<?php echo HOST;?>/phpork/css/style_login.css">

    <script src="<?php echo HOST;?>/phpork/js/jquery-2.1.4.js" type="text/javascript"></script> 
    <script src="<?php echo HOST;?>/phpork/js/jquery-latest.js" type="text/javascript"></script> 
    <script src="<?php echo HOST;?>/phpork/js/jquery.min.js" type="text/javascript"></script> 
    <script src="<?php echo HOST;?>/phpork/js/bootstrap.js" type="text/javascript"></script> 
    <script src="<?php echo HOST;?>/phpork/js/bootstrap.min.js" type="text/javascript"></script> 
    <script src="<?php echo HOST;?>/phpork/js/jquery.min.js"></script> 
    <script src="<?php echo HOST;?>/phpork/js/bootstrap.min.js"></script>
  </head>
  
  <body>
    <div class="container">
      <div class="row row-right pos3">
        <div class="col-md-2 col-centered" style="height: 10%; width: 13%;">
          <img src="<?php echo HOST;?>/phpork/css/images/qrcode.png" class="img-responsive">
        </div>
      </div>
      <form  method = "post"  autocomplete = "off">
        <div class="row row-centered pos1">
          <div class="col-sm-6 col-md-4 col-centered" style="background-color: #bb1d24; border-radius: 25px; padding-top: 1%; padding-bottom: 2%;">
            <img src="<?php echo HOST;?>/phpork/css/images/logo.jpg" class="img-responsive">
            <div class="col-md-2 col-centered" style="width:80%; margin-bottom: 2%; background-color: white; border-radius: 10px; margin-left: 10%; text-align: center; font-size: 1.5em;">
              <a href="<?php echo HOST;?>/phpork/in/1">
                <span>Log in as ADMIN</span>
              </a>
            </div>
            <div class="col-md-2 col-centered" style="width: 80%; background-color: white; border-radius: 10px;  margin-left: 10%; text-align: center; font-size: 1.5em;">
              <a href="<?php echo HOST;?>/phpork/in/2">
               
                <span>Log in as ENCODER</span>
              </a>
            </div>
          </div>
        </div>
      </form>
       <div class="row row-centered pos2">
        <div class="col-md-2 col-centered" style="height: 10.5%; width: 10.5%;">
          <img src="<?php echo HOST;?>/phpork/images/logos/ADSC logo.jpg" class="img-responsive">
        </div>
        <div class="col-md-2 col-centered" style="height: 11%; width: 11%;">
          <img src="<?php echo HOST;?>/phpork/images/logos/ICS logo.png" class="img-responsive">
        </div>
        <div class="col-md-2 col-centered" style="height: 9.8%; width: 9.8%;">
          <img src="<?php echo HOST;?>/phpork/images/logos/PCAARRD logo.png" class="img-responsive">
        </div>
        <div class="col-md-2 col-centered" style="height: 10.5%; width: 10.5%;">
          <img src="<?php echo HOST;?>/phpork/images/logos/UPLB logo.png" class="img-responsive">
        </div>
      </div>
    </div>
    
    <script type="text/javascript"> 
      $(document).ready(function () {

        $('#save').on("click",function(){
            var uName = $('#uname').val();
            var pword = $('#pword').val();
            var pword2 = $('#pword2').val();

            if(pword != pword2){
                alert("Password does not match!");
            }else{
                 $.ajax({
                    url: '/phpork/gateway/auth.php',
                    type: 'post',
                    data : {
                      signup: '1',
                      username: uName,
                      password: pword
                    },
                    success: function (data) {

                        window.location = "/phpork/home"; 
                    }    
                  });
            }


           
        });

        $('#close').on("click",function(){

          window.location = "/phpork/in"; 
        });

      });
    </script>
  </body>
</html>
