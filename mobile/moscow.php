<!DOCTYPE html>
<?
session_start();
$id = $_COOKIE['id'];
$auth = $_COOKIE['auth'];
include ("function.php");

if(!$_COOKIE["id"]){
	header('Location: index.php');
}else{
$get = file_get_contents_curl("http://109.234.156.251/prison/universal.php?key=$auth&method=getInfo&user=$id");
	$xml = simplexml_load_string($get);
    $energy = $xml->xpath('//data/guildTravian/workEnergy/energy'); // энергия у мобилы
    $trooper0 = $xml->xpath('//data/guildTravian/troops/trooper')[0][0]; // бойцы
    $trooper1 = $xml->xpath('//data/guildTravian/troops/trooper')[1][0]; // местные
    $trooper2 = $xml->xpath('//data/guildTravian/troops/trooper')[2][0]; // шныри
    $trooper3 = $xml->xpath('//data/guildTravian/troops/trooper')[3][0]; // четкие
    $test = $xml->xpath('//data/playerGuild/name')[0]; // имя бригады
	
	function ni4($sid, $id, $get){
		preg_match_all("/<level cid=\"$sid\" item=\"$id\">(.*?)<\/level>/", $get, $matches);
		$n = $matches[1][0];
		return $n;
	}
    //$test2 = $xml->xpath('//data/collections/items/level')[21][0]; // нычка
	
	
	//2,3,4,5,6,11,13,16,17,18,22,27
    // $pov1 = $xml->xpath('//data/chestRace/keys/key')[1][0]; // Тройка
    // $pov2 = $xml->xpath('//data/chestRace/keys/key')[2][0]; // Копейка 
    // $pov3 = $xml->xpath('//data/chestRace/keys/key')[3][0]; // Красная однёрка 
    // $pov4 = $xml->xpath('//data/chestRace/keys/key')[4][0]; // Атлянка  
    // $pov5 = $xml->xpath('//data/chestRace/keys/key')[5][0]; // Белый медведь 
    // $pov6 = $xml->xpath('//data/chestRace/keys/key')[10][0]; // Полярная сова 
    // $pov7 = $xml->xpath('//data/chestRace/keys/key')[12][0]; // Чёрный беркут 
    // $pov8 = $xml->xpath('//data/chestRace/keys/key')[15][0]; // Тулун 
    // $pov9 = $xml->xpath('//data/chestRace/keys/key')[16][0]; // Володарка 
    // $pov10 = $xml->xpath('//data/chestRace/keys/key')[17][0]; // Льговка  
    // $pov11 = $xml->xpath('//data/chestRace/keys/key')[21][0]; // АВ 262/5 
    // $pov12 = $xml->xpath('//data/chestRace/keys/key')[26][0]; // Мордовка

	if($_POST["boy"]){
		$count = $_POST["countboy"];
		$get = file_get_contents_curl("http://109.234.156.251/prison/universal.php?user=$id&troopId=1&key=$auth&amount=$count&guildId=137&method=guildTravian.useTroopers&nodeId=24");
		$result = json_decode($get, true);
		if($result["code"] == 8){$echo[]="Вступи в бригаду";}
		if($result["code"] == 6){$echo[]="Не хватает бойцов";}
		if($result["code"] == 0){$echo[]="Успешно отправили";}
	}
	/*if($_POST["tyal"]){
		$get = file_get_contents_curl("http://109.234.156.251/prison/universal.php?user=$id&key=$auth&optionId=3&price=70&method=guildTravian.claimPlayerNodeReward&nodeId=9");
		$result = json_decode($get, true);
		if($result["code"] == 0){$echo[]="Успешно получил туалетку";}
		if($result["code"] == 8){$echo[]="Нехватает зарядки";}
		if($result["code"] == 5){$echo[]="Открой москву";}
	}
	if($_POST["rub"]){
		$get = file_get_contents_curl("http://109.234.156.251/prison/universal.php?user=$id&key=$auth&optionId=3&price=70&method=guildTravian.claimPlayerNodeReward&nodeId=9");
		$result = json_decode($get, true);
		if($result["code"] == 0){$echo[]="Успешно получил туалетку";}
		if($result["code"] == 8){$echo[]="Нехватает зарядки";}
		if($result["code"] == 5){$echo[]="Открой москву";}
	}*/
}
?>

<html>
<head>
	<meta charset="UTF-8">
	<title>Москва</title>
	<link rel="stylesheet" href="css/style.css" media="screen" type="text/css" />
	<link rel="stylesheet" href="css/moscow.css" media="screen" type="text/css" />
</head>
<body>
<center>
<?include "../head_menu.php";?>
<?
if($echo){
	foreach($echo as $err){
	echo "<div class='error'>";
	echo $err;
	echo "</div>";
}}
//echo ni4(42,7,$get);
//var_dump($test2);
?>
<br>
<br>
<br>
<div style="margin: auto; width: 400px;">
<div style="background: #c0c2ff;border: 1px solid #3C6BFF;">
	<table>
	<tr>
	  <td><img src="img/136.png" title="Зарядка"></td>
	  <td><img src="img/173.png" title="Бойцы"></td>
	  <td><img src="img/164.png" title="Местные"></td>
	  <td><img src="img/153.png" title="Шныри"></td>
	  <td><img src="img/180.png" title="Четкие"></td>
	 </tr>
	<tr>
	  <td><?echo $energy[0];?></td>
	  <td><?echo $trooper0;?></td>
	  <td><?echo $trooper1;?></td>
	  <td><?echo $trooper2;?></td>
	  <td><?echo $trooper3;?></td>
	</tr>
	</table>
<form method="post">
<a>Кол-во:</a><input type="text" name="countboy" style="width: 20px;">
<input type="submit" name="boy" value="Отправить бойцов" style="margin-right: 70px;"><br>
<input type="submit" name="tyal" value="Получить туалетку"><br>
<input type="submit" name="rub" value="Получить Рубли">
</form>
<a href="index.php" class="color red button">Назад</a>
</div>
</div>
</center>
</body>
</html>