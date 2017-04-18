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
	
	$statement2 = $db->prepare("SELECT * FROM user WHERE id = (SELECT MAX(id) FROM user)");
	$result2 = $statement2->execute(array('id' => $id));
	$maxID  = $statement2->fetch();
	
	$usersRegistered = $maxID['id'];
	
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
				<h1>Startseite</h1>	
				<p>Est Quiz-Projekt von Benedikt Ross und Lukas Keller</p>
			</div>
			<hr />
			<?php if( !$access ) { ?>
			
			<p style="text-align: center;">
				Herzlich Willkommen auf der Projekt Webseite! <br />
				Du möchtest dein Wissen auf die Probe stellen und dich gleizeitig mit anderen messen? Dann bist du <b>hier</b> genau richtig! <br />
				Es haben sich bereits <b> <?php echo $usersRegistered; ?></b> User registriert!<br />
			</p>
			
			<?php } else { ?>
			<div style="text-align: center;">
				<h2 class="w3-opacity">Herzlich Willkommen, <?php echo $user['username']; ?>!</h2>
			</div>
			<h2 class="w3-center w3-opacity">Themengebiete</h2>

			<div class="w3-content w3-display-container" style="margin-bottom: 5%;">

				<div class="w3-display-container mySlides">
				  <img src="images/topic_art_design.jpg" alt="kunst_design" style="width:100%" />
				  <div class="w3-display-bottomleft w3-large w3-container w3-padding-16 w3-black">
					Kunst
				  </div>
				</div>

				<div class="w3-display-container mySlides">
				  <img src="images/topic_bible.jpg" alt="bibel" style="width:100%" />
				  <div class="w3-display-bottomright w3-large w3-container w3-padding-16 w3-black">
					Bibel
				  </div>
				</div>

				<div class="w3-display-container mySlides">
				  <img src="images/topic_eating_drinking.jpg" alt="essen_drinken" style="width:100%" />
				  <div class="w3-display-topleft w3-large w3-container w3-padding-16 w3-black">
					Essen
				  </div>
				</div>

				<div class="w3-display-container mySlides">
				  <img src="images/topic_freetime_sport.jpg" alt="sport" style="width:100%" />
				  <div class="w3-display-topright w3-large w3-container w3-padding-16 w3-black">
					Sport
				  </div>
				</div>

				<div class="w3-display-container mySlides">
				  <img src="images/topic_geographie.jpg" alt="kulturen" style="width:100%" />
				  <div class="w3-display-middle w3-large w3-container w3-padding-16 w3-black">
					Kulturen
				  </div>
				</div>
				
				<div class="w3-display-container mySlides">
				  <img src="images/topic_history.jpg" alt="Geschichte" style="width:100%" />
				  <div class="w3-display-middle w3-large w3-container w3-padding-16 w3-black">
					Geschichte
				  </div>
				</div>
				
				<div class="w3-display-container mySlides">
				  <img src="images/topic_movies.jpg" alt="filme" style="width:100%" />
				  <div class="w3-display-middle w3-large w3-container w3-padding-16 w3-black">
					Filme
				  </div>
				</div>
				
				<div class="w3-display-container mySlides">
				  <img src="images/topic_music.jpg" alt="musik" style="width:100%" />
				  <div class="w3-display-middle w3-large w3-container w3-padding-16 w3-black">
					Musik
				  </div>
				</div>
				
				<div class="w3-display-container mySlides">
				  <img src="images/topic_nature_animals.jpg" alt="natur_tiere" style="width:100%" />
				  <div class="w3-display-middle w3-large w3-container w3-padding-16 w3-black">
					Natur
				  </div>
				</div>
				
				<div class="w3-display-container mySlides">
				  <img src="images/topic_politics.jpg" alt="politik" style="width:100%" />
				  <div class="w3-display-middle w3-large w3-container w3-padding-16 w3-black">
					Politik
				  </div>
				</div>
				
				<div class="w3-display-container mySlides">
				  <img src="images/topic_science.jpg" alt="wissenschaft" style="width:100%" />
				  <div class="w3-display-middle w3-large w3-container w3-padding-16 w3-black">
					Wissenschaft
				  </div>
				</div>
				
				<div class="w3-display-container mySlides">
				  <img src="images/topic_technology.jpg" alt="technologie" style="width:100%" />
				  <div class="w3-display-middle w3-large w3-container w3-padding-16 w3-black">
					Technologien
				  </div>
				</div>
				
				<div class="w3-display-container mySlides">
				  <img src="images/topic_tv.jpg" alt="serien" style="width:100%" />
				  <div class="w3-display-middle w3-large w3-container w3-padding-16 w3-black">
					Serien
				  </div>
				</div>

				<button class="w3-button w3-display-left w3-black" onclick="plusDivs(-1)">&#10094;</button>
				<button class="w3-button w3-display-right w3-black" onclick="plusDivs(1)">&#10095;</button>

			</div>
			
			<script type="text/javascript">
				var slideIndex = 1;
				showDivs(slideIndex);

				function plusDivs(n) {
				  showDivs(slideIndex += n);
				}

				function showDivs(n) {
				  var i;
				  var x = document.getElementsByClassName("mySlides");
				  if (n > x.length) {slideIndex = 1}    
				  if (n < 1) {slideIndex = x.length}
				  for (i = 0; i < x.length; i++) {
					 x[i].style.display = "none";  
				  }
				  x[slideIndex-1].style.display = "block";  
				}
			</script>
			<?php } ?>
		</div>
	</body>
</html>