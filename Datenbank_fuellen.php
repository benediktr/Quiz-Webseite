<?php
	$pdo = new PDO('mysql:host=localhost;dbname=animals', 'root', '');
	
	$sql = "INSERT INTO `easy`(`id`, `questions`, `r_answer_1`, `f_answer_2`, `f_answer_3`, `f_answer_4`) VALUES (1, `Was ist ein Haustier?`, `Hase`, `Elephant`, `Krokodil`, `Leopard`)";
?>
