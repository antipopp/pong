<div id="login" class="modal">
	<section class="retroBox animate">
		<div class="wrapper">
			<h1>Login</h1>
			<form action="/php/loginChecks.php" method="post" name="login">
				<input type="text" name="username" placeholder="Username" /><br>
				<input type="password" name="password" placeholder="Password" /><br><br>
				<?php
					if (isset($_GET['loginMessage'])) {
						if ($_GET['loginMessage'] != "success"){
							echo '<div class="error">';
							echo '<p>' . $_GET['loginMessage'] . '</p>';
							echo '</div>';
						}
						else if ($_GET['loginMessage'] === "success"){
							echo '<div class="success">';
							echo '<p>Registrazione avvenuta con successo</p>';
							echo '</div>';
						}
					}
				?>
				<button name="submit" type="submit" class="retroButton">Login</button>
			</form>
			<p>Non ti sei ancora registrato? <a href="#" onclick="document.getElementById('login').style.display='none';document.getElementById('reg').style.display='flex'">Fallo qui!</a></p>
		</div>
	</section>
</div>

