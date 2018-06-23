<?
$id = $_POST['id'];
$auth = $_POST['key'];

function nich($get){
    $xml = simplexml_load_string($get);
    $qa = $xml->xpath('//data/collections/items');
    $q1 = 0;

    foreach($qa as $q2){
        if (isset($q2->level)) {
            foreach($q2->level as $q3){
             $q1 += $q3["0"];
            }
        }
    }
return $q1;
}
if(isset($_POST["id"])){

		$url = file_get_contents('http://109.234.156.251/prison/universal.php?user='.$id.'&key='.$auth.'&method=getInfo'); 
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
		preg_match("#<key id=\"19\">(.*?)</key>#",$url,$match); 
		$chefir = $match[1]; //банки чефира
		preg_match("#<key id=\"15\">(.*?)</key>#",$url,$match); 
		$chestB = $match[1]; //Сундуки воркуты 
		
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
		preg_match_all('#<spell id="6">(.*?)</spell>#',$url,$matches);
		$yad = $matches[1][0]; //яд
		preg_match_all('#<spell id="5">(.*?)</spell>#',$url,$matches);
		$sam = $matches[1][0]; //самопал
		preg_match_all('#<spell id="4">(.*?)</spell>#',$url,$matches);
		$fin = $matches[1][0]; //финки
		//pars оружия
		$ni4ki = nich($url); //Нычки
		if($ratin){
		echo '
		<td><input color="green" value="'.$id.':'.$auth.'" style="width: 320px;"></td>
		<td width="5"></td>
        <td><img src="/images/001.png"></td><td width="1"></td><td>'.$ratin.'</td>
		<td width="5"></td>
        <td><img src="/images/003.png"></td><td width="1"></td><td>'.$diamond.'</td>
		<td width="5"></td>
        <td><img src="/images/004.png"></td><td width="1"></td><td>'.$toilet_paper.'</td>
		<td width="5"></td>
        <td><img src="/images/006.png"></td><td width="1"></td><td>'.$soap.'</td>
		<td width="5"></td>
        <td><img src="/images/008.png"></td><td width="1"></td><td>'.$milk.'</td>
		<td width="5"></td>
		<td><img src="/images/010.png"></td><td width="1"></td><td>'.$pac_pos.'</td>
		<td width="5"></td>
		<td><img src="/images/011.png"></td><td width="1"></td><td>'.$blat_pos.'</td>
		<td width="5"></td>
		<td><img src="/images/012.png"></td><td width="1"></td><td>'.$avto_pos.'</td>
		<td width="5"></td>
		<td><img src="/images/014.png"></td><td width="1"></td><td>'.$fin.'</td>
        <td width="5"></td>
		<td><img src="/images/015.png"></td><td width="1"></td><td>'.$sam.'</td>
        <td width="5"></td>
		<td><img src="/images/016.png"></td><td width="1"></td><td>'.$yad.'</td>
		<td width="5"></td>
		<td><img src="/images/matrac.png"></td><td width="1"></td><td>'.$matrac.'</td>
        <td width="5"></td>
		<td><img src="/images/koluch.png"></td><td width="1"></td><td>'.$koluch.'</td>
		<td width="5"></td>
		<td><img src="/images/017.png"></td><td width="1"></td><td>'.$ni4ki.'</td>
		<td width="5"></td>
		<td><img src="/images/red_s.png"></td><td width="1"></td><td>'.$red.'</td>
		<td width="5"></td>
		<td><img src="/images/pink_s.png"></td><td width="1"></td><td>'.$pink.'</td>
		<td width="5"></td>
		<td><img src="/images/green_s.png"></td><td width="1"></td><td>'.$gamefor.'</td>
		<td width="5"></td>
		<td><img src="/images/talents.png"></td><td width="1"></td><td>'.$playerTalentPoints.'</td>
		<td width="5"></td>
		<td><img src="mobile/img/chefir.png"></td><td width="1"></td><td>'.$chefir.'</td>
		<td width="5"></td>
		<td><img src="mobile/img/chest.png"></td><td width="1"></td><td>'.$chestB.'</td>
		';}else{
		echo '<div class="ok sma"><div style="text-align: center;">'.$id.':Не валидный фейк</div></div><br>';
		}
}
?>