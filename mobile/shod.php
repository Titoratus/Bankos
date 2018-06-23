<!DOCTYPE html>
<?
include_once("function.php");
if(!$_COOKIE['id']){header('Location: /mobile/');}else{
$id = $_COOKIE['id']; //ид пользователя
$auth = $_COOKIE['auth']; //аут пользователя
$shodget = file_get_contents("shod.json");
$shodget = json_decode($shodget, true);

/**
 * @param $idh
 * @param $shodget
 * @return mixed
 */
function nameshod($idh, $shodget){
	foreach($shodget['events'][0]['tasks'] as $row){
		if($row['id'] == $idh){
			return $row['description'];
			break;
		}
	}
}
function proc($a1,$a2){
    $a3 = intval(($a1/$a2)*100);
    return $a3;
}
$get = file_get_contents_curl("http://109.234.155.198/prison/universal.php?key=$auth&method=guildEvent.getUpdate&user=$id");
$json = json_decode($get,true);

?>

<html>
    <head>
        <script src="https://code.jquery.com/jquery-2.1.4.min.js"></script>
		<link rel="stylesheet" href="css/style.css" media="screen" type="text/css" />
        <link rel="stylesheet" href="css/menu.css">
    </head>
    <body>
	<div style="text-align: center;">
		<?include "../head_menu.php";?>
	</div>
<script>
function del(){
 $("div.error").remove();
}
setTimeout(del, 3000);
</script>
<?
if($echo){foreach($echo as $err){
	echo "<div style=\"text-align: center;\"><div id='err' class='error'>";
	echo $err;
	echo "</div></center>";}}
?>
<div style="margin: auto; width: 400px;">
<?
if($json['code'] == '2'){
	echo '<div style="background: #ffefc0;border: 1px solid #c43c35;margin: 5px;"><center><b>Вы не в бригаде</b></center>';
}elseif($json['code'] == '0'){?>
	<div style="background: #ffefc0;border: 1px solid #c43c35;margin-bottom: 5px;">
		<div>
		<?echo "<div style=\"text-align: center;\"><b>Ваши задания:</b></div>";
		foreach($json['info']['playerEventsInfo'][0]['acceptedTasks'] as $row){
			echo '<hr>';
			if($row['progress'] < $row['target']){echo '<img src="img/no.png"> '.proc($row['progress'],$row['target']).'% | ';}
			if($row['target'] <= $row['progress']){echo '<img src="img/yes.png"> 100% | ';}
			echo nameshod($row['taskId'],$shodget);
		}	
		?>
		</div>
	<div style="text-align: center;"><a href="team.php" class="color green button" style="margin-bottom: 5px;">Назад</a></div>
	
	</div>
<?}else{echo $json['code'];}
if($get == ""){echo '<div style="background: #ffefc0;border: 1px solid #c43c35;margin: 5px; text-align: center;"><b>Сервер не отвечает</b>';}
?>
</div>
<div style="text-align: center;"><div style="margin: inherit;">
<?include_once ("include/button.php");?>
</div></div></body>
</html>
<?}?>