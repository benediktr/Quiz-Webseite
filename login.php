<?php
session_start(); // Zum starten der Session
$name = $_POST['name'];
 
if(!isset($name) OR empty($name)) {
   $name = "Gast";
}
 
// Session registrieren
$_SESSION['username'] = $name;
 
// Text ausgeben
echo "Hallo $name <br />
<a href=\"seite2.php\">Seite 2</a><br />
<a href=\"logout.php\">Logout</a>";
?>
// Quelle: http://www.php-einfach.de/php-tutorial/php-sessions/
