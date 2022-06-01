<?php
  require_once "../db.php";
  $user = '';
  $userID = '';
  if(isset($_COOKIE['username'])){
    $user = $_COOKIE['username'];
    $characterDataResult = $link->query("SELECT * FROM `game_character` WHERE `username`='{$user}'");
    $data = $characterDataResult->fetch_assoc();
    $exp = $data['exp'];
    $range = $data['levelUp_range'];
    $percent = ($exp / $range)*100;
    $percent = round($percent);
  }
 ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>shop</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css">
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="../homepage/homepage.css">
    <link rel="stylesheet" href="character.css">
    <script type="text/javascript" src="character.js"></script>
  </head>
  <body>
    <audio autoplay="autoplay" controls="controls"loop="loop" preload="auto"
        src="../audio/game_bgm.mp3" style="display:none;">
      你的瀏覽器版本太低，不支援audio標籤
  </audio>
    <main>
      <div class="showData">
        <div class="username" style="grid-area:username">
          <h1>玩家名稱:<?php echo $_COOKIE['username'];?></h1>

        </div>
        <div style="grid-area:level">LV.<?php echo $data['level']; ?></div>
        <div style="grid-area:atkdata">攻擊力</div>
        <div style="grid-area:atk"><?php echo $data["atk"];?></div>
        <div style="grid-area:hpdata">生命值</div>
        <div style="grid-area:hp"><?php echo $data["hp"];?></div>
        <div style="grid-area:levelUp_range;position:relative;"> <div style="background:linear-gradient(90deg, green 0%, green <?php echo $percent; ?>% , white <?php echo $percent ?>% , white 100% );height:25%;width:50%;border-radius:25px;position:absolute;left:25%;color:black;font-size:2vh"><?php echo $exp; ?>/<?php echo $range;?></div> </div>
        <div style="grid-area:coindata;">金幣</div>
        <div style="grid-area:atkDropData;">攻擊上升藥水</div>
        <div style="grid-area:hpDropData;">生命恢復藥水</div>
        <div style="grid-area:damageDropData;">減傷藥水</div>
        <div style="grid-area:coin"><?php echo $data["coin"];?></div>
        <div style="grid-area:atkUp_drops"><?php echo $data["atkUp_drops"];?></div>
        <div style="grid-area:hpUp_drops"><?php echo $data["hpUp_drops"];?></div>
        <div style="grid-area:damageDown_drops"><?php echo $data["damageDown_drops"];?></div>
      </div>
    </main>
    <input type="checkbox" id="toggler" style="display:none;">
      <nav class="mission" style="transition: transform .3s ease-out;transform-origin:bottom;">
        <div class="mostUsed">
          關卡選擇
        </div>
        <ol>
          <li>Boss1</li>
          <li>Boss2</li>
          <li>Boss3</li>
          <li>Boss4</li>
          <li>Boss5</li>
          <li>Boss6</li>
          <li>Boss7</li>
          <li>Boss8</li>
          <li>Boss9</li>
          <li>Boss10</li>
        </ol>
        <footer class="nav_foot"><a href="login/login.php" class="logOut" id="logOut">登出</a></footer>
      </nav>
      <footer class="footer" >
        <nav class="nav_bar" >
          <a href="../homepage/homepage.php" class="homepage rounded-right" style="color:white;font-weight:bold;font-size:2vh;"><img src="../pictures/winLogo.png" style="height:5vh;width:3vw;position:relative;right:0.5vw;">Start <a>
          <a href="../character/character.php" class="character" style="font-size:3vh;"><img src="../pictures/character.png" alt="" style="height:6vh;width:4vw; position:relative;filter: brightness(60%);box-shadow:0px 10px 10px black;"></a>
          <a href="../shop/shop.php"> <img src="../pictures/store.png" alt="" style="height:7vh;width:5vw; position:relative;right:1vw;top:-1vh;"> </a>
          <a href="../userData/userData.php"><img src="../pictures/userData.png" alt="" style="height:6vh;width:5vw;position:relative;right:2vw;top:0vh;"></a>         <a style="font-size:3vh;" href="../userData/userData.php"></a>
        </nav>
      </footer>
  </body>
</html>
