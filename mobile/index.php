<!DOCTYPE html>
<?
session_start();
include ("function.php");
$id = clean($_COOKIE['id']);
$auth = clean($_COOKIE['auth']);
$site = "index.php";

include_once ("../bd2.php");
/////////////////////
if($_POST["id"] && $_POST["auth"] && $_POST["ok"]){
$pid = clean($_POST["id"]);
$pauth = clean($_POST["auth"]);

	$query = "SELECT `id`, `auth` FROM `mobile` WHERE id=$pid";
	$query = mysql_query($query);
	$result = mysql_fetch_array($query);
	
	if($result){// Заходим через базу
		$id = $result["id"];
		
		$url = file_get_contents('http://109.234.155.196/prison/universal.php?user='.$id.'&key='.$pauth);
		preg_match("#<result>(.*?)</result>#",$url,$match); $res = $match[1];
		
		if($res != '0'){//если все ок, заходим
			setcookie("id", $id);
			setcookie("auth", $pauth);
			setcookie("code", 'Успешно вошли :)');
            header("Location: index.php");
		}else{//если нет, то заходим через пост
			$url = file_get_contents('http://109.234.155.196/prison/universal.php?user='.$pid.'&key='.$pauth);
			preg_match("#<result>(.*?)</result>#",$url,$match); $res = $match[1];
			
			if($res != '0'){//если все ок, обновляем данные
				$query = "UPDATE mobile SET auth='$pauth' WHERE id=$pid";
				$query = mysql_query($query);
				$result = mysql_fetch_array($query);
				setcookie("id", $pid);
				setcookie("auth", $pauth);
				setcookie("code", 'Успешно вошли :)');
				header("Location: index.php");
			}else{//Если хуева то ошибочка
				setcookie("code", 'Неверный ID ил Auth');
				header("Location: index.php");
			}
		}
	}else{//если нету в базе, то добавляем
		$url = file_get_contents('http://109.234.155.196/prison/universal.php?user='.$pid.'&key='.$pauth);
		preg_match("#<result>(.*?)</result>#",$url,$match); $res = $match[1];
		echo $res;
		if($res != '0'){//добавляем и входим
			$query = "INSERT INTO `mobile`(`id`, `auth`) VALUES ('$pid','$pauth')";
			$query = mysql_query($query);
			$result = mysql_fetch_array($query);
			setcookie("id", $pid);
			setcookie("auth", $pauth);
			setcookie("code", 'Успешно вошли :)');
            header("Location: index.php");
		}else{//Если хуева то ошибочка
			setcookie("code", 'Неверный ID или Auth');
            header("Location: index.php");
		}
	}
}
if($_POST["prib"]){
    $get = file_get_contents_curl("http://109.234.156.251/prison/universal.php?key=$auth&user=$id&method=getAllBuildingsRewards");
    preg_match("#<money>(.*?)<\/money>#",$get,$match); $resultm = $match[1]; //love до сбора
    preg_match("#<code>(.*?)<\/code>#",$get,$match); $result = $match[1]; //love до сбора
    if($resultm != 0){
    if($result == 0){
		setcookie("code", 'Прибыль успешно забрали');
		header("Location: index.php");}
    }else{
	setcookie("code", 'Нечего собирать');
	header("Location: index.php");
	}
}
if($_COOKIE['id']){
    if($_POST["exit"] || $_GET["exit"]){
        unset($_COOKIE['id']);
        unset($_COOKIE['auth']);
		setcookie('id', null);
		setcookie('auth', null);
		setcookie("code", 'Надеюсь вы еще к нам зайдете ;)');
		header('Location: '.$site);
    }
}
?>
<html>
    <head>
			<script src="https://code.jquery.com/jquery-2.1.4.min.js"></script>
			<link rel="stylesheet" href="css/menu.css" media="screen" type="text/css" />
			<link rel="stylesheet" href="css/style.css" media="screen" type="text/css" />
    </head>
    <body>
		<?php include "../head_menu.php";?>
		<?if(!$_COOKIE['id']){?>
		<div class="form_wrap">
			<form method=post>
			<center>
				<label for="id_vk">ID</label>
				<input id="id_vk" type="text" name="id" autocomplete="off" required><br>
				<label for="auth_vk">Auth</label>
				<input id="auth_vk" type="text" name="auth" autocomplete="off" required><br>
				<?
				if(isset($_COOKIE['code'])){
					echo "<b class='error'>".$_COOKIE['code']."</b>";
					setcookie('code', null);
				}	
				?>
				<input type="submit" name="ok" value="Войти"><br><br>
				<a href="https://oauth.vk.com/authorize?client_id=5813613&scope=offline,friends&redirect_uri=http://<?echo $_SERVER['SERVER_NAME'];?>/mobile/vkauth.php">
					<div class="flat_button wauth_auth _wauth_auth">Войти через ВКонтакте</div>
				</a></center>
			</form>
		</div>
			<?}else{
			$id = $_COOKIE['id'];
			$auth = $_COOKIE['auth'];
			$get = file_get_contents_curl("http://109.234.156.251/prison/universal.php?key=$auth&method=getInfo&user=$id");
			preg_match("#<name>(.*?)</name>#",$get,$match); $name = $match[1]; //Ник
			preg_match("#<money>(.*?)</money>#",$get,$match); $money = $match[1]; //Папиросы
			preg_match("#<rating>(.*?)</rating>#",$get,$match); $rating = $match[1]; //Рейтинг
			preg_match("#<masters_love>(.*?)</masters_love>#",$get,$match); $masters_love = $match[1]; //мастера
			preg_match("#<diamond>(.*?)</diamond>#",$get,$match); $diamond = $match[1]; //Рубли
			preg_match("#<sugar>(.*?)</sugar>#",$get,$match); $sugar = $match[1]; //Сахар
			preg_match("#<toilet_paper>(.*?)</toilet_paper>#",$get,$match); $toilet_paper = $match[1]; //Бумага
			preg_match("#<soap>(.*?)</soap>#",$get,$match); $soap = $match[1]; //Мыло
			preg_match("#<milk>(.*?)</milk>#",$get,$match); $milk = $match[1]; //Сгущенка
			preg_match("#<energy>(.*?)</energy>#",$get,$match); $energy = $match[1]; //Энергия
			preg_match("#<beard>(.*?)</beard>#",$get,$match); $beard = $match[1]; //Борода
			preg_match("#<key id=\"19\">(.*?)</key>#",$get,$match); $chefir = $match[1]; //банки чефира
			preg_match("#<basePopularity>(.*?)</basePopularity>#",$get,$match); $basePopularity = $match[1]; //Бицуха
			preg_match("#<playerTalentPoints>(.*?)</playerTalentPoints>#",$get,$match); $playerTalentPoints = $match[1]; //Таланты
			preg_match("#<playerGuild>(.*?)</playerGuild>#",$get,$match); $playerGuild = $match[1]; //Бригада
			$get1 = file_get_contents_curl("http://109.234.156.251/prison/universal.php?key=$auth&method=getAllBuildingsRewardsInfo&user=$id");
			preg_match("#<timetoprofit>(.*?)</timetoprofit>#",$get1,$match); $timetoprofit = $match[1]; //Время до сбора
			preg_match("#<money>(.*?)</money>#",$get1,$match); $timemoney = $match[1]; //Papir до сбора
			preg_match("#<rating>(.*?)</rating>#",$get1,$match); $timerating = $match[1]; //rating до сбора
			preg_match("#<love>(.*?)</love>#",$get1,$match); $timelove = $match[1]; //love до сбора
			
			$get2 = file_get_contents_curl("http://109.234.156.251/prison/universal.php?key=$auth&method=damageHistory.getHallOfFame&user=$id");
			$json = json_decode($get2, true);
			$damageHistory = $json["ratings"][0]["rating"];
			
			$timesbor = date("H:i:s", mktime(0, 0, $timetoprofit));
			if($money == ''){file_get_contents("/mobile/?exit=1");}
			?>
			<div style="margin:auto; text-align:center; ">
			<div style="width:200px;text-align:left;margin:auto; font-weight:600;">
			<div class="nav">Ваш ник: <?echo urldecode($name);?></div>
			 <img src="img/avtrtt.gif" /><?echo $rating.' ('.printLevel($rating).' ур.)'?><br />
			 Борода: <a id="cb"><?echo $beard?>/60</a><?if($beard >= 1){echo '<div class="brit" style="float: right;"> | <button id="brit">Брить</button></div>';}?><br />
			 <img src="img/mstrstv.gif" /><?echo $masters_love?><br />
			 <img src="img/bic.gif" /><?echo $basePopularity;?><br />
			 <img src="img/chefir.png" /><?echo $chefir;?><br />
			 <img src="img/en.gif" /><?echo $energy;?><br />
			 <img src="img/money.gif" /><?echo $money;?><br />
			 <img src="img/diamond.gif" /><?echo $diamond;?><br />
			 <img src="img/sugar.gif" /><?echo $sugar;?><br />
			 <img src="img/paper.gif" /><?echo $toilet_paper;?><br />
			 <img src="img/soap.gif" /><?echo $soap;?><br />
			 <img src="img/milk.png" /><?echo $milk;?><br />
			 <img src="img/nich.png" /><?echo nich($get);?><br />
			</div>
			<center><div style="width:600px;font-size: 20;">
			<b style="color: #828282;">Пробил за неделю:</b> <span style="color:#AA11AA;font-weight: bold;"><?=number_format($damageHistory, 0, ' ', ' ');?></span><br>
			<b style="color: #828282;">Вложено талантов:</b> <b style="color: #E69600;"><?echo $playerTalentPoints;?></b><br><br>
			</div></center>
			<!--                        -->
			<center>
			<fieldset class="sroch" style="width: 190px; background: #ddd;"> 
			<legend class="center">Прибыль</legend> 
				<div id="time"><?if($timetoprofit != 28800){?>Время до сбора: <?echo $timesbor;?></div>
					<?}else{?>
					<form method=post style="margin: auto;width: 130px;">
						<input type="submit" name="prib" value="Забрать прибыль">
					</form>
					 <img src="img/money.gif" /><?echo $timemoney;?>
					 <img src="img/avtrtt.gif" /><?echo $timerating;?>
					 <img src="img/love1.png" /><?echo $timelove;?>
					<?}?><br>
			</fieldset>
			</center><br>
			<!--                        -->
			<!--<form method=post><input type="submit" class='a' name="exit" value="Выйти"></form>-->
			<?include_once ("include/button.php");?>
		  </div>
		  <center>
			  <div class="delyg">
				  <b><a>Делюги</a></b><br>
				  <?include_once "actionsday.php";
					echo "<br><b><a style='color: green;'>$u / $d Делюг выполнено</a></b>";
				?>
			  </div>
		  </center>
	<?}?>
		<script>
		function del(){
		 $("div.error").remove();
		}

		setTimeout(del, 3000);
		$("#brit").click(function(){
			$.ajax({
				url: 'ajax.php',
				type: 'POST',
				data: 'brit=1',
				success: function(u){
					alert (u);
					$(".brit").remove();
					$("#cb").text("0/60");
				}
			})
		});
	  </script>
    </body>
</html>