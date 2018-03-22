<!DOCTYPE html>
<html lang="it">
	<head>
		<meta charset="utf-8"> 
		<meta name = "author" content = "Francesco Cartier">
		<meta name = "keywords" content = "classifica">
		<link rel="stylesheet" href="/css/style.css" type="text/css"> 
		<link rel="stylesheet" href="/css/modal.css" type="text/css">     
		<title>PONG!</title>
	</head>
	<body>
	<body>
		<header><h1><a href="/index.php">PONG</a></h1></header>
		<?php
			include $_SERVER["DOCUMENT_ROOT"].'/php/navbar.php';
		?>
		<table>
		<thead>
			<tr>
				<td>User</td>
				<td>Vittorie</td>
				<td>Sconfitte</td>
				<td>Rapporto</td>
			</tr>
		</thead>
		<tbody>
		<?php
			require_once $_SERVER["DOCUMENT_ROOT"].'/php/db.php';
			$results = mysqli_query($con,"SELECT * FROM leaderboard ORDER BY ratio DESC");
			while($row = mysqli_fetch_assoc($results)) {
			?>
				<tr>
					<td><?php echo $row['user']?></td>
					<td><?php echo $row['win']?></td>
					<td><?php echo $row['lost']?></td>
					<td><?php echo $row['ratio']?></td>
				</tr>

			<?php
			}
			?>
			</tbody>
			</table>
		<script type="text/javascript" src="/js/modal.js"></script>
	</body>
</html>