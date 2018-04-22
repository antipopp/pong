<div id="leaderboard" class="modal">
	<section class="retroBox animate">
		<div class="wrapper">
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
						require_once 'db.php';
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
		</div>
	</section>
</div>
