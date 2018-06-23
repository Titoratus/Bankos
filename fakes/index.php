<?//боссы по порядку обновлений игры и их ХП лень парсить
$bosses = array('Не известный','Кирпич','Сизый','Махно','Лютый','Шайба','Палыч','Циклоп','Бес','Паленый','Борзов','Хирург','Раиса','Близнецы','Бурят','Дюбель','Дядя Миша','Жестянщики','Отбой','Бугор','Боцман','Жульбаны','Цербер','Пресс','Гастролер','Ташкент','Конвой','Бандяк','Бульдозер','Контрабас','Воркута','Крест','Север','Шнифер','Гризли','Бивень','Кусто','Феня','Крюгер','Карло','Мазай','Фин','Мезен','Ёхан','Чебот','Абу','Дантист','Бельмондо','Немой','Чугун','Змей','Шмель','Старшой', "Бидон", "Шизо", "Кнут",'Зубр','Мельдоний','Борисыч','Полтос','Атас','Думский');
?>
<html>
<head>
<style><!--Стили-->
input[type="submit"]{height: 30px;}
button{height: 30px;}
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
<!--Навигация-->
<nav class="navbar navbar-default" role="navigation">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <a class="navbar-brand" href="#">Ченжер</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li <?if ($_GET['act']!='nik'){if ($_GET['act']!='check2'){if ($_GET['act']!='baz'){if ($_GET['act']!='sig'){if ($_GET['act']!='tyal'){if ($_GET['act']!='bord'){echo 'class="active"';}}}}}}?>><a href="index.php">Чекер</a></li>
        <li <?if ($_GET['act']=='check2'){echo 'class="active"';}?>><a href="?act=check2">Чекер состояния боя</a></li>
        <li <?if ($_GET['act']=='nik'){echo 'class="active"';}?>><a href="?act=nik">Смена ника</a></li>
        <li <?if ($_GET['act']=='baz'){echo 'class="active"';}?>><a href="?act=baz">Смена базара</a></li>
        <li <?if ($_GET['act']=='sig'){echo 'class="active"';}?>><a href="?act=sig">Сбор сиг</a></li>
        <li <?if ($_GET['act']=='tyal'){echo 'class="active"';}?>><a href="?act=tyal">Сбор туалетки</a></li>
        <li <?if ($_GET['act']=='bord'){echo 'class="active"';}?>><a href="?act=bord">Брить бороду</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
          <li><a href="menu.php">Меню</a></li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">Помощь <span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu">
            <li><a target="_blank" href="http://vk.com/id132942251">Связь с создателем</a></li>
          </ul>
        </li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>

<br><!---->
<div style="text-align: center;"><!--Навигация-->
<div class="nav1 sma" style="margin: -5px;">
<a href="brigada.php">
<button>Работа с бригадами</button>
</a>
</div>
</div><br>
<!--PHP-->

<?
include_once('config.php');
?>

