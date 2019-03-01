<?php
	require_once 'db.php';

	$username = $_POST['username'];
	$password = $_POST['password'];

	$loginMessage = login($username, $password);
	if($loginMessage === null)
		echo true;
	else
		echo $loginMessage;

	function login($username, $password){   
		if ($username != null && $password != null){
			$check = authenticate($username, $password);
			if ($check) {
				session_start();
				$_SESSION['username'] = $username;
				return null;
			}
			else 		
				return 'Username o password non validi';
		} 
		else
			return 'Inserisci i dati';
	}

	function authenticate($username, $password) {
		global $con;

		$encPassword = md5($password);
		$query = "SELECT 1 FROM users WHERE username=? AND password=?";
		$loginstmt = $con->prepare($query);
		$loginstmt->bind_param('ss',$username,$encPassword);
		$loginstmt->execute();
		$loginstmt->bind_result($result);
		$loginstmt->fetch();
		if ($result===1) {
			$loginstmt->close();
			return true;
		}
		else {
			$loginstmt->close();
			return false;
		}
	}

?>