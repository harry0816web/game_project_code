  console.log(document.getElementById('stageUpBoss').innerHTML);
//全域變數
        var btnIsCLicked = false;
        var select = '';
        var round = 0;
        var result = '';
        var running = false;
        var Qlength = 15;
        var randNum = ToRandom(0,Qlength-1,Qlength,5455664655);
        var ansOrder = ToRandomAndMightRepeat(0,3,Qlength,4244524545);
        var correct = 0;
        var wrong = 0;
        var outOfTime = false;
        var PlayerWin = false;
        var MonsterWin = false;
        var getMonsterHp = document.getElementById("MonsterHP");
        var getPlayerHp = document.getElementById("PlayerHP");
        var getMonsterAtk = document.getElementById("MonsterATK");
        var getPlayerAtk = document.getElementById("PlayerATK");
        const originHP = {
          Player:parseInt(getPlayerHp.innerHTML.replace(/[^0-9]/ig,"")),
          Monster:parseInt(getMonsterHp.innerHTML.replace(/[^0-9]/ig,""))
        };
        var finishReadingDescription = false;
        if(document.getElementById('fightMob').innerHTML == "true")finishReadingDescription = true;
//function
    function len(str){
      return str.replace(/[^\x00-\xff]/g,"xx").length;
    }


    function getRandom(min,max){//產生min到max之間的亂數
        return Math.floor(Math.random()*(max-min+1))+min;
    };


    //produce random nums
    function ToRandom(min,max,length,exceptThis){//(亂數陣列裡的最小值,最大值,陣列長度,不要出現這個數)
        let rand = Array();
        let emerge = Array();
        for(let i = 0;i < length;i ++){
            emerge.push(0);
        }
        emerge[exceptThis] = 1;
        for(let i = 0;i < length;i ++){
            let num = getRandom(min,max);
            while(emerge[num]){
                num = getRandom(min,max);
            }
            emerge[num] = 1;
            rand.push(num);
        }
        return rand;
    }


    //produce random nums bnt might repeat
    function ToRandomAndMightRepeat(min, max, length,exceptThis) {
        let rand = [];
        for(let k=0; k<length; k++) {
            let randomNum = getRandom(min, max);
            while(randomNum == exceptThis) {
                randomNum = getRandom(min, max);
            }
            rand.push(randomNum);
        }
        return rand;
      }

    //showQuestionToHTML
    function showQuestion(n){//顯示題目
        document.getElementById("showQuestion").innerHTML =
        `
          <h1 class="question" style="background-color: lightgray;">${Q[n]}</h1>
        `;
      }

    //produveOPtionsToHTML
    function produceOptions(IndexOfAns,ans,ansInAnswerArray){//生成選項
        btnIsCLicked = false;
        let show = document.getElementById("showOptions");
        let optionsExceptAns = ToRandom(0,4,3,ansInAnswerArray);
        let ct = 0;
        let question = Q[randNum[round]];
        if(5<=randNum[round] && randNum[round]<=9){
          optionsExceptAns = ToRandom(5,9,3,ansInAnswerArray);
        }
        else if(10<=randNum[round] && randNum[round]<=14){
          optionsExceptAns = ToRandom(10,14,3,ansInAnswerArray);

        }
        for(let k = 0;k < 4;k ++){
            if(k == IndexOfAns){
                show.innerHTML +=
                `<button class="option" name="option" value=${ans} onclick="getSelectedOption(${k})">${ans}</button>`;
            }
            else{
                show.innerHTML +=
                `<button class="option" name="option" value=${Answer[optionsExceptAns[ct]]} onclick="getSelectedOption(${k})">${Answer[optionsExceptAns[ct]]}</button>`;
                ct++;
            }
        }
        let cnt = 0;

        let timer = setInterval(function(){
            cnt++;
            console.log(cnt);
            if(!btnIsCLicked){
                if(cnt >= 2000){
                    if(finishReadingDescription){
                      MonsterAttackPlayer();
                      clearInterval(timer);
                    }
                    else {
                      cnt = 0;
                      clearInterval(timer);
                    }
                }
            }
            else clearInterval(timer);
        },1);
    }


    //know which btn get cLicked , get value and call check()
    function getSelectedOption(clickSpot){
        console.log(btnIsCLicked);
        let options = document.getElementsByName("option");
        select = options[clickSpot].value;
        btnIsCLicked = true;
        check(round);
    }

    //check answer and next question
    function check(i){
        console.log(Answer[i]);
        let timer  = setInterval(function(){//確認有無click然後檢查答案
            if(btnIsCLicked){
                if(select == Answer[randNum[i]]){
                    correct++;
                    PlayerAttackMonster();
                    btnIsCLicked = false;
                    clearInterval(timer);
                }
                else {
                    wrong++;
                    MonsterAttackPlayer()
                    btnIsCLicked = false;
                    clearInterval(timer);
                }
            }
        }, 1);
    }

