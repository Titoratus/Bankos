<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="css/style.css" media="screen" type="text/css">
	<script type="text/javascript" src="//vk.com/js/api/openapi.js?137"></script>
</head>
<style>
#page_wrap{
	width: 560px;
}
#vk_comments iframe {
    width: 550px;
}
#vk_comments {
    position: unset;
    left: 50%;
    margin-left: -15px;
    width: 100%!important;
}
#vkwidget1_tt{
	position: absolute;
    padding: 0px;
    display: none;
    opacity: 1;
    border: 0px;
    width: 274px;
    height: 130px;
    z-index: 5000;
    overflow: hidden;
    top: 707px;
    left: 250px;
    filter: none;
}
</style>
<body>
	<?include "head_menu.php";?>
	<form style="width: 100%;">
	<center>
	<table>
		<tr>
			<th>VK</th>
			<th>TELONKO</th>
		</tr>
		<tr>
			<td>
				<a href='https://vk.com/id137372667' target="_blank">Виталий Семёнов</a>
			</td>
			<td>
				<a href='https://telonko.com/sheol' target="_blank">-SHEOL-</a>
			</td>
		</tr>
		<tr>
			<td>
				<a href='https://vk.com/rzn_fantik' target="_blank">Александр Лабудов</a>
			</td>
			<td>
				<a href='https://telonko.com/id132942251' target="_blank">[RZN]Fantik</a>
			</td>
		</tr>
	</table>
	</center>
	</form>
	
	<form style="width: 100%;">
		<center><div id="vk_comments"></div></center>
	</form>
</body>
<script type="text/javascript">
  VK.init({apiId: 6463761, onlyWidgets: true});
  VK.Widgets.Comments("vk_comments", {limit: 5, width: "200px", attach: false});
</script>
</html>