<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
  
<?php
	require 'database.php'; 
	session_start();
	
	if(!isset($_SESSION['userid'])) {
		die('Bitte zuerst <a href="login.php">einloggen</a>');
	}
 
	$userid = $_SESSION['userid'];
	
	// Username rausfiltern
	
	$data = $db->prepare('SELECT username FROM user_accounts WHERE id = :id');
	$data->bindParam(':id', $_SESSION['userid']);
	$data->execute();
	
	$datas = $data->fetch(PDO::FETCH_ASSOC);
	
	$user = NULL;
	
	if( count($datas) > 0 ) {
		$user = $datas;
		$username = $user['username'];
	}	


?>
  
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" >
	<head>
		<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
		<title>Fragen hinzufügen</title>
		<link rel="stylesheet" type="text/css" href="css/format.css"/>
		<link rel="stylesheet" type="text/css" href="css/format_questions.css"/>
		<link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet"> 
	</head>
	<body>
		<div id = "background">
			<span id ="heading">Frage Hinzufügen</span>
		</div>
		<br /><br /><br /><br /><br />
		<div class = "zentrieren">
			<center><div class="select-style">
				<select>
					<option value = "1">Kunst</option>
					<option value = "2">Bibel</option>
					<option value = "3">Essen</option>
					<option value = "4">Sport</option>
					<option value = "5">Kulturen</option>
					<option value = "6">Geschichte</option>
					<option value = "7">Filme</option>
					<option value = "8">Musik</option>
					<option value = "9">Natur</option>
					<option value = "10">Politik</option>
					<option value = "11">Wissenschaft</option>
					<option value = "12">Technologien</option>
					<option value = "13">Serien</option>
				</select>
			</div></center>
			<br />
			<br />
			<input type = "name" placeholder = "Frage" size = "60" maxlength = "100" name = "question"><br><br />
			<input type = "name" placeholder = "richtige Antwort" size = "30" maxlength = "30" name = "r_answer"><br>
			<input type = "name" placeholder = "falsche Antwort" size = "30" maxlength = "30" name = "f_answer_1"><br>
			<input type = "name" placeholder = "falsche Antwort" size = "30" maxlength = "30" name = "f_answer_2"><br>
			<input type = "name" placeholder = "falsche Antwort" size = "30" maxlength = "30" name = "f_answer_3"><br>
			<input type = "submit" id ="button" value = "Frage hinzufügen">
		</div>	
	</body>
</html>