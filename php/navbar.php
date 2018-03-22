<?php
	session_start();
	$jsID1 = "'login'";
	$jsID2 = "'reg'";
	$jsStyle ="'flex'";
	if (!isset($_SESSION['username'])) {
		echo '<nav>';
		echo '<a class="retroButton" onclick="document.getElementById('.$jsID1.').style.display='.$jsStyle.'">Login</a>';
		include $_SERVER["DOCUMENT_ROOT"].'/php/loginForm.php';
		echo '<a class="retroButton" onclick="document.getElementById('.$jsID2.').style.display='.$jsStyle.'">Registrazione</a>';
		include $_SERVER["DOCUMENT_ROOT"].'/php/regForm.php';
		echo '<a href="./php/leaderboard.php" class="retroButton">Classifica</a>';
		echo '</nav>';
	}
	else {
		echo '<nav>';
		echo '<a href="/php/logout.php" class="retroButton">Logout</a>';
		echo '<a href="/php/leaderboard.php" class="retroButton">Classifica</a>';
		echo '</nav>';
	}
?>