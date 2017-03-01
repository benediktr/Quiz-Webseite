<?php
	
	$server = 'localhost';
	$pass = '';
	$login = 'root';
	$db_name2 = 'question';

	try { 
		$db2 = new PDO("mysql:host=$server;dbname=$db_name2", $login, $pass);
	}
	catch(PDOException $e) {
		echo 'Verbindung fehlgeschlagen: ' . $e->getMessage();
		exit('Unable to connect Database Questions.');
		
	}
	
	if ( $db2 ) {
		return $db2;
		echo 'true';
	}
	else {
		return false;
		echo 'false';
	}

?>