<?php
	
	$server = "localhost";
	$username = "root";
	$password = "";
	$dbname = "pong";

	$con = mysqli_connect($server, $username, $password, $dbname);
	if (mysqli_connect_errno()) {
	  echo "Errore di connessione: " . mysqli_connect_error();
	}
	
?>