<?php
include_once ("../bd2.php");
$id = trim($_POST["id"]);
$key = trim($_POST["key"]);
$version = trim($_POST["version"]);
$method = trim($_POST["method"]);
$arr = array();

$superkey = md5($id.'n7t941212v9080'.$id);
if($key == $superkey){
	
	if($method == 'add'){
		$result = mysql_query("SELECT id, version FROM `vlk` WHERE id='$id'"); 
		$myrow = mysql_fetch_array($result);
		
		if(!empty($myrow['id'])){
			if($myrow['version'] != $version){
				$query1 = "UPDATE `vlk` SET `version`='{$version}' WHERE id='{$id}'";
				$query1 = mysql_query($query1) or die("Ошибка, смотрите код 2");
				echo "Обновление версии прошло успешно #1";
			}else{
				echo "Версия соответствует";
			}
		}else{
			$query1 = "INSERT INTO `vlk` (`id`, `version`) VALUES ('$id','$version')";
			//var_dump($query);
			$query = mysql_query($query1) or die("Ошибка, смотрите код 1");
			echo "Добавлен";
		}
	}
}else{
	$arr = array(
	'version' => '18.2.7'
	);
	// SELECT COUNT(*) FROM `vlk` WHERE length(id) > 15 //длина id больше 15
	$limited = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM vlk")); 
	$count_mail = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM `vlk` WHERE length(id) > 14"));
	$count_new = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM `vlk` WHERE version = \"{$arr['version']}\"")); 
	$arr += array(
	'count' =>$limited[0],
	'new_count' =>$count_new[0],
	'count_mail' =>$count_mail[0],
	'link' => 'http://bankos.tk/vlk.php',
	'link2' => 'https://yadi.sk/d/t0tRCMql3SWxxp',
	'unban' => array('132942251'),
	'desc'=> '1) Всякие доработки (18.2.7)
2) Вывод золота и соло на боссах(18.2.7)
3) Выделить не собраных боссов(18.2.7)
4) Купить делюгу(18.2.7)
5) Отправка N кол-ва нычек разным друзьям(18.2.7)
6) Автополучение токена(18.2.7)
7) Слив спичек в покере(18.2.7)
8) При загрузке людей можно пропускать тех с кем меньше N общих друзей(18.2.7)
	
Чем больше пожервований тем больше настроения обновлять кряк
============================
Если есть лишняя копеечка можете пожертвовать
https://qiwi.me/rzn_fantik
============================
О доработках и по вопросам пишите в ВК');
// echo "<pre>";
// print_r($arr);
// echo "</pre>";
	echo json_encode($arr, true);
}

?>