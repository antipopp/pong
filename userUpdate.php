<?php
	require_once 'db.php';
	$jsondata = file_get_contents('php://input');

	$player = json_decode($jsondata, true);

	$query = "UPDATE leaderboard SET win = ".$player['win'].", lost = ".$player['lost']." WHERE user ='".$player['user']."'";
	$result = mysqli_query($con, $query);

	if ($result) 
		echo 'Succesful update';
	else
		echo 'Failed update';
?>