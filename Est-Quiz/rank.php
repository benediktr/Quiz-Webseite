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
				<h1>Rangliste</h1>
				<p>Est Quiz-Projekt von Benedikt Ross und Lukas Keller</p>
			</div>
			<hr />
			<?php if( !$access ) { ?>
				<center><p>Bitte zuerst <a href = "login.php">Einloggen</a>!</p></center>
			<?php } else { ?>
				<center>
					<table class="w3-table-all w3-hoverable" style = "width: 90%">
						<thead>
							<tr class="w3-light-grey">
								<th>Platz</th>
								<th>Username</th>
								<th>Punkte</th>
							</tr>
							<?php 
								$abfrage="SELECT `id`, `total_score` FROM `user` ORDER BY total_score DESC LIMIT 10;";
								$platz = 1;
		
								foreach( $db->query($abfrage) as $row) {
									$id = $row["id"];
					
									$idabfrage="SELECT `username`, `total_score`, `status`, `id` FROM `user` WHERE `id`='".$id."';";
									foreach( $db->query($idabfrage) as $row2){
										echo "<tr>";
										if( strcmp($row2['status'], "Admin") == 0 ) {
											if( $_SESSION['userid'] == $row2['id'] ) {
												$nameuser = "<td><span class = 'w3-text-green'>".$row2["username"]."</span> [<span class = 'w3-text-red'>Admin</span>]</td>";
											} else {
												$nameuser = "<td>".$row2["username"]." [<span class = 'w3-text-red'>Admin</span>]</td>";
											}
										} else {
											if( $_SESSION['userid'] == $row2['id'] ) {
												$nameuser = "<td><span class = 'w3-text-green'>".$row2["username"]."</span></td>";
											} else {
												$nameuser = "<td>".$row2["username"]." [<span class = 'w3-text-blue'>User</span>]</td>";
											}
										}
										$score_total = "<td>".$row2['total_score']."</td>";
										if($username != $nameuser){
											if( $platz == 1 ) {
												echo "<td><span class='w3-badge w3-green'>$platz</span></td>";
											}
											if( $platz == 2 ) {
												echo "<td><span class='w3-badge w3-orange'>$platz</span></td>";
											}
											if( $platz == 3 ) {
												echo "<td><span class='w3-badge w3-red'>$platz</span></td>";
											}
											if( $platz > 3 ) {
												echo "<td><span class='w3-badge w3-white'>".$platz."</span></td>";
											}
											echo $nameuser;
											echo $score_total;
										}
										$platz += 1;
										echo "</tr>";
									}
	
								}
							?>
						</thead>
					</table>
				</center>
			<?php } ?>
		</div>
	</body>
</html>