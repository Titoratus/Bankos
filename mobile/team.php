<!DOCTYPE html>
<?include_once("function.php");
if(!$_COOKIE['id']){header('Location: /mobile/');}else{
$id = $_COOKIE['id']; //ид пользователя
$auth = $_COOKIE['auth']; //аут пользователя
$gLvlExp=array(0,1150,3200,6650,11800,19E3,28450,40500,55350,73350,94600,119650,167800,223600,287800,414800,754400,1146E3,1595E3,2283E3,3063E3,4699E3,655E4,8638E3,10977E3,12862E3,14949E3,16131E3,17421800,18826E3,2035E4,22E6,23785E3,25706E3,27777E3,3E7,3235E4,349E5,376E5,405E5,435E5,466E5,5E7,535E5,572E5,61E6,652E5,697E5,743E5,795E5,851E5,91E6,974E5,104E6,112E6,11984E4,1282E5,1372E5,1468E5,157E6,168E6,180E6,192E6,206E6,22E7,235E6,252E6,27E7,288E6,308E6,1E12); // опыта до следующего уровня в бригадах
function guildLevel($a,$b){
	for($i=0;$i<count($b);$i++)if($b[$i]>$a)return $i;return 35;
}
function count_members($a){
	foreach($a['guild']['members'] as $row){
		$i++;
	}
return $i;
}


function rank($z){
	foreach($z['guild']['members'] as $row){
		if($row['uid'] == $_COOKIE['id']){
			foreach($z['guild']['ranks'] as $r){
				if($r['id'] == $row['rank']){
					return $r['name'].' #'.$r['id']; break;
				}
			}break;
		}
	}
}

$get = file_get_contents_curl("http://109.234.155.198/prison/universal.php?key=$auth&method=guild.getUpdate&user=$id");
$json = json_decode($get,true);

$guild_exp = $json['guild']['exp'];
$gLv=guildLevel($guild_exp,$gLvlExp);
$gExpDiff=$guild_exp-$gLvlExp[$gLv-1];
$gPercent=floor($gExpDiff*100 / ($gLvlExp[$gLv]-$gLvlExp[$gLv-1]));
?>

<html>
    <head>
        <script src="https://code.jquery.com/jquery-2.1.4.min.js"></script>
		<link rel="stylesheet" href="css/style.css" media="screen" type="text/css" />
        <link rel="stylesheet" href="css/menu.css">
    </head>
    <body>
	<center>
		<?include "../head_menu.php";?>
	</center>
<script>
function del(){
 $("div.error").remove();
}
setTimeout(del, 3000);
</script>
<?
if($echo){foreach($echo as $err){
	echo "<center><div id='err' class='error'>";
	echo $err;
	echo "</div></center>";}}
?>
<div style="margin: auto; width: 400px;">
<?
if($json['code'] == '2'){
	echo '<div style="background: #ffefc0;border: 1px solid #c43c35;margin: 5px;"><center><b>Вы не в бригаде</b></center>';
}elseif($json['code'] == '0'){?>
	<div style="background: #ffefc0;border: 1px solid #c43c35;margin-bottom: 5px;">
		<center>
			<div class="am_tt">
				<div class="am_percA" style="width:200px;">
					<div class="am_perc_text" style="width:200px;"><?=$gLv?> уровень (<?=$gPercent;?>%)</div>
					<div class="am_percB fl_l" style="width: <?echo $gPercent*2;?>px;"></div>
				</div>
			</div>
		</center>

	<center><b><?echo $json['guild']['name']?></b></center>
	<center>Численность бригады:<b><?echo count_members($json);?></b></center>
	<center>Ранг:<b><?echo rank($json);?></b></center>
	</div>
	
	<div style="background: #C0F7FF;border: 1px solid #3C6BFF;margin-bottom: 5px;">
	<center>Сообщение дня:</center>
	<?echo $json['guild']['dailyMessage']['text']?>
	</div>
	<center><a href="shod.php" class="color green button" style="margin-bottom: 5px;">Сходняк</a></center>
	<div style="background: #C0F7FF;border: 1px solid #3C6BFF;">
	<center>Текущая польза: <?echo floor(($json['guild']['my']['activity']*100)/3400).'%';?></center>
	 <??>
	</div>
<?}else{echo $json['code'];}
if($get == ""){
	echo '<div style="background: #ffefc0;border: 1px solid #c43c35;margin: 5px;"><center><b>Сервер не отвечает</b></center>';
}
?>
</div>
<center><div style="margin: inherit;">
<?include_once ("include/button.php");?>
</div></center></body>
</html>


<?}?>