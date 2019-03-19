<?php 

	header('Content-Type: application/json');
	require('index.php');
	fibonachchi(basename($_SERVER['REQUEST_URI']));

 ?>