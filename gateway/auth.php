<?php
  include "../inc/functions.php";
  $db = new phpork_functions();
  if(isset($_POST['loginFlag'])){
    $u = $_POST['username'];
    $p = $_POST['password'];
    if($db->login($u,$p)){
     //  $db->addHistory("",$_SESSION['username'] . " Logged in");
      header("location: ../pages/index.php");
    }else{
      header("location: ../pages/login.php?loginFailed=1");
    }
  }
?>