<?php

	require_once 'db.php';
	$username = $_POST['username'];
	$email = $_POST['email'];
	$password = $_POST['password'];
	$cpassword = $_POST['cpassword'];
	$trn_date = date("Y-m-d H:i:s");

	$errorMessage = registration($username, $password, $cpassword, $email, $trn_date);
	if($errorMessage === null)
		header('location: login.php?success=true');
	else
		header('location: registration.php?errorMessage=' . $errorMessage );
	
	// function per validazione email
	function is_valid_email($email) {
		// variabile di connessione al db
		global $con;
		if (empty($email)) {
			return "Email obbligatoria";
		}
		else {
			// check formattazioene email
			if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
				return "Formato email non valido";
			}
		}

		// check email già registrata
		$slQuery = "SELECT 1 FROM users WHERE email = '$email'";
		$selectResult = mysqli_query($con,$slQuery);
		if (mysqli_num_rows($selectResult)>0) {
			return "Email già registrata";
		}

		return null;
	}

	// function conferma password
	function is_valid_passwords($pass,$confirmpass) {
		if (empty($pass)) {
			return "La password è obbligatoria";
		}
		else if ($pass != $confirmpass) {
			return "Le password non coincidono";
		}
		else {
			return null;
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
	function registration($username, $password, $cpassword, $email, $trn_date) {
		if ($username != null && $password != null){
			if (is_valid_email($email) === null) {
				if (is_valid_passwords($password,$cpassword) === null) {
					if (create_user($username, $password, $email, $trn_date)) {
						return null;
					}
					else {
						return 'Errore durante la registrazione';
					}
				}
				else {
					return is_valid_passwords($password,$cpassword);
				}
			}
			else {
				return is_valid_email($email);
			}
		}
		else {
			return "Tutti i campi sono obbligatori";
		}
	}
?>
