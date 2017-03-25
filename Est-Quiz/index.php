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
			<h3 class="w3-bar-item">Est Quiz-Project</h3>
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
				<h1>Startseite</h1>	
				<p>Est Quiz-Projekt von Benedikt Ross und Lukas Keller</p>
			</div>
			<hr />
			<?php if( !$access ) { ?>
			<center>
				<p>
					Herzlich Willkommen auf der Projekt Webseite!
				</p>
			</center>
			<br />
			<?php } else { ?>
			<center><h2 class="w3-opacity">Herzlich Willkommen, <?php echo $user['username']; ?>!</h2></center>
			<h2 class="w3-center w3-opacity">Themengebiete</h2>
			<div class="w3-content w3-section" style="max-width:500px">
				<img class="mySlides" src="images/topic_art_design.jpg" style="width:100%">
				<img class="mySlides" src="images/topic_bible.jpg" style="width:100%">
				<img class="mySlides" src="images/topic_eating_drinking.jpg" style="width:100%">
				<img class="mySlides" src="images/topic_freetime_sport.jpg" style="width:100%">
				<img class="mySlides" src="images/topic_geographie.jpg" style="width:100%">
				<img class="mySlides" src="images/topic_history.jpg" style="width:100%">
				<img class="mySlides" src="images/topic_movies.jpg" style="width:100%">
				<img class="mySlides" src="images/topic_music.jpg" style="width:100%">
				<img class="mySlides" src="images/topic_nature_animals.jpg" style="width:100%">
				<img class="mySlides" src="images/topic_politics.jpg" style="width:100%">
				<img class="mySlides" src="images/topic_science.jpg" style="width:100%">
				<img class="mySlides" src="images/topic_technology.jpg" style="width:100%">
				<img class="mySlides" src="images/topic_tv.jpg" style="width:100%">
			</div>
			<script>
				var myIndex = 0;
				carousel();

				function carousel() {
					var i;
					var x = document.getElementsByClassName("mySlides");
					for (i = 0; i < x.length; i++) {
						x[i].style.display = "none";  
					}
					myIndex++;
					if (myIndex > x.length) {myIndex = 1}    
						x[myIndex-1].style.display = "block";  
						setTimeout(carousel, 2000); // Change image every 2 seconds
					}
			</script>
			<?php } ?>
		</div>
	</body>
</html>