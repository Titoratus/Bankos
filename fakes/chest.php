<?
$site = "chest.php";
if($_COOKIE['ids'] != null){
    $ids = $_COOKIE['ids'];
}
if($_COOKIE['auths'] != null){
    $auths = $_COOKIE['auths'];
}

if($_POST['save']){
    setcookie("ids", $_POST['id']);
    setcookie("auths", $_POST['auth']);
    header('Location: '.$site);
}

if($_POST['ok']){
$id = $_POST['id'];
$auth = $_POST['auth'];
$sigs = 0;
$sugar = 0;
$rating = 0;
$item = 0;
	for ($num=0;$num <= 50;$num++){
		$get = file_get_contents("http://109.234.156.252/prison/universal.php?method=chestRace.openChest&user=$id&key=$auth&chest=15"); //Запрос
		$arr = json_decode($get,true);//парсим JSON
		if($arr['rewards'][0]['type']=='sigs'){
			$s0 = $arr['rewards'][0]['value'];
			$sigs+= $s0;
		}
		if($arr['rewards'][1]['type']=='sugar'){
			$s1 = $arr['rewards'][1]['value'];
			$sugar+= $s1;
		}
		if($arr['rewards'][2]['type']=='rating'){
			$s2 = $arr['rewards'][2]['value'];
			$rating+= $s2;
		}
		if($arr['rewards'][4]['type']=='item'){
			$s4 = 1;
			$item+= $s4;
		}
		if($arr['rewards'][5]['type']=='item'){
			$s4 = 1;
			$item+= $s4;
		}
		if($arr['rewards'][6]['type']=='item'){
			$s4 = 1;
			$item+= $s4;
		}
		if($arr['rewards'][7]['type']=='item'){
			$s4 = 1;
			$item+= $s4;
		}
		if($arr["code"] == 5){
			$num = 50;
			$s5 = 1;
		}
	}
	if($s0){
	echo "<center>
			<div class=\"smen sma\">
			Вы получили:<br>
			Папирос $sigs<br>
			Сахара $sugar<br>
			Наколок $item<br>
			Авторитета $rating
			</div>
		</center>";}elseif($s5){
		echo "<center>
			<div class=\"smen sma\">
			Закончились сундуки
			</div>
		</center>";}
}
?>
<html>
<head>
<style><!--Стили-->
input[type="submit"]{height: 30;}
button{height: 30;}
.sma  {/*margin-bottom:-15px;*/padding: 8px 5px;}
.ok   {background: #F0E4E4;border: 1px solid #D6CBCB;}
.nav1  {background: #C0F7FF;border: 1px solid #3C6BFF;}
.check{background: #e4f0e8;border: 1px solid #D6CBCB;}
.smen {background: #D7F3EB;border: 1px solid #cbd6cf;}
.sbor {background: #F0F0E4;border: 1px solid #cbd6cf;}
.bri  {background: #CEC6BA;border: 1px solid #D4BCBC;}
#cont {padding: 30px;background: #ffffff;}
</style>
</head>
<body style="background-color: #DDDCEE;">
<meta http-equiv="content-type" content="charset=utf-8">

<center>
<span style="font-family:comic sans ms,cursive;color: #FF0A0A;cursor: context-menu;">Открыть ящик с воркуты</span>
<div class="bri sma">  

<form method=post>
<input type="text" style="resize:none;width:15%;" placeholder="Введите свой ID" name="id" value="<?if($ids != ''){echo "$ids";}?>"><br>
<input type="text" style="resize:none;width:15%;" placeholder="Введите свой Auth" name="auth" value="<?if($auths != ''){echo "$auths";}?>"><br>
<input type="submit" name="ok" value="Открыть :)" style="width: 130;">
<input type="submit" name="save" value="Сохранить" style="width: 75;">
</form>
<div class="nav1" style="width: 356;">
Данный раздел открывает по 50 сундуков, если их меньше, то он откроет сколько есть.	
</div>

</div>
</center>
<div class="ok sma">
<a href="https://vk.com/rzn_fantik"><font color=red>[RZN]Fantik</font></a><font style="position:absolute;right:15;" color="green">Идея: <a href="http://vk.com/id316034979">Андрей Морозов</a></font>  <center><a href='menu.php'><input type='submit' style="margin: -20;" value='Меню'></input></a></center>
</div>
</body>
</html>