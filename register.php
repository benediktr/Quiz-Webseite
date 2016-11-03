<!DOCTYPE html>

<?php
require_once('functions.php'); 
session_start();
$db = connect_to_db('localhost', 'user', 'admin', '12345');
?>

<html>
	<head>
		<title>Quiz-Webseite</title>
	</head>
	<body>
		<strong>Registrierung</strong>
		<hr>
	</body>
</html>

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
		$error = true;
	} 	
	if(strlen($password) == 0) {
		echo 'Bitte geben Sie ein Passwort!<br>';
		$error = true;
	}
	if($password != $password2) {
		echo 'Die Passwörter müssen übereinstimmen<br>';
		$error = true;
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
			die ('Sie haben erfolgreich einen Account erstellt! <a href="login.php">Weiter zum Login</a>');
			$show_formular = false;
		} else {
			echo 'Fehler bei der Registrierung!<br>';
		}
	} 
}

if($show_formular) {

?>

<form action = "?register=1" method = "post">
Username:<br>
<input type = "name" size = "30" maxlength = "15" name = "username"><br>
Passwort:<br>
<input type = "password" size = "30" maxlength = "30" name = "password"><br>
Passwort wiederholen:<br>
<input type = "password" size = "30" maxlength = "30" name = "password2"><br>
E-Mail:<br>
<input type = "email" size = "30" maxlength = "200" name = "email"><br><br>
<input type = "submit" value = "Registrieren">
</form>

<?php
}
?>
