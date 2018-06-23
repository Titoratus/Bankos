<?
include_once ("../bd2.php");
function clean($value) { //удаление из текста всякой дряни 
$value = trim($value); 
$value = stripslashes($value); 
$value = strip_tags($value); 
$value = htmlspecialchars($value); 

return $value; 
}
if(isset($_POST['button']))
{
	$id = clean($_POST['uid']);

	$result = mysql_query("SELECT id, version FROM `vlk` WHERE id='$id'"); 
	$myrow = mysql_fetch_array($result);

	if(!empty($myrow['id'])){
		echo 'Версия VLK Crack у '.$myrow['id'].' пользователя '.$myrow['version'];
	}else{//пользователя не существует
		echo 'Данного пользователя не существует';
	}
}
?>
<html>
	<head>
	</head>
	<body>
		<form method="POST">
			<input type="text" name="uid">
			<input type="submit" name="button" value="Узнать версию пользователя">
		</form>
	</body>
</html>