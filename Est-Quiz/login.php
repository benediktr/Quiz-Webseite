<?php 
	session_start();
	require('php/functions.php');
	
	if( isset($_SESSION['userid']) ) {
		$access = true;
	} else {
		$access = false;
	}
	
	$id = $_SESSION['userid'];
	$statement = $db->prepare("SELECT * FROM user WHERE id = :id");
	$result = $statement->execute(array('id' => $id));
	$user  = $statement->fetch();
	
	/* Login überprüfung */
	
	$error = false;
	$successfull = false;
	
	if( isset($_GET['login']) ) {
		$username = htmlentities($_POST['username']);
		$password = htmlentities($_POST['password']);
		/* Überprüfe ob der Username vorhanden ist */
		$statement = $db->prepare("SELECT * FROM user WHERE username = :username");
		$result = $statement->execute(array('username' => $username));
		$user  = $statement->fetch();
		
		if( $user == false ){
			$error_message = 'Dieser Username ist nicht vorhanden!';
			$error = true;
		}
		
		if ($user !== false && password_verify($password, $user['password'])) {
			$_SESSION['userid'] = $user['id'];
			$successfull = true;
			header("Location: index.php");
			exit;
		} else {
			$error_message = 'Der Username oder das Passwort ist falsch!';
			$error = true;
		}
	} 
	
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
				<h1>Einloggen</h1>
				<p>Est Quiz-Projekt von Benedikt Ross und Lukas Keller</p>
			</div>
			<hr />
			<?php if( $successfull ) { ?>
				<center><p class = "w3-text-green">Du hast dich erfolgreich eingeloggt! Weiter zur <a href = "index.php">Startseite</a></p></center>
			<?php } if( $error ) { ?>
				<center><p class = "w3-text-red">Fehler beim einloggen!</p></center>
				<center><p class = "w3-text-red"><?php echo $error_message; ?></p></center>
			<?php } if( !$successfull ) { ?>
			<div class="w3-display-middle">
				<form action= "?login=1" method= "post">
					<fieldset style="border-style:none;">
						<p class="w3-label w3-text-green" style="font-weight: bold; margin-bottom: 1%; margin-top: 4%;" >Username</p>
						<input type = "text" size= "30" maxlength ="15" name = "username" class = "w3-input w3-border"/><br />
						<p class="w3-label w3-text-green" style="font-weight: bold; margin-bottom: 1%; margin-top: 2%;" >Passwort</p>
						<input type = "password" size = "30" maxlength ="30" name = "password" class = "w3-input w3-border"/><br />
						<input class = "w3-button w3-white w3-border w3-border-red w3-round-large" type = "submit" style="margin-top: 5%;margin-left:25%;" value ="Einloggen"/>
					</fieldset>
				</form>
				<?php } ?>
			</div>
		</div>
	</body>
</html>