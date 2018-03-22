<?php
	require_once 'db.php';

	$username = $_POST['username'];
	$password = $_POST['password'];

	$loginMessage = login($username, $password);
	if($loginMessage === null)
		header('location: ../index.php');
	else
		header('location: loginForm.php?loginMessage=' . $loginMessage );

	function login($username, $password){   
		if ($username != null && $password != null){
			$check = authenticate($username, $password);
			if ($check > 0) {
				session_start();
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

		$query = "SELECT 1 FROM users WHERE username='" . $username . "' AND password='" . md5($password) . "'";
		$result = mysqli_query($con,$query);

		if (mysqli_num_rows($result) === 0)
			return -1;
		else
			return $result;
	}

?>