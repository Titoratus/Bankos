<?
include_once("function.php");
if(!$_COOKIE['id']){header('Location: /mobile/');}else{
$id = $_COOKIE['id']; //ид пользователя
$auth = $_COOKIE['auth']; //аут пользователя
?>
<!doctype html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<title>Движухи</title>
	<script src="https://code.jquery.com/jquery-2.1.4.min.js"></script>
	<link rel="stylesheet" href="css/style.css" media="screen" type="text/css" />
	<link rel="stylesheet" href="css/menu.css">
</head>
<body>
	<?include "../head_menu.php";?>
	<?
	if(!isset($_GET["city"])){?>
	  <table border="0" style="margin:auto;text-align: center;">
		  <thead>
		<tr>
		  <th>Тюрьмы</th>
		  <th>Мастера</th>
		</tr>
	  </thead>
	  <tbody>
		<tr valign="top">
		  <td>
		  <a href="job.php?city=1" class="color green button city">Бутырка</a>
		  <a href="job.php?city=10" class="color green button city">Красная пресня</a>
		  <a href="job.php?city=20" class="color green button city">Софийка</a>
		  <a href="job.php?city=2" class="color green button city">Кресты</a>
		  <a href="job.php?city=3" class="color green button city">В. централ</a>
		  <a href="job.php?city=21" class="color green button city">Угольки</a>
		  <a href="job.php?city=4" class="color green button city">Матросская тишина</a>
		  <a href="job.php?city=5" class="color green button city">Вологодский пятак</a>
		  <a href="job.php?city=25" class="color green button city">Лефортовка</a>
		  <a href="job.php?city=6" class="color green button city">Белый лебедь</a>
		  <a href="job.php?city=29" class="color green button city">Дальняя</a>
		  <a href="job.php?city=7" class="color green button city">Орловский централ</a>
		  <a href="job.php?city=27" class="color green button city">Елецкая крытка</a>
		  <a href="job.php?city=8" class="color green button city">Черный дельфин</a>
		  <a href="job.php?city=32" class="color green button city">Гродненская крытка</a>
          <a href="job.php?city=33" class="color green button city">А. централ</a>
		  </td>
		  <td valign="top">
		  <a href="job.php?city=11" class="color green button city">Петя</a>
		  <a href="job.php?city=12" class="color green button city">Яша</a>
		  <a href="job.php?city=13" class="color green button city">Илюша</a>
		  <a href="job.php?city=14" class="color green button city">Нинка</a>
		  <a href="job.php?city=15" class="color green button city">Ашот</a>
		  <a href="job.php?city=16" class="color green button city">Шура</a>
		  <a href="job.php?city=17" class="color green button city">Макар</a>
		  <a href="job.php?city=18" class="color green button city">Сева</a>
		  <a href="job.php?city=19" class="color green button city">Жора</a>
		  <a href="job.php?city=23" class="color green button city">Янка</a>
		  <a href="job.php?city=22" class="color green button city">Ванька</a>
		  <a href="job.php?city=24" class="color green button city">Пантелей</a>
		  <a href="job.php?city=26" class="color green button city">Кеша</a>
		  <a href="job.php?city=28" class="color green button city">Саня</a>
		  <a href="job.php?city=30" class="color green button city">Захар</a>
		  <a href="job.php?city=31" class="color green button city">Паша</a>
		  </td>
		</tr>
	  </tbody>
	  </table>
	<?}else{
		if(isset($_GET["act"])){
		$city = $_GET["city"];
		$act = $_GET["act"];
			$get = file_get_contents("http://109.234.156.253/prison/universal.php?method=doCityAction&user=$id&key=$auth&city=$city&action_id=$act&action_type=3");
			preg_match("#<msg>(.*?)</msg>#",$get,$match); $msg = $match[1];
			preg_match("#<energy>(.*?)</energy>#",$get,$match); $energy = $match[1];
			
			if($msg == 'You have not energy'){
				setcookie('echo', '<div class="message_box" style="background:rgba(36, 255, 0, 0.35);">Не хватает энергии</div>');
				header("Location: job.php?city=".$_GET['city']);
			}elseif($msg == 'Error in requirements'){
				setcookie('echo', '<div class="message_box" style="background:rgba(36, 255, 0, 0.35);">о_О</div>');
				header("Location: job.php?city=".$_GET['city']);
			}elseif($msg == 'Mission not found'){
				setcookie('echo', '<div class="message_box" style="background:rgba(36, 255, 0, 0.35);">Миссия не найдена</div>');
				header("Location: job.php?city=".$_GET['city']);
			}else{
				if($energy){
					setcookie('echo', '<div class="message_box" style="background:rgba(36, 255, 0, 0.35);">Выполнил. Осталось <b>'.$energy.'</b> энергии</div>');
					header("Location: job.php?city=".$_GET['city']);
				}
			}
		}
	
		$city = $_GET["city"];
		$get = file_get_contents("http://109.234.156.253/prison/universal.php?method=getCityInfo&user=$id&key=$auth&city=$city");
		preg_match("#<mastery>(.*?)</mastery>#",$get,$match); $mastery = $match[1];
		preg_match("#<darkMastery>(.*?)</darkMastery>#",$get,$match); $darkMastery = $match[1];
		
		if($echo){
			echo $echo[0];
		}
		if(isset($_COOKIE['echo'])){
			echo $_COOKIE['echo'];
			setcookie('echo', null);
		}
		
		$xml = simplexml_load_string($get);
		$pach = $xml->xpath('//data/missions/mission');
		
		echo '<table border="0" style="margin:auto;">
		<tr><th scope="col">Дневные</th></tr>';
		foreach($pach as $miss){
		if($miss->id <= 7){$hodka = "Ходка: $mastery";}
		if($miss->id >= 8){$hodka = "Бунт: $darkMastery";}
		
			$complete = $miss->completeTick;
			$decomplate = $miss->allTick - $complete;
			echo '
			<tr>
			  <td>
			  <div class="box_job">
				  <div style="white-space: nowrap;text-overflow:ellipsis;overflow:hidden; text-align:left;">'.$miss->missionText.'</div>
				  <table border="0">
					<tbody>
						<tr>';
            for($i=0;$i<$complete;$i++){echo '
                        <td style="width:10px; height:5px; background:#FFA600;"></td>'."\n";
            }
            for($i=0;$i<$decomplate;$i++){echo '
                        <td style="width:10px; height:5px; background:#B2B2B2;"></td>'."\n";
            }
			echo '</tr>
					</tbody>
				  </table>
				 <div style="text-align:right;"><br><span style="float: left;margin-top: -20px;">'.$hodka.'</span><br>
					<span style="float: left;margin-top: -20px;">Нужно '.$miss->necessaryEnergy.' <img src="img/en.gif" style="height: 15px;"></span> 
					<a href="job.php?city='.$city.'&amp;act='.$miss->id.'" class="color green button job" style="margin-top: -30px;float: right;">Выполнить</a></div>
				 </div>
				</td>
			</tr>
			';
			if($miss->id == 7){echo '<tr><th scope="col">Ночные</th></tr>';}
		}
		echo '</table>';
		}?>
<div style="text-align: center;">
	<div style="margin: inherit;">
		<?include_once ("include/button.php");?>
	</div>
</div>
</body>
</html>
<?}?>