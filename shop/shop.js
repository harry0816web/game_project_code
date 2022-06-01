var coinNow = parseInt(document.getElementById('coinNow').innerHTML);
var cost = 0;
function addCost() {
  var atkDrop = parseInt(document.getElementById('AD').value);
  var hpDrop = parseInt(document.getElementById('HD').value);
  var lowerDamageDrop = parseInt(document.getElementById('LDD').value);
  cost = (atkDrop + hpDrop + lowerDamageDrop)*100;
  if(coinNow < cost){
    swal("無法購買","金幣不足","error");
  }
  else{
    document.getElementById('balance').innerHTML = coinNow - cost;
  }
}


// 計算所需金幣
