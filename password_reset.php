<!DOCTYPE html>
<?php
 session_start();
 require_once('functions.php');
 $db = connect_to_db('localhost','user','admin','12345' );
?>

<?php
$show_formular = true;

if(isset($_GET['send']) ) {
		if(!isset($_POST['old_password']) || empty($_POST['old_password'])) {
			echo 'Bitte geben Sie ihr altes Passwort ein!';
		}
		if(!isset($_POST['email']) || empty($_POST['email'])) {
			echo 'Bitte geben Sie ihre E-Mail ein!';
		}
		if (isset($_POST['old_password']) && isset($_POST['email'])) {
			$statement = $pdo->prepare("SELECT * FROM users WHERE email = :email");
			$result = $statement->execute(array('email' => $_POST['email']));
			$user = $statement->fetch();	
			if ($user === false) {
				echo 'Kein Benutzer gefunden!';
			}
		}
		if(isset($_GET['send'])) {
			$passwort = $_POST['passwort'];
			$passwort2 = $_POST['passwort2'];
	
		if($passwort != $passwort2) {
			echo 'Bitte identische Passwörter eingeben!';
		} 
		else { 
			$passworthash = password_hash($passwort, PASSWORD_DEFAULT);
			$statement = $pdo->prepare("UPDATE users SET passwort = :passworthash, passwortcode = NULL, passwortcode_time = NULL WHERE id = :userid");
			$result = $statement->execute(array('passworthash' => $passworthash, 'userid'=> $userid ));
		
			if($result) {
			die('Dein Passwort wurde erfolgreich geändert!');
			}
		}
	}
}
			

if($show_formular) {
?>

<form action = "?reset=1" method = "post">
Ihre E-Mail:<br>
<input type = "email" size = "30" maxlength = "50" name = "email"><br>
Altes Passwort:<br>
<input type = "password" size = "30" maxlength = "30" name = "old_password"><br>
Passwort wiederholen:<br>
<input type = "password" size = "30" maxlength = "30" name = "new_password"><br>
Passwort:<br>
<input type = "password" size = "30" maxlength = "200" name = "new_password2"><br><br>
<input type = "submit" value = "Passwort Ändern">
</form>

<?php
}
?>
Passwort:<br>
<input type = "password" size = "30" maxlength = "200" name = "new_password2"><br><br>
<input type = "submit" value = "Passwort Ändern">
</form>

<?php
}
?>
