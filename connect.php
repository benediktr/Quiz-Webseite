<?php

	$db_host = "localhost";
	$db_name = "animals";
	$db_user = "admin";
	$db_pass = "12345";
	
	$db = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_pass);
		
	if (!$db) {
		echo "Connection failed!";
	}
	else {
		echo "Connection successfully!";
	}
	
?>
