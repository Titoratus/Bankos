<?php
function pars($log, $begin, $end){ //функция для парсинга
    if (!$log) {return NULL;}
    $begin = strpos($log, $begin) + strlen($begin);
    $end = strpos($log, $end, $begin);
    $result = substr($log, $begin, $end - $begin);
    return $result;
}
function get_auth($user_id,$token,$url,$method){ //1-ид, 2-токен, 3-ип:порт, 4-метод
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "http://".$url."/".$user_id."/".$token."/".$method);
    curl_setopt($ch, CURLOPT_USERAGENT,'Dalvik/1.6.0 (Linux; U; Android 4.4.2; SM-G930K Build/NRD90M)');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
    curl_setopt($ch, CURLOPT_TIMEOUT, 10);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, "sn=vk&sig=&user=".$user_id."&session_secret=");
    $post = curl_exec($ch);
    curl_close($ch);
    return $post;
}
$link = 'https://oauth.vk.com/blank.html#access_token=f02026adfe2f542edac46680dc11e3fc9963ec4af93bcb1&expires_in=0&user_id=12345';
$link = $link.'&';
 
if (strpos($link , "#access_token")){ //ищем в ссылке слово #access_token
$token = pars($link, "access_token=", "&"); //обрезаем токен
$user_id = pars($link, "user_id=", "&"); //обрезаем ид
 
$init = get_auth($user_id, $token, '178.132.205.26:15000', 'init'); // иницилизируем аккаунт
$json = json_decode($init, true); //декодируем строку
 
    if(isset($json['node'])){ //если выдал ip:port
        $auth = get_auth($user_id, $token, $json['node'], 'get_authkey'); //получаем аут из полученого ип
        echo $auth; //выводим аут
    }
    if(isset($json['code']) and $json['code'] == '3'){ //если есть переменная $json['code'] и она имеет 3 то значит ошибка
        echo 'Неверный ид или токен';
    }
   
}
?>