<?php
	date_default_timezone_set('Asia/Bangkok');  
	putenv("TZ=Asia/Bangkok");
	$dtNow = date_create()->format('Y-m-d H:i:s');

	$hostname = "localhost";
	$username = "root";
	$password = "123456789"; 
	$database = "cactus";
	$conn =  new mysqli($hostname, $username, $password, $database) or trigger_error(mysql_error(),E_USER_ERROR);
	mysqli_query($conn, "SET NAMES UTF8");
?>
