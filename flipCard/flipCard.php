<?php
  $needMoreSpace = false;
  if(isset($_GET['type'])){
    if($_GET['type'] == "hiragana"){
      setcookie("type","hiragana",time()+30);
    }
    else if($_GET['type'] == "katagana"){
      setcookie('type',"katagana",time()+30);
    }
    else{
      $needMoreSpace = true;
      setcookie('type',"words",time()+30);
    }
  }
 ?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <script src="flipCardJs.php" defer></script>
        <link rel="stylesheet" href="flipCard.css">
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js" defer></script>
    </head>
    <body>
      <div class="learnFail"  onclick="update('fail');"> <h1 class="learnTEXT">不太熟</h1> </div>
      <div class="learnSucceed" onclick="update('succeed');"> <h1 class="learnTEXT">學會了</h1> </div>
        <main class="wordCard"  style="border-radius:20px;">
            <div class="flip-container" ontouchstart="this.classList.toggle('hover');" style="background-color:black;border-radius:20px;">
                <div class="flipper">
                    <div class="front" style="border-radius:20px;">
                        <h1 id="question" style="color:black;background-color:transparent;font-size:<?php if($needMoreSpace)echo '20vh'; else echo '30vh' ?>;text-align:center;margin-top:17vh;"></h1>
                    </div>
                    <div class="back">
                        <h1 id="answer" style="color:black;font-size:<?php if($needMoreSpace)echo '20vh'; else echo '30vh' ?>;text-align:center;margin-top:0vh;background-color:transparent;margin-top:17vh;"></h1>
                    </div>
                </div>
            </div>
        </main>
        <button onclick="previous();" style="background-color:black;color:white;position:absolute;bottom:2vh;left:46vw;font-size:5vh;">上一個</button>

    </body>
</html>
