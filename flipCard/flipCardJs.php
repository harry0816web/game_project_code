<?php
  header('Content-Type: application/javascript');
  require_once "../db.php";
  $username = $_COOKIE['username'];
  $getStage = $link->query("SELECT `stage` FROM `game_character` WHERE `username`='{$username}'");
  $stage = $getStage->fetch_assoc()['stage'];
  $data = array();
  $questions = array();
  $answer = array();
  $words = false;
  if(isset($_COOKIE['type'])){
    if($_COOKIE['type'] == "hiragana"){
      if($stage == 10)$stage = 9;
      for($i = 1;$i <= $stage;$i ++){
        $sql = "SELECT *
                FROM `flipcard{$i}`";
        $result = $link->query($sql);
        $data[] = $result->fetch_assoc();
      }
    }
    else if($_COOKIE['type'] == "katagana"){
      if($stage == 10)$stage = 9;
      for($i = 1;$i <= $stage;$i ++){
        $sql = "SELECT *
                FROM `flipcard_katagana{$i}`";
        $result = $link->query($sql);
        $data[] = $result->fetch_assoc();
      }
    }
    else{
      $words = true;
      $sql = "SELECT *
              FROM `flipcard_words`";
      $result = $link->query($sql);
      $data = $result->fetch_assoc();
      $qHold = array();
      $aHold = array();
        foreach ($data as $key => $value) {
          array_push($aHold,$key);
          array_push($qHold,$value);
        }
      for($i = 0;$i < $stage*5;$i ++){
        array_push($answer,$aHold[$i]);
        array_push($questions,$qHold[$i]);
      }
    }
  }
  if(!$words){
    for($i = 0;$i < $stage; $i ++){
      foreach ($data[$i] as $key => $value) {
        array_push($questions,$key);
        array_push($answer,$value);
      }
    }
  }
  $questions = json_encode($questions);
  $answer = json_encode($answer);
  $ct = 0;
?>
  var cnt = 0;
  var Q = <?php echo $questions; ?>;
  var Ans = <?php echo $answer; ?>;
  console.log(<?php echo $questions; ?>);
  var length = Q.length;
  var ct = 0;
  var fail = [];
  var reviewQ = [];
  var reviewAns = [];
  var reviewStart = false;
  var lastReviewQ = [];
  var lastReviewAns = [];
  var learnEnd = false;


  function update(learn){
    learnEnd = false;
    if(learn == "fail"){
      fail.push(ct-1);
    }
    if(reviewStart){
      if(reviewQ[ct] != undefined){
        document.getElementById('question').innerHTML = reviewQ[ct];
        document.getElementById('answer').innerHTML = reviewAns[ct];
      }
      else {
        learnEnd = true;
        end();
      }
    }
    else{
      if(Q[ct] != undefined){
        document.getElementById('question').innerHTML = Q[ct];
        document.getElementById('answer').innerHTML = Ans[ct];
      }
      else{
        learnEnd = true;
        end();
      }
    }
    if(learn == "restart")ct--;
    if(!learnEnd){
      ct++;
    }
  }

  function previous(){
    if(ct>1){
      ct-=2;
      if(reviewStart){
        document.getElementById('question').innerHTML = reviewQ[ct];
        document.getElementById('answer').innerHTML = reviewAns[ct];
      }
      else{
        document.getElementById('question').innerHTML = Q[ct];
        document.getElementById('answer').innerHTML = Ans[ct];
      }
      ct++;
    }
  }

  function end(){
    lastReviewQ = reviewQ;
    lastReviewAns = reviewAns;
    reviewQ = [];
    reviewAns = [];
    if(fail.length){
      if(!reviewStart){
        for(let i = 0;i < fail.length;i ++){
          reviewQ.push(Q[fail[i]]);
          reviewAns.push(Ans[fail[i]]);
        }
      }
      else{
        for(let i = 0;i < fail.length;i ++){
          reviewQ.push(lastReviewQ[fail[i]]);
          reviewAns.push(lastReviewAns[fail[i]]);
        }
      }
      alert(`你還有${reviewQ.length}個字不會,再學一次吧!`);
      reviewStart = true;
      length = reviewQ.length;
    }
    else{
      reviewStart = false;
      alert("你學完了,快去清理病毒吧!");
      document.location.href="../homepage/homepage.php";
    }
    fail = [];
    ct = 0;
    update("restart");
  }
  update();
