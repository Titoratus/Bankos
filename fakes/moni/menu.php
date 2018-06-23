<?
include("../config.php");
function vk_auth($id){
    $api_id = "5483293";
    $viewer_id = $id;;
    $api_secret = "dn8g1Xcv6AyAL8dS3Uec";
    $auth_key = md5($api_id.'_'.$viewer_id.'_'.$api_secret);
    return $auth_key;
}
if(vk_auth($_GET['viewer_id']) != $_GET['auth_key']){die('Не верный auth_key');}
$id = $_GET["viewer_id"];?><html>
    <head>
        <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.css" rel="stylesheet">
        <!--<script src="//vk.com/js/api/xd_connection.js?2" type="text/javascript"></script>-->
        <script src="//code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
        <script type="text/javascript">
            var userida = <?echo $id;?>;
            var auth_key = '<?echo $_GET['auth_key'];?>';
        </script>
        <script src="//z95373ka.bget.ru/moni/js/script.js" type="text/javascript"></script>
        
        <link href="//z95373ka.bget.ru/moni/css/style.css" rel="stylesheet">
    </head>
<body id='body'>
<a href="add.php"><button type="button" class="btn btn-success btn-block">Добавить сервер</button></a>
<div class="servers-list scrollbar-outer">
    <table class="table table-striped table-hover tmiddle">
    <thead>
    <tr class="fixed">
        <th>Статус</th>
        <th class="tab_name">Название сервера</th>
        <th>Краткое описание</th>
        <th>Адрес сервера</th>
        <th>Версия</th>
        <th class="tab_players">Игроков</th>
        <th class="votes"><i class="glyphicon glyphicon-signal"></i>Рейтинг</th>
    </tr>
    </thead>
    <tbody>
<?
$db = mysql_connect($db_ip,$db_user,$db_password);        //БД
mysql_select_db ($db_base) or die ("Cannot connect to database");//БД

$num = 10; // Переменная хранит число сообщений выводимых на станице 
$page = $_GET['page']; // Извлекаем из URL текущую страницу 
$result = mysql_query("SELECT COUNT(*) FROM moni"); 
$posts = mysql_fetch_row($result);// Определяем общее число сообщений в базе данных
$total = intval(($posts[0] - 1) / $num + 1); // Находим общее число страниц 
$page = intval($page);// Определяем начало сообщений для текущей страницы
if(empty($page) or $page < 0){ $page = 1; }
if($page > $total){ $page = $total;}
$start = $page * $num - $num;

$row2 = mysql_query("SELECT * FROM moni ORDER BY rate DESC LIMIT $start, $num"); //Отправка SQL запроса
while($r=mysql_fetch_array($row2))//запускаем цыкл перебора данных
{
    $id= $r["id"];
    $ips= $r["ip"];
    $name = $r["name"];
    $text = $r["text"];
    $ver = $r["ver"];
    $rate = $r["rate"];
    $date= $r["date"];

    list($ip,$port) = explode(':',trim($ips));
    if($port){$port1 = sprintf("/$port", $port);}else{$port1=$port;}
    
    $get = json_decode(file_get_contents("https://mcapi.de/api/server/$ip$port1"));
    
    $status = $get->result->status;
    $player_max = $get->players->max;
    $player_min = $get->players->online;
    ?>

            <tr id="server" class="cl-1">
                <td><?if($status == 'Ok'){echo '<span class="bg-success">Вкл<span>';}else{echo '<span class="bg-danger">Выкл<span>';}?></td>
                <td class="tab_name"><a href="#"><?echo $name;?></a></td>
                <td class="tab_sdesc"><?echo $text;?></td>
                <td><span class="sel-host"><?echo $ip; if($port){echo ':'.$port;}?></span></td>
                <td><span class="bg-danger"><?echo $ver;?></span></td>
                <td class="tab_players"><?echo $player_min;?>&nbsp;/&nbsp;<?echo $player_max;?></td>
                <td class="votes">
                    <div class="like" data-id="<?echo $id?>"><span class="counter"><?echo $rate?></span></div>
                </td>
            </tr>
<?}?>
           </tbody>
<?php 
echo '<center style="margin: -20;"><ul class="pagination">';
// Проверяем нужны ли стрелки назад 
if ($page != 1) $pervpage = '
<li><a href=?page=1><<</a> 
<li><a href=?page='. ($page - 1) .'><</a> '; 
// Проверяем нужны ли стрелки вперед 
if ($page != $total) $nextpage = ' 
<li><a href=?page='. ($page + 1) .'>></a> 
<li><a href=?page=' .$total. '>>></a>'; 
// Находим две ближайшие станицы с обоих краев, если они есть 
if($page - 2 > 0) $page2left = 
'<li><a href=?page='. ($page - 2) .'>'. ($page - 2) .'</a></li>'; 
if($page - 1 > 0) $page1left = 
'<li><a href=?page='. ($page - 1) .'>'. ($page - 1) .'</a></li>'; 
if($page + 2 <= $total) $page2right = 
'<li><a href=?page='. ($page + 2) .'>'. ($page + 2) .'</a></li>'; 
if($page + 1 <= $total) $page1right = 
'<li><a href=?page='. ($page + 1) .'>'. ($page + 1) .'</a></li>'; 

// Вывод меню 
echo $pervpage.$page2left.$page1left.'<li class="active"><a href="#">'.$page.'</li>'.$page1right.$page2right.$nextpage; 
echo '</ul></center>';
?>
        </table>
</div>
<t style="visibility: hidden;" id="uid">98231244</t>
</body>
</html>