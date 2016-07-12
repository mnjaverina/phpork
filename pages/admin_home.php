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
    <link rel="stylesheet" href="<?php echo HOST;?>/phpork/css/style_home.css"> 

    <script src="<?php echo HOST;?>/phpork/js/jquery-2.1.4.js" type="text/javascript"></script> 
    <script src="<?php echo HOST;?>/phpork/js/jquery-latest.js" type="text/javascript"></script> 
    
    <script src="<?php echo HOST;?>/phpork/js/jquery-latest.min.js" type="text/javascript"></script> 
    <script src="<?php echo HOST;?>/phpork/js/bootstrap.js" type="text/javascript"></script> 
   
  </head> 
  <body> 
    <div class="page-header"> 
      <img class="img-responsive" src="<?php echo HOST;?>/phpork/images/Header1.png"> 
    </div> 

    <form class="form-horizontal col-xs-10 col-sm-10 col-md-10 col-lg-10"  method="post" action="/phpork/out" style="width:50%; float:right;"> 
      <div class="form-group logout" > 
        <input type="text" class="col-xs-6 col-sm-5" readonly style="text-align: left; border: 2px solid; border-color: #83b26a;" value="<?php echo $_SESSION['username'];?>"> 
        <div class="col-xs-1 col-sm-1" style="left: -1%;"> 
          <button type="submit" class="btn btn-primary btn-sm" >Logout</button> 
        </div> 
      </div> 
    </form> 

      <div class="box userDiv" data-toggle="tooltip" title="Click to add user." data-trigger= "hover" >
        <button id="addUser" style="background-color: white; border: none; outline: none;" data-toggle="modal" data-target="#myModalUser"">
          <img class="img-responsive" src="<?php echo HOST;?>/phpork/images/Username.png" style="width:50%; height: 50%; margin: auto;"> 
          <span>Add User</span>
        </button>
      </div>

      <div class="box farmDiv" data-toggle="tooltip" title="Click to add farm." data-trigger= "hover">
        <button id="addFarm" style="background-color: white; border: none; outline: none;" data-toggle="modal" data-target="#myModalFarm">
          <img class="img-responsive" src="<?php echo HOST;?>/phpork/images/Add Farm.png" style="width:50%; height: 50%; margin: auto;"> 
          <span>Add Farm</span>
        </button>
      </div>

      <div class="box houseDiv" data-toggle="tooltip" title="Click to add house." data-trigger= "hover">
       <button id="addHouse" style="background-color: white; border: none; outline: none;" data-toggle="modal" data-target="#myModalHouse">
          <img class="img-responsive" src="<?php echo HOST;?>/phpork/images/Add House.png" style="width:50%; height: 50%; margin: auto;"> 
          <span>Add House</span>
        </button>
      </div>

      <div class="box penDiv" data-toggle="tooltip" title="Click to add pen." data-trigger= "hover">
         <button id="addPen" style="background-color: white; border: none; outline: none;" data-toggle="modal" data-target="#myModalPen">
          <img class="img-responsive" src="<?php echo HOST;?>/phpork/images/Add Pen.png" style="width:50%; height: 50%; margin: auto;"> 
          <span>Add Pen</span>
        </button>
      </div>

    <div class="box parentDiv" data-toggle="tooltip" title="Click to add parents." data-trigger= "hover">
        <button id="addParent" style="background-color: white; border: none; outline: none;" data-toggle="modal" data-target="#myModalPig">
          <img class="img-responsive" src="<?php echo HOST;?>/phpork/images/Select Pig.png" style="width:50%; height: 50%; margin: auto;"> 
          <span>Add Parent</span>
        </button>
      </div>

      <div class="box breedDiv" data-toggle="tooltip" title="Click to add breed." data-trigger= "hover">
        <button id="addBreed" style="background-color: white; border: none; outline: none;" data-toggle="modal" data-target="#myModalBreed">
          <img class="img-responsive" src="<?php echo HOST;?>/phpork/images/Add Breed.png" style="width:50%; height: 50%; margin: auto;"> 
          <span>Add Breed</span>
        </button>
      </div>

      <div class="box feedsDiv" data-toggle="tooltip" title="Click to add feed." data-trigger= "hover">
         <button id="addFeeds" style="background-color: white; border: none; outline: none;" data-toggle="modal" data-target="#myModalFeed">
          <img class="img-responsive" src="<?php echo HOST;?>/phpork/images/Add Feeds.png" style="width:50%; height: 50%; margin: auto;"> 
          <span>Add Feeds</span>
        </button>
      </div>

      <div class="box medsDiv" data-toggle="tooltip" title="Click to add medication." data-trigger= "hover">
         <button id="addMeds" style="background-color: white; border: none; outline: none;" data-toggle="modal" data-target="#myModalMeds">
          <img class="img-responsive" src="<?php echo HOST;?>/phpork/images/Add Medications.png" style="width:50%; height: 50%; margin: auto;"> 
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
              <input type="text" class="form-control" id="uname" data-trigger= "hover" data-toggle="tooltip" title="Input new username" aria-describedby="basic-addon3" required>
            </div>
            <br/>
            <div class="input-group">
              <span class="input-group-addon" id="basic-addon3">User Type: </span>
              <select class="form-control" id="uType" style="color:black;" data-trigger= "hover" data-toggle="tooltip" title="Select if the user is an admin or encoder." required> 
                    <option value="" disabled selected>Select user type</option>
                    <option value="admin">Admin</option> 
                    <option value="encoder">Encoder</option> 
              </select>
            </div>
            <br/>
            <div class="input-group">
              <span class="input-group-addon" id="basic-addon3">Password: </span>
              <input type="password" class="form-control" id="password" data-trigger= "hover" data-toggle="tooltip" title="Input new password." aria-describedby="basic-addon3" required>
            </div>
          </div>
          <div class="modal-footer" >
            <button type="submit" class="btn btn-default" data-dismiss="modal" data-trigger= "hover" data-toggle="tooltip" title="Click to save user's details." id="saveUser">Add</button>
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
              <input type="text" class="form-control" id="farmname" data-trigger= "hover"  data-toggle="tooltip" title="Input the name of the farm you want to add." aria-describedby="basic-addon3">
            </div>
            <br/>
            <div class="input-group">
              <span class="input-group-addon" id="basic-addon3">Address: </span>
              <input type="text" class="form-control" id="fadd" data-trigger= "hover" data-toggle="tooltip" title="Input the address of the new farm." aria-describedby="basic-addon3">
            </div>
          </div>
          <div class="modal-footer" >
            <button type="button" class="btn btn-default" data-dismiss="modal" data-trigger= "hover" data-toggle="tooltip" title="Click to save farm's details." id="saveFarm">Add</button>
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
              <select class="form-control" id="loc" style="color:black;" data-trigger= "hover" data-toggle="tooltip" title="Select the location/farm of the house you want to add." required> 
                    <option value="" disabled selected>Select farm location...</option> 
            </select>
            </div>
            <br/>
            <div class="input-group">
              <span class="input-group-addon" id="basic-addon3">House Number: </span>
              <input type="text" class="form-control" id="hnum" data-trigger= "hover" data-toggle="tooltip" title="Input the house number of the new house. Ex: 4A" aria-describedby="basic-addon3">
            </div>
            <br/>
            <div class="input-group">
              <span class="input-group-addon" id="basic-addon3">House Name: </span>
              <input type="text" class="form-control" id="hname" data-trigger= "hover" data-toggle="tooltip" title="Input the house name of the new house. Ex: House 3" aria-describedby="basic-addon3">
            </div>
            <br/>
            <div class="input-group">
              <span class="input-group-addon" id="basic-addon3">Function: </span>
              <select  class="form-control" id="func" name="selStat" style="color:black;" data-trigger= "hover" data-toggle="tooltip" title="Input the function of the new house. Ex: Weaning" required> 
                <option value="" disabled selected>Select function</option>
                <option value="Weaning">Weaning</option> 
                <option value="Growing">Growing</option> 
                <option value="Slaughter">Slaughter</option> 
              </select> 
            </div>
            <br/>
          </div>
          <div class="modal-footer" >
            <button type="button" class="btn btn-default" data-dismiss="modal" data-trigger= "hover" data-toggle="tooltip" title="Click to save house's details." id="saveHouse">Add</button>
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
              <select class="form-control" id="farm" style="color:black;" data-trigger= "hover" data-toggle="tooltip" title="Select the location/farm of the new pen. Ex: Farm 1" required> 
                    <option value="" disabled selected>Select farm location...</option> 
            </select>
            </div>
            <br/>
            <div class="input-group">
              <span class="input-group-addon" id="basic-addon3">House Number: </span>
               <select class='form-control'  id='house' style='color:black;' data-trigger= "hover" data-toggle="tooltip" title="Select the house number where the pen will be added. Ex: House 2" required> 
                      <option value='' disabled selected>Select house...</option> 
            </select> 
            </div>
            <br/>
            <div class="input-group">
              <span class="input-group-addon" id="basic-addon3">Pen Number: </span>
              <input type="text" class="form-control" id="pennum" data-trigger= "hover" data-toggle="tooltip" title="Input the pen number of the new pen. Ex: 29" aria-describedby="basic-addon3">
            </div>
            <br/>
            <div class="input-group">
              <span class="input-group-addon" id="basic-addon3">Function: </span>
              <select  class="form-control" id="func2" style="color:black;" data-trigger= "hover" data-toggle="tooltip" title="Select the function of the new pen. Ex: Weaning" required> 
                <option value="" disabled selected>Select function</option>
                <option value="Weaning">Weaning</option> 
                <option value="Growing">Growing</option> 
                <option value="Medication">Medication</option>
                <option value="Mortality">Mortality</option> 
              </select> 
            </div>
          </div>
          <div class="modal-footer" >
            <button type="button" class="btn btn-default" data-dismiss="modal" data-trigger= "hover" data-toggle="tooltip" title="Click to save pen's details." id="savePen">Add</button>
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
              <select  class="form-control" id="parentLabel"  style="color:black;" data-trigger= "hover" data-toggle="tooltip" title="Select if the parent you will add is boar or sow." required> 
                      <option value="" disabled selected>Select parent label</option> 
                      <option value="boar">Boar</option> 
                      <option value="sow">Sow</option> 
              </select> 
            </div>
            <br/>
            <div class="input-group">
              <span class="input-group-addon" id="basic-addon3">Label ID: </span>
              <input type="text" class="form-control" id="label_id" data-trigger= "hover" data-toggle="tooltip" title="Input the label id of the new boar/sow. Ex: AB123" aria-describedby="basic-addon3">
            </div>
          </div>
          <div class="modal-footer" >
            <button type="button" class="btn btn-default" data-trigger= "hover" data-dismiss="modal" data-toggle="tooltip" title="Click to save parent's details." id="saveParent">Add</button>
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
              <input type="text" class="form-control" id="breed_name" data-trigger= "hover" data-toggle="tooltip" title="Input new breed's name." aria-describedby="basic-addon3">
            </div>
          </div>
          <div class="modal-footer" >
            <button type="button" class="btn btn-default" data-dismiss="modal" data-trigger= "hover" data-toggle="tooltip" title="Click to save breed's details." id="saveBreed">Add</button>
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
              <input type="text" class="form-control" id="feed_name" data-trigger= "hover" data-toggle="tooltip" title="Input the name of the new feed." aria-describedby="basic-addon3">
            </div>
            <br/>
            <div class="input-group">
              <span class="input-group-addon" id="basic-addon3">Feed Type: </span>
              <input type="text" class="form-control" id="feed_type" data-trigger= "hover" data-toggle="tooltip" title="Input the type of the new feed. Ex: Type 1 " aria-describedby="basic-addon3">
            </div>
          </div>
          <div class="modal-footer" >
            <button type="button" class="btn btn-default" data-trigger= "hover" data-dismiss="modal" data-toggle="tooltip" title="Click to save feed details." id="saveFeed">Add</button>
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
              <input type="text" class="form-control" id="med_name" data-trigger= "hover" data-toggle="tooltip" title="Input the name of the new medication." aria-describedby="basic-addon3">
            </div>
            <br/>
            <div class="input-group">
              <span class="input-group-addon" id="basic-addon3">Med Type: </span>
              <input type="text" class="form-control" id="med_type" data-trigger= "hover" data-toggle="tooltip" title="Input the type of the new medication. Ex: Type 2" aria-describedby="basic-addon3">
            </div>
          </div>
          <div class="modal-footer" >
            <button type="button" class="btn btn-default" data-dismiss="modal" data-trigger= "hover" data-toggle="tooltip" title="Click to save medication details." id="saveMeds">Add</button>
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
                        alert("User added");
                        window.location = "/phpork/admin/home"; 
                    }    
                  });
          }else{
            if(uName == ''){
              alert("Please input username.");
            }else if(password == ''){
              alert("Please input password.");              
            }
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
          }else{
            if(locAdd == ''){
              alert("Please input the address.");
            }else if(locName == ''){
              alert("Please input location's name.");              
            }
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
                   window.location = "/phpork/admin/home"; 
                }
            });
          }else{
            if(hNum == ''){
              alert("Please input house number.");
            }else if(hName == ''){
              alert("Please input house name.");              
            }else if(func == ''){
              alert("Please input house's function.");              
            }
          }
         
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
          var func = $("#func2").val(); 

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
                   window.location = "/phpork/admin/home";
                } 
            });
          }else{
            if(penNum == ''){
              alert("Please input pen number.");
            }else if(func == ''){
              alert("Please input pen's function.");              
            }
          }
          
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
                  window.location = "/phpork/admin/home";
                } 
            });
          }else{
            if(label == ''){
              alert("Please input pig label.");
            }else if(label_id == ''){
              alert("Please input label id.");              
            }
          }
           
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
                  window.location = "/phpork/admin/home";
                } 
            });
          }else{
            alert("Please input breed name.");
          }
           
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
                  window.location = "/phpork/admin/home";
                } 
            });
          }else{
            if(feed_name == ''){
              alert("Please input feed name.");
            }else if(feed_type == ''){
              alert("Please input feed type.");              
            }
          }
           
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
                  window.location = "/phpork/admin/home";
                } 
            });
          }else{
            if(med_name == ''){
              alert("Please input medication name.");
            }else if(med_type == ''){
              alert("Please input medication type.");              
            }
          }
           
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
    <script>
    $(document).ready(function(){
        /* Add user's tooltip*/
        $('.userDiv').tooltip({trigger: "hover"});
        $('#saveUser').tooltip({trigger: "hover"});
        $('#uname').tooltip({trigger: "hover"});
        $('#uType').tooltip({trigger: "hover"});
        $('#password').tooltip({trigger: "hover"});

        /* Add farm's tooltip*/
        $('.farmDiv').tooltip({trigger: "hover"});
        $('#saveFarm').tooltip({trigger: "hover"});
        $('#farmname').tooltip({trigger: "hover"});
        $('#fadd').tooltip({trigger: "hover"});
        
        /* Add house's tooltip*/
        $('.houseDiv').tooltip({trigger: "hover"});
        $('#saveHouse').tooltip({trigger: "hover"});
        $('#hnum').tooltip({trigger: "hover"});
        $('#hname').tooltip({trigger: "hover"});
        $('#loc').tooltip({trigger: "hover"});
        $('#func').tooltip({trigger: "hover"});

        /* Add pen's tooltip*/
        $('.penDiv').tooltip({trigger: "hover"});
        $('#savePen').tooltip({trigger: "hover"});
        $('#farm').tooltip({trigger: "hover"});
        $('#house').tooltip({trigger: "hover"});
        $('#pennum').tooltip({trigger: "hover"});
        $('#func2').tooltip({trigger: "hover"});

        /* Add parent's tooltip*/
        $('.parentDiv').tooltip({trigger: "hover"});
        $('#saveParent').tooltip({trigger: "hover"});
        $('#parentLabel').tooltip({trigger: "hover"});
        $('#label_id').tooltip({trigger: "hover"});

        /* Add breed's tooltip*/
        $('.breedDiv').tooltip({trigger: "hover"});
        $('#saveBreed').tooltip({trigger: "hover"});
        $('#breed_name').tooltip({trigger: "hover"});

        /* Add feed's tooltip*/
        $('.feedsDiv').tooltip({trigger: "hover"});
        $('#saveFeed').tooltip({trigger: "hover"});
        $('#feed_name').tooltip({trigger: "hover"});
        $('#feed_type').tooltip({trigger: "hover"});

        /* Add medication's tooltip*/
        $('.medsDiv').tooltip({trigger: "hover"});
        $('#saveMeds').tooltip({trigger: "hover"});
        $('#med_name').tooltip({trigger: "hover"});
        $('#med_type').tooltip({trigger: "hover"});

    });
    </script> 
  </body>
</html>

