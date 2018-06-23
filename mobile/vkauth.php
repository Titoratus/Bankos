<?
include_once("function.php");
include_once("../bd2.php");

$code = $_GET["code"];
$site = "index.php";

$get = file_get_contents_curl('https://oauth.vk.com/token?client_id=5813613&client_secret=4nWMU8DJNWxkBAYfnkuP&code='.$code.'&redirect_uri=http://'.$_SERVER['SERVER_NAME'].'/mobile/vkauth.php');
$arr = json_decode($get,true);
$id_vk = $arr["user_id"]; // id user
$token = $arr["access_token"]; // token
$err = $arr['error_description'];

if($err == 'Code is invalid or expired.'){
	header('Location: '.$site);
}
if($id_vk != null){
	$query = mysql_query("SELECT `id`, `auth` FROM `mobile` WHERE id=$id_vk");
	$result = mysql_fetch_array($query);
	$auth_key = $result['auth'];

	if($auth_key == null){
		setcookie("code", 'Сначала нужно войти через ID:Auth');
		header('Location: '.$site);
	}
	else{
		$url = file_get_contents_curl('http://109.234.155.196/prison/universal.php?user='.$id_vk.'&key='.$auth_key);
		preg_match_all("#<result>(.*?)</result>#",$url,$matches);
		$ratin = $matches[1]; //авторитет
		
		if($ratin != '0'){
			setcookie("id", $result['id']);
			setcookie("auth", $result['auth']);
			setcookie("token", $token);
			setcookie("code", 'Успешно вошли :)');
			header('Location: '.$site);
		}
	}
}

?>