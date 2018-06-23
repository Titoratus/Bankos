 <?php
	if( $curl = curl_init() ) {
	curl_setopt($curl, CURLOPT_URL, 'https://telonko.com');
	curl_setopt($curl, CURLOPT_RETURNTRANSFER,true);
	curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: text/xml'));
	curl_setopt($curl, CURLOPT_USERAGENT,'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.13) Gecko/20080311 Firefox/2.0.0.13');

	curl_setopt($curl, CURLOPT_COOKIE, 
	"SID=39VzZyKLsQUkb,NE4hJHD1;
	notice220117=1;
	cook_auth=w2jJycXIlpXGamSZlZtoZZrGlZbIyceWZcWXaGximG8;
	cook_id=kmSbmWljbm2Y;
	geoCity=Petrozavodsk;
	notice291216=1;
	ssl=1;
	_ym_uid=1491557499735004878;
	chkd=1;
	__cfduid=d6d7165d28102e4c162480d9999f070701485543757");
	$out = curl_exec($curl);
	$s = iconv("windows-1251","utf-8", $out);
	// echo $s;
	curl_close($curl);
	} 
 file_get_contents("http://bankos.ml/brigada/friends_vk.php");
 //file_get_contents("http://109.234.156.251/prison/universal.php?gift=10&method=gifts%2Esend&user=259848096&sig=df608ce464be440b7cb7c75db3ef096c&msg=&recipient=132942251&key=1495e981b249fd2e07241a101bdabd01");
 //file_get_contents("http://109.234.156.251/prison/universal.php?gift=10&method=gifts%2Esend&user=259848096&sig=df608ce464be440b7cb7c75db3ef096c&msg=&recipient=132942251&key=1495e981b249fd2e07241a101bdabd01");
?>