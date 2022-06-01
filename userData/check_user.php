<?php
  require_once "../db.php";
  if(!isset($_COOKIE['username'])){
    header('location: ../login/login.php');
  }
  $username = $_COOKIE['username'];
  $result = $link->query("SELECT `password` FROM `user` WHERE `username`='{$username}'");
  $password = $result->fetch_assoc()['password'];
  if($password == $_POST['password']){
    header("location: userData.php?userCorrect=true");
  }
  else{
    header("location: checkUser.php?err=true");
  }
?>
