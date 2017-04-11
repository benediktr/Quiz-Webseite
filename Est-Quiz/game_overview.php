<?php 
	session_start(); 
	require 'php/functions.php'; 
	
		if( isset($_SESSION['userid']) ) {
		$access = true;
	} else {
		$access = false;
	}
	
	$userid = $_SESSION['userid'];
	$statement = $db->prepare("SELECT * FROM user WHERE id = :id");
	$result = $statement->execute(array('id' => $userid));
	$user  = $statement->fetch();
	
	$username = $user['username'];
	$id = $user['id'];
	
	//Maximale Anzahl fragen holen
	$statement_max_question = $db->prepare("SELECT * FROM ".$_SESSION['themaQuestion']." WHERE id = (SELECT MAX(id) FROM ".$_SESSION['themaQuestion'].")");
	$statement_max_question->execute();
	$row = $statement_max_question->fetch();
	$_SESSION['maximaleAnzahlAnFragen']= $row['id'];
	
	//Pruefen ob noch eine Runde moeglich ist
	if(($_SESSION['maximaleAnzahlAnFragen']-$_SESSION['IDaktuelleFrage'])<10){
		$_SESSION['zuWenigFragen'] = true;
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
				<h1>Profil</h1>
				<p>Est Quiz-Projekt von Benedikt Ross und Lukas Keller</p>
			</div>
			<hr />
			<?php if( !$access ) { ?>
				<center><p>Bitte zuerst <a href = "login.php">Einloggen</a>!</p></center>
			<?php } else { ?>
			<div class="w3-container" >
				<center>
					<div class="w3-panel w3-blue">
 						 <h1 class="w3-opacity">Ergebnis der <?php echo $_SESSION['runden']; ?>. Runde</h2>
					</div> 
					
					<p>Richtige Antworten <span class="w3-badge w3-green"><?php echo $_SESSION['richtigBeantworteteFragen']; ?></span></p>
					<p>Falsche Antworten <span class="w3-badge w3-red"><?php echo $_SESSION['falschBeantworteteFragen']; ?></span></p>
		
					<form action="index.php">
						<input  type="submit" class = "w3-button w3-white w3-border w3-border-red w3-round-large" style="margin:2%;" value="Startseite" />
					</form>
					<form action="game.php">
						<input  type="submit" class = "w3-button w3-white w3-border w3-border-red w3-round-large" style="margin:2%;" value="Weiter" />
					</form>
				<center>	
			</div>
			<?php } 
			$_SESSION['runden'] = $_SESSION['runden'] +1;
			?>
		</div>
	</body>
</html>