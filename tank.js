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
	for(i=1; i<= canvas1.width/20; i++){
	cxt.moveTo(20*i,0);
	cxt.lineTo(20*i,canvas1.height);
	cxt.strokeStyle="red";
	cxt.stroke();
	}
	cxt.endPath();
}


function drawWalls(){
	for(var j=0; j<canvas1.width/20; j++){
		for(var k=0; k<canvas1.height/20; k++){
		if(memory[j][k]>0){
	   	drawOneWall(j*20,k*20,20,20);}
	}
	}
}

function drawOneWall(x,y,width,height){
	if(color==0)
	cxt.fillStyle="red";
	else if(color==1)
	cxt.fillStyle="blue";
	else if(color==2)
	cxt.fillStyle="green";
	else if(color==3)
	cxt.fillStyle="yellow";
	else if(color==4)
	cxt.fillStyle="#00FFFF";
	else if(color==5)
	cxt.fillStyle="#FF00FF";
	else if(color==6)
	cxt.fillStyle="#C0C0C0";
	else if(color==7)
	cxt.fillStyle="#FFFFFF";
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

function Ghost(x, y, direct, speed) {
	this.speed = speed;
	this.x = x;
	this.y = y;
	this.direct = direct;
}

function drawGhost(tank, tank2) {
	cxt.clearRect(0,0,canvas1.width,canvas1.height);
	switch(tank.direct) {
		case 0:
		    cxt.beginPath();
			cxt.arc(tank.x+10, tank.y+10, 10, 0.75 * 3.14, 1.75 * 3.14, true);
			cxt.fillStyle = "blue";
			cxt.fill();
			cxt.beginPath();
			cxt.arc(tank.x+10, tank.y+10, 10, 1.25 * 3.14, 2.25 * 3.14, true);
			cxt.fill();
			cxt.beginPath();
			break;
		case 2:
		    cxt.beginPath();
			cxt.arc(tank.x+10, tank.y+10, 10, 0.75 * 3.14, 1.75 * 3.14, false);
			cxt.fillStyle = "blue";
			cxt.fill();
			cxt.beginPath();
			cxt.arc(tank.x+10, tank.y+10, 10, 1.25 * 3.14, 2.25 * 3.14, false);
			cxt.fill();
			cxt.beginPath();
			break;
		case 1:
		    cxt.beginPath();
			cxt.arc(tank.x+10, tank.y+10, 10, 0.25 * 3.14, 1.25 * 3.14, false);
			cxt.fillStyle = "blue";
			cxt.fill();
			cxt.beginPath();
			cxt.arc(tank.x+10, tank.y+10, 10, 0.75 * 3.14, 1.75 * 3.14, false);
			cxt.fill();
			cxt.beginPath();
			break;
		case 3:
			cxt.beginPath();
			cxt.arc(tank.x+10, tank.y+10, 10, 0.25 * 3.14, 1.25 * 3.14, true);
			cxt.fillStyle = "blue";
			cxt.fill();
			cxt.beginPath();
			cxt.arc(tank.x+10, tank.y+10, 10, 0.75 * 3.14, 1.75 * 3.14, true);
			cxt.fill();
			cxt.beginPath();
			break;
	}
	drawTank(tank2);
}

function increment(){
		var dir= ghost.direct;
	var need_change=0;
	switch(dir){
	case 1:
	if(ghost.x+30<canvas1.width&&((memory[ghost.x/20+1][ghost.y/20])==0)){
	ghost.x+=20;
	} //right
	else need_change=1;
	break;
	case 2:
	if(ghost.y+30<canvas1.height&&((memory[ghost.x/20][(ghost.y/20)+1])==0)){
		  ghost.y+=20;
		  } //down
	else need_change=1;
	break;
	case 3:
	if(ghost.x+10>ghost.speed&&((memory[(ghost.x/20)-1][ghost.y/20])==0)){
		  ghost.x-=20;
		  } //left
	else need_change=1;
	break;
	case 0:
	if(ghost.y+10>ghost.speed&&((memory[ghost.x/20][(ghost.y/20)-1])==0)){
		  ghost.y-=20;
		  } //up
	else need_change=1;
    break;
    }
    if(need_change==1){
    	dir= Math.floor(Math.random()*4);
	switch(dir){
	case 1:
	if(ghost.x+30<canvas1.width&&((memory[ghost.x/20+1][ghost.y/20])==0)){
	ghost.x+=20;
	ghost.direct=1;
	} //right
	break;
	case 2:
	if(ghost.y+30<canvas1.height&&((memory[ghost.x/20][(ghost.y/20)+1])==0)){
		  ghost.y+=20;
		  ghost.direct=2;
		  } //down
	break;
	case 3:
	if(ghost.x+10>ghost.speed&&((memory[(ghost.x/20)-1][ghost.y/20])==0)){
		  ghost.x-=20;
		  ghost.direct=3;
		  } //left
	break;
	case 0:
	if(ghost.y+10>ghost.speed&&((memory[ghost.x/20][(ghost.y/20)-1])==0)){
		  ghost.y-=20;
		  ghost.direct=0;
		  } //up
    break;
    }
    }
    
	drawGhost(ghost, hero);
}
