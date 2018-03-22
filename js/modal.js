var login = document.getElementById('login');
var reg = document.getElementById('reg');

window.onclick = function(event) {
    if (event.target == login) {
        login.style.display = "none";
    }
    else if (event.target == reg) {
        reg.style.display = "none";
    }
}
