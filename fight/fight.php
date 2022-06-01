<?php
  require_once "../db.php";
  $username = $_COOKIE['username'];
  $sql = "SELECT `atk`,`hp`,`coin`,`exp`,`stage`,`newBossChallenged`,`defeatMobNums`
          FROM `game_character`
          WHERE `username`='{$username}'";
  $result = $link->query($sql);
  $data = $result->fetch_assoc();
  $playerATK = $data['atk'];
  $playerHP = $data['hp'];
  $exp = $data['exp'];
  $coin = $data['coin'];
  $stage = $data['stage'];
  $challenged = $data['newBossChallenged'];
  $defeatMobNums = $data['defeatMobNums'];
  $fightMob = false;
  $virusPicPath = '';
  $win_exp;
  $win_coin;
  $monsterATK;
  $monsterHP;
  $fightBoss;
  $monsterType;
  $stageUpFight = false;
  if(isset($_GET['mobNum'])){
    $fightMob = true;
    $dataChangeFetch = $link->query("SELECT `mobDataChange` FROM `game_character`");
    $mobDataTimes = $dataChangeFetch->fetch_assoc()['mobDataChange'];
    if($mobDataTimes > 1){
      $mobExpCoinTimes = $mobDataTimes * 0.6;
    }
    else {
      $mobExpCoinTimes = $mobDataTimes * 1;
    }
    $monster = "mob{$_GET['mobNum']}";
    $fightBoss = false;
    $Mnum = $_GET['mobNum'];
    $Msql = "SELECT `mobPicPath`,`atk`,`hp`,`win_coin`,`win_exp`
            FROM `mobs`
            WHERE `mobNum`={$Mnum}";
    $MonsterResult = $link->query($Msql);
    $monsterData = $MonsterResult->fetch_assoc();
    $virusPicPath = $monsterData['mobPicPath'];
    $win_exp = $monsterData['win_exp'] * $mobExpCoinTimes;
    $win_coin = $monsterData['win_coin'] * $mobDataTimes;
    $monsterATK = $monsterData['atk'] * $mobDataTimes;
    $monsterHP = $monsterData['hp'] * $mobDataTimes;
  }
  else if(isset($_GET['bossNum'])){
    $bossNum = intval($_GET['bossNum']);
    if($bossNum == $stage){
      $stageUpFight = true;
    }
    $monster= "boss{$_GET['bossNum']}";
    //若未挑戰boss1 無法挑戰boss2
    if($stage < $_GET['bossNum']){
      header("location: ../homepage/homepage.php?err=tooWeak");
    }
    else if($defeatMobNums < 3){
      header("location: ../homepage/homepage.php?err=mustDefeatThreeMobs");
    }
    $fightBoss = true;
    $Mnum = $_GET['bossNum'];
    $Msql = "SELECT `bossPicPath`,`atk`,`hp`,`win_coin`,`win_exp`,`bossName`,`description`
            FROM `boss`
            WHERE `bossNum`={$Mnum}";
    $MonsterResult = $link->query($Msql);
    $monsterData = $MonsterResult->fetch_assoc();
    $virusPicPath = $monsterData['bossPicPath'];
    $win_exp = $monsterData['win_exp'];
    $win_coin = $monsterData['win_coin'];
    $monsterATK = $monsterData['atk'];
    $monsterHP = $monsterData['hp'];
    $bossName = $monsterData['bossName'];
    $description = $monsterData['description'];
  }
 ?>

<!DOCTYPE html>
<html id="background">
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="fight.css">
        <script src="fight.js" defer></script>
        <script src="useDropsJS.php" defer></script>
        <script type="text/javascript" src="getQandAjs.php"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    </head>
    <body>
      <audio autoplay="autoplay" controls="controls"loop="loop" preload="auto"
          src="../audio/fight_bgm.mp3" style="display:none;">
        你的瀏覽器版本太低，不支援audio標籤
    </audio>
        <div id="description" style="padding:5vh;padding-top:0;height:80vh;width:50vw;position:absolute;left:25vw;top:10vh;background-color:aquamarine;z-index:2;border-radius:25px;<?php if(!isset($_GET['bossNum'])) echo 'display:none;' ?>">
          <h1 style="text-align:center"><?php  echo $bossName;?></h1>
          <h3 style="margin-top:5vh;text-align:center;font-size:4vh;line-height:5vh;"><?php echo $description; ?></h3>
          <button type="button" name="button" onclick="closeWindow()" style="width:7vw;height:7vh;position:absolute;left:22vw;bottom:10vh;background-color:burlywood;border:none;border-radius:25px;">關閉</button>
        </div>

        <div style="display:none;" id="monster"><?php if(!$challenged) echo "true"; ?></div>
        <div style="display:none;" id="stageUpBoss"><?php if($stageUpFight)echo "true"; ?></div>
        <div style="display:none;" id="fightMob"><?php if($fightMob) echo "true"; ?></div>
        <div class="container-fluid">
            <div class="row">
                <main class="col-5" style="position:relative;">
                    <div id="MonsterATK">怪物的攻擊力:<?php echo $monsterATK; ?></div>
                    <div id="MonsterHP" class="rounded-pill">HP:<?php echo $monsterHP; ?></div>
                    <img src="<?php echo $virusPicPath; ?>" alt="" class="monsterPicture" id="monsterPic">
                    <div id="PlayerHP" class="rounded-pill">HP:<?php echo $playerHP; ?></div>
                    <div id="PlayerATK">你的攻擊力:<?php echo $playerATK; ?></div>
                </main>
                <aside class="questions col-7" style="padding: 0%;">
                    <div id="showQuestion"></div>
                    <div id="showOptions"></div>
                    <input type="checkbox" id="toggler" style="display:none;">
                    <label for="toggler" class="drops">
                      <div>使用藥水</div>
                    </label>
                    <div class="nav_bar">
                      <h1 style="justify-content:end;">使用藥水</h1>
                      <span class="drop" id="atkDropName" showAtkDropNums=''  > <img src="../dropsPicture/atk.png" alt="" id="atkDrop" onclick="atkUp()"> </span>
                      <span class="drop" id="hpDropName" showHpDropNums=''  > <img src="../dropsPicture/hp.png" alt="" id="hpDrop" onclick="hpUp()"> </span>
                      <span class="drop" id="damageDownDropName" showDamageDownDropNums=''  > <img src="../dropsPicture/damageDown.png" alt="" id="damageDownDrop" onclick="damageDown()"> </span>
                    </div>
                </aside>
            </div>
        </div>
        <div class="showResult" id="showResult">
        <form class="sendData" action="result.php" method="get">
           <h1 style="text-align: center;">對戰結果</h1>
           <h2 style="text-align: center;" id="winOrLose"></h2>
           <table class="loot" >
               <tr>
                   <td>獲得金幣</td>
                   <td id="coinGet"> <?php echo $win_coin; ?> </td>
               </tr>
               <tr>
                   <td></td>
                   <td id="coin">=><?php echo $coin;?></td>
               </tr>
               <tr>
                   <td>獲得經驗值</td>
                   <td id="expGet">  <?php echo $win_exp; ?>  </td>
               </tr>
               <tr>
                   <td></td>
                   <td id="exp">=><?php echo $exp;?></td>
               </tr>
               <button type="submit" id="backToHomepage">確認</button>
           </table>
           <div id="getDropsNums" style="display:none">
               <div id="atkDropNum" name="atkUp_drops" value=""></div>
               <div id="hpDropNum" name="hpUp_drops"></div>
               <div id="damageDownDropNum" name="damageDown_drops"></div>
           </div>
        </form>
        </div>
    </body>
</html>
