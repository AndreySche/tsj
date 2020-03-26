<?php

$menuSql = [
	'main' 		=> [	'title'=>'Главная', 			'link'=>"/"	],
	'inctuct' 	=> [	'title'=>'Инструкции'						],
	'report' 	=> [	'title'=>'Отчеты'							],
	'life' 		=> [	'title'=>'ТСЖ <b class="green">Life</b>'	]
];

$tabsSql = [
	'inctuct' => [ 
		'index'		=> 'Правила', 
		'nas' 		=> 'Оплата' 
	],

	'report' => [ 
		'index'		=> 'Отчеты', 
		'docs' 		=> 'Документы', 
		'protos' 	=> 'Протоколы' 
	],

	'life' => [ 
		'index'		=> 'Вредители', 
		'goods' 	=> 'О хорошем' 
	],

];

?>