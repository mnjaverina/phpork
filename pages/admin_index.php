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
   <link rel="stylesheet" href="<?php echo HOST;?>/phpork/css/bootstrap.css">
    <link rel="stylesheet" href="<?php echo HOST;?>/phpork/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo HOST;?>/phpork/css/bootstrap-theme.css">
    <link rel="stylesheet" href="<?php echo HOST;?>/phpork/css/bootstrap-theme.min.css">
    <link rel="stylesheet" href="<?php echo HOST;?>/phpork/css/bootstrap-responsive.css"> 
    <link rel="stylesheet" href="<?php echo HOST;?>/phpork/css/style_index.css"> 

    <script src="<?php echo HOST;?>/phpork/js/jquery-2.1.4.js" type="text/javascript"></script> 
    <script src="<?php echo HOST;?>/phpork/js/jquery-latest.js" type="text/javascript"></script> 
    <script src="<?php echo HOST;?>/phpork/js/jquery.min.js" type="text/javascript"></script> 
    <script src="<?php echo HOST;?>/phpork/js/jquery-latest.min.js" type="text/javascript"></script> 
    <script src="<?php echo HOST;?>/phpork/js/bootstrap.js" type="text/javascript"></script> 
    <script src="<?php echo HOST;?>/phpork/js/bootstrap.min.js"></script>
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

      <div class="box">
        <button id="addUser" style="background-color: white; border: none;" data-toggle="modal" data-target="#myModalUser">
          <img class="img-responsive" src="<?php echo HOST;?>/phpork/images/Username.png" style="width:50%; height: 50%; margin: auto;"> 
          <span>Add User</span>
        </button>
      </div>

      <div class="box">
        <button id="addFarm" style="background-color: white; border: none;" data-toggle="modal" data-target="#myModalFarm">
          <img class="img-responsive" src="<?php echo HOST;?>/phpork/images/Select Farm.png" style="width:50%; height: 50%; margin: auto;"> 
          <span>Add Farm</span>
        </button>
      </div>

      <div class="box">
       <button id="addHouse" style="background-color: white; border: none;" data-toggle="modal" data-target="#myModalHouse">
          <img class="img-responsive" src="<?php echo HOST;?>/phpork/images/Select House.png" style="width:50%; height: 50%; margin: auto;"> 
          <span>Add House</span>
        </button>
      </div>

      <div class="box">
         <button id="addPen" style="background-color: white; border: none;" data-toggle="modal" data-target="#myModalPen">
          <img class="img-responsive" src="<?php echo HOST;?>/phpork/images/Select Pen.png" style="width:50%; height: 50%; margin: auto;"> 
          <span>Add Pen</span>
        </button>
      </div>

    <div class="box">
        <a href="#">
          <img class="img-responsive" src="<?php echo HOST;?>/phpork/images/Download Report.png" style="width:50%; height: 50%; margin: auto;"> 
          <span>Add Parent</span>
        </a>
      </div>

      <div class="box">
        <a href="#">
          <img class="img-responsive" src="<?php echo HOST;?>/phpork/images/Download Report.png" style="width:50%; height: 50%; margin: auto;"> 
          <span>Add Breed</span>
        </a>
      </div>

      <div class="box">
        <a href="#">
          <img class="img-responsive" src="<?php echo HOST;?>/phpork/images/Insert Feeds.png" style="width:50%; height: 50%; margin: auto;"> 
          <span>Add Feed</span>
        </a>
      </div>

      <div class="box">
        <a href="#">
          <img class="img-responsive" src="<?php echo HOST;?>/phpork/images/Insert Medications.png" style="width:50%; height: 50%; margin: auto;"> 
          <span>Add Medication</span>
        </a>
      </div>
   
    <div class="page-footer"> 
      Prototype Pork Traceability System || Copyright &copy; 2014 - <?php echo date("Y");?> UPLB || funded by PCAARRD 
    </div>

    <!-- Modal for Add User -->
    <div id="myModalUser" class="modal fade" role="dialog" >
      <div class="modal-dialog">
        <div class="modal-content"> <!-- Modal content-->
          <div class="modal-header">

            <button type="button" class="close" data-dismiss="modal" id="close">&times;</button>
            <h4 class="modal-title">Add User</h4>
          </div>
          <div class="modal-body"> 
            <form>
            <br/>
            <div class="input-group">
              <span class="input-group-addon" id="basic-addon3">Username: </span>
              <input type="text" class="form-control" id="uname" aria-describedby="basic-addon3" required>
            </div>
            <div class="input-group">
              <span class="input-group-addon" id="basic-addon3">User Type: </span>
              <input type="radio" id="utype"   value="admin" aria-describedby="basic-addon3" checked required>Admin
              <input type="radio"  id="utype"  value="encoder" aria-describedby="basic-addon3" required>Encoder
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
            <button type="submit" class="btn btn-default" data-dismiss="modal" id="saveUser">Add</button>
          </div>
        </div>
      </div>
    </div>


     <!-- Modal for Add Farm -->
    <div id="myModalFarm" class="modal fade" role="dialog" >
      <div class="modal-dialog">
        <div class="modal-content"> <!-- Modal content-->
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
            <button type="button" class="btn btn-default" data-dismiss="modal" id="saveFarm">Add</button>
          </div>
        </div>
      </div>
    </div>

    <!-- Modal for add House-->
    <div id="myModalHouse" class="modal fade" role="dialog">
      <div class="modal-dialog">
        <div class="modal-content"> <!-- Modal content-->
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" id="close">&times;</button>
            <h4 class="modal-title">Add House</h4>
          </div>
          <div class="modal-body">
            <div class="input-group">
              <span class="input-group-addon" id="basic-addon3">House Number: </span>
              <input type="text" class="form-control" id="hnum" aria-describedby="basic-addon3">
            </div>
            <br/>
            <div class="input-group">
              <span class="input-group-addon" id="basic-addon3">House Name: </span>
              <input type="text" class="form-control" id="hname" aria-describedby="basic-addon3">
            </div>
            <br/>
            <div class="input-group">
              <span class="input-group-addon" id="basic-addon3">Function: </span>
              <select  class="form-control" id="func" name="selStat" style="color:black;" required> 
                <option value="" disabled selected>Select function</option>
                <option value="Weaning">Weaning</option> 
                <option value="Growing">Growing</option> 
                <option value="Slaughter">Slaughter</option> 
              </select> 
            </div>
            <br/>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal" id="saveHouse">Add</button>
          </div>
        </div>
      </div>
    </div>

     <!-- Modal for add Pen-->
    <div id="myModalPen" class="modal fade" role="dialog">
      <div class="modal-dialog">
        <div class="modal-content"> <!-- Modal content-->
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" id="close">&times;</button>
            <h4 class="modal-title">Add Pen</h4>
          </div>
          <div class="modal-body">
            <div class="input-group">
              <span class="input-group-addon" id="basic-addon3">Pen Number: </span>
              <input type="text" class="form-control" id="pennum" aria-describedby="basic-addon3">
            </div>
            <br/>
            <div class="input-group">
              <span class="input-group-addon" id="basic-addon3">Function: </span>
              <select  class="form-control" id="func" name="selStat" style="color:black;" required> 
                <option value="" disabled selected>Select function</option>
                <option value="Weaning">Weaning</option> 
                <option value="Growing">Growing</option> 
                <option value="Medication">Medication</option>
                <option value="Mortality">Mortality</option> 
              </select> 
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal" id="savePen">Add</button>
          </div>
        </div>
      </div>
    </div>

     
    <script type="text/javascript"> 
       $(document).ready(function () {

         $('#close').on("click",function(){
            window.location = "/phpork/admin/home"; 
           });

         $('#addUser').on("click",function() {
            $('#myModalUser').modal('show');
          
        });

        $('#saveUser').on("click",function(){
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

                        window.location = "/phpork/admin/home"; 
                    }    
                  });
            }

          });


         $('#addFarm').on("click",function() {
            $('#myModalHouse').modal('show');
          });
         
         $('#saveFarm').on("click",function(){
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
                  alert("Farm added");
                  window.location = "/phpork/admin/home";
                }
            });
          }
            
         
       });


          $('#addHouse').on("click",function() {
            $('#myModalHouse').modal('show');
          });
          

        $('#saveHouse').on("click",function(){
          var location = $('#locid').val();
          var hNum = $('#hnum').val();
          var hName = $('#hname').val();  
          var func = $('#func').val();
          if((hNum != '') && (hName != '') && (func != '') ){
            $.ajax({
              url: '/phpork/gateway/house.php',
              type: 'post',
              data : {
                addHouseName: '1',
                hno: hNum,
                hname: hName,
                fxn: func,
                loc: location
              },
              success: function (data) { 
                var data = jQuery.parseJSON(data); 
                  alert("House added");  
                }
            });
          }
         // window.location = "/phpork/admin/home";
        });

         $('#addPen').on("click",function() {
            $('#myModalPen').modal('show');
          });

         $('#savePen').on("click",function(){
          var houseno = $("#houseid").val();
          var location = $('#locid').val();
          var penNum = $("#pennum").val(); 
          var func = $("#func").val(); 
          if((penNum != '') && (func != '') ){
            $.ajax({
              url: '/phpork/gateway/pen.php',
              type: 'post',
              data : {
                addPenName: '1',
                penno: penNum,
                fxn:  func,
                h_id: houseno
              },
              success: function (data) { 
                var data = jQuery.parseJSON(data); 
                  alert("Pen added");
                } 
            });
          }
          // window.location = "/phpork/admin/home";
        });

    });
    </script>
  </body>
</html>