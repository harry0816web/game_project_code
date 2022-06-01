<?php
    if(!isset($_COOKIE['username'])){
      header("location: ../login/login.php");
     }
    if(!isset($_GET['userCorrect'])){
      header('location: checkUser.php');
    }
    require_once '../db.php';
    $username = $_COOKIE['username'];
    $sql = "SELECT `password` FROM `user` WHERE `username`='{$username}'";
    $result = $link->query($sql);
    $password = $result->fetch_assoc()['password'];
 ?>
 <!DOCTYPE html>
 <html lang="en" dir="ltr">
   <head>
     <meta charset="utf-8">
     <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
     <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css">
     <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
     <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
     <link rel="stylesheet" href="../homepage/homepage.css">
     <link rel="stylesheet" href="userData.css" >
   </head>
   <body>
     <audio autoplay="autoplay" controls="controls"loop="loop" preload="auto"
         src="../audio/game_bgm.mp3" style="display:none;">
       你的瀏覽器版本太低，不支援audio標籤
   </audio>
     <main>
       <form class="userData_change_form" action="userData_change.php" method="post"  about="_blank">
           <table class="table rounded col-md-12">
             <tr >
               <td style="border:none;"><img src="../pictures/logo.png" alt="" style="width:15vw;height:15vh;position:relative;left:5vw;background-color:transparent;"></td>
             </tr>
             <tr>
               <td style="border:none;">
                 <input type="text" name="username" placeholder="帳號:<?php echo $username ?>">
               </td>
             </tr>
             <tr>
               <td style="border:none;">
                   <input type="text" name="password" placeholder="密碼:<?php echo $password; ?>">
               </td>
             </tr>
             <tr >
               <td colspan="2" style="border:none;"><button type="submit" name="button" class="btn">送出修改</button></td>
             </tr>
           </table>
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
           <a href="../homepage/homepage.php" class="homepage rounded-right" style="color:white;font-weight:bold;font-size:2vh;"><img src="../pictures/winLogo.png" style="height:5vh;width:3vw;position:relative;right:0.5vw;">Start <a>
           <a href="../character/character.php" class="character" style="font-size:3vh;"><img src="../pictures/character.png" alt="" style="height:7vh;width:5vw; position:relative;"></a>
           <a href="../shop/shop.php"> <img src="../pictures/store.png" alt="" style="height:7vh;width:5vw; position:relative;right:1vw;top:-1vh;"> </a>
           <a href="../userData/userData.php"><img src="../pictures/userData.png" alt="" style="height:6vh;width:5vw;position:relative;right:2vw;top:0vh;filter: brightness(60%);box-shadow:0px 10px 10px black;"></a>
       </footer>
   </body>

 </html>
