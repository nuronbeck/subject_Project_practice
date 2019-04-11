<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Клиенты</title>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<link rel="stylesheet" href="clients.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.1/css/all.min.css">
</head>
<body>
	
	<div class="nav_cl">КЛИЕНТЫ</div>
	<div class="wrapper">
			<a href="../Lab_5_Frontend">
				<i style="font-size: 5vh; color: #000;" class="fas fa-chevron-left"></i>
			</a>
		<table id="clients_table">
			<tr class="tr_head">
				<td class="td_head">Код клиента</td>
				<td class="td_head">Клиент</td>
				<td class="td_head">Тел.</td>
			</tr>
		

		<?php 

			$clients = json_decode(file_get_contents("http://localhost/lab_2/getClients"));
			echo "<pre>";

			for ($i=0; $i < count($clients->allClients); $i++)
			{ 
				echo "<tr>";
					echo "<td>".$clients->allClients[$i][0]."</td>";
					echo "<td>".$clients->allClients[$i][1]."</td>";
					echo "<td>".$clients->allClients[$i][2]."</td>";
				echo "</tr>";
			}

		 ?>

		</table>

		<p style="text-align: right;">
			<a style="border-radius: 5px;color: #fff; text-decoration: none; font-size: 3vh; background-color: #ff5252; padding: 7px 10px;" href="deleteClient.php">Удалить</a>
			
			<a style="border-radius: 5px;color: #000; text-decoration: none; font-size: 3vh; background-color: #eeff41; padding: 7px 10px;" href="editClient.php">Редактировать</a>

			<a style="border-radius: 5px;color: #000; text-decoration: none; font-size: 3vh; background-color: #b2ff59; padding: 7px 10px;" href="addClient.php">Добавить</a>
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