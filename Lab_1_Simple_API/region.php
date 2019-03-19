<?php 

	header('Content-Type: application/json');
	require('index.php');
	RegionByCode(basename($_SERVER['REQUEST_URI']));

 ?>