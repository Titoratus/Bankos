<?error_reporting(1);
include("../bd2.php");
include("../mobile/function.php");

$row = mysql_query("SELECT id, auth, vkl FROM brigada WHERE vkl = 1");
$only = 0;
while($r=mysql_fetch_array($row)){
	$get = file_get_contents_curl("http://109.234.156.251/prison/universal.php?key={$r['auth']}$auth&user={$r['id']}&method=getBoss");
	$idboss = match("id",$get);
	$time = match("battle_time",$get);
	$mode = match("mode",$get);
	$type = match("type",$get);
	$h_full = match("h_full",$get);
	$h_now = match("h_now",$get);
	
	$sp = array(
		"id" => $idboss,
		"time" => $time,
		"mode" => $mode,
		"type" => $type,
		"h_full" => $h_full,
		"h_now" => $h_now
	);
	$ja=json_encode($sp);
	 mysql_query("UPDATE brigada SET json='$ja' WHERE id='".mysql_real_escape_string($r['id'])."'");
	
	if($idboss == null or $get == ''){
		$fake[] = array("id" => $r['id'],"auth" => $r['auth']);
	}else{
		echo "{$r['id']}#бой<br>\n";
		$only++;
	}
}
// && - и // || - или
if($fake != null){
	$info = file_get_contents_curl("http://109.234.156.251/prison/universal.php?method=guild.getDungeonsInfo&user={$fake[0]["id"]}&key={$fake[0]["auth"]}");
	$json = json_decode($info, true);
	$dungeon = $json['currentDungeon']['dungeon'];// id dungeon
	$node = $json['currentDungeon']['nodes']; //здания
	$t = 0;
	if("1" <= $dungeon){
		foreach($node as $s){
			//if($s['claimed'] != '1' && $s['winTS'] == '0'){
			if($s['claimed'] != '1' && $s['winTS'] == '0' && $s['frags']['task'] - ($s['frags']['negative'] + $s['frags']['positive']) != '0'){
				$get = file_get_contents_curl("http://109.234.156.252/prison/universal.php?key={$fake[$t]['auth']}&user={$fake[$t]['id']}&method=startBattle&boss_id={$s['id']}&type=node&choice=p");
				$result = match("code",$get);
				if($result == '2'){
					continue;
				}elseif($result == '4'){
					$t++;
				}
				
				$temp[] = array(
				"node_id"=>$s['id'],
				"fulln"=>$s['frags']['task'],
				"task"=>$s['frags']['task'] - ($s['frags']['negative'] + $s['frags']['positive'])
				);
			}
		}
	}
	if($temp != null){
		for($i=0;$i < $temp[0]['task'] - $only;$i++){
			if($fake[$i] != null){
				echo "{$fake[$i]['id']} - ".$guildnode[$temp[0]['node_id']]."(".$temp[0]['node_id'].") - ".$temp[0]['task']." раз из ".$temp[0]['fulln']." осталось снести<br>\n";
				echo "{$fake[$i]['id']} - нападаем на ".$guildnode[$temp[0]['node_id']]." ...<br>\n";
				$get = file_get_contents_curl("http://109.234.156.252/prison/universal.php?key={$fake[$i]['auth']}&user={$fake[$i]['id']}&method=startBattle&boss_id={$temp[0]['node_id']}&type=node&choice=p");
				$date = date("H:i:s");
				$oldtext = file_get_contents("log.txt");
				if(match("code",$get) == "0"){
					echo "<a style='color:green'>{$fake[$i]['id']} - Успешно напал ...</a><br>\n";
					$text = "[$date] #{$fake[$i]['id']} - Успешно напал на - {$guildnode[$temp[0]['node_id']]}\n";
					file_put_contents("log.txt", "$text $oldtext");
				}elseif(match("code",$get) == "4"){
					echo "<a style='color:red'>{$fake[$i]['id']} - Уже в бою ...</a><br>\n";
					$temp[0]['task'] += 1;
				}
			}
		}
	}else{
	echo "Нету причин нападать ^_^";
	}
}else{
	echo "Все фейки в бою ^_^";
}
?>