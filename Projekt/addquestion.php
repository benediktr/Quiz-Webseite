<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
 
<?php
	require 'php/database.php'; 
	session_start();
	
	if(!isset($_SESSION['userid'])) {
		die('Bitte zuerst <a href="login.php">einloggen</a>');
	}
	
	$userid = $_SESSION['userid'];
	$statement = $db->prepare("SELECT * FROM user_accounts WHERE id = :id");
	$result = $statement->execute(array('id' => $userid));
	$user  = $statement->fetch();
	
	if(isset($_GET['add'])) {
		// Variablen werden aus dem HTML Teil übernommen werden bzw eingelesen
		$question = ($_POST['question']);
		$r_answer = ($_POST['r_answer']);
		$f_answer_1 = ($_POST['f_answer_1']);
		$f_answer_2 = ($_POST['f_answer_2']);
		$f_answer_3 = ($_POST['f_answer_3']);
	}	
?>
  
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" >
	<head>
		<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
		<title>EST Quiz-Projekt</title>
		<link rel="stylesheet" type="text/css" href="css/format.css"/>
		<link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet"> 
	</head>
	<body class = "background">
		<nav> <!-- Navigationsleitse -->
			<ul>
				<li>
					<a href="profil.php">Profil</a>
				</li>
				<li>
					<a href="addquestion.php">Fragen hinzuf&uuml;en</a>
				</li>
				<li>
					<a href="play.php">Spiel Starten</a>
				</li>
				<li>
					<a href="logout.php">Ausloggen</a>
				</li>
				<li>
					<a href="ranking.php">Rangliste</a>
				</li>
			</ul>
		</nav>
		<!-- Login -->	
		<h1 class = "titel">Fragen hinzuf&uuml;gen</h1>
		<div class = "zentrieren">
			<div class = "frageBox">
				<form action= "?add=1" method= "post">
					<input type = "name" placeholder = "Frage" size = "60" maxlength = "100" name = "question"><br><br />
					<input type = "name" placeholder = "richtige Antwort" size = "30" maxlength = "30" name = "r_answer"><br>
					<input type = "name" placeholder = "falsche Antwort" size = "30" maxlength = "30" name = "f_answer_1"><br>
					<input type = "name" placeholder = "falsche Antwort" size = "30" maxlength = "30" name = "f_answer_2"><br>
					<input type = "name" placeholder = "falsche Antwort" size = "30" maxlength = "30" name = "f_answer_3"><br>
					<input type = "submit" class = "button" value = "Frage hinzufügen">
				</form>
			</div>
		</div>