<?php
	error_reporting(E_ALL); ini_set('display_errors', 1);
	session_start();
	if (!isset($_SESSION['username'])) {
		$string = "Utente anonimo";
		echo json_encode($string);
	}
	else 
		echo json_encode($_SESSION['username']);
?>