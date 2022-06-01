<?php
  require_once "../db.php";
  $username = $_COOKIE['username'];
  $atkUp_drops = $_COOKIE['atkUp_drops'];
  $hpUp_drops = $_COOKIE['hpUp_drops'];
  $damageDown_drops = $_COOKIE['damageDown_drops'];
  $exp = intval($_COOKIE['exp']);
  $coin = $_COOKIE['coin'];
  print_r($_COOKIE);
//更改藥水數量
  if(isset($_COOKIE['stageUp'])){ //打敗boss 下一關
    $link->query(
           "UPDATE `game_character`
            SET `atkUp_drops`='{$atkUp_drops}',`hpUp_drops`='{$hpUp_drops}',
            `damageDown_drops`='{$damageDown_drops}',`exp`='{$exp}',`coin`='{$coin}',
            `stage`=`stage`+1,`newBossChallenged`=0,`defeatMobNums`=0,`mobDataChange`=`mobDataChange`+1
            WHERE `username`='{$username}'"
          );
  }
  else{
      if(isset($_COOKIE['challenged'])){ //把怪物的是否被挑戰值改為是
        $link->query(
                "UPDATE `game_character`
                 SET `newBossChallenged`=1
                 WHERE `username`='{$username}'"
          );
      }
      $link->query(
            "UPDATE `game_character`
              SET `atkUp_drops`='{$atkUp_drops}',`hpUp_drops`='{$hpUp_drops}',
              `damageDown_drops`='{$damageDown_drops}',`exp`='{$exp}',`coin`='{$coin}'
              WHERE `username`='{$username}'"
            );
    }


    if(isset($_COOKIE['defeatMob'])){//更改擊敗小怪數
      $link->query(
        "UPDATE `game_character`
         SET `defeatMobNums` =  `defeatMobNums` + 1
         WHERE `username`='{$username}'"
       );
    }


  $result = $link->query("SELECT `levelUp_range`FROM `game_character` WHERE `username`='{$username}'");
  $levelUp_range = intval($result->fetch_assoc()['levelUp_range']);
  if($exp >= $levelUp_range){
    $link->query(
            "UPDATE `game_character`
            SET `level`=`level`+1,`exp`=`exp`-`levelUp_range`,`levelUp_range`=`levelUp_range`*2,
                `atk`=`atk`*1.3,`hp`=`hp`*1.2
            WHERE `username`='{$username}'
            ");
            $link->close();
            header("location: ../homepage/homepage.php?levelUp=true{$stageUp}");
    }
  else{
    $link->close();
    header("location: ../homepage/homepage.php{$stageUp}");
  }


 ?>
