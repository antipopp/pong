var playArea = 
	// definizione degli elementi del DOM che andranno a creare la grafica di gioco
	document.createElement('div'),
	ship = document.createElement('div'),
	gameOverText = document.createElement('h1'),
	scoreDiv = document.createElement('div'),
	scoreLabel = document.createElement('p'),
	livesDiv = document.createElement('div'),
	livesLabel = document.createElement('p'),

	// definizione variabili per la gestione del gioco
	shipPos = {
		x: 0,
		y: 0,
		startX: 0,
		startY: 0
	},
	shipSpeed = 4,
	key = {
		right: false,
		left: false,
		up: false,
		down: false
	},
	shipWidth = ship.offsetWidth,
	shipHeight = ship.offsetHeight
	lasers = [],
	laserSpeed = 4,
	max_lasers = 5
	enemies = [],
	enemySpeed = 2,
	enemyTotal = 4,
	enemyPos = {
		x: 150,
		y: -50
	}
	lives = 3,
	gameOver = false
	scoreText = 'Score: ',
	score = 0,
	livesText = 'Lives: ';

// inizializzazione degli elementi di stile e posizionamento
document.getElementById('game').appendChild(playArea);
playArea.classList.add('playArea');
playArea.appendChild(ship);
ship.classList.add('ship');
shipPos.x = (playArea.offsetWidth / 2) - (ship.offsetWidth / 2);
shipPos.y = playArea.offsetHeight - (ship.offsetHeight * 2);
shipPos.startX = shipPos.x; // new lines
shipPos.startY = shipPos.y; // new lines
playArea.leftBoundary = 0;
playArea.rightBoundary = playArea.offsetWidth - ship.offsetWidth - 20;
playArea.topBoundary = 0;
playArea.bottomBoundary = playArea.offsetHeight - ship.offsetHeight - 20;
document.getElementById('game').appendChild(scoreDiv);
scoreDiv.classList.add('score-div');
scoreDiv.appendChild(scoreLabel);
scoreLabel.classList.add('score-label');
document.getElementById('game').appendChild(livesDiv);
livesDiv.classList.add('lives-div');
livesDiv.appendChild(livesLabel);
livesLabel.classList.add('lives-label');


function keyDown(e) {
	if (e.keyCode === 39) {
		key.right = true;
	} else if (e.keyCode === 37) {
		key.left = true;
	}
	if (e.keyCode === 38) {
		key.up = true;
	} else if (e.keyCode === 40) {
		key.down = true;
	}
	if (e.keyCode === 88) {
		if (lasers.length < max_lasers) {
			var laser = Laser();
			lasers.push([laser, shipPos.y]);
			playArea.appendChild(lasers[lasers.length - 1][0]);
			lasers[lasers.length - 1][0].classList.add('laser');
			lasers[lasers.length - 1][0].style.top = lasers[lasers.length - 1][1] + 'px';
			lasers[lasers.length - 1][0].style.left = shipPos.x + 25 + 'px';
		}
	}
}

function keyUp(e) {
	if (e.keyCode === 39) {
		key.right = false;
	} else if (e.keyCode === 37) {
		key.left = false;
	}
	if (e.keyCode === 38) {
		key.up = false;
	} else if (e.keyCode === 40) {
		key.down = false;
	}
}

function moveShip() {
	if (key.right === true) {
		shipPos.x += shipSpeed;
	} else if (key.left === true) {
		shipPos.x -= shipSpeed;
	}
	if (key.up === true) {
		shipPos.y -= shipSpeed;
	} else if (key.down === true) {
		shipPos.y += shipSpeed;
	}
	if (shipPos.x < playArea.leftBoundary) {
		shipPos.x = playArea.leftBoundary;
	}
	if (shipPos.x > playArea.rightBoundary) {
		shipPos.x = playArea.rightBoundary;
	}
	if (shipPos.y < playArea.topBoundary) {
		shipPos.y = playArea.topBoundary;
	}
	if (shipPos.y > playArea.bottomBoundary) {
		shipPos.y = playArea.bottomBoundary;
	}
	ship.style.left = shipPos.x + 'px';
	ship.style.top = shipPos.y + 'px';
}

document.addEventListener('keydown', keyDown, false);
document.addEventListener('keyup', keyUp, false);

function Laser() {
	return document.createElement('div');
}

function moveLasers() {
	for (var i = 0; i < lasers.length; i++) {
		if (parseInt(lasers[i][0].style.top) > playArea.topBoundary) {
			lasers[i][1] -= laserSpeed;
			lasers[i][0].style.top = lasers[i][1] + 'px';
			checkHit(i);
		} else {
			playArea.removeChild(lasers[i][0]);
			lasers.splice(i, 1);
		}
	}
}

