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
				echo json_encode(array(
					"x1"=> $x1,
					"x2"=> $x2
				));
				break;
			case $discriminant == 0:
				$x = (-$b)/(2*$a);
				echo json_encode(array(
					"x"=> $x
				));
				break;
			default:
				echo json_encode(array('x'=> "Does not have roots!"));
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
			'week_day' => $week_day
		);

		// JSON ответ на запрос
		echo json_encode($output);
	}



	function fibonachchi($number)
	{
		if($number > 0)
		{
			$result = round(((5 ** .5 + 1) / 2) ** $number / 5 ** .5);
		}
		else
		{
			$result = null;
		}
		echo json_encode(array('result'=>$result));
	}

	function RegionByCode($region_code)
	{
		$connection = mysqli_connect('127.0.0.1', 'root', '', 'RegionByCodeDB');

		if ($connection == true)
		{
			$data = mysqli_query($connection, "SELECT * FROM `Region` WHERE `code_region` = $region_code");

			while ($record = mysqli_fetch_assoc($data))
			{
				$region_name = array(
					'code_region' => $record['code_region'],
					'name_region' => $record['name_region']
				);
			}

			echo json_encode($region_name);	
		}
	}
?>