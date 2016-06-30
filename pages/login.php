<!DOCTYPE HTML> 
<html lang = "en">
  <?php 
    session_start(); 
    if(isset($_SESSION['username']) && isset($_SESSION['password'])){
      header("Location: /phpork/home"); 
    } 
    require_once "../connect.php"; 
    require_once "../inc/dbinfo.inc"; 

    if(count($_POST)>0){
      $result = mysqli_query($con, "SELECT user_id,user_name,password FROM user WHERE user_name='" . $_POST["username"]."' and password = '". $_POST["password"]."'") or die ( mysqli_error ( $con ) ); 
      $row = mysqli_fetch_row($result); 
      if($row != null){
        $_SESSION["user_id"] = $row[0]; 
        $_SESSION["username"] = $row[1]; 
        $_SESSION["password"] = $row[2]; 
        header("Location: /phpork/home"); 
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
          <div class="col-sm-6 col-md-4 col-centered" style="background-color: #bb1d24; border-radius: 25px; padding-top: 1%">
            <img src="<?php echo HOST;?>/phpork/css/images/logo.jpg" class="img-responsive">
            <div class="form-group form-group-sm input-group">
              <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
              <input class="form-control" type="username" name='username' placeholder="Username" required/>     
            </div>
            <div class="form-group form-group-sm input-group">
              <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
              <input class="form-control" type="password" name='password' placeholder="Password" required/>     
            </div>
            <a id="signUp">Sign up</a>
            <button type="submit" class="submit" name="loginFlag">
              <i class="fa fa-long-arrow-right">
                <img src="<?php echo HOST;?>/phpork/css/images/arrow.png" id="arrow_img">
              </i>
            </button>    
          </div>
        </div>
      </form>
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

     <!-- Modal -->
    <div id="myModal" class="modal fade" role="dialog" >
      <div class="modal-dialog">
        <div class="modal-content"> <!-- Modal content-->
          <div class="modal-header">

            <button type="button" class="close" data-dismiss="modal" id="close">&times;</button>
            <h4 class="modal-title">Sign Up</h4>
          </div>
          <div class="modal-body"> 
            <form>
            <br/>
            <div class="input-group">
              <span class="input-group-addon" id="basic-addon3">Username: </span>
              <input type="text" class="form-control" id="uname" aria-describedby="basic-addon3" required>
            </div>
            <br/>
            <div class="input-group">
              <span class="input-group-addon" id="basic-addon3">Password: </span>
              <input type="password" class="form-control" id="pword" aria-describedby="basic-addon3" required>
            </div>
            <br/>
            <div class="input-group">
              <span class="input-group-addon" id="basic-addon3">Re-enter Password: </span>
              <input type="password" class="form-control" id="pword2" aria-describedby="basic-addon3" required>
            </div>
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-default" data-dismiss="modal" id="save">Sign Up</button>
          </div>
        </div>
      </div>
    </div>

    <script type="text/javascript"> 
      $(document).ready(function () {

        $('#signUp').on("click",function() {
            $('#myModal').modal('show');


          
        });

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
