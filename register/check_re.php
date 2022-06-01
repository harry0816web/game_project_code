<?php
  require_once "../db.php";
  if (isset($_POST['account_re']) and isset($_POST['password_re']) and isset($_POST['password_re_check'])) {
    if($_POST['password_re'] == $_POST['password_re_check']){ //確認兩次密碼輸入相同
      $ac_re = $_POST['account_re'];
      $pw_re = $_POST['password_re'];
      $searchSameData = mysqli_query($link,"SELECT `username` FROM `user` WHERE `username` = '{$ac_re}'");
      if(mysqli_num_rows($searchSameData) > 0){
        header('location: register.php?nameUsed=true');
      }
      else{
        $sql = "INSERT INTO `user` (`username`,`password`)
                VALUES ('$ac_re','$pw_re')";
        $link->query($sql);
        $characterInsert = "INSERT INTO `game_character` (`user_id`, `username`, `level`, `stage`,
                                                          `hp`, `atk`, `exp`, `levelUp_range`,`mobDataChange`,`defeatMobNums`)
                            VALUES (NULL,'{$ac_re}','1','1','50','10','0','20','1','0')";
        $link->query($characterInsert);
        //id => 自動生成 , username => 玩家註冊的帳號 , level,stage => 0 , hp=> 50 , atk => 10 , exp => 0 , levelUp_range = > 10

        $RESET = "UPDATE `game_character`
                  SET `coin`=0,`atkUp_drops`=0,`hpUp_drops`=0,`damageDown_drops`=0,`newBossChallenged`=0
                  WHERE `username` = '{$ac_re}'
        ";
        $link->query($RESET);
        //藥水與金幣預設為0

        $link -> close();
        header("location: ../homepage/homepage.php");
      }
    }
    else {                                                    //若兩次輸入密碼不同 回傳密碼error至註冊畫面
      header('location: register.php?PWcheck=false');
    }
  }

 ?>


 //level 3 : atk:
