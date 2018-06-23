<!DOCTYPE html>
<?
session_start();
/////// VK ////////
$fakeIDvk = "274696211";
$fakeAuthvk = "51f8199351323ca47336985bd5866b7e";
$token = "255bdd34255bdd3425eb0b2a13250368592255b255bdd347dedcd85e1f7ac784cbeac7d";
/////// Mail //////
$fakeIDmail = "3848121359834058353";
$fakeAuthmail = "f8a5bd3374305ae2994cfb51713e3e5f";
/////// OK ////////
$fakeIDok = "99714846";
$fakeAuthok = "c0b31038e52b43db242b4e30d8b9b7f0";

$rating = "50000"; //сколько нужно авторитета
?>
<html>
<head>
	<link rel="stylesheet" href="css/style.css" media="screen" type="text/css" />
	<meta name="description" content="Бесплатная отправка нычек">
	<title>Беспланые нычки - ВК - МАИЛ</title>
</head>
<body>
	<?include "head_menu.php";?>
	<?
	include('bd2.php');

	if(!empty($_POST["smb"]) && !empty($_POST["id"]) ){
		if (md5($_POST['captha']) != $_COOKIE['randomnr2'])	{
			$echo[] = "<div class='alert alert-danger'>Вы не верно ввели капчу</div>";
		}else{
			if($_POST["rez"] == 'vk'){ ////тут вк ))
			$id = urldecode(trim($_POST["id"]));
			$urlvk = file_get_contents('https://api.vk.com/method/getProfiles?user_ids='.$id.'&fields=photo_50&access_token='.$token.'&v=3.0');
			$arr = json_decode($urlvk,true);
			
			$ids = $arr["response"][0]["uid"];
			
			if($arr["error"] || $arr["response"] == null){
				$echo[] = "<div class='alert alert-danger'>".$arr["error"]["error_code"]." Ошибочка</div>";
			}else{
				$get = file_get_contents("http://109.234.156.251/prison/universal.php?user=$fakeIDvk&key=$fakeAuthvk&method=getFriendModels&friend_uid=$ids");
				preg_match("#<rating>(.*?)</rating>#",$get,$match); 
				$resget = $match[1];
				preg_match("#<code>(.*?)</code>#",$get,$match); 
				$codget = $match[1];
				if($codget == 4 || $id == null){
					$echo[] = "<div class='alert alert-danger'>Данный аккаунт не играет в тюрягу</div>";
				}else{
					if($resget < $rating){
						$echo[] = "<div class='alert alert-danger'>Нужно иметь $rating авторитета</div>";
					}else{

						$result = mysql_query("SELECT id FROM `auto` WHERE id='$ids' AND social='vk'"); 
						$myrow = mysql_fetch_array($result);

						if(!empty($myrow['id'])){
							$echo[] = "<div class='alert alert-danger'>#".$ids." Пользователь уже с таким ID есть в базе</div>";
						}else{
							$query = "INSERT INTO `auto` (`id`, `social`) VALUES ('$ids','vk')";
							$query = mysql_query($query) or die("Ошибка, смотрите код 2");
							$echo[] = "<div class='alert alert-success'>#".$ids.", Вы успешно подключились к автоотправке нычек!</div></br>";	
							setcookie("q", 1);
						}}}
					}
			}
			elseif($_POST["rez"] == 'mail'){ ////тут маил ))
				$id = urldecode(trim($_POST["id"]));
				$ids = $id;
				$get = file_get_contents("http://109.234.157.91/prison/universal.php?user=$fakeIDmail&key=$fakeAuthmail&method=getFriendModels&friend_uid=$ids");
				preg_match("#<rating>(.*?)</rating>#",$get,$match); 
				$resget = $match[1];
				preg_match("#<code>(.*?)</code>#",$get,$match); 
				$codget = $match[1];
				
				if($codget == 4 || $id == null){
					$echo[] = "<div class='alert alert-danger'>Данный аккаунт не играет в тюрягу</div>";
				}else{
					if($resget < $rating){
						$echo[] = "<div class='alert alert-danger'>Нужно иметь $rating авторитета</div>";
					}else{
						$result = mysql_query("SELECT id FROM `auto` WHERE id='$ids' AND social='mail'"); 
						$myrow = mysql_fetch_array($result);
						
						if(!empty($myrow['id'])){
							$echo[] = "<div class='alert alert-danger'>#".$ids." Пользователь уже с таким ID есть в базе</div>";
						}else{
							$query = "INSERT INTO `auto` (`id`, `social`) VALUES ('$ids','mail')";
							$query = mysql_query($query) or die("Ошибка, смотрите код 3");
							$echo[] = "<div class='alert alert-success'>#".$ids.", Вы успешно подключились к автоотправке нычек!</div></br>";	
						}
					}
				}
			}
			elseif($_POST["rez"] == 'ok'){ ////тут однокласники ))
				$id = urldecode(trim($_POST["id"]));
				$echo[] = "<div class='alert alert-danger'>Скоро будет )</div>";
			}	
		}
	}

				if($_REQUEST['halava']){
					$ni4ki = $_POST['id'];
					?>
					<div class="spoiler" style="margin-top: -50px;"> <center>
						<label class="btn buttons spoiler" for="spoiler">Открыть результат отправки</label></center>
						<input type="checkbox" id="spoiler"/>
						<div class="text">
							<?
							$fakes = file('fakes.txt');
							$fa = count($fakes);
							$l = 1;

							for($i = 0; $i < $fa; $i++) 
								{list($id,$key) = explode(':',trim($fakes[$i]));
							$ni1 = rand(1, 7);
							$ni2 = rand(1, 99);
							$qo = file_get_contents('http://109.234.155.196/prison/universal.php?method=collectionsSendGiftToFriend&friend='.$ni4ki.'&id='.$ni1.'&cid='.$ni2.'&user='.$id.'&key='.$key);
							preg_match_all("/<code>(.*?)<\/code>/",$qo,$matches);

$result = $matches[1][0];// id132942251 ряд - 1 нычка - 5 - Успешно передана :)
preg_match_all("/<result>(.*?)<\/result>/",$qo,$matches);

$result2 = $matches[1][0];
if($result2 == '0'){
	echo '<div class="ok smen"><center><font color=red>Старые фейки</font></a></center></div>';
	$i = count($fakes);}
	if($result =='3'){
		echo '<div class="ok smen"><center><font color=red>id'.$ni4ki.' Лимит - отправленно '.$l.' нычек</font></a></center></div>';
		$i = count($fakes);}
		else{echo '<div class="ok smen"><center><font color=red>id'.$ni4ki.' ряд - '.$ni2.' нычка - '.$ni1.' - Успешно передана :) #'.$l.'</font></a></center></div>';
		$l++;
	}
}
echo "</div></div>";
}

if($echo){
	echo "<center>";
	foreach($echo as $err){echo $err;}
	echo "</center>";}
	$temp = "SELECT COUNT(*) FROM auto"; 
	$limited = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM auto WHERE vkl = '0'")); 
	$res = mysql_query($temp);  
	$rows = mysql_fetch_array($res); 
	?>
	<h1>Ежедневная автоматическая отправка нычек</h1>
	<b>Работает ежедневно. БЕСПЛАТНО.</b>
	<p>По всем вопросам  писать <a href="http://vk.com/rzn_fantik">сюда</a></p>
	<p><font color="red">Бесплатное продвижения в социальных сетях! <a href="http://bosslike.ru/?ref=67920">ссылка</a></font></p>
	<p class="allUser">Подключено пользователей: <? echo $rows[0]; ?></p>   
	<p class="allUser red"> Ожидают отправки: <? echo $limited[0]; ?> человек(а) </p>
	<section class="forms">
		<form action="" method="post">
			<h5>Заявка на ежедневную отправку нычек</h5>
			<small>От <?=number_format($rating, 0, '.', '.')?> авторитета</small>
			<label for="id">Ваш ID</label>
			<input id="id" type='text' name='id' autocomplete="off" required>
			<label for="captcha">Код с картинки</label>
			<input id="captcha" type="text" name="captha" autocomplete="off">
			<img class="img_cap" src="/captha.php">
			<section class="networks">
				<input name="rez" class="radio" id="rez0" type="radio" value="vk" checked><label for="rez0">ВК</label>
				<input name="rez" class="radio" id="rez1" type="radio" value="mail"><label for="rez1">Mail</label>
				<input name="rez" class="radio" id="rez2" type="radio" value="ok"><label for="rez2">ОК</label>
			</section>
			<input type="submit" name="smb" class="button" value="Подать заявку">
		</form>
		<form action="" method="post">
			<h5>Получить нычек до лимита</h5>
			<label for="id_get">Ваш ID</label>
			<input id="id_get" type="text" name="id" autocomplete="off" required>
			<input type="submit" name="halava" class="button" value="Получить нычки">
		</form>	
	</section>
<!--	<section class="fakes">
		<h1>Список фейков [<?=count(file('fakes1.php'));?>]</h1>
		<textarea><?include_once("fakes1.php");?></textarea> -->
		<?php 
		$temp = "SELECT COUNT(*) FROM auto"; 
		$res = mysql_query($temp);  
		$rows = mysql_fetch_array($res); 
		mysql_close();

		?>

		<!-- <font color='red'><b>Автоматическое обновление базы! Теперь  <b><?=count(file('fakes.txt'));?></b> фейка(ов).</b></font></br></br>-->
		<? //phpinfo();?>
	</section>
</body>
</html>