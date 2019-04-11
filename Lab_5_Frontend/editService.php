<?php 
	
	if (isset($_POST['save_edits']))
	{
		$edited_service_id = $_POST["serv_id"];
		$edited_service_name = $_POST["edited_service_name"];

		$url_ed = "http://localhost/lab_2/editService/".$edited_service_id."&".$edited_service_name;

		function myUrlEncode($string) {
		    $entities = array('%21', '%2A', '%27', '%28', '%29', '%3B', '%3A', '%40', '%26', '%3D', '%2B', '%24', '%2C', '%2F', '%3F', '%25', '%23', '%5B', '%5D');
		    $replacements = array('!', '*', "'", "(", ")", ";", ":", "@", "&", "=", "+", "$", ",", "/", "?", "%", "#", "[", "]");
		    return str_replace($entities, $replacements, urlencode($string));
		}


		$edit_request = json_decode(file_get_contents(myUrlEncode($url_ed)));

		if ($edit_request->result == "Service edited")
		{
			header('Location: http://localhost/Lab_5_Frontend/services.php ');
		}
	}

	

 ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Редактировать услугу</title>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<link rel="stylesheet" href="clients.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.1/css/all.min.css">
</head>
<body>
	
	<div class="nav_cl">Редактировать услугу</div>
	<div class="wrapper">
		<a href="../Lab_5_Frontend/services.php">
				<i style="font-size: 5vh; color: #000;" class="fas fa-chevron-left"></i>
		</a>
		<form <?php if (isset($_POST["editChoose"])) {echo "hidden";} ?> style="font-size: 3vh; text-align: center;" action="" method="POST">
			<p>Выберите услугу:</p>
			 <p>
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

			<p><input type="submit" style="border-radius: 5px;color: #000; text-decoration: none; font-size: 2.5vh; background-color: #b2ff59; padding: 7px 25px; border: none;" name="editChoose" value="Редактировать данные"> </p>
		</form>
		

		<form <?php if (!isset($_POST["editChoose"])) {echo "hidden";} ?> action="" method="POST" style="font-size: 3vh; text-align: center;">
			<input type="hidden" name="serv_id" value="<?php if(isset($_POST["editChoose"])){echo $_POST["service_select"];} ?>">
			
			<p>Наименование услуги:</p>
			<p>
				<?php
					if (isset($_POST["editChoose"]))
					{
						$url_str = "http://localhost/lab_2/getService/".$_POST["service_select"]."";

						function myUrlEncode($string)
						{
						    $entities = array('%21', '%2A', '%27', '%28', '%29', '%3B', '%3A', '%40', '%26', '%3D', '%2B', '%24', '%2C', '%2F', '%3F', '%25', '%23', '%5B', '%5D');
						    $replacements = array('!', '*', "'", "(", ")", ";", ":", "@", "&", "=", "+", "$", ",", "/", "?", "%", "#", "[", "]");
						    return str_replace($entities, $replacements, urlencode($string));
						}

						$get_service_data = json_decode(file_get_contents(myUrlEncode($url_str)));


						for ($i=0; $i < count($get_service_data->service); $i++)
						{ 
							echo "<input style=\"text-align:center;font-size: 3vh; width: 35%;\" name=\"edited_service_name\" type=\"text\" value=\"".$get_service_data->service[$i][1]."\">";


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