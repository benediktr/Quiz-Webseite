<!DOCTYPE html>
<?php
 session_start();
 require_once('functions.php');
 $db = connect_to_db('localhost','user','admin','12345' );
?>

<?php
if(isset($_GET['login'])){
	// Variablen werden aus dem HTML Teil übernommen werden bzw eingelesen
	$error_exist = false;
	$username = mysql_real_escape_string($_POST['username']);
	$password = mysql_real_escape_string($_POST['password']);
	
	// Überprüfe ob der User vorhanden ist
	$statement = $db->prepare("SELECT * FROM user_accounts WHERE username = :username");
	$result = $statement->execute(array('username' => $username));
	$user  = $statement->fetch();
	if($user == false){
		echo 'Diese Username ist nicht vorhanden!';
		$error_exist = true;
	}
	if ($user !== false && crypt($user['password'], $password) == $user['password']) {
		$_SESSION['userid'] = $user['id'];
		die('Login erfolgreich! Weiter zur <a href="index2.php">Startseite</a>');
	}
	else {
		$error_message = 'Username oder Passwort ist ungültig!';
	}
	
}
?>

<html>
<head>
	<title>Login</title>
</head>
<body>
<?php 
if(isset($error_message)) {
	echo $error_message;
}
?>
	<strong> Login </strong>
</body>
<form action= "?login=1" method= "post">
Username: <br>
<input type = "name" size= "30" maxlength ="15" name = "username"><br>
 Passwort: <br>
<input type = "password" size="30" maxlength ="30" name = "password"><br><br>
<input type = "submit" value ="Login">
</form>
</html>
