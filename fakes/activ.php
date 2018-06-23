<? //Начать бой
$cookauth = $_COOKIE['auths1'];
$cookKPP = $_COOKIE['saveKPP']; //
$site = "activ.php";

if($_POST['save']){
	setcookie("auths1", $_POST['auth']);
	header('Location: '.$site);
}
if($_POST['saveKPP']){
	setcookie("saveKPP", $_POST['idl']);
	header('Location: '.$site);
}
///////////////////////////////////////////////////////////////////////////
if($_POST['startB'])
{
$f = $_POST['fake'];
$lager = $_POST['idl'];

foreach (explode("\n", $f) as $fake)
{list($id,$key) = explode(':',trim($fake));
	$url = file_get_contents('http://109.234.155.196/prison/universal.php?method=startBattle&user='.$id.'&key='.$key.'&boss_id='.$lager.'&combo=0&choice=p&single_mode=0&mode=simple&buff=0&guild_mode=0&type=node');  
	preg_match_all("/<code>(.*?)<\/code>/",$url,$matches);
    $msg1 = $matches[1][0]; //авторитет
echo '<div class="ok sma"><center>';

switch($msg1){
case 4: 
echo"<font color=blue>id$id </font><font color=green>« Уже в бою »</font>";
case 0: 
echo"<font color=blue>id$id </font><font color=green>« Напали =) »</font>"; 
break; 
default: echo"<font color=red></font><font color=red>Не известная ошибка @$msg1@ « id$id »</font>";};?><?echo '</center></div><br>';}}
///////////////////////////////////////////////

if($_POST['duke'])
{
$f = $_POST['fake3'];

foreach (explode("\n", $f) as $fake)
{list($id,$key) = explode(':',trim($fake));
	$url = file_get_contents('http://109.234.155.196/prison/universal.php?user='.$id.'&key='.$key.'&method=dukeDamage.hit'); 
	file_get_contents('http://109.234.155.196/prison/universal.php?user='.$id.'&key='.$key.'&method=getBoss');	
	$msg = json_decode($url);
	$msg1 = $msg->{'code'};
echo '<div class="ok sma"><center>';

switch($msg1){
case 0:  //код ошыбки
echo"<font color=blue>id$id </font><font color=green>Игла успешно ударил</font>"; //то что на сайте отображает ответом 
break; 
case 4: 
echo"<font color=blue>id$id </font><font color=green>Не в бою</font>"; 
break;
case 5: 
echo"<font color=blue>id$id </font><font color=green>Не куплен общак, или у иглы кончился урона</font>"; 
break;
default: echo"<font color=red></font><font color=red>Не известная ошибка @$msg1@ « id$id »</font>";};?><?echo '</center></div><br>';}}
?>

