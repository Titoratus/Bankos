<?
if($_COOKIE['ids'] == null){
    $ids = $_COOKIE['id'];
}else{$ids = $_COOKIE['ids'];}
if($_COOKIE['auths'] == null){
    $auths = $_COOKIE['auth'];
}else{$auths = $_COOKIE['auths'];}

$site = "vpar.php";

if($_POST['save']){
    setcookie("ids", $_POST['id']);
    setcookie("auths", $_POST['auth']);
    header('Location: '.$site);
}


if($_POST['ok']){  
$id = $_POST['id'];
$auth = $_POST['auth'];

$p=0;

for ($w = 1; $w <= 99; $w++) {
$get = file_get_contents('http://109.234.156.251/prison/universal.php?key='.$auth.'&method=collectionsCollect&user='.$id.'&cid='.$w++);
	preg_match_all('/<result>(.*?)<\/result>/',$get,$matches);
	$result = $matches[1][0]; //result
    if($result == "0"){$p++;}
}
echo "<center><div class=\"smen sma\">Впарили $p коллекций</div></center>"; 
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
    
<form method=post>
<input type="text" style="resize:none;width:15%;" placeholder="Введите свой ID" name="id" value="<?if($ids != ''){echo "$ids";}?>"><br>
<input type="text" style="resize:none;width:15%;" placeholder="Введите свой Auth" name="auth" value="<?if($auths != ''){echo "$auths";}?>"><br>
<input type="submit" name="ok" value="Впарить" style="width: 130;">
<input type="submit" name="save" value="Сохранить" style="width: 75;">
</form>
    
</center><br>
<div class="ok sma">
<a href="https://vk.com/rzn_fantik" target="_blank"><font color=red>Скриптер: [RZN]Fantik</font></a><font style="position:absolute;right:15;" color="green">Идея: <a href="http://vk.com/id316034979" target="_blank">Андрей Морозов</a></font>  <center><a href='menu.php'><input type='submit' style="margin: -20;" value='Меню'></input></a></center>
</div>
</body>
</html>