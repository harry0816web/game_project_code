<?php
    if(!isset($_COOKIE['username'])){
      header("location: ../login/login.php");
    }
    $username = $_COOKIE['username'];
    require_once "../db.php";
    $result = $link->query("SELECT `stage` FROM `game_character` WHERE `username`='{$username}'");
    $stage = $result->fetch_assoc()['stage'];
    $canChallenge = array();
    for($cnt = 0;$cnt < 10;$cnt ++){
      if($cnt + 1 <= $stage){
        $canChallenge[] = 1;
      }
      else{
        $canChallenge[] = 0;
      }
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <link rel="stylesheet" href="homepage.css">
        <link rel="stylesheet" href="main.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css">
        <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="homepage.js" defer></script>
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
        <script type="text/javascript" src="../clickSound.js"></script>
    </head>
    <body>
      <audio src="../audio/click.mp3" id="clickSound"></audio>
      <audio preload="preload" autoplay="autoplay" controls="controls"loop="loop" preload="auto"
          src="../audio/game_bgm.mp3" style="display:none;">
        你的瀏覽器版本太低，不支援audio標籤
    </audio>
      <aside class="showInfo">
      </aside>
      <main class="mobs">
        <a href="../fight/fight.php?mobNum=1" class="mob1" style="text-decoration: none;position:absolute;left:-3vw;top:-6vh;">
          <h2 style="position:absolute;left:3vw;top:15vh;color:black;font-weight:bold;">小怪1</h2>
          <img src="../virusPictures/mob1.png" alt="" style="width:5vw;position:absolute;left:3vw;top:5vh;">
        </a>
        <a href="../fight/fight.php?mobNum=2" class="mob1" style="text-decoration: none;position:absolute;left:10vw;top:-6vh;">
          <h2 style="position:absolute;top:15vh;left:-1vw;color:black;font-weight:bold;">小怪2</h2>
          <img src="../virusPictures/mob2.png" alt="" style="width:4vw;position:absolute;top:8vh;">
          </a>
          <a href="../flipCard/flipCard.php?type=hiragana" class="link" style="text-decoration: none;position:absolute;left:35vw;top:15vh;">
            <h2 style="position:absolute;left:4vw;top:19vh;color:black;font-weight:bold;width:10vw;">平假名</h2>
            <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/6/67/Japanese_Hiragana_kyokashotai_A.svg/150px-Japanese_Hiragana_kyokashotai_A.svg.png" alt="" style="width:4vw;position:absolute;left:5vw;top:10vh;">
          </a>
          <a href="../flipCard/flipCard.php?type=katagana" class="link" style="text-decoration: none;position:absolute;left:35vw;top:15vh;width:20vw;">
            <h2 style="position:absolute;left:14vw;top:19vh;width:10vw;color:black;font-weight:bold;">片假名</h2>
            <img src="../pictures/katagana.png" alt="" style="width:4vw;position:absolute;left:15vw;top:10vh;">
          </a>
          <a href="../flipCard/flipCard.php?type=words" class="link" style="text-decoration: none;position:absolute;left:35vw;top:15vh;width:20vw;">
            <h1 style="width:6vw;position:absolute;left:23vw;top:10vh;font-size:5vh;font-weight:bold">単語</h1>
            <h2 style="position:absolute;left:24vw;top:19vh;width:10vw;color:black;font-weight:bold;">單字</h2>
          </a>
          <label for="toggler_boss"> <img src="../pictures/folder.png" alt="" style="height:12vh;position:absolute;top:0vh;" class="folder"> <h2  style="color:black;font-weight:bold;position:absolute;left:20vw;top:9vh;">BOSS</h2> <label>
            <input type="checkbox" id="toggler_boss" style="display:none;">
              <nav class="mission" style="transition: transform .3s ease-out;transform-origin:center;padding:5vh;">
                <ol>
                  <li><a href="../fight/fight.php?bossNum=1"><img src="../virusPictures/1.png" alt="" style="height:20vh;"></a></li>
                  <li><a href="../fight/fight.php?bossNum=2"><img src="../virusPictures/<?php if($canChallenge[1])echo "2.png"; else echo "2_lock.png"; ?>" alt="" style="height:20vh;"></a></li>
                  <li><a href="../fight/fight.php?bossNum=3"><img src="../virusPictures/<?php if($canChallenge[2])echo "3.png"; else echo "3_lock.png"; ?>" alt="" style="height:20vh;"></a></li>
                  <li><a href="../fight/fight.php?bossNum=4"><img src="../virusPictures/<?php if($canChallenge[3])echo "4.png"; else echo "4_lock.png"; ?>" alt="" style="height:20vh;"></a></li>
                  <li><a href="../fight/fight.php?bossNum=5"><img src="../virusPictures/<?php if($canChallenge[4])echo "5.png"; else echo "5_lock.png"; ?>" alt="" style="height:20vh;width:8vw;"></a></li>
                  <li><a href="../fight/fight.php?bossNum=6"><img src="../virusPictures/<?php if($canChallenge[5])echo "6.png"; else echo "6_lock.png"; ?>" alt="" style="height:20vh;"></a></li>
                  <li><a href="../fight/fight.php?bossNum=7"><img src="../virusPictures/<?php if($canChallenge[6])echo "7.png"; else echo "7_lock.png"; ?>" alt="" style="height:20vh;"></a></li>
                  <li><a href="../fight/fight.php?bossNum=8"><img src="../virusPictures/<?php if($canChallenge[7])echo "8.png"; else echo "8_lock.png"; ?>" alt="" style="height:20vh;"></a></li>
                  <li><a href="../fight/fight.php?bossNum=9"><img src="../virusPictures/<?php if($canChallenge[8])echo "9.png"; else echo "9_lock.png"; ?>" alt="" style="height:20vh;position:relative;left:1vw;"></a></li>
                  <li><a href="../fight/fight.php?bossNum=10"><img src="../virusPictures/<?php if($canChallenge[9])echo "10.jpg"; else echo "10_lock.jpg"; ?>" alt="" style="height:20vh;"></a></li>
                </ol>
              </nav>
      </main>


          <footer class="footer">
            <nav class="nav_bar">
              <a href="../homepage/homepage.php" class="homepage rounded-right"><label for="toggler" style="font-size:2vh;"><img src="../pictures/winLogo.png" style="height:5vh;width:3vw;position:relative;right:0.5vw;">Start</label> <a>
              <a href="../character/character.php" class="character" style="font-size:3vh;"><img src="../pictures/character.png" alt="" style="height:7vh;width:5vw; position:relative;"></a>
              <a href="../shop/shop.php" class="shop"> <img src="../pictures/store.png" alt="" style="height:7vh;width:5vw; position:relative;right:1vw;top:-1vh;"> </a>
              <a href="../userData/userData.php" style="width:auto;"><img src="../pictures/userData.png" alt="" style="height:6vh;width:5vw;position:relative;right:2vw;top:0vh;"></a>
            </nav>
          </footer>
          <input type="checkbox" id="toggler" style="display:none;">
          <nav class="logOut_navbar" style="transition: transform .3s ease-out;transform-origin:bottom;">
            <button class="logOut" id="logOut" style="position:absolute;bottom:0vh;"> <img src="../pictures/logout.png" alt="" style="background-color:transparent;height:5vh;"> </button>
          </nav>
          <?php
          if(isset($_GET['levelUp'])){
            $result = $link->query("SELECT `level` FROM `game_character` WHERE `username`='{$username}'");
            $level = $result->fetch_assoc()['level'];
            echo "<script type='text/javascript'>swal('你升級了!', '現在等級:{$level}', 'success');</script>";
          }
          if(isset($_GET['err'])){
            if($_GET['err'] == "tooWeak"){
              echo "<script type='text/javascript'>swal('無法挑戰這隻boss!', '必須先挑戰boss{$stage}', 'warning');</script>";
            }
            else{
              $result = $link->query("SELECT `defeatMobNums` FROM `game_character` WHERE `username`='{$username}'");
              $needDefeatMobNums = 3-intval($result->fetch_assoc()['defeatMobNums']);
              echo "<script type='text/javascript'>swal('無法挑戰這隻boss!', '必須再挑戰{$needDefeatMobNums}隻小怪', 'warning');</script>";
            }
          }
          if(isset($_GET['stageUp'])){
            $result = $link->query("SELECT `stage` FROM `game_character` WHERE `username`='{$username}'");
            $stage = $result->fetch_assoc()['stage'];
            echo "<script type='text/javascript'>swal('你過關了!', '現在可以挑戰boss{$stage}', 'success');</script>";
          }
           ?>
    </body>
</html>
