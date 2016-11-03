<!DOCTYPE html>
<?php
 session_start();
 require_once('functions.php');
 $db = connect_to_db('localhost','user','admin','12345' );
?>

<?php
$show_formular = true;

if(isset($_GET['reset'])) {
	$error_exist = false;
	$old_password = $_POST['old_password'];
	$new_password = $_POST['new_password'];
	$new_password2 = $_POST['new_password2'];
	$benutzername;
	
	if(strlen($old_password) == 0) {
		echo 'Bitte geben Sie ihr altes Passwort ein!<br>';
		$error_exist = true;
	}
	if($new_password != $new_password2) {
		echo 'Die Passwörter müssen übereinstimmen<br>';
		$error_exist = true;
	}
	if(!$error_exist) {	
		$password_hash = password_hash($new_password, PASSWORD_DEFAULT);
		
		$statement = $db->prepare("INSERT INTO user_accounts (password) VALUES (:password)");
		$result = $statement->execute(array('password' => $password_hash));
		
		if($result) {		
			die ('Sie haben erfolgreich ihr Passwort geändert! <a href="index2.php">Weiter zur Startseite</a>');
			$show_formular = false;
		} else {
			echo 'Fehler bei der Änderung ihres Passworts!<br>';
		}
	} 
}

if($show_formular) {

?>

<form action = "?reset=1" method = "post">
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
