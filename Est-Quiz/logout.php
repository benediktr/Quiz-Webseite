<?php 
	session_start();
	session_destroy();
	$access = false;
	
	header("Location: index.php");
	exit;
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
  
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" >
	<head>
		<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
		<title>EST Quiz-Projekt</title>
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<link rel="stylesheet" href="https://www.w3schools.com/w3css/3/w3.css" />
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
				<h1>Logout</h1>
				<p>Est Quiz-Projekt von Benedikt Ross und Lukas Keller</p>
			</div>
			<hr />
			<p style="text-align:center;">Du hast dich erfolgreich ausgeloggt! Zur&uuml;ck zur <a href = "index.php">Startseite</a></p>
		</div>
	</body>
</html>