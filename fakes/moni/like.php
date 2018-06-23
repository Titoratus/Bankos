<?php
include("../config.php");
function vk_auth($id){
    $api_id = "5483293";
    $viewer_id = $id;;
    $api_secret = "dn8g1Xcv6AyAL8dS3Uec";
    $auth_key = md5($api_id.'_'.$viewer_id.'_'.$api_secret);
    return $auth_key;
}
if(vk_auth(trim($_POST['uid'])) != $_POST['auth_key']){die('Не верный auth_key');}

/** Данные для подключения к Базе Данных */
$host = $db_ip;
$database = $db_base;
$user = $db_user;
$password = $db_password;

/** Подключаемся в Базе Данных */
$pdo = new PDO('mysql:host='. $host .';dbname='.$database.';charset=utf8', $user, $password);
$pdo->exec("SET NAMES utf8");

/** Получаем наш ID статьи из запроса */
$id = intval($_POST['id']);
$uid = trim($_POST['uid']);
$count = 0;
$message = '';
$error = true;

$getu = file_get_contents("https://api.vk.com/method/users.get?user_ids=$uid");
$res = json_decode($getu,true);
$resvk =  $res["response"]['0']["deactivated"];
if($uid =='' || $resvk== 'deleted' || $resvk == 'banned'){die ('Зайдите через вк');}

@mysql_connect($host,$user,$password); // коннект с сервером бд
@mysql_select_db($database); // выбор бд
$result=mysql_query("SELECT user_vote FROM moni WHERE id = $id"); // запрос на выборку
$row=mysql_fetch_array($result)['user_vote'];

/*$query = $pdo->prepare("UPDATE moni SET rate = rate+1, user_vote=CONCAT( `user_vote`, ',22' )  WHERE id = 7");*/

if(stristr($row, $uid) === FALSE) {
    $yea = 1;
  }else{$yea = 0;}
/** Если нам передали ID то обновляем  UPDATE moni SET rate = rate+1, user_vote=CONCAT( `user_vote`, ',555' )  WHERE id = 7 */
if($id || $uid){
    if($yea == 1){
	/** Обновляем количество лайков в статье */
	$query = $pdo->prepare("UPDATE moni SET user_vote=CONCAT( `user_vote`, ',$uid' )  WHERE id = :id");
	$query->execute(array(':id'=>$id));
	$query = $pdo->prepare("UPDATE moni SET rate = rate+1  WHERE id = :id");
	$query->execute(array(':id'=>$id));
	
	/** Выбираем количество лайков в статье */
	$query = $pdo->prepare("SELECT rate FROM moni WHERE id = :id");
	$query->execute(array(':id'=>$id));
	$result = $query->fetch(PDO::FETCH_ASSOC);
	$count = isset($result['rate']) ? $result['rate']  : 0;
	
	$error = false;
    }else{$message = 'Вы уже голосовали'; unset ($yea);}
}else{
	/** Если ID пуст - возвращаем ошибку */
	$error = true;
	$message = 'Статья не найдена';
}
/** Возвращаем ответ скрипту */
// Формируем масив данных для отправки
$out = array(
	'error' => $error,
	'message' => $message,
	'count' => $count,
);
// Устанавливаем заголовот ответа в формате json
header('Content-Type: text/json; charset=utf-8');
// Кодируем данные в формат json и отправляем
echo json_encode($out);

