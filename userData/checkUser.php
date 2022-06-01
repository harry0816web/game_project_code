<?php
  $nameFalse = false;
  $pwFalse = false;
  if(isset($_GET['err'])){
     $pwFalse = true;
  }
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="../login/login.css">
    </head>
    <body>
        <main class="LogBorder">
            <form method="post" action="check_user.php">
                <input type="password" name="password" id="password" placeholder="<?php echo ($pwFalse) ? '密碼錯誤' : '請輸入密碼'; ?> "style="top:15vh;">
                <button class="loginBtn" style="background-image:url('../pictures/start.png');"></button>
            </form>
          </main>
    </body>
</html>
