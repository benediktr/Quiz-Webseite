<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
  
<?php
	require 'database.php'; 
	session_start();
	
	if(!isset($_SESSION['userid'])) {
		die('Bitte zuerst <a href="login.php">einloggen</a>');
	}
 
	$userid = $_SESSION['userid'];
	
	// Username rausfiltern
	
	$data = $db->prepare('SELECT username FROM user_accounts WHERE id = :id');
	$data->bindParam(':id', $_SESSION['userid']);
	$data->execute();
	
	$datas = $data->fetch(PDO::FETCH_ASSOC);
	
	$user = NULL;
	
	if( count($datas) > 0 ) {
		$user = $datas;
		$username = $user['username'];
	}	


?>
  
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" >
	<head>
		<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
		<title>Startseite</title>
		<link rel="stylesheet" type="text/css" href="css/format.css"/>
		<link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet"> 
	</head>
	<body>
		<div id = "background">
		<span id ="heading"><?php echo "Willkommen ".$username; ?></span>
		</div>
		<br />
		<br />
		<br />
		<br />
		<br />
		<div>
			<form action = "stats.php">
				<button type="submit" style = "position: absolute; margin-left: 15%; font-family: 'Montserrat', sans-serif; background-color: #4CAF50; border: none; cursor: pointer;">Profil anzeigen</button>
			</form>
			<form action = "game.php">
				<button type="submit" style = "position: absolute; margin-left: 47%; font-family: 'Montserrat', sans-serif; background-color: #4CAF50; border: none; cursor: pointer;">Quiz starten</button>
			</form>
			<form action = "question.php">
				<button type="submit" style = "position: absolute; margin-left: 75%; font-family: 'Montserrat', sans-serif; background-color: #4CAF50; border: none; cursor: pointer;">Fragen hinzufügen</button>
			</form>
		
		</div>
		
		<a href = "logout.php" style=" position:fixed; top:11px; right:10px;">Ausloggen</a>
		<br />
		<div class = "zentrieren"><h3 class = "titel">Vorschau Themengebiete</h3></div>
		<div>
		<ul>
			<input type="radio" name="slider" id="1" class="slider" checked>
			<input type="radio" name="slider" id="2" class="slider">
			<input type="radio" name="slider" id="3" class="slider">
			<input type="radio" name="slider" id="4" class="slider">
			<input type="radio" name="slider" id="5" class="slider">
			<input type="radio" name="slider" id="6" class="slider">
			<input type="radio" name="slider" id="7" class="slider">
			<input type="radio" name="slider" id="8" class="slider">
			<input type="radio" name="slider" id="9" class="slider">
			<input type="radio" name="slider" id="10" class="slider">
			<input type="radio" name="slider" id="11" class="slider">
			<input type="radio" name="slider" id="12" class="slider">
			<input type="radio" name="slider" id="13" class="slider">
			<li class="slide1">
			<img src="images/topic_art_design.jpg">
			<h2>Kunst</h2>
			</li>
			<li class="slide1">
			<img src="images/topic_bible.jpg">
			<h2>Bibel</h2>
			</li>
			<li class="slide1">
			<img src="images/topic_eating_drinking.jpg">
			<h2>Essen</h2>
			</li>
			<li class="slide1">
			<img src="images/topic_freetime_sport.jpg">
			<h2>Sport</h2>
			</li>
			<li class="slide1">
			<img src="images/topic_geographie.jpg">
			<h2>Kulturen</h2>
			</li>
			<li class="slide1">
			<img src="images/topic_history.jpg">
			<h2>Geschichte</h2>
			</li>
			<li class="slide1">
			<img src="images/topic_movies.jpg">
			<h2>Filme</h2>
			</li>
			<li class="slide1">
			<img src="images/topic_music.jpg">
			<h2>Musik</h2>
			</li>
			<li class="slide1">
			<img src="images/topic_nature_animals.jpg">
			<h2>Natur</h2>
			</li>
			<li class="slide1">
			<img src="images/topic_politics.jpg">
			<h2>Politik</h2>
			</li>
			<li class="slide1">
			<img src="images/topic_science.jpg">
			<h2>Wissenschaft</h2>
			</li>
			<li class="slide1">
			<img src="images/topic_technology.jpg">
			<h2>Technologien</h2>
			</li>
			<li class="slide1">
			<img src="images/topic_tv.jpg">
			<h2>Serien</h2>
			</li>
		</ul>
		</div>
		
		<div class="selector">
			<label for="1"></label>
			<label for="2"></label>
			<label for="3"></label>
			<label for="4"></label>
			<label for="5"></label>
			<label for="6"></label>
			<label for="7"></label>
			<label for="8"></label>
			<label for="9"></label>
			<label for="10"></label>
			<label for="11"></label>
			<label for="12"></label>
			<label for="13"></label>
		</div>
			
	</body>
</html>