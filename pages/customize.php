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
    <link rel="stylesheet" href="<?php echo HOST;?>/phpork/css/style_customize.css"> 
    <script src="<?php echo HOST;?>/phpork/js/jquery-latest.min.js" type="text/javascript"></script> 
  </head> 
  <body> 
     <div class="page-header"> 
      <a href="<?php echo HOST;?>/phpork/pages/index.php">
        <img class="img-responsive" src="<?php echo HOST;?>/phpork/css/images/Header1.png"> 
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
              <th scope="row">Parentage</td>
              <td><input id="c" type="radio" name="optradio"></td>
              <td><input id="c" type="radio" name="optradio"></td>
              <td><input id="c" type="radio" name="optradio"></td>
              <td><input id="c" type="radio" name="optradio"></td>
            </tr>
            <tr>
              <th scope="row">Movement</td>
              <td><input id="c" type="radio" name="optradio1"></td>
              <td><input id="c"type="radio" name="optradio1"></td>
              <td><input id="c" type="radio" name="optradio1"></td>
              <td><input id="c" type="radio" name="optradio1"></td>
            </tr>
            <tr>
              <th scope="row">Feeds</td>
              <td><input id="c" type="radio" name="optradio2"></td>
              <td><input id="c" type="radio" name="optradio2"></td>
              <td><input id="c" type="radio" name="optradio2"></td>
              <td><input id="c" type="radio" name="optradio2"></td>
            </tr>
            <tr>
              <th scope="row">Vitamins and Supplements</td>
              <td><input id="c" type="radio" name="optradio3"></td>
              <td><input id="c" type="radio" name="optradio3"></td>
              <td><input id="c" type="radio" name="optradio3"></td>
              <td><input id="c" type="radio" name="optradio3"></td>
            </tr>
            <tr>
              <th scope="row">Medicine</td>
              <td><input id="c" type="radio" name="optradio4"></td>
              <td><input id="c" type="radio" name="optradio4"></td>
              <td><input id="c" type="radio" name="optradio4"></td>
              <td><input id="c" type="radio" name="optradio4"></td>
            </tr>
            <tr>
              <th scope="row">Water</td>
              <td><input id="c" type="radio" name="optradio5"></td>
              <td><input id="c" type="radio" name="optradio5"></td>
              <td><input id="c" type="radio" name="optradio5"></td>
              <td><input id="c" type="radio" name="optradio5"></td>
            </tr>
            <tr>
              <th scope="row">Production Information</td>
              <td><input id="c" type="radio" name="optradio6"></td>
              <td><input id="c" type="radio" name="optradio6"></td>
              <td><input id="c" type="radio" name="optradio6"></td>
              <td><input id="c" type="radio" name="optradio6"></td>
            </tr>
            <tr>
              <th scope="row">People</td>
              <td><input id="c" type="radio" name="optradio7"></td>
              <td><input id="c" type="radio" name="optradio7"></td>
              <td><input id="c" type="radio" name="optradio7"></td>
              <td><input id="c" type="radio" name="optradio7"></td>
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
