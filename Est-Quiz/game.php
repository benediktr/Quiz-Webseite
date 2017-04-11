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
			
				<center>
					<p>Bitte zuerst <a href = "login.php">Einloggen</a>!</p>
				</center>
				
			<?php } else { ?>
			

			<div class="w3-container"> 
				<center>
					<?php
		
		
					// Soll nur beim ersten Mal durchlaufen werden
					if( !isset($_SESSION['ersteMal'])){
		
						if( !isset( $_POST['topics'] )){
							//Wenn kein Thema ausgewaehlt wurde zurueck zur Uebersicht
							echo 'Noch kein Thema ausgew&auml;hlt <a href="start_game.php">  Zur&uuml;ck zur Auswahl</a>';
				
						}
						else{
							//Ausgewähltes Thema holen und als Variable festlegen, welche dann in die MySQL Queries eingefuegt wird
							//Einmal um die Fragen zuholen, und um die ID der letzt Beantworteten Frage zu holen
							//Einmal fuer die Question-Datenbank und fuer die Score Datenbank
							switch($_POST['topics']){
								case "art":
									$_SESSION['themaQuestion']='art';
									$_SESSION['themaScore']='score_art';
									break;
								case "bible":
									$_SESSION['themaQuestion']='bible';
									$_SESSION['themaScore']='score_bible';
									break;
								case "eating":
									$_SESSION['themaQuestion']='eating';
									$_SESSION['themaScore']='score_eating';
									break;
								case "freetime":
									$_SESSION['themaQuestion']='freetime';
									$_SESSION['themaScore']='score_freetime';
									break;
								case "geography":
									$_SESSION['themaQuestion']='geographie';
									$_SESSION['themaScore']='score_geography';
									break;
								case "history":
									$_SESSION['themaQuestion']='history';
									$_SESSION['themaScore']='score_history';
									break;
								case "movies":
									$_SESSION['themaQuestion']='movies';
									$_SESSION['themaScore']='score_movies';
									break;
								case "music":
									$_SESSION['themaQuestion']='music';
									$_SESSION['themaScore']='score_music';
									break;
								case "nature":
									$_SESSION['themaQuestion']='nature';
									$_SESSION['themaScore']='score_nature';
									break;
								case "politics":
									$_SESSION['themaQuestion']='politics';
									$_SESSION['themaScore']='score_politics';
									break;
								case "science":
									$_SESSION['themaQuestion']='science';
									$_SESSION['themaScore']='score_science';
									break;
								case "technology":
									$_SESSION['themaQuestion']='technology';
									$_SESSION['themaScore']='score_technology';
									break;
								case "series":
									$_SESSION['themaQuestion']='series';
									$_SESSION['themaScore']='score_series';
									break;
					
							}
				
						}
		
			
						//ID der zuletzt beantworteten Frage aus der Score Datenbank holen
						$abfrageLetzteId = "SELECT ".$_SESSION['themaScore']." FROM `user` WHERE `id`='".$id."';";
			
			
						foreach($db->query($abfrageLetzteId) as $ergebnisLetzteId ){
							$letzteID = $ergebnisLetzteId[ ''.$_SESSION['themaScore'] ];
						}
			
			
						//Zur der ID der letzten Frage eins dazuzaehlen um die ID der naechsten Frage zu haben
						$_SESSION['IDaktuelleFrage']= $letzteID + 1;
			
				
						
			
						//Durchlaufe Variable auf eins setzen
						$_SESSION['durchlauf'] = 1;
						
						//Maximale Anzahl fragen holen
						$statement_max_question = $db->prepare("SELECT * FROM ".$_SESSION['themaQuestion']." WHERE id = (SELECT MAX(id) FROM ".$_SESSION['themaQuestion'].")");
						$statement_max_question->execute();
						$row = $statement_max_question->fetch();
						$_SESSION['maximaleAnzahlAnFragen']= $row['id'];
					
						
						$_SESSION['zuWenigFragen']= false;
						if(($_SESSION['maximaleAnzahlAnFragen']-$_SESSION['IDaktuelleFrage'])<10){
							$_SESSION['zuWenigFragen'] = true;
						}
						
						$_SESSION['ersteMal'] = false;
					
					}
					//------- ENDE Erstes Mal ---------
					
		
					
					//Wenn keine Fragen verfuegbar sind Warnung anzeigen...
					if($_SESSION['zuWenigFragen']){
					?>
						<div class="w3-panel w3-red">
							<h3> Fehler!</h3>
							<p>Es sind nicht genug Fragen in diesem Themenbereich verf&uuml;gbar um eine neue Runde zu starten. F&uuml;ge weitere hinzu oder spiele in einem anderen Themenbereich weiter.</p>
						</div>
						
						<form action="addquestion.php">
							<input  type="submit" class = "w3-button w3-white w3-border w3-border-red w3-round-large" style="margin:2%;" value="Fragen hinzuf&uuml;gen" />
						</form>
						<form action="index.php">
							<input  type="submit" class = "w3-button w3-white w3-border w3-border-red w3-round-large" style="margin:2%;" value="Startseite" />
						</form>
					<?php	
						
					}
					else {					
						//Frage aus der Datenbank holen 
						$abfragefrage = "SELECT `question`, `right_answer`, `wrong_answer_1`, `wrong_answer_2`, `wrong_answer_3` FROM ".$_SESSION['themaQuestion']." WHERE `id`='".$_SESSION['IDaktuelleFrage']."';";
		
				
						//Die Fragen in SESSION Variabeln speichern, um sie bei dem Wiederaufruf, der Auswertung zu haben
						foreach($db->query($abfragefrage) as $ergebnisFrage ){
							$_SESSION['aktuelleFrage'] = $ergebnisFrage['question'];
				
						} 
					
		
		
						//Formular Kopf
						//Wenn es unter 10 Mal ist soll sich das Skript selbst nochmals aufrufen, beim 10 Mal soll das Ergebnis 
				
				
						echo '<form action="game_results.php" method="POST">';
						
				
				
						// Radio Button mit der Frage und den Antworten
				
							//Algorithmus um festzustellen das jede Radomzahl nur einmal vorkommt
							// Variabeln zahlNull , zahlEins, zahlZwei, ZahlDrei
							$fertig = false;
							$zahlNull = rand( 1 , 4);
				
				
							for($i = 1; $i<4; $i++){
					
								while($fertig == false){
									$randomzahl = rand( 1 , 4);
						
									if(($i == 1)&($randomzahl != $zahlNull)){
										$zahlEins =  $randomzahl;
										$fertig = true;
									}
									if(($i == 2 & $randomzahl != $zahlEins) & ( $randomzahl != $zahlNull )){
										$zahlZwei =  $randomzahl;
										$fertig = true;
									}
									if( ($i == 3 & $randomzahl != $zahlZwei) & ( ($randomzahl != $zahlNull) & ($randomzahl != $zahlEins ) ) ){
										$zahlDrei =  $randomzahl;
										$fertig = true;
									}	
								}
					
								//Fertig wieder auf False setzten, das solange die Schleife wiederholt wird bis eine ander Zahl gefunden wurde
								$fertig = false;
							}
					
							//Zahl der richtigen Antwort festlegen
							//Die Zahl für die erste Stelle gibt die Stelle der richtigen Antwort vor
							$_SESSION['richtigeAntwortZahl'] = $zahlNull;
				
				
							//Eine Funktion um die Antworten an die Stelle der Zahl zuzuordnen z.B. Erste Antwort an die vierte Stelle weil die Zahl 4 ist
							function zurordnenAntworten($zahl, $antwort){
								if($zahl == 1){
								$_SESSION['antwort1'] = $antwort;
								}
								if($zahl == 2){
									$_SESSION['antwort2'] = $antwort;
								}
								if($zahl == 3){
									$_SESSION['antwort3'] = $antwort;
								}
								if($zahl == 4){
									$_SESSION['antwort4'] = $antwort;
								}
							}
				
				
							//Antworten aus der Datenbank abfrage abhand den Zahlen zuordnen
							zurordnenAntworten($zahlNull,$ergebnisFrage['right_answer']);
							zurordnenAntworten($zahlEins,$ergebnisFrage['wrong_answer_1']);
							zurordnenAntworten($zahlZwei,$ergebnisFrage['wrong_answer_2']);
							zurordnenAntworten($zahlDrei,$ergebnisFrage['wrong_answer_3']);
				
							
							//Frage
							echo '<h1>'.$_SESSION['aktuelleFrage'].' </h1>';
							
							echo '<div style="margin-left:40%; margin-right:40%; text-align:left;">';
								//--------------- Antwort 1 ----------------------------------
								echo '<input class="w3-radio" type="radio" name="antworten" value="1" > &nbsp;';
								echo $_SESSION['antwort1']. '<br />';
								echo '<hr />';
								//--------------- Antwort 2 -----------------------------------
								echo '<input class="w3-radio" type="radio" name="antworten" value="2" > &nbsp;';
								echo $_SESSION['antwort2'] .'<br />';
								echo '<hr />';
								//--------------- Antwort 3 -----------------------------------
								echo '<input class="w3-radio" type="radio" name="antworten" value="3" > &nbsp;';
								echo $_SESSION['antwort3'] .'<br />';
								echo '<hr />';
								//---------------- Antwort 4 ----------------------------------
								echo '<input class="w3-radio" type="radio" name="antworten" value="4" > &nbsp;';
								echo $_SESSION['antwort4'] .'<br />';
					
			   
							?>
							</div>
							<input type="submit" class = "w3-button w3-white w3-border w3-border-red w3-round-large" style="margin:2%;" value="Weiter">
							
							</form>
						</div>
					<?php } } ?>
				</center>
		
		
	</body>
</html>