<? //Чекер
error_reporting(0);
set_time_limit(0); 
if($_POST['baz'] == "Чекнуть")
{
$f = $_POST['fake'];

foreach (explode("\n", $f) as $fake)
{list($id,$key) = explode(':',trim($fake));

$url = file_get_contents('http://109.234.155.196/prison/universal.php?user='.$id.'&key='.$key.'&method=getInfo'); 
	preg_match_all("#<rating>(.*?)</rating>#",$url,$matches);
    $ratin = $matches[1][0]; //авторитет
    $rating = number_format($ratin); //авторитет
	preg_match_all("#<money>(.*?)</money>#",$url,$matches);
    $money = $matches[1][0];  // папиросы
	preg_match_all("#<basePopularity>(.*?)</basePopularity>#",$url,$matches);
    $basePopularity = $matches[1][0]; // бицуха
	preg_match_all("#<diamond>(.*?)</diamond>#",$url,$matches);
    $diamond = $matches[1][0]; //рубли
	preg_match_all("#<toilet_paper>(.*?)</toilet_paper>#",$url,$matches);
    $toilet_paper = $matches[1][0]; // туалетка
	preg_match_all("#<soap>(.*?)</soap>#",$url,$matches);
    $soap = $matches[1][0]; //мыло
	preg_match_all("#<milk>(.*?)</milk>#",$url,$matches);
    $milk = $matches[1][0]; //сгущенка
	preg_match_all("#<playerTalentPoints>(.*?)</playerTalentPoints>#",$url,$matches);
    $playerTalentPoints = $matches[1][0]; //таланты
	preg_match_all("#<redMatchAmount>(.*?)</redMatchAmount>#",$url,$matches);
	$red = $matches[1][0];//Красные спички
	preg_match_all("#<pinkMatchAmount>(.*?)</pinkMatchAmount>#",$url,$matches);
	$pink = $matches[1][0]; //Розовые спички
	preg_match_all("#<energyTS>(.*?)</energyTS>\s*<energy>(.*?)</energy>#",$url,$matches);
	$gamefor = $matches[2][0];//Зеленые спички
	
//pars оружия
preg_match_all("#<collected_spells>\s*<spell id=\"4\">(.*?)</spell>\s*<spell id=\"5\">(.*?)</spell>\s*<spell id=\"6\">(.*?)</spell>\s*</collected_spells>#",$url,$matches);
$ror1 = $matches[1][0];
$ror2 = $matches[2][0];
$ror3 = $matches[3][0];
//pars оружия

echo '
<div class="ok sma"> 
<div style="text-align: center;">
<span style="color: black; "> ' .$id.':'.$key. ' </span>
<img src="images/001.png">' .$rating.'
<img src="images/009.png">'.$basePopularity.'
<img src="images/003.png">'.$diamond.'
<img src="images/004.png">'.$toilet_paper.'
<img src="images/006.png">'.$soap.'
<img src="images/008.png">'.$milk.'
<img src="images/014.png">'.$ror1.'
<img src="images/015.png">'.$ror2.'
<img src="images/016.png">'.$ror3.'
<img src="images/red_s.png">'.$red.'
<img src="images/pink_s.png">'.$pink.'
<img src="images/green_s.png">'.$gamefor.'
<img src="images/talents.png">'.$playerTalentPoints. '
</div>
</div><br>';
}
}
?>

<? //Чекер состояния боя
if($_POST['baz11'] == "Чекнуть")
{
$f = $_POST['fake'];

foreach (explode("\n", $f) as $fake)
{list($id,$key) = explode(':',trim($fake));

$url = file_get_contents_curl('http://109.234.155.196/prison/universal.php?user='.$id.'&key='.$key.'&method=getBoss'); 

preg_match_all("#<h_full>(.*?)</h_full>#",$url,$matches);
$bossxp = $matches[1][0]; // Сколько щас хп
preg_match_all("#<h_now>(.*?)</h_now>#",$url,$matches);
$newxp = $matches[1][0]; // Сколько щас хп
preg_match_all("#<id>(.*?)</id>#",$url,$matches);
$idb = $matches[1][0]; // id босса
preg_match_all("#<battle_time>(.*?)</battle_time>#",$url,$matches);
$timeb = $matches[1][0]; // время
preg_match_all("#<mode>(.*?)</mode>#",$url,$matches);
$mode = $matches[1][0];// mode
preg_match_all("#<battle_result>\r\n		<id>(.*?)</id>#",$get,$matches);
$namebos = $matches[1][0];// ID босса если выиграли

if($timeb != "0"){
$timebos = date("H:i:s", mktime(0, 0, $timeb));
}
	
echo '
<div class="ok sma"> 
<center>
<span style="color: black; ">ID' .$id. ' |</span>';?>
<?if($timeb != ""){echo'<font color="#6b6b6b">Босс: </font>';}?>
<?
if($endbattle){
	echo "<font color=red>Победа над ".$bosses[$endbattle]." =)";
}else{
	echo"<font color=red>$bosses[$idb]";
}
?> </font>
<?if($timeb != ""){?>
<font color="blue"><?switch($mode){case simple: echo"x1"; break; case cool: echo"x3"; break; default: "x6";};?></font> |
<font color="#6b6b6b">XP: <?echo$newxp;?>/ <?echo$bossxp;?></font> |
<font color="#6b6b6b"> Осталось времени: <?echo $timebos;?></font>
<?}elseif($timeb == "" && !$endbattle){
echo'<font color=green>Не в бою )</font>';
}
echo"</center></div><br>";}}?>

