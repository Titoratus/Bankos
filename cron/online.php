<?php
	$rand = file_get_contents('boss.txt');
	echo $rand;
	$vrem = time();
	$get = file_get_contents("http://109.234.156.251/prison/universal.php?method=events.getUpdate&key=456305e15d979e2b5de749aa1712dd6c&user=137372667");

	$get1 = file_get_contents("http://109.234.156.251/prison/universal.php?launchId=304&bossId=$rand&method=events.claimBattleTrainBattle&key=456305e15d979e2b5de749aa1712dd6c&user=137372667"); 
var_dump($get1);
	$get2 = file_get_contents("http://109.234.156.251/prison/universal.php?launchId=304&bossId=$rand&method=events.startBattleTrainBattle&key=456305e15d979e2b5de749aa1712dd6c&user=137372667");
	$json1 = json_decode($get2, true); 
	$code1 = $json1["code"]; 
	if ($code1 == 9){
		file_put_contents("boss.txt",(int)$rand+1);
	}
	$json = json_decode($get, true); 
	$code = $json["info"]; 
	// var_dump($code['events']['7']);
	$h = 0;
	for ($i=11; $i >=1; $i--){
		$boss = $code['events']['7']['soldierCooldowns'][$i]['cdTS'];
		if ($boss < $vrem){
			if (($i==4) or ($i==7)){
				continue;
			}
			if ($h==3){
			break;}
			$get = file_get_contents("http://109.234.156.251/prison/universal.php?launchId=304&bossId=$rand&soldierId=$i&method=events.useBattleTrainSoldier&key=456305e15d979e2b5de749aa1712dd6c&user=137372667");	
			$json = json_decode($get, true); 
			$code = $json["code"]; 
			echo "Код2 #".$code."<br>";
			if ($code == 0){
			$h++;}
		}
		
	}
	// $json = json_decode($get, true); 
	// $code = $json["code"]; 
	// if ($code == 9){
	// file_put_contents("boss.txt",(int)$rand+1);
	// }
	// echo "Код #".$code."<br>";
	// for ($l=9; $l >= 2; $l--){
	// if (($l==4) or ($l==7)){
	// continue;
	// }
	// $get = file_get_contents("http://109.234.156.251/prison/universal.php?launchId=262&bossId=$rand&soldierId=$l&method=events.useBattleTrainSoldier&key=456305e15d979e2b5de749aa1712dd6c&user=137372667");	
	// $json = json_decode($get, true); 
	// $code = $json["code"]; 
	// echo "Код2 #".$code."<br>";
	// sleep(1);
	// }
	if (($rand >=3) and ($rand <=10)){
		$get = file_get_contents("http://109.234.156.251/prison/universal.php?user=137372667&method=events%2EuseBattleTrainSpell&bossId=$rand&key=456305e15d979e2b5de749aa1712dd6c&spellId=1&launchId=304");
	}
	if ((($rand >=4) and ($rand <=10)) or ($rand>=13)){
		$get = file_get_contents("http://109.234.156.251/prison/universal.php?user=137372667&method=events%2EuseBattleTrainSpell&bossId=$rand&key=456305e15d979e2b5de749aa1712dd6c&spellId=4&launchId=304");
	}
?>