<?php
session_start(); // Ganz wichtig
 
if(!isset($_SESSION['username'])) {
   die("Bitte erst einloggen"); // Mit die beenden wir den weiteren Scriptablauf   
}
 
// In $name den Wert der Session speichern
$name = $_SESSION['username'];
 
// Text ausgeben
echo "Du heißt immer noch: $name
<a href=\"logout.php\">Logout</a>";
?>
<!-- Quelle: http://www.php-einfach.de/php-tutorial/php-sessions/ -->
