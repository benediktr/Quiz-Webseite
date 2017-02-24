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
	
	// Zweite Datenbank mit den Fragen


	try { 
		$db2 = new PDO('mysql:host=localhost;dbname=questions', 'benutzer', '12345');
	}
	catch(PDOException $e) {
		exit('Unable to connect Database.');
	}
	
	if ( $db2 ) {
		return $db2;
	}
	else {
		return false;
	}
	
?>
