<?php
	include("auth.php");
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>PONG!</title>
		<link rel="stylesheet" href="css/style.css" />
	</head>
	<body>
		<header><h1>PONG</h1></header>
		<nav>
			<ul>
				<li><a href="logout.php" class="retroButton">Logout</a></li>
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