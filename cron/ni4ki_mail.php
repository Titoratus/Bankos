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
include("../bd2.php");
$sql = "SELECT `id` FROM `auto` WHERE vkl = '0' AND social='mail' LIMIT 1";
$rand_user = mysql_fetch_array(mysql_query($sql))[0];

function rand_fake(){
	$fakes = file("fakes_mail.txt");
	$rand_fakes = array_rand($fakes);
	$fakes = $fakes[$rand_fakes];
	return $fakes;
}
if(!$rand_user){
	die("Нету id");
}
for($i = 0; $i < 20; $i++){
$ni1 = rand(1, 7);
$ni2 = rand(1, 81);
	list($id,$key) = explode(':',trim(rand_fake()));
	$qeury = file_get_contents_curl('http://109.234.157.91/prison/universal.php?method=collectionsSendGiftToFriend&friend='.$rand_user.'&id='.$ni1.'&cid='.$ni2.'&user='.$id.'&key='.$key);
	preg_match_all("/<code>(.*?)<\/code>/",$qeury,$matches);
	$result = $matches[1][0];// ряд,нычка,Успешно передана :)
	
	preg_match_all("/<result>(.*?)<\/result>/",$qo,$matches);
	$result2 = $matches[1][0];

	if($result =='3'){
		echo $rand_user.": Лимит\r\n";
		$qeury = mysql_query("UPDATE `auto` SET `vkl`=1 WHERE id='$rand_user'"); 
		mysql_close();
		break;
	}else{
		echo $rand_user.": $ni2 нычка - $ni1 - Успешно передана :)</br>";
	}
}
?>