<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="css/style.css" media="screen" type="text/css" />
	<script type="text/javascript" src="//vk.com/js/api/openapi.js?137"></script>
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>
</head>
<body>
		<?php include "head_menu.php";?>
		<?php
		if($_GET["id"] != null && $_GET["auth"] != null){
			
			if($_GET['rez'] == 'mail'){
				echo '<div id="game">
				<iframe style="width: 750px;height: 650px;"
				src="https://kefirprison-a.akamaihd.net/app_11_04_2018_1.html?is_app_user=1&session_key='.$_GET["session_key"].'&vid='.$_GET["id"].'&app_id=552078&authentication_key='.$_GET["auth"].'">
				</div>';
				/*echo '<div id="game">
				<embed 
				type="application/x-shockwave-flash" 
				width="730" 
				height="760" 
				preventhide="1" 
				quality="low" 
				flashvars="app_id=552078&authentication_key=aa73f30f5458c6994766a614303b11ee&is_app_user=1&session_key=bfb4047c93c2dc042d17bed71562cbaa&vid=3848121359834058353" 
				allowfullscreen="true" 
				allownetworking="all" 
				allowscriptaccess="never" 
				allowfullscreeninteractive="true" 
				wmode="opaque" 
				muted="muted"
				src="/other/game3_11_04_2018_mail.swf"; />
					
				</div>
			';*/
				
			}else{
			
			echo '<div id="game">
			<embed 
			type="application/x-shockwave-flash" 
			width="730" 
			height="760" 
			preventhide="1" 
			quality="low" 
			flashvars="api_id=1979194&amp;api_settings=2097159&amp;api_url=http%3A%2F%2Fapi.vk.com%2Fapi.php&amp;auth_key='.$_GET["auth"].'&amp;is_app_user=1&amp;secret=Prince&amp;user_id='.$_GET["id"].'&amp;viewer_id='.$_GET["id"].'" 
			allowfullscreen="true" 
			allownetworking="all" 
			allowscriptaccess="never" 
			allowfullscreeninteractive="true" 
			wmode="opaque" 
			muted="muted"
			src="/other/new_vk.swf"; />
		</div>';
			}
	}else{
		?>
		<div class="form_wrap">
			<form method="GET">
				<label id="t_id" for="id_app">ID</label>
				<input id="id_app" name="id" type="text" autocomplete="off">
				<label id="t_auth" for="auth">auth_key</label>
				<input id="auth" name="auth" type="text" autocomplete="off">
				<div id="div_session"><br>
					<label for="session_key">session_key</label>
					<input id="session_key" name="session_key" type="text" autocomplete="off">
				</div>
				<input style="margin-top: 16px" type="submit" value="Войти в приложение">
				<br>
				<br>
				<section class="networks">
					<input name="rez" class="radio" id="rez0" type="radio" value="vk" checked><label for="rez0">ВК</label>
					<input name="rez" class="radio" id="rez1" type="radio" value="mail"><label for="rez1">Mail</label>
				</section>
				
			</form>
		</div>
		
		<script>
$('#div_session').hide();

$('.radio').click(function(){
	if(this.value == 'mail'){
		$('#div_session').show();
		$('#t_auth').html('authentication_key');
		$('#t_id').html('oid');
	}else{
		$('#div_session').hide();
		$('#t_auth').html('auth_key');
		$('#t_id').html('ID');
	}
});
		</script>
		
		<?
	}
	?>
</body>
</html>