<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
  
<?php
	require 'database.php'; 
	session_start();
?> 
  
<?php
	$show_formular = true;
	if(isset($_GET['register'])) {
		$error_exist = false;
		$username = $_POST['username'];
		$email = $_POST['email'];
		$password = $_POST['password'];
		$password2 = $_POST['password2'];
	
		if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
			echo 'Bitte geben Sie eine gültige E-Mail-Adresse ein!<br>';
			$error_exist = true;
		} 
		
		if(strlen($password) == 0) {
			echo 'Bitte geben Sie ein Passwort!<br>';
			$error_exist = true;
		}
		
		if($password != $password2) {
			echo 'Die Passwörter müssen übereinstimmen!<br>';
			$error_exist = true;
		}
	
		if(!$error_exist) { 
			$statement = $db->prepare("SELECT * FROM user_accounts WHERE email = :email");
			$result = $statement->execute(array('email' => $email));
			$user = $statement->fetch();
		
			if($user !== false) {
				echo 'Diese E-Mail-Adresse ist bereits vergeben!<br>';
				$error_exist = true;
			}	
		}
	
			if(!$error_exist) { 
			$statement = $db->prepare("SELECT * FROM user_accounts WHERE username = :username");
			$result = $statement->execute(array('username' => $username));
			$user = $statement->fetch();
		
			if($user !== false) {
				echo 'Dieser Username ist bereits vergeben!<br>';
				$error_exist = true;
			}	
		}
	
		if(!$error_exist) {	
			$password_hash = password_hash($password, PASSWORD_DEFAULT);
			
			$statement = $db->prepare("INSERT INTO user_accounts (username, email, password) VALUES (:username, :email, :password)");
			$result = $statement->execute(array('username' => $username, 'email' => $email, 'password' => $password_hash));
		
			if($result) {
				$statement = $db->prepare("SELECT * FROM user_accounts WHERE username = :username");
				$result = $statement->execute(array('username' => $username));
				$user  = $statement->fetch();
				$_SESSION['userid'] = $user['id'];
				$id = $user['id'];
				echo "Ihre User ID: $id<br />";
				$idscore = $db->prepare("INSERT INTO user_scores (userid, total_score, s_bible, s_sport_freetime, s_eating_drinking, s_geography_countries, s_movies, s_time_history, s_art_design, s_music, s_series, s_politics, s_science, s_animals_nature, s_technology) VALUES (:1, :0, :0, :0, :0, :0, :0, :0, :0, :0, :0, :0, :0, :0, :0)");
				$resultscore = $idscore->execute(array('userid' => $id, 'total_score' => 0, 's_bible' => 0, 's_sport_freetime' => 0, 's_eating_drinking' => 0, 's_geography_countries' => 0, 's_movies' => 0, 's_time_history' => 0, 's_art_design' => 0, 's_music' => 0, 's_series' => 0, 's_politics' => 0, 's_science' => 0, 's_animals_nature' => 0, 's_technology' => 0));
				die ('Sie haben erfolgreich einen Account erstellt! <a href="index2.php">Weiter zur Startseite</a>');
				$show_formular = false;
			} else {
				echo 'Fehler bei der Registrierung!<br>';
			}
		} 
	}
	if($show_formular) {
		
	?>
	<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" >
	<head>
		<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
		<title>Registrieren</title>
		<link rel="stylesheet" type="text/css" href="css/format.css"/>
		<link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet"> 
		<link rel="stylesheet" type="text/css" href="css/format_register.css"/>
	</head>
	<body>
		<div id = "background">
		<span id ="heading">REGISTRIEREN</span>
		</div>
		<br />
		<br />
		<br />
		<br />
		<br />
	</body>
		<div id = "registerBox">
		<form action = "?register=1" method = "post" class = "form">
			Username<br>
			<input type = "name" placeholder = "dein Username" size = "30" maxlength = "15" name = "username"><br>
			Passwort<br>
			<input type = "password" placeholder = "dein Passwort" size = "30" maxlength = "255" name = "password"><br>
			Passwort wiederholen<br>
			<input type = "password" placeholder = "dein Passwort wiederholen" size = "30" maxlength = "255" name = "password2"><br>
			E-Mail<br>
			<input type = "email" placeholder = "deine E-Mail-Adresse" size = "30" maxlength = "200" name = "email"><br><br>
			<input type = "submit" id = "registerGross" value = "Registrieren">
		
		</form>
		
		<p>
			Bereits registriert?
		</p>
		<form action = "login.php">
			<button action = "login.php" type="submit" id ="einloggen">Einloggen</button>
		</form>
		</div>
	</html>
<?php
}
?>