<? //Смена ника
if($_POST['baz2'] == "Сменить")
{
$n = htmlspecialchars($_POST['nik1']);
$f = $_POST['fake'];

foreach (explode("\n", $f) as $fake)
{list($id,$key) = explode(':',trim($fake));
	$url = file_get_contents('http://109.234.155.196/prison/universal.php?user='.$id.'&name='.$n.'&key='.$key.'&method=renamehouse'); 
	preg_match_all("/<result>(.*?)<\/result>/",$url,$matches);
    $result = $matches[1][0]; //code

echo '<div class="ok sma"> 
<center>';?> 
<?switch($result){case 0: echo"<font color=blue>id$id </font><font color=red>Ошибка(</font>"; break;
case 1: 
echo"<a href='http://vk.com/id$id' target='_blank'><font color=red>id$id <font></a><font color=green>Ник успешно изменен на « $n »"; 
break;
default: echo"Неизвестная ошибка";};?> <?echo '</center></div><br>';}}
?>

<? //Смена базара
if($_POST['baz3'] == "Сменить")
{
$n = htmlspecialchars($_POST['baz1']);
$f = $_POST['fake'];

foreach (explode("\n", $f) as $fake)
{list($id,$key) = explode(':',trim($fake));
	$url = file_get_contents('http://109.234.155.196/prison/universal.php?user='.$id.'&taunt='.$n.'&key='.$key.'&method=setTaunt'); 
	preg_match_all("/<msg>(.*?)<\/msg>/",$url,$matches);
    $result = $matches[1][0]; //авторитет

echo '
<div class="ok sma"> 
<center>';?> 
<?switch($result){
case ok: 
echo"<a href='http://vk.com/id$id' target='_blank'><font color=red>id$id <font></a><font color=green>Базар успешно изменен на « $n »</font>"; 
break;
default: echo"<font color=blue>id$id </font><font color=red>Базар не доступен.</font>";};?> <?echo '</center></div><br>';}}
?>

<? //Сбор сиг
if($_POST['baz4'] == "Собрать")
{
$f = $_POST['fake'];
foreach (explode("\n", $f) as $fake)
{list($id,$key) = explode(':',trim($fake));
$url = file_get_contents('http://109.234.155.196/prison/universal.php?user='.$id.'&getidea=5&key='.$key.'&method=office'); 
	preg_match_all("/<result>(.*?)<\/result>/",$url,$matches);
    $result = $matches[1][0]; //авторитет
echo '<div class="ok sma"> 
<center>';?> 
<?switch($result){
case 1: 
echo"$id <font color=green>Успешно)</font>"; 
break;
default: echo"$id <font color=red>Уже собирал.</font>";};?> <?echo '</center></div><br>';}}
?>

<? //Сбор туалетки
if($_POST['baz5'] == "Собрать")
{
$f = $_POST['fake'];
foreach (explode("\n", $f) as $fake)
{list($id,$key) = explode(':',trim($fake));
$url = file_get_contents('http://109.234.155.196/prison/universal.php?user='.$id.'&key='.$key.'&method=collectToiletPaper'); 
	preg_match_all("/<msg>(.*?)<\/msg>/",$url,$matches);
    $result = $matches[1][0]; //авторитет
echo '<div class="ok sma"> 
<center>';?> 
<?switch($result){
case ok: 
echo"$id <font color=green>Успешно)</font>"; 
break;
default: echo"$id <font color=red>Уже воровал.</font>";};?> <?echo '</center></div><br>';}}
?>

<? //Брить бороду
if($_POST['baz6'] == "Брить")
{
$f = $_POST['fake'];
foreach (explode("\n", $f) as $fake)
{list($id,$key) = explode(':',trim($fake));
$url = file_get_contents('http://109.234.155.196/prison/universal.php?user='.$id.'&key='.$key.'&method=shaveBeard'); 
	preg_match_all("/<msg>(.*?)<\/msg>/",$url,$matches);
    $result = $matches[1][0]; //авторитет
echo '<div class="ok sma"> 
<center>';?> 
<?switch($result){
case ok: 
echo"$id <font color=green>Успешно)</font>"; 
break;
default: echo"$id <font color=red>Уже брился.</font>";};?> <?echo '</center></div><br>';}}
?>

<? //кнопка убрать результаты
if ($_POST['baz'] != "" ){echo '    <center><a href="?">          <button style="height: 30px;width: 150px;">Убрать результаты</button></a></center>';}
elseif ($_POST['baz11'] != ""){echo '<center><a href="?act=check2"><button style="height: 30px;width: 150px;">Убрать результаты</button></a></center>';}
elseif ($_POST['baz2'] != ""){echo '<center><a href="?act=nik">   <button style="height: 30px;width: 150px;">Убрать результаты</button></a></center>';}
elseif ($_POST['baz3'] != ""){echo '<center><a href="?act=baz">   <button style="height: 30px;width: 150px;">Убрать результаты</button></a></center>';}
elseif ($_POST['baz4'] != ""){echo '<center><a href="?act=sig">   <button style="height: 30px;width: 150px;">Убрать результаты</button></a></center>';}
elseif ($_POST['baz5'] != ""){echo '<center><a href="?act=tyal">  <button style="height: 30px;width: 150px;">Убрать результаты</button></a></center>';}
elseif ($_POST['baz6'] != ""){echo '<center><a href="?act=bord">  <button style="height: 30px;width: 150px;">Убрать результаты</button></a></center>';}
?>

