<?php

	include 'db.php';
	global $msg;
	
	// function per validazione email
	function is_valid_email($email) {
		// import variabile di connessione
		global $con;
		if (empty($email)) {
			echo "Email is required.";
			return false;
		}
		else {
			// check formattazioene email
			if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
			$msg = "Formato email non valido";
			return false;
			}
		}

		// check email già registrata
		$slQuery = "SELECT 1 FROM users WHERE email = '$email'";
		$selectResult = mysqli_query($con,$slQuery);
		if (mysqli_num_rows($selectResult)>0) {
			$msg = "Email già registrata";
			return false;
		}

		return true;
	}

	// function conferma password
	function is_valid_passwords($pass,$confirmpass) {
		if (empty($pass)) {
			echo "Password is required.";
			return false;
		}
		else if ($pass != $confirmpass) {
			// errore password sbagliate
			$msg = "Le password non coincidono";
			return false;
		}
		else {
			return true;
		}
	}

	// function inserimento utente
	function create_user($username, $password, $email, $trn_date) {
		global $con;
		$query = "INSERT INTO users (username, password, email, trn_date)
		VALUES ('$username', '".md5($password)."', '$email', '$trn_date')";

		$result = mysqli_query($con,$query);

		if($result) {
			return true;
		}
		else {
			return false;
		}
	}

	// esecuzione
	if (isset($_POST['username']) && isset($_POST['password'])){

		$username = $_POST['username'];
		$email = $_POST['email'];
		$password = $_POST['password'];
		$cpassword = $_POST['cpassword'];
		$trn_date = date("Y-m-d H:i:s");

		if (is_valid_email($email) && is_valid_passwords($password,$cpassword)) {
			if (create_user($username, $password, $email, $trn_date)) {
				echo 'Nuovo utente registrato con successo';
			}
			else {
				echo 'Errore durante la registrazione';
			}
		}
		else {
			echo $msg;
		}
	}
?>
