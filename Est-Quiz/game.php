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
						$_SESSION['themaScore']='s_sport_freetime';
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
			
				
			$_SESSION['ersteMal'] = false;
			
			//Durchlaufe Variable auf null setzen
			$_SESSION['durchlauf']=0;
		}
		//------- ENDE Erstes Mal ---------
		
		

		
		//Frage aus der Datenbank holen 
		$abfragefrage = "SELECT `question`, `right_answer`, `wrong_answer_1`, `wrong_answer_2`, `wrong_answer_3` FROM ".$_SESSION['themaQuestion']." WHERE `id`='".		$_SESSION['IDaktuelleFrage']."';";
	
			
		//Die Fragen in SESSION Variabeln speichern, um sie bei dem Wiederaufruf, der Auswertung zu haben
		foreach($db->query($abfragefrage) as $ergebnisFrage ){
			$_SESSION['aktuelleFrage'] = $ergebnisFrage['question'];
			$_SESSION['rantwort'] = $ergebnisFrage['right_answer'];
			$_SESSION['fantwort1'] = $ergebnisFrage['wrong_answer_1'];
			$_SESSION['fantwort2'] = $ergebnisFrage['wrong_answer_2'];
			$_SESSION['fantwort3'] = $ergebnisFrage['wrong_answer_3'];
		}
		
		
		//Formular Kopf
		//Wenn es unter 10 Mal ist soll sich das Skript selbst nochmals aufrufen, beim 10 Mal soll das Ergebnis 
			
		if($_SESSION["durchlauf"]<= 10){
			// ZU der Seite die anzeiget ob das von Nutzer angklickte, das Richtige war
			echo '<form action="game_results.php" method="POST">';
			$_SESSION['durchlauf'] = $_SESSION['durchlauf'] +1;
		}
		else{
			// Zu einer Uebersicht mit den Richtig beantworteten Fragen
			echo '<form action="results_game.php" method="POST" >';
			$_SESSION['durchlauf'] = 0;
		}
			
		// Radio Button mit der Frage und den Antworten
			
			//Algorithmus um festzustellen das jede Radomzahl nur einmal vorkommt
			// Variabeln zahlEins, zahlZwei, ZahlDrei, ZahlVier
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
			
			
			//Array erstellen um die richtigen Antworten der Zahl zurueckgibt
			function zurueckgebenAntwort($zahl, $antwort1, $antwort2, $antwort3, $antwort4){
				if($zahl == 1){
					return $antwort1;
				}
				if($zahl == 2){
					return $antwort2;
				}
				if($zahl == 3){
					return $antwort3;
				}
				if($zahl == 4){
					return $antwort4;
				}
			}
			
			//Antworten in Session Variablen speichern um sie und der gleichen Reihenfolge, zur Übersicht zu haben
			$_SESSION['antwort1'] = zurueckgebenAntwort($zahlNull,$_SESSION['rantwort'],$_SESSION['fantwort1'],$_SESSION['fantwort2'],$_SESSION['fantwort3'] );
			$_SESSION['antwort2'] = zurueckgebenAntwort($zahlEins,$_SESSION['rantwort'],$_SESSION['fantwort1'],$_SESSION['fantwort2'],$_SESSION['fantwort3'] );
			$_SESSION['antwort3'] = zurueckgebenAntwort($zahlZwei,$_SESSION['rantwort'],$_SESSION['fantwort1'],$_SESSION['fantwort2'],$_SESSION['fantwort3'] );
			$_SESSION['antwort4'] = zurueckgebenAntwort($zahlDrei,$_SESSION['rantwort'],$_SESSION['fantwort1'],$_SESSION['fantwort2'],$_SESSION['fantwort3'] );
			
			//Frage
			echo '<h1>'.$_SESSION['aktuelleFrage'].' </h1>';
			
			//--------------- Antwort 1 ----------------------------------
			echo '<input type="radio" name="antworten" value="1" >';
			echo $_SESSION['antwort1']. '<br />';
			//--------------- Antwort 2 -----------------------------------
			echo '<input type="radio" name="antworten" value="2"  >';
			echo $_SESSION['antwort2'] .'<br />';
			//--------------- Antwort 3 -----------------------------------
			echo '<input type="radio" name="antworten" value="3" >';
			echo $_SESSION['antwort3'] .'<br />';
			//---------------- Antwort 4 ----------------------------------
			echo '<input type="radio" name="antworten" value="4" >';
			echo $_SESSION['antwort4'] .'<br />';
			
		   
		?>
		
			<input type="submit" class="button" value="Weiter">
			
		</form>
		</div>
		
		
		
		
	</body>
</html>