<!--PHP-->

<!--HTML-->
<div id="cont"><center>
<center><!--Чекер-->
<?if($_GET['act']==""){?>
<span id="check1" style="font-family:comic sans ms,cursive;color: #FF0A0A;cursor: context-menu;">Чекер</span>
<div class="check sma"> 
<form method=POST>
<textarea name="fake" maxlength="950" rows="10" style="resize:none;width:40%;"></textarea><br>
<input type="submit" name="baz" value="Чекнуть" style="height: 30px;width: 90px;">
</form>
</div><?}?>
</center>

<center><!--Чекер состояния боя-->
<?if($_GET['act']=="check2"){?>
<span id="check2" style="font-family:comic sans ms,cursive;color: #FF0A0A;cursor: context-menu;">Чекер состояния боя</span>
<div class="check sma"> 
<form method=POST>
<textarea name="fake" maxlength="950" rows="10" style="resize:none;width:40%;"></textarea><br>
<input type="submit" name="baz11" value="Чекнуть" style="width: 90px;">
</form>
</div><?}?>
</center>

<center><!--Смена ника-->
<?if($_GET['act']=="nik"){?>
<span id="nik1" style="font-family:comic sans ms,cursive;color: #FF0A0A;cursor: context-menu;">Смена ника</span>
<div class="smen sma">  
<form method=POST>
Ваш текст: <input type="text" name="nik1" style="height: 30;width: 425;"><br>
<textarea name="fake" maxlength="950" rows="10" style="resize:none;width:40%;"></textarea><br>
<input type="submit" name="baz2" value="Сменить" style="width: 90;">
</form>
</div><?}?>
</center>

<center><!--Смена базара-->
<?if($_GET['act']=="baz"){?>
<span id="baz1" style="font-family:comic sans ms,cursive;color: #FF0A0A;cursor: context-menu;">Смена базара</span>
<div class="smen sma">  
<form method=POST>
Ваш текст: <input type="text" name="baz1" style="height: 30;width: 425;" /><br>
<textarea name="fake" maxlength="950" rows="10" style="resize:none;width:40%;"></textarea><br>
<input type="submit" name="baz3" value="Сменить" style="width: 90;">
</form>
</div><?}?>
</center>

<center><!--Сбор сиг-->
<?if($_GET['act']=="sig"){?>
<span id="sig1" style="font-family:comic sans ms,cursive;color: #FF0A0A;cursor: context-menu;">Сбор сиг</span>
<div class="sbor sma"> 
<form method=POST>
<textarea name="fake" maxlength="950" rows="10" style="resize:none;width:40%;"></textarea><br>
<input type="submit" name="baz4" value="Собрать" style="width: 90px;">
</form>
</div><?}?>
</center>

<center><!--Сбор туалетки-->
<?if($_GET['act']=="tyal"){?>
<span id="tyal1" style="font-family:comic sans ms,cursive;color: #FF0A0A;cursor: context-menu;">Сбор туалетки</span>
<div class="sbor sma"> 
<form method=POST>
<textarea name="fake" maxlength="950" rows="10" style="resize:none;width:40%;"></textarea><br>
<input type="submit" name="baz5" value="Собрать" style="width: 90px;">
</form>
</div><?}?>
</center>

<center><!--Брить бороду-->
<?if($_GET['act']=="bord"){?>
<span id="bord1" style="font-family:comic sans ms,cursive;color: #FF0A0A;cursor: context-menu;">Брить бороду</span>
<div class="bri sma"> 
<form method=POST>
<textarea name="fake" maxlength="950" rows="10" style="resize:none;width:40%;"></textarea><br>
<input type="submit" name="baz6" value="Брить" style="width: 90px;">
</form>
</div><?}?>
</center>

</div>
<div class="nav" style="background: #C0D7FF;"> 
<center><font color="red">Вставлять не больше 20 фейков</font></center>
<div>
</body>
</html>