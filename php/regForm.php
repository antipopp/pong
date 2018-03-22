<div id="reg" class="modal">
	<section class="retroBox animate">
		<div class="wrapper">
			<h1>Registrazione</h1>
			<form>
				<input type="text" id="username" placeholder="Username" /><br>
				<input type="text" id="email" placeholder="Email" /><br>
				<input type="password" id="password" placeholder="Password" /><br>
				<input type="password" id="cpassword" placeholder="Conferma password" /><br><br>
				<div id="regMessage" class="error"></div>
				<button type="button" onclick="sendRegForm()" class="retroButton">Registrati</button>
			</form>
			<p>Sei già registrato? Effettua il <a href="#" onclick="document.getElementById('reg').style.display='none';document.getElementById('login').style.display='flex'">login</a>!</p>
		</div>
	</section>
</div>
<script type="text/javascript" src="/js/formAjax.js"></script>