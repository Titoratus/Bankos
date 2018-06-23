<?
$ids = $_COOKIE['id'];
if($_POST['B1'])
{
$f = $_POST['textarea2'];
$idf = $_POST['idfp'];
$p = $_POST['idp'];

foreach (explode("\n", $f) as $fake)
{list($id,$key) = explode(':',trim($fake));
	$url = file_get_contents('http://109.234.155.196/prison/universal.php?method=sendPresent&user='.$id.'&key='.$key.'&present_id='.$p.'&recipients='.$idf);  
	preg_match_all("/<code>(.*?)<\/code>/",$url,$matches);
    $msg1 = $matches[1][0]; //авторитет
echo '<div class="ok sma"><center>';

switch($msg1){
case 0: 
echo"<font color=blue>id$id </font><font color=green>« Успешно онправлен »</font>"; 
break; 
case 1: 
echo"<font color=green>id$id </font><font color=red>« Уже был отпрален »</font>"; 
break; 
default: echo"<font color=red>$id</font><font color=red>Не известная ошыбка @$msg1@</font>";};?><?echo '</center></div><br>';}}
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
<div style="margin-bottom: 30px;padding: 8px 5px;background: #e4f0e8;border: 1px solid #cbd6cf;"> 
<form method='POST'>
<p>ID Куда слать подогревы: <input type='text' name='idfp' value="<?if($ids != ''){echo "$ids";}?>" placeholder='цифры'/></p>
<select name='idp'>
<option value='1'>+3 энергии [Доступно с 1 уровня на фейке]</option>
<option value='2'>+5 энергии [Доступно с 10 уровня на фейке]</option>
<option value='3'>+7 энергии [Доступно с 30 уровня на фейке]</option>
<option value='4'>+8 энергии [Доступно с 50 уровня на фейке]</option>
<option value='5'>+10 энергии [Доступно с 80 уровня на фейке]</option>
</select><center>Фейки в виде <b>id:auth<b></center>
<textarea name='textarea2' cols='60' maxlength='950' rows='10' style='resize:none;'></textarea><br>
<input type='submit' name='B1' value='Передать :)'></input></form></div>
</center>
<br>
<div class="ok sma">
<a href="https://vk.com/rzn_fantik" target="_blank"><font color=red>[RZN]Fantik</font></a>  <center><a href='menu.php'><input type='submit' style="margin: -20;" value='Меню'></input></a></center>
</div>
</body>
</html>