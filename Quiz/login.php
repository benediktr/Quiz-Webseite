<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
  
<?php
	session_start();
	require_once('functions.php');
	$db = connect_to_db('localhost','user','admin','12345' );
?>
  
  
<?php
if(isset($_GET['login'])){
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
		die('Login erfolgreich! Weiter zur <a href="index2.php">Startseite</a>');
	}
	else {
		$error_message = 'Username oder Passwort ist ungültig!';
	}
}
?>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" >
	<head>
		<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
		<title>Login</title>
		<link rel="stylesheet" type="text/css" href="css/format.css"/>
		<link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet"> 
		
	</head>
	<body>
		<div id = "background">
		<span id ="heading">LOGIN</span>
		</div>
		<br />
		<br />
		<br />
		<br />
		<br />
		<div id = "login">
			<form action= "?login=1" method= "post" class = "form">
				<span id = "textFett">Username</span> <br>
				<input type = "name" placeholder = "dein Username" size= "30" maxlength ="15" name = "username"><br>
				<div id = "textFett">Passwort</span> <br>
				<input type = "password" placeholder = "dein Passwort" size = "30" maxlength ="30" name = "password"><br>
				<input id = "button" type = "submit" value ="Einloggen">
			</form>
		</div>
		<p>
			Noch nicht registriert?
		</p>
		<form action = "register.php">
			<button action = "register.php" type="submit" id ="register">Registrieren</button>
		</form>
		<?php 
			if(isset($error_message)) {
				echo $error_message;
			}
		?>
	</body>
</html>