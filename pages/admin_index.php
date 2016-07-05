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
    
    <script src="<?php echo HOST;?>/phpork/js/jquery-latest.min.js" type="text/javascript"></script> 
    <script src="<?php echo HOST;?>/phpork/js/bootstrap.js" type="text/javascript"></script> 
   
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
        <button id="addParent" style="background-color: white; border: none;" data-toggle="modal" data-target="#myModalPig">
          <img class="img-responsive" src="<?php echo HOST;?>/phpork/images/Select Pig.png" style="width:50%; height: 50%; margin: auto;"> 
          <span>Add Parent</span>
        </button>
      </div>

      <div class="box">
        <button id="addBreed" style="background-color: white; border: none;" data-toggle="modal" data-target="#myModalBreed">
          <img class="img-responsive" src="<?php echo HOST;?>/phpork/images/Select Pig.png" style="width:50%; height: 50%; margin: auto;"> 
          <span>Add Breed</span>
        </button>
      </div>

      <div class="box">
         <button id="addFeeds" style="background-color: white; border: none;" data-toggle="modal" data-target="#myModalFeed">
          <img class="img-responsive" src="<?php echo HOST;?>/phpork/images/Insert Feeds.png" style="width:50%; height: 50%; margin: auto;"> 
          <span>Add Feeds</span>
        </button>
      </div>

      <div class="box">
         <button id="addMeds" style="background-color: white; border: none;" data-toggle="modal" data-target="#myModalMeds">
          <img class="img-responsive" src="<?php echo HOST;?>/phpork/images/Insert Medications.png" style="width:50%; height: 50%; margin: auto;"> 
          <span>Add Medication</span>
        </button>
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
            <div class="input-group">
              <span class="input-group-addon" id="basic-addon3">Username: </span>
              <input type="text" class="form-control" id="uname" aria-describedby="basic-addon3" required>
            </div>
            <br/>
            <div class="input-group">
              <span class="input-group-addon" id="basic-addon3">User Type: </span>
              <select class="form-control" id="uType" style="color:black;" required> 
                    <option value="" disabled selected>Select user type</option>
                    <option value="admin">Admin</option> 
                    <option value="encoder">Encoder</option> 
              </select>
            </div>
            <br/>
            <div class="input-group">
              <span class="input-group-addon" id="basic-addon3">Password: </span>
              <input type="password" class="form-control" id="password" aria-describedby="basic-addon3" required>
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
              <input type="text" class="form-control" id="farmname" aria-describedby="basic-addon3">
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
              <span class="input-group-addon" id="basic-addon3">Location: </span>
              <select class="form-control" id="loc" style="color:black;" required> 
                    <option value="" disabled selected>Select farm location...</option> 
            </select>
            </div>
            <br/>
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
              <span class="input-group-addon" id="basic-addon3">Location: </span>
              <select class="form-control" id="farm" style="color:black;" required> 
                    <option value="" disabled selected>Select farm location...</option> 
            </select>
            </div>
            <br/>
            <div class="input-group">
              <span class="input-group-addon" id="basic-addon3">House Number: </span>
               <select class='form-control'  id='house' style='color:black;' required> 
                      <option value='' disabled selected>Select house...</option> 
            </select> 
            </div>
            <br/>
            <div class="input-group">
              <span class="input-group-addon" id="basic-addon3">Pen Number: </span>
              <input type="text" class="form-control" id="pennum" aria-describedby="basic-addon3">
            </div>
            <br/>
            <div class="input-group">
              <span class="input-group-addon" id="basic-addon3">Function: </span>
              <select  class="form-control" id="func" style="color:black;" required> 
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

    <!-- Modal for Add Parent -->
     <div id="myModalParent" class="modal fade" role="dialog" >
      <div class="modal-dialog">
        <div class="modal-content"> <!-- Modal content-->
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" id="close">&times;</button>
            <h4 class="modal-title">Add Parent</h4>
          </div>
          <div class="modal-body">
            <br/>
            <div class="input-group">
              <span class="input-group-addon" id="basic-addon3">Label: </span>
              <select  class="form-control" id="parentLabel"  style="color:black;" required> 
                      <option value="" disabled selected>Select parent label</option> 
                      <option value="boar">Boar</option> 
                      <option value="sow">Sow</option> 
              </select> 
            </div>
            <br/>
            <div class="input-group">
              <span class="input-group-addon" id="basic-addon3">Label ID: </span>
              <input type="text" class="form-control" id="label_id" aria-describedby="basic-addon3">
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal" id="saveParent">Add</button>
          </div>
        </div>
      </div>
    </div>

    <!-- Modal for Add Breed -->
     <div id="myModalBreed" class="modal fade" role="dialog" >
      <div class="modal-dialog">
        <div class="modal-content"> <!-- Modal content-->
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" id="close">&times;</button>
            <h4 class="modal-title">Add Breed</h4>
          </div>
          <div class="modal-body">
            <div class="input-group">
              <span class="input-group-addon" id="basic-addon3">Breed Name: </span>
              <input type="text" class="form-control" id="breed_name" aria-describedby="basic-addon3">
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal" id="saveBreed">Add</button>
          </div>
        </div>
      </div>
    </div>


    <!-- Modal for Add Feed -->
     <div id="myModalFeed" class="modal fade" role="dialog" >
      <div class="modal-dialog">
        <div class="modal-content"> <!-- Modal content-->
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" id="close">&times;</button>
            <h4 class="modal-title">Add Feed</h4>
          </div>
          <div class="modal-body">
            <div class="input-group">
              <span class="input-group-addon" id="basic-addon3">Feed Name: </span>
              <input type="text" class="form-control" id="feed_name" aria-describedby="basic-addon3">
            </div>
            <br/>
            <div class="input-group">
              <span class="input-group-addon" id="basic-addon3">Feed Type: </span>
              <input type="text" class="form-control" id="feed_type" aria-describedby="basic-addon3">
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal" id="saveFeed">Add</button>
          </div>
        </div>
      </div>
    </div>

    <!-- Modal for Add Med -->
     <div id="myModalMeds" class="modal fade" role="dialog" >
      <div class="modal-dialog">
        <div class="modal-content"> <!-- Modal content-->
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" id="close">&times;</button>
            <h4 class="modal-title">Add Medication</h4>
          </div>
          <div class="modal-body">
            <div class="input-group">
              <span class="input-group-addon" id="basic-addon3">Med Name: </span>
              <input type="text" class="form-control" id="med_name" aria-describedby="basic-addon3">
            </div>
            <br/>
            <div class="input-group">
              <span class="input-group-addon" id="basic-addon3">Med Type: </span>
              <input type="text" class="form-control" id="med_type" aria-describedby="basic-addon3">
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal" id="saveMeds">Add</button>
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
           e.preventDefault(); 
            $('#myModalUser').modal('show');
          
        });

        $('#saveUser').on("click",function(){
            var uName = $('#uname').val();
            var user_Type = $('#utype').val();
            var pword = $('#password').val();
            
            
          if((uName != '') && (password != '') ){
              var uType;
              if(user_Type === "admin"){
                uType = 1;
              }else{
                uType = 2;
              }
                 $.ajax({
                    url: '/phpork/gateway/auth.php',
                    type: 'post',
                    data : {
                      signup: '1',
                      username: uName,
                      password: pword,
                      usertype: uType
                    },
                    success: function (data) {

                        window.location = "/phpork/admin/home"; 
                    }    
                  });
              }

          });


         $('#addFarm').on("click",function() {
           e.preventDefault(); 
            $('#myModalFarm').modal('show');
          });
         
         $('#saveFarm').on("click",function(){
          var locName = $("#farmname").val(); 
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

         /*Add House*/
          $('#addHouse').on("click",function() {
             e.preventDefault(); 
            $('#myModalHouse').modal('show');
          });
          

        $('#saveHouse').on("click",function(){
          var location = $('#loc').val();
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
          window.location = "/phpork/admin/home";
        });
        /*End of Add House*/


        /*Add Pen */
        $('#farm').on("change", function(e) {
            e.preventDefault(); 
              var location = $('#farm').val();

              $.ajax({
                url: '/phpork/gateway/house.php',
                type: 'post',
                data : {
                  getHouseByLoc: '1',
                  loc: location
                },
                success: function (data) { 
                   var data = jQuery.parseJSON(data); 
                      for(i=0;i<data.length;i++){
                        $("#house").append($("<option></option>").attr("value",data[i].h_id)
                          .attr("name","house")
                          .text("House " +data[i].h_no)); 
                      }
                    } 
              });
           });

         $('#addPen').on("click",function() {
           e.preventDefault(); 
            $('#myModalPen').modal('show');
          });

         $('#savePen').on("click",function(){
          var houseno = $("#house").val();
          var location = $('#farm').val();
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
           window.location = "/phpork/admin/home";
        });
         /*End of Add Pen*/

         /*Add Parent*/
         $('#addParent').on("click",function() {
          // e.preventDefault(); 
            $('#myModalParent').modal('show');
          });

         $('#saveParent').on("click",function(){
          var label = $("#parentLabel").val();
          var label_id = $('#label_id').val();
         
          if((label != '') && (label_id != '') ){
            $.ajax({
              url: '/phpork/gateway/pig.php',
              type: 'post',
              data : {
                addParent: '1',
                label: label,
                label_id:  label_id
              },
              success: function (data) { 
                var data = jQuery.parseJSON(data); 
                  alert("Parent added");
                } 
            });
          }
           window.location = "/phpork/admin/home";
        });
         /*End of Add Parent*/

         /*Add Breed*/
         $('#addBreed').on("click",function() {
           e.preventDefault(); 
            $('#myModalBreed').modal('show');
          });

         $('#saveBreed').on("click",function(){
          var breed_name = $("#breed_name").val();
          
         
          if((breed_name != '') ){
            $.ajax({
              url: '/phpork/gateway/pig.php',
              type: 'post',
              data : {
                addBreed: '1',
                breed_name: breed_name
              },
              success: function (data) { 
                var data = jQuery.parseJSON(data); 
                  alert("Parent added");
                } 
            });
          }
           window.location = "/phpork/admin/home";
        });
         /*End of Add Breed*/

          /*Add Feed*/
         $('#addFeed').on("click",function() {
           e.preventDefault(); 
            $('#myModalFeed').modal('show');
          });

         $('#saveFeed').on("click",function(){
          var feed_name = $("#feed_name").val();
           var feed_type = $("#feed_type").val();
          
         
          if((feed_name != '') && (feed_type != '') ){
            $.ajax({
              url: '/phpork/gateway/feeds.php',
              type: 'post',
              data : {
               addFeedName: '1',
                fname: feed_name,
                ftype: feed_type
              },
              success: function (data) { 
                var data = jQuery.parseJSON(data); 
                  alert("Feeds added");
                } 
            });
          }
           window.location = "/phpork/admin/home";
        });
         /*End of Add Feed*/


         /*Add Med*/
         $('#addMeds').on("click",function() {
           e.preventDefault(); 
            $('#myModalMeds').modal('show');
          });

         $('#saveMeds').on("click",function(){
          var med_name = $("#med_name").val();
           var med_type = $("#med_type").val();
          
         
          if((med_name != '') && (med_type != '') ){
            $.ajax({
              url: '/phpork/gateway/meds.php',
              type: 'post',
              data : {
               addMedName: '1',
                mname: med_name,
                mtype: med_type
              },
              success: function (data) { 
                var data = jQuery.parseJSON(data); 
                  alert("Medication added");
                } 
            });
          }
           window.location = "/phpork/admin/home";
        });
         /*End of Add Med*/

  

    //select farm
    $.ajax({
          url: '/phpork/gateway/location.php',
          type: 'post',
          data : {
            ddl_location: '1'
          },
          success: function (data) { 
             var data = jQuery.parseJSON(data); 
                for(i=0;i<data.length;i++){
                  $("#farm").append($("<option></option>").attr("value",data[i].loc_id)
                    .attr("name","location")
                    .text(data[i].loc_name)); 
                }
                   
              } 
          
        });
     //select farm
    $.ajax({
          url: '/phpork/gateway/location.php',
          type: 'post',
          data : {
            ddl_location: '1'
          },
          success: function (data) { 
             var data = jQuery.parseJSON(data); 
                for(i=0;i<data.length;i++){
                  $("#loc").append($("<option></option>").attr("value",data[i].loc_id)
                    .attr("name","location")
                    .text(data[i].loc_name)); 
                }
                   
              } 
          
        });
     });

    </script>
  </body>
</html>
