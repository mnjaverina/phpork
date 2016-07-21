<!DOCTYPE html>
<html lang="en">
  <?php 
    session_start(); 
    require_once "../connect.php"; 
    require_once "../inc/dbinfo.inc"; 
    if(!isset($_SESSION['username']) || !isset($_SESSION['password']) || (!isset($_SESSION['user_type']) || ($_SESSION['user_type'] != 1)) ) {
      header("Location: /phpork/in"); 
    }
    include "../inc/functions.php"; 
    $db = new phpork_functions ();
    $db->connect(); 
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
        <button id="addUser" style="background-color: white; border: none; outline: none;" data-toggle="modal" data-target="#myModalUser">
          <img class="img-responsive" src="<?php echo HOST;?>/phpork/images/Username.png" style="width:50%; height: 50%; margin: auto;"> 
          <span>USER</span>
        </button>
      </div>

      <div class="box farmDiv" data-toggle="tooltip" title="Click to add farm." data-trigger= "hover">
        <button id="addFarm" style="background-color: white; border: none; outline: none;" data-toggle="modal" data-target="#myModalFarm">
          <img class="img-responsive" src="<?php echo HOST;?>/phpork/images/Farm.png" style="width:50%; height: 50%; margin: auto;"> 
          <span>FARM</span>
        </button>
      </div>

      <div class="box houseDiv" data-toggle="tooltip" title="Click to add house." data-trigger= "hover">
       <button id="addHouse" style="background-color: white; border: none; outline: none;" data-toggle="modal" data-target="#myModalHouse">
          <img class="img-responsive" src="<?php echo HOST;?>/phpork/images/House.png" style="width:50%; height: 50%; margin: auto;"> 
          <span>HOUSE</span>
        </button>
      </div>

      <div class="box penDiv" data-toggle="tooltip" title="Click to add pen." data-trigger= "hover">
         <button id="addPen" style="background-color: white; border: none; outline: none;" data-toggle="modal" data-target="#myModalPen">
          <img class="img-responsive" src="<?php echo HOST;?>/phpork/images/Pen.png" style="width:50%; height: 50%; margin: auto;"> 
          <span>PEN</span>
        </button>
      </div>

    <div class="box parentDiv" data-toggle="tooltip" title="Click to add parents." data-trigger= "hover">
        <button id="addParent" style="background-color: white; border: none; outline: none;" data-toggle="modal" data-target="#myModalPig">
          <img class="img-responsive" src="<?php echo HOST;?>/phpork/images/Parentage.png" style="width:50%; height: 50%; margin: auto;"> 
          <span>PARENTAGE</span>
        </button>
      </div>

      <div class="box breedDiv" data-toggle="tooltip" title="Click to add breed." data-trigger= "hover">
        <button id="addBreed" style="background-color: white; border: none; outline: none;" data-toggle="modal" data-target="#myModalBreed">
          <img class="img-responsive" src="<?php echo HOST;?>/phpork/images/Breed.png" style="width:50%; height: 50%; margin: auto;"> 
          <span>BREED</span>
        </button>
      </div>

      <div class="box feedsDiv" data-toggle="tooltip" title="Click to add feed." data-trigger= "hover">
         <button id="addFeeds" style="background-color: white; border: none; outline: none;" data-toggle="modal" data-target="#myModalFeed">
          <img class="img-responsive" src="<?php echo HOST;?>/phpork/images/Feeds2.png" style="width:50%; height: 50%; margin: auto;"> 
          <span>FEED</span>
        </button>
      </div>

      <div class="box medsDiv" data-toggle="tooltip" title="Click to add medication." data-trigger= "hover">
         <button id="addMeds" style="background-color: white; border: none; outline: none;" data-toggle="modal" data-target="#myModalMeds">
          <img class="img-responsive" src="<?php echo HOST;?>/phpork/images/Medications.png" style="width:50%; height: 50%; margin: auto;"> 
          <span>MEDICATION</span>
        </button>
      </div>
   
    <div class="page-footer"> 
      Prototype Pork Traceability System || Copyright &copy; 2014 - <?php echo date("Y");?> UPLB || funded by PCAARRD 
    </div>
    <?php
        $u = $_SESSION['user_id']; 
        echo "<input type='hidden' value='$u' name='user' id='userId'/>";
    ?>

    <!-- Modal for User -->
    <div id="myModalUser" class="modal fade" role="dialog" >
      <div class="modal-dialog">
        <div class="modal-content"> <!-- Modal content-->
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" id="close">&times;</button>
            <h4 class="modal-title">User</h4>
          </div>
          <div class="modal-body"> 
            <div id="chooseToDo" class="btnCenter">
              <button id="addUserBtn" class="btnModal">Add User</button>
              <br/><br/>
              <button id="editUserBtn" class="btnModal">Edit User</button>
            </div>

            <div id="addUserDetails" style="display: none;">
              <div style="margin-bottom: 10%;">
                <button id="backToUser1" style="float: right;">Back</button>
                <h3 class="modal-title" style="float: left;">Add User</h3>
              </div>
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
              <div class="modal-footer" >
                <button type="submit" class="btn btn-default" data-dismiss="modal" data-trigger= "hover" data-toggle="tooltip" title="Click to save user's details." id="saveUser">Add</button>
              </div>
            </div>

            <div id="editUser" style="display: none;">
              <div style="margin-bottom: 10%;">
                <button id="backToUser2" style="float: right;">Back</button>
                <h3 class="modal-title" style="float: left;">Edit User</h3>
              </div>
              <div class="input-group">
                <span class="input-group-addon" id="basic-addon3">Search: </span>
                <select id="searchUser" type="search" class="form-control" title="Search for farm to be edited">
                 <option></option>
               </select>
              </div>
              <br/>
              <div id="displayUser"></div>
            </div>

            <div id="editUserDetails" style="display: none;">
                <div class="input-group" id="editUNAME">
                  <span class="input-group-addon" id="basic-addon3">Username: </span>
                  <input type="text" class="form-control" id="unameEdit" data-trigger= "hover" data-toggle="tooltip" title="Edit username" aria-describedby="basic-addon3" required>
                </div>
                <br/>
                <div class="input-group" id="editUTYPE">
                  <span class="input-group-addon" id="basic-addon3">User Type: </span>
                  <select class="form-control" id="uTypeEdit" style="color:black;" data-trigger= "hover" data-toggle="tooltip" title="Edit if the user is an admin or encoder." required> 
                        <option value="" disabled selected>Select user type</option>
                        <option value="admin">Admin</option> 
                        <option value="encoder">Encoder</option> 
                  </select>
                </div>
                <br/>
                <div class="input-group" id="editPWORD">
                  <span class="input-group-addon" id="basic-addon3">Password: </span>
                  <input type="password" class="form-control" id="passwordEdit" data-trigger= "hover" data-toggle="tooltip" title="Edit or change password." aria-describedby="basic-addon3" required>
                </div>
                <div class="modal-footer" >
                  <button type="submit" class="btn btn-default" data-dismiss="modal" data-trigger= "hover" data-toggle="tooltip" title="Click to edit user's details." id="saveEditUser">Edit</button>
                </div>
              </div>
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
            <h4 class="modal-title">Farm</h4>
          </div>

          <div class="modal-body">
            <div id="chooseToDoFarm" class="btnCenter">
              <button id="addFarmBtn" class="btnModal">Add Farm</button>
              <br/><br/>
              <button id="editFarmBtn" class="btnModal">Edit Farm</button>
            </div>
            
            <div id="addFarmDetails" style="display: none;">
              <div style="margin-bottom: 10%;">
                <button id="backToFarm1" style="float: right;">Back</button>
                <h3 class="modal-title" style="float: left;">Add Farm</h3>
              </div>
              <div class="input-group">
                <span class="input-group-addon" id="basic-addon3">Farm Name: </span>
                <input type="text" class="form-control" id="farmname" data-trigger= "hover"  data-toggle="tooltip" title="Input the name of the farm you want to add." aria-describedby="basic-addon3">
              </div>
              <br/>
              <div class="input-group">
                <span class="input-group-addon" id="basic-addon3">Address: </span>
                <input type="text" class="form-control" id="fadd" data-trigger= "hover" data-toggle="tooltip" title="Input the address of the new farm." aria-describedby="basic-addon3">
              </div>
              <div class="modal-footer" >
                <button type="button" class="btn btn-default" data-dismiss="modal" data-trigger= "hover" data-toggle="tooltip" title="Click to save farm's details." id="saveFarm">Add</button>
              </div>
            </div>

