<?
$key2 = "rznfantikLOLcode";
include("../mobile/function.php");
$vk = array("126226626","53522458","132942251","143249830","311836952","16378328");

$bosses = array('Не известный','Кирпич','Сизый','Махно','Лютый','Шайба','Палыч','Циклоп','Бес','Паленый','Борзов','Хирург','Раиса','Близнецы','Бурят','Дюбель','Дядя Миша','Жестянщики','Отбой','Бугор','Боцман','Жульбаны','Цербер','Пресс','Гастролер','Ташкент','Конвой','Бандяк','Бульдозер','Контрабас','Воркута','Крест','Север','Шнифер','Гризли','Бивень','Кусто','Феня','Крюгер','Карло','Мазай','Фин','Мезен','Ёхан','Чебот','Абу','Дантист','Бельмондо','Немой','Чугун','Змей','Шмель','Старшой', "Бидон", "Шизо", "Кнут",'Зубр','Мельдоний','Борисыч','Полтос','Атас','Думский','','','Тротил');
$bosses1 = array('Не известный','Кирпич','Сизый','Махно','Лютый','Шайба','Палыч','Циклоп','Бес','Паленый','Борзов','Хирург','Раиса','Близнецы','Бурят','Дюбель','Дядя Миша','Жестянщики','Отбой','Бугор','Боцман','Жульбаны','Цербер','Пресс','Гастролер','Ташкент','Конвой','Бандяк','Бульдозер','Контрабас','Воркута','Крест','Север','Шнифер','Гризли','Бивень','Кусто','Феня','Крюгер','Карло','Мазай','Фин','Мезен','Ёхан','Чебот','Абу','Дантист','Бельмондо','Немой','Чугун','Змей','Шмель','Старшой', "Бидон", "Шизо", "Кнут",'Зубр','Мельдоний','Борисыч','Полтос','Атас','Думский','','','Тротил');
$bossm = array(
    "simple" => "<a>(Пацанский)</a>",
    "cool" => "<a style='color: blue;'>(Блатной)</a>",
    "epic" => "<a style='color: red;'>(Авторитетный)</a>"
);
include("../bd2.php");
?>
	<table>
	<?
	$row2 = mysql_query("SELECT id, auth, json, vkl FROM brigada ORDER BY vkl");
	while($r=mysql_fetch_array($row2))
	{  
		$id=$r["id"];
		$auth=$r["auth"];
		$vkl=$r["vkl"];
		$json = $r["json"];
		$fakecount[] = $id.":".$auth;
	$get = json_decode($json,true);
	$idd = $get["id"]; //id босса
	$h_full = $get["h_full"]; //Полное хп
	$h_now = $get["h_now"]; //Сколько осталось хп
	$battle_time = $get["time"]; //Время
	$mode = $get["mode"]; //В каком режиме
	$type = $get["type"]; //Тип
	if($type == 'node'){
		$bosses = $guildnode;
	}else{
		$bosses = $bosses1;
	}
	$timebos = date("G:i:s", mktime(0, 0, $battle_time));//Переводим в нормальное время
	if($idd){
		if($get == null){
		$bbd = "<tr>
				<td>
					<a style='color:white; background: black;'></a>  
				</td>
				<td>
					<a style='color:white; background: black;'></a>  
				</td>
				<td>
					<a style='color:white; background: red;'>Тюряга не ответила на запрос</a> 
				</td>";
		}else{
			if($h_now < '0'){
				$bbd = "<tr>
				<td>
					<a style='color:white; background: black;'></a>  
				</td>
				<td>
					<a style='color:white; background: black;'></a>  
				</td>
				<td>
					<a style='color:white; background: green;'>Победа</a> (".$bosses[$idd].") 
				</td>";
			}else{
				$bbd = "<tr>
				<td>
					<a style='color:white; background: black;'>($timebos)</a>  
				</td>
				<td>
					<a style='color:white; background: black;'>($h_now \ $h_full)</a>  
				</td>
				<td>
					|| В бою (".$bosses[$idd].") 
				</td>";
			}
		}
	}else{
		$bbd = "
		<td><a style='color:white; background: black;'></a></td>
		<td><a style='background: darkorange;'>Не в бою</a></td>";
	}
		echo '
		<td>
			<a>'.$bbd.'</a>
		</td>';
		if(!in_array(decode($_COOKIE['key'],$key2),$vk)){echo '</tr>';}
		if(in_array(decode($_COOKIE['key'],$key2),$vk)){
		echo '<td>
			|| <a style="color:red;" href="../game.php?id='.$id.'&auth='.$auth.'" target="_blank">'.$id.':****</a> 
		</td>';
		}
		if(in_array(decode($_COOKIE['key'],$key2),$vk)){
		echo '<td>
			|| <a href="?del='.$id.'"><button class="button blue">Удалить</button></a> 
		</td>';
		if($vkl == '1'){
			echo '<td><a href="?off='.$id.'"><button class="button green">Выключить</button></a></td></tr>';
		}elseif($vkl == '0'){
			echo '<td><a href="?on='.$id.'"><button class="button red">Включить</button></a></td></tr>';
		}
		}
	}
	?>
		</tr>
	</table>
<?if(in_array(decode($_COOKIE['key'],$key2),$vk)){?>
<textarea style="width: 364px;"><?foreach($fakecount as $s){echo $s."\n";}?></textarea>
<?}?>