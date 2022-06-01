var player = new Object();
player.hp = parseInt(document.getElementById("player_hp").innerHTML);
player.atk = parseInt(document.getElementById("player_atk").innerHTML);
var monster = new Object();
monster.hp = parseInt(document.getElementById('monster_hp').innerHTML);
monster.atk = parseInt(document.getElementById('monster_atk').innerHTML);
document.getElementById('PlayerAtk').addEventListener("click",function () {
	monster.hp -= player.atk;
	document.getElementById('monster_hp').innerHTML = monster.hp;
	check();
	if(document.getElementById('pic1').className = "pic1"){
		document.getElementById('pic1').classList.add("attackAnimation");
	}
	setInterval(function(){
		document.getElementById('pic1').classList.remove("attackAnimation");
	},1500)
});
document.getElementById('MonsterAtk').addEventListener("click",function () {
	player.hp -= monster.atk;
	document.getElementById('player_hp').innerHTML = player.hp;
	check();
});
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


/*question and answer*/
