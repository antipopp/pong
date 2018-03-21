/****************************************************
 TO DO:
 push win/loss data to server

****************************************************/

var canvas;
var canvasContext;

var ballX = 50;
var ballY = 50;
var ballSpeedX = 10;
var ballSpeedY = 4;
var ballRadius = 10;

var paddle1Y = 250;
var paddle2Y = 250;
const PADDLE_HEIGHT = 100;
const PADDLE_THICK = 10;

var winScreen = true;

var playerScore1 = 0;
var playerScore2 = 0;
const WINNING_SCORE = 3;

var playerData;

// import dal db
function getData() {
	var request = new XMLHttpRequest();
	request.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			playerData = JSON.parse(this.responseText)
		}
	};
	request.open("GET", "userEncode.php", true);
	request.send(); 
}

/*function pushData() {
	var request = new XMLHttpRequest();
	request.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			console.log(playerData);
		}
	};	
	request.open("POST", "userUpdate.php", true);
	request.setRequestHeader("Content-Type", "application/json");
	request.send(JSON.stringify(playerData));
}*/

function makeXHRRequest( url, callback, method, postData, dataType ) {
    if ( !window.XMLHttpRequest ) {
        return null;
    }
    
    // create request object
    var req = new XMLHttpRequest();
    
    // assign defaults to optional arguments
    method = method || 'GET';
    postData = postData || null;
    dataType = dataType || 'text/plain';
    
    // pass method and url to open method
    req.open( method, url );
    // set Content-Type header 
    req.setRequestHeader('Content-Type', dataType);
    
    // handle readystatechange event
    req.onreadystatechange = function() {
        // check readyState property
        if ( req.readyState === 4 ) { // 4 signifies DONE
            // req.status of 200 means success
            if ( req.status === 200 ) {
                callback.success(req); 
            } else { // handle request failure
                callback.failure(req); 
            }
        }
    }
    
    req.send( postData ); // send request
    
    return req; // return request object
}

function calculateMousePos(evt) {
	var rect = canvas.getBoundingClientRect();
	var root = document.documentElement;
	var mouseX = evt.clientX - rect.left - root.scrollLeft;
	var mouseY = evt.clientY - rect.top - root.scrollTop;
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
	var fps = 30;
	
	setInterval(function() {
		drawEverything();
		moveEverything();
	}, 1000/fps);
	
	canvas.addEventListener('mousedown',handleMouseClick);

	canvas.addEventListener('mousemove', function(evt) {
		var mousePos = calculateMousePos(evt);
		paddle1Y = mousePos.y - PADDLE_HEIGHT/2;
	});

	getData();
}

function computerMovement() {
	var paddle2YCenter = paddle2Y + (PADDLE_HEIGHT/2);

	if (paddle2YCenter < ballY-35)
		paddle2Y += 6;
	else if (paddle2YCenter > ballY+35)
		paddle2Y -= 6;
}

function moveEverything() {
	if (winScreen)
		return;

	computerMovement();
	ballX += ballSpeedX;
	ballY += ballSpeedY;

	// racchetta di destra
	if (ballX+ballRadius*2 > canvas.width-PADDLE_THICK) {
		if (ballY+ballRadius > paddle2Y && ballY-ballRadius < paddle2Y+PADDLE_HEIGHT) {
			ballSpeedX = -ballSpeedX;
			
		    var deltaY = ballY - (paddle2Y+PADDLE_HEIGHT/2);
			ballSpeedY = deltaY * 0.35;
		}	
	}

	// muro di destra
	if (ballX > canvas.width) {
		playerScore1++; // il punteggio deve stare prima di ballReset() 
		ballReset();
	}

	// racchetta di sinistra
	if (ballX-ballRadius*2 < 0+PADDLE_THICK) {
		if (ballY+ballRadius > paddle1Y && ballY-ballRadius < paddle1Y+PADDLE_HEIGHT) {
			ballSpeedX = -ballSpeedX;

			var deltaY = ballY - (paddle1Y+PADDLE_HEIGHT/2);
			ballSpeedY = deltaY * 0.35;
		}
	}

	// muro di sinistra
	if (ballX < 0) {
		playerScore2++;
		ballReset();
	}

	// muri sopra e sotto
	if (ballY > canvas.height) {
		ballSpeedY = -ballSpeedY;
	}

	if (ballY < 0) 
		ballSpeedY = -ballSpeedY;
	}

function ballReset() {
	if (playerScore1 >= WINNING_SCORE) {
		playerData.win += 1;
		makeXHRRequest('userUpdate.php', callback, 'POST', JSON.stringify(playerData),'application/json');
		winScreen = true;
	} 
	else if (playerScore2 >= WINNING_SCORE) {
		playerData.lost += 1;
		makeXHRRequest('userUpdate.php', callback, 'POST', JSON.stringify(playerData),'application/json');
		winScreen = true;
	}

	ballSpeedX = -ballSpeedX;
	ballX = canvas.width/2;
	ballY = canvas.height/2;
}

function drawNet() {
	for(var i=0;i<canvas.height;i+=40) {
		colorRect(canvas.width/2-1,i,2,20,'white');
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
			canvasContext.fillText("Hai perso.", 400,200);
		}
		canvasContext.textAlign='center';
		canvasContext.fillStyle = 'white';
		canvasContext.font = '30px Helvetica';
		canvasContext.fillText("clicca per giocare", 400,300);
		canvasContext.font = '20px Helvetica';
		canvasContext.fillText("sei loggato come:", 400,400);
		canvasContext.font = '25px Helvetica';
		canvasContext.fillText(playerData.user, 400,450);
		if (playerData.name !== "Anonimo") {
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
}
