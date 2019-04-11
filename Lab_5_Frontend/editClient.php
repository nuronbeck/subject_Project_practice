<?php 
	
	if (isset($_POST['save_edits']))
	{
		$edited_client_id = $_POST["cl_id"];
		$edited_fio = $_POST["edited_client_fio"];
		$edited_tel = $_POST["edited_client_tel"];

		$url_ed = "http://localhost/lab_2/editClient/".$edited_client_id."&".$edited_fio."&".$edited_tel."";

		function myUrlEncode($string) {
		    $entities = array('%21', '%2A', '%27', '%28', '%29', '%3B', '%3A', '%40', '%26', '%3D', '%2B', '%24', '%2C', '%2F', '%3F', '%25', '%23', '%5B', '%5D');
		    $replacements = array('!', '*', "'", "(", ")", ";", ":", "@", "&", "=", "+", "$", ",", "/", "?", "%", "#", "[", "]");
		    return str_replace($entities, $replacements, urlencode($string));
		}


		$edit_request = json_decode(file_get_contents(myUrlEncode($url_ed)));

		if ($edit_request->result == "Client edited")
		{
			header('Location: http://localhost/Lab_5_Frontend/client.php ');
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
	<title>Редактировать клиента</title>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<link rel="stylesheet" href="clients.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.1/css/all.min.css">
</head>
<body>
	
	<div class="nav_cl">Редактировать клиента</div>
	<div class="wrapper">
		<a href="../Lab_5_Frontend/client.php">
				<i style="font-size: 5vh; color: #000;" class="fas fa-chevron-left"></i>
		</a>
		<form <?php if (isset($_POST["editChoose"])) {echo "hidden";} ?> style="font-size: 3vh; text-align: center;" action="" method="POST">
			<p>Выберите клиента:</p>
			 <p>
			 	<select style="border-radius: 5px;font-size: 2.8vh; padding: 5px 10px;" name="client_select" id="cl">
			 	<?php 
			 		$clients = json_decode(file_get_contents("http://localhost/lab_2/getClients"));

			 		for ($i=0; $i < count($clients->allClients); $i++)
					{ 
						echo "<option value=\"".$clients->allClients[$i][0]."\">";
							echo $clients->allClients[$i][1]." -- ";
							echo $clients->allClients[$i][2];
						echo "</option>";
					}
				 ?>
			 	</select>
			 </p>

			<p><input type="submit" style="border-radius: 5px;color: #000; text-decoration: none; font-size: 2.5vh; background-color: #b2ff59; padding: 7px 25px; border: none;" name="editChoose" value="Редактировать данные"> </p>
		</form>
		

		<form <?php if (!isset($_POST["editChoose"])) {echo "hidden";} ?> action="" method="POST" style="font-size: 3vh; text-align: center;">
			<input type="hidden" name="cl_id" value="<?php if(isset($_POST["editChoose"])){echo $_POST["client_select"];} ?>">
			
			<p>ФИО:</p>
			<p>
				<?php
					if (isset($_POST["editChoose"]))
					{
						$url_str = "http://localhost/lab_2/getClient/".$_POST["client_select"]."";

						function myUrlEncode($string)
						{
						    $entities = array('%21', '%2A', '%27', '%28', '%29', '%3B', '%3A', '%40', '%26', '%3D', '%2B', '%24', '%2C', '%2F', '%3F', '%25', '%23', '%5B', '%5D');
						    $replacements = array('!', '*', "'", "(", ")", ";", ":", "@", "&", "=", "+", "$", ",", "/", "?", "%", "#", "[", "]");
						    return str_replace($entities, $replacements, urlencode($string));
						}

						$get_client_data = json_decode(file_get_contents(myUrlEncode($url_str)));


						for ($i=0; $i < count($get_client_data->client); $i++)
						{ 
							echo "<input style=\"text-align:center;font-size: 3vh; width: 35%;\" name=\"edited_client_fio\" type=\"text\" value=\"".$get_client_data->client[$i][1]."\">";

							echo "<p>Номер:</p>	";

							echo "<input style=\"text-align:center;font-size: 3vh; width: 35%;\" name=\"edited_client_tel\" type=\"text\" value=\"".$get_client_data->client[$i][2]."\">";
						}
					}
				?>
			</p>
			<p>
				<input type="submit" style="border-radius: 5px;color: #000; text-decoration: none; font-size: 2.5vh; background-color: #b2ff59; padding: 7px 25px; border: none;" value="Сохранить изменения" name="save_edits">
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