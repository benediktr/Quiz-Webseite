<?php session_start(); ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
 
<?php
	require 'php/functions.php'; 
	
	if(!isset($_SESSION['userid'])) {
		die('Bitte zuerst <a href="login.php">einloggen</a>');
	}
	
	$userid = $_SESSION['userid'];
	$statement = $db->prepare("SELECT * FROM user WHERE id = :id");
	$result = $statement->execute(array('id' => $userid));
	$user  = $statement->fetch();
	
	$username = $user['username'];
	$id = $user['id'];
?>
  
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" >
	<head>
		<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
		<title>EST Quiz-Projekt</title>
		<link rel="stylesheet" type="text/css" href="css/format.css"/>
		<link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet"> 
	</head>
	<body class = "background">
		<nav> <!-- Navigationsleitse -->
			<ul>
				<li>
					<a href="profil.php">Profil</a>
				</li>
				<li>
					<a href="rank.php">Rangliste</a>
				</li>
				<li>
					<a href="addquestion.php">Fragen hinzuf&uuml;genn</a>
				</li>
				<li>
					<a href="play.php">Spiel Starten</a>
				</li>
				<li>
					<a href="logout.php">Ausloggen</a>
				</li>
			</ul>
		</nav>
		<div class="zentrieren" >
		<?php
		
		// Radio Button mit der Antworten
			
			//Frage
			echo '<h1>'.$_SESSION['aktuelleFrage'].' </h1>';
			
			//--------------- Antwort 1 ----------------------------------
			echo '<input type="radio" name="antworten" value="antwort1" ';
			// Wenn Antwort 1 ausgwählt wurde diesen anzeigen
			if($_POST['antworten'] == "antwort1"){
				echo ' checked ';
			}
			echo ' >';
			
			echo $_SESSION['rantwort']. '<br />';
			//--------------- Antwort 2 -----------------------------------
			
			echo '<input type="radio" name="antworten" value="antwort2" ';
			// Wenn Antwort 2 ausgwählt wurde diesen anzeigen
			if($_POST['antworten'] == "antwort2"){
				echo ' checked ';
			}
			echo ' >';
			echo $_SESSION['fantwort1'] .'<br />';
			
			//--------------- Antwort 3 -----------------------------------
			echo '<input type="radio" name="antworten" value="antwort3" ';
			// Wenn Antwort 3 ausgwählt wurde diesen anzeigen
			if(['antworten'] == "antwort3"){
				echo ' checked ';
			}
			echo ' >';
			echo $_SESSION['fantwort2'] .'<br />';
			
			//---------------- Antwort 4 ----------------------------------
			echo '<input type="radio" name="antworten" value="antwort4" ';
			// Wenn Antwort 1 ausgwählt wurde diesen anzeigen
			if($_POST['antworten'] == "antwort4"){
				echo ' checked ';
			}
			echo ' >';
			echo $_SESSION['fantwort3'] .'<br />';
			
		   
		?>
		
			<a href="game.php"> Weiter </a>
			
		</form>
		</div>
		
		
		
		
	</body>
</html>