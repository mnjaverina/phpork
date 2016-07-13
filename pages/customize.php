<!DOCTYPE html>
<html lang="en">
  <?php 
    session_start(); 
    require_once "../connect.php"; 
    require_once "../inc/dbinfo.inc"; 
    if(!isset($_SESSION['username']) || !isset($_SESSION['password'])) {
      header("Location: /phpork/user"); 
    }
    include "../inc/functions.php"; 
    $db = new phpork_functions ();

    $parentage1_status = 'unchecked';
    $parentage2_status = 'unchecked';
    $parentage3_status = 'unchecked';
    $parentage4_status = 'unchecked';
    $movement1_status = 'unchecked';
    $movement2_status = 'unchecked';
    $movement3_status = 'unchecked';
    $movement4_status = 'unchecked';
    $feeds1_status = 'unchecked';
    $feeds2_status = 'unchecked';
    $feeds3_status = 'unchecked';
    $feeds4_status = 'unchecked';
    $vitasup1_status = 'unchecked';
    $vitasup2_status = 'unchecked';
    $vitasup3_status = 'unchecked';
    $vitasup4_status = 'unchecked';
    $medicine1_status = 'unchecked';
    $medicine2_status = 'unchecked';
    $medicine3_status = 'unchecked';
    $medicine4_status = 'unchecked';
    $water1_status = 'unchecked';
    $water2_status = 'unchecked';
    $water3_status = 'unchecked';
    $water4_status = 'unchecked';
    $prodinfo1_status = 'unchecked';
    $prodinfo2_status = 'unchecked';
    $prodinfo3_status = 'unchecked';
    $prodinfo4_status = 'unchecked';
    $people1_status = 'unchecked';
    $people2_status = 'unchecked';
    $people3_status = 'unchecked';
    $people4_status = 'unchecked';
  
    if(isset($_POST['submit'])) {
      if($selected_radio = $_POST['parentage']){
        if($selected_radio == 'parentage_NOT_record') {
          $parentage1_status = 'checked';
        } 
        elseif($selected_radio == 'parentage_save_local') {
          $parentage2_status = 'checked';
        }
        elseif($selected_radio == 'parentage_keep_private') {
          $parentage3_status = 'checked';
        }
        elseif($selected_radio == 'parentage_open_data') {
          $parentage4_status = 'checked';
        }
      }
      
      if($selected_radio = $_POST['movement']){
        if($selected_radio == 'movement_NOT_record') {
          $movement1_status = 'checked';
        }  
        elseif($selected_radio == 'movement_save_local') {
          $movement2_status = 'checked';
        }
        elseif($selected_radio == 'movement_keep_private') {
          $movement3_status = 'checked';
        }
        elseif($selected_radio == 'movement_open_data') {
          $movement4_status = 'checked';
        }
      }

      if($selected_radio = $_POST['feeds']){  
        if($selected_radio == 'feeds_NOT_record') {
          $feeds1_status = 'checked';
        } 
        elseif($selected_radio == 'feeds_save_local') {
          $feeds2_status = 'checked';
        }
        elseif($selected_radio == 'feeds_keep_private') {
          $feeds3_status = 'checked';
        }
        elseif($selected_radio == 'feeds_open_data') {
          $feeds4_status = 'checked';
        }
      }    

      if($selected_radio = $_POST['vitasup']){ 
        if($selected_radio == 'vitasup_NOT_record') {
          $vitasup1_status = 'checked';
        } 
        elseif($selected_radio == 'vitasup_save_local') {
          $vitasup2_status = 'checked';
        }
        elseif($selected_radio == 'vitasup_keep_private') {
          $vitasup3_status = 'checked';
        }
        elseif($selected_radio == 'vitasup_open_data') {
          $vitasup4_status = 'checked';
        }
      }

      if($selected_radio = $_POST['medicine']){ 
        if($selected_radio == 'medicine_NOT_record') {
          $medicine1_status = 'checked';
        } 
        elseif($selected_radio == 'medicine_save_local') {
          $medicine2_status = 'checked';
        }
        elseif($selected_radio == 'medicine_keep_private') {
          $medicine3_status = 'checked';
        }
        elseif($selected_radio == 'medicine_open_data') {
          $medicine4_status = 'checked';
        }
      }

      if($selected_radio = $_POST['water']){   
        if($selected_radio == 'water_NOT_record') {
          $water1_status = 'checked';
        } 
        elseif($selected_radio == 'water_save_local') {
          $water2_status = 'checked';
        }
        elseif($selected_radio == 'water_keep_private') {
          $water3_status = 'checked';
        }
        elseif($selected_radio == 'water_open_data') {
          $water4_status = 'checked';
        }
      }

      if($selected_radio = $_POST['prodinfo']){  
        if($selected_radio == 'prodinfo_NOT_record') {
          $prodinfo1_status = 'checked';
        } 
        elseif($selected_radio == 'prodinfo_save_local') {
          $prodinfo2_status = 'checked';
        }
        elseif($selected_radio == 'prodinfo_keep_private') {
          $prodinfo3_status = 'checked';
        }
        elseif($selected_radio == 'prodinfo_open_data') {
          $prodinfo4_status = 'checked';
        }
      }  
      
      if($selected_radio = $_POST['people']){ 
        if($selected_radio == 'people_NOT_record') {
          $people1_status = 'checked';
        } 
        elseif($selected_radio == 'people_save_local') {
          $people2_status = 'checked';
        }
        elseif($selected_radio == 'people_keep_private') {
          $people3_status = 'checked';
        }
        elseif($selected_radio == 'people_open_data') {
          $people4_status = 'checked';
        }
      }    
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
    <link rel="stylesheet" href="<?php echo HOST;?>/phpork/css/style_customize.css"> 
    <script src="<?php echo HOST;?>/phpork/js/jquery-latest.min.js" type="text/javascript"></script> 
  </head> 
  <body>
    <div class="page-header" data-trigger= "hover" data-toggle="tooltip" title="Click to go back to home page which is 'View', 'Insert' and 'Customize' " data-placement="bottom"> 
      <a href="/phpork/encoder/home" >
        <img class="img-responsive" src="<?php echo HOST;?>/phpork/images/Header1.png"> 
      </a>
    </div>

    <form class="form-horizontal col-xs-10 col-sm-10 col-md-10 col-lg-10"  method="post" action="/phpork/out" style="width:50%; float:right;"> 
      <div class="form-group logout" > 
        <input type="text" class="col-xs-6 col-sm-5" readonly style="text-align: left; border: 2px solid; border-color: #83b26a;" value="<?php echo $_SESSION['username'];?>"> 
        <div class="col-xs-1 col-sm-1" style="left: -1%;"> 
          <button type="submit" class="btn btn-primary btn-sm" >Logout</button> 
        </div> 
      </div> 
    </form> 

    
      <div class="lower">
        <div class="table1">
        <table class="table">
          <thead>
            <tr>
              <th rowspan="3">Data</th>
              <th rowspan="3" style="text-align: center;">Do NOT Record</th>
              <th colspan="3" style="text-align: center;">Record</th>
            </tr>
            <tr>
              <th rowspan="2" style="text-align: center;">BUT Save Locally</th>
              <th colspan="2" style="text-align: center;">AND Send to NPTS</th>
            </tr>
            <tr>
              <th style="text-align: center;">BUT Keep Private</th>
              <th style="text-align: center;">AND Open Data</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <th class="theader" scope="row" name="parentage">Parentage</td>
              <td><input class="c" id="a1" type="radio" name="radio" value="parentage_NOT_record"></td>
              <td><input class="c" id="a2" type="radio" name="radio" value="parentage_save_local"></td>
              <td><input class="c" id="a3" type="radio" name="radio" value="parentage_keep_private"></td>
              <td><input class="c" id="a4" type="radio" name="radio" value="parentage_open_data"></td>
            </tr>
            <tr>
              <th class="theader" scope="row" name="movement">Movement</td>
              <td><input class="c" id="b1" type="radio" name="radio" value="movement_NOT_record"></td>
              <td><input class="c" id="b2" type="radio" name="radio" value="movement_save_local"></td>
              <td><input class="c" id="b3" type="radio" name="radio" value="movement_keep_private"></td>
              <td><input class="c" id="b4" type="radio" name="radio" value="movement_open_data"></td>
            </tr>
            <tr>
              <th class="theader" scope="row" name="feeds">Feeds</td>
              <td><input class="c" id="c1" type="radio" name="radio" value="feeds_NOT_record"></td>
              <td><input class="c" id="c2" type="radio" name="radio" value="feeds_save_local"></td>
              <td><input class="c" id="c3" type="radio" name="radio" value="feeds_keep_private"></td>
              <td><input class="c" id="c4" type="radio" name="radio" value="feeds_open_data"></td>
            </tr>
            <tr>
              <th class="theader" scope="row" name="vitasup">Vitamins and Supplements</td>
              <td><input class="c" id="d1" type="radio" name="radio" value="vitasup_NOT_record"></td>
              <td><input class="c" id="d2" type="radio" name="radio" value="vitasup_save_local"></td>
              <td><input class="c" id="d3" type="radio" name="radio" value="vitasup_keep_private"></td>
              <td><input class="c" id="d4" type="radio" name="radio" value="vitasup_open_data"></td>
            </tr>
            <tr>
              <th class="theader" scope="row" name="medicine">Medicine</td>
              <td><input class="c" id="e1" type="radio" name="radio" value="medicine_NOT_record"></td>
              <td><input class="c" id="e2" type="radio" name="radio" value="medicine_save_local"></td>
              <td><input class="c" id="e3" type="radio" name="radio" value="medicine_keep_private"></td>
              <td><input class="c" id="e4" type="radio" name="radio" value="medicine_open_data"></td>
            </tr>
            <tr>
              <th class="theader" scope="row" name="water">Water</td>
              <td><input class="c" id="f1" type="radio" name="radio" value="water_NOT_record"></td>
              <td><input class="c" id="f2" type="radio" name="radio" value="water_save_local"></td>
              <td><input class="c" id="f3" type="radio" name="radio" value="water_keep_private"></td>
              <td><input class="c" id="f4" type="radio" name="radio" value="water_open_data"></td>
            </tr>
            <tr>
              <th class="theader" scope="row" name="prodinfo">Production Information</td>
              <td><input class="c" id="g1" type="radio" name="radio" value="prodinfo_NOT_record"></td>
              <td><input class="c" id="g2" type="radio" name="radio" value="prodinfo_save_local"></td>
              <td><input class="c" id="g3" type="radio" name="radio" value="prodinfo_keep_private"></td>
              <td><input class="c" id="g4" type="radio" name="radio" value="prodinfo_open_data"></td>
            </tr>
            <tr>
              <th class="theader" scope="row" name="people">People</td>
              <td><input class="c" id="h1" type="radio" name="radio" value="people_NOT_record"></td>
              <td><input class="c" id="h2" type="radio" name="radio" value="people_save_local"></td>
              <td><input class="c" id="h3" type="radio" name="radio" value="people_keep_private"></td>
              <td><input class="c" id="h4" type="radio" name="radio" value="people_open_data"></td>
            </tr>
          </tbody>
        </table>
      </div>
    </br>
    <div style="margin-left: 40%">
       <button type="button" class="btn1" id="backH">
          <span class="glyphicon glyphicon-ok" aria-hidden="true"></span> DONE 
      </button>
    </div>
      </div>

 <div class="page-footer"> 
      Prototype Pork Traceability System || Copyright &copy; 2014 - <?php echo date("Y");?> UPLB || funded by PCAARRD 
    </div>
  </body>
</html>
