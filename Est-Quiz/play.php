<?php
	session_start();
	require 'php/functions.php'; 
	
	if( isset($_SESSION['userid']) ) {
		$access = true;
	} else {
		$access = false;
	}
	
	$userid = $_SESSION['userid'];
	$statement = $db->prepare("SELECT * FROM user WHERE id = :id");
	$result = $statement->execute(array('id' => $userid));
	$user  = $statement->fetch();
	
	$username = $user['username'];
	
	//Sessions Variablen zurücksetzen
	unset($_SESSION['themaQuestion']);
	unset($_SESSION['themaScore']);
	unset($_SESSION['ersteMal']);
	unset($_SESSION['IDaktuelleFrage']);
	unset($_SESSION['durchlauf']);
	
	//Counter fuer die richtig und falsch beantworteten Fragen auf 0 setzten
	$_SESSION['falschBeantworteteFragen'] = 0;
	$_SESSION['richtigBeantworteteFragen'] = 0;

	//Counter fuer die Runden auf eins setzen
	//Rollen sind immer 10 Durchgänge
	$_SESSION['runden'] = 1;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
  
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" >
	<head>
		<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
		<title>EST Quiz-Projekt</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="https://www.w3schools.com/w3css/3/w3.css">
	</head>
	<body>
		<!-- Sidebar -->
		<div class="w3-sidebar w3-light-grey w3-bar-block" style="width:15%">
			<h3 class="w3-bar-item">Est Quiz-Projekt</h3>
			<?php if( !$access) { ?>
			<a href="index.php" class="w3-bar-item w3-button">Startseite</a>
			<a href="login.php" class="w3-bar-item w3-button">Einloggen</a>
			<a href="register.php" class="w3-bar-item w3-button">Registrieren</a>
			<a href="https://github.com/benediktr/Quiz-Webseite/wiki/Projekttagebuch" class="w3-bar-item w3-button">Projekttagebuch</a>
			<?php } else { ?>
			<a href="index.php" class="w3-bar-item w3-button">Startseite</a>
			<a href="profil.php" class="w3-bar-item w3-button">Profil</a>
			<?php if( strcmp($user['status'], "Admin") == 0 ) { ?>
			<a href="admin.php" class="w3-bar-item w3-button">Adminpanel</a>
			<?php } ?>
			<a href="rank.php" class="w3-bar-item w3-button">Rangliste</a>
			<a href="addquestion.php" class="w3-bar-item w3-button">Fragen hinzufügen</a>
			<a href="play.php" class="w3-bar-item w3-button">Quiz Starten</a>
			<a href="logout.php" class="w3-bar-item w3-button">Ausloggen</a>
			<?php } ?>
		</div>
		<!-- Content -->
		<div style="margin-left:15%">
			<div class="w3-container w3-teal">
				<h1>Profil</h1>
				<p>Est Quiz-Projekt von Benedikt Ross und Lukas Keller</p>
			</div>
			<hr />
			<?php if( !$access ) { ?>
				<center>
					<p>Bitte zuerst <a href = "login.php">Einloggen</a>!</p>
				</center>
			<?php } else { ?>
			<center>
				<div class="w3-container">
					<div class = 'box'><span class = 'green'>Wähle aus einer der Themengebiete das Thema für dein Quiz</a></span></div><br />
				
					<form action = "game.php" method = "post">
						<select name = "topics" class="w3-select" style = "width: 50%;">
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
						<br />
						<br />
						<input class = "w3-button w3-white w3-border w3-border-red w3-round-large" type="submit" value="Weiter" style="margin: 2%;"/>
					</form>
			
				</div>
			</center>
			<?php } ?>
		</div>
	</body>
</html>