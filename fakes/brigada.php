<?
$cook = $_COOKIE['idb'];
$site = "brigada.php";
if($_POST['save']){
	setcookie("idb", $_POST['idbri']);
	header('Location: '.$site);
}
?><html>
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
<script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
			<link rel="stylesheet" href="bootstrap.css">
			<script src="bootstrap.js"></script>

<nav class="navbar navbar-default" role="navigation"><!--Навигация-->
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <a class="navbar-brand" href="#">Работа с бригадами</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li <?if ($_GET['act']!='vxod'){if ($_GET['act']!='vixod'){if ($_GET['act']!='3da'){echo 'class="active"';}}}?>><a href="brigada.php">Узнать ID бригады</a></li>
        <li <?if ($_GET['act']=='vxod'){echo 'class="active"';}?>><a href="?act=vxod">Заявки в бригаду</a></li>
        <li <?if ($_GET['act']=='vixod'){echo 'class="active"';}?>><a href="?act=vixod">Выход из бригад</a></li>
        <li <?if ($_GET['act']=='3da'){echo 'class="active"';}?>><a href="?act=3da">Баррикадируем здания</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
          <li><a href="menu.php">Меню</a></li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">Помощь <span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu">
            <li><a target="_blank" href="http://vk.com/id132942251">Связь с админом</a></li>
          </ul>
        </li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
<br><!---->
<center><!--Навигация-->
<div class="nav1 sma" style="margin: -5;"> 
<a style="color:rgba(0, 0, 0, 0);" href="index.php">
<button>Ченжер</button>
</a>
</div>
</center><br>
<?
include_once('config.php');
?>

