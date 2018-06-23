<?
include_once("../bd2.php");
$qeury = mysql_query('UPDATE `auto` SET `vkl` = REPLACE(`vkl`, "1", "0");'); 
$qeury = mysql_query('TRUNCATE damage'); 
mysql_close();
file_put_contents("../brigada/log.txt", "");
file_put_contents("../brigada/log2.txt", "");
?>