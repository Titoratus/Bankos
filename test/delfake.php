<?
	include("../mobile/function.php");
	include("../bd2.php");

$txt = file("../fakes.txt");
foreach($txt as $t){
	list($id,$auth) = explode(':',$t);
	$fakes[] = $id;
}

$row2 = mysql_query("SELECT * FROM auto");
while($r=mysql_fetch_array($row2))
{  
	$akk[]=$r["id"];
}

foreach($akk as $ak){
	foreach($fakes as $f){
		if($ak == $f){
			mysql_query("DELETE FROM `ulnyezxl_bk`.`auto` WHERE `auto`.`id` = $ak");
		}
	}
}