<?php
  $challenged = 1;
  $description = '';
  $monsterPicPath;
  $monsterName;
  $monsterData;
  if(isset($_GET['bossNum'])){
    require_once '../db.php';
    $bossNum = $_GET['bossNum'];
    $sql = "SELECT `bossName`,`bossPicPath`,`challenged`,`description`
            FROM `boss`
            WHERE `bossNum`={$bossNum}
    ";
    $result = $link->query($sql);
    $monsterData = $result->fetch_assoc();
    $monsterName = $monsterData['bossName'];
    $monsterPicPath = $monsterData['bossPicPath'];
    $challenged = $monsterData['challenged'];
    $description = $monsterData['description'];
  }
  else if(isset($_GET['mobNum'])){
    require_once '../db.php';
    $mobNum = $_GET['mobNum'];
    $sql = "SELECT `mobName`,`mobPicPath`,`challenged`,`description`
            FROM `mobs`
            WHERE `mobNum`={$mobNum}
    ";
    $result = $link->query($sql);
    $monsterData = $result->fetch_assoc();
    $monsterName = $monsterData['mobName'];
    $monsterPicPath = $monsterData['mobPicPath'];
    $challenged = $monsterData['challenged'];
    $description = $monsterData['description'];
  }
  print_r($monsterData);
 ?>
