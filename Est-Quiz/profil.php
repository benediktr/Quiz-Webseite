<?php 
	session_start();
	require('php/functions.php');
	
	if( isset($_SESSION['userid']) ) {
		$access = true;
	} else {
		$access = false;
	}
	
	$id = $_SESSION['userid'];
	$statement = $db->prepare("SELECT * FROM user WHERE id = :id");
	$result = $statement->execute(array('id' => $id));
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
	$score_tvseries = $user['score_series'];
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
	$max_tvserie = getMaxQuestions( "series", $db );
	
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
				<h1>Profil</h1>
				<p>Est Quiz-Projekt von Benedikt Ross und Lukas Keller</p>
			</div>
			<hr />
			<?php if( !$access ) { ?>
				<p style="text-align:center;">Bitte zuerst <a href = "login.php">Einloggen</a>!</p>
			<?php } else { ?>
				<div style="text-align:center">
					<h2 class="w3-center w3-opacity">Pers&ouml;nliches</h2>
					<table class="w3-table-all w3-hoverable" style = "width: 90%">
						<tr class="w3-light-grey">
							<th>Registrierungsdatum</th>
							<th>Identifikationsnummer</th>
							<th>Status</th>
						</tr>
						<tr>
						<?php 
							echo "<td>".$registerdate."</td>";
							echo "<td>".$id."</td>";
							echo "<td>".$status."</td>";
						?>
						</tr>				
					</table>
					<h2 class="w3-center w3-opacity">Globales</h2>
					<table class="w3-table-all w3-hoverable" style = "width: 90%">
						<tr class="w3-light-grey">
							<th>Globaler Score</th>
							<th>Fragen hinzugef&uuml;gt</th>
							<th>Fragen beantwortet</th>
							<th>Fragen richtig beantwortet</th>
							<th>Fragen falsch beantwortet</th>
						</tr>
						<tr>
						<?php 
							echo "<td>".$total_score."</td>";
							echo "<td>".$questions_added."</td>";
							echo "<td>".$questions_done."</td>";
							echo "<td>".$questions_right."</td>";
							echo "<td>".$questions_wrong."</td>";
						?>
						</tr>
					</table>
					<h2 class="w3-center w3-opacity">Themenstatistiken</h2>
					<table class="w3-table-all w3-hoverable" style = "width: 90%">
							<tr class="w3-light-grey">
								<th>Thema</th>
								<th>Fragen beantwortet</th>
								<th>Prozentual erledigt</th>
							</tr>
							<tr>
								<?php 
									/* Kunst */
									echo "<td>Kunst</td>";
									echo "<td>".$score_art."</td>";
									
									if( $score_art == 0 ) {
										echo "<td>0%";
									} else {
										echo "<td>".( ( $score_art / $max_art ) *100 ).'%';
									}
									echo ' von 100%</td>';
									
									echo "</tr><tr>";
									
									/* Bibel */
									echo "<td>Bibel</td>";
									echo "<td>".$score_bible."</td>";
									
									if( $score_bible == 0 ) {
										echo "<td>0%";
									} else {
										echo "<td>".( ( $score_bible / $max_bible ) *100 ).'%';
									}
									echo ' von 100%</td>';
									
									echo "</tr><tr>"; 
									
									/* Essen */
									echo "<td>Essen</td>";
									echo "<td>".$score_eating."</td>";
									
									if( $score_eating == 0 ) {
										echo "<td>0%";
									} else {
										echo "<td>".( ( $score_eating / $max_eating ) *100 ).'%';
									}
									echo ' von 100%</td>';
									
									echo "</tr><tr>";
									
									/* Sport */
									echo "<td>Sport</td>";
									echo "<td>".$score_freetime."</td>";
									
									if( $score_freetime == 0 ) {
										echo "<td>0%";
									} else {
										echo "<td>".( ( $score_freetime / $max_freetime ) *100 ).'%';
									}
									echo ' von 100%</td>';
									
									echo "</tr><tr>";
									
									/* Kultur */
									echo "<td>Kultur</td>";
									echo "<td>".$score_geography."</td>";
									
									if( $score_geography == 0 ) {
										echo "<td>0%";
									} else {
										echo "<td>".( ( $score_geography / $max_geography ) *100 ).'%';
									}
									echo ' von 100%</td>';
									
									echo "</tr><tr>";
									
									/* Geschichte */
									echo "<td>Geschichte</td>";
									echo "<td>".$score_history."</td>";
									
									if( $score_history == 0 ) {
										echo "<td>0%";
									} else {
										echo "<td>".( ( $score_history / $max_history ) *100 ).'%';
									}
									echo ' von 100%</td>';
									
									echo "</tr><tr>";
									
									/* Filme */
									echo "<td>Filme</td>";
									echo "<td>".$score_movies."</td>";
									
									if( $score_movies == 0 ) {
										echo "<td>0%";
									} else {
										echo "<td>".( ( $score_movies / $max_movies ) *100 ).'%';
									}
									echo ' von 100%</td>';
									
									echo "</tr><tr>";
									
									/* Musik */
									echo "<td>Musik</td>";
									echo "<td>".$score_music."</td>";
									
									if( $score_music == 0 ) {
										echo "<td>0%";
									} else {
										echo "<td>".( ( $score_music / $max_music ) *100 ).'%';
									}
									echo ' von 100%</td>';
									
									echo "</tr><tr>";
									
									/* Natur */
									echo "<td>Natur</td>";
									echo "<td>".$score_nature."</td>";
									
									if( $score_nature == 0 ) {
										echo "<td>0%";
									} else {
										echo "<td>".( ( $score_nature / $max_nature ) *100 ).'%';
									}
									echo ' von 100%</td>';
									
									echo "</tr><tr>";
									
									/* Politik */
									echo "<td>Politik</td>";
									echo "<td>".$score_politics."</td>";
									
									if( $score_politics == 0 ) {
										echo "<td>0%";
									} else {
										echo "<td>".( ( $score_politics / $max_politics ) *100 ).'%';
									}
									echo ' von 100%</td>';
									
									echo "</tr><tr>";
									
									/* Wissenschaft */
									echo "<td>Wissenschaft</td>";
									echo "<td>".$score_science."</td>";
									
									if( $score_science == 0 ) {
										echo "<td>0%";
									} else {
										echo "<td>".( ( $score_science / $max_science ) *100 ).'%';
									}
									echo ' von 100%</td>';
									
									echo "</tr><tr>";
									
									/* Technologien */
									echo "<td>Technologien</td>";
									echo "<td>".$score_technology."</td>";
									
									if( $score_technology == 0 ) {
										echo "<td>0%";
									} else {
										echo "<td>".( ( $score_technology / $max_technologie ) *100 ).'%';
									}
									echo ' von 100%</td>';
								
									echo "</tr><tr>";
								
									/* Serien */
									echo "<td>Serien</td>";
									echo "<td>".$score_tvseries."</td>";
								
									if( $score_tvseries == 0 ) {
										echo "<td>0%";
									} else {
										echo "<td>".( ( $score_tvseries / $max_tvserie ) *100 ).'%';
									}
									echo ' von 100%</td>';
								?>
							</tr>
				
					</table>
					<br />
				</div>
			<?php } ?>
		</div>
	</body>
</html>