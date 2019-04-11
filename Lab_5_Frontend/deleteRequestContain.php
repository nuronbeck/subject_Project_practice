<?php 
	
	if (isset($_POST['deleteChoose']))
	{
		$req_id = $_POST["request_id"];
		$serv_id = $_POST["service_select"];

		$url_ed = "http://localhost/lab_2/deleteServiceFromRequest/".$req_id."&".$serv_id;

		function myUrlEncode($string) {
		    $entities = array('%21', '%2A', '%27', '%28', '%29', '%3B', '%3A', '%40', '%26', '%3D', '%2B', '%24', '%2C', '%2F', '%3F', '%25', '%23', '%5B', '%5D');
		    $replacements = array('!', '*', "'", "(", ")", ";", ":", "@", "&", "=", "+", "$", ",", "/", "?", "%", "#", "[", "]");
		    return str_replace($entities, $replacements, urlencode($string));
		}


		$del_request = json_decode(file_get_contents(myUrlEncode($url_ed)));

		if ($del_request->result == "Service deleted from request succesfully")
		{
			header('Location: http://localhost/Lab_5_Frontend/request_contain.php ');
		}
	}

 ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Удалить услугу из содержания</title>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<link rel="stylesheet" href="clients.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.1/css/all.min.css">
</head>
<body>
	
	<div class="nav_cl">Удалить услугу из содержания</div>
	<div class="wrapper">
		<a href="../Lab_5_Frontend/request_contain.php">
				<i style="font-size: 5vh; color: #000;" class="fas fa-chevron-left"></i>
		</a>
		<form <?php if (isset($_POST["editChoose"])) {echo "hidden";} ?> style="font-size: 3vh; text-align: center;" action="" method="POST">
			<p>Выберите услугу из <span style="color: #dd0000; background-color: #e9e9e9; ">Заявка # <?php echo $_GET["id_req"]; ?> </span></p>
			 <p>
			 	<input type="hidden" name="request_id" value="<?php echo $_GET["id_req"]; ?>">
			 	<select style="border-radius: 5px;font-size: 2.8vh; padding: 5px 10px;" name="service_select" id="cl">
			 	<?php 
			 		$req_services = json_decode(file_get_contents("http://localhost/lab_2/getServicesByRequest/".$_GET["id_req"]));

			 		for ($i=0; $i < count($req_services->servicesList); $i++)
					{ 
						echo "<option value=\"".$req_services->servicesList[$i][0]."\">";

						$serv_get = json_decode(file_get_contents("http://localhost/lab_2/getService/".$req_services->servicesList[$i][0]));
							echo $serv_get->service[0][1];
						echo "</option>";
					}
				 ?>
			 	</select>
			 </p>

			<p>
				<input type="submit" style="border-radius: 5px;color: #000; text-decoration: none; font-size: 2.5vh; background-color: #b2ff59; padding: 7px 25px; border: none;" name="deleteChoose" value="Удалить услугу">
			</p>
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