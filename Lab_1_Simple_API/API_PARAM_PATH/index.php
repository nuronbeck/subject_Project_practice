<?php
	use Psr\Http\Message\ServerRequestInterface as Request;
	use Psr\Http\Message\ResponseInterface as Response;
	require 'vendor/autoload.php';

	$app = new \Slim\App;

	$app->get('/{number}', function (Request $request, Response $response, array $args)
	{
	    $number = (int)$args['number'];

	    $result = number2string($number);

		JSON_save("../lab_1.json", json_encode(array(
			"numb_letter"=> $result
		)));

		return $response->withJSON(
	        ["numb_letter"=> $result],
	        200,
	        JSON_UNESCAPED_UNICODE
    	);
	});


	$app->get('/fibonachchi/{numb}', function (Request $request, Response $response, array $args)
	{
	    $number = (int)$args['numb'];

	    if($number > 0)
		{
			$result = round(((5 ** .5 + 1) / 2) ** $number / 5 ** .5);
		}
		else
		{
			$result = null;
		}

		JSON_save("../lab_1.json", json_encode(array(
			'fib_result'=> $result
		)));

		return $response->withJSON(
	        ['fib_result' => $result],
	        200,
	        JSON_UNESCAPED_UNICODE
    	);
	});



	$app->get('/region/{region_code}', function (Request $request, Response $response, array $args)
	{
	    $region_code = $args['region_code'];

	    $regions_data = array
	    (
	    	array('72', 'Тюмень'),
			array('77', 'г. Москва'),
			array('78', 'Санкт-Петербург'),
			array('66', 'Свердловская область')
	    );

	    for ($j=0; $j < count($regions_data); $j++)
	    { 
	    	if ($regions_data[$j][0] == $region_code)
	    	{
	    		$result = $regions_data[$j][1];
	    		break;
	    	}
	    	else{ $result = "REGION NOT FOUND"; }
	    }

	    JSON_save("../lab_1.json", json_encode(array(
			'region_name'=> $result
		)));
		return $response->withJSON(
	        ['region_name' => $result],
	        200,
	        JSON_UNESCAPED_UNICODE
    	);
	});

	$app->run();





	function JSON_save($filename, $response)
	{
		$url = $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
		$example = array(
			'url' => $url,
			'response' => $response,
			'method' => $_SERVER['REQUEST_METHOD']);
		$json_example = json_encode($example, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
		file_put_contents($filename, $json_example . "\n", FILE_APPEND | LOCK_EX);
	}



	function number2string($number) {
    
    // обозначаем словарь в виде статической переменной функции, чтобы 
    // при повторном использовании функции его не определять заново
    static $dic = array(
    
        // словарь необходимых чисел
        array(
            -2  => 'две',
            -1  => 'одна',
            1   => 'один',
            2   => 'два',
            3   => 'три',
            4   => 'четыре',
            5   => 'пять',
            6   => 'шесть',
            7   => 'семь',
            8   => 'восемь',
            9   => 'девять',
            10  => 'десять',
            11  => 'одиннадцать',
            12  => 'двенадцать',
            13  => 'тринадцать',
            14  => 'четырнадцать' ,
            15  => 'пятнадцать',
            16  => 'шестнадцать',
            17  => 'семнадцать',
            18  => 'восемнадцать',
            19  => 'девятнадцать',
            20  => 'двадцать',
            30  => 'тридцать',
            40  => 'сорок',
            50  => 'пятьдесят',
            60  => 'шестьдесят',
            70  => 'семьдесят',
            80  => 'восемьдесят',
            90  => 'девяносто',
            100 => 'сто',
            200 => 'двести',
            300 => 'триста',
            400 => 'четыреста',
            500 => 'пятьсот',
            600 => 'шестьсот',
            700 => 'семьсот',
            800 => 'восемьсот',
            900 => 'девятьсот'
        ),
        
        // словарь порядков со склонениями для плюрализации
        array(
            array('', '', ''),
            array('тысяча', 'тысячи', 'тысяч'),
            array('миллион', 'миллиона', 'миллионов'),
            array('миллиард', 'миллиарда', 'миллиардов'),
            array('триллион', 'триллиона', 'триллионов'),
            array('квадриллион', 'квадриллиона', 'квадриллионов'),
            // квинтиллион, секстиллион и т.д.
        ),
        
        // карта плюрализации
        array(
            2, 0, 1, 1, 1, 2
        )
    );
    
    // обозначаем переменную в которую будем писать сгенерированный текст
    $string = array();
    
    // дополняем число нулями слева до количества цифр кратного трем,
    // например 1234, преобразуется в 001234
    $number = str_pad($number, ceil(strlen($number)/3)*3, 0, STR_PAD_LEFT);
    
    // разбиваем число на части из 3 цифр (порядки) и инвертируем порядок частей,
    // т.к. мы не знаем максимальный порядок числа и будем бежать снизу
    // единицы, тысячи, миллионы и т.д.
    $parts = array_reverse(str_split($number,3));
    
    // бежим по каждой части
    foreach($parts as $i=>$part) {
        
        // если часть не равна нулю, нам надо преобразовать ее в текст
        if($part>0) {
            
            // обозначаем переменную в которую будем писать составные числа для текущей части
            $digits = array();
            
            // если число треххзначное, запоминаем количество сотен
            if($part>99) {
                $digits[] = floor($part/100)*100;
            }
            
            // если последние 2 цифры не равны нулю, продолжаем искать составные числа
            // (данный блок прокомментирую при необходимости)
            if($mod1=$part%100) {
                $mod2 = $part%10;
                $flag = $i==1 && $mod1!=11 && $mod1!=12 && $mod2<3 ? -1 : 1;
                if($mod1<20 || !$mod2) {
                    $digits[] = $flag*$mod1;
                } else {
                    $digits[] = floor($mod1/10)*10;
                    $digits[] = $flag*$mod2;
                }
            }
            
            // берем последнее составное число, для плюрализации
            $last = abs(end($digits));
            
            // преобразуем все составные числа в слова
            foreach($digits as $j=>$digit) {
                $digits[$j] = $dic[0][$digit];
            }
            
            // добавляем обозначение порядка или валюту
            $digits[] = $dic[1][$i][(($last%=100)>4 && $last<20) ? 2 : $dic[2][min($last%10,5)]];
            
            // объединяем составные числа в единый текст и добавляем в переменную, которую вернет функция
            array_unshift($string, join(' ', $digits));
        }
    }
    
    // преобразуем переменную в текст и возвращаем из функции, ура!
    return join(' ', $string);
}


?>
