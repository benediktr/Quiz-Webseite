<?php
function connect_to_db($db_host, $db_name, $db_user, $db_pass) {
	$db = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_pass);
	if($db) {
		return $db;
	}
	else {
		echo "Connection failed!";
	}
}
function add_question_to_db($question, $r_answer1, $f_answer2, $f_answer3, $f_answer4, $db_name, $topic) {
	$add_data = "INSERT INTO $db_name (topic, question, urlname, name, banner, beschreibung) VALUES ('$topic', '$question', '$r_answer1', '$f_answer2', '$f_answer3', '$f_answer4')";
	// Eintrag an die Datenbank übergeben, mit MySQLi realisieren?
}
?>
