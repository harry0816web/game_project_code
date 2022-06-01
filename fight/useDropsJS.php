<?php
  header('Content-Type: application/javascript');
  require_once "../db.php";
   $username = $_COOKIE['username'];
  $sql = "SELECT `atkUp_drops`,`hpUp_drops`,`damageDown_drops`
          FROM `game_character`
          WHERE `username`='{$username}'";
  $result = $link->query($sql);
  $data = $result->fetch_assoc();
  $atkUp_drops = (int)$data["atkUp_drops"];
  $hpUp_drops = (int)$data["hpUp_drops"];
  $damageDown_drops = (int)$data["damageDown_drops"];
?>
  var atkDrops = <?php echo $atkUp_drops ?>;
  var hpDrops = <?php echo $hpUp_drops ?>;
  var damageDownDrops = <?php echo $damageDown_drops ?>;
  var atkDropDiv = document.getElementById ( 'atkDropName' ) ;
  var hpDropDiv = document.getElementById ('hpDropName') ;
  var damageDownDropDiv = document.getElementById('damageDownDropName');
  atkDropDiv.setAttribute('showAtkDropNums',atkDrops);
  hpDropDiv.setAttribute('showHpDropNums',hpDrops);
  damageDownDropDiv.setAttribute('showDamageDownDropNums',damageDownDrops);
  function atkUp(){
    if(atkDrops > 0){
      atkDrops -= 1;
      atkDropDiv.setAttribute('showAtkDropNums',atkDrops);
      let atk = parseInt(document.getElementById(`PlayerATK`).innerHTML.replace(/[^0-9]/ig,""));
      atk = Math.round(atk + atk*0.4);
      document.getElementById(`PlayerATK`).innerHTML = "你的攻擊力:" + atk;
    }
    else{
      alert("無剩餘藥水");
    }
  }
  function hpUp(){
    if(hpDrops > 0){
      hpDrops -= 1;
      hpDropDiv.setAttribute('showHpDropNums',hpDrops);
      let hp = parseInt(document.getElementById('PlayerHP').innerHTML.replace(/[^0-9]/ig,""));
      hp = Math.round(hp + hp*0.4);
      document.getElementById(`PlayerHP`).innerHTML = "HP:" + hp;
      let percent = (hp / originHP['Player'])*100;
      let insert = `linear-gradient( 90deg,
                  rgb(89, 184, 0) 0% , rgb(89, 184, 0) ${percent}%,
                  white ${percent}%, white 100% )`;
      document.getElementById(`PlayerHP`).style.setProperty("background",insert);
    }
    else{
      alert("無剩餘藥水");
    }
  }
  function damageDown(){
    if(damageDownDrops > 0){
      damageDownDrops -= 1;
      damageDownDropDiv.setAttribute('showDamageDownDropNums',damageDownDrops);
      let atk = parseInt(document.getElementById('MonsterATK').innerHTML.replace(/[^0-9]/ig,""));
      let atkDown = Math.round(atk*0.6);
      document.getElementById('MonsterATK').innerHTML = "怪物的攻擊力:" + atkDown;
    }
    else{
      alert("無剩餘藥水");
    }
  }
