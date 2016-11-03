<!DOCTYPE html>
<?php
 session_start();
 require_once('functions.php');
 connect_to_db(localhost,'user','admin','12345' );
$>

<html>
	<head>
		<title>Login</title>
	</head>
	<body>
		<strong> Login </strong>
	</body>

</html>

<form action= "?login=1" method= "post">
Username: <br>
<input type = "name" size= "30" maxlength ="15" name = "username"><br>
 Passwort: <br>
<input type = "password" size="30" maxlength ="30" password = "password"><br><br>
<input type = "submit" value ="Login">
</form>

<?php
if(isset($_GET['login'])){
	// Variablen welche sud dem HTML Teil übernommen werden bzw eingelesen
	$error_exist = false;
	$username = $_POST['username'];
	$password = $_POST['password'];
	
	//Überprüfe ob der User vorhanden ist
	$statement = $pdo->prepare("SELECT * FROM user_accounts WHERE username = :username");
	$result = $statement->execute(array('username' => $username);
	$user  = $statement->fetch();
	if($user == false){
		echo 'Diese Username ist nicht vorhanden!';
		$erroer_exists =true;
	}

	//Überprüfen ob alles richtig angeben wurde, falls nicht setze $error_exist auf true 
	if(strlen($password)==0){
		echo "Bitte geben Sie ein Passwort am! <br>";
		§error_exist = true;
	}
}

	
