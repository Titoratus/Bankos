<?
include_once("classDelug.php");
if(isset($_POST['oper'])){
	if(!empty($_POST['id']) && !empty($_POST['key']) && !empty($_POST['count'])){
		if($_POST['count'] < 99 && $_POST['count'] > null){
			if($_POST['oper'] == "Отправка нычек"){$s = ni4($_POST['id'],$_POST['key'],$_POST['count']); $echo[] = "Отправлено: $s нычек";}
			if($_POST['oper'] == "Прокачка бицухи"){$s = biz($_POST['id'],$_POST['key'],$_POST['count']); $echo[] = "Прокачал: $s раз";}
			if($_POST['oper'] == "Харчки в баланду"){$s = harch($_POST['id'],$_POST['key'],$_POST['count']); $echo[] = "Харкнул: $s раз";}
			if($_POST['oper'] == "Подкинуть дрожей"){$s = droje($_POST['id'],$_POST['key'],$_POST['count']); $echo[] = "Подкинул: $s раз";}
			if($_POST['oper'] == "Наезд на корешей"){$s = napast($_POST['id'],$_POST['key'],$_POST['count']); $echo[] = "Наехал: $s раз";}
		}else{$echo[] = "Кол-во не может превышать 99";}
	}else{$echo[] = "Введите данные";}
}
if(isset($_POST['save'])){setcookie("tid", $_POST['id']); setcookie("tkey", $_POST['key']);header("Location: index.php");}
?>
<!doctype html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<title>Test</title>
</head>
<body>
	<center>
	<?if($echo){echo $echo[0]."<br>\n";}?>
		<form method=post>
		<input type="submit" name="save" value="Сохранить ID и Auth"><br><hr>
			ID:<input name="id" type="text" value="<?=$_COOKIE['tid'];?>"><br>
			Auth:<input name="key" type="text" value="<?=$_COOKIE['tkey'];?>"><br>
			Кол-во:<input type="number" name="count" maxlength="2" style="width: 30px;"><hr>
			<input type="submit" name="oper" value="Отправка нычек"><br><br>
			<input type="submit" name="oper" value="Прокачка бицухи"><br><br>
			<input type="submit" name="oper" value="Харчки в баланду"><br><br>
			<input type="submit" name="oper" value="Подкинуть дрожей"><br><br>
			<input type="submit" name="oper" value="Наезд на корешей"><hr>
		</form>
	</center>
</body>
</html>