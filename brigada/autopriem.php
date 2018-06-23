<?
include("../bd2.php");
include("../mobile/function.php");
$id = "113386008";
$auth = "ca6f723bcee398ca0f35d106f5f13bd2";
$date = date("H:i:s");

$row = mysql_query("SELECT id, rank FROM brigada_priem");
while($r=mysql_fetch_array($row)){
	$akk[] = array("id" => $r["id"], "rank" => $r["rank"]);
}
//print_r($akk);


if(isset($akk)){
$get = file_get_contents_curl("http://109.234.156.251/prison/universal.php?user=$id&key=$auth&method=guild.getJoinRequests");
$json = json_decode($get, true);
$json_set = json_decode(file_get_contents("auto_settings.json"), true);
foreach($json["requests"] as $r){
$zap = json_encode($r);
	foreach($akk as $k){
		if($r["uid"] == $k["id"]){
			$get = file_get_contents_curl("http://109.234.156.251/prison/universal.php?user=$id&key=$auth&method=guild.acceptJoinRequest&request=$zap");
			$json = json_decode($get, true);
			
			if($json["code"] == '0'){//Принял
				$okakk[] = array("id"=>$k["id"]);
			}else{
				echo $json["code"]."<br>\n";
			}
		}
	}
	
	if($json_set["sets"] == 's1'){
		if($r["talents"] >= $json_set["tal"] AND $r["poison"] >= $json_set["yad"] AND $r["gun"] >= $json_set["sam"]){
		   //var_dump($zap);
		   //echo "<br>";
			$get = file_get_contents_curl("http://109.234.156.251/prison/universal.php?user=$id&key=$auth&method=guild.acceptJoinRequest&request=$zap");
			$json = json_decode($get, true);
			if($json["code"] == '0'){//Принял
				$oldtext2 = file_get_contents("log2.txt");
				$text2 = "<a style='color:#0012ff;'>[$date]</a> <a style='color:#a907bb;'>#".namevk($r["uid"])." принят</a> - <a style='color:#0064ff'>#{$r["poison"]} ЯД | #{$r["talents"]} Талантов</a>\n";
				file_put_contents("log2.txt", "$text2 $oldtext2");
				echo $text2."<br>";
			}else{
				echo $r["uid"]." - ".$json["code"]."<br>\n";
			}
		}
	}elseif($json_set["sets"] == 's2'){
		if($json_set["sets"] == 's2' OR $r["talents"] >= $json_set["tal"] OR $r["poison"] >= $json_set["yad"] OR $r["gun"] >= $json_set["sam"]){
		   var_dump($zap);
		   //echo "<br>";
			$get = file_get_contents_curl("http://109.234.156.251/prison/universal.php?user=$id&key=$auth&method=guild.acceptJoinRequest&request=$zap");
			$json = json_decode($get, true);
			if($json["code"] == '0'){//Принял
				$oldtext2 = file_get_contents("log2.txt");
				$text2 = "<a style='color:#0012ff;'>[$date]</a> <a style='color:#a907bb;'>#".namevk($r["uid"])." принят</a> - <a style='color:#0064ff'>#{$r["poison"]} ЯД | #{$r["talents"]} Талантов</a>\n";
				file_put_contents("log2.txt", "$text2 $oldtext2");
				echo $text2."<br>";
			}else{
				echo $r["uid"]." - ".$json["code"]."<br>\n";
			}
		}
	}
}

foreach($okakk as $w){
	foreach($akk as $k){
		if($w["id"] == $k["id"]){
			$lid = $k["id"];
			$lrank = $k["rank"];
			
			$get = file_get_contents_curl("http://109.234.156.251/prison/universal.php?user=$id&key=$auth&method=guild.promoteGuildMember&member=$lid&rank=$lrank");
			$json = json_decode($get, true);
			
			if($json["code"] == '0'){//Принял
				echo "ok #2";
				$oldtext = file_get_contents("log2.txt");
				$text = "<a style='color:#0012ff;'>[$date]</a> <a style='color:#a907bb;'>#".namevk($k["id"])." принят</a> - <a style='color:#0064ff'>сменил ранг на #{$k["rank"]}</a>\n";
				file_put_contents("log2.txt", "$text $oldtext");
			}
		}
	}
}

	
}else{
echo "No";
}
?>