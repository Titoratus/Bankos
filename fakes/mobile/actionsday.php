<?
$idb = $_SESSION['id'];
$authb = $_SESSION['auth'];
$res = new SimpleXMLElement($get);

$tstime = $res->playerHolidayActions->actions->launch->viewTS;
$time = time();
$restime = intval($time - $tstime);
$rrr = intval(date("j", mktime(0, 0, $restime, 1, 1, 1970)));

function day($day, $rrr){
	$get = file_get_contents("prison.json");
	$json = json_decode($get, true);
	foreach($json["tasks"] as $k){
		if($k["day"] == $day){
			$s = $k["day"];
			if($rrr == $k["day"]){
				echo "<b><a style='color: blue;'>".$k["day"].". ".$k["name"]."</a></b>: ";
			}else{
				echo "<a>".$k["day"].". ".$k["name"]."</a>: ";
			}
		}
	}
}
foreach($res->playerHolidayActions->actions->launch->currentTasks->task as $sk){
	echo "<u>".day($sk->taskId,$rrr)." </u>";
		if(intval($sk->progress) >= intval($sk->target)){echo "<b><a style='color: green;'>Выполнено</a></b>";}else{echo "<b><a style='color: red;'>Не выполнено</a></b>";}
	echo "<br />\n";
}
?>