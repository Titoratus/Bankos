<?php
		if( $curl = curl_init() ) {
	curl_setopt($curl, CURLOPT_URL, 'https://telonko.com');
	curl_setopt($curl, CURLOPT_RETURNTRANSFER,true);
	curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: text/xml'));
	curl_setopt($curl, CURLOPT_USERAGENT,'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.13) Gecko/20080311 Firefox/2.0.0.13');

	curl_setopt($curl, CURLOPT_COOKIE, 
	"SID=8pHMI%2C6T47jQgiSpivkki1;
	cook_auth=lmibmJOax2KZmWtrapxqk27GmJyZnMbDYptmZJiVbZs;
	cook_id=kmSbmWljbm2Y;
yandexuid=5275886441520080781;
_ym_u=1520080777821201353;
_ym_isad=2;
_ym_visorc_8782456=w;
");
	$out = curl_exec($curl);
	$s = iconv("windows-1251","utf-8", $out);
//	echo $s;
	curl_close($curl);
	}

	?>