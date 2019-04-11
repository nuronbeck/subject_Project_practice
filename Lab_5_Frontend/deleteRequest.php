<?php 
	
	if (isset($_POST['deleteBtn']))
	{
		$deleting_request_id = $_POST["request_select"];

		$url_del = "http://localhost/lab_2/deleteRequest/".$deleting_request_id;


		$delete_request = json_decode(file_get_contents($url_del));

		if ($delete_request->result == "Request deleted")
		{
			header('Location: http://localhost/Lab_5_Frontend/requests.php ');
		}
	}
	

 ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Удалить заявку</title>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<link rel="stylesheet" href="clients.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.1/css/all.min.css">
</head>
<body>
	
	<div class="nav_cl">Удалить заявку</div>
	<div class="wrapper">
		<a href="../Lab_5_Frontend/requests.php">
				<i style="font-size: 5vh; color: #000;" class="fas fa-chevron-left"></i>
		</a>
		<form style="font-size: 3vh; text-align: center;" action="" method="POST">
			<p>Выберите заявку:</p>
			 <p>
			 	<select style="border-radius: 5px;font-size: 2.8vh; padding: 5px 10px;" name="request_select" id="cl">
			 	<?php 
			 		$requests = json_decode(file_get_contents("http://localhost/lab_2/getRequests"));

			 		for ($i=0; $i < count($requests->allRequests); $i++)
					{ 
						echo "<option value=\"".$requests->allRequests[$i][0]."\">";
							echo "заявка #".$requests->allRequests[$i][0]." __ ";
							echo $requests->allRequests[$i][1]."_";
							$name_client = json_decode(file_get_contents("http://localhost/lab_2/getClient/".$requests->allRequests[$i][1]));
							echo $name_client->client[0][1];
						echo "</option>";
					}
				 ?>
			 	</select>
			 </p>

			<p><input type="submit" style="border-radius: 5px;color: #000; text-decoration: none; font-size: 2.5vh; background-color: #b2ff59; padding: 7px 25px; border: none;" name="deleteBtn" value="Удалить"> </p>
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