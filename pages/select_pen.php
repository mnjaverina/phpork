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
    <script src="<?php echo HOST;?>/phpork/js/jquery-latest.min.js" type="text/javascript"></script> 
    <script src="<?php echo HOST;?>/phpork/js/bootstrap.js" type="text/javascript"></script> 
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
            <div class="col-md-2 col-centered" style="height: 10%; width: 10%; margin-right: 11%; margin-left: 0px;">
              <img src="<?php echo HOST;?>/phpork/images/Selected Farm.png" class="img-responsive">
            </div>

            <div class="col-md-2 col-centered" style="height: 10%; width: 10%; margin-right: 11%;">
              <img src="<?php echo HOST;?>/phpork/images/Selected House.png" class="img-responsive">
            </div>

            <div class="col-md-2 col-centered" style="height: 10%; width: 10%; margin-right: 11%;">
              <img src="<?php echo HOST;?>/phpork/images/Select Pen.png" class="img-responsive">
            </div>

            <div class="col-md-2 col-centered" style="height: 10%; width: 10%; margin-right: 0px;">
              <img src="<?php echo HOST;?>/phpork/images/Select Pig.png" class="img-responsive">
            </div>
      </div>

    <div class="row row-centered pos1 col-xs-12 col-sm-12 col-md-12 col-lg-12">
       <div class="lowerPanel">
        <span class="custom-dropdown2"> 
            <select id="dropdown"> 
                  echo "<option selected="true" disabled="disabled">Select Pen</option>"; 
              </select> 
            </span> 
            <br/> <br/>  <br/> <br/>
            <button type="button" class="btn1" id="backP">
              <span class="glyphicon glyphicon-chevron-left" aria-hidden="true">Back</span> 
          </button>
         <button type="button" class="btn1" id="nextP">
                 <span class="glyphicon glyphicon-chevron-right" aria-hidden="true">Next</span>
            </button>
        </div>
    </div>

    <!-- Modal -->
    <div id="myModal" class="modal fade" role="dialog">
      <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" id="close">&times;</button>
            <h4 class="modal-title">Modal Header</h4>
          </div>
          <div class="modal-body">
            <p>Some text in the modal.</p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal" id="close2">Close</button>
          </div>
        </div>

      </div>
    </div>

    <div class="page-footer"> 
      Prototype Pork Traceability System || Copyright &copy; 2014 - <?php echo date("Y");?> UPLB ||funded by PCAARRD 
    </div>

     

     <div class="step-content active col-xs-12"> 
        <?php 
          $h = $_GET['house'];
          $l = $_GET['location']; 
          echo "<input type='hidden' value='$l' name='loc' id='locid'/>"; 
          echo "<input type='hidden' value='$h' name='house' id='houseid'/>"; 
        ?>
      </div>
    <script type="text/javascript"> 
      $(document).ready(function () {
        $('#nextP').on("click",function() {
          var penno = $('#dropdown').val();
          var houseno = $("#houseid").val(); 
          var location = $("#locid").val(); 
         
           if(penno == null){
            alert("Select an option");
          }else if(penno != "Pen"){ 
             window.location = "/phpork/farm/house/pen/" +location+ "/" +houseno+ "/" +penno; 
          }
        }); 
        $('#dropdown').on("change",function() {
            var pen = $("#dropdown").val(); 

            if(pen == "Pen"){
                   $('#myModal').modal('show');
            }
           
          });
        $('#backP').on("click",function() {
           var location = $("#locid").val();
          window.location = "/phpork/farm/" +location; 
        }); 
        $('#close').on("click",function(){
           var houseno = $("#houseid").val();
          var location = $('#locid').val();
           window.location = "/phpork/farm/house/"+location+"/"+houseno; 
        });
         $('#close2').on("click",function(){
           var houseno = $("#houseid").val();
          var location = $('#locid').val();
           window.location = "/phpork/farm/house/"+location+"/"+houseno; 
        });
      }); 
    </script>

     <script>
        $.ajax({
          url: '/phpork/gateway/pen.php',
          type: 'post',
          data : {
            getPenByHouse: '1',
            house: '1'
          },
          success: function (data) { 
             var data = jQuery.parseJSON(data); 
                for(i=0;i<data.length;i++){
                  $("#dropdown").append($("<option></option>").attr("value",data[i].pen_id)
                    .attr("name","pen")
                    .text("Pen " +data[i].pen_no)); 
                }
                $("#dropdown").append($("<option></option>").attr("value","Pen")
                    .attr("name","addPen")
                    .text("<--Add Pen-->"));   
              } 
          
        });
    </script>

</body>

</html>