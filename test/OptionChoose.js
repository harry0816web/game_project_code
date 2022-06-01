var question = new Array();
for(var i = 0;i < 4;i ++){
  question[i] = new Array();
}
question[0][0] ='1+1';
question[1][0] ='1+2';
question[2][0] ='1+3';
for(var i = 0;i < 3;i ++){
  for(var j = 1;j < 4;j ++){
    question[i][j] = j;
  }
}
var ans = new Array();
ans = [2,3,4];
var Correct = new Boolean(false);
var Qnum = 0;
document.getElementById('screen').innerHTML = question[Qnum][0];
function Choose(index) {
  var PlayerChoose = document.getElementsByName('option')[index];
  if(PlayerChoose.innerHTML == ans[Qnum]){
    document.getElementById('showIfCorrect').innerHTML = "correct";
    next();
    PlayerAttackMonster();
  }
  else {
    monsterAttackPlayer();
  }
}
function next(){
  if(Qnum < question.length-2){
    Qnum ++;
    document.getElementById('screen').innerHTML = question[Qnum][0];
    console.log(question.length-2);
  }
  else document.getElementById('screen').innerHTML = "finish";

}



/*attack*/
var player = new Object();
player.hp = parseInt(document.getElementById("player_hp").innerHTML);
player.atk = parseInt(document.getElementById("player_atk").innerHTML);
var monster = new Object();
monster.hp = parseInt(document.getElementById('monster_hp').innerHTML);
monster.atk = parseInt(document.getElementById('monster_atk').innerHTML);
function PlayerAttackMonster() {
	monster.hp -= player.atk;
	document.getElementById('monster_hp').innerHTML = monster.hp;
	check();
	if(document.getElementById('pic1').className == "pic1"){
		document.getElementById('pic1').classList.add("attackAnimation");
	}
	setInterval(function(){
		document.getElementById('pic1').classList.remove("attackAnimation");
	},1500)
}
function monsterAttackPlayer () {
	player.hp -= monster.atk;
	document.getElementById('player_hp').innerHTML = player.hp;
	check();
}
function check(){
	if(monster.hp <= 0){
		alert("you win");
		monster.hp = 50;
		player.hp = 50;
		document.getElementById('monster_hp').innerHTML = monster.hp;
		document.getElementById('player_hp').innerHTML = player.hp;
	}
	else if(player.hp <= 0){
		alert("you lost");
		monster.hp = 50;
		player.hp = 50;
		document.getElementById('monster_hp').innerHTML = monster.hp;
		document.getElementById('player_hp').innerHTML = player.hp;
	}
}
