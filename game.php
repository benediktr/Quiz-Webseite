<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
  
<?php
	require 'database.php';
	require 'database_questions.php';
	session_start();
	
	if(!isset($_SESSION['userid'])) {
		die('Bitte zuerst <a href="login.php">einloggen</a>');
	}
 
	$userid = $_SESSION['userid'];
	
	// Username rausfiltern
	
	$data = $db->prepare('SELECT username FROM user_accounts WHERE id = :id');
	$data->bindParam(':id', $_SESSION['userid']);
	$data->execute();
	
	$datas = $data->fetch(PDO::FETCH_ASSOC);
	
	$user = NULL;
	
	if( count($datas) > 0 ) {
		$user = $datas;
		$username = $user['username'];
	}	


?>


	
  
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" >
	<head>
		<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
		<title>Bestenliste</title>
		<link rel="stylesheet" type="text/css" href="css/format.css"/>
		<link rel="stylesheet" type="text/css" href="css/format_game.css"/>
		<link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet"> 
	</head>
	<body>
		<div id = "background">
			<span id ="heading">Das Quiz</span>
		</div>
		
		<br />
		<br />
		<br />
		<br />	
		
		<div class="zentrieren">
		<?php
		// Soll nur beim ersten Mal durchlaufen werden
		echo $_SESSION['ersteMal'];
		
		if( !isset($_SESSION['ersteMal'])){
		
			if( !isset( $_POST['thema'] )){
				//Wenn kein Thema ausgewaehlt wurde zurueck zur Uebersicht
				echo 'Noch kein Thema ausgew&auml;hlt <a href="start_game.php">  Zur&uuml;ck zur Auswahl</a>';
				
			}
			else{
				//Ausgewähltes Thema holen und als Variable festlegen, welche dann in die MySQL Queries eingefuegt wird
				//Einmal um die Fragen zuholen, und um die ID der letzt Beantworteten Frage zu holen
				//Einmal fuer die Question-Datenbank und fuer die Score Datenbank
				switch($_POST['thema']){
					case "kunst":
						$_SESSION['themaQuestion']='q_art_design';
						$_SESSION['themaScore']='s_art_design';
						break;
					case "bibel":
						$_SESSION['themaQuestion']='q_bible';
						$_SESSION['themaScore']='s_bible';
						break;
					case "essen":
						$_SESSION['themaQuestion']='q_eating_drinking';
						$_SESSION['themaScore']='s_eating_drinking';
						break;
					case "sport":
						$_SESSION['themaQuestion']='q_sport_freetime';
						$_SESSION['themaScore']='s_sport_freetime';
						break;
					case "kulturen":
						$_SESSION['themaQuestion']='q_geographie_countries';
						$_SESSION['themaScore']='s_geography_countries';
						break;
					case "geschichte":
						$_SESSION['themaQuestion']='q_time_history';
						$_SESSION['themaScore']='s_time_history';
						break;
					case "filme":
						$_SESSION['themaQuestion']='q_movies';
						$_SESSION['themaScore']='s_movies';
						break;
					case "musik":
						$_SESSION['themaQuestion']='q_music';
						$_SESSION['themaScore']='s_music';
						break;
					case "naturUndTiere":
						$_SESSION['themaQuestion']='q_animals_nature';
						$_SESSION['themaScore']='s_animals_nature';
						break;
					case "politik":
						$_SESSION['themaQuestion']='q_politics';
						$_SESSION['themaScore']='s_politics';
						break;
					case "wissenschaft":
						$_SESSION['themaQuestion']='q_science';
						$_SESSION['themaScore']='s_science';
						break;
					case "technologien":
						$_SESSION['themaQuestion']='q_technology';
						$_SESSION['themaScore']='s_technology';
						break;
					case "serien":
						$_SESSION['themaQuestion']='q_tv';
						$_SESSION['themaScore']='s_series';
						break;
					
				}
				
			}
		
		
			//ID der zuletzt beantworteten Frage aus der Score Datenbank holen
			$abfrageLetzteId="SELECT ".$_SESSION['themaScore']." FROM `user_scores` WHERE `userid`='".$userid."';";
			
			foreach($db->query($abfrageLetzteId) as $ergebnisLetzteId ){
				$letzteID = $ergebnisLetzteId[ '' .$_SESSION['themaScore'] ];
			}
			//Zur der ID der letzten Frage eins dazuzaehlen um die ID der naechsten Frage zu haben
			
			$_SESSION['IDaktuelleFrage']= $letzteID + 1;
			
			$_SESSION['ersteMal'] = false;
		}
		//------- ENDE Erstes Mal ---------
		
		
		//Frage aus der Datenbank holen 
			$abfragefrage = "SELECT `question`, `r_answer`, `f_answer_1`, `f_answer_2`, `f_answer_3` FROM ".$_SESSION['themaQuestion']." WHERE `id`='".$_SESSION['IDaktuelleFrage']."';";
			
			//Die Fragen in SESSION Variabeln speichern, um sie bei dem Wiederaufruf, der Auswertung zu haben
			foreach($db2->query($abfragefrage) as $ergebnisFrage ){
				$_SESSION['aktuelleFrage'] = $ergebnisFrage['question'];
				$_SESSION['rantwort'] = $ergebnisFrage['r_answer'];
				$_SESSION['fantwort1'] = $ergebnisFrage['f_answer_1'];
				$_SESSION['fantwort2'] = $ergebnisFrage['f_answer_2'];
				$_SESSION['fantwort3'] = $ergebnisFrage['f_answer_3'];
			}
		
		
		//Formular Kopf
		//Wenn es unter 10 Mal ist soll sich das Skript selbst nochmals aufrufen, beim 10 Mal soll das Ergebnis 
			$durchlauf = 0;
			if($GLOBALS["durchlauf"]<= 10){
				echo '<form action="game.php" method="post">';
			}
			else{
				echo '<form action="results_game.php" method="post" >';
				
			}
			
		// Radio Button mit der Antworten
			
			//Frage
			echo '<h1>'.$_SESSION['aktuelleFrage'].' </h1>';
			//Antwort 1
			echo '<input type="radio" name="antworten" value="antwort1" >';
			echo $_SESSION['rantwort']. '<br />';
			//Antwort 2
			echo '<input type="radio" name="antworten" value="antwort2" >';
			echo $_SESSION['fantwort1'] .'<br />';
			//Antwort 3
			echo '<input type="radio" name="antworten" value="antwort3" >';
			echo $_SESSION['fantwort2'] .'<br />';
			//Antwort 4
			echo '<input type="radio" name="antworten" value="antwort4" >';
			echo $_SESSION['fantwort3'] .'<br />';
			
		   
		?>
		
			<input type="submit" id="button" value="Weiter">
			
		</form>
		</div>
	</body>
</html>