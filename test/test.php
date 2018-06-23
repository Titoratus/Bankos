<?php
include("../mobile/function.php");
$id = '205344716';
$key = 'a0ddb54f7e95fca3b01dbc6ee1693633';
$get = post('method=initGame&user='.$id.'&key='.$key);

preg_match_all('#<library url="(.*?)" (.*?)>#',$get[0], $link);

echo implode("\r\n<br>", $link[1]);
?>