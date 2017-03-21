<?php session_start(); ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
 
<?php
	require 'php/functions.php'; 
	
	if(!isset($_SESSION['userid'])) {
		die('Bitte zuerst <a href="login.php">einloggen</a>');
	}
	
	$plaetze = 0;
	
	$userid = $_SESSION['userid'];
	$statement = $db->prepare("SELECT * FROM user WHERE id = :id");
	$result = $statement->execute(array('id' => $userid));
	$user  = $statement->fetch();
	
	$status = $user['status'];

	if( strcmp($status, "Admin") != 0 ) {
		die('Du hast hier keine Berechtigung!');
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
					<a href="addquestion.php">Frage hinzuf&uuml;gen</a>
				</li>
				<li>
					<a href="play.php">Spiel Starten</a>
				</li>
				<?php if( strcmp($status, "Admin") == 0 ) { ?>
				<li>
					<a href="admin.php">Adminpanel</a>
				</li>
				<?php } ?>
				<li>
					<a href="logout.php">Ausloggen</a>
				</li>
			</ul>
		</nav>
		<h1 class = "titel">Adminpanel</h1>

	</body>
</html>