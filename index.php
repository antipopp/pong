<!DOCTYPE html>
<html lang="it">
	<head>
		<meta charset="utf-8"> 
		<meta name = "author" content = "Francesco Cartier">
		<meta name = "keywords" content = "index">
		<link rel="stylesheet" href="/css/style.css" type="text/css">
		<link rel="stylesheet" href="/css/login.css" type="text/css">	
		<title>PONG!</title>
	</head>
	<body>
		<h1><a href="index.php">PONG</a></h1>
		<?php
			include './php/navbar.php';
		?>
		<section class="retroBox">
			<div class="wrapper gameContainer">
				<canvas id="gameCanvas" width="800" height="600"></canvas>
			</div>
		</section>
		<script src="js/game.js"></script>
		<script src="js/login.js"></script>
	</body>
</html>