<?php
try {
	$servername = "localhost";
	$username = "root";
	$password = "";
	$db = new PDO("mysql:host=$servername;dbname=pollmaker", $username, $password);
} catch (PDOException $ex) {
	die($ex->getMessage());
}
?>