var login = document.getElementById('login');
var reg = document.getElementById('reg');
var board = document.getElementById('leaderboard');

window.onclick = function(event) {
	if (event.target == login) {
		login.style.display = "none";
	}
	else if (event.target == reg) {
		reg.style.display = "none";
	}
	else if (event.target == board) {
		board.style.display = "none";
	}
}

function modalSwitch(whereTo) {
	if (whereTo == 'toLogin') {
		reg.style.display='none';
		login.style.display='flex';
	}
	else if (whereTo == 'toReg') {
		login.style.display='none';
		reg.style.display='flex';
	}
}