<?php
	
	$server = "localhost";
	$username = "root";
	$password = "root";
	$dbname = "pong";

	$con = new mysqli($server, $username, $password, $dbname);
	if ($con->connect_error) {
		die("Errore di connessione: " . $con->connect_error);
	}
?>