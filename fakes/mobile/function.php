<?
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

function frends($get){
    $xml = simplexml_load_string($get);
    $q1 = $xml->xpath('//data/latest_events/friends_rating');

    foreach($q1 as $q2){
        foreach($q2 as $q3){
            $qid = $q3->uid;
            $qdm = $q3->damage;
			
			$urlvk = file_get_contents_curl('http://api.vkontakte.ru/method/getProfiles?user_ids='.$qid.'&fields=photo_50&lang=ru');
            $arr1 = json_decode($urlvk,true);
			$name=$arr1['response']['0']['first_name']; // Имя в вконтакте
            $famil_vk=$arr1['response']['0']['last_name']; // Фамилия в вконтате
			$photo_vk=$arr1['response']['0']['photo_50']; // фотка 50 на 50 пкс
			
			//var_dump($arr1);
            echo "<img src='$photo_vk' style=\"width: 20;\"><a href=\"https://vk.com/id$qid\" target=\"_blank\">$name $famil_vk</a> - $qdm<br>";
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
        foreach($q2->level as $q3){
         $q1 += $q3["0"];
        }
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

?>