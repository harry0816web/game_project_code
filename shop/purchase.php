<?php
  if(!isset($_COOKIE['username'])){
    header("location: ../login/login.php");
  }
  require_once "../db.php";
  $username = $_COOKIE['username'];
  $coinFetch = $link->query("SELECT `coin` FROM `game_character` WHERE `username`='{$username}'");
  $coinCheck = $coinFetch->fetch_assoc()['coin'];
  $atkDrop = $_GET['atkDrop'];
  $hpDrop = $_GET['hpDrop'];
  $lowerDamageDrop = $_GET['lowerDamageDrop'];
  $totalCost = ($atkDrop + $hpDrop + $lowerDamageDrop)*100;  //計算價錢
  if(!$atkDrop && !$hpDrop  && !$lowerDamageDrop){  //不夠coin or 沒有選數量
    header("location: shop.php?err=buyNothing");
  }
  else if($coinCheck < $totalCost){
    header("location: shop.php?err=needMoreCoin");
  }
  else{   //金幣-花費  藥水數量更新
    $sql = "UPDATE `game_character`
            SET `atkUp_drops`=`atkUp_drops`+'{$atkDrop}',
            `hpUp_drops`=`hpUp_drops`+'{$hpDrop}',
            `damageDown_drops`=`damageDown_drops`+'{$lowerDamageDrop}',
            `coin` = `coin`-'{$totalCost}'
            WHERE `username`='{$username}'
    ";
    $link->query($sql);
    $link->close();
    header("location: shop.php?purchase=succed");
  }
 ?>
