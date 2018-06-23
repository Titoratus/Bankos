<? 
include('function.php');
if($_COOKIE['id'] && $_COOKIE['auth']){
$bosses = array('Не известный','Кирпич','Сизый','Махно','Лютый','Шайба','Палыч','Циклоп','Бес','Паленый','Борзов','Хирург','Раиса','Близнецы','Бурят','Дюбель','Дядя Миша','Жестянщики','Отбой','Бугор','Боцман','Жульбаны','Цербер','Пресс','Гастролер','Ташкент','Конвой','Бандяк','Бульдозер','Контрабас','Воркута','Крест','Север','Шнифер','Гризли','Бивень','Кусто','Феня','Крюгер','Карло','Мазай','Фин','Мезен','Ёхан','Чебот','Абу','Дантист','Бельмондо','Немой','Чугун','Змей','Шмель','Старшой', "Бидон", "Шизо", "Кнут",'Зубр','Мельдоний','Борисыч','Полтос','Атас','Думский','','','Тротил');
$bossm = array(
    "simple" => "<a>(Пацанский)</a>",
    "cool" => "<a style='color: blue;'>(Блатной)</a>",
    "epic" => "<a style='color: red;'>(Авторитетный)</a>",
);
$id = $_COOKIE['id'];
$auth = $_COOKIE['auth'];


	if($_POST['brit']){
		$url = file_get_contents('http://109.234.155.196/prison/universal.php?user='.$id.'&key='.$auth.'&method=shaveBeard'); 
		preg_match_all("/<msg>(.*?)<\/msg>/",$url,$matches);
		$result = $matches[1][0]; //код
		if($result == 'ok'){
			echo 'Успешно побрились';
		}
	}
	// глаз 1
	// колено 2
	// солнышко 3
	// финка 4
	// самопал 5
	// яд 6
	// пах 7
	if($_POST['hitBoss']){
		$count = $_POST['amout']; //количество
		$idhit = $_POST['idhit']; // id оружия
		$boss_id = $_POST['boss_id']; // id босса
		$url = file_get_contents("http://109.234.155.196/prison/universal.php?user=$id&key=$auth&method=hitBoss&amount=$count&spell_id=$idhit&boss_id=$boss_id"); 
		preg_match_all("/<code>(.*?)<\/code>/",$url,$matches);
		$result = $matches[1][0]; //code ошибки  //0 ok //11 no weapons
		preg_match_all("/<damage>(.*?)<\/damage>/",$url,$matches);
		$damage = $matches[1][0]; //сколько нанесли
		preg_match_all("/<currentDamage>(.*?)<\/currentDamage>/",$url,$matches);
		$currentDamage = $matches[1][0]; //общий ваш дамаг
		
		
		if($idhit == '4' || $idhit == '5' || $idhit == '6'){
			$perez = 777;
		}else{
			$perez = 333;
		}
		
		$jresult = array(
			'code' => $result,
			'damage' => $damage,
			'perez' => $perez,
			'curdamage' => $currentDamage
		);
		print (json_encode($jresult));
		
		
		//echo "Нанесли <a style='color:red;'>$damage</a> урона";
		// }elseif($result == '3')
		// {
			// echo "Нехватает оружия";
		// }elseif($result == '111')
		// {
			// echo "Перезарядка оружия ¯\_(ツ)_/¯";
		// }else{
			// echo "Что за ошибка ? #$result";
		// }
	}
	
}

	if($_POST['refresh1']){
		$get = file_get_contents("http://109.234.156.251/prison/universal.php?key=$auth&user=$id&method=getBoss");
		preg_match("#<id>(.*?)<\/id>#",$get,$match); $idd = $match[1]; //id босса
		preg_match("#<h_full>(.*?)<\/h_full>#",$get,$match); $h_full = $match[1]; //Полное хп
		preg_match("#<h_now>(.*?)<\/h_now>#",$get,$match); $h_now = $match[1]; //Сколько осталось хп
		preg_match("#<battle_time>(.*?)<\/battle_time>#",$get,$match); $battle_time = $match[1]; //Время
		preg_match("#<cur_damage>(.*?)<\/cur_damage>#",$get,$match); $cur_damage = $match[1]; //Наш дамаг
		preg_match("#<mode>(.*?)<\/mode>#",$get,$match); $mode = $match[1]; //В каком режиме
		
		preg_match("#<type>(.*?)<\/type>#",$get,$match); $type = $match[1]; //Тип
		if($type == 'node'){$bosses = $guildnode; $mode = 'lal';}
		
		$bossid = $bosses[$idd];//Переводим из id в название босса
		$bossmode = $bossm[$mode];//Переводим мод в понятное значение
		$timebosS = date("s", mktime(0, 0, $battle_time));//Переводим в нормальное время
		$timebosI = date("i", mktime(0, 0, $battle_time));//Переводим в нормальное время
		$timebosH = date("H", mktime(0, 0, $battle_time));//Переводим в нормальное время
		$timebos = date("G:i:s", mktime(0, 0, $battle_time));//Переводим в нормальное время
		$pochp = ($h_now/$h_full)*200;
		$poctime = intval(($battle_time/28800)*200);
		if($poctime > 200){$poctime = 200;}
		
		if($battle_time){?>
			<center style="margin-left: 25px;"><b><?echo $bossid.' '.$bossmode;?></b><a id="bossID" style="opacity:0;"><?echo $idd;?></a></center><br>
			<div class="divb"><div class="dibc" style="width:<?=$pochp;?>px;"><div class="divn"><center><?=number_format($h_now, 0, '.', '.').'/'.number_format($h_full, 0, '.', '.')?></center></div></div></div>'<br>
			<div class="divb"><div class="dibc" style="width:<?=$poctime;?>px;"><div id="timer" class="divn"><center><?=$timebos?></center></div></div></div>
			<br>
			<script>
			window.onload = function() // дожидаемся загрузки страницы
			{
			 var sss1 = new Date(1970,1,1,<?=$timebosH;?>,<?=$timebosI;?>,<?=$timebosS;?>);
			 initializeTimer(sss1);
			}
			</script>
			<center>Мой урон: <a id="curdamag"><?echo $cur_damage;?></a></center><hr>
		<?}else{
			echo '<script>window.location.href = "boss.php"</script>';
		}
	}
	
	if($_POST['refresh2']){
		echo frends(file_get_contents("http://109.234.156.251/prison/universal.php?key=$auth&user=$id&method=getBoss"));
	}
	if($_POST['refresh']){
	$get = file_get_contents("http://109.234.156.251/prison/universal.php?key=$auth&user=$id&method=getInfo");
	//pars оружия
	preg_match('#<spell id="6">(.*?)</spell>#',$get,$matches);
	$yad = $matches[1]; //яд
	preg_match('#<spell id="5">(.*?)</spell>#',$get,$matches);
	$sam = $matches[1]; //самопал
	preg_match('#<spell id="4">(.*?)</spell>#',$get,$matches);
	$fin = $matches[1]; //финки
	//pars оружия
	
	echo "<td id='fin66'>$fin</td>
			<td id='sam66'>$sam</td>
			<td id='yad66'>$yad</td>";
	}
?>