<div id="reg" class="modal">
	<section class="retroBox animate">
		<div class="wrapper">
			<h3>Registrazione</h3>
			<form>
				<input type="text" id="regUsername" placeholder="Username" /><br>
				<input type="text" id="regEmail" placeholder="Email" /><br>
				<input type="password" id="regPassword" placeholder="Password" /><br>
				<input type="password" id="regCPassword" placeholder="Conferma password" /><br><br>
				<div id="regMessage" class="error"></div>
				<button type="submit" onclick="sendRegForm()" class="retroButton">Registrati</button>
			</form>
			<p>Sei già registrato? Effettua il <a href="#" onclick="modalSwitch('toLogin')">login</a>!</p>
		</div>
	</section>
</div>