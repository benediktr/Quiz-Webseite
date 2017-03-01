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
		<title>Bestenliste</title>
		<link rel="stylesheet" type="text/css" href="css/format.css"/>
		<link rel="stylesheet" type="text/css" href="css/format2.css"/>
		<link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet"> 
	</head>
	<body>
		<div id = "background">
			<span id ="heading">Bestenliste</span>
		</div>
<br /><br /> <br /><br />
		<div class = "zentrieren">
			<div id="bestenliste_spalte1">
				<p> Platz </p>
				<p> 1. </p>
				<p> 2. </p>
				<p> 3. </p>
				<p> 4. </p>
				<p> 5. </p>
				<p> 6. </p>
				<p> 7. </p>
				<p> 8. </p>
				<p> 9. </p>
				<p> 10. </p>
			</div>
			<div id="bestenliste_spalte2">
				<p> Name </p>
				<?php
					$abfrage="SELECT `userid`, `total_score` FROM `user_scores` ORDER BY total_score DESC LIMIT 10;";
		
					foreach( $db->query($abfrage) as $row){
						$id = $row["userid"];
						
						$idabfrage="SELECT `username` FROM `user_accounts` WHERE `id`='".$id."';";
						foreach( $db->query($idabfrage) as $row2){
							$nameuser = $row2["username"];
							if($username != $nameuser){
								echo "<p>".$nameuser."</p>";
							}
							else{
								echo "<p> Du </p>";
							}
						}
	
					}
				?>
			</div>
			<div id="bestenliste_spalte3">
				<p> Score </p>
				<?php
					$abfrage="SELECT `total_score` FROM `user_scores` ORDER BY total_score DESC LIMIT 10;";
					
					foreach( $db->query($abfrage) as $row){
						echo "<p>". $row["total_score"]."</p>";
	
					}
				?>
			</div>
		
		
			<a  id="bestenliste_zurueck" href="index2.php" > Zur&uuml;ck </a>
		</div>	
	</body>
</html>