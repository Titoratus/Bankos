<?	
$id = "285924738";	
$key = "e15507de89d079cf51b79f91b42d5dcb";

$get = file_get_contents('http://109.234.155.196/prison/universal.php?method=events.getUpdate&user='.$id.'&key='.$key);

$json = json_decode($get, true); // Декодируем
$pop = array_pop($json['info']['events']); //входим в последний ключ масива events

$launchId = $pop['launchId']; //узнаем у последнего ключа launchId
if($pop['dng'] != null){
	foreach($pop['dng']['nodes'] as $t){
		if($t['health'] != 0){
			$id = $t['id']; // id нужного задания
			$health = $t['health']; // хп сколько осталось у задания
			$healthFull = $t['healthFull'];// полное хп у задания
			
			echo 'launchId:'.$launchId.'<br>';
			echo 'id:'.$id.'<br>';
			echo 'health:'.$health.'<br>';
			echo 'healthFull:'.$healthFull;
			break;
		}
	}
}else{
	echo "Не хочу, не буду работать, плохой аккаунт";
}
?>