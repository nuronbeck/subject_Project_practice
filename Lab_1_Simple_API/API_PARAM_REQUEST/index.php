<?php

	if (isset($_GET['date']))
	{	
		//Получаем дату в формате dd.mm.YYYY и передаем методу
		date_to_week_day($_GET['date']);
	}
	if (isset($_GET['a']) and isset($_GET['b']) and isset($_GET['c']))
	{
		//Получаем a,b,c уравнения и передаем методу
		quadratic_equation($_GET['a'], $_GET['b'], $_GET['c']);
	}

	
	function quadratic_equation($a, $b, $c)
	{
		$discriminant = ($b*$b)-(4*$a*$c);

		switch ($discriminant)
		{
			case $discriminant > 0:
				$x1 = (-$b-sqrt($discriminant))/(2*$a);
				$x2 = (-$b+sqrt($discriminant))/(2*$a);
				echo json_encode(
					array(
						"url" => $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"],
						"response" => array(
							"x1"=> $x1,
							"x2"=> $x2
						),
						"method" => $_SERVER["REQUEST_METHOD"]
					)
				);
				JSON_save("../lab_1.json", json_encode(array(
					"x1"=> $x1,
					"x2"=> $x2
				)));
				break;
			case $discriminant == 0:
				$x = (-$b)/(2*$a);
				echo json_encode(
					array(
						"url" => $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"],
						"response" => array(
							"x"=> $x
						),
						"method" => $_SERVER["REQUEST_METHOD"]
					)
				);
				JSON_save("../lab_1.json", json_encode(array("x"=> $x)));
				break;
			default:
				echo json_encode(
					array(
						"url" => $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"],
						"response" => array(
							"x"=> "Does not have roots!"
						),
						"method" => $_SERVER["REQUEST_METHOD"]
					)
				);
				JSON_save("../lab_1.json", json_encode(array('x'=> "Does not have roots!")));
				break;
		}

		
	}



	function date_to_week_day($date)
	{
		// %A - формат дня недели
		// %d - день месяца формата dd
		// %m - месяц формата mm
		// %Y- год формата YYYY
		//echo strftime("%A, %d/%m/%Y", strtotime($date)); 


		$week_day = strftime("%A", strtotime($date));

		switch ($week_day)
		{
			case 'Monday':
				$week_day = 'Понедельник';
				break;
			case 'Tuesday':
				$week_day = 'Вторник';
				break;
			case 'Wednesday':
				$week_day = 'Среда';
				break;
			case 'Thursday':
				$week_day = 'Четверг';
				break;
			case 'Friday':
				$week_day = 'Пятница';
				break;
			case 'Saturday':
				$week_day = 'Суббота';
				break;
			case 'Sunday':
				$week_day = 'Воскресенье';
				break;
			
			default:
				$week_day = $week_day;
				break;
		}

		$output = array(
			"url" => $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"],
			"response" => array( 'week_day' => $week_day ),
			"method" => $_SERVER["REQUEST_METHOD"]
		);

		// JSON ответ на запрос
		JSON_save("../lab_1.json", json_encode(array('week_day'=> $week_day)));
		echo json_encode($output);
	}




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
	
?>