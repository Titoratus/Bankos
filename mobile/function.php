<?
//include_once('check_acount.php');
function file_get_contents_curl($url) {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_AUTOREFERER, TRUE);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_TIMEOUT, 10);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
	$data = curl_exec($ch);
    curl_close($ch);
	return $data;
}

function post($post){
	$server = "109.234.156.251";
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, "http://" . $server . "/prison/universal.php");
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 60);
	curl_setopt($ch, CURLOPT_TIMEOUT, 60);
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
	$result = array("0" => curl_exec($ch), "1" => curl_getinfo($ch));
	curl_close($ch);
	return $result;
}
function post2($url, $post){
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_PORT, 15006);
	curl_setopt($ch, CURLOPT_VERBOSE, true);
	curl_setopt($ch, CURLOPT_USERAGENT,'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.13) Gecko/20080311 Firefox/2.0.0.13');
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
	curl_setopt($ch, CURLOPT_TIMEOUT, 10);
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
	$post = array("0" => curl_exec($ch), "1" => curl_getinfo($ch));
	curl_close($ch);
	return $post;
}

function get_file($name){return unserialize(file_get_contents($name));}

function namevk($id){
	$get = file_get_contents_curl("https://api.vk.com/method/users.get?user_ids=$id&lang=ru&v=3.0");
	$json = json_decode($get, true);
	$name = $json["response"][0]["first_name"];
	$famile = $json["response"][0]["last_name"];
	return $name." ".$famile;
}

function pars($log, $begin, $end)
{
	if (!$log) {
		return NULL;
	}

	$begin = strpos($log, $begin) + strlen($begin);
	$end = strpos($log, $end, $begin);
	$result = substr($log, $begin, $end - $begin);
	return $result;
}
function clean($value) { //удаление из текста всякой дряни 
$value = trim($value); 
$value = stripslashes($value); 
$value = strip_tags($value); 
$value = htmlspecialchars($value); 

return $value; 
}

function dump($a){
	echo "<pre>";
	print_r($a);
	echo "</pre>";
}

function lvl_baul($bayl_result){//уровень баула
	$pointbl = array(0,50,150,300,500,750,1050,1425,1925,2575,3375,4375,5775,7575,9875,12875,16875,22375,29375,38375,50375,74375,104375,141875,188750,247250); // уровни баулов
	for($i=0; $i<count($pointbl); $i++){
		if ($bayl_result < $pointbl[2]) $bayl_total = '0';
		if ($bayl_result >= $pointbl[$i] && $bayl_result < $pointbl[$i+1]) {
			$bayl_total = $i;
		}
		if ($bayl_result >= $pointbl[count($pointbl)-1]) {
			$sss = count($pointbl)-1;
			$bayl_total = "<span style=\"color:red;font-weight:bold;\">$sss</span>";
		}
	}
	return $bayl_total;
}

function match($b,$c){
	preg_match_all("#<$b>(.*?)</$b>#",$c,$match);
	return $match[1][0];
}
function encode($unencoded,$key){//Шифруем
$string=base64_encode($unencoded);//Переводим в base64

$arr=array();//Это массив
$x=0;
while ($x++< strlen($string)) {//Цикл
$arr[$x-1] = md5(md5($key.$string[$x-1]).$key);//Почти чистый md5
    $newstr = $newstr.$arr[$x-1][3].$arr[$x-1][6].$arr[$x-1][1].$arr[$x-1][2];//Склеиваем символы
}
return $newstr;//Вертаем строку
}

function decode($encoded, $key){//расшифровываем
$strofsym="qwertyuiopasdfghjklzxcvbnm1234567890QWERTYUIOPASDFGHJKLZXCVBNM=";//Символы, с которых состоит base64-ключ
$x=0;
while ($x++<= strlen($strofsym)) {//Цикл
$tmp = md5(md5($key.$strofsym[$x-1]).$key);//Хеш, который соответствует символу, на который его заменят.
$encoded = str_replace($tmp[3].$tmp[6].$tmp[1].$tmp[2], $strofsym[$x-1], $encoded);//Заменяем №3,6,1,2 из хеша на символ
}
return base64_decode($encoded);//Вертаем расшифрованную строку
}

