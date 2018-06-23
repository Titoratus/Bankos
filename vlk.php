<?php
include("mobile/function.php");
$arr = file_get_contents_curl("http://".$_SERVER['SERVER_NAME']."/vlk/vlk.php");
$json = json_decode($arr, true);

$info = file_get_contents_curl("https://cloud-api.yandex.net/v1/disk/public/resources?public_key=".$json['link2']);
$info_json = json_decode($info, true);
$size = round($info_json['size'] / 1024 / 1024);
$date = new DateTime($info_json['modified']);
$modified = $date->format('d-m-Y (H:i)');
?>

<html>
<head>
	<link rel="stylesheet" href="css/style.css" media="screen" type="text/css" />
	<script type="text/javascript" src="//vk.com/js/api/openapi.js?137"></script>
	<script type="text/javascript" src="https://vk.com/js/api/share.js?95" charset="windows-1251"></script>
</head>
<style>
body{
	position: inherit;
}
</style>
<body>
<?php include "head_menu.php";?>

<form style="width: 100%;">
	<center>
		<div id="vk_subscribe" style="padding-left: 25%;"></div><br>
		<a class="teg" data-title="Перекачивать каждую неделю не просит, при выходе обновления сами решаете обновлять или нет, программа уведомляет о новом кряке при ЗАПУСКЕ, ваш auth_key остается в сохранности так как он его никуда не отправляет кроме самой тюряги" style="color: #f00">Данная версия VLK бесплатна и не требует активации</a><br><br>
		<a style="color: #3500ff;">Кол-во пользователей: <?echo $json["count"];?> 
			<a class="teg" data-title="Кол-во пользователей с последней версией программы" style="color: #3500ff;">( <?=$json["new_count"];?> )</a>
		</a><br>
		<a style="color: #eeb24e;">Кол-во Mail пользователей: <?=$json['count_mail'];?></a><br>
		<a style="color: #9f00ff;">Последняя версия программы: <?=$json['version'];?></a><br>
		<a style="color: #f00;">Изменения последней версии:</a><br>
		
		<textarea style="width: 500px;height: 200px;" readonly><?=$json['desc'];?></textarea><br>
		<br>
		<p style="border: 2px solid red">Данный кряк единственный который постоянно поддерживается и обновляется</p><br>
		<a class="flat sm green teg2" data-title="Вес программы <?=$size;?>Мб &#xa;Кол-во просмотров: <?=$info_json['views_count'];?> &#xa; Файл изменен [<?=$modified;?>]" href="<?=$json['link2'];?>" target="_blank">Скачать</a>
		<br><br><hr><br>
		<div id="vk_like"></div>
		<script>
			document.write(VK.Share.button({title: 'Бесплатный VLK-Crack, с последними обновлениями',image: 'https://pp.userapi.com/c847121/v847121148/40feb/vEQgYD_8aj0.jpg',noparse: true}));
		</script>
	</center>
</form>


<script type="text/javascript">
  VK.init({apiId: 6463761, onlyWidgets: true});
  VK.Widgets.Subscribe("vk_subscribe", {soft: 1}, 132942251);
  VK.Widgets.Like("vk_like", {type: "vertical", height: 30});
</script>