<?php
  $same = true;
  $used = false;
  if (isset($_GET['PWcheck'])) {
    if($_GET['PWcheck'] == "false")
      $same = false;
  }
  elseif (isset($_GET['nameUsed'])) {
    if($_GET["nameUsed"] == "true"){
      $used = true;
    }
  }
 ?>
 <!DOCTYPE html>
 <html>
     <head>
         <meta charset="UTF-8">
         <link rel="stylesheet" href="register.css">
     </head>
     <body>
        <main class="LogBorder">
            <form action="check_re.php" method="post" style="display:flex;justify-content:space-around;align-items:center;">
                <input type="text" name="account_re" id="account" placeholder="<?php echo ($used) ? '此帳號已被使用' : '請輸入帳號'; ?> ">
                <input type="password" name="password_re" id="password" placeholder="<?php echo (!$same) ? '密碼不一致' : '請輸入密碼' ?>" style="top:10vh;">
                <input type="password" name="password_re_check" id="password_check" placeholder="請確認密碼" style="top:15vh;">
                <button class="loginBtn" style="background-image:url('../pictures/start.png');"></button>
                <a class="login" href="../login/login.php">已有帳號? 點我登入</a>
                </div>
            </form>
          </main>
    </body>
</html>
