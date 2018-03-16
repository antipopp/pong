<!DOCTYPE html>
<html lang="it">
	<head>
		<meta charset="utf-8"> 
		<meta name = "author" content = "Francesco Cartier">
		<meta name = "keywords" content = "index">
		<link rel="stylesheet" href="/css/style.css" type="text/css">		
		<title>PONG!</title>
	</head>
	<body>
	<body>
		<header><h1>PONG</h1></header>
		<nav>
			<ul>
				<?php
					session_start();
					if(!isset($_SESSION["userId"])) {
						echo '<li><a href="login.php" class="retroButton">Login</a></li>';
						echo '<li><a href="registrazione.php" class="retroButton">Registrazione</a></li>';
					}
					else {
						echo '<li><a href="logout.php" class="retroButton">Logout</a></li>';
					}
				?>
				<li><a href="#" class="retroButton">Classifica</a></li>
			</ul>
		</nav>
		<section class="retroBox">
			<div class="wrapper gameContainer">
				<canvas id="gameCanvas" width="800" height="600"></canvas>
			</div>
		</section>

		<script src="js/game.js"></script>
	</body>
</html>