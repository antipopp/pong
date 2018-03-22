function sendRegForm() {
	var req = new XMLHttpRequest();	
	var username = document.getElementById('username').value;
	var password = document.getElementById('password').value;
	var email = document.getElementById('email').value;
	var cpassword = document.getElementById('cpassword').value;

	var creds = 'username='+username+'&password='+password+'&cpassword='+cpassword+'&email='+email;

	req.onreadystatechange = function() {
		if (req.readyState == 4 && req.status == 200) {
			if (req.responseText == 'success') {
				document.getElementById('reg').style.display='none';
				document.getElementById('login').style.display='flex';
				document.getElementById('loginSuccess').innerHTML='Registrazione avvenuta con successo!';
			}
			else
				document.getElementById('regMessage').innerHTML = req.responseText;
		}
	}

	req.open('POST', '../php/regChecks.php', true);
	req.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
	req.send(creds);
}

function sendLoginForm() {
	var req = new XMLHttpRequest;
	var username = document.getElementById('username').value;
	var password = document.getElementById('password').value;

	var creds = 'username='+username+'&password='+password;

	req.onreadystatechange = function() {
		if (req.readyState == 4 && req.status == 200) {
			if (req.responseText == 'success') {
				location.reload();
			}
			else
				document.getElementById('loginMessage').innerHTML = req.responseText;
		}
	}

	req.open('POST', '../php/loginChecks.php', true);
	req.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
	req.send(creds);
}