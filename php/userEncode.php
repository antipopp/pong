<?php
	require_once 'db.php';
	session_start();
	if (!isset($_SESSION['username'])) {
		$arr = array('user' => 'Ospite', 'score' => 0);
		echo json_encode($arr, JSON_PRETTY_PRINT);
	}
	else {
		$query = "SELECT username, max(score) as score
				FROM scores 
				WHERE username = '" . $_SESSION['username'] . "'";
		$result = $con->query($query);
		// $result->fetch();
		// $result = mysqli_query($con, $query);

		$row = $result->fetch_array(MYSQLI_ASSOC);
		$playerData = array(
			'user' => $row['username'],
			'score' => $row['score'] 
		);

		// while($r = $result->fetch_array(MYSQLI_ASSOC)) {
		// 	$rows = array(
		// 		'user' => $r['username'],
		// 		'score' => $r['score']
		// 	);
		// }
		$con->close();
		echo json_encode($playerData, JSON_NUMERIC_CHECK);
	}
?>