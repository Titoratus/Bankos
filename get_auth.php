<?php
include "mobile/function.php";
if(!empty($_POST)){
	if(!empty($_POST['url'])){
		$key = md5('rzn_fantik');
		$url = $_POST['url'];
		
		if (strpos($url, "#access_token")) {
			$string = $url . "&";
			$token = pars($string, "access_token=", "&");
			$user_id = pars($string, "&user_id=", "&");
			
			$post = file_get_contents_curl("http://rzn-fantik.byethost10.com/test_auth.php?key=".$key."&user=".$user_id."&token=".$token."&i=1");
			print_r($post);
		}else{
			$err['code'] = 2;
		}
	}else{
		//не вели ссылку
		$err['code'] = 1;
	}
}
?><!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="css/style.css" media="screen" type="text/css" />
	<script type="text/javascript" src="//vk.com/js/api/openapi.js?137"></script>
</head>
<body>
<?php include "head_menu.php";?>

<div class="form_wrap">
	<form method="POST">
		<label for="id_app">URL:</label>
		<input id="id_app" name="url" type="text" autocomplete="off" placeholder="Вставте ссылку">
		<input style="margin-top: 16px" type="submit" value="Получить auth">
		<br><br>
		<label for="id_app">Получить ссылку</label>
		<img style="cursor:pointer" src="https://telonko.com/img/vk48.png" onclick="window.open('https://oauth.vk.com/authorize?client_id=4908638&amp;response_type=token&amp;display=popup', '', 'width=640, height=470');">
	</form>
</div>
</body>
</html>