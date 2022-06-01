<?php
  $link = mysqli_connect('localhost:8889','root','root','school_project_db');
  if($link){
    mysqli_query($link,"SET NAMES utf8");
    // echo "正確連線";
  }
  else {
    echo "錯誤" . mysqli_connect_error();
  }
 ?>
