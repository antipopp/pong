<div id="reg" class="modal">
	<section class="retroBox animate">
		<div class="wrapper">
			<h1>Registrazione</h1>
			<form>
				<input type="text" id="regUsername" placeholder="Username" /><br>
				<input type="text" id="regEmail" placeholder="Email" /><br>
				<input type="password" id="regPassword" placeholder="Password" /><br>
				<input type="password" id="regCPassword" placeholder="Conferma password" /><br><br>
				<div id="regMessage" class="error"></div>
				<button type="button" onclick="sendRegForm()" class="retroButton">Registrati</button>
			</form>
			<p>Sei già registrato? Effettua il <a href="#" onclick="document.getElementById('reg').style.display='none';document.getElementById('login').style.display='flex'">login</a>!</p>
		</div>
	</section>
</div>
<script type="text/javascript" src="/js/formAjax.js"></script>