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
		<header><h1>PONG!</h1></header>
		<nav>
			<button href="logout.php" class="navItem">Logout</button>
			<button href="#" class="navItem">Classifica</button>
		</nav>
		<section class="game"><canvas id="gameCanvas" width="800" height="600"></canvas></section>

		<script src="js/game.js"></script>
	</body>
</html>