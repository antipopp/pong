<!DOCTYPE html>
<html lang="it">
	<head>
		<meta charset="utf-8"> 
		<meta name = "author" content = "Francesco Cartier">
		<meta name = "keywords" content = "registration">
		<link rel="stylesheet" href="/css/style.css" type="text/css">		
		<title>Registrazione</title>
	</head>
	<body>
		<header><h1><a href="index.php">PONG</a></h1></header>
		<section class="retroBox">
			<div class="wrapper">
				<h1>Registrazione</h1>
				<form name="registration" action="./php/regChecks.php" method="POST">
					<input type="text" name="username" placeholder="Username" /><br>
					<input type="text" name="email" placeholder="Email" /><br>
					<input type="password" name="password" placeholder="Password" /><br>
					<input type="password" name="cpassword" placeholder="Conferma password" /><br><br>
					<?php
						if (isset($_GET['regMessage'])){
							echo '<div class="error">';
							echo '<p>' . $_GET['regMessage'] . '</p>';
							echo '</div>';
						}
						else {
							echo '<div class="error">';
							echo '<p>Tutti i campi sono obbligatori</p>';
							echo '</div>';
						}
					?>
					<button type="submit" name="submit" class="retroButton">Registrati</button>
				</form>
				<p>Sei già registrato? Effettua il <a href="./php/loginForm.php">login</a>!</p>
			</div>
		</section>
	</body>
</html>