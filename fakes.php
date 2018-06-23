<!DOCTYPE html>
<?
session_start();
$fakeID = "99714846";
$fakeAuth = "c0b31038e52b43db242b4e30d8b9b7f0";

$rating = "50000"; //сколько нужно авторитета
?>
<html>
<head>
	<link rel="stylesheet" href="css/style.css" media="screen" type="text/css" />
</head>
<body>
	<?include "head_menu.php";?>
	<?
	include('bd2.php');
	?>
     	<font color='red'><b>Автоматическое обновление базы! Теперь  <b><?=count(file('fakes1.php'));?></b> фейка(ов).</b></font>
		<section class="fakes">
		<h1>Список доступных фейков [<?=count(file('fakes.txt'));?>]</h1>
		<textarea><?include_once("fakes.txt");?></textarea>
		<?php 
		$temp = "SELECT COUNT(*) FROM auto"; 
		$res = mysql_query($temp);  
		$rows = mysql_fetch_array($res); 
		mysql_close();

		// echo $_SESSION['randomnr2'];
		?>
		<? //phpinfo();?>
	</section>
</body>
</html>