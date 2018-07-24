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
<input type='submit' name='B1' value='Передать :)'></input></form>