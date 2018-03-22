<?php
	require_once 'db.php';
	session_start();
	if (!isset($_SESSION['username'])) {
		$arr = array('user' => 'Ospite', 'win' => null, 'lost' => null, 'ratio' => null);
		echo json_encode($arr, JSON_PRETTY_PRINT);
	}
	else {
		$query = "SELECT * FROM leaderboard WHERE user = '" . $_SESSION['username'] . "'";
		$result = mysqli_query($con, $query);

		$rows = array();
		while($r = mysqli_fetch_assoc($result)) {
			$rows = array(
				'user' => $r['user'],
				'win' => $r['win'],
      			'lost' => $r['lost'],
      			'ratio' => $r['ratio']
			);
		}

		echo json_encode($rows, JSON_NUMERIC_CHECK);
	}
?>