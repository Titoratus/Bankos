<?
include("../mobile/function.php");
$token = "38cf48f56fe193b8e1df30026cba3153e0fc78a4a173fe717ae06f2e5c246163405e9a29044550fe85f60";
$text = "";
$fakeIDvk = "358788820";
$fakeAuthvk = "09f528c2fb194224e00f1ca09d59e0b2";
//
$get = file_get_contents_curl("https://api.vk.com/method/friends.getSuggestions?access_token=$token&filter=mutual&count=50&v=5.65");
$json = json_decode($get, true);

for($i=0;$i < 10;$i++){
	$id = $json["response"]["items"][$i]["id"];
	$get = file_get_contents("http://109.234.156.251/prison/universal.php?user=$fakeIDvk&key=$fakeAuthvk&method=getFriendModels&friend_uid=$id"); 
	$tala = talant($get);
	if($tala > 810){
		//echo $tala."<br>\n";
		$get2 = file_get_contents_curl("https://api.vk.com/method/friends.add?access_token=$token&user_id=$id&text=$text");
		$json2 = json_decode($get2, true);

		if($json2["response"] == 1){
			echo $tala." - OK<br>\n";
		}else{
			echo "Error add friend<br>\n";
		}
		$i = 15;
	}
}




$get = file_get_contents_curl("https://api.vk.com/method/friends.getRequests?access_token=$token&filter=mutual&count=50&v=5.65");
$json = json_decode($get, true);
//var_dump($json["response"]["count"]);
for($i=0;$i < $json["response"]["count"]; $i++){
	$id = $json["response"]["items"][$i];
	$get = file_get_contents_curl("http://109.234.156.251/prison/universal.php?user=$fakeIDvk&key=$fakeAuthvk&method=getFriendModels&friend_uid=$id");
	$resget = talant($get);
	if($resget > 779){
		//$get2 = file_get_contents_curl("https://api.vk.com/method/friends.add?access_token=$token&user_id=$id&v=5.65");
		$json2 = json_decode($get2, true);
		if($json2["response"] == 2){
			echo $id." - Заявка одобрена | $resget талантов<br>\n";
		}
	}elseif($resget < 778){
		//$get3 = file_get_contents_curl("https://api.vk.com/method/friends.delete?access_token=$token&user_id=$id&v=5.65");
		$json3 = json_decode($get3, true);
		if($json3["response"]["in_request_deleted"] == 1){
			echo $id." - Заявка отклонена | $resget талантов<br>\n";
		}
	}
}

?>