<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Услуги</title>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<link rel="stylesheet" href="clients.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.1/css/all.min.css">
</head>
<body>
	
	<div class="nav_cl">УСЛУГИ</div>
	<div class="wrapper">
			<a href="../Lab_5_Frontend">
				<i style="font-size: 5vh; color: #000;" class="fas fa-chevron-left"></i>
			</a>
		<table id="clients_table">
			<tr class="tr_head">
				<td class="td_head">Код услуги</td>
				<td class="td_head">Наименование услуги</td>
			</tr>
		

		<?php 

			$clients = json_decode(file_get_contents("http://localhost/lab_2/getServices"));
			echo "<pre>";

			for ($i=0; $i < count($clients->allServices); $i++)
			{ 
				echo "<tr>";
					echo "<td>".$clients->allServices[$i][0]."</td>";
					echo "<td>".$clients->allServices[$i][1]."</td>";
				echo "</tr>";
			}

		 ?>

		</table>

		<p style="text-align: right;">
			<a style="border-radius: 5px;color: #fff; text-decoration: none; font-size: 3vh; background-color: #ff5252; padding: 7px 10px;" href="deleteService.php">Удалить</a>
			
			<a style="border-radius: 5px;color: #000; text-decoration: none; font-size: 3vh; background-color: #eeff41; padding: 7px 10px;" href="editService.php">Редактировать</a>

			<a style="border-radius: 5px;color: #000; text-decoration: none; font-size: 3vh; background-color: #b2ff59; padding: 7px 10px;" href="addService.php">Добавить</a>
		</p>

	</div>


	<script>
		$( document ).ready(function()
		{
			console.log("doc ready");
		});
	</script>
</body>
</html>