<?php
	session_start();
	$jsID1 = "'login'";
	$jsID2 = "'reg'";
	$jsID3 = "'leaderboard'";
	$jsStyle ="'flex'";
	if (!isset($_SESSION['username'])) {
		echo '<nav>';
		echo '<a href="#" class="retroButton" onclick="document.getElementById('.$jsID1.').style.display='.$jsStyle.'">Login</a>';
		include $_SERVER["DOCUMENT_ROOT"].'/php/loginForm.php';
		echo '<a href="#" class="retroButton" onclick="document.getElementById('.$jsID2.').style.display='.$jsStyle.'">Registrazione</a>';
		include $_SERVER["DOCUMENT_ROOT"].'/php/regForm.php';
		echo '<a href="#" class="retroButton" onclick="document.getElementById('.$jsID3.').style.display='.$jsStyle.'">Classifica</a>';
		include $_SERVER["DOCUMENT_ROOT"].'/php/leaderboard.php';
		echo '</nav>';
	}
	else {
		echo '<nav>';
		echo '<a href="/php/logout.php" class="retroButton">Logout</a>';
		echo '<a href="#" class="retroButton" onclick="document.getElementById('.$jsID3.').style.display='.$jsStyle.'">Classifica</a>';
		include $_SERVER["DOCUMENT_ROOT"].'/php/leaderboard.php';
		echo '</nav>';
	}
?>