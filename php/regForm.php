<div id="reg" class="modal">
	<section class="retroBox animate">
		<div class="wrapper">
			<h1>Registrazione</h1>
			<form action="php/regChecks.php" method="POST" name="registration">
				<input type="text" name="username" placeholder="Username" /><br>
				<input type="text" name="email" placeholder="Email" /><br>
				<input type="password" name="password" placeholder="Password" /><br>
				<input type="password" name="cpassword" placeholder="Conferma password" /><br><br>
				<?php
					if (isset($_GET['regMessage'])){
						echo '<div class="error">';
						echo '<p>' . $_GET['regMessage'] . '</p>';
						echo '</div>';
					}
					else {
						echo '<div class="error">';
						echo '<p>Tutti i campi sono obbligatori</p>';
						echo '</div>';
					}
				?>
				<button type="submit" name="submit" class="retroButton">Registrati</button>
			</form>
			<p>Sei già registrato? Effettua il <a onclick="document.getElementById('login').style.display='flex'">login</a>!</p>
		</div>
	</section>
</div>