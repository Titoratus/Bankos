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
if(isset($_POST['but'])){
    if($_POST['ip']){
        if($_POST['name']){
            if($_POST['text']){
                $ips = $_POST['ip'];
                $name = $_POST['name'];
                $text = $_POST['text'];
                $ver = $_POST['ver'];
                list($ip,$port) = explode(':',trim($ips));
                if($port){$port1 = sprintf("/$port", $port);}else{$port1=$port;}
                
                $get = json_decode(file_get_contents("https://mcapi.de/api/server/$ip$port1"));
                $status = $get->result->status;
                    if($status == 'Ok'){
                        $db = mysql_connect($db_ip,$db_user,$db_password);
                        mysql_select_db ($db_base) or die ("Cannot connect to database");
                        $row2 = mysql_query("INSERT INTO `moni`(`id`, `name`, `text`, `ip`, `ver`, `rate`, `date`) VALUES ('','$name','$text','$ips','$ver','','')"); //Отправка SQL запроса
                        if($row2 == true){$echo[] = 'Сервер добавлен';}elseif($row2 == false){$echo[] = 'Сервер не был добавлен';}
                    }else{$echo[] = 'Сервер выключен';}
            }else{$echo[] = 'Введите описание сервера';}
        }else{$echo[] = 'Введите название сервера';}
    }else{$echo[] = 'Введите ip';}
}
?>
<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.css" rel="stylesheet">

<style>
html{height:100%}#contact{background-color:#f9f9f9;width:100%;margin:30px auto;padding:30px 20px;border:1px solid #ccc}#contact img{max-width:100%}fieldset{padding:20px}#newip{width:400px;margin:0 auto}.substrate{text-align:center;width:880px;margin:50px auto;background:#fff;border-radius:10px;padding:50px 150px;-webkit-box-shadow:0 0 15px 0 rgba(50,50,50,0.5);-moz-box-shadow:0 0 15px 0 rgba(50,50,50,0.5);box-shadow:0 0 15px 0 rgba(50,50,50,0.5)}.additional input[type="checkbox"]:checked + label{background:#0081e4;color:#fff}.additional label{background:#fff;border:1px solid #e1e1e1;border-radius:3px;padding:4px 7px 3px;color:#333;text-transform:uppercase;font-weight:300;font-size:12px}.additional input[type="checkbox"]{visibility:hidden}#form_add input[type="text"],#form_add textarea{background:#f0f0f0}#form_add input[type="text"]{height:40px}#server_name_id{font-size:20px}#submit_ip{padding:10px}#results{display:none}#results h1{margin:20px -120px 30px}#checkip{display:none}.additional-info__wrap{white-space:nowrap;margin:0 -15px}.additional-info{width:50%;display:inline-block;padding:0 15px}.additional__item{margin:0 -120px}#results{margin-top:20px}.share{text-align:center;background-color:#DCEED4;margin:20px 0;padding:15px;border-radius:4px}.form__item{margin:30px 0}.backLink{margin:15px 0 20px}.backLink__info{font-size:12px;font-weight:400}.goto_top{background:#53c937;color:#fff;margin-top:50px}.goto_top:link,.goto_top:hover,.goto_top:hover,.goto_top:active{color:#fff}.bdresult{margin-bottom:20px}
</style>
<?if($echo){?>
<div id="form_add" style="padding: 5px 150px;" class="substrate">
    <?foreach($echo AS $error){print $error."<br>";}?>
</div>
<?}?>
<form id="form_add" class="substrate" method="post">
    <h4>IP:Port Вашего сервера</h4>
    <input type="text" name="ip" class="form-control" id="newip" placeholder="Пример: 127.0.0.1:25565" value="" autocomplete="off"><br>
    <select style="width: 200;" name="ver">
      <option>1.4.7</option>
      <option>1.5.2</option>
      <option>1.6.2</option>
      <option>1.5.4</option>
      <option>1.7.x</option>
      <option>1.8.x</option>
      <option>1.9.2</option>
      <option>1.9.4</option>
      <option>1.10</option>
    </select>
    <div class="form__item">
        <h4>Название сервера</h4>
        <input type="text" name="name" class="form-control" id="newip" autocomplete="off">
    </div>
    <div class="form__item">
        <h4>Описание сервера</h4>
        <textarea class="form-control" name="text" style="margin: 0px; height: 53px;" title="Подробное описание сервера. Старайтесь описать сервер красиво, и игроки не пройдут мимо!"></textarea>
    </div>
    
    <input type="submit" id="submit_ip" name="but" class="btn btn-lg" value="Добавить сервер"></input>
</form>
<a href="menu.php"><button type="button" class="btn btn-success btn-block">Вернуться</button></a>