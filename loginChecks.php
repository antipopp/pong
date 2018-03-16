<?php
	require_once 'db.php';

	$userneme = $_POST['username'];
	$password = $_POST['password'];

	$loginMessage = login($username, $password);
	if($loginMessage === null)
		header('location: index.php');
	else
		header('location: login.php?loginMessage=' . $loginMessage );

	function login($username, $password){   
		if ($username != null && $password != null){
			$userId = authenticate($username, $password);
			if ($userId > 0) {
				session_start();
				$_SESSION['userId'] = $userId;
				$_SESSION['username'] = $username;
				return null;
			}
		} 
		else
			return 'Inserisci i dati';

		return 'Username o password non validi';
	}

	function authenticate($username, $password) {
		global $con;

		mysql_real_escape_string($username);
		mysql_real_escape_string($password);

		$query = "SELECT id FROM users WHERE username='" . $username . "' AND password='" . md5($password) . "'";
		$result = mysqli_query($con,$query);

		if (!$result)
			return -1;
		else
			return mysqli_query($con,$query);
	}

?>