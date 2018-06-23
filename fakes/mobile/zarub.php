<?
session_start();
include_once("function.php");
include_once ("include/button.php");
if(!$_SESSION['id']){header('Location: /mobile/');}else{
    $id = $_SESSION['id']; //ид пользователя
    $auth = $_SESSION['auth']; //аут пользователя
    #$rez = $r["rez"]; //режим зарубов
    $get = file_get_contents_curl("http://109.234.156.251/prison/universal.php?user=$id&key=$auth&method=chestRace%2Eget");//отправка запроса
	$arr = json_decode($get,true);//парсим JSON

function proc($a1,$a2){
    $a3 = intval(($a1/$a2)*100);
    return $a3;
}

if($_POST['na4at']){
	$get = file_get_contents_curl("http://109.234.156.251/prison/universal.php?user=$id&key=$auth&method=chestRace%2Eget");//отправка запроса
	$arr = json_decode($get,true);//парсим JSON
	if($arr["msg"] == "ok"){
		$echo[] = "Успешно начали заруб";
	}
}
if($_POST['3abrat']){
	$get = file_get_contents_curl("http://109.234.156.251/prison/universal.php?user=$id&key=$auth&method=chestRace%2Eget");//отправка запроса
	$arr = json_decode($get,true);//парсим JSON
	if($arr["msg"] == "ok"){
		$echo[] = "Успешно забрали награду";
	}
}
?>
<html>
    <head>
        <script src="https://code.jquery.com/jquery-2.1.4.min.js"></script>
        <link rel="stylesheet" href="css/menu.css">
    </head>
    <body>
<script>
function del(){
 $("div.error").remove();
}
setTimeout(del, 3000);
</script>
<?
if($echo){
foreach($echo as $err){?>
<?echo "<center><div id='err' class='error'>";
	echo $err;
	echo "</div></center>";
}}
?>
<div style="margin: auto; width: 400px;">
    <?
	$ok = $arr["race"]["acceptTS"];
	if($ok == 0){
		echo "<center><b><a style='color: red;'>Заруб не начат</a></b></center><br>";
	}else{
		echo "<center><b><a style='color: green;'>Идет заруб</a></b></center><br>";
	}
    foreach($arr["race"]["tasks"] AS $sk){
    $prog = $sk["progress"]; //сколько выполнено 
	$tar = $sk["target"]; //сколько надо
	$idz = $sk["id"]; //ид задания
    $zid = array('error','Набери '.$tar.' авторитета','Отправь подогревы '.$tar.' корешам','Бутырка','Кресты','В.централ','М.тишина','В.пятак','Б.лебедь','О.централ','Чр.делфин','Кр.пресня','Софийка','Угольки','Нанести '.$tar.' урона','Победи в наездах корешей '.$tar.' раз','Попросить '.$tar.' нычки','Отправить '.$tar.' нычек корешам','Попроси '.$tar.' корешей помочь в бою','Напомнить о друге','Собери '.$tar.' папирос','Харкнуть '.$tar.' раз в баланду');

        if($prog < $tar){
            echo '<img src="img/no.png">'.$zid[$idz].', '.$prog.'/'.$tar.' : выполнено '.proc($prog,$tar).'% <br>';
        }
		if($tar <= $prog){echo '<img src="img/yes.png">'.$zid[$idz].', '.$tar.'/'.$tar.' : выполнено 100% <br>';}
}
if($sk["race"]["oldProgress"] == 1){echo "<center><form method='post'><input type='submit' name='3abrat' value='Забрать награду'></form><center>";}
if($ok == 0){echo "<center><form method='post'><input type='submit' name='na4at' value='Начать заруб'></form><center>";}
?>
</div>
<center><div style="width: 300px;margin: inherit;">
<?echo $button;?>
</div></center></body>
</html>
<?}?>