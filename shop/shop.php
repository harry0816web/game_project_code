<?php
  if(!isset($_COOKIE['username'])){
    header("location: ../login/login.php");
} ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>shop</title>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css">
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="../homepage/homepage.css">
    <link rel="stylesheet" href="shop.css" >
    <script type="text/javascript" src="shop.js" defer></script>
  </head>
  <body>
    <audio autoplay="autoplay" controls="controls"loop="loop" preload="auto"
        src="../audio/game_bgm.mp3" style="display:none;">
      你的瀏覽器版本太低，不支援audio標籤
  </audio>
    <main>
          <form class="shop" action="purchase.php" method="get">
            <table class="showCoin  table table-sm">
              <?php
                require_once "../db.php";
                $username = $_COOKIE['username'];
                $sql = "SELECT `coin` FROM `game_character` WHERE `username`='{$username}'";
                $result = $link->query($sql);
                $coinNow = ($result->fetch_assoc())["coin"];
              ?>
              <tr>
                <td>現在擁有金幣:</td>
                <td id="coinNow"><?php echo $coinNow; ?></td>
              </tr>
              <tr>
                <td>購買後剩餘金幣:</td>
                <td id="balance"><?php echo $coinNow; ?></td>
              </tr>
            </table>
            <table class="dropsTable">
              <tr style="font-weight:bold;font-size:120%;">
                <td>藥水種類</td>
                <td>功能</td>
                <td>價錢</td>
                <td>數量</td>
              </tr>
              <tr>
                <td><img src="../dropsPicture/atk.png" alt="" style="height:10vh;width:4vw;"></td>
                <td>攻擊力上升40%</td>
                <td>$100</td>
                <td>
                  <select class="atkDrop" name="atkDrop" onchange="addCost()" id="AD">
                    <option value="0">0</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                  </select>
                </td>
              </tr>
              <tr>
                <td><img src="../dropsPicture/hp.png" alt="" style="height:12vh;width:4vw;"></td>
                <td>生命值回復40%</td>
                <td>$100</td>
                <td>
                  <select class="hpDrop" name="hpDrop" onchange="addCost()" id="HD">
                    <option value="0">0</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                  </select>
                </td>
              </tr>
              <tr>
                <td><img src="../dropsPicture/damageDown.png" alt="" style="height:12vh;width:5vw;"></td>
                <td>敵人傷害降低40%</td>
                <td>$100</td>
                <td>
                  <select class="lowerDamageDrop" name="lowerDamageDrop" onchange="addCost()" id="LDD">
                    <option value="0">0</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                  </select>
                </td>
              </tr>
            </table>
            <input type="submit" name="button" class="submit" style="background-image:url('../pictures/purchaseBtn.png');background-size:100% 100%;width:5vw;height:10vh;border:none;background-color:transparent;" value=""></input>
          </form>

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
        <footer class="nav_foot"><a href="../login/login.php" class="logOut" id="logOut">登出</a></footer>
      </nav>
      <footer class="footer">
        <nav class="nav_bar">
          <a href="../homepage/homepage.php" class="homepage rounded-right" style="color:white;font-weight:bold;"><img src="../pictures/winLogo.png" style="height:5vh;width:3vw;position:relative;right:0.5vw;">Start <a>
          <a href="../character/character.php" class="character" style="font-size:3vh;"><img src="../pictures/character.png" alt="" style="height:7vh;width:5vw; position:relative;"></a>
          <a href="../shop/shop.php"> <img src="../pictures/store.png" alt="" style="height:7vh;width:5vw; position:relative;right:1vw;top:-1vh;filter: brightness(60%);box-shadow:0px 10px 10px black;"> </a>
          <a href="../userData/userData.php"><img src="../pictures/userData.png" alt="" style="height:6vh;width:5vw;position:relative;right:2vw;top:0vh;"></a>
        </nav>
      </footer>
      <?php if(isset($_GET['err'])){
              if($_GET['err'] == "buyNothing"){
                echo '<script>swal("購買失敗", "你沒選擇數量", "error");</script>';
              }
              else {
                echo '<script>swal("購買失敗", "金幣不足", "error");</script>';
              }
            }
            else if(isset($_GET['purchase'])){
              echo '<script>swal("購買成功", "你已購買藥水", "success");</script>';
            }
       ?>
  </body>

</html>
