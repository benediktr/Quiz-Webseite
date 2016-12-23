<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
  
  <html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" >
	<head>
		<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
		<title>Logout</title>
		<link rel="stylesheet" type="text/css" href="css/format.css"/>
		<link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet"> 
	</head>
	<body>
		<div id = "background">
		<span id ="heading">Logout</span>
		</div>
		<br />
		<br />
		<br />
		<br />
		<br />
		<?php
			session_start();
			session_destroy();
 
		echo '<p id = "start">
		Sie werden nun ausgeloggt
		</p>';
		?>
		<a href = "index.html">Startseite</a>
		<br />
	</body>
</html>