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
