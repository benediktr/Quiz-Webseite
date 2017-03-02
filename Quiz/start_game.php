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
		<title>Themenauswahl</title>
		<link rel="stylesheet" type="text/css" href="css/format.css"/>
		<link rel="stylesheet" type="text/css" href="css/format_game.css"/>
		<link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet"> 
	</head>
	<body>
		<div id = "background">
			<span id ="heading">Themenauswahl</span>
		</div>
		

	
		<div id="Themenauswahl">
		<!-- Formular zur Auswahl der Fragen -->
			<form action="game.php" method="post" >
			
				<input type="radio" name="thema" value="Kunst" /> <label> Kunst </label> <br />
				<input type="radio" name="thema" value="Bibel" /> <label> Bibel </label> <br />
				<input type="radio" name="thema" value="Essen" /> <label> Essen </label> <br />
				<input type="radio" name="thema" value="Sport" /> <label> Sport </label> <br />
				<input type="radio" name="thema" value="Kulturen" /> <label> Kulturen </label> <br />
				<input type="radio" name="thema" value="Geschichte" /> <label> Geschichte</label> <br />
				<input type="radio" name="thema" value="Natur und Tiere" /> <label> Natur und Tiere </label> <br />
				<input type="radio" name="thema" value="Politik" /> <label> Politik </label> <br />
				<input type="radio" name="thema" value="Wissenschaft" /> <label> Wissenschaft </label> <br />
				<input type="radio" name="thema" value="Technologien" /> <label> Technologien </label> <br />
				<input type="radio" name="thema" value="Serien" /> <label> Serien </label> <br />
			
				<input type="submit" id="spielstartenbutton" value="Spiel Starten">
			</form>
		</div>

		
		
	</body>
</html>