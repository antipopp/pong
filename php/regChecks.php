<?php
	require_once 'db.php';
	$username = $_POST['username'];
	$email = $_POST['email'];
	$password = $_POST['password'];
	$cpassword = $_POST['cpassword'];
	$trn_date = date("Y-m-d H:i:s");

	$regMessage = registration($username, $password, $cpassword, $email, $trn_date);
	if($regMessage === null)
		echo "success";
	else
		echo $regMessage;
	
	// function per validazione email
	function isValidEmail($email) {
		global $con;
		if (empty($email)) {
			return "Email obbligatoria";
		}
		else {
			// formattazioene email
			if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
				return "Formato email non valido";
			}
		}

		// check email già registrata
		$query = "SELECT 1 FROM users WHERE email=?";
		$existingEmail = $con->prepare($query);
		$existingEmail->bind_param('s',$email);
		$existingEmail->execute();
		$existingEmail->bind_result($result);
		$existingEmail->fetch();

		if ($result===1) {
			$existingEmail->close();
			return "Email già registrata";
		}
		else {
			$existingEmail->close();
			return null;
		}
	}

	// function conferma password
	function isValidPassword($pass,$confirmpass) {
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

	// function username valido
	function isValidUsername($username) {
		global $con;
		if (empty($username))
			return "Username obbligatorio";
		else if ($username === 'Ospite' || $username === 'ospite')
			return "Username non valido";

		// check username già registrato
		$query = "SELECT 1 FROM users WHERE username = ?";
		$existingUser = $con->prepare($query);
		$existingUser->bind_param('s',$username);
		$existingUser->execute();
		$existingUser->bind_result($result);
		$existingUser->fetch();
		
		if ($result===1) {
			$existingUser->close();
			return "Username già registrato";
		}
		else {
			$existingUser->close();
			return null;
		}		
	}

	// function inserimento utente
	function createUser($username, $password, $email, $trn_date) {
		global $con;
		
		// prepare registration query
		$query = "INSERT INTO users (username, password, email, trn_date) VALUES (?,?,?,?)";
		$registrationQuery = $con->prepare($query);
		$registrationQuery->bind_param("ssss", $username, md5($password), $email, $trn_date);
		

		if($registrationQuery->execute()) {
			return true;
		}
		else {
			return false;
		}
	}

	function registration($username, $password, $cpassword, $email, $trn_date) {
		if ($username != null && $password != null) {
			if (isValidUsername($username) === null) {
				if (isValidEmail($email) === null) {
					if (isValidPassword($password, $cpassword) === null) {
						if (createUser($username, $password, $email, $trn_date)) {
							return null;
						}
						else
							return 'Errore durante la registrazione';
					}
					else
						return isValidPassword($password,$cpassword);
				}
				else
					return isValidEmail($email);
			}
			else
				return isValidUsername($username);
		}
		else
			return "Tutti i campi sono obbligatori";
	}
?>
