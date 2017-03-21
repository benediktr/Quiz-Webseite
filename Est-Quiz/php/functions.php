<?php
	$server = 'localhost';
	$db_name = 'est-quiz';
	$login = 'est-quiz';
	$pass = 'k97kccpj';
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
	
	/*function getMaxQuestions( $topic, $db ) {
		$statement = $db->prepare("SELECT * FROM ".$topic." WHERE id = (SELECT MAX(id) FROM ".$topic.")");
		$statement->execute();
		$row = $statement->fetch();
	
		$max_id = $row['id'];	
		
		return $max_id;
	}*/
?>