<html>
<head>
<style><!--Стили-->
input[type="submit"]{height: 30;}
button{height: 30;}
.sma  {/*margin-bottom:-15px;*/padding: 8px 5px;}
.ok   {background: #F0E4E4;border: 1px solid #D6CBCB;}
.nav1  {background: #C0F7FF;border: 1px solid #3C6BFF;}
.check{background: #e4f0e8;border: 1px solid #D6CBCB;}
.smen {background: #D7F3EB;border: 1px solid #cbd6cf;}
.sbor {background: #F0F0E4;border: 1px solid #cbd6cf;}
.bri  {background: #CEC6BA;border: 1px solid #D4BCBC;}
#cont {padding: 30px;background: #ffffff;}
</style>
</head>
<body style="background-color: #DDDCEE;">
<meta http-equiv="content-type" content="charset=utf-8">

<center>
<span id="nik1" style="font-family:comic sans ms,cursive;color: #FF0A0A;cursor: context-menu;">Напасть на актив</span>
<div class="smen sma">  
<form method=POST>
<font>Лагерь:</font><br>
<select name="idl">
<option value="1" <?if($cookKPP == "1"){echo"selected";}?>>Тройка [КПП]</option>
<option value="2"<?if($cookKPP == "2"){echo"selected";}?>>Тройка [Восточная вышка]</option>
<option value="3"<?if($cookKPP == "3"){echo"selected";}?>>Тройка [Лазарет]</option>
<option value="4"<?if($cookKPP == "4"){echo"selected";}?>>Тройка [Прачка]</option>
<option value="5"<?if($cookKPP == "5"){echo"selected";}?>>Тройка [Блок 1]</option>
<option value="6"<?if($cookKPP == "6"){echo"selected";}?>>Тройка [Западная вышка]</option>
<option value="7"<?if($cookKPP == "7"){echo"selected";}?>>Тройка [Котельная]</option>
<option value="8"<?if($cookKPP == "8"){echo"selected";}?>>Тройка [Столовая]</option>
<option value="9"<?if($cookKPP == "9"){echo"selected";}?>>Тройка [Блок 2]</option>
<option value="10"<?if($cookKPP == "10"){echo"selected";}?>>Тройка [Административный корпус]</option>
<option disabled="">Копейка</option>
<option value="11"<?if($cookKPP == "11"){echo"selected";}?>>Копейка [Проходная]</option>
<option value="12"<?if($cookKPP == "12"){echo"selected";}?>>Копейка [Пищеблок]</option>
<option value="13"<?if($cookKPP == "13"){echo"selected";}?>>Копейка [Вышка]</option>
<option value="14"<?if($cookKPP == "14"){echo"selected";}?>>Копейка [Барак 3]</option>
<option value="15"<?if($cookKPP == "15"){echo"selected";}?>>Копейка [Цех]</option>
<option value="16"<?if($cookKPP == "16"){echo"selected";}?>>Копейка [Барак 2]</option>
<option value="17"<?if($cookKPP == "17"){echo"selected";}?>>Копейка [Морг]</option>
<option value="18"<?if($cookKPP == "18"){echo"selected";}?>>Копейка [Карцер]</option>
<option value="19"<?if($cookKPP == "19"){echo"selected";}?>>Копейка [Барак 4]</option>
<option value="20"<?if($cookKPP == "20"){echo"selected";}?>>Копейка [Корпус охраны]</option>
<option disabled="">Красная однёрка</option>
<option value="21"<?if($cookKPP == "21"){echo"selected";}?>>Красная однёрка [Барак 1]</option>
<option value="22"<?if($cookKPP == "22"){echo"selected";}?>>Красная однёрка [Медпункт]</option>
<option value="23"<?if($cookKPP == "23"){echo"selected";}?>>Красная однёрка [Барак 2]</option>
<option value="24"<?if($cookKPP == "24"){echo"selected";}?>>Красная однёрка [Вышка]</option>
<option value="25"<?if($cookKPP == "25"){echo"selected";}?>>Красная однёрка [Баня]</option>
<option value="26"<?if($cookKPP == "26"){echo"selected";}?>>Красная однёрка [Барак 3]</option>
<option value="27"<?if($cookKPP == "27"){echo"selected";}?>>Красная однёрка [Корпус А]</option>
<option value="28"<?if($cookKPP == "28"){echo"selected";}?>>Красная однёрка [Библиотека]</option>
<option value="29"<?if($cookKPP == "29"){echo"selected";}?>>Красная однёрка [Прачка]</option>
<option value="30"<?if($cookKPP == "30"){echo"selected";}?>>Красная однёрка [Теплотрасса]</option>
<option value="31"<?if($cookKPP == "31"){echo"selected";}?>>Красная однёрка [Карцер]</option>
<option value="32"<?if($cookKPP == "32"){echo"selected";}?>>Красная однёрка [Хозблок]</option>
<option value="33"<?if($cookKPP == "33"){echo"selected";}?>>Красная однёрка [Администрация]</option>
<option disabled="">Полярная сова</option>
<option value="68"<?if($cookKPP == "68"){echo"selected";}?>>Полярная сова [Проходная]</option>
<option value="69"<?if($cookKPP == "69"){echo"selected";}?>>Полярная сова [Хозблок]</option>
<option value="70"<?if($cookKPP == "70"){echo"selected";}?>>Полярная сова [Склад]</option>
<option value="71"<?if($cookKPP == "71"){echo"selected";}?>>Полярная сова [Гардероб]</option>
<option value="72"<?if($cookKPP == "72"){echo"selected";}?>>Полярная сова [Западный барак]</option>
<option value="73"<?if($cookKPP == "73"){echo"selected";}?>>Полярная сова [Барак 2]</option>
<option value="74"<?if($cookKPP == "74"){echo"selected";}?>>Полярная сова [Заброшенный барак]</option>
<option value="75"<?if($cookKPP == "75"){echo"selected";}?>>Полярная сова [Барак у дороги]</option>
<option value="76"<?if($cookKPP == "76"){echo"selected";}?>>Полярная сова [Барак 5]</option>
<option value="77"<?if($cookKPP == "77"){echo"selected";}?>>Полярная сова [Барак 6]</option>
<option value="78"<?if($cookKPP == "78"){echo"selected";}?>>Полярная сова [Центровой барак]</option>
<option value="79"<?if($cookKPP == "79"){echo"selected";}?>>Полярная сова [Барак УДОшников]</option>
<option value="80"<?if($cookKPP == "80"){echo"selected";}?>>Полярная сова [Баня]</option>
<option value="81"<?if($cookKPP == "81"){echo"selected";}?>>Полярная сова [Актовый зал]</option>
<option value="82"<?if($cookKPP == "82"){echo"selected";}?>>Полярная сова [Столярка]</option>
<option value="83"<?if($cookKPP == "83"){echo"selected";}?>>Полярная сова [Слесарка]</option>
<option value="84"<?if($cookKPP == "84"){echo"selected";}?>>Полярная сова [Пищеблок]</option>
<option value="85"<?if($cookKPP == "85"){echo"selected";}?>>Полярная сова [Цеха]</option>
<option value="86"<?if($cookKPP == "86"){echo"selected";}?>>Полярная сова [Медсанчасть]</option>
<option value="87"<?if($cookKPP == "87"){echo"selected";}?>>Полярная сова [Западная вышка]</option>
<option value="88"<?if($cookKPP == "88"){echo"selected";}?>>Полярная сова [Восточная вышка]</option>
<option value="89"<?if($cookKPP == "89"){echo"selected";}?>>Полярная сова [Управление лагеря]</option>
<option disabled="">Чёрный беркут</option>
<option value="90"<?if($cookKPP == "90"){echo"selected";}?>>Чёрный беркут [Охрана]</option>
<option value="91"<?if($cookKPP == "91"){echo"selected";}?>>Чёрный беркут [Раздевалка]</option>
<option value="92"<?if($cookKPP == "92"){echo"selected";}?>>Чёрный беркут [Канцелярия]</option>
<option value="93"<?if($cookKPP == "93"){echo"selected";}?>>Чёрный беркут [Щитовая]</option>
<option value="94"<?if($cookKPP == "94"){echo"selected";}?>>Чёрный беркут [Барак №1]</option>
<option value="95"<?if($cookKPP == "95"){echo"selected";}?>>Чёрный беркут [Барак №2]</option>
<option value="96"<?if($cookKPP == "96"){echo"selected";}?>>Чёрный беркут [Барак №3]</option>
<option value="97"<?if($cookKPP == "97"){echo"selected";}?>>Чёрный беркут [Барак №4]</option>
<option value="98"<?if($cookKPP == "98"){echo"selected";}?>>Чёрный беркут [Складское помещение]</option>
<option value="99"<?if($cookKPP == "99"){echo"selected";}?>>Чёрный беркут [Карцер]</option>
<option value="100"<?if($cookKPP == "100"){echo"selected";}?>>Чёрный беркут [Котельная]</option>
<option value="101"<?if($cookKPP == "101"){echo"selected";}?>>Чёрный беркут [Брак УДОшников]</option>
<option value="102"<?if($cookKPP == "102"){echo"selected";}?>>Чёрный беркут [Морг]</option>
<option value="103"<?if($cookKPP == "103"){echo"selected";}?>>Чёрный беркут [Баня]</option>
<option value="104"<?if($cookKPP == "104"){echo"selected";}?>>Чёрный беркут [Актовый зал]</option>
<option value="105"<?if($cookKPP == "105"){echo"selected";}?>>Чёрный беркут [Столярка]</option>
<option value="106"<?if($cookKPP == "106"){echo"selected";}?>>Чёрный беркут [Музей]</option>
<option value="107"<?if($cookKPP == "107"){echo"selected";}?>>Чёрный беркут [Склад столярки]</option>
<option value="108"<?if($cookKPP == "108"){echo"selected";}?>>Чёрный беркут [Пищеблок]</option>
<option value="109"<?if($cookKPP == "109"){echo"selected";}?>>Чёрный беркут [Лазарет]</option>
<option value="110"<?if($cookKPP == "110"){echo"selected";}?>>Чёрный беркут [Северный пищеблок]</option>
<option value="111"<?if($cookKPP == "111"){echo"selected";}?>>Чёрный беркут [Медсанчасть]</option>
<option value="112"<?if($cookKPP == "112"){echo"selected";}?>>Чёрный беркут [Наблюдательный пункт]</option>
<option value="113"<?if($cookKPP == "113"){echo"selected";}?>>Чёрный беркут [Блок охраны]</option>
<option value="114"<?if($cookKPP == "114"){echo"selected";}?>>Чёрный беркут [Корпус администрации]</option>
</select><input type="submit" name="saveKPP" value="Запомнить" style="width: 90;"><br>
<textarea name="fake" maxlength="950" rows="10" style="resize:none;width:40%;"><?if($cookauth != ''){echo "$cookauth";}?></textarea><br>
<input type="submit" name="startB" value="Напасть" style="width: 110;">
</form>
</div>
</center>

<center>
<span id="nik1" style="font-family:comic sans ms,cursive;color: #FF0A0A;cursor: context-menu;">Урон от иглы</span>
<div class="bri sma">  
<form method=POST>
<textarea name="fake3" maxlength="950" rows="10" style="resize:none;width:40%;"><?if($cookauth != ''){echo "$cookauth";}?></textarea><br>   
<input type="submit" name="duke" value="Убить иглой" style="width: 110;">
</form>
</div>
</center>

<center>
<form method="POST">
    <textarea style="resize:none;width:40%;" placeholder="Запоминает список фейков" name="auth" value="<?if($cookauth != ''){echo "$cookauth";}?>"></textarea>
<input type="submit" name="save" value="Сохранить" style="width: 90;position: absolute;padding: 8;">
</form>
</center><br>
<div class="ok sma">
<a href="https://vk.com/rzn_fantik"><font color=red>Бот сделал: [RZN]Fantik</font></a><font style="position:absolute;right:15;" color="green">Идея: <a href="http://vk.com/id316034979">Андрей Морозов</a></font>  <center><a href='menu.php'><input type='submit' style="margin: -20;" value='Меню'></input></a></center>
</div>

</body>
</html>