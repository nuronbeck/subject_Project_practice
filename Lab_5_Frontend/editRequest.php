<?php 
	
	if (isset($_POST['editRequestBtn']))
	{
		$editing_request_id = $_POST["id_req"];
		$editing_cl_id = $_POST["client_select"];

		$url_del = "http://localhost/lab_2/editRequest/".$editing_request_id."&".$editing_cl_id;


		$edit_request = json_decode(file_get_contents($url_del));

		if ($edit_request->result == "Request edited")
		{
			header('Location: http://localhost/Lab_5_Frontend/requests.php ');
		}
	}
	

 ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Изменить заявку</title>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<link rel="stylesheet" href="clients.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.1/css/all.min.css">
</head>
<body>
	
	<div class="nav_cl">Изменить заявку</div>
	<div class="wrapper">
		<a href="../Lab_5_Frontend/requests.php">
				<i style="font-size: 5vh; color: #000;" class="fas fa-chevron-left"></i>
		</a>
		<form <?php if (isset($_POST['editBtn'])){echo "hidden";} ?> style="font-size: 3vh; text-align: center;" action="" method="POST">
			<p>Выберите заявку:</p>
			 <p>
			 	<select style="border-radius: 5px;font-size: 2.8vh; padding: 5px 10px;" name="request_select" id="cl">
			 	<?php 
			 		$requests = json_decode(file_get_contents("http://localhost/lab_2/getRequests"));

			 		for ($i=0; $i < count($requests->allRequests); $i++)
					{ 
						echo "<option value=\"".$requests->allRequests[$i][0]."\">";
							echo "заявка #".$requests->allRequests[$i][0]." __ ";

							$name_client = json_decode(file_get_contents("http://localhost/lab_2/getClient/".$requests->allRequests[$i][1]));
							echo $name_client->client[0][1];
						echo "</option>";
					}
				 ?>
			 	</select>
			 </p>

			<p><input type="submit" style="border-radius: 5px;color: #000; text-decoration: none; font-size: 2.5vh; background-color: #b2ff59; padding: 7px 25px; border: none;" name="editBtn" value="Изменить"> </p>
		</form>


		<form <?php if (!isset($_POST['editBtn'])){echo "hidden";} ?> style="font-size: 3vh; text-align: center;" action="" method="POST">
			<input type="hidden" name="id_req" value="<?php if(isset($_POST["editBtn"])){echo $_POST["request_select"];} ?>">
			<p>Оформить заявку на:</p>
			 <p>
			 	<select style="border-radius: 5px;font-size: 2.8vh; padding: 5px 10px;" name="client_select" id="cl">
			 	<?php 
			 		$clients = json_decode(file_get_contents("http://localhost/lab_2/getClients"));

			 		for ($i=0; $i < count($clients->allClients); $i++)
					{ 
						echo "<option value=\"".$clients->allClients[$i][0]."\">";
							echo $clients->allClients[$i][1]." _ ";
							echo $clients->allClients[$i][2];
						echo "</option>";
					}
				 ?>
			 	</select>
			 </p>

			<p><input type="submit" style="border-radius: 5px;color: #000; text-decoration: none; font-size: 2.5vh; background-color: #b2ff59; padding: 7px 25px; border: none;" name="editRequestBtn" value="Сохранить"> </p>
		</form>

	</div>


	<script>
		$( document ).ready(function()
		{
			console.log("doc ready");
		});
	</script>
</body>
</html>