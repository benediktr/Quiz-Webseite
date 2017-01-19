<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
  
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" >
	<head>
		<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
		<title>EST Quiz-Projekt</title>
		<link rel="stylesheet" type="text/css" href="css/format.css"/>
		<link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet"> 
	</head>
	<body class = "background">
	<?php
		require 'php/database.php';
		$show_formular = true;
		$successfull = false; 
		$error_exist = false;
		
		if(isset($_GET['register'])) {
			$error_exist = false;
			$username = $_POST['username'];
			$email = $_POST['email'];
			$password = $_POST['password'];
			$password2 = $_POST['password2'];
		
			if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
				$error_message = 'Bitte geben Sie eine gültige E-Mail-Adresse ein!<br>';
				$error_exist = true;
			} 	
		
			if(strlen($password) == 0) {
				$error_message = 'Bitte geben Sie ein Passwort!<br>';
				$error_exist = true;
			}
			
			if($password != $password2) {
				$error_message = 'Die Passwörter müssen übereinstimmen!<br>';
				$error_exist = true;
			}
	
			if(!$error_exist) { 
				$statement = $db->prepare("SELECT * FROM user_accounts WHERE email = :email");
				$result = $statement->execute(array('email' => $email));
				$user = $statement->fetch();
		
			if($user !== false) {
				$error_message = 'Diese E-Mail-Adresse ist bereits vergeben!<br>';
				$error_exist = true;
			}	
		}
	
		if(!$error_exist) { 
			$statement = $db->prepare("SELECT * FROM user_accounts WHERE username = :username");
			$result = $statement->execute(array('username' => $username));
			$user = $statement->fetch();

			if($user !== false) {
				$error_message = 'Dieser Username ist bereits vergeben!<br>';
				$error_exist = true;
			}	
		}
	
		if(!$error_exist) {	
			$password_hash = password_hash($password, PASSWORD_DEFAULT);
			$date = date("Y-m-d H:i:s");
			
			$statement = $db->prepare("INSERT INTO user_accounts (username, password, email, registrierungsdatum) VALUES (:username, :password, :email, :registrierungsdatum)");
			$result = $statement->execute(array('username' => $username, 'password' => $password_hash, 'email' => $email, 'registrierungsdatum' => $date));
			
			if($result) {
				$successfull = true;
			} 
			
			else {
				$error_message = 'Fehler bei der Registrierung!<br>';
			}
			
		} 
	}
	
	if($show_formular) {
	?>
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
		<h1 class = "titel">Registrieren</h1>
		<?php
		if ($successfull) {
			echo "<div class = 'box'><span class = 'green'>Account erfolgreich registriert, $username du kannst dich nun <a href = 'login.php'>einloggen!</a></span></div><br />";
		} 
		if ($error_exist) {
			echo "<div class = 'box'><span class = 'red'>$error_message</span></div><br />";
		} 
		?>
		<div class = "box">
			<form action = "?register=1" method = "post">
				<input type = "name" placeholder = "Username" size = "30" maxlength = "15" name = "username"><br>
				<input type = "password" placeholder = "Passwort" size = "30" maxlength = "255" name = "password"><br>
				<input type = "password" placeholder = "Passwort wiederholen" size = "30" maxlength = "255" name = "password2"><br>
				<input type = "email" placeholder = "E-Mail-Adresse" size = "30" maxlength = "200" name = "email">
				<input type = "submit" class = "registerButton" id = "registerGross" value = "Registrieren">
			</form>
		</div>
		<?php
			}
		?>
	</body>
</html>