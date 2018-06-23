<?
$key2 = "rznfantikLOLcode";
include("../mobile/function.php");
include("../bd2.php");
$vk = array("126226626","53522458","132942251","143249830","311836952","16378328");
$file_load = scandir("img/");
foreach ($file_load as $key => $value) {
	if($key > 1){
		$preload[] = $value;
	}
}
$preload = $preload[array_rand($preload)];
if(in_array(decode($_COOKIE['key'],$key2),$vk)){


$json_set = json_decode(file_get_contents("auto_settings.json"), true);
?>
<html>
	<head>
		<title>Test</title>
		<link rel="stylesheet" type="text/css" media="all" href="style.css" />
		<script src="https://code.jquery.com/jquery-2.1.4.min.js"></script>
	</head>
	<body>
		<center>
			<?
			if(isset($_GET['setauto'])){
				$yad = $_GET['yad'];
				$sam = $_GET['sam'];
				$tal = $_GET['tal'];
				
				file_put_contents("auto_settings.json", json_encode($_GET));
				header("Location: index.php");
			}
			if(isset($_GET['del'])){
				$id = $_GET['del'];
				$row = mysql_query("DELETE FROM brigada WHERE id='".mysql_real_escape_string($id)."'");
				header("Location: index.php");
			}
			if(isset($_GET['autodel'])){
				$id = $_GET['autodel'];
				$row = mysql_query("DELETE FROM brigada_priem WHERE id='".mysql_real_escape_string($id)."'");
				header("Location: index.php");
			}
			if(isset($_GET['on'])){
				$id = $_GET['on'];
				$row = mysql_query("UPDATE brigada SET vkl='1' WHERE id='".mysql_real_escape_string($id)."'");
				header("Location: index.php");
			}
			if(isset($_GET['onall'])){
				if($_GET['onall'] == 'yes'){
					$row = mysql_query("UPDATE `brigada` SET `vkl` = REPLACE(`vkl`, '0', '1')");
					header("Location: index.php");
				}elseif($_GET['onall'] == 'no'){
					$row = mysql_query("UPDATE `brigada` SET `vkl` = REPLACE(`vkl`, '1', '0')");
					header("Location: index.php");
				}
			}
			if(isset($_GET['off'])){
				$id = $_GET['off'];
				$row = mysql_query("UPDATE brigada SET vkl='0' WHERE id='".mysql_real_escape_string($id)."'");
				header("Location: index.php");
			}
			if(isset($_GET['fake'])){
				$fake = urldecode($_GET['fake']);
				list($id,$auth) = explode(':',trim($fake));
				$get = file_get_contents("http://109.234.156.251/prison/universal.php?user=$id&key=$auth");
				preg_match("#<result>(.*?)<\/result>#",$get,$match); $result = $match[1]; //id босса
					if($result != '0'){
						$row = mysql_query("INSERT INTO brigada (id, auth, vkl) values('".mysql_real_escape_string($id)."', '".mysql_real_escape_string($auth)."', '0')");
					}else{
						echo "Плохой фейк";
					}
				header("Location: index.php");
			}
			
			if(isset($_GET['idauto'])){
				$id = $_GET['idauto'];
				$rank = $_GET['rank'];
				if($rank > 2 and $rank < 11){
					if(is_numeric($id)){
						$row = mysql_query("INSERT INTO brigada_priem (id, rank) values('".mysql_real_escape_string($id)."', '".mysql_real_escape_string($rank)."')");
						
						$date = date("H:i:s");
						$oldtext = file_get_contents("log2.txt");
						$namevk = namevk(decode($_COOKIE['key'],$key2));
						$text = "[$date] #$namevk - Добавил в автоприем '#$id'\n";
						file_put_contents("log.txt", "$text $oldtext");
					}
				}
				
				header("Location: index.php");
			}
			?>
			<div id="load_page" style="background: #ffefc0;border: 1px solid #c43c35;margin-bottom: 5px;">
			</div>
			
			<div style="background: #ffefc0;border: 1px solid #c43c35;margin-bottom: 5px;">
				<form method="GET">
					id:auth - <input type="text" name="fake" style="width: 320px;">
					<input class="button blue" type="submit" value="Добавить фейк">
				</form><br>
				<a href="?onall=no"><button class="button red">Выключить все</button></a>
				<a href="?onall=yes"><button class="button green">Включить все</button></a>
				<br>
				<a id="returns"><button class="flat_button wauth_auth _wauth_auth">Обновить</button></a><br>
			</div>
			
			<div style="background: #ff9090;border: 1px solid #c43c35;margin-bottom: 5px;">
				<div style="background: #ffcb89;border: 1px solid #c43c35;margin-bottom: 5px;">
				<label>Настройки автоприема по криитериям:</label>
					<form>
					<table>
						<tr>
							<td>
								<label>Таланты от:</label>
							</td>
							<td>
								<input type="number" name="tal" value="<?=$json_set['tal']?>"><br>
							</td>
						</tr>
						<tr>
							<td>
								<label>Яд от:</label>
							</td>
							<td>
								<input type="number" name="yad" value="<?=$json_set['yad']?>"><br>
							</td>
						</tr>
						<tr>
							<td>
								<label>Самопал от:</label> 
							</td>
							<td>
								<input type="number" name="sam" value="<?=$json_set['sam']?>">
							</td>
						</tr>
					</table>
					 <label>Параметр:</label><br>
						 <input name="sets" id="sets1" type="radio" value="s1"<?if($json_set['sets'] == 's1'){echo 'checked';}?>> <label for="sets1" style="cursor: pointer;">Проверять все криитерии</label><br>
						 <input name="sets" id="sets2" type="radio" value="s2"<?if($json_set['sets'] == 's2'){echo 'checked';}?>> <label for="sets2" style="cursor: pointer;">Любой из перечисленных</label><br>
						<input type="submit" name="setauto" value="Сохранить">
					</form>
				</div>
				<a class="textauto">Автоприем:</a>
				<!-- -->
				<div class="spoiler"> <center>
					<label class="btn22 buttons22 spoiler" for="spoiler">Открыть список авториема</label></center>
					<input type="checkbox" id="spoiler"/>
					<div class="text">
				<!-- -->
				<div style="background: #ffcb89;border: 1px solid #c43c35;margin-bottom: 5px;">
					<table>
						<tr>
							<th>ID</th>
							<th>Ранг</th> 
						</tr>
							<?
							$row = mysql_query("SELECT id, rank FROM brigada_priem");
							while($r=mysql_fetch_array($row))
							{  
								$autp_temp[]= array("id"=>$r["id"],"rank"=>$r["rank"]);
							}
							foreach($autp_temp as $t){
								$vkapi[] = $t["id"];
							}
							
							$uidvk = implode(",", $vkapi);
							$getvk = file_get_contents_curl("https://api.vk.com/method/users.get?user_ids=$uidvk&lang=ru&v=3.0");
							$json = json_decode($getvk, true);
							foreach($json['response'] as $uid){
								$id1 = $uid["uid"];
								$name = $uid["first_name"];
								$famile = $uid["last_name"];
								
								foreach($autp_temp as $l){
									if($id1 == $l["id"]){
										$rank = $l["rank"];
										
										echo "<tr><td>
										<a style='color:white; background: black;'>$name $famile</a>  
										</td>
										<td>
											<a style='color:white; background: black;'>$rank</a>  
										</td>
										<td>
											<a href='?autodel=$id1'><button class='button red'>Удалить</button></a>  
										</td></tr>";
									}
								}
							}
							?>
					</table>
				</div>
				<!-- -->,
					</div></div>
				<!-- -->
				
				<div style="background: #ffdac0;border: 1px solid #c43c35;margin-bottom: 5px;">
					
					<form method="GET">
						<span>
							<a class="textauto">ID:</a>	<input type="text" name="idauto" class="textinput"/>
						</span> 
						
						<a class="textauto">Ранг:</a> <select name="rank" class="custom-select">
							<option value="3">3</option>
							<option value="4">4</option>
							<option value="5">5</option>
							<option value="6">6</option>
							<option value="7">7</option>
							<option value="8" selected>8</option>
							<option value="9">9</option>
							<option value="01">10</option>
						</select>
						<input type="submit" style="font-size: 21px;" value="Добавить" class="button blue"/>
					</form>
				</div>
			</div>
			
			<div style="background: #ffefc0;border: 1px solid #c43c35;margin-bottom: 5px;">
				<div style="width: 600px; height: 150px;overflow: auto;">
					<?
					$file = file("log.txt");
					foreach($file as $f){
					echo $f."<br>";
					}
					?>
				</div>
				<hr>
				<div style="width: 600px; height: 150px;overflow: auto;">
					<?
					$file2 = file("log2.txt");
					foreach($file2 as $f2){
					echo $f2."<br>";
					}
					?>
				</div>
			</div>
			
			<!--<div style="background: #ffefc0;border: 1px solid #c43c35;margin-bottom: 5px;">Дамаг
				<div style="background: #ffefc0;border: 1px solid #c43c35;margin-bottom: 5px; width: 50%;height: 200px;overflow: auto;">
				<?
				$row = mysql_query("SELECT `uid`, `damage` FROM `damage` ORDER BY `damage` DESC");
				while($r=mysql_fetch_array($row)){
				$id = $r['uid'];
				$damage = $r['damage'];
				$temp_damag+=$damage;
					if(decode($_COOKIE['key'],$key2) == $id){
						echo "<b style=\"color: magenta;\">#$id</b> - $damage <br>";
					}else{
						echo "<b>#$id</b> - $damage <br>";
					}
				}
				?>
				</div>Примерно урона за сегодня: <?=$temp_damag;?>
			</div>-->
		</center>
		<script>
		function obnov(){
			$("#load_page").html("<center><div style='height:648px'><img style='margin-top: 324px;' src='img/<?=$preload;?>' /></div></center>");
			$.ajax({
			url: 'load_page.php',
			type: 'POST',
			success: function(u){
				$("#load_page").html(u);
				}
			});
		}
		obnov();
		$("#returns").click(function(){
			obnov();
		});
		</script>
	</body>
</html>
<?}else{
// if(isset($_POST['key'])){
	// if (md5($_POST['captha']) == $_COOKIE['randomnr2'])	{
		// if(encode($_POST['key'],$key2) == encode($key,$key2)){
			// setcookie("key", encode($_POST['key'],$key2), time()+600);
			// header("Location: index.php");
		// }else{
		// echo "хуй а не доступ";
		// }
	// }else{
		// echo "Не верная капча"; 
	// }
// }
?>
	<center>
	<link rel="stylesheet" href="../css/vk_flat.css" media="screen" type="text/css" />
	<script src="https://code.jquery.com/jquery-2.1.4.min.js"></script>
		<a href="https://oauth.vk.com/authorize?client_id=5813613&scope=offline,friends&redirect_uri=http://bankos.tk/brigada/vk.php">
			<div class="flat_button wauth_auth _wauth_auth" style="width: 250px;">Войти через ВКонтакте</div>
		</a>
		<div id="load_page" style="background: #ffefc0;border: 1px solid #c43c35;margin-bottom: 5px;">
		</div>
		<div style="background: #DDDCEE; border: 1px solid #3C6BFF;width: 600px; height: 150px;overflow: auto;">
			<?
			$file2 = file("log2.txt");
			foreach($file2 as $f2){
			echo $f2."<br>";
			}
			?>
		</div>
	</center>
			<script>
		function obnov(){
			$("#load_page").html("<center><div style='height:648px'><img style='margin-top: 324px;' src='img/<?=$preload;?>' /></div></center>");
			$.ajax({
			url: 'load_page.php',
			type: 'POST',
			success: function(u){
				$("#load_page").html(u);
				}
			});
		}
		obnov();
		</script>
<?}?>