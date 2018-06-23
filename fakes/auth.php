<?php
/*
Новый скрипт авторизации во ВКонтакте на PHP с использованием CURL
 
(!) Не предусмотрен ввод каптчи
 
Вы можете оптимизировать скрипт, избавив его от постоянного запроса на авторизацию.
Сам не стал этим заниматься, так как лень ^.^
 
Author: Ruslan Sadykhov https://vk.com/fsdsdfsfdsfsdfsdfsdfsdfsdfsgsdfs
*/
 
$login = '89537390102';
$password = 'wormix310898321';
$security_check_code = '12345678'; // если требуется 8 цифр номера телефона (по крайней мере у меня столько запросило)
 
$headers = array(
 'accept' => 'text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,*/*;q=0.8',
 'content-type' => 'application/x-www-form-urlencoded',
 'user-agent' => 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.86 Safari/537.36'
);
 
// получаем главную страницу
$get_main_page = post('https://vk.com', array(
 'headers' => array(
  'accept: '.$headers['accept'],
  'content-type: '.$headers['content-type'],
  'user-agent: '.$headers['user-agent']
 )
));
 
// парсим с главной страницы параметры ip_h и lg_h
preg_match('/name=\"ip_h\" value=\"(.*?)\"/s', $get_main_page['content'], $ip_h);
preg_match('/name=\"lg_h\" value=\"(.*?)\"/s', $get_main_page['content'], $lg_h);
 
// посылаем запрос на авторизацию
$post_auth = post('https://login.vk.com/?act=login', array(
 'params' => 'act=login&role=al_frame&_origin='.urlencode('http://vk.com').'&ip_h='.$ip_h[1].'&lg_h='.$lg_h[1].'&email='.urlencode($login).'&pass='.urlencode($password),
 'headers' => array(
  'accept: '.$headers['accept'],
  'content-type: '.$headers['content-type'],
  'user-agent: '.$headers['user-agent']
 ),
 'cookies' => $get_main_page['cookies']
));
 
// получаем ссылку для редиректа после авторизации
preg_match('/Location\: (.*)/s', $post_auth['headers'], $post_auth_location);
 
if(!preg_match('/\_\_q\_hash=/s', $post_auth_location[1])) {
 echo 'Не удалось авторизоваться <br /> <br />'.$post_auth['headers'];
 
 exit;
}
 
// переходим по полученной для редиректа ссылке
$get_auth_location = post($post_auth_location[1], array(
 'headers' => array(
  'accept: '.$headers['accept'],
  'content-type: '.$headers['content-type'],
  'user-agent: '.$headers['user-agent']
 ),
 'cookies' => $post_auth['cookies']
));
 
// получаем ссылку на свою страницу
preg_match('/"uid"\:"([0-9]+)"/s', $get_auth_location['content'], $my_page_id);
 
$my_page_id = $my_page_id[1];
 
$get_my_page = getUserPage($my_page_id, $get_auth_location['cookies']);
 
// если запрошена проверка безопасности
if(preg_match('/act=security\_check/s', $get_my_page['headers'])) {
 preg_match('/Location\: (.*)/s', $get_my_page['headers'], $security_check_location);
 
 // переходим на страницу проверки безопасности
 $get_security_check_page = post('https://vk.com'.$security_check_location[1], array(
  'headers' => array(
   'accept: '.$headers['accept'],
   'content-type: '.$headers['content-type'],
   'user-agent: '.$headers['user-agent']
  ),
  'cookies' => $get_auth_location['cookies']
 ));
 
 // получаем hash для запроса на проверку мобильного телефона
 preg_match('/hash: \'(.*?)\'/s', $get_security_check_page['content'], $get_security_check_page_hash);
 
 // вводим запрошенные цифры мобильного телефона
 $post_security_check_code = post('https://vk.com/login.php', array(
  'params' => 'act=security_check&code='.$security_check_code.'&al_page=2&hash='.$get_security_check_page_hash[1],
  'headers' => array(
   'accept: '.$headers['accept'],
   'content-type: '.$headers['content-type'],
   'user-agent: '.$headers['user-agent']
  ),
  'cookies' => $get_auth_location['cookies']
 ));
 
 echo 'Запрошена проверка безопасности';
 
 // отображаем свою страницу после проверки безопасности
 $get_my_page = getUserPage($my_page_id, $get_auth_location['cookies']);
 
 echo iconv('windows-1251', 'utf-8', $get_my_page['content']);
} else {
 // также отображаем свою страницу, если нет проверки безопасности
 echo iconv('windows-1251', 'utf-8', $get_my_page['content']);
}
 
function getUserPage($id = null, $cookies = null) {
 global $headers;
 
 $get = post('http://vk.com/app1979194', array(
  'headers' => array(
   'accept: '.$headers['accept'],
   'content-type: '.$headers['content-type'],
   'user-agent: '.$headers['user-agent']
  ),
  'cookies' => $cookies
 ));
 $saf = file_get_contents($get);
 preg_match('#viewer_id":(\d+?).*"auth_key":"(.*)"#iU', $saf, $out23);
 return $get;
}
 
function post($url = null, $params = null) {
 $ch = curl_init();
 
 curl_setopt($ch, CURLOPT_URL, $url);
 curl_setopt($ch, CURLOPT_HEADER, 1);
 curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
 curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
 
 if(isset($params['params'])) {
  curl_setopt($ch, CURLOPT_POST, 1);
  curl_setopt($ch, CURLOPT_POSTFIELDS, $params['params']);
 }
 
 if(isset($params['headers'])) {
  curl_setopt($ch, CURLOPT_HTTPHEADER, $params['headers']);
 }
 
 if(isset($params['cookies'])) {
  curl_setopt($ch, CURLOPT_COOKIE, $params['cookies']);
 }
 
 $result = curl_exec($ch);
 
 list($headers, $result) = explode("\r\n\r\n", $result, 4);
 
 preg_match_all('|Set-Cookie: (.*);|U', $headers, $parse_cookies);
 
 $cookies = implode(';', $parse_cookies[1]);
 
 curl_close($ch);
 
 return array('headers' => $headers, 'cookies' => $cookies, 'content' => $result);
}echo $out23[1], $out23[2];
?>