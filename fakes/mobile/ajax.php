<?
session_start();
if($_SESSION['id']){
$id = $_SESSION['id'];
$auth = $_SESSION['auth'];

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

		$jresult = array(
			'code' => $result,
			'damage' => $damage,
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

?>