function checkHit(l) {
	var lx = parseInt(lasers[l][0].style.left),
		ly = parseInt(lasers[l][0].style.top);
	for (var i = 0; i < enemies.length; i++) {
		var ex = parseInt(enemies[i][0].style.left),
			ey = parseInt(enemies[i][0].style.top),
			ew = enemies[i][0].offsetWidth,
			eh = enemies[i][0].offsetHeight;
		if (lx > ex && lx < ex + ew && ly > ey && ly < ey + eh) {
			playArea.removeChild(lasers[l][0]);
			playArea.removeChild(enemies[i][0]);
			lasers.splice(l, 1);
			enemies.splice(i, 1);
			score += 100;
		}
	}
}

function Enemy() {
	return document.createElement('div');
}

function moveEnemies() {
	if (enemies.length < enemyTotal) {
		var enemy = new Enemy();
		enemies.push([enemy, enemyPos.y]);
		playArea.appendChild(enemies[enemies.length - 1][0]);
		enemies[enemies.length - 1][0].classList.add('enemy');
		enemies[enemies.length - 1][0].style.top = enemies[enemies.length - 1][1] + 'px';
		enemies[enemies.length - 1][0].style.left = Math.floor(Math.random() * 500) + 'px';
	}
	for (var i = 0; i < enemies.length; i++) {
		enemies[i][1] += enemySpeed;
		enemies[i][0].style.top = enemies[i][1] + 'px';

		// inizializzazione delle variabili per la gestione delle collisioni tra nemici e giocatore
		var ex = parseInt(enemies[i][0].style.left),
			ey = parseInt(enemies[i][0].style.top),
			ew = ex + parseInt(enemies[i][0].offsetWidth),
			eh = ey + parseInt(enemies[i][0].offsetHeight),
			sx = parseInt(ship.style.left),
			sy = parseInt(ship.style.top),
			sw = sx + parseInt(ship.offsetWidth),
			sh = sy + parseInt(ship.offsetHeight);

		if (parseInt(enemies[i][0].style.top) > (playArea.bottomBoundary + enemies[i][0].style.height)) {
			enemies[i][1] = enemyPos.y;
			enemies[i][0].style.top = enemies[i][1] + 'px';

		// gestione della collisione tra la posizione dei nemici e quella del giocatore
		} else if (sx >= ex && sx <= ew && sy >= ey && sy <= eh) {
			checkLives();
		} else if (sw <= ew && sw >= ex && sy >= ey && sy <= eh) {
			checkLives();
		} else if (sh >= ey && sy <= eh && sx >= ex && sx <= ew) {
			checkLives();
		} else if (sh >= ey && sh <= eh && sw <= ew && sw >= ex) {
			checkLives();
		}
	}
}

function checkLives() {
	if (lives > 1) {
		resetGame();
	} else {
		playArea.removeChild(ship);
		for (var i = 0; i < enemies.length; i++) {
			playArea.removeChild(enemies[i][0]);
		}
		if (lasers.length > 0) {
			for (var i = 0; i < lasers.length; i++) {
				playArea.removeChild(lasers[i][0]);
			}
		}
		gameOver = true;
		playArea.appendChild(gameOverText);
		gameOverText.classList.add('game-over');
		gameOverText.innerHTML = 'Game Over';
	}
	lives -= 1;
}

function resetGame() {
	shipPos.x = shipPos.startX;
	shipPos.y = shipPos.startY;
	ship.style.left = shipPos.x + 'px';
	ship.style.top = shipPos.y + 'px';
	enemyPos.x = 150;
	for (var i = 0; i < enemyTotal; i++) {
		enemies[i][1] = enemyPos.y;
		enemies[i][0].style.top = enemies[i][1] + 'px';
		enemies[i][0].style.left = enemyPos.x + 'px';
		enemyPos.x += 150;
	}
}

function updateScore() {
	scoreLabel.innerHTML = scoreText + score;
	livesLabel.innerHTML = livesText + lives;
}

// ******************************************************************************** //
//                                                                                  //
// Autore: Paul Irish                                                               //
// URL: https://www.paulirish.com/2011/requestanimationframe-for-smart-animating/   //
// Descrizione:                                                                     //
//	Semplice funzione che controlla se il browser è in grado di utilizzare il       //
// 	metodo requestAnimationFrame, altrimenti utilizza setTimeout per gestire        //
// 	l'animazione.                                                                   //
// 																																									//
// ******************************************************************************** //
window.requestAnimFrame = (function () {
	return window.requestAnimationFrame ||
		window.webkitRequestAnimationFrame ||
		window.mozRequestAnimationFrame ||
		function (callback) {
			window.setTimeout(callback, 1000 / 60);
		};
})();

function loop() {
	if (gameOver === false) {
		moveShip();
		moveEnemies();
		moveLasers();
	}
	updateScore();
	requestAnimFrame(loop);
}

loop();
