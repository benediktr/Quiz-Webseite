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
				<h1>Spiel</h1>
				<p>Est Quiz-Projekt von Benedikt Ross und Lukas Keller</p>
			</div>
			<hr />
			<?php if( !$access ) { ?>
				<p style="text-align:center;" >Bitte zuerst <a href = "login.php">Einloggen</a>!</p>
			<?php } else { ?>
		
			
			<div class="w3-container" style="text-align:center;"> 
				<?php
					
				//Wenn keine Fragen verfuegbar sind Warnung anzeigen...
				if($_SESSION['maximaleAnzahlAnFragen'] < $_SESSION['IDaktuelleFrage']){
				?>
					<div class="w3-panel w3-red">
						<h3> Fehler </h3>
						<p> Es sind keine weiteren Fragen in diesem Themenbereich verf&uuml;gbar. F&uuml;ge weitere hinzu oder spiele in einem anderen Themenbereich weiter.</p>
					</div>
					
					<form action="addquestion.php">
						<fieldset style="border-style:none;">
							<input  type="submit" class = "w3-button w3-white w3-border w3-border-red w3-round-large" style="margin:2%;" value="Fragen hinzuf&uuml;gen" />
						</fieldset>
					</form>
					<form action="index.php">
						<fieldset style="border-style:none;">
							<input  type="submit" class = "w3-button w3-white w3-border w3-border-red w3-round-large" style="margin:2%;" value="Startseite" />
						</fieldset>
					</form>
				<?php	
						
				}
				else {
					// Radio Button mit der Antworten
				
					//Frage
					echo '<h1>'.$_SESSION['aktuelleFrage'].' </h1>';
						
					echo '<div style="margin-left:40%; margin-right:40%; text-align:left;">';
						//--------------- Antwort 1 ----------------------------------
						echo '<input class="w3-radio" type="radio" name="antworten" value="1" disabled="disabled" ';
						// Wenn Antwort 1 ausgwählt wurde diesen anzeigen
						if($_POST['antworten'] == "1"){
							echo ' checked ';
						}
					
						echo '/> &nbsp;';
					
					
						//Div um den Text machen um ihn farbig zu machen
						echo '<span ';
						if(1 == $_SESSION['richtigeAntwortZahl']){
							echo ' style="color:green;" >';
						}
						else{
							echo ' style="color:red;" >';
						}
						echo $_SESSION['antwort1']. '</span> <hr /> ';
							
					
						//--------------- Antwort 2 -----------------------------------
					
						echo '<input class="w3-radio" type="radio" name="antworten" value="2" disabled="disabled" ';
						// Wenn Antwort 2 ausgwählt wurde diesen anzeigen
						if($_POST['antworten'] == "2"){
							echo ' checked ';
						}
						echo '/> &nbsp;';
					
						//Div um den Text machen um ihn farbig zu machen
						echo '<span ';
						if(2 == $_SESSION['richtigeAntwortZahl']){
							echo ' style="color:green;" >';
						}
						else{
							echo ' style="color:red;" >';
						}
						echo $_SESSION['antwort2'] .'</span> <hr />  ';
				
						//--------------- Antwort 3 -----------------------------------
						echo '<input class="w3-radio" type="radio" name="antworten" value="3" disabled="disabled" ';
						// Wenn Antwort 3 ausgwählt wurde diesen anzeigen
						if($_POST['antworten'] == "3"){
							echo ' checked ';
						}
						echo '/> &nbsp;';
					
						//Div um den Text machen um ihn farbig zu machen
						echo '<span ';
						if(3 == $_SESSION['richtigeAntwortZahl']){
							echo ' style="color:green;" >';
						}
						else{
							echo ' style="color:red;" >';
						}
						echo $_SESSION['antwort3'] .'</span> <hr /> ';
							
						//---------------- Antwort 4 ----------------------------------
						echo '<input class="w3-radio" type="radio" name="antworten" value="4" disabled="disabled" ';
						// Wenn Antwort 1 ausgwählt wurde diesen anzeigen
						if($_POST['antworten'] == "4"){
							echo ' checked ';
						}
						echo '/> &nbsp;';
							
						//Div um den Text machen um ihn farbig zu machen
						echo '<span ';
						if(4 == $_SESSION['richtigeAntwortZahl']){
							echo ' style="color:green;" >';
						}
						else{
							echo ' style="color:red;" >';
						}
						echo $_SESSION['antwort4'] .'</span> <hr /> ';
					echo '</div>';

					   
					//Ergebnis in die Score-Datenbank des Nutzer schreiben
					if($_POST['antworten'] == $_SESSION['richtigeAntwortZahl']){
						//Totalen Score erhoehen, 
						//Anzahl richtig beantworteter Fragen erhoehen  
						//Zahl der zuletztbeantworteten Frage erhoehen
						$abfrage_richtig = "UPDATE  `user` SET  `total_score` =  `total_score` +1, `".$_SESSION['themaScore']."` =  `".$_SESSION['themaScore']."`+1, `counter_right_answers` =  `counter_right_answers` +1, `counter_answers` =  `counter_answers` +1 WHERE `id`=".$_SESSION['userid']."";
						$statement_right = $db->prepare($abfrage_richtig);
						$statement_right->execute();
							
						//Variable für die Übersicht
						$_SESSION['richtigBeantworteteFragen']=$_SESSION['richtigBeantworteteFragen']+1;
					}
					else{
						//Anzahl beantworteter Fragen erhoehen
						//Anzahl falsch beantworteter Fragen erhoehen  
						//ID der zuletztbeantworteten Frage erhoehen
						$abfrage_falsch ="UPDATE  `user` SET  `counter_answers` =  `counter_answers` +1,`".$_SESSION['themaScore']."` =  `".$_SESSION['themaScore']."`+1, `counter_wrong_anwers` =  `counter_wrong_anwers` +1 WHERE `id`=".$_SESSION['userid']."";
						$statement_false = $db->prepare($abfrage_falsch);
						$statement_false->execute();	
					
							
						//Variable für die Übersicht
						$_SESSION['falschBeantworteteFragen']=$_SESSION['falschBeantworteteFragen']+1;
					}
						
					// ID der letzt beantworteten Frage erhoehen
					$_SESSION['IDaktuelleFrage'] = $_SESSION['IDaktuelleFrage']+1;
						
					//Wenn es unter 10 Mal ist soll sich das Skript selbst nochmals aufrufen, beim 10 Mal soll das Ergebnis 
					if($_SESSION['durchlauf'] < 10){
						// Zum Spiel
						echo '<form action="game.php" method="post">';
						$_SESSION['durchlauf'] = $_SESSION['durchlauf'] +1;

					}
					else{
						// Zu einer Uebersicht mit den Richtig beantworteten Fragen
						echo '<form action="game_overview.php" method="post" >';
						// Wieder zurücksetzen
						$_SESSION['durchlauf'] = 1;
					}
					?>
						<fieldset style="border-style:none;">
							<input  type="submit" class = "w3-button w3-white w3-border w3-border-red w3-round-large" style="margin-top:0%;" value="Weiter" />
						</fieldset>
					</form>
				<?php } ?>
			</div>
			<?php } ?>
		</div>
	</body>
</html>