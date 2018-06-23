<!doctype html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Чекер</title>
	<link rel="stylesheet" href="css/style.css" media="screen" type="text/css" />
</head>
<body>
	<?php include ("head_menu.php");?>
	<?php
	if(!empty($_POST["fakes"])){
		if(iconv_strlen($_POST["fakes"]) < 950 && iconv_strlen($_POST["fakes"]) > 30){
			$f = $_POST['fakes'];
			include "mobile/function.php";
			echo '<table class="check">
				<tbody>';

					foreach (explode("\n", $f) as $fake){
						list($id,$key) = explode(':',trim($fake));
						$url = file_get_contents('http://109.234.155.196/prison/universal.php?user='.$id.'&key='.$key.'&method=getInfo'); 

						preg_match_all("#<rating>(.*?)</rating>#",$url,$matches);
		$ratin = $matches[1][0]; //авторитет
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
		
		//посылки
		preg_match_all('#<category id="1">(.*?)</category>#',$url,$matches);
		$pac_pos = $matches[1][0]; //пацанская
		preg_match_all('#<category id="2">(.*?)</category>#',$url,$matches);
		$blat_pos = $matches[1][0]; //блатная
		preg_match_all('#<category id="3">(.*?)</category>#',$url,$matches);
		$avto_pos = $matches[1][0]; //авторитетная
		//посылки
		//матрасы и колючки
		preg_match_all('#<spell spell="3">(.*?)</spell>#',$url,$matches);
		$matrac = $matches[1][0]; //матрасы
		preg_match_all('#<spell spell="4">(.*?)</spell>#',$url,$matches);
		$koluch = $matches[1][0]; //колючка
		
		//матрасы и колючки
		
		//pars оружия
		preg_match_all('#<spell id="4">(.*?)</spell>#',$url,$matches);
		$yad = $matches[1][0]; //яд
		preg_match_all('#<spell id="5">(.*?)</spell>#',$url,$matches);
		$sam = $matches[1][0]; //самопал
		preg_match_all('#<spell id="6">(.*?)</spell>#',$url,$matches);
		$fin = $matches[1][0]; //финки
		//pars оружия
		$ni4ki = nich($url); //Нычки
		if($ratin != null){
			echo '<tr><th colspan="18">'.$id.':'.$key.'</th></tr>
			<tr>
			<td style="background-image: url(/images/001.png)">'.$ratin.'</td>
			<td style="background-image: url(/images/003.png)">'.$diamond.'</td>
			<td style="background-image: url(/images/004.png)">'.$toilet_paper.'</td>
			<td style="background-image: url(/images/006.png)">'.$soap.'</td>
			<td style="background-image: url(/images/008.png)">'.$milk.'</td>
			<td style="background-image: url(/images/010.png)">'.$pac_pos.'</td>
			<td style="background-image: url(/images/011.png)">'.$blat_pos.'</td>
			<td style="background-image: url(/images/012.png)">'.$avto_pos.'</td>
			<td style="background-image: url(/images/014.png)">'.$fin.'</td>
			<td style="background-image: url(/images/015.png)">'.$sam.'</td>
			<td style="background-image: url(/images/016.png)">'.$yad.'</td>
			<td style="background-image: url(/images/matrac.png)">'.$matrac.'</td>
			<td style="background-image: url(/images/koluch.png)">'.$koluch.'</td>
			<td style="background-image: url(/images/017.png)">'.$ni4ki.'</td>
			<td style="background-image: url(/images/red_s.png)">'.$red.'</td>
			<td style="background-image: url(/images/pink_s.png)">'.$pink.'</td>
			<td style="background-image: url(/images/green_s.png)">'.$gamefor.'</td>
			<td style="background-image: url(/images/talents.png)">'.$playerTalentPoints.'</td>
		</tr>';
	}
	else{
		echo '<div class="ok sma"><div style="text-align: center;">'.$id.':Не валидный фейк</div></div>';
	}
}
echo '</tbody></table>';
}}	
?>
<div class="form_wrap">
	<form id="checker" method="POST">
		<textarea name="fakes" rows="20" cols="65"></textarea>
		<input type="submit" value="Чекнуть">
	</form>
</div>
</body>
</html>