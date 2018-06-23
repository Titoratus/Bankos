<?
session_start();
$id = $_SESSION['id'];
$auth = $_SESSION['auth'];
include ("function.php");
include_once ("include/button.php");
/////////////////////
if($_POST["id"] && $_POST["auth"] && $_POST["ok"]){
    $get = file_get_contents_curl("http://109.234.156.251/prison/universal.php?key=".$_POST["auth"]."&method=getSpecialOffer&user=".$_POST["id"]);
    preg_match("#<result>(.*?)<\/result>#",$get,$match);
        if($match[1] != '0'){
            $_SESSION['id']=$_POST["id"];
            $_SESSION['auth']=$_POST["auth"];
            $echo[]='Успешно вошли'; $er=1;
        }else{
            $echo[]='Не верный id или auth';$er=2;
        }
}
//////////////////
if($_POST["prib"]){
    $get = file_get_contents_curl("http://109.234.156.251/prison/universal.php?key=$auth&user=$id&method=getAllBuildingsRewards");
    preg_match("#<money>(.*?)<\/money>#",$get,$match); $resultm = $match[1]; //love до сбора
    preg_match("#<code>(.*?)<\/code>#",$get,$match); $result = $match[1]; //love до сбора
    if($resultm != 0){
    if($result == 0){$echo[]='Прибыль успешно забрали';}
    }else{$echo[]='Нечего собирать'; }
}
if($_SESSION['id']){
    if($_POST["exit"] || $_GET["exit"]){
        unset($_SESSION['id']);
        unset($_SESSION['auth']);
        $echo[]='Надеюсь вы еще к нам зайдете ;)';$er=3;
    }
}
?>
<html>
    <head>
		<script src="https://code.jquery.com/jquery-2.1.4.min.js"></script>
		<link rel="stylesheet" href="css/menu.css" media="screen" type="text/css" />
    </head>
    <body>
		<?if($echo){?><center><div class='error'><?foreach($echo as $err){echo $err;}?></div></center>
		<?}if(!$_SESSION['id']){?>
		<center><form method=post>
			<p>ID</p><input type="text" name="id"><br>
			<p>Auth</p><input type="text" name="auth"><br>
			<input type="submit" name="ok" value="Войти">
		</form>
		</center>
			<?}else{
			$id = $_SESSION['id'];
			$auth = $_SESSION['auth'];
			$get = file_get_contents_curl("http://109.234.156.251/prison/universal.php?key=$auth&method=getInfo&user=$id");
			preg_match("#<name>(.*?)<\/name>#",$get,$match); $name = $match[1]; //Ник   1
			preg_match("#<money>(.*?)<\/money>#",$get,$match); $money = $match[1]; //Папиросы   1
			preg_match("#<rating>(.*?)<\/rating>#",$get,$match); $rating = $match[1]; //Рейтинг 1
			preg_match("#<masters_love>(.*?)<\/masters_love>#",$get,$match); $masters_love = $match[1]; //мастера  1
			preg_match("#<diamond>(.*?)<\/diamond>#",$get,$match); $diamond = $match[1]; //Рубли 1
			preg_match("#<sugar>(.*?)<\/sugar>#",$get,$match); $sugar = $match[1]; //Сахар 1 
			preg_match("#<toilet_paper>(.*?)<\/toilet_paper>#",$get,$match); $toilet_paper = $match[1]; //Бумага 1
			preg_match("#<soap>(.*?)<\/soap>#",$get,$match); $soap = $match[1]; //Мыло 1
			preg_match("#<milk>(.*?)<\/milk>#",$get,$match); $milk = $match[1]; //Сгущенка 1
			preg_match("#<energy>(.*?)<\/energy>#",$get,$match); $energy = $match[1]; //Энергия 1
			preg_match("#<beard>(.*?)<\/beard>#",$get,$match); $beard = $match[1]; //Борода
			preg_match("#<basePopularity>(.*?)<\/basePopularity>#",$get,$match); $basePopularity = $match[1]; //Бицуха 1
			preg_match("#<playerTalentPoints>(.*?)<\/playerTalentPoints>#",$get,$match); $playerTalentPoints = $match[1]; //Таланты
			$get1 = file_get_contents("http://109.234.156.251/prison/universal.php?key=$auth&method=getAllBuildingsRewardsInfo&user=$id");
			preg_match("#<timetoprofit>(.*?)<\/timetoprofit>#",$get1,$match); $timetoprofit = $match[1]; //Время до сбора
			preg_match("#<money>(.*?)<\/money>#",$get1,$match); $timemoney = $match[1]; //Papir до сбора
			preg_match("#<rating>(.*?)<\/rating>#",$get1,$match); $timerating = $match[1]; //rating до сбора
			preg_match("#<love>(.*?)<\/love>#",$get1,$match); $timelove = $match[1]; //love до сбора
			$timesbor = date("H:i:s", mktime(0, 0, $timetoprofit));
			if($money == ''){file_get_contents("/mobile/?exit=1");}
			?>
			<div style="margin:auto; text-align:center; ">
			<div style="width:200px;text-align:left;margin:auto; font-weight:600;">
			<p>
			<div class="nav">Ваш ник: <?echo urldecode($name);?></div>
			 <img src="img/avtrtt.gif" /><?echo $rating.' ('.printLevel($rating).' ур.)'?><br />
			 Борода: <a id="cb"><?echo $beard?>/60</a><?if($beard >= 1){echo '<div class="brit" style="float: right;"> | <button id="brit">Брить</button></div>';}?><br />
			 <img src="img/mstrstv.gif" /><?echo $masters_love?><br />
			 <img src="img/bic.gif" /><?echo $basePopularity;?><br />
			 <img src="img/en.gif" /><?echo $energy;?><br />
			 <img src="img/money.gif" /><?echo $money;?><br />
			 <img src="img/diamond.gif" /><?echo $diamond;?><br />
			 <img src="img/sugar.gif" /><?echo $sugar;?><br />
			 <img src="img/paper.gif" /><?echo $toilet_paper;?><br />
			 <img src="img/soap.gif" /><?echo $soap;?><br />
			 <img src="img/milk.png" /><?echo $milk;?><br />
			 <img src="img/nich.png" /><?echo nich($get);?></p><br />
			</div>
			<p> Талантов: <?echo $playerTalentPoints;?> <br /></p><br>
			<!-------------------------->
			<center>
			<fieldset class="sroch" style="width: 190px; background: #ddd;"> 
			<legend class="center">Прибыль</legend> 
				<div id="time"><?if($timetoprofit != 28800){?>Время до сбора: <?echo $timesbor;?></div>
					<?}else{?>
					<form method=post style="margin: auto;width: 130;">
						<input type="submit" name="prib" value="Забрать прибыль">
					</form>
					 <img src="img/money.gif" /><?echo $timemoney;?>
					 <img src="img/avtrtt.gif" /><?echo $timerating;?>
					 <img src="img/love1.png" /><?echo $timelove;?>
					<?}?><br>
					<!-- <a>Акция:</a> -->
			    <?
			   // $get2 = file_get_contents_curl('http://109.234.156.251/prison/universal.php?key='.$auth.'&method=getSpecialOffer&user='.$id.'');
				// $asd = json_decode($get2);
				// $bosses = array('Не известный','Кирпич','Сизый','Махно','Лютый','Шайба','Палыч','Циклоп','Бес','Паленый','Борзовa','Хирург','Раиса','Близнецы','Бурят','Дюбель','Дядя Миша','Жестянщики','Отбой','Бугор','Боцман','Жульбаны','Цербер','Пресс','Гастролер','Ташкент','Конвой','Бандяк','Бульдозер','Контрабас','Воркута','Крест','Север','Шнифер','Гризли','Бивень','Кусто','Феня','Крюгер','Карло','Мазай','Фин','Мезен','Ёхан','Чебот','Абу','Дантист','Бельмондо','Немой','Чугун','Змей','Шмель','Старшой');
				// foreach($asd->offer->rewards as $arr){
				// if($arr->type == "diamonds"){
					// echo $arr->value." рубликов <br>";
				// }
				// if($arr->type == "rating"){
					// echo $arr->value." авторитета <br>";
				// }
				// if($arr->type == "saop"){
					// echo $arr->value." мыла <br>";
				// }
				// if($arr->type == "poison"){
					// echo $arr->value." яда <br>";
				// }
				// if($arr->type == "toiletpaper"){
					// echo $arr->value." туалетки <br>";
				// }
				// if($arr->type == "chestKey"){
					// echo $arr->value." печатки <br>";
				// }
				// if($arr->type == "sigs"){
					// echo $arr->value." папирос <br>";
				// }
				// if($arr->type == "milk"){
					// echo $arr->value." сгущенки <br>";
				// }
				// if($arr->type == "key"){
					// $keyid = $arr->key_id;
					// echo $arr->value." ключа с ".$bosses[$arr->key_id]."<br>";
				// }
				// if($arr->type == "bonusSale"){
					// echo "Скидка на покупку рубликов <br>";
				// }
			// }
			// if($get == 'null'){echo "<a>Акция закончилась</a> <br>";}?>
			</fieldset>
			</center><br>
			<!-------------------------->
			<form method=post><input type="submit" class='a' name="exit" value="Выйти"></form>
			<?echo $button;?>
		  </div>
		  <center>
			  <div class="delyg">
				  <b><a>Делюги</a></b><br>
				  <?include_once "actionsday.php";?>
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