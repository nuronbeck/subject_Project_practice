<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Содержание заявок</title>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<link rel="stylesheet" href="clients.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.1/css/all.min.css">
</head>
<body>
	
	<div class="nav_cl">СОДЕРЖАНИЕ ЗАЯВОК</div>
	<div class="wrapper">
			<a href="../Lab_5_Frontend">
				<i style="font-size: 5vh; color: #000;" class="fas fa-chevron-left"></i>
			</a>

		<?php 

			$requests = json_decode(file_get_contents("http://localhost/lab_2/getRequests"));

			for ($r=0; $r < count($requests->allRequests); $r++)
			{ 
				echo "<p style=\"font-family: Arial; margin-top: 70px;\">";
				echo "<span style=\"padding: 5px 15px; font-weight: italic; font-size: 3.2vh; background-color: #42f44e; color: #000;\">Заявка #".$requests->allRequests[$r][0]."</span>";

				$name_client = json_decode(file_get_contents("http://localhost/lab_2/getClient/".$requests->allRequests[$r][1]));

				echo "<span style=\"padding: 5px 10px 5px 25px; font-weight: italic; font-size: 3.2vh; color: #000;\">Оформлен на:</span>";
				echo "<span style=\"padding: 5px 0px; font-weight: italic; font-size: 3.2vh; color: #ff0000;\">".$name_client->client[0][1]."</span>";
				echo "</p>";

				///getServicesByRequest

				$request_services = json_decode(file_get_contents("http://localhost/lab_2/getServicesByRequest/".$requests->allRequests[$r][0]));

				echo "<table id=\"clients_table\">";
				for ($i=0; $i < count($request_services->servicesList); $i++)
				{ 
					
						$service_name = json_decode(file_get_contents("http://localhost/lab_2/getService/".$request_services->servicesList[$i][0]));
						
						echo "<tr>";
							if ($i == count($request_services->servicesList)-1)
							{
								echo "<td>".$service_name->service[0][1]."</td>";
							}
							else
							{
								echo "<td style=\"border-bottom: 1px solid #000;\">".$service_name->service[0][1]."</td>";
							}
							
						echo "</tr>";					
					
				}
				if (count($request_services->servicesList) == 0)
				{
					echo "<tr>";
					echo "<td style=\"color: #5c5c5c;\">заявка не содержить услуг..</td>";
					echo "</tr>";
				}

				echo "</table>";

				?>
					<p style="text-align: right;">						
						<a style="border-radius: 5px;color: #000; text-decoration: none; font-size: 3vh; background-color: #eeff41; padding: 7px 10px;" href="editRequestContain.php?id_req=<?php echo $requests->allRequests[$r][0]; ?>">Редактировать содержание</a>
					
						<a style="border-radius: 5px;color: #000; text-decoration: none; font-size: 3vh; background-color: #b2ff59; padding: 7px 10px;" href="addRequestContain.php?id_req=<?php echo $requests->allRequests[$r][0]; ?>">Добавить услугу</a>

						<a style="border-radius: 5px;color: #000; text-decoration: none; font-size: 3vh; background-color: #ff4444; color: #fff; padding: 7px 10px;" href="deleteRequestContain.php?id_req=<?php echo $requests->allRequests[$r][0]; ?>">Удалить из содержания</a>
					</p>
				<?php 

			}

		 ?>

	</div>


	<script>
		$( document ).ready(function()
		{
			console.log("doc ready");
		});
	</script>
</body>
</html>