<?php
	$id = '137372667';
	$auth = 'a5ddbc4db52edd04adb1cfb44ab681a7';

$get = file_get_contents('http://109.234.155.196/prison/universal.php?method=events.getUpdate&user='.$id.'&key='.$auth);
 
$json = json_decode($get, true); // Декодируем
$pop = array_pop($json['info']['events']); //входим в последний ключ масива events
 
$launchId = $pop['launchId']; //узнаем у последнего ключа launchId
if($pop['dng'] != null){
    foreach($pop['dng']['nodes'] as $t){
        if($t['health'] != 0){
            $id = $t['id']; // id нужного задания
            $health = $t['health']; // хп сколько осталось у задания
            $healthFull = $t['healthFull'];// полное хп у задания
            break;
        }
    }
}
 
echo 'launchId:'.$launchId.'<br>';
echo 'id:'.$id.'<br>';
echo 'health:'.$health.'<br>';
echo 'healthFull:'.$healthFull;
	
	// $boss = file_get_contents('boss.txt');
	// $get = file_get_contents("http://109.234.156.253/prison/universal.php?user=$id&key=$auth&method=events%2EgetUpdate");
	// $get = file_get_contents("http://109.234.156.253/prison/universal.php?launchId=204&method=events%2EclaimBattleTrainBattle&key=$auth&user=$id&bossId=$boss");
	// $get = file_get_contents("http://109.234.156.253/prison/universal.php?key=$auth&bossId=$boss&method=events%2EstartBattleTrainBattle&user=$id&launchId=204");
	// $json = json_decode($get, true);
	// if (($boss > 2) and ($boss != 11) and ($boss != 12)){
	// $get = file_get_contents("http://109.234.156.252/prison/universal.php?bossId=$boss&spellId=1&launchId=204&method=events%2EuseBattleTrainSpell&user=$id&key=$auth");
	// $get = file_get_contents("http://109.234.156.252/prison/universal.php?bossId=$boss&spellId=4&launchId=204&method=events%2EuseBattleTrainSpell&user=$id&key=$auth");
	// $get = file_get_contents("http://109.234.156.252/prison/universal.php?bossId=$boss&spellId=5&launchId=204&method=events%2EuseBattleTrainSpell&user=$id&key=$auth");
	
	// }
	// if($json["code"] == '0'){ 
	// echo "$id Успешно напали на босса </br>"; 
	// }
	// if($json["code"] == '6'){ 
	// echo "$id Идет бой </br>";
	// }
	// if($json["code"] == '9'){ 
	// echo " $id Лимит </br>";
	// $boss+=1;
	// $fp = fopen("boss.txt", "r+");
	// $test = fwrite($fp, $boss); // Запись в файл
	// }
	
	// for ($i=13; $i >=2; $i--){
	// if (($i==4) or ($i==7)){
	// continue; 
	// }
	// $get = file_get_contents("http://109.234.156.253/prison/universal.php?soldierId=$i&bossId=$boss&launchId=204&method=events%2EuseBattleTrainSoldier&user=$id&key=$auth");
	// }
	// $get = file_get_contents("http://109.234.156.253/prison/universal.php?user=$id&key=$auth&method=events%2EgetUpdate");
	
	// $boss = file_get_contents('boss1.txt');
	// $id = '36749230';
	// $auth = '651aee69b8196810826d59d12a6b6d37';
	// ПОРА ВАРИТЬ БАРЫГА
	// for ($i=0; $i < 5; $i++){
	// $get = file_get_contents("http://109.234.156.252/prison/universal.php?key=$auth&user=$id&launchId=205&method=events%2EletsCook%2EdoAction");
	// var_dump($get);
	// echo "<br>";
	// }	
	
	//  ЛОМАЙ РЕЖИМ
	// for ($i=0; $i < 2; $i++){
	// $get = file_get_contents("http://109.234.156.252/prison/universal.php?user=$id&key=$auth&launchId=206&nodeId=9&weaponId=2&method=events%2EhitHDDTDungeonNode");
	// var_dump($get);
	// echo "<br>";
	// }	
	
	
	#var_dump($get);
	// $get = file_get_contents("http://109.234.156.253/prison/universal.php?user=$id&key=$auth&method=events%2EgetUpdate");
	// $get = file_get_contents("http://109.234.156.253/prison/universal.php?launchId=204&method=events%2EclaimBattleTrainBattle&key=$auth&user=$id&bossId=$boss");
	// $get = file_get_contents("http://109.234.156.253/prison/universal.php?key=$auth&bossId=$boss&method=events%2EstartBattleTrainBattle&user=$id&launchId=204");
	// $json = json_decode($get, true);
	// if($json["code"] == '0'){ 
	// echo "$id Успешно напали на босса  </br>"; 
	// }
	// if($json["code"] == '6'){ 
	// echo "$id Идет бой </br>";
	// }
	// if($json["code"] == '9'){ 
	// echo " $id Лимит </br>";
	// $boss+=1;
	// $fp = fopen("boss1.txt", "r+");
	// $test = fwrite($fp, $boss); // Запись в файл
	// }
	// for ($i=10; $i >=1; $i--){
	// if (($i==4) or ($i==7) or ($i==8)){
	// continue;
	// }
	// $get = file_get_contents("http://109.234.156.253/prison/universal.php?soldierId=$i&bossId=$boss&launchId=204&method=events%2EuseBattleTrainSoldier&user=$id&key=$auth");
	// sleep(1);
	// }
	// $get = file_get_contents("http://109.234.156.253/prison/universal.php?user=$id&key=$auth&method=events%2EgetUpdate");
	// if (($boss > 2) and ($boss != 11) and ($boss != 12)){
	// $get = file_get_contents("http://109.234.156.252/prison/universal.php?bossId=$boss&spellId=1&launchId=204&method=events%2EuseBattleTrainSpell&user=$id&key=$auth");
	// $get = file_get_contents("http://109.234.156.252/prison/universal.php?bossId=$boss&spellId=4&launchId=204&method=events%2EuseBattleTrainSpell&user=$id&key=$auth");
	// $get = file_get_contents("http://109.234.156.252/prison/universal.php?bossId=$boss&spellId=5&launchId=204&method=events%2EuseBattleTrainSpell&user=$id&key=$auth");
	
	// }
	
	// $id = '159494918';
	// $auth = '246360abb1cd0799c29d8a0a60352659';
	// ПОРА ВАРИТЬ БАРЫГА
	// for ($i=0; $i < 5; $i++){
	// $get = file_get_contents("http://109.234.156.252/prison/universal.php?key=$auth&user=$id&launchId=205&method=events%2EletsCook%2EdoAction");
	// var_dump($get);
	// echo "<br>";
	// }	
	// ПОРА ВАРИТЬ БАРЫГА	
	
	
	// обновление инфы  $get = file_get_contents("http://109.234.156.251/prison/universal.php?user=$id&key=$auth&method=events%2EgetUpdate");
	// var_dump($get);
	// старт за 1000 сиг $get = file_get_contents("http://109.234.156.251/prison/universal.php?user=$id&key=$auth&launchId=145&method=events%2Eescape%2EstartEscape");
	// удар кулаком 
	// $get = file_get_contents("http://109.234.156.251/prison/universal.php?toTargetId=4&skillId=19&method=events%2Eescape%2EhitEscape&user=$id&key=$auth&fromTargetId=1&launchId=145");
	// $get = file_get_contents("http://109.234.156.251/prison/universal.php?nodeId=30&method=events%2Eescape%2EclaimNode&user=$id&key=$auth&launchId=145");
	
	
	//$get = file_get_contents("http://109.234.156.251/prison/universal.php?nodeId=35&method=events%2Eescape%2EclaimNode&user=$id&key=$auth&launchId=145");
	// открытие схрона
	//$get = file_get_contents("http://109.234.156.251/prison/universal.php?user=$id&key=$auth&launchId=145&method=events%2Eescape%2EopenRewards");
	
	//$get = file_get_contents("http://109.234.156.251/prison/universal.php?");
	
	// $get = file_get_contents("http://109.234.156.251/prison/universal.php?toTargetId=5&skillId=19&method=events%2Eescape%2EhitEscape&user=$id&key=$auth&fromTargetId=1&launchId=145");


?>