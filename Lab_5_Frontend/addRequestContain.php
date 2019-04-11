<?php 
	
	if (isset($_POST['addChoosen']))
	{
		$req_id = $_POST["request_id"];
		$serv_id = $_POST["service_select"];

		$url_ed = "http://localhost/lab_2/addRequestService/".$req_id."&".$serv_id;

		function myUrlEncode($string) {
		    $entities = array('%21', '%2A', '%27', '%28', '%29', '%3B', '%3A', '%40', '%26', '%3D', '%2B', '%24', '%2C', '%2F', '%3F', '%25', '%23', '%5B', '%5D');
		    $replacements = array('!', '*', "'", "(", ")", ";", ":", "@", "&", "=", "+", "$", ",", "/", "?", "%", "#", "[", "]");
		    return str_replace($entities, $replacements, urlencode($string));
		}


		$edit_request = json_decode(file_get_contents(myUrlEncode($url_ed)));

		if ($edit_request->result == "RequestService added")
		{
			header('Location: http://localhost/Lab_5_Frontend/request_contain.php ');
		}
	}
	
	if (isset($_POST['addButton']))
	{
		$name = str_replace(" ", "%20", $_POST['new_client_fio']);
		$tel = str_replace(" ", "%20", $_POST['new_client_tel']);

		$url_str = "http://localhost/lab_2/addClient/".$name."&".$tel."";

		function myUrlEncode($string) {
		    $entities = array('%21', '%2A', '%27', '%28', '%29', '%3B', '%3A', '%40', '%26', '%3D', '%2B', '%24', '%2C', '%2F', '%3F', '%25', '%23', '%5B', '%5D');
		    $replacements = array('!', '*', "'", "(", ")", ";", ":", "@", "&", "=", "+", "$", ",", "/", "?", "%", "#", "[", "]");
		    return str_replace($entities, $replacements, urlencode($string));
		}


		$add_request = json_decode(file_get_contents(myUrlEncode($url_str)));

	}

 ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Добавить услугу в содержание</title>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<link rel="stylesheet" href="clients.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.1/css/all.min.css">
</head>
<body>
	
	<div class="nav_cl">Добавить услугу в содержание</div>
	<div class="wrapper">
		<a href="../Lab_5_Frontend/request_contain.php">
				<i style="font-size: 5vh; color: #000;" class="fas fa-chevron-left"></i>
		</a>
		<form <?php if (isset($_POST["editChoose"])) {echo "hidden";} ?> style="font-size: 3vh; text-align: center;" action="" method="POST">
			<p>Какую услугу хотите добавить в  <span style="color: #dd0000; background-color: #e9e9e9; ">Заявка # <?php echo $_GET["id_req"]; ?> </span>:</p>
			 <p>
			 	<input type="hidden" name="request_id" value="<?php echo $_GET["id_req"]; ?>">
			 	<select style="border-radius: 5px;font-size: 2.8vh; padding: 5px 10px;" name="service_select" id="cl">
			 	<?php 
			 		$services = json_decode(file_get_contents("http://localhost/lab_2/getServices"));

			 		for ($i=0; $i < count($services->allServices); $i++)
					{ 
						echo "<option value=\"".$services->allServices[$i][0]."\">";
							echo $services->allServices[$i][1];
						echo "</option>";
					}
				 ?>
			 	</select>
			 </p>

			<p>
				<input type="submit" style="border-radius: 5px;color: #000; text-decoration: none; font-size: 2.5vh; background-color: #b2ff59; padding: 7px 25px; border: none;" name="addChoosen" value="Добавить услугу">
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