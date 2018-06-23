<?
include_once("../mobile/function.php");

$code = $_GET["code"];
$site = "index.php";
$key2 = "rznfantikLOLcode";

$get = file_get_contents_curl('https://oauth.vk.com/token?client_id=5813613&client_secret=4nWMU8DJNWxkBAYfnkuP&code='.$code.'&redirect_uri=http://bankos.tk/brigada/vk.php');
$arr = json_decode($get,true);
$id_vk = $arr["user_id"]; // id user
$token = $arr["access_token"]; // token
$err = $arr['error_description'];

if($err == 'Code is invalid or expired.'){
	header('Location: '.$site);
}
if($id_vk != null){
	$vk = array("126226626","53522458","132942251","143249830","311836952","16378328");
	if(in_array($id_vk,$vk)){
		setcookie("key", encode($id_vk,$key2), time() + (60 * 60  * 24));
		$oldtext = file_get_contents("log2.txt");
		$date = date("H:i:s");
		$text = "<a style=\"background: lightblue;\">[$date] #id{$id_vk} - Произвел вход</a>\n";
		file_put_contents("log2.txt", "$text $oldtext");
	}
	header('Location: '.$site);
}
?>