<? //Узнать ID бригады
error_reporting(0);
set_time_limit(0); 
if($_POST['baz'] == "Получить ID")
{
$adr = $_POST['adr'];
$f = $_POST['fake'];

foreach (explode("\n", $f) as $fake)
{list($id,$key) = explode(':',trim($fake));

$url = 'http://109.234.155.196/prison/universal.php?user='.$id.'&key='.$key.'&address='.$adr.'&method=guild.view'; 
    $ch=curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $r=curl_exec($ch);
    curl_close($ch);
    $arr = json_decode($r,true);
    $idb=$arr['guild']['id']; // Имя в вконтакте

echo '<div class="ok sma"> 
<center>';?><?switch($idb){
case '': echo"<font color=red>Не верный id:auth_key</font>"; break;
default: echo"<font color=red>ID  бригады</font><font color=green>« $idb »</font>";};?>
<?echo '</font></center></div><br>';}}
?>
<? //Заявки в бригаду с фейков +
if($_POST['baz11'] == "Подать заявки")
{
$idbri = $_POST['idbri'];
$f = $_POST['fake'];

foreach (explode("\n", $f) as $fake)
{list($id,$key) = explode(':',trim($fake));
	$url = file_get_contents('http://109.234.155.196/prison/universal.php?user='.$id.'&key='.$key.'&guildId='.$idbri.'&method=guild.addJoinRequest');  
	$msg = json_decode($url);
	$msg1 = $msg->{'code'};
	
echo '<div class="ok sma"> 
<center>';?><?switch($msg1){
case 0: 
echo"<font color=blue>id$id </font><font color=green>Заявка отправлена « id$id »</font>"; 
break; 
default: echo"<font color=red></font><font color=red>Не удалось, возможно фейк уже в бригаде, либо указали неверный ЦИФРОВОЙ айди бригады  « id$id »</font>";};?><?echo '</center></div><br>';}}
?>
<? //Массовый выход из бригад +
if($_POST['baz2'] == "Выйти из бригад")
{
$f = $_POST['fake'];

foreach (explode("\n", $f) as $fake)
{list($id,$key) = explode(':',trim($fake));
	$url = file_get_contents('http://109.234.155.196/prison/universal.php?user='.$id.'&key='.$key.'&method=guild.leave');  
	$msg = json_decode($url);
	$msg1 = $msg->{'code'};
	
echo '<div class="ok sma"> 
<center>';?><?switch($msg1){
case 2: 
echo"<font color=blue>id$id </font><font color=red>Фейк не в бригаде « $id »</font>"; 
break; 
case 0: 
echo"<font color=red>id$id <font><font color=green>Вышли из бригады « $id »</font>"; 
break;
case 3: 
echo"<font color=blue>id$id </font><font color=red>Завершите делюги в бригаде</font>"; 
break; 
default: echo"Неизвестная ошибка #$msg1";};?><?echo '</center></div><br>';}}
?>
<? //Кнопка очитить результаты +
if ($_POST['baz'] != "" ){echo '<center><a href="?"><button style="height: 30;width: 140;"> Убрать результаты </button></a></center>';}
elseif ($_POST['baz11'] != ""){echo '<center><a href="?act=vxod"><button style="height: 30;width: 140;"> Убрать результаты </button></a></center>';}
elseif ($_POST['baz2'] != ""){echo '<center><a href="?act=vixod"><button style="height: 30;width: 140;"> Убрать результаты </button></a></center>';}
?>
<?//Баррикадируем здания
error_reporting(0);
set_time_limit(0); 
if($_POST['3da'] == "Баррикадировать")
{
$idl = $_POST['idl'];
$idp = $_POST['idp'];
$f = $_POST['fake'];

foreach (explode("\n", $f) as $fake)
{list($id,$key) = explode(':',trim($fake));

$url = 'http://109.234.155.196/prison/universal.php?user='.$id.'&key='.$key.'&spell='.$idp.'&node='.$idl.'&amount=1&method=guild.useDungeonDefenseSpell'; 
    $ch=curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $r=curl_exec($ch);
    curl_close($ch);
    $arr = json_decode($r,true);
    $idb=$arr['code']; // Имя в вконтакте

echo '<div class="ok sma"> 
<center>';
switch($idb){
case '0': 
echo"<font color=red>Успешно</font> <font color=green>« $id »</font>"; 
break;
case '5': 
echo"<font color=red>Не в бригаде</font> <font color=green>« $id »</font>"; 
break;
case '6': 
echo"<font color=red>Это здание уже укреплено</font> <font color=green>« $id »</font>"; 
break;
case '8': 
echo"<font color=red>Не в том лагере или лагерь не доступен</font> <font color=green>« $id »</font>"; 
break;
case '13': 
echo"<font color=red>Перезарядка</font> <font color=green>« $id »</font>"; 
break;
default: echo"<font color=red>Не известная ошибка</font><font color=green>№« $idb »</font> <font color=pink>ID« $id »</font>";};?>
<?echo '</font></center></div><br>';}}
?>
<!--PHP-->

<!--HTML-->
<div id="cont"><center>
<center><!--Узнать ID бригады + -->
<?if($_GET['act']==""){?>
<span id="check1" style="font-family:comic sans ms,cursive;color: #FF0A0A;cursor: context-menu;">Узнать ID бригады</span>
<div class="check sma"> 
<form method=POST>
<font>Введите Адрес бригады</font><br>
http://vk.com/prisongame#<input type="text" name="adr" style="height: 30;width: 425;"><br>
<textarea name="fake" maxlength="53" rows="10" style="resize:none;width:40%;"></textarea><br>
<input type="submit" name="baz" value="Получить ID" style="height: 30;width: 90;">
</form>
</div><?}?>
</center>

<center><!--Заявки в бригаду с фейков + -->
<?if($_GET['act']=="vxod"){?>
<span id="check2" style="font-family:comic sans ms,cursive;color: #FF0A0A;cursor: context-menu;">Заявки в бригаду с фейков</span>
<div class="check sma"> 
<form method=POST>
Цифровой ID бригады:<input type="text" value="<?if($cook != ''){echo "$cook";}?>" name="idbri" style="height: 30;width: 360;">
<input type="submit" name="save" value="Запомнить" style="width: 90;"><br>
<textarea name="fake" maxlength="950" rows="10" style="resize:none;width:40%;"></textarea><br>
<input type="submit" name="baz11" value="Подать заявки" style="width: 100;">
</form>
</div><?}?>
</center>

