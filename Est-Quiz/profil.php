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
	
	$status = $user['status'];
	
	$username = $user['username'];
	$id = $user['id'];
	
	$total_score = $user['total_score'];
	$score_art = $user['score_art'];
	$score_bible = $user['score_bible'];
	$score_eating = $user['score_eating'];
	$score_freetime = $user['score_freetime'];
	$score_geography = $user['score_geography'];
	$score_history = $user['score_history'];
	$score_movies = $user['score_movies'];
	$score_music = $user['score_music'];
	$score_nature = $user['score_nature'];
	$score_politics = $user['score_politics'];
	$score_science = $user['score_science'];
	$score_technology = $user['score_technology'];
	$score_tvseries = $user['score_tvseries'];
	$score_art = $user['score_art'];
	$questions_done = $user['counter_answers'];
	$questions_right = $user['counter_right_answers'];
	$questions_wrong = $questions_done - $questions_right;
	$questions_added = $user['counter_add_questions'];
	
	$rank = $user['status'];
	$registerdate = $user['registerdate'];
	
	function getMaxQuestions( $topic, $db ) {
		$statement = $db->prepare("SELECT * FROM ".$topic." WHERE id = (SELECT MAX(id) FROM ".$topic.")");
		$statement->execute();
		$row = $statement->fetch();
	
		$max_id = $row['id'];	
		
		return $max_id;
	}
	
	/* Die Anzahl der Eintrage in der Datenbank jedes Themas holen, 
	die maximale Anzahl an Fragen zu haben */
	
	/*$statement = $db->prepare("SELECT * FROM art WHERE id = (SELECT MAX(id) FROM art)");
	$statement->execute();
	$row = $statement->fetch();
	
	$max_art = $row['id'];	*/
	
	$max_art = (getMaxQuestions( "art", $db ));
	$max_bible = getMaxQuestions( "bible", $db );
	$max_eating = getMaxQuestions( "eating", $db );
	$max_freetime = getMaxQuestions( "freetime", $db );
	$max_geography = getMaxQuestions( "geography", $db );
	$max_history = getMaxQuestions( "history", $db );
	$max_movies = getMaxQuestions( "movies", $db );
	$max_music = getMaxQuestions( "musik", $db );
	$max_nature = getMaxQuestions( "nature", $db );
	$max_politics = getMaxQuestions( "politics", $db );
	$max_science = getMaxQuestions( "science", $db );
	$max_technologie = getMaxQuestions( "technologie", $db );
	$max_tvserie = getMaxQuestions( "serie", $db );
	
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
					<a href="addquestion.php">Fragen hinzuf&uuml;gen</a>
				</li>
				<li>
					<a href="play.php">Spiel Starten</a>
				</li>
				<?php if( strcmp($status, "Admin") == 0 ) { ?>
				<li>
					<a href="admin.php">Adminpanel</a>
				</li>
				<?php } ?>
				<li>
					<a href="logout.php">Ausloggen</a>
				</li>
			</ul>
		</nav>
		<!-- Login -->	
		<h1 class = "titel">Profil&uuml;bersicht von <?php echo $username; ?></h1>
		<div class = 'box'>
			<p>Registrierungdatum: <?php echo $registerdate; ?></p>
			<p>Identifikationsnummer: <?php echo $id; ?></p>
			<p>Rang: <?php echo $rank; ?></p><br /><br />
			<p>Globaler Score: <?php echo $total_score; ?></p>
			<p>Fragen hinzugefügt: <?php echo $questions_added; ?></p>
			<p>Fragen beantwortet: <?php echo $questions_done; ?></p>
			<p>Richtig: <?php echo $questions_right; ?></p>
			<p>Falsch: <?php echo $questions_wrong; ?></p>
			
			<br />
			
			
			<p>Kunst Score: <?php echo $score_art; ?></p>
			
				<?php
				
				if($max_art  == 0){
					echo 'Es wurden noch keine Fragen hinzugefügt.';
				}
				else{
					if( $score_art == 0){
						echo '0%';
					}
					else{
						echo (( $score_art / $max_art )*100).'%';
					}
					echo ' von 100 %';
				}
				
				?>
			
				<br />
				
			
			<p>Bibel Score: <?php echo $score_bible; ?></p>
			
				<?php
				
				if($max_bible  == 0){
					echo 'Es wurden noch keine Fragen hinzugefügt.';
				}
				else{
					if( $score_art == 0){
						echo '0%';
					}
					else{
						echo (( $score_bible / $max_bible )*100).'%';
					}
					echo ' von 100 %';
				}
				
				?>
				
				<br />
			
			<p>Essens Score: <?php echo $score_eating; ?></p>
			
				<?php
				
				if($max_eating  == 0){
					echo 'Es wurden noch keine Fragen hinzugefügt.';
				}
				else{
					if( $score_eating == 0){
						echo '0%';
					}
					else{
						echo (( $score_eating / $max_eating )*100).'%';
					}
					echo ' von 100 %';
				}
				
				?>
				
				<br />
			
			<p>Sport Score: <?php echo $score_freetime; ?></p>
			
				<?php
				
				if($max_freetime  == 0){
					echo 'Es wurden noch keine Fragen hinzugefügt.';
				}
				else{
					if( $score_freetime == 0){
						echo '0%';
					}
					else{
						echo (( $score_freetime / $max_freetime )*100).'%';
					}
					echo ' von 100 %';
				}
				
				?>
				
				<br />
			
			<p>Kultur Score: <?php echo $score_geography; ?></p>
			
				<?php
				
				if($max_geography  == 0){
					echo 'Es wurden noch keine Fragen hinzugefügt.';
				}
				else{
					if( $score_geography == 0){
						echo '0%';
					}
					else{
						echo (( $score_geography / $max_geography )*100).'%';
					}
					echo ' von 100 %';
				}
				
				?>
				
				<br />
			
			<p>Geschichte Score: <?php echo $score_history; ?></p>
			
				<?php
				
				if($max_history  == 0){
					echo 'Es wurden noch keine Fragen hinzugefügt.';
				}
				else{
					if( $score_history == 0){
						echo '0%';
					}
					else{
						echo (( $score_history / $max_history )*100).'%';
					}
					echo ' von 100 %';
				}
				
				?>
				
				<br />
			
			<p>Filme Score: <?php echo $score_movies; ?></p>
			
				<?php
				
				if($max_movies  == 0){
					echo 'Es wurden noch keine Fragen hinzugefügt.';
				}
				else{
					if( $score_movies == 0){
						echo '0%';
					}
					else{
						echo (( $score_movies / $max_movies )*100).'%';
					}
					echo ' von 100 %';
				}
				
				?>
				
				<br />
			
			<p>Musik Score: <?php echo $score_music; ?></p>
			
				<?php
				
				if($max_music  == 0){
					echo 'Es wurden noch keine Fragen hinzugefügt.';
				}
				else{
					if( $score_music == 0){
						echo '0%';
					}
					else{
						echo (( $score_music / $max_music )*100).'%';
					}
					echo ' von 100 %';
				}
				
				?>
				
				<br />
			
			<p>Natur Score: <?php echo $score_nature; ?></p>
			
				<?php
				
				if($max_nature  == 0){
					echo 'Es wurden noch keine Fragen hinzugefügt.';
				}
				else{
					if( $score_nature == 0){
						echo '0%';
					}
					else{
						echo (( $score_nature / $max_nature )*100).'%';
					}
					echo ' von 100 %';
				}
				
				?>
				
				<br />
			
			<p>Politiks Score: <?php echo $score_politics; ?></p>
			
				<?php
				
				if($max_politics  == 0){
					echo 'Es wurden noch keine Fragen hinzugefügt.';
				}
				else{
					if( $score_politics == 0){
						echo '0%';
					}
					else{
						echo (( $score_politics / $max_politics )*100).'%';
					}
					echo ' von 100 %';
				}
				
				?>
				
				<br />
			
			<p>Wissenschafts Score: <?php echo $score_science; ?></p>
			
				<?php
				
				if($max_science  == 0){
					echo 'Es wurden noch keine Fragen hinzugefügt.';
				}
				else{
					if( $score_science == 0){
						echo '0%';
					}
					else{
						echo (( $score_science / $max_science )*100).'%';
					}
					echo ' von 100 %';
				}
				
				?>
				
				<br />
			
			<p>Technologies Score: <?php echo $score_technology; ?></p>
			
				<?php
				
				if($max_technology  == 0){
					echo 'Es wurden noch keine Fragen hinzugefügt.';
				}
				else{
					if( $score_technology == 0){
						echo '0%';
					}
					else{
						echo (( $score_technology / $max_technology )*100).'%';
					}
					echo ' von 100 %';
				}
				
				?>
				
				<br />
			
			<p>Serien Score: <?php echo $score_tvseries; ?></p>
			
				<?php
				
				if($max_tvserie  == 0){
					echo 'Es wurden noch keine Fragen hinzugefügt.';
				}
				else{
					if( $score_tvserie == 0){
						echo '0%';
					}
					else{
						echo (( $score_tvserie / $max_tvserie )*100).'%';
					}
					echo ' von 100 %';
				}
				
				?>
				
				<br />
			
		</div><br />
	</body>
</html>