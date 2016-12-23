<?php

	$server = 'localhost';
	$db_name = 'user';
	$login = 'admin';
	$pass = '12345';

	$db = new PDO("mysql:host=$server;dbname=$db_name", $login, $pass);
	if ( $db ) {
		return $db;
	}
	else {
		return false;
	}
?>
