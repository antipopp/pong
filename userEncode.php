<?php
	error_reporting(E_ALL); ini_set('display_errors', 1);
	require_once 'db.php';
	session_start();
	if (!isset($_SESSION['username'])) {
		$arr = array('user' => 'Anonimo', 'win' => 'N/A', 'lost' => 'N/A');
		echo json_encode($arr, JSON_PRETTY_PRINT);
	}
	else {
		$query = "SELECT * FROM leaderboard WHERE user = '" . $_SESSION['username'] . "'";
		$result = mysqli_query($con, $query);

		$rows = array();
		while($r = mysqli_fetch_assoc($result)) {
			$rows = $r;
		}
		echo json_encode($rows, JSON_PRETTY_PRINT);
	}
?>