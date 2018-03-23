<div id="login" class="modal">
	<section class="retroBox animate">
		<div class="wrapper">
			<h3>Login</h3>
			<form>
				<input type="text" id="username" placeholder="Username" /><br>
				<input type="password" id="password" placeholder="Password" /><br><br>
				<div id="loginMessage" class="error"></div>
				<div id="loginSuccess" class="success"></div>
				<button type="button" onclick="sendLoginForm()" class="retroButton">login</button>
			</form>
			<p>Non ti sei ancora registrato? <a href="#" onclick="modalSwitch('toReg')">Fallo qui!</a></p>
		</div>
	</section>
</div>


