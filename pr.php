<?php 
$id = array();
$auth = array();
$uid = array();
include ('bd2.php');

		$sql = "SELECT * FROM `token` ORDER BY RAND() LIMIT 7";
		$result_select = mysql_query($sql);
		while($object = mysql_fetch_object($result_select)){
			$uid[] = $object -> id;
		}
		$sql = "SELECT * FROM `auth` ORDER BY RAND() LIMIT 50";
		$result_select = mysql_query($sql);
		while($object = mysql_fetch_object($result_select)){
			$id[] = $object -> id;
			$auth[] = $object -> auth;
		}

 for ($i=0; $i < count($uid); $i++){
	 for ($l=0; $l < 2; $l++){
	$rand = rand (0,50);
	echo "http://109.234.156.251/prison/universal.php?targetUid=$uid[$i]&user=$id[$rand]&key=$auth[$rand]&method=events%2EsendBattleTrainPresent&launchId=176</br>";
	$get = file_get_contents("http://109.234.156.251/prison/universal.php?targetUid=$uid[$i]&user=$id[$rand]&key=$auth[$rand]&method=events.sendBattleTrainPresent&launchId=176");

	echo $get.'</br>';
	 }
 } 

 ?>