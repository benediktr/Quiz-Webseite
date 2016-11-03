<?php
function connect_to_db($db_host, $db_name, $db_user, $db_pass) {
	$db = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_pass);
	if($db) {
		return $db;
	}
	else {
		echo "Connection failed!";
	}
}
?>
