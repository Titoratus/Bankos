<?
session_start();
$site = "free_n.php";

if($_POST['save']){
	setcookie("ids", $_POST['id']);
	header('Location: '.$site);
}

if($_COOKIE['ids'] == null){
    $save = $_COOKIE['id'];
}else{$save = $_COOKIE['ids'];}

function file_get_contents_curl($url) {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_AUTOREFERER, TRUE);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);       
    $data = curl_exec($ch);
    curl_close($ch);
    return $data;
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
.btn {display: block; cursor: pointer;}
.btn2 a {display: block; cursor: pointer; color: silver; padding-top: 1em; text-align: right;}
.text {display: block; padding: 16px; margin: 16px; border: 1px dashed silver; height: auto;}
.spoiler input[type=checkbox] {display: none;}
.spoiler input[type=checkbox] + .text {display: none;}
.spoiler input[type=checkbox]:checked + .text {display: block;}
.buttons {background-color: #4CAF50;border: none;color: white;padding: 5px 12px;text-align: center;text-decoration: none;display: inline-block;font-size: 16px;}
#cont {padding: 30px;background: #ffffff;}
</style>
</head>
<body style="background-color: #DDDCEE;">
<meta http-equiv="content-type" content="charset=UTF-8">

<div class="ok nav1">
<center><font color=red>Получить 100 нычкек</font></a></center>
</div>
<?
if($_REQUEST['ok']){
 $ni4ki = $_REQUEST['user_id'];
 ?>
 <div class="spoiler">    <center>
	<label class="btn buttons" for="spoiler">Открыть результат отправки</label></center>
	<input type="checkbox" id="spoiler"/>
	<div class="text">
<?
$fakes = file('../fakes.txt');
$fa = count($fakes);
$l = 1;
for($i = 0,$c = count($fakes); $i < $c; $i++)
{list($id,$key) = explode(':',trim($fakes[$i]));
$ni1 = rand(1, 7);
$ni2 = rand(1, 81);
//////////////////////////////////////////////////////////////////ID-1/////////////////////////////////////////////////////////////////////
$qo = file_get_contents_curl('http://109.234.155.197/prison/universal.php?method=collectionsSendGiftToFriend&friend='.$ni4ki.'&id='.$ni1.'&cid='.$ni2.'&user='.$id.'&key='.$key);
//////////////////////////////////////////////////////////////////ID-2/////////////////////////////////////////////////////////////////////
preg_match_all("/<code>(.*?)<\/code>/",$qo,$matches);
    $result = $matches[1][0];// id132942251 ряд - 1 нычка - 5 - Успешно передана :)
	
preg_match_all("/<result>(.*?)<\/result>/",$qo,$matches);
    $result2 = $matches[1][0];
	
if($result2 == '0'){
    echo '<div class="ok smen"><center><font color=red>Старые фейки</font></a></center></div>';
    $i = count($fakes);
}
if($result =='3'){
    echo '<div class="ok smen"><center><font color=red>id'.$ni4ki.' Лимит - отправленно '.$l.' нычек</font></a></center></div>';
    $i = count($fakes);
}else{
    echo '<div class="ok smen"><center><font color=red>id'.$ni4ki.' ряд - '.$ni2.' нычка - '.$ni1.' - Успешно передана :) #'.$l.'</font></a></center></div>';
    $l++;
    
}
}?>
    <label class="btn2" for="spoiler"><a>hide</a></label>
	</div>
</div>
<?}
?>
<div class="bri sma">
<center>
<form method=post>
<input type="text" style="resize:none;width:15%;" placeholder="Введите свой ID" name="user_id" value="<?if($save != ''){echo "$save";}?>">
<input type="submit" name="save" value="Сохранить ID" style="width: 100;"><br>
<input type="submit" name="ok" value="Получить" style="width: 130;">
</form>
</center>
</div>

<div class="ok sma">
<a href="https://vk.com/rzn_fantik"><font color=red>[RZN]Fantik</font></a>  <center><a href='menu.php'><input type='submit' style="margin: -20;" value='Меню'></input></a></center>
</div>
</body>
</html>