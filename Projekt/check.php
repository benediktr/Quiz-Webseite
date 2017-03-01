<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
 
<?php
	require 'php/database.php'; 
	session_start();
	
	if(!isset($_SESSION['userid'])) {
		die('Bitte zuerst <a href="login.php">einloggen</a>');
	}
	
	$userid = $_SESSION['userid'];
	$statement = $db->prepare("SELECT * FROM user_accounts WHERE id = :id");
	$result = $statement->execute(array('id' => $userid));
	$user  = $statement->fetch();
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
 
<?php	
	$topic = $_POST['topics'];
	if( $_POST['question'] != null ) {
		$question = $_POST['question'];
	}
	if( $_POST['r_answer'] != null ) {
		$r_answer = $_POST['r_answer'];
	}
	if( $_POST['f_answer_1'] != null ) {
		$f_answer_1 = $_POST['f_answer_1'];
	}
	if( $_POST['f_answer_2'] != null ) {
		$f_answer_2 = $_POST['f_answer_2'];
	}
	if( $_POST['f_answer_3'] != null ) {
		$f_answer_3 = $_POST['f_answer_3'];
	}
	
	if (isset($_POST['add'])) {
		if ($question != null && $r_answer != null && $r_answer != null && $f_answer_1 != null && $f_answer_2 != null && $f_answer_3 != null) {
			$statement = $db2->prepare("INSERT INTO question (topic, question, r_answer, f_answer_1, f_answer_2, f_answer_3) VALUES (:topic, :question, :r_answer, :f_anwer_1, :f_answer_2, :f_answer_3)");
			$result = $statement->execute(array('topic' => $topic, 'question' => $question, 'r_answer' => $r_answer, 'f_answer_1' => $f_answer_1, 'f_answer_2' => $f_answer_2, 'f_answer_3' => $f_answer_3));
			echo '<div class = "zentrieren"><p class = "text">Erfolgreich Eingefügt!</p></div>';
			end;
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
					<a href="addquestion.php">Fragen hinzuf&uuml;en</a>
				</li>
				<li>
					<a href="play.php">Spiel Starten</a>
				</li>
				<li>
					<a href="logout.php">Ausloggen</a>
				</li>
			</ul>
		</nav>

		<div class = "zentrieren">
			<div class = "frageBox">
				<form action = "?add=1">
				<p class = "text"><u>Thema</u><br /><br />
				<?php echo "$topic <br /><br />" ?>
				<u>Frage</u><br /><br />
				<?php echo "$question <br /><br />" ?>
				<u>Richtige Antwort</u><br /><br />
				<?php echo "$r_answer <br /><br />" ?>
				<u>Falsche Antwort 1</u><br /><br />
				<?php echo "$f_answer_1 <br /><br />" ?>
				<u>Falsche Antwort 2</u><br /><br />
				<?php echo "$f_answer_2 <br /><br />" ?>
				<u>Falsche Antwort 3</u><br /><br />
				<?php echo "$f_answer_3 <br /><br />" ?>
				Eingabe nicht richtig? <a href = "addquestion.php">zur&uuml;ck!</a></p><br />
				<input type = "submit" name = "abschicken" value = "Eintragen" class = "button"></input>
				</form>
			</div>
		</div>
		<br />
	</body>
</html>
