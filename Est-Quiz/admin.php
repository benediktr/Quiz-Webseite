<?php 
	session_start();
	require('php/functions.php');
	
	if( isset($_SESSION['userid']) ) {
		$access = true;
	} else {
		$access = false;
	}
	
	$editing = false;
	
	$id = $_SESSION['userid'];
	$statement = $db->prepare("SELECT * FROM user WHERE id = :id");
	$result = $statement->execute(array('id' => $id));
	$user  = $statement->fetch();
	
	if( $_POST['userverwaltung'] ) {
		$userverwaltung = true;
	} else {
		$userverwaltung = false;
	}
	
	
	if( $_POST['change'] ) {
		if( isset($_POST['loeschen']) ) {
			$statement = $db->prepare("DELETE FROM user WHERE id = ?");
			$statement->execute(array($_POST['loeschen']));
		}
		if( isset($_POST['degrade']) ) {
			$statement = $db->prepare('UPDATE user SET status = "User" WHERE id = ?');
			$statement->execute(array($_POST['degrade']));
		}
		if( isset($_POST['promote']) ) {
			$statement = $db->prepare('UPDATE user SET status = "Admin" WHERE id = ?');
			$statement->execute(array($_POST['promote']));
		}
	}
	
	if( $_POST['addquestion'] ) {
		if( isset($_POST['delete']) ) {
			$statement = $db->prepare("DELETE FROM submit WHERE id = ?");
			$statement->execute(array($_POST['delete']));
			header('Location: admin.php'); 
			exit;
		}
		if( isset($_POST['add']) ) {
			$statement = $db->prepare("SELECT * FROM submit WHERE id = :id");
			$result = $statement->execute(array('id' => $_POST['add']));
			$row  = $statement->fetch();
	
			$statement = $db->prepare("INSERT INTO ".$row['topic']." (question, right_answer, wrong_answer_1, wrong_answer_2, wrong_answer_3) VALUES (:question, :right_answer, :wrong_answer_1, :wrong_answer_2, :wrong_answer_3)");
			$result = $statement->execute(array('question' => $row['question'], 'right_answer' => $row['right_answer'], 'wrong_answer_1' => $row['wrong_answer_1'], 'wrong_answer_2' => $row['wrong_answer_2'], 'wrong_answer_3' => $row['wrong_answer_3']));
			
			$statement = $db->prepare("DELETE FROM submit WHERE id = ?");
			$statement->execute(array($_POST['add']));
			
			$id = $row['eingereichteid'];
			
			$statement = $db->prepare("SELECT * FROM user WHERE id = :id");
			$result = $statement->execute(array('id' => $id));
			$useraccount  = $statement->fetch();
			
			$counter = 1 + $useraccount['counter_add_questions'];
			
			$sql = "UPDATE user SET counter_add_questions='$counter' WHERE id='$id'";
			$stmt = $db->prepare($sql);
			$stmt->execute();
			
			header('Location: admin.php'); 
			exit;
		}
		if( isset($_POST['edit']) ) {
			$questionID = $_POST['edit'];
			$_SESSION['editid'] = $_POST['edit'];
			
			$statement = $db->prepare("SELECT * FROM submit WHERE id = :id");
			$result = $statement->execute(array('id' => $questionID));
			$submit  = $statement->fetch();
			
			$topic = $submit['topic'];
			$question = $submit['question'];
			$right_answer = $submit['right_answer'];
			$wrong_answer_1 = $submit['wrong_answer_1'];
			$wrong_answer_2 = $submit['wrong_answer_2'];
			$wrong_answer_3 = $submit['wrong_answer_3'];
			
			$editing = true;
		}
	}
	
	if( $_POST['einfuegen'] ) {	
				$_SESSION['topic'] = $_POST['topics'];
				$_SESSION['question'] = $_POST['question'];
				$_SESSION['right_answer'] = $_POST['right_answer'];
				$_SESSION['wrong_answer_1'] = $_POST['wrong_answer_1'];
				$_SESSION['wrong_answer_2'] = $_POST['wrong_answer_2'];
				$_SESSION['wrong_answer_3'] = $_POST['wrong_answer_3'];
					
				$statement = $db->prepare("INSERT INTO ".$_SESSION['topic']." (question, right_answer, wrong_answer_1, wrong_answer_2, wrong_answer_3) VALUES (:question, :right_answer, :wrong_answer_1, :wrong_answer_2, :wrong_answer_3)");
				$result = $statement->execute(array('question' => $_SESSION['question'], 'right_answer' => $_SESSION['right_answer'], 'wrong_answer_1' => $_SESSION['wrong_answer_1'], 'wrong_answer_2' => $_SESSION['wrong_answer_2'], 'wrong_answer_3' => $_SESSION['wrong_answer_3']));
				
				if( $result ) {
					$edited = true;
				} else {
					$edited = false;
				}
					
				
				$_SESSION['topic'] = null;
				$_SESSION['question'] = null;
				$_SESSION['right_answer'] = null;
				$_SESSION['wrong_answer_1'] = null;
				$_SESSION['wrong_answer_2'] = null;
				$_SESSION['wrong_answer_3'] = null;
					
				
				$statement = $db->prepare("SELECT * FROM submit WHERE id = :id");
				$result = $statement->execute(array('id' => $_SESSION['editid']));
				$row  = $statement->fetch();
					
				$id = $row['eingereichteid'];
					
				$statement = $db->prepare("SELECT * FROM user WHERE id = :id");
				$result = $statement->execute(array('id' => $id));
				$useraccount  = $statement->fetch();
					
				$counter = 1 + $useraccount['counter_add_questions'];
					
				$sql = "UPDATE user SET counter_add_questions='$counter' WHERE id='$id'";
				$stmt = $db->prepare($sql);
				$stmt->execute();
				
				$statement = $db->prepare("DELETE FROM submit WHERE id = ?");
				$statement->execute(array($_SESSION['editid']));
			}
	
	
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
				<h1>Adminpanel</h1>
				<p>Est Quiz-Projekt von Benedikt Ross und Lukas Keller</p>
			</div>
			<hr />
			<?php if( !$access ) { ?>
				<p style="text-align:center">Bitte zuerst <a href = "login.php">Einloggen</a>!</p>
				<?php } if( strcmp($user['status'], "Admin") == 0 ) { ?>
					<?php if( !isset($_POST['userverwaltung']) && !isset($_POST['fragen']) && !$editing ) { ?>
					<div style="text-align:center">
					<form action = "?admin=1" method = "post">
						<fieldset style="border-style:none;">
							<input class = "w3-button w3-white w3-border w3-border-red w3-round-large" type = "submit" name = "userverwaltung" value = "Userverwaltung anzeigen"/>
							<hr />
							<input class = "w3-button w3-white w3-border w3-border-red w3-round-large" type = "submit" name = "fragen" value = "Eingereichte Fragen anzeigen"/>
						</fieldset>
					</form>
					<?php } if( $userverwaltung ) { ?>
					<h2 style="text-align:center"class="w3-opacity">Userverwaltung</h2>
					<form action = "?change=1" method = "POST">
						<div class="w3-row-padding">
							<div class="w3-third">
								<label class="w3-label w3-text-green">Account löschen</label>
								<input class="w3-input w3-border" type="text" placeholder="ID" name = "loeschen">
							</div>
							<div class="w3-third">
								<label class="w3-label w3-text-green">Account degradieren</label>
								<input class="w3-input w3-border" type="text" placeholder="ID" name = "degrade">
							</div>
							<div class="w3-third">
								<label class="w3-label w3-text-green">Account befördern</label>
								<input class="w3-input w3-border" type="text" placeholder="ID" name = "promote">
							</div>
						</div>
						<br />
						<center><input class = "w3-button w3-white w3-border w3-border-red w3-round-large" type = "submit" name = "change" value = "Speichern"/></center>
						<br />
						<table class="w3-table-all w3-hoverable">
								<thead>
									<tr class="w3-light-grey">
										<th>User ID</th>
										<th>Username</th>
										<th>Status</th>
									</tr>
									<?php 
										$idabfrage="SELECT * FROM `user` ORDER BY id";
										foreach( $db->query($idabfrage) as $row){
											echo "<tr>";
											echo "<td>".$row['id']."</td>";
											echo "<td>".$row["username"]."</td>";
											echo "<td>".$row['status']."</td>";
											echo "</tr>";
										}
									?>
								</thead>
							</table>
						</form>
					</div>
					<?php }			
					if( $_POST['fragen'] ) {		
					?>
					<h2 style="text-align:center" class="w3-opacity">Eingereichte Fragen verwalten</h2>
					<form action = "?question=1" method = "POST">
						<div class="w3-row-padding">
							<div class="w3-third">
								<label class="w3-label w3-text-green">Eingereichte Frage löschen</label>
								<input class="w3-input w3-border" type="text" placeholder="ID" name = "delete">
							</div>
							<div class="w3-third">
								<label class="w3-label w3-text-green">Eingereichte Frage in die Datenbank einfügen</label>
								<input class="w3-input w3-border" type="text" placeholder="ID" name = "add">
							</div>
							<div class="w3-third">
								<label class="w3-label w3-text-green">Eingereichte Frage editieren und hinzufügen</label>
								<input class="w3-input w3-border" type="text" placeholder="ID" name = "edit">
							</div>
						</div>
						<br />
						<center><input class = "w3-button w3-white w3-border w3-border-red w3-round-large" type = "submit" name = "addquestion" value = "Speichern"/></center>
						<br />
						</div>
						<?php 
							$question = "SELECT * FROM `submit` ORDER BY id";
							foreach( $db->query($question) as $row) {
						?>
							<div style="text-align:center">
							<label class = "w3-label w3-text-green">ID</label><br />
							<?php echo $row['id'] ?> <br /><br />
							<label class = "w3-label w3-text-green">Thema</label><br />
							<?php echo $row['topic'] ?> <br /><br />
							<label class = "w3-label w3-text-green">Frage</label><br />
							<?php echo $row['question'] ?> <br /><br />
							<label class = "w3-label w3-text-green">Richtige Antwort</label><br />
							<?php echo $row['right_answer'] ?> <br /><br />
							<label class = "w3-label w3-text-green">1. Falsche Antwort</label><br />
							<?php echo $row['wrong_answer_1'] ?> <br /><br />
							<label class = "w3-label w3-text-green">2. Falsche Antwort</label><br />
							<?php echo $row['wrong_answer_2'] ?> <br /><br />
							<label class = "w3-label w3-text-green">3. Falsche Antwort</label><br />
							<?php echo $row['wrong_answer_3'] ?> <br /><br />
							<hr />
							</div>
							<?php } ?>
						</form>
					<?php }

						} 
						else { 
					
						?>
					
					<p style="text-align:center" class = "w3-text-red">Du hast hier keine Berechtigung!</p>
					</center>
				<?php } if( $editing ) { ?>
					
					<form action = "?addquestion=1" method= "post">
						<label class="w3-label w3-text-green">Themenauswahl</label>
						<select name = "topics" class="w3-select">
							<option value = "art" <?php 
								if( strcmp($topic, "art") == 0 ) {
									echo "SELECTED";
								}
							?>>Kunst</option>
							<option value = "bible" <?php 
								if( strcmp($topic, "bible") == 0 ) {
									echo "SELECTED";
								}
							?>>Bibel</option>
							<option value = "eating" <?php 
								if( strcmp($topic, "eating") == 0 ) {
									echo "SELECTED";
								}
							?>>Essen</option>
							<option value = "freetime" <?php
								if( strcmp($topic, "freetime") == 0 ) {
									echo "SELECTED";
								}
							?>>Sport</option>
							<option value = "geography" <?php 
								if( strcmp($topic, "geography") == 0 ) {
									echo "SELECTED";
								}
							?>>Kulturen</option>
							<option value = "history" <?php 
								if( strcmp($topic, "history") == 0 ) {
									echo "SELECTED";
								}
							?>>Geschichte</option>
							<option value = "movies" <?php 
								if( strcmp($topic, "movies") == 0 ) {
									echo "SELECTED";
								}
							?>>Filme</option>
							<option value = "music" <?php 
								if( strcmp($topic, "music") == 0 ) {
									echo "SELECTED";
								}
							?>>music</option>
							<option value = "nature" <?php 
								if( strcmp($topic, "nature") == 0 ) {
									echo "SELECTED";
								}
							?>>Natur</option>
							<option value = "politics" <?php 
								if( strcmp($topic, "politics") == 0 ) {
									echo "SELECTED";
								}
							?>>Politik</option>
							<option value = "science" <?php 
								if( strcmp($topic, "science") == 0 ) {
									echo "SELECTED";
								}
							?>>Wissenschaft</option>
							<option value = "technology" <?php 
							if( strcmp($topic, "technology") == 0 ) {
									echo "SELECTED";
								}
								?>>Technologien</option>
							<option value = "series" <?php
								if( strcmp($topic, "series") == 0 ) {
									echo "SELECTED";
								}
							?>>Serien</option>
						</select>
						<br /><br />
						<label class = "w3-label w3-text-green">Quiz Frage</label>
						<input type = "name" class = "w3-input w3-border" size = "60" maxlength = "100" name = "question"
							<?php 
								echo "value='".$question."'";	
							?> />
						</input><br /><br />
						<label class = "w3-label w3-text-green">Richtige Antwort</label>
						<input type = "name" class = "w3-input w3-border" size = "30" maxlength = "30" name = "right_answer" 					
						<?php 
							echo "value='".$right_answer."'";	
						?> >
						</input><br>
						<label class = "w3-label w3-text-green">1. Falsche Antwort</label>
						<input type = "name" class = "w3-input w3-border" size = "30" maxlength = "30" name = "wrong_answer_1" 
						<?php
							echo "value='".$wrong_answer_1."'";	
						?>>
						</input><br>
						<label class = "w3-label w3-text-green">2. Falsche Antwort</label>
						<input type = "name" class = "w3-input w3-border" size = "30" maxlength = "30" name = "wrong_answer_2" 
						<?php 
							echo "value='".$wrong_answer_2."'";	
						?>>
						</input><br>
						<label class = "w3-label w3-text-green">3. Falsche Antwort</label>
						<input type = "name" class = "w3-input w3-border" size = "30" maxlength = "30" name = "wrong_answer_3" 
						<?php 
							echo "value='".$wrong_answer_3."'";					
						?>>
						</input>
						<br>
						<center>
							<input class = "w3-button w3-white w3-border w3-border-red w3-round-large" type = "submit" value ="Einfügen" name = "einfuegen"/><br />
							</form>
						</center>
				<?php } if( $edited ) { ?>
				
					<p style="text-align:center" class = "w3-text-green">Du hast die Frage erfolgreich hinzugef&uuml;gt!</p>
			
				<?php } ?>
			</div>
		</div>
	</body>
</html>