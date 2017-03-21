<?php session_start(); ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
 
<?php
	require 'php/functions.php'; 
	
	if(!isset($_SESSION['userid'])) {
		die('Bitte zuerst <a href="login.php">einloggen</a>');
	}
	
	$userid = $_SESSION['userid'];
	$statement = $db->prepare("SELECT * FROM user WHERE id = :id");
	$result = $statement->execute(array('id' => $userid));
	$user  = $statement->fetch();
	
	$username = $user['username'];
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
					<a href="rank.php">Rangliste</a>
				</li>
				<li>
					<a href="addquestion.php">Fragen hinzuf&uuml;genn</a>
				</li>
				<li>
					<a href="play.php">Spiel Starten</a>
				</li>
				<li>
					<a href="logout.php">Ausloggen</a>
				</li>
			</ul>
		</nav>
		<h1 class = "titel">Quiz</h1>
		<div class = "zentrieren">
			<div class = "frageBox">
				<div class = 'box'><span class = 'green'>Wähle aus einer der Themengebiete das Thema für dein Quiz</a></span></div><br />
				
				<form action = "game.php" method = "post">
					<select name = "topics">
						<option value = "art">Kunst</option>
						<option value = "bible">Bibel</option>
						<option value = "eating">Essen</option>
						<option value = "freetime">Sport</option>
						<option value = "geography">Kulturen</option>
						<option value = "history">Geschichte</option>
						<option value = "movies">Filme</option>
						<option value = "music">Musik</option>
						<option value = "nature">Natur</option>
						<option value = "politics">Politik</option>
						<option value = "science">Wissenschaft</option>
						<option value = "series">TV Serien</option>
						<option value = "technology">Technologien</option>
						
					</select>
					
					<br /><br /><br />
					
					<input type="submit" class="button" value="Weiter" />
				</form>
			
			</div>
		</div>
	</body>
</html>