<center><!--Массовый выход из бригад + -->
<?if($_GET['act']=="vixod"){?>
<span id="nik1" style="font-family:comic sans ms,cursive;color: #FF0A0A;cursor: context-menu;">Массовый выход из бригад</span>
<div class="smen sma">  
<form method=POST>
<textarea name="fake" maxlength="950" rows="10" style="resize:none;width:40%;"></textarea><br>
<input type="submit" name="baz2" value="Выйти из бригад" style="width: 110;">
</form>
</div><?}?>
</center>

<center><!--Баррикадируем здания + -->
<?if($_GET['act']=="3da"){?>
<span id="check1" style="font-family:comic sans ms,cursive;color: #FF0A0A;cursor: context-menu;">Баррикадируем здания в лагерях с фейков</span>
<div class="check sma"> 
<form method=POST>
<font>Лагерь:</font><br>
<select name="idl">
<option value="1">Тройка [КПП]</option>
<option value="2">Тройка [Восточная вышка]</option>
<option value="3">Тройка [Лазарет]</option>
<option value="4">Тройка [Прачка]</option>
<option value="5">Тройка [Блок 1]</option>
<option value="6">Тройка [Западная вышка]</option>
<option value="7">Тройка [Котельная]</option>
<option value="8">Тройка [Столовая]</option>
<option value="9">Тройка [Блок 2]</option>
<option value="10">Тройка [Административный корпус]</option>
<option disabled="">Копейка</option>
<option value="11">Копейка [Проходная]</option>
<option value="12">Копейка [Пищеблок]</option>
<option value="13">Копейка [Вышка]</option>
<option value="14">Копейка [Барак 3]</option>
<option value="15">Копейка [Цех]</option>
<option value="16">Копейка [Барак 2]</option>
<option value="17">Копейка [Морг]</option>
<option value="18">Копейка [Карцер]</option>
<option value="19">Копейка [Барак 4]</option>
<option value="20">Копейка [Корпус охраны]</option>
<option disabled="">Красная однёрка</option>
<option value="21">Красная однёрка [Барак 1]</option>
<option value="22">Красная однёрка [Медпункт]</option>
<option value="23">Красная однёрка [Барак 2]</option>
<option value="24">Красная однёрка [Вышка]</option>
<option value="25">Красная однёрка [Баня]</option>
<option value="26">Красная однёрка [Барак 3]</option>
<option value="27">Красная однёрка [Корпус А]</option>
<option value="28">Красная однёрка [Библиотека]</option>
<option value="29">Красная однёрка [Прачка]</option>
<option value="30">Красная однёрка [Теплотрасса]</option>
<option value="31">Красная однёрка [Карцер]</option>
<option value="32">Красная однёрка [Хозблок]</option>
<option value="33">Красная однёрка [Администрация]</option>
<option disabled="">Полярная сова</option>
<option value="68">Полярная сова [Проходная]</option>
<option value="69">Полярная сова [Хозблок]</option>
<option value="70">Полярная сова [Склад]</option>
<option value="71">Полярная сова [Гардероб]</option>
<option value="72">Полярная сова [Западный барак]</option>
<option value="73">Полярная сова [Барак 2]</option>
<option value="74">Полярная сова [Заброшенный барак]</option>
<option value="75">Полярная сова [Барак у дороги]</option>
<option value="76">Полярная сова [Барак 5]</option>
<option value="77">Полярная сова [Барак 6]</option>
<option value="78">Полярная сова [Центровой барак]</option>
<option value="79">Полярная сова [Барак УДОшников]</option>
<option value="80">Полярная сова [Баня]</option>
<option value="81">Полярная сова [Актовый зал]</option>
<option value="82">Полярная сова [Столярка]</option>
<option value="83">Полярная сова [Слесарка]</option>
<option value="84">Полярная сова [Пищеблок]</option>
<option value="85">Полярная сова [Цеха]</option>
<option value="86">Полярная сова [Медсанчасть]</option>
<option value="87">Полярная сова [Западная вышка]</option>
<option value="88">Полярная сова [Восточная вышка]</option>
<option value="89">Полярная сова [Управление лагеря]</option>
<option disabled="">Чёрный беркут</option>
<option value="90">Чёрный беркут [Охрана]</option>
<option value="91">Чёрный беркут [Раздевалка]</option>
<option value="92">Чёрный беркут [Канцелярия]</option>
<option value="93">Чёрный беркут [Щитовая]</option>
<option value="94">Чёрный беркут [Барак №1]</option>
<option value="95">Чёрный беркут [Барак №2]</option>
<option value="96">Чёрный беркут [Барак №3]</option>
<option value="97">Чёрный беркут [Барак №4]</option>
<option value="98">Чёрный беркут [Складское помещение]</option>
<option value="99">Чёрный беркут [Карцер]</option>
<option value="100">Чёрный беркут [Котельная]</option>
<option value="101">Чёрный беркут [Брак УДОшников]</option>
<option value="102">Чёрный беркут [Морг]</option>
<option value="103">Чёрный беркут [Баня]</option>
<option value="104">Чёрный беркут [Актовый зал]</option>
<option value="105">Чёрный беркут [Столярка]</option>
<option value="106">Чёрный беркут [Музей]</option>
<option value="107">Чёрный беркут [Склад столярки]</option>
<option value="108">Чёрный беркут [Пищеблок]</option>
<option value="109">Чёрный беркут [Лазарет]</option>
<option value="110">Чёрный беркут [Северный пищеблок]</option>
<option value="111">Чёрный беркут [Медсанчасть]</option>
<option value="112">Чёрный беркут [Наблюдательный пункт]</option>
<option value="113">Чёрный беркут [Блок охраны]</option>
<option value="114">Чёрный беркут [Корпус администрации]</option>
<option disabled="">Тулун</option>
<option value="115">Тулун [КПП]</option>
<option value="116">Тулун [Наблюдательный пункт]</option>
<option value="117">Тулун [Блок охраны]</option>
<option value="118">Тулун [Цеха]</option>
<option value="119">Тулун [Центровой барак]</option>
<option value="120">Тулун [Склад]</option>
<option value="121">Тулун [Котельная]</option>
<option value="122">Тулун [Барак №1]</option>
<option value="123">Тулун [Барак №2]</option>
<option value="124">Тулун [Арсенал]</option>
<option value="125">Тулун [Западная вышка]</option>
<option value="126">Тулун [Восточная вышка]</option>
<option value="127">Тулун [Столовка]</option>
<option value="128">Тулун [Барак №3]</option>
<option value="129">Тулун [Столярка]</option>
<option value="130">Тулун [Барак №4]</option>
<option value="131">Тулун [Северная вышка]</option>
<option value="132">Тулун [Барак УДОшников]</option>
<option value="133">Тулун [Актовый зал]</option>
<option value="134">Тулун [Баня]</option>
<option value="135">Тулун [Корпус Администрации]</option>
</select>
<br>
<font>Что делать:</font><br>
<select name="idp">
<option value="1">Кинуть мешок [FREE]</option>
<option value="2">Вбить брусок [FREE]</option>
<option value="3">Принести матрац</option>
<option value="4">Растянуть колючку</option>
<option value="5">Воткнуть арматуру</option></select><br>
<textarea name="fake" maxlength="950" rows="10" style="resize:none;width:40%;"></textarea><br>
<input type="submit" name="3da" value="Баррикадировать" style="height: 30;width: 130;">
</form>
</div><?}?>
</center>

</div>

<div class="nav" style="background: #C0D7FF;"> 
<center><font color="red">Вставлять не больше 10 фейков</font></center>
</div>
</body>
</html>