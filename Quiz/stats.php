<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
  
<?php
	require 'database.php'; 
	include 'database_questions.php';
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
		<title>Profil&uuml;bersicht</title>
		<link rel="stylesheet" type="text/css" href="css/format_stats.css"/>
		<link rel="stylesheet" type="text/css" href="css/format.css"/>
		<link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet"> 
		
	</head>
	<body>
		<div id = "background">
			<span id ="heading">Profil&uuml;bersicht</span>
		</div>
		
		<br />
		<br />
		<br />
		<br />
		<a  class="button" href="index2.php" > Zur&uuml;ck </a>
		<a  class="button" href="bestenliste.php" > Bestenliste </a>
		<?php 
			$abfrage_spielstand="SELECT `total_score`, `s_bible`, `s_sport_freetime`, `s_eating_drinking`, `s_geography_countries`, `s_movies`, 		`s_time_history`, `s_art_design`, `s_music`, `s_series`, `s_politics`, `s_science`, `s_animals_nature`, `s_technology` FROM `user_scores` WHERE `userid`='".$userid."';"; 
			foreach( $db->query($abfrage_spielstand) as $row){
			}
			//Zweite Abfrage mit der Anzahl der Fragen
			
			
			
				
		?>
		
		<div>
			<h1> Dein Score: </h1>
			<?php
				echo $row["total_score"];
				
			?>
		</div>
		<div>
			<h1> Bibel:</h1>
			<?php 
				foreach( $db2->query('SELECT COUNT(*) FROM q_bible') as $ergebnis_bible);
				
				if($ergebnis_bible['COUNT(*)']  == 0){
					echo '0%';
				}
				else{
					if($row['s_bible'] == 0){
						echo '0%';
					}
					else{
						echo (($row['s_bible'] / $ergebnis_bible['COUNT(*)'])*100).'%';
					}
				}
				echo ' von 100 %';
				
			?>
		</div>	
		<div>	
			<h1> Sport und Freizeit:</h1>
			<?php 
				foreach( $db2->query('SELECT COUNT(*) FROM q_sport_freetime') as $ergebnis_sport_freetime){
					
				}
				
				if($ergebnis_sport_freetime['COUNT(*)'] == 0){
					echo '0%';
				}
				else{
					if($row['s_sport_freetime'] == 0){
						echo '0%';
					}
					else{
						echo (($row['s_sport_freetime'] / $ergebnis_sport_freetime['COUNT(*)'])*100).'%';
					}
				}
				echo ' von 100 %';
			?>
		</div>	
		<div>	
			<h1> Essen und Trinken:</h1>
			<?php 
				 
				foreach( $db2->query('SELECT COUNT(*) FROM q_eating_drinking') as $ergebnis_eating_drinking){
					
				}
				if($ergebnis_eating_drinking['COUNT(*)']  == 0){
					echo '0%';
				}
				else{
					if($row['s_eating_drinking'] == 0){
						echo '0%';
					}
					else{
						echo (($row['s_eating_drinking'] / $ergebnis_eating_drinking['COUNT(*)'])*100).'%';
					}
				}
				echo ' von 100 %';
			?>
		</div>	
		<div>	
			<h1> Kulturen:</h1>
			<?php 
				 
				foreach( $db2->query('SELECT COUNT(*) FROM q_geographie_countries') as $ergebnis_geography_countries){
					
				}
				
				if($ergebnis_geography_countries['COUNT(*)']  == 0){
					echo '0%';
				}
				else{
					if($row['s_geography_countries'] == 0){
						echo '0%';
					}
					else{
						echo (($row['s_geography_countries'] / $ergebnis_geography_countries['COUNT(*)'])*100).'%';
					}
				}
				echo ' von 100 %';
			?>
		</div>	
		<div>	
			<h1> Filme:</h1>
			<?php 
			
				foreach( $db2->query('SELECT COUNT(*) FROM q_movies') as $ergebnis_movies){
					
				}
				if($ergebnis_movies['COUNT(*)']  == 0){
					echo '0%';
				}
				else{
					if($row['s_movies'] == 0){
						echo '0%';
					}
					else{
						echo (($row['s_movies'] / $ergebnis_movies['COUNT(*)'])*100).'%';
					}
				}
				echo ' von 100 %';
			?>
		</div>	
		<div>	
			<h1> Zeit und Geschichte:</h1>
			<?php 
				
				foreach( $db2->query('SELECT COUNT(*) FROM q_time_history') as $ergebnis_time_history){
					
				}
				if($ergebnis_time_history['COUNT(*)']  == 0){
					echo '0%';
				}
				else{
					if($row['s_time_history'] == 0){
						echo '0%';
					}
					else{
						echo (($row['s_time_history'] / $ergebnis_time_history['COUNT(*)'])*100).'%';
					}
				}
				echo ' von 100 %';
			?>
		</div>	
		<div>	
			<h1> Kunst und Design:</h1>
			<?php 
	
				foreach( $db2->query('SELECT COUNT(*) FROM q_art_design') as $ergebnis_art_design){
					
				}
				if($ergebnis_art_design['COUNT(*)']  == 0){
					echo '0%';
				}
				else{
					if($row['s_art_design'] == 0){
						echo '0%';
					}
					else{
						echo (($row['s_art_design'] / $ergebnis_art_design['COUNT(*)'])*100).'%';
					}
				}
				echo ' von 100 %';
			?>
		</div>
		<div>	
			<h1> Musik:</h1>
			<?php 
				foreach( $db2->query('SELECT COUNT(*) FROM q_music') as $ergebnis_music){
					
				}
				if($ergebnis_music['COUNT(*)']  == 0){
					echo '0%';
				}
				else{
					if($row['s_music'] == 0){
						echo '0%';
					}
					else{
						echo (($row['s_music'] / $ergebnis_music['COUNT(*)'])*100).'%';
					}
				}
				echo ' von 100 %';
			?>
		</div>
		<div>	
			<h1> Serien:</h1>
			<?php 

				foreach( $db2->query('SELECT COUNT(*) FROM q_tv') as $ergebnis_series){

				}
				if($ergebnis_series['COUNT(*)']  == 0){
					echo '0%';
				}
				else{
					if($row['s_series'] == 0){
						echo '0%';
					}
					else{
						echo (($row['s_series'] / $ergebnis_series['COUNT(*)'])*100).'%';
					}
				}
				echo ' von 100 %';
			?>
		</div>
		<div>	
			<h1> Politik:</h1>
			<?php 
				
				foreach( $db2->query('SELECT COUNT(*) FROM q_politics') as $ergebnis_politics){
					
				}
				if($ergebnis_politics['COUNT(*)']  == 0){
					echo '0%';
				}
				else{
					if($row['s_politics'] == 0){
						echo '0%';
					}
					else{
						echo (($row['s_politics'] / $ergebnis_politics['COUNT(*)'])*100).'%';
					}
				}
				echo ' von 100 %';
			
			?>
		</div>
		<div>	
			<h1> Wissenschaft:</h1>
			<?php 
				
				foreach( $db2->query('SELECT COUNT(*) FROM q_science') as $ergebnis_science){
					
				}
				if($ergebnis_science['COUNT(*)']  == 0){
					echo '0%';
				}
				else{
					if($row['s_science'] == 0){
						echo '0%';
					}
					else{
						echo (($row['s_science'] / $ergebnis_science['COUNT(*)'])*100).'%';
					}
				}
				echo ' von 100 %';
			?>
		</div>
		<div>	
			<h1> Natur und Tiere:</h1>
			<?php 
				
				$abfrage_anzahlfragen="SELECT COUNT(*) FROM q_animals_nature";
				foreach( $db2->query($abfrage_anzahlfragen) as $ergebnis_animals_nature){
					
				}
				if($ergebnis_animals_nature['COUNT(*)']  == 0){
					echo '0%';
				}
				else{
					if($row['s_animals_nature'] == 0){
						echo '0%';
					}
					else{
						echo (($row['s_animals_nature'] / $ergebnis_animals_nature['COUNT(*)'])*100).'%';
					}
				}
				echo ' von 100 %';
			
			?>
		</div>
		<div>	
			<h1> Technologie:</h1>
			<?php 
			
				foreach( $db2->query('SELECT COUNT(*) FROM q_technology') as $ergebnis_technology){
					
				}
				if($ergebnis_technology['COUNT(*)']  == 0){
					echo '0%';
				}
				else{
					if($row['s_technology'] == 0){
						echo '0%';
					}
					else{
						echo (($row['s_technology'] / $ergebnis_technology['COUNT(*)'])*100).'%';
					}
				}
				echo ' von 100 %';
			?>
		</div>
	</body>
</html>