//attack functions


    function PlayerAttackMonster(){
      let pic = document.getElementById('monsterPic');
      pic.className += " " + "attack";
      setTimeout(function () {
        pic.className = "monsterPicture";
      },1000);
      calculateHP("Player","Monster");
      round++;
      document.getElementById("showOptions").innerHTML = '';
      if(round < Qlength){
          play(round);
      }
      else {
          if(!PlayerWin){
            MonsterWin = true;
            show_game_result();
          }
      }
    }


    function MonsterAttackPlayer(){
      let pic = document.getElementById('background');
      pic.className += " " + "attack";
      setTimeout(function () {
        pic.className = "";
      },1000);
      calculateHP("Monster","Player");
      round++;
      document.getElementById("showOptions").innerHTML = '';
      if(round < Qlength){
          play(round);
      }
      else {
          if(!PlayerWin){
            MonsterWin = true;
            show_game_result();
          }
      }
    }

    function calculateHP(attacker,theInjured){
      let hp = parseInt(document.getElementById(`${theInjured}HP`).innerHTML.replace(/[^0-9]/ig,""));
      let atk = parseInt(document.getElementById(`${attacker}ATK`).innerHTML.replace(/[^0-9]/ig,""));
      hp -= atk;
      if(hp <= 0){
        hp = 0;
        if(theInjured == "Monster"){  //setcookie BossNum
          PlayerWin = true;
          document.getElementById("showQuestion").innerHTML = '';
          document.getElementById("showOptions").innerHTML = '';
          show_game_result();
        }
        else{
          MonsterWin = true;
          document.getElementById("showQuestion").innerHTML = '';
          document.getElementById("showOptions").innerHTML = '';
          show_game_result();
        }
      }
      document.getElementById(`${theInjured}HP`).innerHTML = "HP:" + hp;
      let percent = (hp / originHP[theInjured])*100;
      console.log(atk);
      let insert = `linear-gradient( 90deg,
									rgb(89, 184, 0) 0% , rgb(89, 184, 0) ${percent}%,
									white ${percent}%, white 100% )`;
      document.getElementById(`${theInjured}HP`).style.setProperty("background",insert);
    }



//gamePlay and result

    function play(i){
        showQuestion(randNum[i]);
        produceOptions(ansOrder[i],Answer[randNum[i]],randNum[i]);
    }

    function show_game_result(){
      if(document.getElementById('monster').innerHTML){
        document.cookie = "challenged=1;path=/;max-age=15;";
      }
      let expGet = parseInt(document.getElementById(`expGet`).innerHTML.replace(/[^0-9]/ig,""));
      let coinGet = parseInt(document.getElementById(`coinGet`).innerHTML.replace(/[^0-9]/ig,""));
      if(PlayerWin){
        document.getElementById('winOrLose').innerHTML = "YOU WIN";
        if(document.getElementById('stageUpBoss').innerHTML == "true"){
          document.cookie = "stageUp=true;path=/;max-age=15;";
        }
        else{
          document.cookie = "defeatMob=true;path=/;max-age=15;";
        }
      }
      else {
        document.getElementById('winOrLose').innerHTML = "YOU LOSE";
        expGet = Math.floor(expGet/2);
        coinGet = Math.floor(coinGet/2);
        document.cookie = "challenge_cool_down='true';path=/;max-age=10;";
        document.getElementById("coinGet").innerHTML = coinGet;
        document.getElementById("expGet").innerHTML = expGet;
      }
      let exp = parseInt(document.getElementById(`exp`).innerHTML.replace(/[^0-9]/ig,"")) + expGet;
      let coin = parseInt(document.getElementById(`coin`).innerHTML.replace(/[^0-9]/ig,"")) + coinGet;
      document.getElementById(`exp`).innerHTML = `=>${exp}`;
      document.getElementById(`coin`).innerHTML = `=>${coin}`;
      let atkDropRemaining = document.getElementById ( 'atkDropName' ).getAttribute('showAtkDropNums');
      let hpDropRemaining = document.getElementById ('hpDropName').getAttribute('showHpDropNums');
      let damageDownDropRemaining = document.getElementById('damageDownDropName').getAttribute('showDamageDownDropNums');
      document.cookie = "atkUp_drops=" + atkDropRemaining + ";path=/;max-age=15;";
      document.cookie = "hpUp_drops=" + hpDropRemaining + ";path=/;max-age=15;";
      document.cookie = "damageDown_drops=" + damageDownDropRemaining + ";path=/;max-age=15;";
      document.cookie = "exp=" + exp + ";path=/;max-age=15;";
      document.cookie = "coin=" + coin + ";path=/;max-age=15;";

      //result animation
      document.getElementById('showResult').classList += " addAnimation";
      console.log(document.getElementById('showResult').classList);
    }
    play(round);

    function closeWindow(){
      finishReadingDescription = true;
      let id = document.getElementById("description");
      id.style.display = "none";
    }