<<<<<<< HEAD
          <div id="editFarm" style="display: none;">
            <button id="backToFarm2">Back</button>
              <h2 class="modal-title">Edit Farm</h2>
            <div class="input-group" id="editFarmSearch">
                <center></center>
                
=======
            <div id="editFarm" style="display: none;">
              <div style="margin-bottom: 10%;">
                <button id="backToFarm2" style="float: right;">Back</button>
                <h3 class="modal-title" style="float: left;">Edit Farm</h3>
              </div>
              <div class="input-group">
>>>>>>> 0ce054b781dffc354c0e6221ef020b0582411985
                <span class="input-group-addon" id="basic-addon3">Search: </span>
                <select id="farmOptions" type="search" class="form-control" title="Search for farm to be edited">
                  <option> </option>
                </select>
              </div>
            </div>
      
            <div id="editFarmDetails" style="display: none;">
              <div class="input-group" id="editFARMNAME">
                <span class="input-group-addon" id="basic-addon3">Farm Name: </span>
                <input type="text" class="form-control" id="farmnameEdit" data-trigger= "hover"  data-toggle="tooltip" title="Edit the name of the farm." aria-describedby="basic-addon3">
              </div>
              <br/>
              <div class="input-group" id="editFADD">
                <span class="input-group-addon" id="basic-addon3">Address: </span>
                <input type="text" class="form-control" id="faddEdit" data-trigger= "hover" data-toggle="tooltip" title="Edit the address of the farm." aria-describedby="basic-addon3">
              </div>
              <div class="modal-footer" >
                <button type="button" class="btn btn-default" data-dismiss="modal" data-trigger= "hover" data-toggle="tooltip" title="Click to save farm's details." id="saveEditFarm">Edit</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Modal for add House-->
    <div id="myModalHouse" class="modal fade" role="dialog">
      <div class="modal-dialog">
        <div class="modal-content">
          
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" id="close">&times;</button>
            <h4 class="modal-title">House</h4>
          </div>

          <div class="modal-body">
            <div id="chooseToDoHouse" class="btnCenter">
              <button id="addHouseBtn" class="btnModal">Add House</button>
              <br/><br/>
              <button id="editHouseBtn" class="btnModal">Edit House</button>
            </div>

            <div id="addHouseDetails" style="display: none;">
              <div style="margin-bottom: 10%;">
                <button id="backToHouse1" style="float: right;">Back</button>
                <h3 class="modal-title" style="float: left;">Add House</h3>
              </div>
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
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal" data-trigger= "hover" data-toggle="tooltip" title="Click to save house's details." id="saveHouse">Add</button>
              </div>
            </div>

            <div id="editHouse" style="display: none;">
              <div style="margin-bottom: 10%;">
                <button id="backToHouse2" style="float: right;">Back</button>
                <h3 class="modal-title" style="float: left;">Edit House</h3>
              </div>
              <div class="input-group">
                <span class="input-group-addon" id="basic-addon3">Location: </span>
                <select class="form-control" id="loc1" style="color:black;" data-trigger= "hover" data-toggle="tooltip" title="Select the location/farm." required> 
                  <option value="" disabled selected>Select farm location...</option> 
                </select>
              </div>
              <br/>
              <div class="input-group">
                <span class="input-group-addon" id="basic-addon3">Search: </span>
                <select type="search" name="userName" id="searchHouse" class="form-control" placeholder="Search for House">
                  <option></option>
                </select>
              </div>
            </div>
                  
            <div id="editHouseDetails" style="display: none;">
              <div class="input-group" id="editHOUSELOC">
                <span class="input-group-addon" id="basic-addon3">Location: </span>
                <select class="form-control" id="editloc2" style="color:black;" data-trigger= "hover" data-toggle="tooltip" title="Edit the location/farm." required> 
                  <option value="" disabled selected>Select farm location...</option> 
                </select>
              </div>
              <br/>
              <div class="input-group" id="EDITHOUSENUM">
                <span class="input-group-addon" id="basic-addon3">House Number: </span>
                <input type="text" class="form-control" id="edithnum" data-trigger= "hover" data-toggle="tooltip" title="Edit the house number of the new house. Ex: 4A" aria-describedby="basic-addon3">
              </div>
              <br/>
              <div class="input-group" id="editHOUSENAME">
                <span class="input-group-addon" id="basic-addon3">House Name: </span>
                <input type="text" class="form-control" id="edithname" data-trigger= "hover" data-toggle="tooltip" title="Edit the house name of the new house. Ex: House 3" aria-describedby="basic-addon3">
              </div>
              <br/>
              <div class="input-group" id="editHOUSEFXN">
                <span class="input-group-addon" id="basic-addon3">Function: </span>
                <select  class="form-control" id="editfunc" name="selStat" style="color:black;" data-trigger= "hover" data-toggle="tooltip" title="Edit the function of the new house. Ex: Weaning" required> 
                  <option value="" disabled selected>Select function</option>
                  <option value="Weaning">Weaning</option> 
                  <option value="Growing">Growing</option> 
                  <option value="Slaughter">Slaughter</option> 
                </select> 
              </div>

              <div class="modal-footer" >
                <button type="button" class="btn btn-default" data-dismiss="modal" data-trigger= "hover" data-toggle="tooltip" title="Click to edit house's details." id="saveEditHouse">Edit</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Modal for add Pen-->
    <div id="myModalPen" class="modal fade" role="dialog">
      <div class="modal-dialog">
        <div class="modal-content"> 
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" id="close">&times;</button>
            <h4 class="modal-title">Pen</h4>
          </div>

          <div class="modal-body">
            <div id="chooseToDoPen" class="btnCenter">
              <button id="addPenBtn" class="btnModal">Add Pen</button>
              <br/><br/>
              <button id="editPenBtn" class="btnModal">Edit Pen</button>
            </div>

            <div id="addPenDetails" style="display: none;">
              <div style="margin-bottom: 10%;">
                <button id="backToPen1" style="float: right;">Back</button>
                <h3 class="modal-title" style="float: left;">Add Pen</h3>
              </div>
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
              <div class="modal-footer" >
                <button type="button" class="btn btn-default" data-dismiss="modal" data-trigger= "hover" data-toggle="tooltip" title="Click to save pen's details." id="savePen">Add</button>
              </div>
            </div>

            <div id="editPen" style="display: none;">
              <div style="margin-bottom: 10%;">
                <button id="backToPen2" style="float: right;">Back</button>
                <h3 class="modal-title" style="float: left;">Edit Pen</h3>
              </div>
              <div class="input-group">
                <span class="input-group-addon" id="basic-addon3">Location: </span>
                <select class="form-control" id="farm1" style="color:black;" data-trigger= "hover" data-toggle="tooltip" title="Select the location/farm of the new pen. Ex: Farm 1" required> 
                  <option value="" disabled selected>Select farm location...</option> 
                </select>
              </div>
              <br/>
              <div class="input-group">
                <span class="input-group-addon" id="basic-addon3">House Number: </span>
                <select class='form-control'  id='house1' style='color:black;' data-trigger= "hover" data-toggle="tooltip" title="Select the house number where the pen will be added. Ex: House 2" required> 
                  <option value='' disabled selected>Select house...</option> 
                </select> 
              </div>
              <br/>
              <div class="input-group">
                <span class="input-group-addon" id="basic-addon3">Search: </span>
                <select type="search" name="userName" id="searchPen" class="form-control" placeholder="Search for Pen">
                  <option></option>
                </select>
              </div>
            </div>
            
            <div id="editPenDetails" style="display: none;">
              <div class="input-group" id="editPENLOC">
                <span class="input-group-addon" id="basic-addon3">Location: </span>
                <select class="form-control" id="editfarm2" style="color:black;" data-trigger= "hover" data-toggle="tooltip" title="Select the location/farm of the new pen. Ex: Farm 1" required> 
                  <option value="" disabled selected>Select farm location...</option> 
                </select>
              </div>
              <br/>
              <div class="input-group" id="editPENHOUSE">
                <span class="input-group-addon" id="basic-addon3">House Number: </span>
                <select class='form-control'  id='edithouse2' style='color:black;' data-trigger= "hover" data-toggle="tooltip" title="Select the house number where the pen will be added. Ex: House 2" required> 
                  <option value='' disabled selected>Select house...</option> 
                </select> 
              </div>
              <br/>
              <div class="input-group" id="editPENNUM">
                <span class="input-group-addon" id="basic-addon3">Pen Number: </span>
                <input type="text" class="form-control" id="editpennum" data-trigger= "hover" data-toggle="tooltip" title="Input the pen number of the new pen. Ex: 29" aria-describedby="basic-addon3">
              </div>
              <br/>
              <div class="input-group" id="editPENFXN">
                <span class="input-group-addon" id="basic-addon3">Function: </span>
                <select  class="form-control" id="editfunc2" style="color:black;" data-trigger= "hover" data-toggle="tooltip" title="Select the function of the new pen. Ex: Weaning" required> 
                  <option value="" disabled selected>Select function</option>
                  <option value="Weaning">Weaning</option> 
                  <option value="Growing">Growing</option> 
                  <option value="Medication">Medication</option>
                  <option value="Mortality">Mortality</option> 
                </select> 
              </div>
              <div class="modal-footer" >
                <button type="button" class="btn btn-default" data-dismiss="modal" data-trigger= "hover" data-toggle="tooltip" title="Click to save pen's details." id="saveEditPen">Add</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Modal for Add Parent -->
    <div id="myModalParent" class="modal fade" role="dialog" >
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" id="close">&times;</button>
            <h4 class="modal-title">Parent</h4>
          </div>

          <div class="modal-body">
            <div id="chooseToDoParent" class="btnCenter">
              <button id="addParentBtn" class="btnModal">Add Parent</button>
              <br/><br/>
              <button id="editParentBtn" class="btnModal">Edit Parent</button>
            </div>
            
            <div id="addParentDetails" style="display: none;">
              <div style="margin-bottom: 10%;">
                <button id="backToParent1" style="float: right;">Back</button>
                <h3 class="modal-title" style="float: left;">Add Parent</h3>
              </div>
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
              <div class="modal-footer" >
                <button type="button" class="btn btn-default" data-trigger= "hover" data-dismiss="modal" data-toggle="tooltip" title="Click to save parent's details." id="saveParent">Add</button>
              </div>
            </div>
          
            <div id="editParent" style="display: none;">
              <div style="margin-bottom: 10%;">
                <button id="backToParent2" style="float: right;">Back</button>
                <h3 class="modal-title" style="float: left;">Edit Parent</h3>
              </div>
              <div class="input-group">
                <span class="input-group-addon" id="basic-addon3">Search: </span>
                <select type="search" name="userName" id="searchParent" class="form-control" placeholder="Search for parent">
                  </option></option>
                </select>
              </div>
            </div>
            
            <div id="editParentDetails" style="display: none;">
              <div class="input-group" id="editPARENTLABEL">
                <span class="input-group-addon" id="basic-addon3">Label: </span>
                <select  class="form-control" id="editparentLabel"  style="color:black;" data-trigger= "hover" data-toggle="tooltip" title="Select if the parent you will add is boar or sow." required> 
                  <option value="" disabled selected>Select parent label</option> 
                  <option value="boar">Boar</option> 
                  <option value="sow">Sow</option> 
                </select> 
              </div>
              <br/>
              <div class="input-group" id="editPARENTLABELID">
                <span class="input-group-addon" id="basic-addon3">Label ID: </span>
                <input type="text" class="form-control" id="editlabel_id" data-trigger= "hover" data-toggle="tooltip" title="Input the label id of the new boar/sow. Ex: AB123" aria-describedby="basic-addon3">
              </div>
              <div class="modal-footer" >
                <button type="button" class="btn btn-default" data-trigger= "hover" data-dismiss="modal" data-toggle="tooltip" title="Click to save parent's details." id="saveEditParent">Edit</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Modal for Add Breed -->
    <div id="myModalBreed" class="modal fade" role="dialog" >
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" id="close">&times;</button>
            <h4 class="modal-title">Breed</h4>
          </div>

          <div class="modal-body">

            <div id="chooseToDoBreed" class="btnCenter">
              <button id="addBreedBtn" class="btnModal">Add Breed</button>
              <br/><br/>
              <button id="editBreedBtn" class="btnModal">Edit Breed</button>
            </div>

            <div id="addBreedDetails" style="display: none;">
              <div style="margin-bottom: 10%;">
                <button id="backToBreed1" style="float: right;">Back</button>
                <h3 class="modal-title" style="float: left;">Add Breed</h3>
              </div>
              <div class="input-group">
                <span class="input-group-addon" id="basic-addon3">Breed Name: </span>
                <input type="text" class="form-control" id="breed_name" data-trigger= "hover" data-toggle="tooltip" title="Input new breed's name." aria-describedby="basic-addon3">
              </div>
              <div class="modal-footer" >
                <button type="button" class="btn btn-default" data-dismiss="modal" data-trigger= "hover" data-toggle="tooltip" title="Click to save breed's details." id="saveBreed">Add</button>
              </div>
            </div>

            <div id="editBreed" style="display: none;">
              <div style="margin-bottom: 10%;">
                <button id="backToBreed2" style="float: right;">Back</button>
                <h3 class="modal-title" style="float: left;">Edit Breed</h3>
              </div>
              <div class="input-group">
                <span class="input-group-addon" id="basic-addon3">Search: </span>
                <select type="search" id="searchBreed" class="form-control" placeholder="Search for breed">
                  <option></option>
                </select>
              </div>
            </div>
            
            <div id="editBreedDetails" style="display: none;">
              <div class="input-group" id="editBREEDNAME">
                <span class="input-group-addon" id="basic-addon3">Breed Name: </span>
                <input type="text" class="form-control" id="breed_name" data-trigger= "hover" data-toggle="tooltip" title="Input new breed's name." aria-describedby="basic-addon3">
              </div>
              <div class="modal-footer" >
                <button type="button" class="btn btn-default" data-dismiss="modal" data-trigger= "hover" data-toggle="tooltip" title="Click to save breed's details." id="saveEditBreed">Edit</button>
              </div>
            </div>
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
            <h4 class="modal-title">Feed</h4>
          </div>

          <div class="modal-body">

            <div id="chooseToDoFeed" class="btnCenter">
              <button id="addFeedBtn" class="btnModal">Add Feed</button>
              <br/><br/>
              <button id="editFeedBtn" class="btnModal">Edit Feed</button>
            </div>

            <div id="addFeedDetails" style="display: none;">
              <div style="margin-bottom: 10%;">
                <button id="backToFeed1" style="float: right;">Back</button>
                <h3 class="modal-title" style="float: left;">Add Feed</h3>
              </div>
              <div class="input-group">
                <span class="input-group-addon" id="basic-addon3">Feed Name: </span>
                <input type="text" class="form-control" id="feed_name" data-trigger= "hover" data-toggle="tooltip" title="Input the name of the new feed." aria-describedby="basic-addon3">
              </div>
              <br/>
              <div class="input-group">
                <span class="input-group-addon" id="basic-addon3">Feed Type: </span>
                <input type="text" class="form-control" id="feed_type" data-trigger= "hover" data-toggle="tooltip" title="Input the type of the new feed. Ex: Type 1 " aria-describedby="basic-addon3">
              </div>
              <div class="modal-footer" >
                <button type="button" class="btn btn-default" data-trigger= "hover" data-dismiss="modal" data-toggle="tooltip" title="Click to save feed details." id="saveFeed">Add</button>
              </div>
            </div>


            <div id="editFeed" style="display: none;">
              <div style="margin-bottom: 10%;">
                <button id="backToFeed2" style="float: right;">Back</button>
                <h3 class="modal-title" style="float: left;">Edit Feed</h3>
              </div>
              <div class="input-group">
                <span class="input-group-addon" id="basic-addon3">Search: </span>
                <select type="search" id="searchFeed" class="form-control" placeholder="Search for breed">
                  <option></option>
                </select>
              </div>
            </div>

            <div id="editFeedDetails" style="display: none;">
              <div class="input-group" id="editFEEDNAME">
                <span class="input-group-addon" id="basic-addon3">Feed Name: </span>
                <input type="text" class="form-control" id="edit_feed_name" data-trigger= "hover" data-toggle="tooltip" title="Input the name of the new feed." aria-describedby="basic-addon3">
              </div>
              <br/>
              <div class="input-group" id="editFEEDTYPE">
                <span class="input-group-addon" id="basic-addon3">Feed Type: </span>
                <input type="text" class="form-control" id="edit_feed_type" data-trigger= "hover" data-toggle="tooltip" title="Input the type of the new feed. Ex: Type 1 " aria-describedby="basic-addon3">
              </div>
              <div class="modal-footer" >
                <button type="button" class="btn btn-default" data-trigger= "hover" data-dismiss="modal" data-toggle="tooltip" title="Click to save feed details." id="saveEditFeed">Edit</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Modal for Add Med -->
    <div id="myModalMeds" class="modal fade" role="dialog" >
      <div class="modal-dialog">
        <div class="modal-content"> 
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" id="close">&times;</button>
            <h4 class="modal-title">Medication</h4>
          </div>
          <div class="modal-body">

            <div id="chooseToDoMeds" class="btnCenter">
              <button id="addMedsBtn" class="btnModal">Add Meds</button>
              <br/><br/>
              <button id="editMedsBtn" class="btnModal">Edit Meds</button>
            </div>

            <div id="addMedsDetails" style="display: none;">
              <div style="margin-bottom: 10%;">
                <button id="backToMeds1" style="float: right;">Back</button>
                <h3 class="modal-title" style="float: left;">Add Medication</h3>
              </div>
              <div class="input-group">
                <span class="input-group-addon" id="basic-addon3">Medication Name: </span>
                <input type="text" class="form-control" id="med_name" data-trigger= "hover" data-toggle="tooltip" title="Input the name of the new feed." aria-describedby="basic-addon3">
              </div>
              <br/>
              <div class="input-group">
                <span class="input-group-addon" id="basic-addon3">Medication Type: </span>
                <input type="text" class="form-control" id="med_type" data-trigger= "hover" data-toggle="tooltip" title="Input the type of the new feed. Ex: Type 1 " aria-describedby="basic-addon3">
              </div>
              <div class="modal-footer" >
                <button type="button" class="btn btn-default" data-trigger= "hover" data-dismiss="modal" data-toggle="tooltip" title="Click to save feed details." id="saveMeds">Add</button>
              </div>
            </div>

            <div id="editMeds" style="display: none;">
              <div style="margin-bottom: 10%;">
                <button id="backToMeds2" style="float: right;">Back</button>
                <h3 class="modal-title" style="float: left;">Edit Medication</h3>
              </div>
              <div class="input-group">
                <span class="input-group-addon" id="basic-addon3">Search: </span>
                <select type="search" id="searchMeds" class="form-control" placeholder="Search for medications">
                  <option></option>
                </select>
              </div>
            </div>

            <div id="editMedsDetails" style="display: none;">
              <div class="input-group" id="editMEDNAME">
                <span class="input-group-addon" id="basic-addon3">Medication Name: </span>
                <input type="text" class="form-control" id="edit_med_name" data-trigger= "hover" data-toggle="tooltip" title="Edit name of medication." aria-describedby="basic-addon3">
              </div>
              <br/>
              <div class="input-group" id="editMEDTYPE">
                <span class="input-group-addon" id="basic-addon3">Medication Type: </span>
                <input type="text" class="form-control" id="edit_med_type" data-trigger= "hover" data-toggle="tooltip" title="Edit the type of the new feed. Ex: Type 1 " aria-describedby="basic-addon3">
              </div>
              <div class="modal-footer" >
                <button type="button" class="btn btn-default" data-trigger= "hover" data-dismiss="modal" data-toggle="tooltip" title="Click to save feed details." id="saveEditMeds">Edit</button>
              </div>
            </div>
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
          $('#chooseToDo').attr("style", "display: inline-block");
          $('#addUserDetails').attr("style", "display: none");
          $('#editUser').attr("style", "display: none");
          $('#editUserDetails').attr("style", "display: none");
        });

        $('#addUserBtn').on("click",function() {
          $('#chooseToDo').attr("style", "display: none");
          $('#addUserDetails').attr("style", "display: inline-block");
          $('#editUser').attr("style", "display: none");
          $('#editUserDetails').attr("style", "display: none");
        });

        $('#editUserBtn').on("click",function() {
          $('#chooseToDo').attr("style", "display: none");
          $('#addUserDetails').attr("style", "display: none"); 
          $('#editUser').attr("style", "display: inline-block");
          $('#addUserDetails').attr("style", "display: none");
        });

         
         $('#searchUser').on('change',function(){
          var name = $("#searchUser").val();
          viewDetailsUser(name);
        });


        $('#backToUser1').on("click",function() {
          $('#chooseToDo').attr("style", "display: inline-block");
          $('#addUserDetails').attr("style", "display: none"); 
          $('#editUser').attr("style", "display: none");
          $('#addUserDetails').attr("style", "display: none");
        });

        $('#backToUser2').on("click",function() {
          $('#chooseToDo').attr("style", "display: inline-block");
          $('#addUserDetails').attr("style", "display: none"); 
          $('#editUser').attr("style", "display: none");
          $('#addUserDetails').attr("style", "display: none"); 
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

        $('#saveEditUser').on("click",function(){
            var user = $('#userId').val();
            var prev_uname = $('#prev_uname').val();
            var user_name = $('#unameEdit').val();
            var prev_utype = $('#prev_utype').val();
            var user_Type = $('#uTypeEdit').val();
            var prev_pword = $('#prev_pword').val();
            var password = $('#passwordEdit').val();
            
              var uType;
              if(user_Type === "admin"){
                uType = 1;
              }else{
                uType = 2;
              }
                 $.ajax({
                    url: '/phpork/gateway/admin.php',
                    type: 'post',
                    data : {
                      editUser: '1',
                      user: user,
                      prev_uname: prev_uname,
                      username: user_name,
                      prev_pword: prev_pword,
                      password: password,
                      prev_utype: prev_utype,
                      usertype: uType
                    },
                    success: function (data) {
                        alert("User edited");
                        window.location = "/phpork/admin/home"; 
                    }    
                  });
         

          });

//FARM

          /*Farm*/

        $('#addFarm').on("click",function() {
          e.preventDefault(); 
          $('#myModalFarm').modal('show');
          $('#chooseToDoFarm').attr("style", "display: inline-block");
          $('#addFarmDetails').attr("style", "display: none");
          $('#editFarm').attr("style", "display: none");
          $('#editFarmDetails').attr("style", "display: none");
        });

        $('#addFarmBtn').on("click",function() {
          $('#chooseToDoFarm').attr("style", "display: none");
          $('#addFarmDetails').attr("style", "display: inline-block");
          $('#editFarm').attr("style", "display: none");
          $('#editFarmDetails').attr("style", "display: none");
        });

        $('#editFarmBtn').on("click",function() {
          $('#chooseToDoFarm').attr("style", "display: none");
          $('#addFarmDetails').attr("style", "display: none");
          $('#editFarm').attr("style", "display: inline-block");
          $('#editFarmDetails').attr("style", "display: none");
        });

        $('#farmOptions').on('change',function(){
          var id = $("#farmOptions").val();
          viewDetailsFarm(id);
        });
        
        $('#backToFarm1').on("click",function() {
          $('#chooseToDoFarm').attr("style", "display: inline-block");
          $('#addFarmDetails').attr("style", "display: none");
          $('#editFarm').attr("style", "display: none");
          $('#editFarmDetails').attr("style", "display: none");
        });

        $('#backToFarm2').on("click",function() {
          $('#chooseToDoFarm').attr("style", "display: inline-block"); 
          $('#addFarmDetails').attr("style", "display: none"); 
          $('#editFarm').attr("style", "display: none");
          $('#editFarmDetails').attr("style", "display: none");
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

         $('#saveEditFarm').on("click",function(){
            var user = $('#userId').val();
            var prev_loc_name = $('#prev_loc_name').val();
            var farmnameEdit = $('#farmnameEdit').val();
            var prev_addr = $('#prev_addr').val();
            var faddEdit = $('#faddEdit').val();
            var loc_id = $('#loc_id').val();
           
            
              if((farnameEdit != '') && (faddEdit != '') ){
                 $.ajax({
                    url: '/phpork/gateway/admin.php',
                    type: 'post',
                    data : {
                      editLocationName: '1',
                      user: user,
                      prev_lname: prev_loc_name,
                      lname: farmnameEdit,
                      prev_addr: prev_addr,
                      addr: faddEdit,
                      loc_id: loc_id
                    },
                    success: function (data) {
                        alert("Farm edited");
                        window.location = "/phpork/admin/home"; 
                    }    
                  });
                }
         

          });

         /*Add House*/
        $('#addHouse').on("click",function() {
           e.preventDefault(); 
            $('#myModalHouse').modal('show');
            $('#chooseToDoHouse').attr("style", "display: inline-block");
            $('#addHouseDetails').attr("style", "display: none");
            $('#editHouse').attr("style", "display: none"); 
            $('#editHouseDetails').attr("style", "display: none");
        });

          $('#addHouseBtn').on("click",function() {
         
            $('#addHouseDetails').attr("style", "display: inline-block");
             $('#editHouse').attr("style", "display: none");
             
             $('#editHouseDetails').attr("style", "display: none");
              $('#chooseToDoHouse').attr("style", "display: none");
          
        });
           $('#editHouseBtn').on("click",function() {
            $('#editHouse').attr("style", "display: inline-block");
           
            $('#editHouseDetails').attr("style", "display: none");
            $('#addHouseDetails').attr("style", "display: none");
            $('#chooseToDoHouse').attr("style", "display: none");
          
        });
           $('#searchHouse').on('change',function(){
              var id = $("#searchHouse").val();
              viewDetailsHouse(id);
            });

        $('#backToHouse1').on("click",function() {
          
            $('#editHouse').attr("style", "display: none");
            $('#addHouseDetails').attr("style", "display: none");
            $('#chooseToDoHouse').attr("style", "display: inline-block");
          
        });

          $('#backToHouse2').on("click",function() {
          
            $('#editHouse').attr("style", "display: none");
            $('#addHouseDetails').attr("style", "display: none");
            $('#chooseToDoHouse').attr("style", "display: inline-block");
          
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

        $('#saveEditHouse').on("click",function(){
            var user = $('#userId').val();
            var prev_loc_id = $('#prev_loc_id').val();
            var editLoc = $('#editloc2').val();
            var prev_h_no = $('#prev_h_no').val();
            var edithnum = $('#edithnum').val();
            var prev_h_name = $('#prev_h_name').val();
            var edithname = $('#edithname').val();
            var prev_fxn = $('#prev_fxn').val();
            var editfunc = $('#editfunc').val();
            var h_id = $('#h_id').val();
           
            
              if((edithnum != '') && (edithname != '') && (editfunc != '') ){
                 $.ajax({
                    url: '/phpork/gateway/admin.php',
                    type: 'post',
                    data : {
                      editHouseName: '1',
                      user: user,
                      prev_hno: prev_h_no,
                      hno: edithnum, 
                      prev_hname: prev_hname,
                      hname: edithname,
                      prev_fxn: prev_fxn
                      fxn: editfunc,
                      prev_loc: prev_loc_id,
                      loc: editLoc
                      house_id: h_id
                    },
                    success: function (data) {
                        alert("House edited");
                        window.location = "/phpork/admin/home"; 
                    }    
                  });
                }
         

          });
        /*End of Add House*/


        /*Add Pen */
        $('#farm1').on("change", function(e) {
            e.preventDefault(); 
              var location = $('#farm1').val();

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
                        $("#house1").append($("<option></option>").attr("value",data[i].h_id)
                          .attr("name","house")
                          .text("House " +data[i].h_no)); 
                      }

                    } 
              });
           });

        $('#house1').on("change", function(e) {
            e.preventDefault(); 
              var house = $('#house1').val();

              $.ajax({
                url: '/phpork/gateway/pen.php',
                type: 'post',
                data : {
                  getPenByHouse: '1',
                  h_id: house
                },
                success: function (data) { 
                   var data = jQuery.parseJSON(data); 
                      for(i=0;i<data.length;i++){
                        $("#searchPen").append($("<option></option>").attr("value",data[i].pen_id)
                          .attr("name","pen")
                          .text("Pen " +data[i].pen_no)); 
                      }

                    } 
              });
           });

        $('#farm2').on("change", function(e) {
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
                        $("#house2").append($("<option></option>").attr("value",data[i].h_id)
                          .attr("name","house")
                          .text("House " +data[i].h_no)); 
                      }

                    } 
              });
           });

         $('#addPen').on("click",function() {
           e.preventDefault(); 
            $('#myModalPen').modal('show');
            $('#chooseToDoPen').attr("style", "display: inline-block");
            $('#addPenDetails').attr("style", "display: none");
             $('#editPen').attr("style", "display: none");
          
        });

          $('#addPenBtn').on("click",function() {
         
            $('#addPenDetails').attr("style", "display: inline-block");
             $('#editPen').attr("style", "display: none");
             $('#editPenSearch').attr("style", "display: none");
             $('#editPenDetails').attr("style", "display: none");
              $('#chooseToDoPen').attr("style", "display: none");
          
        });
           $('#editPenBtn').on("click",function() {
            $('#editPen').attr("style", "display: inline-block");
            $('#editPenSearch').attr("style", "display: inline-block");
            $('#editPenDetails').attr("style", "display: none");
            $('#addPenDetails').attr("style", "display: none");
            $('#chooseToDoPen').attr("style", "display: none");
          
        });
           $('#searchPen').on('change',function(){
              var id = $("#searchPen").val();
              viewDetailsPen(id);
            });

        $('#backToPen1').on("click",function() {
          
            $('#editPen').attr("style", "display: none");
            $('#addPenDetails').attr("style", "display: none");
            $('#chooseToDoPen').attr("style", "display: inline-block");
          
        });

          $('#backToPen2').on("click",function() {
          
            $('#editPen').attr("style", "display: none");
            $('#addPenDetails').attr("style", "display: none");
            $('#chooseToDoPen').attr("style", "display: inline-block");
          
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

         $('#saveEditPen').on("click",function(){
            var user = $('#userId').val();
            var prev_pen_loc = $('#prev_pen_loc').val();
            var editfarm = $('#editfarm2').val();
            var prev_pen_house = $('#prev_pen_house').val();
            var edithouse2 = $('#edithouse2').val();
            var prev_pen_no = $('#prev_pen_no').val();
            var editpennum = $('#editpennum').val();
            var prev_pen_fxn = $('#prev_pen_fxn').val();
            var editfunc2 = $('#editfunc2').val();
            var prev_pen_id = $('#prev_pen_id').val();
           
            
             if((editpennum != '') && (editfunc2 != '') ){
                 $.ajax({
                    url: '/phpork/gateway/admin.php',
                    type: 'post',
                    data : {
                      editHouseName: '1',
                      user: user,
                      prev_penno: prev_pen_no,
                      penno: editpennum,
                      prev_fxn: prev_pen_fxn,
                      fxn: editfunc2,
                      prev_h_id: prev_pen_house,
                      h_id: edithouse2,
                      prev_loc_id: prev_pen_loc,
                      loc_id: prev_pen_loc,
                      pen_id: prev_pen_id
                    },
                    success: function (data) {
                        alert("Pen edited");
                        window.location = "/phpork/admin/home"; 
                    }    
                  });
                }
         

          });
         /*End of Add Pen*/

         /*Add Parent*/
         $('#addParent').on("click",function(e) {
           e.preventDefault(); 
            $('#myModalParent').modal('show');
            $('#chooseToDoParent').attr("style", "display: inline-block");
            $('#addParentDetails').attr("style", "display: none");
             $('#editParent').attr("style", "display: none");
          
        });

          $('#addParentBtn').on("click",function() {
         
            $('#addParentDetails').attr("style", "display: inline-block");
             $('#editParent').attr("style", "display: none");
             $('#editParentSearch').attr("style", "display: none");
             $('#editParentDetails').attr("style", "display: none");
              $('#chooseToDoParent').attr("style", "display: none");
          
        });
           $('#editParentBtn').on("click",function() {
            $('#editParent').attr("style", "display: inline-block");
            $('#editParentSearch').attr("style", "display: inline-block");
            $('#editParentDetails').attr("style", "display: none");
            $('#addParentDetails').attr("style", "display: none");
            $('#chooseToDoParent').attr("style", "display: none");
          
        });
           $('#searchParent').on('change',function(){
              var id = $("#searchParent").val();
              viewDetailsParent(id);
            });

        $('#backToParent1').on("click",function() {
          
            $('#editParent').attr("style", "display: none");
            $('#addParentDetails').attr("style", "display: none");
            $('#chooseToDoParent').attr("style", "display: inline-block");
          
        });

          $('#backToParent2').on("click",function() {
          
            $('#editParent').attr("style", "display: none");
            $('#addParentDetails').attr("style", "display: none");
            $('#chooseToDoParent').attr("style", "display: inline-block");
          
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

          $('#saveEditParent').on("click",function(){
            var user = $('#userId').val();
            var prev_label_id = $('#prev_label_id').val();
            var editlabel_id = $('#editlabel_id').val();
            var prev_parent_label = $('#prev_parent_label').val();
            var editparentLabel = $('#editparentLabel').val();
            var prev_parent_id = $('#prev_parent_id').val();
           
            
             if((editlabel_id != '') && (editparentLabel != '') ){
                 $.ajax({
                    url: '/phpork/gateway/admin.php',
                    type: 'post',
                    data : {
                      editParent: '1',
                      user: user,
                      prev_parent: prev_parent_label,
                      parent: editparentLabel,
                      prev_id: prev_label_id,
                      id: editlabel_id,
                      parent_id: prev_parent_id
                    },
                    success: function (data) {
                        alert("Parent edited");
                        window.location = "/phpork/admin/home"; 
                    }    
                  });
                }
         

          });
         /*End of Add Parent*/

         /*Add Breed*/
         $('#addBreed').on("click",function() {
           e.preventDefault(); 
            $('#myModalBreed').modal('show');
            $('#chooseToDoBreed').attr("style", "display: inline-block");
            $('#addBreedDetails').attr("style", "display: none");
            $('#editBreed').attr("style", "display: none");
          $('#editBreedDetails').attr("style", "display: none");
        });

        $('#addBreedBtn').on("click",function() {
          console.log("add");
          $('#chooseToDoBreed').attr("style", "display: none");
          $('#addBreedDetails').attr("style", "display: inline-block");
          $('#editBreed').attr("style", "display: none");
          $('#editBreedDetails').attr("style", "display: none");
        });

        $('#editBreedBtn').on("click",function() {
          $('#chooseToDoBreed').attr("style", "display: none"); 
          $('#addBreedDetails').attr("style", "display: none");
          $('#editBreed').attr("style", "display: inline-block");
          $('#editBreedDetails').attr("style", "display: none");
        });

        $('#searchBreed').on('change',function(){
              var id = $("#searchBreed").val();
              viewDetailsBreed(id);
            });

        $('#backToBreed1').on("click",function() {
          $('#chooseToDoBreed').attr("style", "display: inline-block"); 
          $('#addBreedDetails').attr("style", "display: none");
          $('#editBreed').attr("style", "display: none");
          $('#editBreedDetails').attr("style", "display: none");
        });

        $('#backToBreed2').on("click",function() {
          $('#chooseToDoBreed').attr("style", "display: inline-block"); 
          $('#addBreedDetails').attr("style", "display: none");
          $('#editBreed').attr("style", "display: none");
          $('#editBreedDetails').attr("style", "display: none");
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

         $('#saveEditBreed').on("click",function(){
            var user = $('#userId').val();
            var prev_br_name = $('#prev_br_name').val();
            var breednameEdit = $('#breednameEdit').val();
            var prev_br_id = $('#prev_br_id').val();
           
            
              if((breed_name != '') ){
                 $.ajax({
                    url: '/phpork/gateway/admin.php',
                    type: 'post',
                    data : {
                      editBreed: '1',
                      user: user,
                      prev_bname: prev_br_name,
                      breed_name: breednameEdit,
                      breed_id: prev_br_id
                    },
                    success: function (data) {
                        alert("Breed edited");
                        window.location = "/phpork/admin/home"; 
                    }    
                  });
                }
         

          });
         /*End of Add Breed*/

          /*Add Feed*/
         $('#addFeed').on("click",function() {
           e.preventDefault(); 
            $('#myModalFeed').modal('show');
            $('#chooseToDoFeed').attr("style", "display: inline-block");
            $('#addFeedDetails').attr("style", "display: none");
             $('#editFeed').attr("style", "display: none");
          
        });

          $('#addFeedBtn').on("click",function() {
          console.log("add");
            $('#addFeedDetails').attr("style", "display: inline-block");
             $('#editFeed').attr("style", "display: none");
             $('#editFeedSearch').attr("style", "display: none");
             $('#editFeedDetails').attr("style", "display: none");
              $('#chooseToDoFeed').attr("style", "display: none");
          
        });
           $('#editFeedBtn').on("click",function() {
            $('#editFeed').attr("style", "display: inline-block");
            $('#editFeedSearch').attr("style", "display: inline-block");
            $('#editFeedDetails').attr("style", "display: none");
            $('#addFeedDetails').attr("style", "display: none");
            $('#chooseToDoFeed').attr("style", "display: none");
          
        });

        $('#searchFeed').on('change',function(){
              var id = $("#searchFeed").val();
              viewDetailsFeed(id);
            });

        $('#backToFeed1').on("click",function() {
          
            $('#editFeed').attr("style", "display: none");
            $('#addFeedDetails').attr("style", "display: none");
            $('#chooseToDoFeed').attr("style", "display: inline-block");
          
        });

          $('#backToFeed2').on("click",function() {
          
            $('#editFeed').attr("style", "display: none");
            $('#addFeedDetails').attr("style", "display: none");
            $('#chooseToDoFeed').attr("style", "display: inline-block");
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

         $('#saveEditFeed').on("click",function(){
            var user = $('#userId').val();
            var prev_feed_name = $('#prev_feed_name').val();
            var edit_feed_name = $('#edit_feed_name').val();
            var prev_feed_type = $('#prev_feed_type').val();
            var edit_feed_type = $('#edit_feed_type').val();
            var prev_feed_id = $('#prev_feed_id').val();
           
            
             if((edit_feed_name != '') && (edit_feed_type != '') ){
                 $.ajax({
                    url: '/phpork/gateway/admin.php',
                    type: 'post',
                    data : {
                      editFeedName: '1',
                      user: user,
                      prev_fname: prev_feed_name,
                      fname: edit_feed_name,
                      prev_ftype: prev_feed_type,
                      ftype: prev_feed_type,
                      feed_id: prev_feed_id
                    },
                    success: function (data) {
                        alert("Feed edited");
                        window.location = "/phpork/admin/home"; 
                    }    
                  });
                }
         

          });
         /*End of Add Feed*/


         /*Add Med*/
          $('#addMeds').on("click",function() {
           e.preventDefault(); 
            $('#myModalMeds').modal('show');
            $('#chooseToDoMeds').attr("style", "display: inline-block");
            $('#addMedsDetails').attr("style", "display: none");
             $('#editMeds').attr("style", "display: none");
          
        });

          $('#addMedsBtn').on("click",function() {
          console.log("add");
            $('#addMedsDetails').attr("style", "display: inline-block");
             $('#editMeds').attr("style", "display: none");
             $('#editMedsSearch').attr("style", "display: none");
             $('#editMedsDetails').attr("style", "display: none");
              $('#chooseToDoMeds').attr("style", "display: none");
          
        });
           $('#editMedsBtn').on("click",function() {
            $('#editMeds').attr("style", "display: inline-block");
            $('#editMedsSearch').attr("style", "display: inline-block");
            $('#editMedsDetails').attr("style", "display: none");
            $('#addMedsDetails').attr("style", "display: none");
            $('#chooseToDoMeds').attr("style", "display: none");
          
        });

        $('#searchMeds').on('change',function(){
              var id = $("#searchMeds").val();
              viewDetailsMeds(id);
            });

        $('#backToMeds1').on("click",function() {
          
            $('#editMeds').attr("style", "display: none");
            $('#addMedsDetails').attr("style", "display: none");
            $('#chooseToDoMeds').attr("style", "display: inline-block");
          
        });

          $('#backToMeds2').on("click",function() {
          
            $('#editMeds').attr("style", "display: none");
            $('#addMedsDetails').attr("style", "display: none");
            $('#chooseToDoMeds').attr("style", "display: inline-block");
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

         
          $('#saveEditMed').on("click",function(){
            var user = $('#userId').val();
            var prev_med_name = $('#prev_med_name').val();
            var edit_med_name = $('#edit_med_name').val();
            var prev_med_type = $('#prev_med_type').val();
            var edit_med_type = $('#edit_med_type').val();
            var prev_med_id = $('#prev_med_id').val();
           
            
             if((edit_med_name != '') && (edit_med_type != '') ){
                 $.ajax({
                    url: '/phpork/gateway/admin.php',
                    type: 'post',
                    data : {
                      editMedName: '1',
                      user: user,
                      prev_mname: prev_med_name,
                      mname: edit_med_name,
                      prev_mtype: prev_med_type,
                      mtype: prev_med_type,
                      med_id: prev_med_id
                    },
                    success: function (data) {
                        alert("Medication edited");
                        window.location = "/phpork/admin/home"; 
                    }    
                  });
                }
         

          });
         /*End of Add Med*/
          

  
        $.ajax({
          url: '/phpork/gateway/auth.php',
          type: 'post',
          data : {
            ddl_user: '1'
          },
          success: function (data) { 
             var data = jQuery.parseJSON(data);
             console.log('User');
                for(i=0;i<data.length;i++){
                  $("#searchUser").append($("<option></option>").attr("value",data[i].user_id)
                    .attr("name","user")
                    .text(data[i].username)); 
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
                  $("#farm").append($("<option></option>").attr("value",data[i].loc_id)
                    .attr("name","location")
                    .text(data[i].loc_name)); 
                   $("#farm1").append($("<option></option>").attr("value",data[i].loc_id)
                    .attr("name","location")
                    .text(data[i].loc_name)); 
                   
                   $("#farmOptions").append($("<option></option>").attr("value",data[i].loc_id)
                    .attr("name","location")
                    .text(data[i].loc_name)); 

                   $("#loc1").append($("<option></option>").attr("value",data[i].loc_id)
                    .attr("name","location")
                    .text(data[i].loc_name));
                  $("#loc2").append($("<option></option>").attr("value",data[i].loc_id)
                    .attr("name","location")
                    .text(data[i].loc_name)); 
                }
                   
              } 
          
        });

        $('#loc1').on("change", function(e) {
            e.preventDefault(); 
              var location = $('#loc1').val();

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
                        $("#searchHouse").append($("<option></option>").attr("value",data[i].h_id)
                          .attr("name","house")
                          .text("House " +data[i].h_no)); 
                      }

                    } 
              });
           });

          $.ajax({
          url: '/phpork/gateway/pig.php',
          type: 'post',
          data : {
            ddl_parent: '1'
          },
          success: function (data) { 
             var data = jQuery.parseJSON(data);
                for(i=0;i<data.length;i++){
                  $("#searchParent").append($("<option></option>").attr("value",data[i].parent_id)
                    .attr("name","user")
                    .text(data[i].label+ "-" +data[i].label_id)); 
                }
                   
              } 
          
        });

          $.ajax({
          url: '/phpork/gateway/pig.php',
          type: 'post',
          data : {
            ddl_breeds: '1'
          },
          success: function (data) { 
             var data = jQuery.parseJSON(data);
                for(i=0;i<data.length;i++){
                  $("#searchBreed").append($("<option></option>").attr("value",data[i].brid)
                    .attr("name","breed")
                    .text(data[i].brname)); 
                }
                   
              } 
          
        });

          $.ajax({
          url: '/phpork/gateway/feeds.php',
          type: 'post',
          data : {
            ddl_feeds: '1'
          },
          success: function (data) { 
             var data = jQuery.parseJSON(data);
                for(i=0;i<data.length;i++){
                  $("#searchFeed").append($("<option></option>").attr("value",data[i].feed_id)
                    .attr("name","user")
                    .text(data[i].feed_name)); 
                }
                   
              } 
          
        });
           $.ajax({
          url: '/phpork/gateway/meds.php',
          type: 'post',
          data : {
            ddl_meds: '1'
          },
          success: function (data) { 
             var data = jQuery.parseJSON(data);
                for(i=0;i<data.length;i++){
                  $("#searchMeds").append($("<option></option>").attr("value",data[i].med_id)
                    .attr("name","user")
                    .text(data[i].med_name)); 
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
<script>
  function viewDetailsUser(id){
     $.ajax({
              url: '/phpork/gateway/auth.php',
              type: 'post',
              data : {
               getUser: '1',
               user_id: id
              },
              success: function (data) { 
                var data = jQuery.parseJSON(data);
                  $('#unameEdit').attr("placeholder", data[0].user_name);
                  $('#uTypeEdit').attr("placeholder", data[0].user_type);
                  $('#passwordEdit').attr("placeholder", data[0].password);

                  $('#editUNAME').append($("<input></input>").attr("type", "hidden")
                                                              .attr("id", "prev_uname")
                                                              .attr("value", data[0].user_name));
                  $('#editUNAME').append($("<input></input>").attr("type", "hidden")
                                                              .attr("id", "user_id")
                                                              .attr("value", data[0].user_id));

                   $('#editUTYPE').append($("<input></input>").attr("type", "hidden")
                                                              .attr("id", "prev_utype")
                                                              .attr("value", data[0].user_type));

                    $('#editPWORD').append($("<input></input>").attr("type", "hidden")
                                                              .attr("id", "prev_pword")
                                                              .attr("value", data[0].password));

                    $('#editUserSearch').attr("style", "display: none");
                    $('#editUserDetails').attr("style", "display: inline-block");
                }  
            });

            

  }

   function viewDetailsFarm(id){
     $.ajax({
              url: '/phpork/gateway/location.php',
              type: 'post',
              data : {
               getLocDetails: '1',
               loc: id
              },
              success: function (data) { 
                var data = jQuery.parseJSON(data);
                  $('#farmnameEdit').attr("placeholder", data[0].loc_name);
                  $('#faddEdit').attr("placeholder", data[0].addr);

                  $('#editFARMNAME').append($("<input></input>").attr("type", "hidden")
                                                              .attr("id", "prev_loc_name")
                                                              .attr("value", data[0].loc_name));
                  $('#editFARMNAME').append($("<input></input>").attr("type", "hidden")
                                                              .attr("id", "loc_id")
                                                              .attr("value", data[0].loc_id));
                   $('#editFADD').append($("<input></input>").attr("type", "hidden")
                                                              .attr("id", "prev_addr")
                                                              .attr("value", data[0].addr));

                   $('#editFarmSearch').attr("style", "display: none");
                  $('#editFarmDetails').attr("style", "display: inline-block");
                   
                }  
            });
  }

      function viewDetailsHouse(id){
     $.ajax({
              url: '/phpork/gateway/house.php',
              type: 'post',
              data : {
               getHouseDetails: '1',
               h_id: id
              },
              success: function (data) { 
                var data = jQuery.parseJSON(data);
                  $('#editlabel_id').attr("placeholder", data[0].label_id);
                   $('#editparentLabel').attr("placeholder", data[0].label);
                  


                  $('#editHOUSELOC').append($("<input></input>").attr("type", "hidden")
                                                              .attr("id", "prev_loc_id")
                                                              .attr("value", data[0].loc_id));
                  $('#editHOUSENUM').append($("<input></input>").attr("type", "hidden")
                                                              .attr("id", "prev_h_no")
                                                              .attr("value", data[0].h_no));
                  $('#editHOUSENUM').append($("<input></input>").attr("type", "hidden")
                                                              .attr("id", "prev_h_id")
                                                              .attr("value", data[0].h_id));
                  $('#editHOUSENAME').append($("<input></input>").attr("type", "hidden")
                                                              .attr("id", "prev_h_name")
                                                              .attr("value", data[0].h_name));
                   $('#editHOUSEFXN').append($("<input></input>").attr("type", "hidden")
                                                              .attr("id", "prev_fxn")
                                                              .attr("value", data[0].fxn));

                   $('#editHouseSearch').attr("style", "display: none");
                  $('#editHouseDetails').attr("style", "display: inline-block");
                   
                }  
            });
      }

       function viewDetailsPen(id){
     $.ajax({
              url: '/phpork/gateway/pen.php',
              type: 'post',
              data : {
               getPenDetails: '1',
               pen: id
              },
              success: function (data) { 
                var data = jQuery.parseJSON(data);
                  $('#editfarm2').attr("placeholder", data[0].loc_id);
                   $('#edithouse2').attr("placeholder", data[0].h_no);
                  $('#editpennum').attr("placeholder", data[0].h_name);
                  $('#editfunc2').attr("placeholder", data[0].fxn);


                  $('#editPENLOC').append($("<input></input>").attr("type", "hidden")
                                                              .attr("id", "prev_pen_loc")
                                                              .attr("value", data[0].loc_id));
                  $('#editPENNUM').append($("<input></input>").attr("type", "hidden")
                                                              .attr("id", "prev_pen_no")
                                                              .attr("value", data[0].pen_no));
                  $('#editPENNUM').append($("<input></input>").attr("type", "hidden")
                                                              .attr("id", "prev_pen_id")
                                                              .attr("value", data[0].pen_id));
                   $('#editPENFXN').append($("<input></input>").attr("type", "hidden")
                                                              .attr("id", "prev_pen_fxn")
                                                              .attr("value", data[0].fxn));

                   $('#editPenSearch').attr("style", "display: none");
                  $('#editPenDetails').attr("style", "display: inline-block");
                   
                }  
            });
      }

      function viewDetailsParent(id){
     $.ajax({
              url: '/phpork/gateway/pig.php',
              type: 'post',
              data : {
               getParentDetails: '1',
               parent: id
              },
              success: function (data) { 
                var data = jQuery.parseJSON(data);
                  $('#editlabel_id').attr("placeholder", data[0].label_id);
                   $('#editparentLabel').attr("placeholder", data[0].label);
                 


                  $('#editPARENTLABELID').append($("<input></input>").attr("type", "hidden")
                                                              .attr("id", "prev_label_id")
                                                              .attr("value", data[0].label_id));
                  $('#editPARENTLABELID').append($("<input></input>").attr("type", "hidden")
                                                              .attr("id", "prev_parent_id")
                                                              .attr("value", data[0].parent_id));
                  $('#editPARENTLABEL').append($("<input></input>").attr("type", "hidden")
                                                              .attr("id", "prev_parent_label")
                                                              .attr("value", data[0].label));
                   
                   $('#editParentSearch').attr("style", "display: none");
                  $('#editParentDetails').attr("style", "display: inline-block");
                   
                }  
            });
      }
            
    function viewDetailsBreed(id){
     $.ajax({
              url: '/phpork/gateway/pig.php',
              type: 'post',
              data : {
               getBreed: '1',
               breed_id: id
              },
              success: function (data) { 
                var data = jQuery.parseJSON(data);
                  $('#breednameEdit').attr("placeholder", data[0].breed_name);

                  $('#editBREEDNAME').append($("<input></input>").attr("type", "hidden")
                                                              .attr("id", "prev_br_name")
                                                              .attr("value", data[0].breed_name));
                  $('#editBREEDNAME').append($("<input></input>").attr("type", "hidden")
                                                              .attr("id", "prev_br_id")
                                                              .attr("value", data[0].breed_id));
                  
                   $('#editBreedSearch').attr("style", "display: none");
                  $('#editBreedDetails').attr("style", "display: inline-block");
                   
                }  
            });
      }
      function viewDetailsFeed(id){
     $.ajax({
              url: '/phpork/gateway/feeds.php',
              type: 'post',
              data : {
               getFeedsDetails: '1',
               feed: id
              },
              success: function (data) { 
                var data = jQuery.parseJSON(data);
                  $('#edit_feed_name').attr("placeholder", data[0].fname);
                  $('#edit_feed_type').attr("placeholder", data[0].ftype);

                  $('#editFEEDNAME').append($("<input></input>").attr("type", "hidden")
                                                              .attr("id", "prev_feed_name")
                                                              .attr("value", data.fname));
                  $('#editFEEDNAME').append($("<input></input>").attr("type", "hidden")
                                                              .attr("id", "prev_feed_type")
                                                              .attr("value", data.ftype));
                  
                   $('#editFeedSearch').attr("style", "display: none");
                  $('#editFeedDetails').attr("style", "display: inline-block");
                   
                }  
            });
      }
       function viewDetailsMeds(id){
         $.ajax({
              url: '/phpork/gateway/meds.php',
              type: 'post',
              data : {
               getMedsDetails: '1',
               meds: id
              },
              success: function (data) { 
                var data = jQuery.parseJSON(data);
                  $('#edit_med_name').attr("placeholder", data.mname);
                  $('#edit_med_type').attr("placeholder", data.mtype);

                  $('#editMEDSNAME').append($("<input></input>").attr("type", "hidden")
                                                              .attr("id", "prev_med_name")
                                                              .attr("value", data[0].mname));
                  $('#editMEDSNAME').append($("<input></input>").attr("type", "hidden")
                                                              .attr("id", "prev_med_id")
                                                              .attr("value", data[0].mid));
                  $('#editMEDSTYPE').append($("<input></input>").attr("type", "hidden")
                                                              .attr("id", "prev_med_type")
                                                              .attr("value", data[0].mtype));
                  
                   $('#editMedsSearch').attr("style", "display: none");
                  $('#editMedsDetails').attr("style", "display: inline-block");
                   
                }  
            });
      }

</script>
   
  </body>
</html>

