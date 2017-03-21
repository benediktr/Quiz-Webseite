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
	
/*	$statement2 = $db->prepare("SELECT `userid`, `total_score` FROM `user_scores` ORDER BY total_score DESC LIMIT 10");
	$result2 = $statement2->execute(array('id' => $userid));
	$user  = $statement2->fetch();*/
	
	$username = $user['username'];
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
				<li>
					<a href="logout.php">Ausloggen</a>
				</li>
			</ul>
		</nav>
		<h1 class = "titel">Rangliste</h1>
		<center>
			<table>
				<thead>
					<tr>
						<th>Platz</th>
						<th>Username</th>
						<th>Score</th>
					</tr>
				</thead>
				<tbody>
					<?php 
						$abfrage="SELECT `id`, `total_score` FROM `user` ORDER BY total_score DESC LIMIT 10;";
						$platz = 1;
		
						foreach( $db->query($abfrage) as $row){
						$id = $row["id"];
					
						$idabfrage="SELECT `username`, `total_score` FROM `user` WHERE `id`='".$id."';";
						foreach( $db->query($idabfrage) as $row2){
							echo "<tr>";
							$nameuser = "<td>".$row2["username"]."</td>";
							$score_total = "<td>".$row2['total_score']."</td>";
								if($username != $nameuser){
								echo "<td>".$platz."</td>";
								echo $nameuser;
								echo $score_total;
							}
							else{
								echo "<td>".$platz."/td>";
								echo "<td>Du</td>";
								echo "<td>".$score_total."</td>";
							}
							$platz += 1;
							echo "</tr>";
						}
	
					}
					?>
				</tbody>
			</table>
		</center>
	</body>
</html>