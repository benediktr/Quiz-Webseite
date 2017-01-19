<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
  
<?php
	session_start();
	require 'php/database.php';
	$error_exist = false;
	$successfull = false; 
	
	if(isset($_GET['login'])) {
		// Variablen werden aus dem HTML Teil übernommen werden bzw eingelesen
		$error_exist = false;
		$username = ($_POST['username']);
		$password = ($_POST['password']);
		// Überprüfe ob der User vorhanden ist
		$statement = $db->prepare("SELECT * FROM user_accounts WHERE username = :username");
		$result = $statement->execute(array('username' => $username));
		$user  = $statement->fetch();
		if($user == false){
			$error_message = 'Dieser Username ist nicht vorhanden!';
			$error_exist = true;
		}
		if ($user !== false && password_verify($password, $user['password'])) {
			$_SESSION['userid'] = $user['id'];
			$successfull = true;
		}
		else {
			$error_message = 'Username oder Passwort ist ungültig!';
		}
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
					<a href="index.html">Startseite</a>
				</li>
				<li>
					<a href="login.php">Login</a>
				</li>
				<li>
					<a href="register.php">Registrieren</a>
				</li>
				<li>
					<a href="https://github.com/benediktr/Quiz-Webseite/wiki/Projekttagebuch">Projekttagebuch</a>
				</li>
			</ul>
		</nav>
		<!-- Login -->	
		<h1 class = "titel">Login</h1>
		<?php
			if ($error_exist) {
				echo "<div class = 'box'><span class = 'red'>$error_message</span></div><br />";
			}
			if ($successfull) {
				echo "<div class = 'box'><span class = 'green'>Willkommen <span class = 'gross'>$username</span>, du hast dich erfolgreich eingeloggt, weiter ins  <a href = 'game.php'>Spiel!</a></span></div><br />";
			}
		?>
		<div class = "box">
			<form action= "?login=1" method= "post" class = "form">
				<input type = "name" placeholder = "Username" size= "30" maxlength ="15" name = "username"><br>
				<input type = "password" placeholder = "Passwort" size = "30" maxlength ="30" name = "password"><br>
				<input class = "button" type = "submit" value ="Einloggen">
			</form>
		</div>
	</body>
</html>