<?
function cleans($value) { //проверка кода 
$value = trim($value); 
$value = stripslashes($value); 
$value = strip_tags($value); 
$value = htmlspecialchars($value); 

return $value; 
}

$id = cleans($_COOKIE['id']);
$auth = cleans($_COOKIE['auth']);

if($id != null && $auth != null){
	$urls = file_get_contents('http://109.234.156.251/prison/universal.php?user='.$id.'&key='.$auth);
	preg_match("#<result>(.*?)</result>#",$urls,$match); 
	$result = $match[1];

	if($result == '0'){
		setcookie('id', null);
		setcookie('auth', null);
		header("Location: index.php");
	}
}
?>