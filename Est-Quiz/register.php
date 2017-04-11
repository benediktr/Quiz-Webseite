<?php 
	session_start();
	require('php/functions.php');
	
	$showFormular = true;
	$successfull = false; 
	$error = false;
	
	if( isset($_GET['register']) ) {
			$username = htmlentities($_POST['username']);
			$email = htmlentities($_POST['email']);
			$password = htmlentities($_POST['password']);
			$password2 = htmlentities($_POST['password2']);
			$rank = "User";
		
			if( !filter_var($email, FILTER_VALIDATE_EMAIL) ) {
				$error_message = 'Bitte geben Sie eine gültige E-Mail-Adresse ein!<br>';
				$error = true;
			} 	
		
			if( strlen($password) == 0 ) {
				$error_message = 'Bitte geben Sie ein Passwort!<br>';
				$error = true;
			}
			
			if( $password != $password2 ) {
				$error_message = 'Die Passwörter müssen übereinstimmen!<br>';
				$error = true;
			}
	
			if( !$error ) { 
				$statement = $db->prepare("SELECT * FROM user WHERE email = :email");
				$result = $statement->execute(array('email' => $email));
				$user = $statement->fetch();
		
			if( $user !== false ) {
				$error_message = 'Diese E-Mail-Adresse ist bereits vergeben!<br>';
				$error = true;
			}	
		}
	
		if( !$error ) { 
			$statement = $db->prepare("SELECT * FROM user WHERE username = :username");
			$result = $statement->execute(array('username' => $username));
			$user = $statement->fetch();

			if( $user !== false ) {
				$error_message = 'Dieser Username ist bereits vergeben!<br>';
				$error = true;
			}	
		}
	
		if( !$error ) {	
			$password_hash = password_hash($password, PASSWORD_DEFAULT);
			$date = date("Y-m-d H:i:s");
			
			$statement = $db->prepare("INSERT INTO user (username, password, email, registerdate, status) VALUES (:username, :password, :email, :registerdate, :status)");
			$result = $statement->execute(array('username' => $username, 'password' => $password_hash, 'email' => $email, 'registerdate' => $date, 'status' => $rank));
			
			if( $result ) {
				$successfull = true;
				$showFormular = false;
			} 
			
			else {
				$error_message = 'Fehler bei der Registrierung!<br>';
			}
			
			$statement = $db->prepare("SELECT * FROM user WHERE username = :username");
			$result = $statement->execute(array('username' => $username));
			$user  = $statement->fetch();
			
			$_SESSION['userid'] = $user['id'];
			
			header("Location: index.php");
			exit;
		} 
	}
	
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
				<h1>Registrieren</h1>
			</div>
			<hr />
			<div class="w3-display-middle">
				<?php if( $showFormular ) { ?>
				<form action = "?register=1" method = "post">
					<label class="w3-label w3-text-green"><b>Username</b></label>
					<input type = "name"  size = "30" maxlength = "15" name = "username" class = "w3-input w3-border"/><br>
					<label class="w3-label w3-text-green"><b>Passwort</b></label>
					<input type = "password" size = "30" maxlength = "255" name = "password" class = "w3-input w3-border"/><br>
					<label class="w3-label w3-text-green"><b>Passwort wiederholen</b></label>
					<input type = "password" size = "30" maxlength = "255" name = "password2" class = "w3-input w3-border"/><br>
					<label class="w3-label w3-text-green"><b>E-Mail-Addresse</b></label>
					<input type = "email" size = "30" maxlength = "200" name = "email" class = "w3-input w3-border"/><br />
					<center><input class = "w3-button w3-white w3-border w3-border-red w3-round-large" value = "Registrieren" type = "submit"/><center>
				</form>
			</div>
			<?php } if( $error ) { ?>
				<center><p class = "w3-text-red">Fehler beim registrieren!</p></center>
				<center><p class = "w3-text-red"><?php echo $error_message; ?></p></center>
			<?php } if( $successfull ) { ?>
				<center><p class = "w3-text-green">Hallo <?php echo $username; ?>, du hast erfolgreich einen Account erstellt! Du kannst dich nun <a href = "login.php">Einloggen</a>!</p></center>
			<?php } ?>
			</div>
		</div>
	</body>
</html>