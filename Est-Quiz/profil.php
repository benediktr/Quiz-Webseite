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
	
	$total_score = $user['total_score'];
	$score_art = $user['score_art'];
	$score_bible = $user['score_bible'];
	$score_eating = $user['score_eating'];
	$score_freetime = $user['score_freetime'];
	$score_geography = $user['score_geography'];
	$score_history = $user['score_history'];
	$score_movies = $user['score_movies'];
	$score_musik = $user['score_musik'];
	$score_nature = $user['score_nature'];
	$score_politics = $user['score_politics'];
	$score_science = $user['score_science'];
	$score_technologie = $user['score_technologie'];
	$score_serie = $user['score_serie'];
	$score_art = $user['score_art'];
	$questions_done = $user['counter_answers'];
	$questions_right = $user['counter_right_answers'];
	$questions_wrong = $user['counter_wrong_answers'];
	$questions_added = $user['counter_add_questions'];
	
	$rank = $user['status'];
	$registerdate = $user['registerdate'];
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
			<p>Kunst Score: <?php echo $score_art; ?></p>
			<p>Bibel Score: <?php echo $score_bible; ?></p>
			<p>Essens Score: <?php echo $score_eating; ?></p>
			<p>Sport Score: <?php echo $score_freetime; ?></p>
			<p>Kultur Score: <?php echo $score_geography; ?></p>
			<p>Geschichte Score: <?php echo $score_history; ?></p>
			<p>Filme Score: <?php echo $score_movies; ?></p>
			<p>Musik Score: <?php echo $score_musik; ?></p>
			<p>Natur Score: <?php echo $score_nature; ?></p>
			<p>Politiks Score: <?php echo $score_politics; ?></p>
			<p>Wissenschafts Score: <?php echo $score_science; ?></p>
			<p>Technologies Score: <?php echo $score_technologie; ?></p>
			<p>Serien Score: <?php echo $score_serie; ?></p>
		</div><br />
	</body>
</html>