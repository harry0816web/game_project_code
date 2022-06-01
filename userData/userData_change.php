<?php
  require_once '../db.php';
  $username = $_COOKIE['username'];
  $username_change = $username;
  $result = $link->query("SELECT `password` FROM `user` WHERE `username`='{$username}'");
  $password_change = $result->fetch_assoc()['password'];
  //取得當前帳號的密碼

  if(isset($_POST['username']) or isset($_POST['password'])){
    if($_POST['username'] != "") {
      $username_change = $_POST['username'];  //更改後的帳號
    }
    if($_POST['password'] != "") {
      $password_change = $_POST['password'];  //更改後的密碼
    }

    //UPDATE
    $sql = "UPDATE `user` SET `username`='{$username_change}',`password` = '{$password_change}' WHERE `username` = '{$username}'";
    $link->query($sql);
    $link->query("UPDATE `game_character` SET `username`='{$username_change}' WHERE `username` = '{$username}'");
    $_COOKIE['username'] = $_POST['username'];

    //重新生成COOKIE
    setcookie("username",$_POST['username'],time()*60*12,'/');
    header('location: ../homepage/homepage.php');
  }
  else {
    header('location: ../homepage/homepage.php');
  }

 ?>
