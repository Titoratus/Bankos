<?php
include("../../mobile/function.php");
function procent($mode_id, $html, $t_id){
	$myweap = myWeapon($html);
	$file = file_get_contents("legion.json");
	$task_file = json_decode($file, true);
	$qa = $mode_id;
    $arr_proc = array();
	
	foreach ($task_file as $k => $v ) {//перебираем задания
    	$proc = 0;

    	foreach ($v["weapons_probability"][$qa] as $w => $l ) { //перебираем нужный режим и достаем коеф оружий W-(id)оружие L-коеф
    		if (isset($myweap["weapon"][$w])) {//если есть данное оружие на аккаунте ТО
    			$pr = $l[$myweap["weapon"][$w]]; //достаем коеф и прибавляем
				$arr_proc[$v["id"]]["weap"][] = $w;
    		}else{//если нет оружия
    			$pr = 0; 
    		}
    		$proc += $pr*100;//складываем и умножаем
    	}

    	foreach ($v["car"][$qa] as $w => $l ) { //перебираем нужный режим и достаем коеф машин W-(id)оружие L-коеф
    		if (isset($myweap["unit"][$w])) { //если есть данная машина на аккаунте ТО
    			$pr = $l[$myweap["unit"][$w]];  //достаем коеф и прибавляем
				$arr_proc[$v["id"]]["car"][] = $w;
    		}else{//если нет оружия
    			$pr = 0;
    		}
    		$proc += $pr*100;//складываем и умножаем
    	}
        //$name2 .= cp_txt("(".$proc."%) - ".$v["name"]."\r\n"); //записываем текст в переменную
    
		$arr_proc[$v["id"]]["data"] = array(
		"proc" => $proc,
		"name" => $v["name"]
		);
	}
	return $arr_proc[$t_id];
}
$id = '379076152';
$auth = 'a786abe7f85ad473ff5dedcc5ef70d6f';
$getInfo = post("method=getInfo&user=$id&key=$auth");

$post = post("method=legion.getNodeTasks&user=$id&key=$auth&node_id=22"); // Получаем задания
$json_result = json_decode($post[0], true);

foreach($json_result["result"]["tasks"] as $value){
	$t_id = $value["task_id"];
	$m_id = $value["mode_id"];
	if($m_id != "2"){ continue; }
	$proc = procent($m_id,$getInfo[0],$t_id);
	
	if($proc["data"]["proc"] > 0){
		//echo $proc["data"]["name"]." - ".$proc["data"]["proc"]."% - потребуются оружия ".implode(",",$proc["weap"])."<hr>";
		echo json_encode($proc);
	}
	
}





?>