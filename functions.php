<?php

	// Verbindung zur Datenbank
	function connectToDB($db_host, $db_name, $db_user, $db_pass) {
		
		$pdo = new PDO("'mysql:host=$dbhost;dbname=$db_name, $db_user, $db_pass'");
		
		if($pdo) {
			echo 'Verbindung erfolgreich!';
		} 
		else {
			echo 'Verbindung nicht erfolgreich!';
		}
	}

	// Zum hinzufügen von Fragen
	function addQuestions($question, $r_answer1, $f_answer2, $f_answer3, $f_answer4) {
		$sql = "INSERT INTO `easy`(`questions`, `r_answer_1`, `f_answer_2`, `f_answer_3`, `f_answer_4`) VALUES (`$question`, `$r_answer1`, `$f_answer2`, `$f_answer2`, `$f_answer4`);";
		mysql_query($sql, $db);
	}
	
?>