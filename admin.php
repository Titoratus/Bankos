<?

		//mysql_connect("localhost","ulnyezxl_bk","Bankos123") or die(mysql_error());
		mysql_select_db("ulnyezxl_bk") or die("Could not select database");
		mysql_query("SET CHARACTER SET 'utf8'");
		mysql_query("SET NAMES utf8");
			if (isset($_POST['enter_2'])){
			$fp = "fakes.txt"; // Название файла .txt (Стандартно стоит token.txt)
			$ff = file($fp);
			while (list($key, $value) = each($ff)) { 
			list($a, $z) = explode(':', $value);
			echo "$a, $z </br>";
			
			$query = "INSERT INTO auth (`id`, `auth`, `k`) VALUES ('$a','$z', '');";
			$sort=@mysql_query($query) or die ("$query"); 
		}
			}
			
	print "	<form method='post' enctype='multipart/form-data'>
			<input type='submit' name='enter_2' value='Загрузить' /></p>
			</form>"; 
	
	/* for ($i=0; $i < 2; $i++){
$get = file_get_contents('http://109.234.156.253/prison/universal.php?method=gifts.send&key=336bf472a16d584204bb9585cb800f2d&recipient=137372667&user=140405188&method=gifts%2Esend&gift=2&sig=c13cbec31d3de800cc68a46e87672a57'); 
	 echo $get.'АВТО ВИТАЛЕ</br>';	
	}
	for ($k=0; $k < 2; $k++){
$get = file_get_contents('http://109.234.156.253/prison/universal.php?method=gifts.send&key=32a12fc617fa12c127b6941b193a7d74&msg=231&recipient=137372667&user=225619605&method=gifts%2Esend&sig=6b8c855d11864e0022552dfdddee9a39&gift=6');
echo $get.' БЛАТНАЯ ВИТАЛЕ</br>';	
	}
	for ($l=0; $l < 4; $l++){
	$get = file_get_contents('http://109.234.156.253/prison/universal.php?method=gifts.send&key='.$auth.'&msg=&recipient='.$id.'&user='.$uid.'&method=gifts%2Esend&sig=947a8e70ca6ef53307afadd86e644d19&gift=2');
	echo $get.'  ПАЦАНСКАЯ ВИТАЛЕ</br>';	
	} */
?> 
<?php
$key = '05f2a325ccfd9d40a3b6f315a5f0beb1';
$id  = '137372667';
$user = '301137590';
#$get = file_get_contents("http://109.234.156.251/prison/universal.php?key=$key&recipient=$id&msg'Prison-fakes.ru'=&user=$user&gift=6&method=gifts%2Esend");
for ($i=1; $i <= 3; $i++){
$get = file_get_contents("http://109.234.156.251/prison/universal.php?key=05f2a325ccfd9d40a3b6f315a5f0beb1&gift=6&msg=Prison%2Dfakes%2Eru&sig=9f26683ad7eb66802b6012e9f7dda558&recipient=137372667&user=301137590&method=gifts%2Esend");
echo $get."<br>";
}
?>