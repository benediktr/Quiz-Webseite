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
		
		<?php
		// Soll nur beim ersten Mal durchlaufen werden
		if( empty($themaMySql)AND empty($themaScore) ){
			
			
			
			if( !isset( $_POST['thema'] )){
				//Wenn kein Thema ausgewaehlt wurde zurueck zur Uebersicht
				echo 'Noch kein Thema ausgew&auml;hlt <a href="start_game.php">  Zur&uuml;ck zur Auswahl</a>';
				
			}
			else{
				//Ausgewähltes Thema holen und als Variable festlegen, welche dann in die MySQL Queries eingefuegt wird
				//Einmal um die Fragen zuholen, und um die ID der letzt Beantworteten Frage zu holen
				switch($_POST['thema']){
					case "kunst":
						$themaMySql='q_art_design';
						$themaScore='s_art_design';
						break;
					case "bibel":
						$themaMySql='q_bible';
						$themaScore='s_bible';
						break;
					case "essen":
						$themaMySql='q_eating_drinking';
						$themaScore='s_eating_drinking';
						break;
					case "sport":
						$themaMySql='q_sport_freetime';
						$themaScore='s_sport_freetime';
						break;
					case "kulturen":
						$themaMySql='q_geographie_countries';
						$themaScore='s_geography_countries';
						break;
					case "geschichte":
						$themaMySql='q_time_history';
						$themaScore='s_time_history';
						break;
					case "filme":
						$themaMySql='q_movies';
						$themaScore='s_movies';
						break;
					case "musik":
						$themaMySql='q_music';
						$themaScore='s_music';
						break;
					case "naturUndTiere":
						$themaMySql='q_animals_nature';
						$themaScore='s_animals_nature';
						break;
					case "politik":
						$themaMySql='q_politics';
						$themaScore='s_politics';
						break;
					case "wissenschaft":
						$themaMySql='q_science';
						$themaScore='s_science';
						break;
					case "technologien":
						$themaMySql='q_technology';
						$themaScore='s_technology';
						break;
					case "serien":
						$themaMySql='q_tv';
						$themaScore='s_series';
						break;
					
				}
				
			}
		
		
			//ID der zuletzt beantworteten Frage aus der Score Datenbank holen
			$abfrageLetzteId="SELECT ".$themaScore." FROM `user_scores` WHERE `userid`='".$userid."';";
			foreach($db->query($abfrageLetzteId) as $ergebnisLetzteId ){
			$letzteID = $ergebnisLetzteId[ '' .$themaScore ];
			}
			$idaktuelleFrage = $letzteID+1;
			$GLOBALS["idaktuelleFrage"];
		}
		
		//Frage aus der Datenbank holen 
			$abfragefrage = "SELECT `question`, `r_answer`, `f_answer_1`, `f_answer_2`, `f_answer_3` FROM ".$themaMySql." WHERE `id`='".$idaktuelleFrage."';";
			foreach($db2->query($abfragefrage) as $ergebnisFrage ){
				$aktuelleFrage = $ergebnisFrage['question'];
				$rantwort = $ergebnisFrage['r_answer'];
				$fantwort1 = $ergebnisFrage['f_answer_1'];
				$fantwort2 = $ergebnisFrage['f_answer_2'];
				$fantwort3 = $ergebnisFrage['f_answer_3'];
			}
		
		?>
		<?php
			//Formular Kopf
			//Wenn es unter 10 Mal ist soll sich das Skript selbst nochmals aufrufen, beim 10 Mal soll das Ergebnis 
			$durchlauf = 0;
			if($GLOBALS["durchlauf"]<= 10){
				echo '<form action="game.php">';
			}
			else{
				echo '<form action="results_game.php" >';
				
			}
			
			// Radio Button mit der Antworten
			
			echo '<h1>'.$aktuelleFrage.' </h1> <br />';
			echo '<input type="radio" name="antworten" value="antwort1" >';
			echo $rantwort. '<br />';
			echo '<input type="radio" name="antworten" value="antwort2" >';
			echo $fantwort1 .'<br />';
			echo '<input type="radio" name="antworten" value="antwort3" >';
			echo $fantwort2 .'<br />';
			echo '<input type="radio" name="antworten" value="antwort4" >';
			echo $fantwort3 .'<br />';
			
		   
		?>
		
			<input type="submit" id="button" value="Weiter">
		</form>
	</body>
</html>