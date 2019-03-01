<div id="leaderboard" class="modal">
	<section class="retroBox animate">
		<div class="wrapper">
			<table>
				<thead>
					<tr>
						<td>User</td>
						<td>Punteggio</td>
					</tr>
				</thead>
				<tbody>
					<?php
						require_once 'php/db.php';
						$results = $con->query("SELECT * FROM scores ORDER BY score DESC");
						while($row = mysqli_fetch_assoc($results)) {
					?>
						<tr>
							<td><?php echo $row['username']?></td>
							<td><?php echo $row['score']?></td>
						</tr>
					<?php
						}

						$con->close();
					?>
					</tbody>
				</table>
		</div>
	</section>
</div>
