<?
include("../bd2.php");
include("../mobile/function.php");
// guild.getDungeonsInfo - информация о лагерях
// 1 - Тройка
// 2 - Копейка
// 3 - Красная однёрка
// 6 - Полярная сова
// 7 - Чёрный беркут

$row = mysql_query("SELECT id, auth, vkl FROM brigada WHERE vkl = 1");
while($r=mysql_fetch_array($row)){ 	
	$id = $r['id'];
	$auth = $r['auth'];
	
	$get = file_get_contents_curl("http://109.234.156.251/prison/universal.php?key=$auth&user=$id&method=getBoss");
	preg_match("#<id>(.*?)<\/id>#",$get,$match);
	$idboss = $match[1]; //id босса
	
	if($idboss == null){
			$info = file_get_contents_curl("http://109.234.156.251/prison/universal.php?method=guild.getDungeonsInfo&user=$id&key=$auth");
			$json = json_decode($info, true);
			$dungeon = $json['currentDungeon']['dungeon'];// id dungeon
			$node = $json['currentDungeon']['nodes']; //здания
			
		foreach($node as $s){
			$node_id = $s['id']; //id здания
			$claimed = $s['claimed']; //завершено ли 
			$winTS = $s['winTS']; //время завершения
			$fulln = $s['frags']['task']; //сколько нужно нападений
			$negativ = $s['frags']['negative']; //какой то негатив
			$positiv = $s['frags']['positive']; //какой то позитив
			$task = $fulln - ($s['frags']['negative'] + $s['frags']['positive']); //сколько осталось
			$hp = $s['wasted']; //хп у актива
			
			
			// if($node_id){
				// if($hp != null){
					if($claimed != '1'){
						if($winTS == '0'){
							echo $id." - ".$guildnode[$node_id]."(".$node_id.") - ".$task." раз из ".$fulln." осталось снести<br>\n";
							echo $id." - нападаем на ".$guildnode[$node_id]." ...<br>\n";
							$get = file_get_contents_curl("http://109.234.156.252/prison/universal.php?key=$auth&user=$id&method=startBattle&boss_id=$node_id&type=node&choice=p");
							preg_match("#<code>(.*?)</code>#",$get,$match);
							if($match[1][0] == "0"){
								echo "<a style='color:green'>".$id." - Успешно напал ...</a><br>\n";
								$task--;
								break;
							}elseif($match[1] == "4"){
								echo "<a style='color:red'>".$id." - Уже в бою ...</a><br>\n";
								break;
							}
						}else{echo $id."#Не может напасть, потому что время выигрыша уже есть<br>\n";}
					// }
				// }
			}else{echo $id."#Не может напасть, потому что здание забрано<br>\n";}
		}
	}else{echo $id."#В бою<br>\n";}
}
?>