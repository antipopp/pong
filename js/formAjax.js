function sendRegForm() {
	var req = new XMLHttpRequest();	
	var username = document.getElementById('regUsername').value;
	var password = document.getElementById('regPassword').value;
	var email = document.getElementById('regEmail').value;
	var cpassword = document.getElementById('regCPassword').value;

	var creds = 'username='+username+'&password='+password+'&cpassword='+cpassword+'&email='+email;
	req.onreadystatechange = function() {
		if (req.readyState == 4 && req.status == 200) {
			if (req.responseText == 'success') {
				modalSwitch('toLogin');
				var node = document.getElementById('loginSuccess');
				while (node.firstChild)
					node.removeChild(node.firstChild);
				node.appendChild(document.createTextNode('Registrazione avvenuta con successo'));
			}
			else {
				var node = document.getElementById('regMessage');
				while (node.firstChild)
					node.removeChild(node.firstChild);
				node.appendChild(document.createTextNode(req.responseText));				
			}

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
				var node = document.getElementById('loginMessage');
				while (node.firstChild)
					node.removeChild(node.firstChild);
				node.appendChild(document.createTextNode(req.responseText));
		}
	}

	req.open('POST', '../php/loginChecks.php', true);
	req.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
	req.send(creds);
}