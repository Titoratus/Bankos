<?
session_start();
if($_SESSION['id']){
    include('function.php');
	include_once ("include/button.php");
$id = $_SESSION['id'];
$auth = $_SESSION['auth'];
$bosses = array('Не известный','Кирпич','Сизый','Махно','Лютый','Шайба','Палыч','Циклоп','Бес','Паленый','Борзов','Хирург','Раиса','Близнецы','Бурят','Дюбель','Дядя Миша','Жестянщики','Отбой','Бугор','Боцман','Жульбаны','Цербер','Пресс','Гастролер','Ташкент','Конвой','Бандяк','Бульдозер','Контрабас','Воркута','Крест','Север','Шнифер','Гризли','Бивень','Кусто','Феня','Крюгер','Карло','Мазай','Фин','Мезен','Ёхан','Чебот','Абу','Дантист','Бельмондо','Немой','Чугун','Змей','Шмель','Старшой', "Бидон", "Шизо", "Кнут",'Зубр','Мельдоний','Борисыч','Полтос','Атас','Думский','','','Тротил');
$bossm = array(
    "simple" => "<a>(Пацанский)</a>",
    "cool" => "<a style='color: blue;'>(Блатной)</a>",
    "epic" => "<a style='color: red;'>(Авторитетный)</a>",
);
    $get = file_get_contents_curl("http://109.234.156.251/prison/universal.php?key=$auth&user=$id&method=getBoss");
    preg_match("#<id>(.*?)<\/id>#",$get,$match); $idd = $match[1]; //id босса
    preg_match("#<h_full>(.*?)<\/h_full>#",$get,$match); $h_full = $match[1]; //Полное хп
    preg_match("#<h_now>(.*?)<\/h_now>#",$get,$match); $h_now = $match[1]; //Сколько осталось хп
    preg_match("#<battle_time>(.*?)<\/battle_time>#",$get,$match); $battle_time = $match[1]; //Время
    preg_match("#<cur_damage>(.*?)<\/cur_damage>#",$get,$match); $cur_damage = $match[1]; //Наш дамаг
    preg_match("#<mode>(.*?)<\/mode>#",$get,$match); $mode = $match[1]; //В каком режиме
	preg_match_all("#<battle_result>\r\n		<id>(.*?)</id>#",$get,$matches); $endbattle = $matches[1][0];// ID босса если выиграли
$bossid = $bosses[$idd];//Переводим из id в название босса
$bossmode = $bossm[$mode];//Переводим мод в понятное значение
$timebos = date("H:i:s", mktime(0, 0, $battle_time));//Переводим в нормальное время
$pochp = ($h_now/$h_full)*200;
$poctime = ($battle_time/$battle_time)*200;
$endbattle1 = $bosses[$endbattle];//Переводим из id в название босса

if($_GET['id']){
    $id = $_SESSION['id'];
    $auth = $_SESSION['auth'];
    $idb = $_GET['id'];
    $getb = file_get_contents_curl("http://109.234.155.197/prison/universal.php?method=startBattle&key=$auth&buff=0&user=$id&boss_id=$idb");
    preg_match("#<code>(.*?)<\/code>#",$getb,$match); $code = $match[1]; #code
    if($code==6){$echo[]='Лимит на босса';}
    if($code==2){$echo[]='Нет ключей';}
    if($code==0){$echo[]='Успешно напали';}
}
?>
<html>
    <head>
		<script src="https://code.jquery.com/jquery-2.1.4.min.js"></script>
		<link rel="stylesheet" type="text/css" href="css/boss.css" />
    </head>
    <body>
        <?if($echo){?><center><div class='error'><a id="tex"><?foreach($echo as $err){echo $err;}?></a></div></center><?}?>
        <div class='center'>
            <?if($endbattle1){
            echo "Победа<b> ".$endbattle1."</b>";
            }elseif($battle_time){?>
            <center>
				<b><?echo $bossid.' '.$bossmode;?></b><a id="bossID" style="opacity:0;"><?echo $idd;?></a>
			</center>
			<br>
            <?echo '<div class="divb"><div class="dibc" style="width:'.$pochp.'px;"><div class="divn"><center>'.$h_now.'/'.$h_full.'</center></div></div></div>'?>
			<br>
            <?echo '<div class="divb"><div class="dibc" style="width:'.$poctime.'px;"><div class="divn"><center>'.$timebos.'</center></div></div></div>'?>
			<br>
            <center>Мой урон: <a id="curdamag"><?echo $cur_damage;?></a></center><hr>
                Урон друзей:<br>
            <?echo frends($get);?>
			<hr>
			<center>
			<div id="reshit"></div>
				<img src="img/glas.jpg" id="glas" title="Пальцем в глаз"/>
				<img src="img/vux.jpg" id="vux" title="Коленом в ухо"/>
				<img src="img/soln.jpg" id="soln" title="Пыром в солнышко"/>
				<img src="img/pax.jpg" id="pax" title="В пах"/><br><hr>
				
				<img src="img/f1.jpg" id="f1" title="Пырнуть финкой"/>
				<img src="img/s1.jpg" id="s1" title="Шмальнуть из самопала"/>
				<img src="img/y1.jpg" id="y1" title="Подкинуть яда"/><br>
				Кол-во:<input type="number" id="counthit" style="width:80px;" value="1"><br>
			</center>
			<?}else{?>
<div style="width:90%; margin:auto; text-align:left;">
<table border="0"  style="margin:auto;">
<thead>
<tr>
	<th>Беспредел.</th>
	<th>Вертухаи</th>
	<th>Рецидивисты</th>
</tr>
</thead>
<tbody>
<tr>
<td valign="top">
	<a href="boss.php?id=1" class="color green button boss">Кирпич</a>
	<a href="boss.php?id=2" class="color green button boss">Сизый</a>
	<a href="boss.php?id=3" class="color green button boss">Махно</a>
	<a href="boss.php?id=4" class="color green button boss">Лютый</a>
	<a href="boss.php?id=24" class="color green button boss">Гастролёр</a>
	<a href="boss.php?id=5" class="color green button boss">Шайба</a>
	<a href="boss.php?id=42" class="color green button boss">Мезен</a>
	<a href="boss.php?id=14" class="color green button boss">Бурят</a>
	<a href="boss.php?id=16" class="color green button boss">Дядя Миша</a>
	<a href="boss.php?id=27" class="color green button boss">Бандяк</a>
	<a href="boss.php?id=45" class="color green button boss">Абу</a>
	<a href="boss.php?id=34" class="color green button boss">Гризли</a>
	<a href="boss.php?id=30" class="color green button boss">Воркута</a>
	<a href="boss.php?id=37" class="color green button boss">Феня</a>
	<a href="boss.php?id=32" class="color green button boss">Север</a>
	<a href="boss.php?id=40" class="color green button boss">Мазай</a>
	<a href="boss.php?id=11" class="color green button boss">Хирург</a>
	<a href="boss.php?id=39" class="color green button boss">Карло</a>
	<a href="boss.php?id=23" class="color green button boss">Пресс</a>
	<a href="boss.php?id=48" class="color green button boss">Немой</a>
	<a href="boss.php?id=53" class="color green button boss">Бидон</a>
	<a href="boss.php?id=52" class="color green button boss">Старшой</a>
	<a href="boss.php?id=19" class="color green button boss">Бугор</a>
	<a href="boss.php?id=50" class="color green button boss">Змей</a>
</td>
<td valign="top">
	<a href="boss.php?id=6" class="color green button boss">Палыч</a>
	<a href="boss.php?id=7" class="color green button boss">Циклоп</a>
	<a href="boss.php?id=12" class="color green button boss">Раиса</a>
	<a href="boss.php?id=8" class="color green button boss">Бес</a>
	<a href="boss.php?id=9" class="color green button boss">Палёный</a>
	<a href="boss.php?id=13" class="color green button boss">Близнецы</a>
	<a href="boss.php?id=10" class="color green button boss">Борзов</a>
	<a href="boss.php?id=22" class="color green button boss">Цербер</a>
	<a href="boss.php?id=43" class="color green button boss">Ёхан</a>
	<a href="boss.php?id=26" class="color green button boss">Конвой</a>
	<a href="boss.php?id=28" class="color green button boss">Бульдозер</a>
	<a href="boss.php?id=36" class="color green button boss">Кусто</a>
	<a href="boss.php?id=41" class="color green button boss">Фин</a>
	<a href="boss.php?id=15" class="color green button boss">Дюбель</a>
	<a href="boss.php?id=46" class="color green button boss">Дантист</a>
	<a href="boss.php?id=49" class="color green button boss">Чугун</a>
	<a href="boss.php?id=55" class="color green button boss">Кнут</a>
	<a href="boss.php?id=31" class="color green button boss">Крест</a>
</td>
<td valign="top">
	<a href="boss.php?id=17" class="color green button boss">Жестянщики</a>
	<a href="boss.php?id=18" class="color green button boss">Отбой</a>
	<a href="boss.php?id=20" class="color green button boss">Боцман</a>
	<a href="boss.php?id=21" class="color green button boss">Жульбаны</a>
	<a href="boss.php?id=33" class="color green button boss">Шнифер</a>
	<a href="boss.php?id=35" class="color green button boss">Бивень</a>
	<a href="boss.php?id=25" class="color green button boss">Ташкент</a>
	<a href="boss.php?id=29" class="color green button boss">Контрабас</a>
	<a href="boss.php?id=44" class="color green button boss">Чебот</a>
	<a href="boss.php?id=38" class="color green button boss">Крюгер</a>
	<a href="boss.php?id=47" class="color green button boss">Бельмондо</a>
	<a href="boss.php?id=51" class="color green button boss">Шмель</a>
	<a href="boss.php?id=54" class="color green button boss">Шизо</a>
</td>
</tr>
</tbody>
</table>    
        <?}?></div>
        </div>
<script src="js/script.js"></script>
        <center>
		<?echo $button;?>
		</center>
    </body><?}else{header('Location: /mobile/');}?>
</html>