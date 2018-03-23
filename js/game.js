var canvas;
var canvasContext;

var ballX = 400;
var ballY = 300;
var ballSpeedX = 7;
var ballSpeedY = 0;
var ballRadius = 10;

var paddle1Y = 300;
var paddle2Y = 300;
const PADDLE_HEIGHT = 100;
const PADDLE_THICK = 10;

var winScreen = true;

var playerScore1 = 0;
var playerScore2 = 0;
const WINNING_SCORE = 3;

var playerData = '';


function getData() {
	var req = new XMLHttpRequest();
	req.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			playerData = JSON.parse(this.responseText)
		}
	};
	req.open("GET", "../php/userEncode.php", true);
	req.send(); 
}

function sendData(data) {
	var req = new XMLHttpRequest();	
	
	req.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200)
			console.log(this.responseText);
	}
	req.open("POST", "../php/userUpdate.php");
	req.setRequestHeader('Content-Type', 'application/json');
	req.send(JSON.stringify(data));
}

function calculateMousePos(evt) {
	var rect = canvas.getBoundingClientRect();
	var mouseX = evt.clientX - rect.left;
	var mouseY = evt.clientY - rect.top;
	return {
		x:mouseX,
		y:mouseY
	};
}

function handleMouseClick() {
	if (winScreen){
		playerScore1 = 0;
		playerScore2 = 0;
		winScreen = false;	
	}
}

window.onload = function() {
	canvas = document.getElementById('gameCanvas');
	canvasContext = canvas.getContext('2d');
	getData();

	function frame() {
		moveEverything();
		drawEverything();
		requestAnimationFrame(frame);
	}
	
	requestAnimationFrame(frame);
	
	canvas.addEventListener('mousedown',handleMouseClick);

	canvas.addEventListener('mousemove', function(evt) {
		var mousePos = calculateMousePos(evt);
		paddle1Y = mousePos.y - PADDLE_HEIGHT/2;
	});

	
}

function computerMovement() {
	var paddle2YCenter = paddle2Y + (PADDLE_HEIGHT/2);

	if (paddle2YCenter < ballY-35)
		paddle2Y += 5;
	else if (paddle2YCenter > ballY+35)
		paddle2Y -= 5;
}

function moveEverything() {
	if (winScreen)
		return;

	computerMovement();
	ballX += ballSpeedX;
	ballY += ballSpeedY;

	// racchetta di destra
	if (ballX+ballRadius > canvas.width-PADDLE_THICK) {
		if (ballY+ballRadius > paddle2Y && ballY-ballRadius < paddle2Y+PADDLE_HEIGHT) {
			ballSpeedX = -ballSpeedX;
			
			var deltaY = ballY - (paddle2Y+PADDLE_HEIGHT/2);
			ballSpeedY = deltaY * 0.18;
		}	
	}

	// muro di destra
	if (ballX > canvas.width) {
		playerScore1++; 
		ballReset();
	}

	// racchetta di sinistra
	if (ballX-ballRadius < 0+PADDLE_THICK) {
		if (ballY+ballRadius > paddle1Y && ballY-ballRadius < paddle1Y+PADDLE_HEIGHT) {
			ballSpeedX = -ballSpeedX;

			var deltaY = ballY - (paddle1Y+PADDLE_HEIGHT/2);
			ballSpeedY = deltaY * 0.18;
		}
	}

	// muro di sinistra
	if (ballX < 0) {
		playerScore2++;
		ballReset();
	}

	// muro sotto
	if (ballY+ballRadius > canvas.height) {
		ballSpeedY = -ballSpeedY;
	}

	// muro sopra
	if (ballY-ballRadius < 0) 
		ballSpeedY = -ballSpeedY;
}

function ballReset() {
	if (playerScore1 >= WINNING_SCORE) {
		if (playerData.user == 'Ospite') {
			winScreen = true;
		}
		else {
			playerData.win += 1;
			sendData(playerData);
			winScreen = true;
		}
	} 
	else if (playerScore2 >= WINNING_SCORE) {
		if (playerData.user == 'Ospite') {
			winScreen = true;
		}
		else {
			playerData.lost += 1;
			sendData(playerData);
			winScreen = true;
		}
	}

	ballSpeedX = -ballSpeedX;
	ballX = canvas.width/2;
	ballY = canvas.height/2;
}

function drawNet() {
	for(var i=0;i<=canvas.height;i+=40) {
		colorRect(canvas.width/2-2,i,4,20,'white');
	}
}

function drawEverything() {
	// cornice nera
	colorRect(0,0,canvas.width,canvas.height, 'black');

	if (winScreen) {
		if (playerScore1 >= WINNING_SCORE) {
			canvasContext.fillStyle = 'white';
			canvasContext.font = '30px Helvetica';
			canvasContext.textAlign='center';
			canvasContext.fillText("Hai vinto!", 400,200);
		}
		else if (playerScore2 >= WINNING_SCORE) {
			canvasContext.textAlign='center';
			canvasContext.fillStyle = 'white';
			canvasContext.font = '30px Helvetica';
			canvasContext.fillText("Hai perso :(", 400,200);
		}
		canvasContext.textAlign='center';
		canvasContext.fillStyle = 'white';
		canvasContext.font = '30px Helvetica';
		canvasContext.fillText("clicca per giocare", 400,300);
		canvasContext.font = '20px Helvetica';
		canvasContext.fillText("stai giocando come:", 400,400);
		canvasContext.font = '25px Helvetica';
		canvasContext.fillText(playerData.user, 400,450);
		if (playerData.user != "Ospite") {
			canvasContext.textAlign='end';
			canvasContext.fillStyle = 'green';
			canvasContext.font = '25px Helvetica';
			canvasContext.fillText(playerData.win, 390,500);
			canvasContext.textAlign='start';
			canvasContext.fillStyle = 'red';
			canvasContext.font = '25px Helvetica';
			canvasContext.fillText(playerData.lost, 410,500);
		}

		return;
	}
	// rendering degli elementi

	drawNet();

	// utente anonimo o loggato
	canvasContext.fillStyle = 'white';
	canvasContext.font = '20px Helvetica';
	canvasContext.fillText(playerData.user, 250,100);


	// racchetta sinistra
	colorRect(0,paddle1Y,PADDLE_THICK,PADDLE_HEIGHT, 'white');

	// racchetta destra
	colorRect(canvas.width-PADDLE_THICK,paddle2Y,PADDLE_THICK,PADDLE_HEIGHT, 'white');

	// palla
	colorCircle(ballX,ballY,ballRadius,'red'); 

	// punteggio
	canvasContext.fillStyle = 'white';
	canvasContext.font = '30px Helvetica';
	canvasContext.fillText(playerScore1, 100,100);
	canvasContext.fillText(playerScore2, 700,100);
}

function colorRect(leftX, topY, width, height, color){
	canvasContext.fillStyle = color;
	canvasContext.fillRect(leftX, topY, width, height);
}

function colorCircle(posX, posY, radius, color) {
	canvasContext.fillStyle = color;
	canvasContext.beginPath();
	canvasContext.arc(posX, posY, radius, 0, Math.PI*2, true)
	canvasContext.fill(); 
	canvasContext.closePath();
}
