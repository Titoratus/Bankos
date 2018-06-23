<?
include("../mobile/function.php");

$jn = get_file("img/guilds");
echo '<select name="zone">';
echo "\n";
foreach($jn["travianInfo"]["zones"] as $val){
	if($val["reqs"][0]["type"] == "comingSoon"){continue;}
	$zone[] = array(
	"id"=>$val["id"],
	"name"=>$val["name"]
	);
	echo '<option value="'.$val["id"].'">'.$val["name"].'</option>'."\n";
}
echo '</select>';
echo "\n";
echo "\n";

echo '<select name="nodes">';
echo "\n";
foreach($jn["travianInfo"]["nodes"] as $val2){
	$node[] = array(
	"id"=>$val2["id"],
	"name"=>$val2["name"],
	"zoneId"=>$val2["zoneId"]
	);
	echo '<option zoneId="'.$val2["zoneId"].'" value="'.$val2["id"].'">'.$val2["name"].'</option>'."\n";
}
echo '</select>';
//echo"<br>";
//echo json_encode($jn["travianInfo"]["zones"]);
