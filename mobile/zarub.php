<!DOCTYPE html>
<?
session_start();
include_once("function.php");
if(!$_COOKIE['id']){header('Location: /mobile/');}else{
    $id = $_COOKIE['id']; //ид пользователя
    $auth = $_COOKIE['auth']; //аут пользователя
    #$rez = $r["rez"]; //режим зарубов
    $get = file_get_contents_curl("http://109.234.156.251/prison/universal.php?user=$id&key=$auth&method=chestRace%2Eget");//отправка запроса
	$arr1 = json_decode($get,true);//парсим JSON

function proc($a1,$a2){
    $a3 = intval(($a1/$a2)*100);
    return $a3;
}

if($_POST['na4at']){
	$rez = $_POST["rez"];
	$get = file_get_contents_curl("http://109.234.156.251/prison/universal.php?user=$id&key=$auth&league=$rez&method=chestRace.accept");//отправка запроса
	$arr = json_decode($get,true);//парсим JSON
	if($arr["msg"] == "ok"){
		$echo[] = "<a style='color: green;'>Успешно начали заруб</a>";
	}elseif($arr["code"] == "3"){
		$echo[] = "<a style='color: red;'>Данный режим заблокирован</a>";
	}else{
		$echo[] = "<a style='color: red;'>Ошибка</a>";
	}
}
if($_POST['3abrat']){
	$get = file_get_contents_curl("http://109.234.156.251/prison/universal.php?user=$id&key=$auth&method=chestRace.claim");//отправка запроса
	$arr = json_decode($get,true);//парсим JSON
	$pe4at = $arr["rewards"][0]["value"];
	$exp = $arr["rewards"][1]["value"];
	$slitki = $arr["rewards"][3]["value"];
	
	if($arr["msg"] == "ok"){
		$echo[] = "<a style='color:red'>Успешно забрали награду<br>
		Печатки: $pe4at<br>
		Слитки: $slitki</a>";
	}
}
?>
<html>
    <head>
        <script src="https://code.jquery.com/jquery-2.1.4.min.js"></script>
		<link rel="stylesheet" href="css/style.css" media="screen" type="text/css" />
        <link rel="stylesheet" href="css/menu.css">
    </head>
    <body>
	<div style="text-align: center;">
		<?include "../head_menu.php";?>
	</div>
<script>
function del(){
 $("div.error").remove();
}
setTimeout(del, 3000);
</script>
<?
if($echo){
foreach($echo as $err){
    echo "<div style=\"text-align: center;\"><div id='err' class='error'>";
	echo $err;
	echo "</div></center>";
}}
?>
<div style="margin: auto; width: 400px;">
    <?
	$ok = $arr1["race"]["acceptTS"];
	$oldProgress = $arr1["race"]["oldProgress"];
	if($ok == 0){
		echo "<div style=\"text-align: center;\"><b><a style='color: red;'>Заруб не начат</a></b></div><br>\n";
	}else{
		echo "<div style=\"text-align: center;\"><b><a style='color: green;'>Идет заруб</a></b></div><br>\n";
	}
	$god = 0;
    foreach($arr1["race"]["tasks"] AS $sk){
    $prog = $sk["progress"]; //сколько выполнено 
	$tar = $sk["target"]; //сколько надо
	$idz = $sk["id"]; //ид задания
    $zid = array('error','Набери '.$tar.' авторитета','Отправь подогревы '.$tar.' корешам','<a class="danger_zone">Бутырка</a>','Кресты','В.централ','М.тишина','<a class="danger_zone">В.пятак</a>','Б.лебедь','О.централ','<a class="danger_zone">Чр.делфин</a>','Кр.пресня','Софийка','Угольки','Нанести '.$tar.' урона','Победи в наездах корешей '.$tar.' раз','Попросить '.$tar.' нычки','Отправить '.$tar.' нычек корешам','Попроси '.$tar.' корешей помочь в бою','Напомнить о друге','Собери '.$tar.' папирос','Харкнуть '.$tar.' раз в баланду');

        if($prog < $tar){
            echo '<img src="img/no.png">'.$zid[$idz].', '.$prog.'/'.$tar.' : выполнено '.proc($prog,$tar).'% <br>'."\n";
        }
		if($tar <= $prog){echo '<img src="img/yes.png">'.$zid[$idz].', '.$tar.'/'.$tar.' : выполнено 100% <br>'."\n"; $god++;}
}
if($god == 8){
	echo "<div style=\"text-align: center;\"><form method='post'><input type='submit' name='3abrat' value='Забрать награду'></form></div>";
}
if($ok == 0){
	echo '
	<div style="text-align: center;">
		<form method="post">
			<select name="rez" size="4">
				<optgroup label="Режим">
				<option value="simple" selected="selected">Пацанские</option>
				<option value="cool">Блатные</option>
				<option value="epic">Авторитетные</option>
				</optgroup>
			</select><br>
			<input type="submit" name="na4at" value="Начать заруб">
		</form>
	</div>';
}
?>

</div>
<div style="text-align: center;">
    <div style="margin: inherit;">
        <?include_once ("include/button.php");?>
    </div>
</div></body>
</html>
<?}?>