<?php
session_start();
  if(!isset($_SESSION['userid'])){
    header("location: login.php");
  }
  include '../inc/functions.php';
?>
<!DOCTYPE html>
<html lang="en">

<head> 
    <meta charset="utf-8"> 
    <meta name="viewport" content="width=device-width, initial-scale=1"> 
    <title>Pork Traceability System</title> 
    <link rel="stylesheet" href="../css/bootstrap.css"> 
    <link rel="stylesheet" href="../css/bootstrap.min.css"> 
    <link rel="stylesheet" href="../css/bootstrap-theme.css"> 
    <link rel="stylesheet" href="../css/bootstrap-theme.min.css"> 
    <link rel="stylesheet" href="../css/style2_nonnavbar.css"> 
    <script src="../js/jquery-latest.min.js" type="text/javascript"></script> 
  </head> 
  <body> 
    <div class="page-header"> 
      <img class="img-responsive" src="../css/images/Header1.png"> 
    </div> 
    <form class="form-horizontal col-xs-10 col-sm-10 col-md-10 col-lg-10"  method="post" action="logout.php" style="width:50%;float:right;"> 
      <div class="form-group logout" > 
        <input type="text" class="col-xs-6 col-sm-5" readonly style="text-align: left; border: 2px solid; border-color: #83b26a;" value="<?php echo $_SESSION['uname'];?>"> 
        <div class="col-xs-1 col-sm-1" style="left: -1%;"> 
          <button type="submit" class="btn btn-primary btn-sm" >Logout</button> 
        </div> 
      </div> 
    </form> 
    <div class="menu"> 
      <div class="menu_view"> 
        <a href="/phpork/farm">
          <img class="img-responsive" src="../css/images/View.png">
        </a> 
      </div> 
      <div class="menu_insert"> 
        <a href="/phpork/addpig">
          <img class="img-responsive" src="../css/images/Insert.png">
        </a> 
      </div> 
    </div> 
  
  <div class="page-footer"> 
    Prototype Pork Traceability System || Copyright &copy; 2014 - <?php echo date("Y");?> UPLB ||funded by PCAARRD 
  </div>

    <script>
        $.ajax({
          url: '../gateway/cashier.php?addCashier=1',
          type: 'post',
          data : {
            name: "rainier"
          },
          success: function(data){
            
          }
        });
    </script>


</body>

</html>
