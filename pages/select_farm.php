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
    <div>
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
            <div class="col-md-2 col-centered" style="height: 10%; width: 10%; margin-right: 9%; margin-left: 0px;">
              <img src="<?php echo HOST;?>/phpork/images/Select Farm.png" class="img-responsive">
            </div>

            <div class="col-md-2 col-centered" style="height: 10%; width: 10%; margin-right: 9%;">
              <img src="<?php echo HOST;?>/phpork/images/Select House.png" class="img-responsive">
            </div>

            <div class="col-md-2 col-centered" style="height: 10%; width: 10%; margin-right: 9%;">
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
                    <option selected="true" disabled="disabled" id="select">Select farm</option> 
              </select> 
            </span> 
            <br/> <br/> <br/>
            <button type="button" class="btn1" id="nextF">
                 Next <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
            </button>
        </div>
    </div>

    <div class="page-footer"> 
      Prototype Pork Traceability System || Copyright &copy; 2014 - <?php echo date("Y");?> UPLB || funded by PCAARRD 
    </div>

    <!-- Modal -->
    <div id="myModal" class="modal fade" role="dialog" >
      <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" id="close">&times;</button>
            <h4 class="modal-title">Add Farm</h4>
          </div>
          <div class="modal-body">
            <br/>
            <div class="input-group">
              <span class="input-group-addon" id="basic-addon3">Farm Name: </span>
              <input type="text" class="form-control" id="fname" aria-describedby="basic-addon3">
            </div>
            <br/>
            <div class="input-group">
              <span class="input-group-addon" id="basic-addon3">Address: </span>
              <input type="text" class="form-control" id="fadd" aria-describedby="basic-addon3">
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal" id="save">Add</button>
          </div>
        </div>

      </div>
    </div>

    
      <script type="text/javascript"> 
        $(document).ready(function () {
          $('#nextF').on("click",function() {
            var location = $("#dropdown").val(); 

            if(location == null){
              alert("Select an option");
            }else if(location != "Farm"){ 
              window.location = "/phpork/farm/" +location;
            }
           
          });
          $('#dropdown').on("change",function() {
            var location = $("#dropdown").val();
           
            if(location == "Farm"){
                   $('#myModal').modal('show');
            }
           
          });
           $('#close').on("click",function(){
             window.location = "/phpork/pages/farm/"; 
          });
           $('#save').on("click",function(){
            var locName = $("#fname").val(); 
            var locAdd = $("#fadd").val(); 

            console.log("Loc Name: "+locName);

            if((locAdd != '') && (locName != '') ){
           
               $.ajax({
                        url: '/phpork/gateway/location.php',
                        type: 'post',
                        data : {
                         addLocationName: '1',
                         lname: locName,
                         addr: locAdd
                        },
                        success: function (data) { 
                           var data = jQuery.parseJSON(data); 
                                $("#dropdown").append($("<option></option>").attr("value",data.loc_id)
                                  .attr("name","farm")
                                  .attr("selected", "true")
                                  .text(data.loc_name)); 

                                $('#select').attr("selected", "false");
                                alert("Farm added");
                                
                              }
                        });
             }
              window.location = "/phpork/pages/farm/";
          });
        });
      </script>
     
     
      <script>
        $.ajax({
          url: '/phpork/gateway/location.php',
          type: 'post',
          data : {
            ddl_location: '1'
          },
          success: function (data) { 
             var data = jQuery.parseJSON(data); 
                for(i=0;i<data.length;i++){
                  $("#dropdown").append($("<option></option>").attr("value",data[i].loc_id)
                    .attr("name","location")
                    .text(data[i].loc_name)); 
                }
                $("#dropdown").append($("<option></option>").attr("value","Farm").attr("id","add")
                    .attr("name","addLoc")
                    .text("<--Add Farm-->"));   
              } 
          
        });
      </script>


</body>

</html>
