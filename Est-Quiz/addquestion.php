<?php session_start(); ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
 
<?php
	require 'php/functions.php'; 
	session_start();
	
	if(!isset($_SESSION['userid'])) {
		die('Bitte zuerst <a href="login.php">einloggen</a>');
	}
	
	$done = false;
	$done2 = false;
	$fehler = false;
	
	$userid = $_SESSION['userid'];
	$statement = $db->prepare("SELECT * FROM user WHERE id = :id");
	$result = $statement->execute(array('id' => $userid));
	$user  = $statement->fetch();
	
	$id = $user['id'];
	$counter = $user['counter_add_question'] + 1;
	$_SESSION['counter'] = $counter;
	
	if( isset($_GET['addquestion']) ) {
		if( isset($_POST['add']) ) {
			$done = true;
			$topic = $_POST['topics'];
			$question = $_POST['question'];
			$right_answer = $_POST['r_answer'];
			$wrong_answer_1 = $_POST['f_answer_1'];
			$wrong_answer_2 = $_POST['f_answer_2'];
			$wrong_answer_3 = $_POST['f_answer_3'];
			$_SESSION['question'] = $question;
			$_SESSION['right_answer'] = $right_answer;
			$_SESSION['wrong_answer_1'] = $wrong_answer_1;
			$_SESSION['wrong_answer_2'] = $wrong_answer_2;
			$_SESSION['wrong_answer_3'] = $wrong_answer_3;
			$_SESSION['topic'] = $topic;
		}
	}
	
	if( isset( $_GET['add'] ) ) {
		if( isset($_POST['abschicken'] ) ) {
	
		/*	$statement3 = $db->prepare("UPDATE user SET counter_add_questions = :counter_add_questions WHERE id = :id");
			$statement3->execute(array('counter_add_questions' => $_SESSION['counter'])); */ // Funktioniert noch nicht - Grund: keine Ahnung, will nicht
		
			$statement = $db->prepare("INSERT INTO ".$_SESSION['topic']." (question, right_answer, wrong_answer_1, wrong_answer_2, wrong_answer_3) VALUES (:question, :right_answer, :wrong_answer_1, :wrong_answer_2, :wrong_answer_3)");
			$result = $statement->execute(array('question' => $_SESSION['question'], 'right_answer' => $_SESSION['right_answer'], 'wrong_answer_1' => $_SESSION['wrong_answer_1'], 'wrong_answer_2' => $_SESSION['wrong_answer_2'], 'wrong_answer_3' => $_SESSION['wrong_answer_3']));
			
			$done2 = true;
			
			if($result) {
				$ausgabe = "Frage erfolgreich hinzugefügt.";
			} 
				
			else {
				$ausgabe = "Frage nicht erfolgreich hinzugefügt.";
				$fehler = true;
			}
		
		}
	}
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
		<h1 class = "titel">Fragen hinzuf&uuml;gen</h1>
		<div class = "zentrieren">
			<div class = "frageBox">
				<?php 
					if ($done2) {
						echo "<div class = 'box'><span class = 'green'>Frage erfolgreich hinzugefügt!</a></span></div><br />";
					} 
					
					if( $fehler ) {
						echo "<div class = 'box'><span class = 'red'>Frage nicht erfolgreich hinzugefügt!</a></span></div><br />";
					} ?>
					<br />
				<?php if( !$done ) { ?>
				<form action = "?addquestion=1" method= "post">
					<select name = "topics">
						<option value = "art">Kunst</option>
						<option value = "bible">Bibel</option>
						<option value = "eating">Essen</option>
						<option value = "freetime">Sport</option>
						<option value = "geography">Kulturen</option>
						<option value = "history">Geschichte</option>
						<option value = "movies">Filme</option>
						<option value = "musik">Musik</option>
						<option value = "nature">Natur</option>
						<option value = "politics">Politik</option>
						<option value = "science">Wissenschaft</option>
						<option value = "technologie">Technologien</option>
						<option value = "serie">Serien</option>
					</select>
					<br /><br />
					<input type = "name" placeholder = "Frage" size = "60" maxlength = "100" name = "question"><br><br />
					<input type = "name" placeholder = "richtige Antwort" size = "30" maxlength = "30" name = "r_answer"><br>
					<input type = "name" placeholder = "falsche Antwort" size = "30" maxlength = "30" name = "f_answer_1"><br>
					<input type = "name" placeholder = "falsche Antwort" size = "30" maxlength = "30" name = "f_answer_2"><br>
					<input type = "name" placeholder = "falsche Antwort" size = "30" maxlength = "30" name = "f_answer_3"><br>
					<input type = "submit" class = "button" value = "Frage hinzufügen" name = "add">
				</form>
				<?php } if( $done ) { ?>
				<form action = "?add=1" method = "POST">
					<p class = "text"><u>Thema</u><br /><br />
					<?php echo "$topic <br /><br />" ?>
					<u>Frage</u><br /><br />
					<?php echo "$question <br /><br />" ?>
					<u>Richtige Antwort</u><br /><br />
					<?php echo "$right_answer <br /><br />" ?>
					<u>Falsche Antwort 1</u><br /><br />
					<?php echo "$wrong_answer_1 <br /><br />" ?>
					<u>Falsche Antwort 2</u><br /><br />
					<?php echo "$wrong_answer_2 <br /><br />" ?>
					<u>Falsche Antwort 3</u><br /><br />
					<?php echo "$wrong_answer_3 <br /><br />" ?>
					Eingabe nicht richtig? <a href = "addquestion.php">zur&uuml;ck!</a></p><br />
					<input type = "submit" name = "abschicken" value = "Eintragen" class = "button"></input>
				</form>
				<?php } ?>
			</div>
		</div>
		<br />
	</body>
</html>