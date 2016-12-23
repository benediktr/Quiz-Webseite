<?php

	$server = 'localhost';
	$db_name = 'user';
	$login = 'admin';
	$pass = '12345';

	try { 
		$db = new PDO("mysql:host=$server;dbname=$db_name", $login, $pass);
	}
	catch(PDOException $e) {
		exit('Unable to connect Database.');
	}
	
	if ( $db ) {
		return $db;
	}
	else {
		return false;
	}
?>
