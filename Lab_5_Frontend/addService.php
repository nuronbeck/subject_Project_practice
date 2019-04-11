<?php 
	
	if (isset($_POST['addButton']))
	{
		$new_service_name = str_replace(" ", "%20", $_POST['new_service_name']);

		$url_str = "http://localhost/lab_2/addService/".$new_service_name;

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
	<title>Добавить услугу</title>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<link rel="stylesheet" href="clients.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.1/css/all.min.css">
</head>
<body>
	
	<div class="nav_cl">Добавить услугу</div>
	<div class="wrapper">
		<a href="../Lab_5_Frontend/services.php">
				<i style="font-size: 5vh; color: #000;" class="fas fa-chevron-left"></i>
		</a>
		<form style="font-size: 3vh; text-align: center;" action="" method="POST">
			<p>Наименование новой услуги:</p>
			<p><input type="text" style="font-size: 3vh; width: 35%;" name="new_service_name"> </p>

			<p><input type="submit" style="border-radius: 5px;color: #000; text-decoration: none; font-size: 2.5vh; background-color: #b2ff59; padding: 7px 25px; border: none;" name="addButton" value="Добавить"> </p>
		</form>

		<?php 
			if (isset($_POST['addButton']))
			{
				if ($add_request->result == "Service added")
				{
					echo "<p style=\"text-align: center; color: green; font-size: 3vh;\">";
					echo "Услуга добавлена!";
					echo "</p>";
				}
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