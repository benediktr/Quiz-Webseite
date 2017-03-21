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
	
	$_SESSION['added'] = $user['counter_add_questions'];
	
	$id = $user['id'];
	$permission =  $user['status'];
	
	if( isset($_POST['res']) ) {
		$_SESSION['topic'] = null;
		$_SESSION['question'] = null;
		$_SESSION['right_answer'] = null;
		$_SESSION['wrong_answer_1'] = null;
		$_SESSION['wrong_answer_2'] = null;
		$_SESSION['wrong_answer_3'] = null;
	}
	
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
	
	if( isset($_POST['abschicken'] ) ) {
	
		$id = $_SESSION['userid'];
		
		$_SESSION['added'] += 1;
		$counter = $_SESSION['added'];
			
			
			
		$sql = "UPDATE user SET counter_add_questions='$counter' WHERE id='$id'";
		$stmt = $db->prepare($sql);
		$stmt->execute();

			
		if( !empty($_SESSION['question']) && !empty($_SESSION['right_answer']) && !empty($_SESSION['wrong_answer_1']) && !empty($_SESSION['wrong_answer_2']) && !empty($_SESSION['wrong_answer_3']) ) {
			
			$statement = $db->prepare("INSERT INTO ".$_SESSION['topic']." (question, right_answer, wrong_answer_1, wrong_answer_2, wrong_answer_3) VALUES (:question, :right_answer, :wrong_answer_1, :wrong_answer_2, :wrong_answer_3)");
			$result = $statement->execute(array('question' => $_SESSION['question'], 'right_answer' => $_SESSION['right_answer'], 'wrong_answer_1' => $_SESSION['wrong_answer_1'], 'wrong_answer_2' => $_SESSION['wrong_answer_2'], 'wrong_answer_3' => $_SESSION['wrong_answer_3']));
			
			$done2 = true;
		
			if($result) {
				$ausgabe = "Frage erfolgreich hinzugefügt.";
				$_SESSION['topic'] = null;
				$_SESSION['question'] = null;
				$_SESSION['right_answer'] = null;
				$_SESSION['wrong_answer_1'] = null;
				$_SESSION['wrong_answer_2'] = null;
				$_SESSION['wrong_answer_3'] = null;
			} 
				
			else {
				$ausgabe = "Frage nicht erfolgreich hinzugefügt.";
				$fehler = true;
			}
			
		}
			
		else {
			$ausgabe = "Frage nicht erfolgreich hinzugefügt.";
			$fehler = true;
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

		<h1 class = "titel">Fragen hinzuf&uuml;gen</h1>
		
		<div class = "zentrieren">
			<div class = "frageBox">
				<?php 
					if ($done2) {
						echo "<div class = 'box'><span class = 'green'>Frage erfolgreich hinzugefügt!</a></span></div><br />";
					} 
					
					if( $fehler ) {
						echo "<div class = 'box'><span class = 'red'>Frage nicht erfolgreich hinzugefügt!</a></span></div><br />";
					} 
					
					if( strcmp($permission, "Admin") != 0 ) {
						echo "<div class = 'box'><span class = 'red'>Du hast hier keine Berechtigung!</a></span></div><br />";
					}
					
				?>
				
				<br />
				
				<?php if( !$done && strcmp($permission, "Admin") == 0 ) { ?>
				<form action = "?addquestion=1" method= "post" name = "form">
					<select name = "topics">
						<option value = "art" <?php if( isset($_SESSION['topic']) ) {
							if( strcmp($_SESSION['topic'], "art") == 0 ) {
								echo "SELECTED";
							}
						} ?>>Kunst</option>
						<option value = "bible" <?php if( isset($_SESSION['topic']) ) {
							if( strcmp($_SESSION['topic'], "bible") == 0 ) {
								echo "SELECTED";
							}
						} ?>>Bibel</option>
						<option value = "eating" <?php if( isset($_SESSION['topic']) ) {
							if(strcmp($_SESSION['topic'], "eating") == 0 ) {
								echo "SELECTED";
							}
						} ?>>Essen</option>
						<option value = "freetime" <?php if( isset($_SESSION['topic']) ) {
							if( strcmp($_SESSION['topic'], "freetime") == 0 ) {
								echo "SELECTED";
							}
						} ?>>Sport</option>
						<option value = "geography" <?php if( isset($_SESSION['topic']) ) {
							if( strcmp($_SESSION['topic'], "geography") == 0 ) {
								echo "SELECTED";
							}
						} ?>>Kulturen</option>
						<option value = "history" <?php if( isset($_SESSION['topic']) ) {
							if( strcmp($_SESSION['topic'], "history") == 0 ) {
								echo "SELECTED";
							}
						} ?>>Geschichte</option>
						<option value = "movies" <?php if( isset($_SESSION['topic']) ) {
							if( strcmp($_SESSION['topic'], "movies") == 0 ) {
								echo "SELECTED";
							}
						} ?>>Filme</option>
						<option value = "musik" <?php if( isset($_SESSION['topic']) ) {
							if( strcmp($_SESSION['topic'], "musik") == 0 ) {
								echo "SELECTED";
							}
						} ?>>Musik</option>
						<option value = "nature" <?php if( isset($_SESSION['topic']) ) {
							if( strcmp($_SESSION['topic'], "nature") == 0 ) {
								echo "SELECTED";
							}
						} ?>>Natur</option>
						<option value = "politics" <?php if( isset($_SESSION['topic']) ) {
							if( strcmp($_SESSION['topic'], "politics") == 0 ) {
								echo "SELECTED";
							}
						} ?>>Politik</option>
						<option value = "science" <?php if( isset($_SESSION['topic']) ) {
							if( strcmp($_SESSION['topic'], "science") == 0 ) {
								echo "SELECTED";
							}
						} ?>>Wissenschaft</option>
						<option value = "technologie" <?php if( isset($_SESSION['topic']) ) {
							if( strcmp($_SESSION['topic'], "technologie") == 0 ) {
								echo "SELECTED";
							}
						} ?>>Technologien</option>
						<option value = "serie" <?php if( isset($_SESSION['topic']) ) {
							if( strcmp($_SESSION['topic'], "serie") == 0 ) {
								echo "SELECTED";
							}
						} ?>>Serien</option>
					</select>
					<br /><br />
					<input type = "name" placeholder = "Frage" size = "60" maxlength = "100" name = "question"
					<?php 
				
						if( !empty($_SESSION['question']) ) {
							echo "value='".$_SESSION['question']."'";
						}				
						
					?> >
					
					</input><br><br />
					
					<input type = "name" placeholder = "richtige Antwort" size = "30" maxlength = "30" name = "r_answer" 					
					<?php 
					
						if( !empty($_SESSION['right_answer']) ) {
							echo " value='".$_SESSION['right_answer']."'";
						}		
						
					?> >
					
					</input><br>
					<input type = "name" placeholder = "falsche Antwort" size = "30" maxlength = "30" name = "f_answer_1" 
					<?php 
					
						if( !empty($_SESSION['wrong_answer_1']) && !isset($_GET['res']) ) {
							echo "value='".$_SESSION['wrong_answer_1']."'";
						} ?>>
					
					</input><br>
					<input type = "name" placeholder = "falsche Antwort" size = "30" maxlength = "30" name = "f_answer_2" 
					<?php 
					
						if( !empty($_SESSION['wrong_answer_2']) && !isset($_GET['res']) ) {
							echo "value='".$_SESSION['wrong_answer_2']."'";
						}	
						?>>
					</input><br>
					<input type = "name" placeholder = "falsche Antwort" size = "30" maxlength = "30" name = "f_answer_3" 
					<?php 
					
						if( !empty($_SESSION['wrong_answer_3']) && !isset($_GET['res']) ) {
							echo "value='".$_SESSION['wrong_answer_3']."'";
						}					
						
					?>>
					</input><br>
					<input type = "submit" class = "registerButton" name = "res" value = "Formular Zur&uuml;cksetzen"></input>
					<br /><br />
					<input type = "submit" class = "button" value = "Frage hinzuf&uuml;gen" name = "add"/>
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