function frends($get){
    $xml = simplexml_load_string($get);
    $q1 = $xml->xpath('//data/latest_events/friends_rating');

    foreach($q1 as $q2){
        foreach($q2 as $q3){
            $qid = $q3->uid;
			
            $qdm = number_format((int)$q3->damage);
			
			$urlvk = file_get_contents('https://api.vk.com/method/getProfiles?user_ids='.$qid.'&fields=photo_50&lang=ru&v=3.0');
            $arr1 = json_decode($urlvk,true);
			$name=$arr1['response']['0']['first_name']; // Имя в вконтакте
            $famil_vk=$arr1['response']['0']['last_name']; // Фамилия в вконтате
			$photo_vk=$arr1['response']['0']['photo_50']; // фотка 50 на 50 пкс
			
			//var_dump($arr1);
			if($_COOKIE["id"] == $qid){
			echo "<img src='$photo_vk' style=\"width: 20px;\"><a href=\"https://vk.com/id$qid\" style=\"color:green;\" target=\"_blank\">$name $famil_vk</a> - <a style=\"font-weight: bold;\">".$qdm."</a><br>";
			}else{
            echo "<img src='$photo_vk' style=\"width: 20px;\"><a href=\"https://vk.com/id$qid\" target=\"_blank\">$name $famil_vk</a> - ".$qdm."<br>";
			}
        }
    }
return;
}

function myWeapon($html){
$weap = pars($html, "<weaponLevels>", "</weaponLevels>");
$car = pars($html, "<unitLevels>", "</unitLevels>");
$select = pars($html, "<selectedWeapons>", "</selectedWeapons>");
 
$arr = array();
 
for ($a = 1; $a < 30; $a++) {
    $weap2 = pars($weap, "<weapon weaponId=\"$a\">", "</weapon>");
    if (0 < $weap2) {
        $arr["weapon"][$a] = $weap2;
        unset($weap2);
    }
}
for ($b = 8; $b < 30; $b++) {
    $car2 = pars($car, "<unit unitId=\"$b\">", "</unit>");
    if (0 < $car2) {
        $arr["unit"][$b] = $car2;
        unset($car2);
    }
}
for ($c = 1; $c < 10; $c++) {
    $sel = pars($select, "<unit unitId=\"$c\">", "</unit>");
    if (0 < $sel) {
        $arr["select"][$c] = $sel;
        unset($sel);
    }
}
 
return $arr;
}

function damages($get){
    $xml = simplexml_load_string($get);
	$parse = pars($get,"<battle_result>","</battle_result>");
	
	$parse = strval($parse);
	if($get == null or $get == ''){
		echo "#error";
	}
	if($parse == null){
		$q1 = $xml->xpath('//data/battle_result/friends_rating');
		echo "#553<br>";
		var_dump($parse);
	}else{
		$q1 = $xml->xpath('//data/latest_events/friends_rating');
		echo "#132";
	}

    foreach($q1 as $q2){
        foreach($q2 as $q3){
            $qid = $q3->uid; //id
			$qdm = (int)$q3->damage; //damage
			
			$row = mysql_query("SELECT `uid`, `damage` FROM `damage` WHERE uid = \"$qid\"");
			$r=mysql_fetch_array($row);
			
			if($r == false){
				$rows = mysql_query("INSERT INTO `damage`(`uid`, `damage`) VALUES (\"$qid\",\"$qdm\")");
			}else{
				$ids = $r['uid'];
				$damag = $r['damage'];
				
				if($qdm > $damag){
					$rows = mysql_query("UPDATE `damage` SET `damage`=\"$qdm\" WHERE uid = \"$qid\"");
				}
			}
        }
    }
return;
}

function printLevel($raiting){
	$level=1; $isLevel=false; $start=39; $i=18; $k=0; $total=0;
	if($raiting>=$start){
		$k=$start; $total=$k;
		while(!$isLevel){
			if($total<=$raiting){
				$level++;
				$k+=$i;
				$total+=$k;
			} else {
				$isLevel=true;
			}
		}
	}
	return $level;
}
function nich($get){
    $xml = simplexml_load_string($get);
    $qa = $xml->xpath('//data/collections/items');
    $q1 = 0;

    foreach($qa as $q2){
        if (isset($q2->level)) {
            foreach($q2->level as $q3){
             $q1 += $q3["0"];
            }
        }
    }
return $q1;
}

function talant($get){ // таланты
    $xml = simplexml_load_string($get);
    $qa = $xml->xpath('//data/user/playerTalents');
    $q1 = 0;

    foreach($qa[0]->talent as $q2){
       $q1 += $q2;
    }
return $q1;
}

