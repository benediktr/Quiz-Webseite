<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
  
<?php
	require 'database.php'; 
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
			
			$abfrage_anzahlfragen="";
				
		?>
		
		<div>
			<h2> Dein Score: </h2>
			<?php
				echo $row["total_score"];
			?>
		</div>
		<div>
			<h2> Bibel:</h2>
			<?php $stand_bibel=$row['s_bible'];
				
			?>
		</div>	
		<div>	
			<h2> Sport und Freizeit:</h2>
			<?php echo $row['s_sport_freetime']; ?>
		</div>	
		<div>	
			<h2> Essen und Trinken:</h2>
			<?php echo $row['s_eating_drinking']; ?>
		</div>	
		<div>	
			<h2> Kulturen:</h2>
			<?php echo $row['s_geography_countries']; ?>
		</div>	
		<div>	
			<h2> Filme:</h2>
			<?php echo $row['s_movies']; ?>
		</div>	
		<div>	
			<h2> Zeit und Geschichte:</h2>
			<?php echo $row['s_time_history']; ?>
		</div>	
		<div>	
			<h2> Kunst und Design:</h2>
			<?php echo $row['s_art_design']; ?>
		</div>
		<div>	
			<h2> Musik:</h2>
			<?php echo $row['s_music']; ?>
		</div>
		<div>	
			<h2> Serien:</h2>
			<?php echo $row['s_series']; ?>
		</div>
		<div>	
			<h2> Politik:</h2>
			<?php echo $row['s_politics']; ?>
		</div>
		<div>	
			<h2> Wissenschaft:</h2>
			<?php echo $row['s_science']; ?>
		</div>
		<div>	
			<h2> Natur und Tiere:</h2>
			<?php echo $row['s_animals_nature']; ?>
		</div>
		<div>	
			<h2> Technologie:</h2>
			<?php echo $row['s_science']; ?>
		</div>
	</body>
</html>