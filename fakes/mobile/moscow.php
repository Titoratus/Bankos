<?
session_start();
$id = $_SESSION['id'];
$auth = $_SESSION['auth'];
include ("function.php");
include_once ("include/button.php");

if(!$_SESSION["id"]){
	echo '<META HTTP-EQUIV="REFRESH" CONTENT="1; URL=menu.php">';
}else{
	$get = file_get_contents_curl("http://109.234.156.251/prison/universal.php?key=$auth&method=getInfo&user=$id");
	$xml = simplexml_load_string($get);
    $energy = $xml->xpath('//data/guildTravian/workEnergy/energy'); // энергия у мобилы
    $trooper0 = $xml->xpath('//data/guildTravian/troops/trooper')[0][0]; // бойцы
    $trooper1 = $xml->xpath('//data/guildTravian/troops/trooper')[1][0]; // местные
    $trooper2 = $xml->xpath('//data/guildTravian/troops/trooper')[2][0]; // шныри
    $trooper3 = $xml->xpath('//data/guildTravian/troops/trooper')[3][0]; // четкие

	if($_POST["boy"]){
		$count = $_POST["countboy"];
		$get = file_get_contents_curl("http://109.234.156.251/prison/universal.php?user=$id&troopId=1&key=$auth&amount=$count&guildId=137&method=guildTravian.useTroopers&nodeId=24");
		$result = json_decode($get, true);
		if($result["code"] == 8){$echo[]="Вступи в бригаду";}
		if($result["code"] == 6){$echo[]="Не хватает бойцов";}
		if($result["code"] == 0){$echo[]="Успешно отправили";}
	}
	if($_POST["tyal"]){
		$get = file_get_contents_curl("http://109.234.156.251/prison/universal.php?user=$id&key=$auth&optionId=3&price=70&method=guildTravian.claimPlayerNodeReward&nodeId=9");
		$result = json_decode($get, true);
		if($result["code"] == 0){$echo[]="Успешно получил туалетку";}
		if($result["code"] == 8){$echo[]="Нехватает зарядки";}
		if($result["code"] == 5){$echo[]="Открой москву";}
	}
	if($_POST["rub"]){
		/*$get = file_get_contents_curl("http://109.234.156.251/prison/universal.php?user=$id&key=$auth&optionId=3&price=70&method=guildTravian.claimPlayerNodeReward&nodeId=9");
		$result = json_decode($get, true);
		if($result["code"] == 0){$echo[]="Успешно получил туалетку";}
		if($result["code"] == 8){$echo[]="Нехватает зарядки";}
		if($result["code"] == 5){$echo[]="Открой москву";}*/
	}
}
?>

<html>
<head>
	<meta charset="UTF-8">
	<title>Москва</title>
	<link rel="stylesheet" href="css/moscow.css" media="screen" type="text/css" />
</head>
<body style="background-color: #2c3338;">
<center>
<?
if($echo){
	foreach($echo as $err){
	echo "<div class='error'>";
	echo $err;
	echo "</div>";
}}
?>
<div>
<p>Зарядка: <?echo $energy[0];?></p>
<p>бойцы: <?echo $trooper0;?></p>
<p>местные: <?echo $trooper1;?></p>
<p>шныри: <?echo $trooper2;?></p>
<p>четкие: <?echo $trooper3;?></p><br>
</div>
<form method="post">
<a>Кол-во:</a><input type="text" name="countboy" style="width: 20;"></input><input type="submit" name="boy" value="Отправить бойцов"><br>
<input type="submit" name="tyal" value="Получить туалетку"><br>
<input type="submit" name="rub" value="Получить Рубли">
</form>
<a href="menu.php" class="color red button">Назад</a>
</center>
</body>
</html>