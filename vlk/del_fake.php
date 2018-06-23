<?
$file = file("../fakes.txt");

include_once ("../bd2.php");
$row = mysql_query("SELECT id FROM vlk");
while($r=mysql_fetch_array($row)){
	$user_id[] = $r['id'];
}

foreach($user_id as $user){
	foreach($file as $fake){
		list($id,$auth) = explode(":",$fake);
		
		if($user == $id){
			mysql_query("DELETE FROM vlk WHERE id='$user'");
			//print_r($user."\n");
		}
	}
	//print_r($user."\n");
}



?>