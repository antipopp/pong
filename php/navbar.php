<?php
	session_start();
	if (!isset($_SESSION['username'])) {
		$jsID = "'id01'";
		$jsStyle ="'flex'";
		echo '<nav>';
		echo '<a class="retroButton" onclick="document.getElementById('.$jsID.').style.display='.$jsStyle.'">Login</a>';
		include './php/loginForm.php';
		echo '<a href="./php/regForm.php" class="retroButton">Registrazione</a>';
		echo '<a href="./php/leaderboard.php" class="retroButton">Classifica</a>';
		echo '</nav>';
	}
?>