// уровень зарубов
function chLvl($exp){
	$a=90;
	$b=10;
	$exp+=$a;
	return intval($exp<$a?0:(-1*(2*$a-$b)+sqrt((2*$a-$b)*(2*$a-$b)-4*$b*(-2*$exp)))/(2*$b));
}
$guildnode = array(
"1" =>"Тройка <a style='color: red'>КПП </a>",
"2" =>"Тройка <a style='color: red'>Восточная вышка </a>",
"3" =>"Тройка <a style='color: red'>Лазарет </a>",
"4" =>"Тройка <a style='color: red'>Прачка </a>",
"5" =>"Тройка <a style='color: red'>Блок № 1 </a>",
"6" =>"Тройка <a style='color: red'>Западная вышка </a>",
"7" =>"Тройка <a style='color: red'>Котельная </a>",
"8" =>"Тройка <a style='color: red'>Столовая </a>",
"9" =>"Тройка <a style='color: red'>Блок № 2 </a>",
"10" =>"Тройка <a style='color: red'>Административный корпус </a>",
"11" =>"Копейка <a style='color: red'>Проходная </a>",
"12" =>"Копейка <a style='color: red'>Пищеблок </a>",
"13" =>"Копейка <a style='color: red'>Вышка </a>",
"14" =>"Копейка <a style='color: red'>Барак №3 </a>",
"15" =>"Копейка <a style='color: red'>Цех </a>",
"16" =>"Копейка <a style='color: red'>Барак №2 </a>",
"17" =>"Копейка <a style='color: red'>Морг </a>",
"18" =>"Копейка <a style='color: red'>Карцер </a>",
"19" =>"Копейка <a style='color: red'>Барак №4 </a>",
"20" =>"Копейка <a style='color: red'>Корпус охраны </a>",
"21" =>"Красная однёрка <a style='color: red'>Барак №1 </a>",
"22" =>"Красная однёрка <a style='color: red'>Медпункт </a>",
"23" =>"Красная однёрка <a style='color: red'>Барак №2 </a>",
"24" =>"Красная однёрка <a style='color: red'>Вышка </a>",
"25" =>"Красная однёрка <a style='color: red'>Баня </a>",
"26" =>"Красная однёрка <a style='color: red'>Барак №3 </a>",
"27" =>"Красная однёрка <a style='color: red'>Корпус А </a>",
"28" =>"Красная однёрка <a style='color: red'>Библиотека </a>",
"29" =>"Красная однёрка <a style='color: red'>Прачка </a>",
"30" =>"Красная однёрка <a style='color: red'>Теплотрасса </a>",
"31" =>"Красная однёрка <a style='color: red'>Карцер </a>",
"32" =>"Красная однёрка <a style='color: red'>Хозблок </a>",
"33" =>"Красная однёрка <a style='color: red'>Администрация </a>",
"34" =>"Атлянка <a style='color: red'>КПП </a>",
"35" =>"Атлянка <a style='color: red'>Склад </a>",
"36" =>"Атлянка <a style='color: red'>Хозблок </a>",
"37" =>"Атлянка <a style='color: red'>Барак №3 </a>",
"38" =>"Атлянка <a style='color: red'>Барак №4 </a>",
"39" =>"Атлянка <a style='color: red'>Барак №5 </a>",
"40" =>"Атлянка <a style='color: red'>Барак №6 </a>",
"41" =>"Атлянка <a style='color: red'>Барак №7 </a>",
"42" =>"Атлянка <a style='color: red'>Барак №8 </a>",
"43" =>"Атлянка <a style='color: red'>Столовая </a>",
"44" =>"Атлянка <a style='color: red'>Госпиталь </a>",
"45" =>"Атлянка <a style='color: red'>АХЧ </a>",
"46" =>"Атлянка <a style='color: red'>Котельная </a>",
"47" =>"Атлянка <a style='color: red'>Корпус охраны </a>",
"48" =>"Атлянка <a style='color: red'>Управление </a>",
"49" =>"Белый медведь <a style='color: red'>КПП </a>",
"50" =>"Белый медведь <a style='color: red'>Корпус охраны </a>",
"51" =>"Белый медведь <a style='color: red'>Пищеблок </a>",
"52" =>"Белый медведь <a style='color: red'>Лазарет </a>",
"53" =>"Белый медведь <a style='color: red'>Карцер </a>",
"54" =>"Белый медведь <a style='color: red'>Барак №8 </a>",
"55" =>"Белый медведь <a style='color: red'>Барак №6 </a>",
"56" =>"Белый медведь <a style='color: red'>Барак №9 </a>",
"57" =>"Белый медведь <a style='color: red'>Слесарный цех </a>",
"58" =>"Белый медведь <a style='color: red'>АХЧ </a>",
"59" =>"Белый медведь <a style='color: red'>Барак №4 </a>",
"60" =>"Белый медведь <a style='color: red'>Барак №5 </a>",
"61" =>"Белый медведь <a style='color: red'>Барак №7 </a>",
"62" =>"Белый медведь <a style='color: red'>Хозблок </a>",
"63" =>"Белый медведь <a style='color: red'>Церковь </a>",
"64" =>"Белый медведь <a style='color: red'>Столярка </a>",
"65" =>"Белый медведь <a style='color: red'>Западный блок </a>",
"66" =>"Белый медведь <a style='color: red'>Восточный блок </a>",
"67" =>"Белый медведь <a style='color: red'>Администрация лагеря </a>",
"68" =>"Полярная сова <a style='color: red'>Проходная </a>",
"69" =>"Полярная сова <a style='color: red'>Хозблок </a>",
"70" =>"Полярная сова <a style='color: red'>Склад </a>",
"71" =>"Полярная сова <a style='color: red'>Гардероб </a>",
"72" =>"Полярная сова <a style='color: red'>Западный барак </a>",
"73" =>"Полярная сова <a style='color: red'>Барак № 2 </a>",
"74" =>"Полярная сова <a style='color: red'>Заброшенный барак </a>",
"75" =>"Полярная сова <a style='color: red'>Барак у дороги </a>",
"76" =>"Полярная сова <a style='color: red'>Барак № 5 </a>",
"77" =>"Полярная сова <a style='color: red'>Барак № 6 </a>",
"78" =>"Полярная сова <a style='color: red'>Центровой барак </a>",
"79" =>"Полярная сова <a style='color: red'>Барак УДОшников </a>",
"80" =>"Полярная сова <a style='color: red'>Баня </a>",
"81" =>"Полярная сова <a style='color: red'>Актовый зал </a>",
"82" =>"Полярная сова <a style='color: red'>Столярка </a>",
"83" =>"Полярная сова <a style='color: red'>Слесарка </a>",
"84" =>"Полярная сова <a style='color: red'>Пищеблок </a>",
"85" =>"Полярная сова <a style='color: red'>Цеха </a>",
"86" =>"Полярная сова <a style='color: red'>Медсанчасть </a>",
"87" =>"Полярная сова <a style='color: red'>Западная вышка </a>",
"88" =>"Полярная сова <a style='color: red'>Восточная вышка </a>",
"89" =>"Полярная сова <a style='color: red'>Управление лагеря </a>",
"90" =>"Чёрный беркут <a style='color: red'>Охрана </a>",
"91" =>"Чёрный беркут <a style='color: red'>Раздевалка </a>",
"92" =>"Чёрный беркут <a style='color: red'>Канцелярия </a>",
"93" =>"Чёрный беркут <a style='color: red'>Щитовая </a>",
"94" =>"Чёрный беркут <a style='color: red'>Барак №1 </a>",
"95" =>"Чёрный беркут <a style='color: red'>Барак №2 </a>",
"96" =>"Чёрный беркут <a style='color: red'>Барак №3 </a>",
"97" =>"Чёрный беркут <a style='color: red'>Барак №4 </a>",
"98" =>"Чёрный беркут <a style='color: red'>Складское помещение </a>",
"99" =>"Чёрный беркут <a style='color: red'>Карцер </a>",
"100" =>"Чёрный беркут <a style='color: red'>Котельная </a>",
"101" =>"Чёрный беркут <a style='color: red'>Брак УДОшников </a>",
"102" =>"Чёрный беркут <a style='color: red'>Морг </a>",
"103" =>"Чёрный беркут <a style='color: red'>Баня </a>",
"104" =>"Чёрный беркут <a style='color: red'>Актовый зал </a>",
"105" =>"Чёрный беркут <a style='color: red'>Столярка </a>",
"106" =>"Чёрный беркут <a style='color: red'>Музей </a>",
"107" =>"Чёрный беркут <a style='color: red'>Склад столярки </a>",
"108" =>"Чёрный беркут <a style='color: red'>Пищеблок </a>",
"109" =>"Чёрный беркут <a style='color: red'>Лазарет </a>",
"110" =>"Чёрный беркут <a style='color: red'>Северный пищеблок </a>",
"111" =>"Чёрный беркут <a style='color: red'>Медсанчасть </a>",
"112" =>"Чёрный беркут <a style='color: red'>Наблюдательный пункт </a>",
"113" =>"Чёрный беркут <a style='color: red'>Блок охраны </a>",
"114" =>"Чёрный беркут <a style='color: red'>Корпус администрации </a>",
"115" =>"Тулун <a style='color: red'>КПП </a>",
"116" =>"Тулун <a style='color: red'>Наблюдательный пункт </a>",
"117" =>"Тулун <a style='color: red'>Блок охраны </a>",
"118" =>"Тулун <a style='color: red'>Цеха </a>",
"119" =>"Тулун <a style='color: red'>Центровой барак </a>",
"120" =>"Тулун <a style='color: red'>Склад </a>",
"121" =>"Тулун <a style='color: red'>Котельная </a>",
"122" =>"Тулун <a style='color: red'>Барак №1 </a>",
"123" =>"Тулун <a style='color: red'>Барак №2 </a>",
"124" =>"Тулун <a style='color: red'>Арсенал </a>",
"125" =>"Тулун <a style='color: red'>Западная вышка </a>",
"126" =>"Тулун <a style='color: red'>Восточная вышка </a>",
"127" =>"Тулун <a style='color: red'>Столовка </a>",
"128" =>"Тулун <a style='color: red'>Барак №3 </a>",
"129" =>"Тулун <a style='color: red'>Столярка </a>",
"130" =>"Тулун <a style='color: red'>Барак №4 </a>",
"131" =>"Тулун <a style='color: red'>Северная вышка </a>",
"132" =>"Тулун <a style='color: red'>Барак УДОшников </a>",
"133" =>"Тулун <a style='color: red'>Актовый зал </a>",
"134" =>"Тулун <a style='color: red'>Баня </a>",
"135" =>"Тулун <a style='color: red'>Корпус администрации </a>",
"136" =>"Володарка <a style='color: red'>Блок охраны </a>",
"137" =>"Володарка <a style='color: red'>Канцелярия </a>",
"138" =>"Володарка <a style='color: red'>Столярка </a>",
"139" =>"Володарка <a style='color: red'>Складское помещение </a>",
"140" =>"Володарка <a style='color: red'>Медсанчасть </a>",
"141" =>"Володарка <a style='color: red'>Западный барак </a>",
"142" =>"Володарка <a style='color: red'>Барак УДОшников </a>",
"143" =>"Володарка <a style='color: red'>Корпус конвоя </a>",
"144" =>"Володарка <a style='color: red'>Барак №4 </a>",
"145" =>"Володарка <a style='color: red'>Столовка </a>",
"146" =>"Володарка <a style='color: red'>Наблюдательный пункт </a>",
"147" =>"Володарка <a style='color: red'>Барак №1 </a>",
"148" =>"Володарка <a style='color: red'>Заброшенный барак </a>",
"149" =>"Володарка <a style='color: red'>Северная вышка </a>",
"150" =>"Володарка <a style='color: red'>Центровой барак </a>",
"151" =>"Володарка <a style='color: red'>Пищеблок </a>",
"152" =>"Володарка <a style='color: red'>Актовый зал </a>",
"153" =>"Володарка <a style='color: red'>Цеха </a>",
"154" =>"Володарка <a style='color: red'>Арсенал </a>",
"155" =>"Льговка <a style='color: red'>КПП </a>",
"156" =>"Льговка <a style='color: red'>Барак охраны </a>",
"157" =>"Льговка <a style='color: red'>Столовка охраны </a>",
"158" =>"Льговка <a style='color: red'>Дом свиданий </a>",
"159" =>"Льговка <a style='color: red'>Склад инструментов </a>",
"160" =>"Льговка <a style='color: red'>Мастерская </a>",
"161" =>"Льговка <a style='color: red'>Дом отдыха </a>",
"162" =>"Льговка <a style='color: red'>Барак №3 </a>",
"163" =>"Льговка <a style='color: red'>Барак №2 </a>",
"164" =>"Льговка <a style='color: red'>Барак №1 </a>",
"165" =>"Льговка <a style='color: red'>Баня </a>",
"166" =>"Льговка <a style='color: red'>Прачка </a>",
"167" =>"Льговка <a style='color: red'>Пищеблок </a>",
"168" =>"Льговка <a style='color: red'>Охранный корпус </a>",
"169" =>"Льговка <a style='color: red'>Вышка </a>",
"170" =>"Льговка <a style='color: red'>КПП №2 </a>",
"171" =>"Льговка <a style='color: red'>Лазарет </a>",
"172" =>"Льговка <a style='color: red'>Арсенал </a>",
"173" =>"Льговка <a style='color: red'>Столярка </a>",
"174" =>"Льговка <a style='color: red'>Каптерка </a>",
"175" =>"Льговка <a style='color: red'>Вышка №2 </a>",
"176" =>"Льговка <a style='color: red'>Корпус администрации </a>",
"177" =>"АВ 262/5 <a style='color: red'>КПП </a>",
"178" =>"АВ 262/5 <a style='color: red'>Пункт досмотра </a>",
"179" =>"АВ 262/5 <a style='color: red'>Наблюдательная вышка </a>",
"180" =>"АВ 262/5 <a style='color: red'>Склад </a>",
"181" =>"АВ 262/5 <a style='color: red'>Склад №2 </a>",
"182" =>"АВ 262/5 <a style='color: red'>Мастерская </a>",
"183" =>"АВ 262/5 <a style='color: red'>Дом свиданий </a>",
"184" =>"АВ 262/5 <a style='color: red'>Цех </a>",
"185" =>"АВ 262/5 <a style='color: red'>Дом охраны </a>",
"186" =>"АВ 262/5 <a style='color: red'>Медпункт </a>",
"187" =>"АВ 262/5 <a style='color: red'>КПП №2 </a>",
"188" =>"АВ 262/5 <a style='color: red'>Продовольственный склад </a>",
"189" =>"АВ 262/5 <a style='color: red'>Барак №1 </a>",
"190" =>"АВ 262/5 <a style='color: red'>Охранный корпус </a>",
"191" =>"АВ 262/5 <a style='color: red'>Барак N2 </a>",
"192" =>"АВ 262/5 <a style='color: red'>Барак №3 </a>",
"193" =>"АВ 262/5 <a style='color: red'>Барак №4 </a>",
"194" =>"АВ 262/5 <a style='color: red'>Столовая </a>",
"195" =>"АВ 262/5 <a style='color: red'>Кухня </a>",
"196" =>"АВ 262/5 <a style='color: red'>Баня </a>",
"197" =>"АВ 262/5 <a style='color: red'>Оружейный Склад </a>",
"198" =>"АВ 262/5 <a style='color: red'>Корпус администрации </a>",
"199" =>"Мордовка <a style='color: red'>КПП </a>",
"200" =>"Мордовка <a style='color: red'>Вышка №1 </a>",
"201" =>"Мордовка <a style='color: red'>Вышка №2 </a>",
"202" =>"Мордовка <a style='color: red'>Барак заключенных </a>",
"203" =>"Мордовка <a style='color: red'>Комната пересмены </a>",
"204" =>"Мордовка <a style='color: red'>Барак охраны </a>",
"205" =>"Мордовка <a style='color: red'>Вышка №3 </a>",
"206" =>"Мордовка <a style='color: red'>Склад №1 </a>",
"207" =>"Мордовка <a style='color: red'>Склад №2 </a>",
"208" =>"Мордовка <a style='color: red'>Столовая </a>",
"209" =>"Мордовка <a style='color: red'>Баня </a>",
"210" =>"Мордовка <a style='color: red'>Цех </a>",
"211" =>"Мордовка <a style='color: red'>Столярная мастерская </a>",
"212" =>"Мордовка <a style='color: red'>Вышка №4 </a>",
"213" =>"Мордовка <a style='color: red'>Продовольственный склад </a>",
"214" =>"Мордовка <a style='color: red'>КПП №2 </a>",
"215" =>"Мордовка <a style='color: red'>Кухня </a>",
"216" =>"Мордовка <a style='color: red'>Склад оружия </a>",
"217" =>"Мордовка <a style='color: red'>Вышка №5 </a>",
"218" =>"Мордовка <a style='color: red'>Допросная </a>",
"219" =>"Мордовка <a style='color: red'>Здание администрации </a>");
