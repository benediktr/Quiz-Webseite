<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
  
<?php
	require_once('functions.php'); 
	session_start();
	$db = connect_to_db('localhost', 'quiz-project', 'quiz-project', 'project');
?>
  
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" >
	<head>
		<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
		<title>Startseite</title>
		<link rel="stylesheet" type="text/css" href="css/format.css"/>
		<link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet"> 
	</head>
	<body>
		<div id = "background">
		<span id ="heading">Startseite</span>
		</div>
		<br />
		<br />
		<br />
		<br />
		<br />
		<p id = "start" class = "zentriert">
		Quiz-Webseite, Projektarbeit von Benedikt Ross & Lukas Keller <br />
		Herzlich Willkommen [user] <br />
		</p>
		<a class = "zentrieren" href = "logout.php">Ausloggen</a>
	</body>
</html>