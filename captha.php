<?php 	
session_start(); 	
$randomnr = rand(1000, 9999); 	// создаем случайное число и сохраняем в сессии 
$_SESSION['randomnr2'] = md5($randomnr); 		
setcookie('randomnr2',  md5($randomnr)); 

$im = imagecreatetruecolor(160, 38); 	//создаем изображение 

$white = imagecolorallocate($im, 0, 0, 255); 	//цвета:

$grey = imagecolorallocate($im, 255, 128, 128); 	

$black = imagecolorallocate($im, 255, 255, 255); 	//фон

imagefilledrectangle($im, 0, 0, 200, 38, $black); 		


$font = 'other/HACKED.ttf'; 	//рисуем текст: 	//путь к шрифту: 
imagettftext($im, 27, 2, 50, 30, $grey, $font, $randomnr); 	
imagettftext($im, 27, 3, 45, 32, $white, $font, $randomnr); 


header("Expires: Wed, 1 Jan 1997 00:00:00 GMT"); // предотвращаем кэширование на стороне пользователя 
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-store, no-cache, must-revalidate"); 
header("Cache-Control: post-check=0, pre-check=0", false); 
header("Pragma: no-cache"); 	//отсылаем изображение браузеру 
header ("Content-type: image/gif"); 	
imagegif($im); 	
imagedestroy($im);
 ?>