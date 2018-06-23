<?php
function file_get_contents_curl($url) {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_ENCODING, "gzip");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_REFERER, true);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
    curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; SV1; .NET CLR 1.0.3705; .NET CLR 1.1.4322)');
    $data = curl_exec($ch);
    curl_close($ch);
    return $data;
}

$so = file_get_contents_curl("http://prison-fakes.ru/free.php");
preg_match_all("#<br><b>(.*?)</b></p>#", $so, $mat);
$timefake = $mat[1][0];
preg_match("#$timefake#",file_get_contents("../fakes1.php"),$ma);
if($ma != null){
    echo 'уже есть ';
}else{
	list($id, $auth) = explode(':',trim($timefake));
	$get = file_get_contents_curl('http://109.234.156.251/prison/universal.php?key='.$auth.'&user='.$id);
	preg_match('#<result>(.*?)</result>#',$get,$result);
	
	if(!isset($result[1])){
		$fp = fopen("../fakes1.php", "a"); // Открываем файл в режиме записи
		$test = fwrite($fp, "\n" . "$timefake"); // Запись в файл
		$fp1 = fopen("../fakes.txt", "a"); // Открываем файл в режиме записи
		$test = fwrite($fp1, "\n" . "$timefake"); // Запись в файл
		
		echo "Добавленно"; 
		fclose($fp); //Закрытие файла
		fclose($fp1); //Закрытие файла
	}
}
?>