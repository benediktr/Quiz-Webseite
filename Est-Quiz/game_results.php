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
			echo '<input type="radio" name="antworten" value="1" ';
			// Wenn Antwort 1 ausgwählt wurde diesen anzeigen
			if($_POST['antworten'] == "1"){
				echo ' checked ';
			}
			
			echo ' >';
			
			
			//Div um den Text machen um ihn farbig zu machen
			echo '<div ';
			if(1 == $_SESSION['richtigeAntwortZahl']){
				echo ' style="color:green;" >';
			}
			else{
				echo ' style="color:red;" >';
			}
			echo $_SESSION['antwort1']. '</div> <br />';
			
			//--------------- Antwort 2 -----------------------------------
			
			echo '<input type="radio" name="antworten" value="2" ';
			// Wenn Antwort 2 ausgwählt wurde diesen anzeigen
			if($_POST['antworten'] == "2"){
				echo ' checked ';
			}
			echo ' >';
			
			//Div um den Text machen um ihn farbig zu machen
			echo '<div ';
			if(2 == $_SESSION['richtigeAntwortZahl']){
				echo ' style="color:green;" >';
			}
			else{
				echo ' style="color:red;" >';
			}
			echo $_SESSION['antwort2'] .'</div> <br />';
			
			//--------------- Antwort 3 -----------------------------------
			echo '<input type="radio" name="antworten" value="3" ';
			// Wenn Antwort 3 ausgwählt wurde diesen anzeigen
			if(['antworten'] == "3"){
				echo ' checked ';
			}
			echo ' >';
			
			//Div um den Text machen um ihn farbig zu machen
			echo '<div ';
			if(3 == $_SESSION['richtigeAntwortZahl']){
				echo ' style="color:green;" >';
			}
			else{
				echo ' style="color:red;" >';
			}
			echo $_SESSION['antwort3'] .'</div> <br />';
			
			//---------------- Antwort 4 ----------------------------------
			echo '<input type="radio" name="antworten" value="4" ';
			// Wenn Antwort 1 ausgwählt wurde diesen anzeigen
			if($_POST['antworten'] == "4"){
				echo ' checked ';
			}
			echo ' >';
			
			//Div um den Text machen um ihn farbig zu machen
			echo '<div ';
			if(4 == $_SESSION['richtigeAntwortZahl']){
				echo ' style="color:green;" >';
			}
			else{
				echo ' style="color:red;" >';
			}
			echo $_SESSION['antwort4'] .'</div> <br />';
			
			
		   
		   
		   //Ergebnis in die Score-Datenbank des Nutzer schreiben
			if($_POST['antworten'] == $_SESSION['richtigeAntwortZahl']){
				//Totalen Score erhoehen, 
				//Anzahl richtig beantworteter Fragen erhoehen  
				//ID der zuletztbeantworteten Frage erhoehen
				$abfrage_richtig = "UPDATE  `user` SET  `total_score` =  `total_score` +1, `".$_SESSION['themaScore']."` =  `".$_SESSION['themaScore']."`+1, `counter_right_answers` =  `counter_right_answers` +1, `counter_answers` =  `counter_answers` +1 WHERE ".$id."";
				$statement_right = $db->prepare($abfrage_richtig);
				$statement_right->execute();
				
				//Variable für die Übersicht
				$_SESSION['richtigBeantworteteFragen']=$_SESSION['richtigBeantworteteFragen']+1;
			}
			else{
				//Anzahl beantworteter Fragen erhoehen
				//Anzahl falsch beantworteter Fragen erhoehen  
				//ID der zuletztbeantworteten Frage erhoehen
				$abfrage_falsch ="UPDATE  `user` SET  `counter_answers` =  `counter_answers` +1,`".$_SESSION['themaScore']."` =  `".$_SESSION['themaScore']."`+1, `counter_wrong_anwers` =  `counter_wrong_anwers` +1 WHERE ".$id."";
				$statement_false = $db->prepare($abfrage_falsch);
				$statement_false->execute();			
				
				//Variable für die Übersicht
				$_SESSION['falschBeantworteteFragen']=$_SESSION['falschBeantworteteFragen']+1;
			}
			
			// ID der letzt beantworteten Frage erhoehen
			$_SESSION['IDaktuelleFrage'] = $_SESSION['IDaktuelleFrage']+1;
			
		?>
		
			<a href="game.php"> Weiter </a>
			
		</form>
		</div>
		
		
		
		
	</body>
</html>