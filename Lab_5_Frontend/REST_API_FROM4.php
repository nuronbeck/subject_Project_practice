<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Вызов REST API</title>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<link rel="stylesheet" href="clients.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.1/css/all.min.css">
</head>
<body>
	
	<div class="nav_cl">Вызов REST API</div>
	<div class="wrapper">
		<a href="../Lab_5_Frontend/">
				<i style="font-size: 5vh; color: #000;" class="fas fa-chevron-left"></i>
		</a>
		<form style="font-size: 3vh; text-align: center;" action="" method="POST">
			<p>
				<span style="color: #ff0000; background-color: #ffc; padding: 7px 20px; border-radius: 5px; border: 1px solid #c5c5c5;">http://localhost/LAB4_REST/callapi</span>
			</p>
			<p><input type="submit" style="border-radius: 5px;color: #000; text-decoration: none; font-size: 2.5vh; background-color: #b2ff59; padding: 7px 25px; border: none;" name="callREST" value="Вызвать REST API"> </p>
		</form>
		<br>
		<br>

		<p <?php if (!isset($_POST['callREST'])){echo "hidden";} ?> style="font-size: 3vh; text-align: center;">РЕЗУЛЬТАТ:</p>
		<br><br>
		<p <?php if (!isset($_POST['callREST'])){echo "hidden";} ?> style="text-align: center;">
			<span style="font-size: 2.5vh; border-radius: 5px; box-shadow: 1px 5px 10px rgba(0,0,0,0.2); color: green; width: 50%; padding: 50px; background-color: #f0f0f0; margin: 0 auto;">
			<?php 
	
				if (isset($_POST['callREST']))
				{
					$url_str = "http://localhost/LAB4_REST/callapi/";
					$callapiREST = json_decode(file_get_contents($url_str));

					echo $callapiREST->result;

				}

			 ?>
			</span>
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