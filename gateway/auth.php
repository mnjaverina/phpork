<?php
  include "../inc/functions.php";
  $db = new phpork_functions();

  if(isset($_POST['loginFlag'])){
    $u = $_POST['username'];
    $p = $_POST['password'];
    if($db->login($u,$p)){
     //  $db->addHistory("",$_SESSION['username'] . " Logged in");
      header("location: /phpork/home");
    }else{
      header("location: /phpork/in?loginFailed=1");
    }
  }
  if(isset($_POST['signup'])){
    $u = $_POST['username'];
    $p = $_POST['password'];
    
      $db->signup($u, $p);
     
  }else{
      header("location: /phpork/in");
    
  
  }
?>