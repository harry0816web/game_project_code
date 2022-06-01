<?php
  header('Content-Type: application/javascript');
  require_once "../db.php";
  $username = $_COOKIE['username'];
  $getStage = $link->query("SELECT `stage` FROM `game_character` WHERE `username`='{$username}'");
  $stage = $getStage->fetch_assoc()['stage'];
  $sql = "SELECT *
          FROM `stage{$stage}`";
  $data = array();
  $result = $link->query($sql);
  $data[] = $result->fetch_assoc();
  $questions = array();
  $answer = array();
  foreach ($data[0] as $key => $value) {
    $questions[] = $key;
    $answer[] = $value;
  }
  $len = count($questions);
  $questions = json_encode($questions);
  $answer = json_encode($answer);
  $ct = 0;
?>


    var Q = <?php echo $questions; ?>;
    var Answer = <?php echo $answer; ?>;
