<?
function num($number){
	if (strlen($number) < 4) {return $number;}
	$num = number_format($number, 0, " ", ".");
	return $num;
}

$boss = array (
1 => array('name'=>'Атаман', 'hp' => num('10000')),
2 => array('name'=>'Нинка', 'hp' => num('50000')),
3 => array('name'=>'Инга', 'hp' => num('100000')),
4 => array('name'=>'Знахарь', 'hp' => num('1500000')),
5 => array('name'=>'Полковник', 'hp' => num('2500000')),
6 => array('name'=>'Братки', 'hp' => num('7500000')),
7 => array('name'=>'Штурман', 'hp' => num('18000000')),
10 => array('name'=>'Люська', 'hp' => num('40000000')),
8 => array('name'=>'Головорез', 'hp' => num('59500000')),
9 => array('name'=>'Бык', 'hp' => num('119000000')),
13 => array('name'=>'Коба', 'hp' => num('245000000')),
16 => array('name'=>'Шаман', 'hp' => num('445000000')),
11 => array('name'=>'Топор', 'hp' => num('799000000')),
12 => array('name'=>'Лысый', 'hp' => num('3589000000')),
15 => array('name'=>'Угар', 'hp' => num('5589000000')),
14 => array('name'=>'Годзила', 'hp' => num('33589000000'))
);

echo json_encode($boss);
?>