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
	
	$rank = $user['status'];
	
	if( strcmp($rank, "Admin") == 0 ) {
		$adminAccess = true;
	} else {
		$adminAccess = false;
	}
	
	$_SESSION['added'] = $user['counter_add_questions'];
	
	$id = $user['id'];
	
	$done = false;
	
	// Resetten des Formulars
	
	if( isset($_POST['res']) ) {
		$_SESSION['topic'] = null;
		$_SESSION['question'] = null;
		$_SESSION['right_answer'] = null;
		$_SESSION['wrong_answer_1'] = null;
		$_SESSION['wrong_answer_2'] = null;
		$_SESSION['wrong_answer_3'] = null;
	}
	
	// Auslesen des Formulars
	
	if( isset($_GET['addquestion']) ) {
		if( isset($_POST['add']) ) {
			$done = true;
			$topic = htmlentities($_POST['topics']);
			$question = htmlentities($_POST['question']);
			$right_answer = htmlentities($_POST['r_answer']);
			$wrong_answer_1 = htmlentities($_POST['f_answer_1']);
			$wrong_answer_2 = htmlentities($_POST['f_answer_2']);
			$wrong_answer_3 = htmlentities($_POST['f_answer_3']);
			$_SESSION['question'] = $question;
			$_SESSION['right_answer'] = $right_answer;
			$_SESSION['wrong_answer_1'] = $wrong_answer_1;
			$_SESSION['wrong_answer_2'] = $wrong_answer_2;
			$_SESSION['wrong_answer_3'] = $wrong_answer_3;
			$_SESSION['topic'] = $topic;
		}
	}
	
	// Einreichen der Fragen falls der User Admin ist
	
	if( isset($_POST['abschicken'] ) ) {
		
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
				
				$done4 = true;
				
				$id = $_SESSION['userid'];
		
				$_SESSION['added'] += 1;
				$counter = $_SESSION['added'];
			
				$sql = "UPDATE user SET counter_add_questions='$counter' WHERE id='$id'";
				$stmt = $db->prepare($sql);
				$stmt->execute();
		
			} 
				
			else {
				$ausgabe = "Frage nicht erfolgreich hinzugefügt.";
				$fehler = true;
				$done4 = false;
			}
			
		}
		
	}
	
	// Einreichen falls der User kein Admin ist
	
	if( isset($_GET['addquestion']) ) {
		if( isset($_POST['addToAdmin']) ) {
			$done2 = true;
			$einreichen = true;
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
	
	if( isset($_POST['einreichen']) ) {
		if( !empty($_SESSION['question']) && !empty($_SESSION['right_answer']) && !empty($_SESSION['wrong_answer_1']) && !empty($_SESSION['wrong_answer_2']) && !empty($_SESSION['wrong_answer_3']) ) {
			
			$statement = $db->prepare("INSERT INTO submit (question, right_answer, wrong_answer_1, wrong_answer_2, wrong_answer_3, topic, eingereichteid) VALUES (:question, :right_answer, :wrong_answer_1, :wrong_answer_2, :wrong_answer_3, :topic, :eingereichteid)");
			$result = $statement->execute(array('question' => $_SESSION['question'], 'right_answer' => $_SESSION['right_answer'], 'wrong_answer_1' => $_SESSION['wrong_answer_1'], 'wrong_answer_2' => $_SESSION['wrong_answer_2'], 'wrong_answer_3' => $_SESSION['wrong_answer_3'], 'topic' => $_SESSION['topic'], 'eingereichteid' => $_SESSION['userid']));
		
			if($result) {
				$ausgabe = "Frage erfolgreich hinzugefügt.";
				$_SESSION['topic'] = null;
				$_SESSION['question'] = null;
				$_SESSION['right_answer'] = null;
				$_SESSION['wrong_answer_1'] = null;
				$_SESSION['wrong_answer_2'] = null;
				$_SESSION['wrong_answer_3'] = null;		
				$erfolgreichEingereicht = true;
				$fail = false;
			} else {
				$ausgabe = "Frage nicht erfolgreich hinzugefügt.";
				$fehler2 = true;
				$erfolgreichEingereicht = false;
				$fail = true;
			}
			
		}
	}
	
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
  
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" >
	<head>
		<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
		<title>EST Quiz-Projekt</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="https://www.w3schools.com/w3css/3/w3.css">
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
				<h1>Fragen hinzufügen</h1>
				<p>Est Quiz-Projekt von Benedikt Ross und Lukas Keller</p>
			</div>
			<hr />
			<?php
			if( !$erfolgreichEingereicht && !$adminAccess && $fail ) { ?>
				<center>
					<div class="w3-panel w3-red w3-display-container">
					<span onclick="this.parentElement.style.display='none'"
					class="w3-button w3-red w3-large w3-display-topright">&times;</span>
						<h3>Fehler!</h3>
						<p>Die Frage wurde nicht hinzugefügt!</p>
					</div> 
				</center>
			<?php } 
			
			if( $erfolgreichEingereicht ) { ?>
				<center>
					<div class="w3-panel w3-green w3-display-container">
					<span onclick="this.parentElement.style.display='none'"
					class="w3-button w3-red w3-large w3-display-topright">&times;</span>
						<h3>Erfolgreich!</h3>
						<p>Die Frage wurde erfolgreich eingereichte! Ein Admin wird sich in kürze darum kümmern.</p>
					</div> 
				</center>
			<?php } 
			
			if( $fehler && $adminAccess ) { ?>
				<center>
					<div class="w3-panel w3-red w3-display-container">
					<span onclick="this.parentElement.style.display='none'"
					class="w3-button w3-red w3-large w3-display-topright">&times;</span>
						<h3>Fehler!</h3>
						<p>Die Frage wurde nicht erfolgreich hinzugefügt!</p>
					</div> 
				</center>
			<?php } if( !$fehler && $adminAccess && $done4 ) { ?>
				<center>
					<div class="w3-panel w3-green w3-display-container">
					<span onclick="this.parentElement.style.display='none'"
					class="w3-button w3-red w3-large w3-display-topright">&times;</span>
						<h3>Erfolreich!</h3>
						<p>Die Frage wurde erfolgreich hinzugefügt!</p>
					</div> 
				</center>
			<?php }  
			
			if( !$access ) { ?>
			
				<center>
					<p>Bitte zuerst <a href = "login.php">Einloggen</a>!</p>
				</center>
				
			<?php } if( $adminAccess && !$done ) { ?>
			
			<!-- Falls der User Admin ist -->
			
			<div class="w3-container"> 
				<center>
					<form action = "?addquestion=1" method= "post" name = "form">
						<label class="w3-label w3-text-green">Themenauswahl</label>
						<select name = "topics" class="w3-select">
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
							<option value = "series" <?php if( isset($_SESSION['topic']) ) {
								if( strcmp($_SESSION['topic'], "series") == 0 ) {
									echo "SELECTED";
								}
							} ?>>Serien</option>
						</select>
						<br /><br />
						<label class = "w3-label w3-text-green">Quiz Frage</label>
						<input type = "name" class = "w3-input w3-border" size = "60" maxlength = "150" name = "question"
							<?php 
							
								if( !empty($_SESSION['question']) ) {
									echo "value='".$_SESSION['question']."'";
								}
								
							?> />
						</input><br /><br />
						<label class = "w3-label w3-text-green">Richtige Antwort</label>
						<input type = "name" class = "w3-input w3-border" size = "60" maxlength = "60" name = "r_answer" 					
						<?php 
						
							if( !empty($_SESSION['right_answer']) ) {
								echo " value='".$_SESSION['right_answer']."'";
							}		
							
						?> >
						
						</input><br>
						<label class = "w3-label w3-text-green">1. Falsche Antwort</label>
						<input type = "name" class = "w3-input w3-border" size = "60" maxlength = "60" name = "f_answer_1" 
						<?php 
						
							if( !empty($_SESSION['wrong_answer_1']) && !isset($_GET['res']) ) {
								echo "value='".$_SESSION['wrong_answer_1']."'";
							} ?>>
						
						</input><br>
						<label class = "w3-label w3-text-green">2. Falsche Antwort</label>
						<input type = "name" class = "w3-input w3-border" size = "60" maxlength = "60" name = "f_answer_2" 
						<?php 
						
							if( !empty($_SESSION['wrong_answer_2']) && !isset($_GET['res']) ) {
								echo "value='".$_SESSION['wrong_answer_2']."'";
							}	
							?>>
						</input><br>
						<label class = "w3-label w3-text-green">3. Falsche Antwort</label>
						<input type = "name" class = "w3-input w3-border" size = "60" maxlength = "60" name = "f_answer_3" 
						<?php 
						
							if( !empty($_SESSION['wrong_answer_3']) && !isset($_GET['res']) ) {
								echo "value='".$_SESSION['wrong_answer_3']."'";
							}					
							
						?>>
						</input>
						<br>
						<center>
							<input class = "w3-button w3-white w3-border w3-border-red w3-round-large" type = "submit" value ="Zurücksetzen" name = "res"/><br /><br />
						</center>
						<center>
							<input class = "w3-button w3-white w3-border w3-border-red w3-round-large" type = "submit" value ="Eintragen" name = "add"/><br />
							</form>
						</center>
					</div>
					<?php } if( $done ) { ?>
					<center>
						<form action = "?add=1" method = "POST">
							<label class = "w3-label w3-text-green">Thema</label><br />
							<?php echo "$topic <br /><br />" ?>
							<label class = "w3-label w3-text-green">Frage</label><br />
							<?php echo "$question <br /><br />" ?>
							<label class = "w3-label w3-text-green">Richtige Antwort</label><br />
							<?php echo "$right_answer <br /><br />" ?>
							<label class = "w3-label w3-text-green">1. Falsche Antwort</label><br />
							<?php echo "$wrong_answer_1 <br /><br />" ?>
							<label class = "w3-label w3-text-green">2. Falsche Antwort</label><br />
							<?php echo "$wrong_answer_2 <br /><br />" ?>
							<label class = "w3-label w3-text-green">3. Falsche Antwort</label><br />
							<?php echo "$wrong_answer_3 <br /><br />" ?>
							<p>Eingabe nicht richtig? <a href = "addquestion.php">zur&uuml;ck!</a></p><br />
							<center>
								<input class = "w3-button w3-white w3-border w3-border-red w3-round-large" type = "submit" value ="Eintragen" name = "abschicken"/></center>
							</form>
						</center>
				</center>
			<?php } /* if( $fehler && $adminAccess ) { ?>
				<center>
					<p class = "w3-text-red">Fehler beim hinzufügen der Frage!</p>
				</center>
			<?php } if( !$fehler && $adminAccess && $done4 ) { ?>
				<center>
					<p class = "w3-text-green">Du hast die Frage erfolgreich hinzugefügt!</p>
				</center>
			<?php } */ ?>
			
			<!-- Falls der User kein Admin ist -->
			
			<?php if( !$adminAccess && !$done2 && $access ) { ?>
			
				<div class="w3-container"> 
				<center>
					<form action = "?addquestion=1" method= "post" name = "form">
						<label class="w3-label w3-text-green">Themenauswahl</label>
						<select name = "topics" class="w3-select">
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
						<label class = "w3-label w3-text-green">Quiz Frage</label>
						<input type = "name" class = "w3-input w3-border" size = "60" maxlength = "150" name = "question"
							<?php 
							
								if( !empty($_SESSION['question']) ) {
									echo "value='".$_SESSION['question']."'";
								}
								
							?> />
						</input><br /><br />
						<label class = "w3-label w3-text-green">Richtige Antwort</label>
						<input type = "name" class = "w3-input w3-border" size = "60" maxlength = "60" name = "r_answer" 					
						<?php 
						
							if( !empty($_SESSION['right_answer']) ) {
								echo " value='".$_SESSION['right_answer']."'";
							}		
							
						?> >
						
						</input><br>
						<label class = "w3-label w3-text-green">1. Falsche Antwort</label>
						<input type = "name" class = "w3-input w3-border" size = "60" maxlength = "60" name = "f_answer_1" 
						<?php 
						
							if( !empty($_SESSION['wrong_answer_1']) && !isset($_GET['res']) ) {
								echo "value='".$_SESSION['wrong_answer_1']."'";
							} ?>>
						
						</input><br>
						<label class = "w3-label w3-text-green">2. Falsche Antwort</label>
						<input type = "name" class = "w3-input w3-border" size = "60" maxlength = "60" name = "f_answer_2" 
						<?php 
						
							if( !empty($_SESSION['wrong_answer_2']) && !isset($_GET['res']) ) {
								echo "value='".$_SESSION['wrong_answer_2']."'";
							}	
							?>>
						</input><br>
						<label class = "w3-label w3-text-green">3. Falsche Antwort</label>
						<input type = "name" class = "w3-input w3-border" size = "60" maxlength = "60" name = "f_answer_3" 
						<?php 
						
							if( !empty($_SESSION['wrong_answer_3']) && !isset($_GET['res']) ) {
								echo "value='".$_SESSION['wrong_answer_3']."'";
							}					
							
						?>>
						</input>
						<br>
						<center>
							<input class = "w3-button w3-white w3-border w3-border-red w3-round-large" type = "submit" value ="Zurücksetzen" name = "res"/><br /><br />
						</center>
						<center>
							<input class = "w3-button w3-white w3-border w3-border-red w3-round-large" type = "submit" value ="Einreichen" name = "addToAdmin"/><br />
							</form>
						</center>
					</div>
			
			<?php } if( $einreichen && $access ) { ?>
				<center>
					<form action = "?add=1" method = "POST">
						<label class = "w3-label w3-text-green">Thema</label><br />
						<?php echo "$topic <br /><br />" ?>
						<label class = "w3-label w3-text-green">Frage</label><br />
						<?php echo "$question <br /><br />" ?>
						<label class = "w3-label w3-text-green">Richtige Antwort</label><br />
						<?php echo "$right_answer <br /><br />" ?>
						<label class = "w3-label w3-text-green">1. Falsche Antwort</label><br />
						<?php echo "$wrong_answer_1 <br /><br />" ?>
						<label class = "w3-label w3-text-green">2. Falsche Antwort</label><br />
						<?php echo "$wrong_answer_2 <br /><br />" ?>
						<label class = "w3-label w3-text-green">3. Falsche Antwort</label><br />
						<?php echo "$wrong_answer_3 <br /><br />" ?>
						<p>Eingabe nicht richtig? <a href = "addquestion.php">zur&uuml;ck!</a></p><br />
						<center>
							<input class = "w3-button w3-white w3-border w3-border-red w3-round-large" type = "submit" value ="Einreichen" name = "einreichen"/></center>
						</form>
						</center>
			<?php } /* if( !$erfolgreichEingereicht && !$adminAccess && $fail ) { ?>
				<center>
					<p class = "w3-text-red"><?php echo $ausgabe; ?></p>
				</center>
			<?php } if( $erfolgreichEingereicht ) { ?>
				<center>
					<p class = "w3-text-green">Du hast die Frage erfolgreich eingereicht!</p>
				</center>
			<?php } */ ?>
	</body>
</html>