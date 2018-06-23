<?
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
function match($html, $teg)
{
	preg_match_all("/<$teg>(.*?)<\/$teg/i", $html, $matches);
	return $matches[1][0];
}
function obshak($html,$id_user,$key_user)
{
$idduk = array('0','1','Пацанский','Блатной','Авторитетный','<b>Воровской</b>');
$damagduk = array('0','1','30000000','50000000','75000000','100000000');
	$time = time();
	$arr_buff = array(63, 64, 65, 66);
	$arr_buff2 = array(63 => "2", 64 => "3", 65 => "4", 66 => "5");
	$pars = pars($html, "<playerBuffs>", "</playerBuffs>");
	$pars = "<data>$pars</data>";
	$xml = new SimpleXMLElement($pars);
	$count = count($xml->group);
	for ($a = 0; $a < $count; $a++) {
		$buff_id = intval($xml->group[$a]->attributes()->buff_id);
		$val_ts = intval($xml->group[$a]);

		if (!in_array($buff_id, $arr_buff)) {
			continue;
		}

		if ($val_ts < $time) {
			continue;
		}

		$obshak = $arr_buff2[$buff_id];
		$pars = pars($html, "<regularRewards>", "</regularRewards>");
		preg_match_all("/<id>(.*?)<\/id/i", $pars, $arr_rid);
		preg_match_all("/<endTS>(.*?)<\/endTS/i", $pars, $arr_ts);

		for ($a2 = 0; $a2 < count($arr_rid[1]); $a2++) {
			if ($arr_rid[1][$a2] != $obshak) {
				continue;
			}

			$end = $arr_ts[1][$a2];
			break;
		}

		break;
	}
	if ("1" < $obshak) {
		$ts1 = floor(($val_ts - $time) / 86400);
		$id_obshak = $obshak;
		$end_obshak = $end;
		$ts_time = $val_ts;
		$pars = pars($html, "<dukeDamages>", "</dukeDamages>");
		$pars = pars($pars, "<id>" . $obshak . "</id>", "</damage>");
		$damage_ob = match($pars, "amount");
		$damages = $damagduk[$obshak] - $damage_ob;
		$day_obshak = $idduk[$obshak]." : Осталось дней: " . $ts1;
		echo "<div class=\"bri sma\"><center>";
		echo "#$id_user:$key_user | ".$day_obshak." : урона израсходованно ( $damage_ob \ $damagduk[$obshak])<br>";
		echo "</center></div>";
	}
	else {
		echo "<div class=\"bri sma\"><center>";
		echo "#$id_user - когда нибудь куплю";
		echo "</center></div>";
	}
}


if($_POST['duke']){
$f = $_POST['fake'];


foreach (explode("\n", $f) as $fake)
{list($id,$key) = explode(':',trim($fake));
    $url = file_get_contents('http://109.234.155.196/prison/universal.php?user='.$id.'&key='.$key.'&method=getInfo'); 
    preg_match_all('/<result>(.*?)<\/result>/',$url,$matches);
    $result = $matches[1][0]; //result
    if($result != '0' or $url != null){
		obshak($url,$id,$key);
	}else{
		echo "<div class=\"bri sma\">";
		echo "$id:$key - Ошибка";
		echo "</div>";
	}

}
}
?>
<html>
<head>
<style><!--Стили-->
input[type="submit"]{height: 30;}
button{height: 30;}
.sma  {/*margin-bottom:-15px;*/padding: 8px 5px;}
.ok   {background: #F0E4E4;border: 1px solid #D6CBCB;}
.nav1  {background: #C0F7FF;border: 1px solid #3C6BFF;}
.check{background: #e4f0e8;border: 1px solid #D6CBCB;}
.smen {background: #D7F3EB;border: 1px solid #cbd6cf;}
.sbor {background: #F0F0E4;border: 1px solid #cbd6cf;}
.bri  {background: #CEC6BA;border: 1px solid #D4BCBC;}
#cont {padding: 30px;background: #ffffff;}
</style>
</head>
<body style="background-color: #DDDCEE;">
<meta http-equiv="content-type" content="charset=utf-8">

<center>
<span style="font-family:comic sans ms,cursive;color: #FF0A0A;cursor: context-menu;">Проверить общак</span>
<div class="bri sma">  

<form method=POST>
<textarea name="fake" maxlength="950" rows="10" style="resize:none;width:40%;"></textarea><br>   
<input type="submit" name="duke" value="Проверить на общак" style="width: 140;">
</form>

</div>
</center>
<div class="ok sma">
<a href="https://vk.com/rzn_fantik"><font color=red>[RZN]Fantik</font></a>
</div>
</body>
</html>