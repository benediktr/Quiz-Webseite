<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
  
<?php
	require 'php/database.php'; 
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
		<title>EST Quiz-Projekt</title>
		<link rel="stylesheet" type="text/css" href="css/format.css"/>
		<link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet"> 
	</head>
	<body class = "background">
		<h1 class = "titel">Rangliste</h1>
		<?php
			$abfrage="SELECT `userid`, `total_score` FROM `user_scores` ORDER BY total_score DESC LIMIT 10;";
			foreach( $db->query($abfrage) as $row) {
				$id = $row["userid"];
						
				$idabfrage="SELECT `username` FROM `user_accounts` WHERE `id`='".$id."';";
				foreach( $db->query($idabfrage) as $row2) {
					$nameuser = $row2["username"];
					if($username != $nameuser) {
						// Username
						echo "<p>".$nameuser."</p>";
					}
					else {
						echo "<p>Du </p>";
					}
				}
	
			}
		?>
		<?php
			$abfrage="SELECT `total_score` FROM `user_scores` ORDER BY total_score DESC LIMIT 10;";
					
			foreach( $db->query($abfrage) as $row) {
				// Punktezahl
				echo "<p>". $row["total_score"]."</p>";
			}
		?>	
	</body>
</html>