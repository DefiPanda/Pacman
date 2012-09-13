function Hero(x, y, direct, speed) {
	this.speed = speed;
	this.x = x;
	this.y = y;
	this.direct = direct;

	this.moveUp = function() {
		this.y -= this.speed;
		this.direct = 0;
	}
	this.moveDown = function() {
		this.y += this.speed;
		this.direct = 2;
	}
	this.moveLeft = function() {
		this.x -= this.speed;
		this.direct = 3;
	}
	this.moveRight = function() {
		this.x += this.speed;
		this.direct = 1;
	}
}


function drawLines(){
	cxt.beginPath();
    for(var i=1; i<= canvas1.height/20; i++){
	cxt.moveTo(0,20*i);
	cxt.lineTo(canvas1.width,20*i);
	cxt.strokeStyle="red";
	cxt.stroke();
	}
	for(var i=1; i<= canvas1.width/20; i++){
	cxt.moveTo(20*i,0);
	cxt.lineTo(20*i,canvas1.height);
	cxt.strokeStyle="red";
	cxt.stroke();
	}
	cxt.endPath();
}

function generateRandomWalls(index){
	walls[index][0]=20*(Math.floor(Math.random()*14)+1);
	walls[index][1]=20*(Math.floor(Math.random()*4)+1);
	walls[index][2]= 20*Math.floor(Math.random()*(canvas1.width/40));
	walls[index][3]= 20*Math.floor(Math.random()*(canvas1.height/40));
}

function drawWalls(){
	for(var j=0; j<10; j++){
	   	drawOneWall(walls[j][2],walls[j][3],walls[j][0],walls[j][1]);
	}
}

function drawOneWall(x,y,width,height){
	cxt.fillStyle="red";
	cxt.fillRect(x,y,width,height);
	var start_x= x/20;
	var start_y= y/20;
	for(var i= 0; i<width/20; i++){
	  for(var j=0; j<height/20; j++){
	  	memory[start_x+i][start_y+j]=1;
	  }
	}
}


function drawTank(tank) {
	switch(tank.direct) {
		case 0:
		    cxt.beginPath();
			cxt.arc(tank.x+10, tank.y+10, 10, 0.75 * 3.14, 1.75 * 3.14, true);
			cxt.fillStyle = "yellow";
			cxt.fill();
			cxt.beginPath();
			cxt.arc(tank.x+10, tank.y+10, 10, 1.25 * 3.14, 2.25 * 3.14, true);
			cxt.fill();
			cxt.beginPath();
			break;
		case 2:
		    cxt.beginPath();
			cxt.arc(tank.x+10, tank.y+10, 10, 0.75 * 3.14, 1.75 * 3.14, false);
			cxt.fillStyle = "yellow";
			cxt.fill();
			cxt.beginPath();
			cxt.arc(tank.x+10, tank.y+10, 10, 1.25 * 3.14, 2.25 * 3.14, false);
			cxt.fill();
			cxt.beginPath();
			break;
		case 1:
		    cxt.beginPath();
			cxt.arc(tank.x+10, tank.y+10, 10, 0.25 * 3.14, 1.25 * 3.14, false);
			cxt.fillStyle = "yellow";
			cxt.fill();
			cxt.beginPath();
			cxt.arc(tank.x+10, tank.y+10, 10, 0.75 * 3.14, 1.75 * 3.14, false);
			cxt.fill();
			cxt.beginPath();
			break;
		case 3:
			cxt.beginPath();
			cxt.arc(tank.x+10, tank.y+10, 10, 0.25 * 3.14, 1.25 * 3.14, true);
			cxt.fillStyle = "yellow";
			cxt.fill();
			cxt.beginPath();
			cxt.arc(tank.x+10, tank.y+10, 10, 0.75 * 3.14, 1.75 * 3.14, true);
			cxt.fill();
			cxt.beginPath();
			break;
	}
	drawWalls();
	drawLines();
}