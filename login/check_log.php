<?php
  require_once "../db.php";
  if(isset($_POST['account'])){
    $sql = "SELECT `password` FROM `user` WHERE `username` = '{$_POST['account']}'";
    $result = mysqli_query($link,$sql);
    //取得此帳號的密碼

    if(mysqli_num_rows($result) > 0){
      if($_POST['password'] == mysqli_fetch_assoc($result)['password']){//若玩家輸入==使用者密碼
        setcookie("username",$_POST['account'],time()+3600*12,"/");
        header("location: ../homepage/homepage.php");
        //建立使用者帳號的cookie與轉址到主頁
      }
      else{
        header('location: login.php?err=pwWrong');
        //回傳密碼error至登入畫面
      }
    }
    else{
      header('location: login.php?err=nameWrong');
      //回傳帳號error至登入畫面
    }
  }
?>
