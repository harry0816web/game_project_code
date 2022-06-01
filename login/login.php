<?php
  $nameFalse = false;
  $pwFalse = false;
  if(isset($_GET['err'])){
    if($_GET['err'] == "nameWrong"){
      $nameFalse = true;
    }
    else $pwFalse = true;
  }
  if(isset($_COOKIE["username"])){
    header('location: ../homepage/homepage.php');
  }
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="login.css">
    </head>
    <body>
        <main class="LogBorder">
            <form method="post" action="check_log.php" >
                <input type="text" name="account" id="account" placeholder="<?php echo ($nameFalse) ? '查無此帳號' : '請輸入帳號'; ?> ">
                <input type="password" name="password" id="password" placeholder="<?php echo ($pwFalse) ? '密碼錯誤' : '請輸入密碼'; ?> "style="top:15vh;">
                <button class="loginBtn" style="background-image:url('../pictures/start.png');"></button>
                <a class="signup" href="../register/register.php">沒有帳號? 點我註冊</a>
            </form>
          </main>
    </body>
</html>
