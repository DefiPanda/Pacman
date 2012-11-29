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

//level 1: random ghost, level 2: if in sight, if possible, switch direction to get the pacman
function Ghost(x, y, direct, speed, level) {
	this.speed = speed;
	this.x = x;
	this.y = y;
	this.direct = direct;
	this.level= level;
}

function Runnaway(x, y, direct, speed, level, eaten) {
	this.speed = speed;
	this.x = x;
	this.y = y;
	this.direct = direct;
	this.level= level;
	this.eaten= eaten;
}

function drawGhost(list1, list2, tank2) {
	cxt.clearRect(0,0,canvas1.width,canvas1.height);
	for(var i=0; i<list1.length; i++){
	var tank= list1[i];
	var color= "blue";
	if(tank.level==2){color="green";}
	else if(tank.level==3) {color="white";}
	switch(tank.direct) {
		case 0:
		    cxt.beginPath();
			cxt.arc(tank.x+10, tank.y+10, 10, 0.75 * 3.14, 1.75 * 3.14, true);
			cxt.fillStyle = color;
			cxt.fill();
			cxt.beginPath();
			cxt.arc(tank.x+10, tank.y+10, 10, 1.25 * 3.14, 2.25 * 3.14, true);
			cxt.fill();
			cxt.beginPath();
			break;
		case 2:
		    cxt.beginPath();
			cxt.arc(tank.x+10, tank.y+10, 10, 0.75 * 3.14, 1.75 * 3.14, false);
			cxt.fillStyle = color;
			cxt.fill();
			cxt.beginPath();
			cxt.arc(tank.x+10, tank.y+10, 10, 1.25 * 3.14, 2.25 * 3.14, false);
			cxt.fill();
			cxt.beginPath();
			break;
		case 1:
		    cxt.beginPath();
			cxt.arc(tank.x+10, tank.y+10, 10, 0.25 * 3.14, 1.25 * 3.14, false);
			cxt.fillStyle = color;
			cxt.fill();
			cxt.beginPath();
			cxt.arc(tank.x+10, tank.y+10, 10, 0.75 * 3.14, 1.75 * 3.14, false);
			cxt.fill();
			cxt.beginPath();
			break;
		case 3:
			cxt.beginPath();
			cxt.arc(tank.x+10, tank.y+10, 10, 0.25 * 3.14, 1.25 * 3.14, true);
			cxt.fillStyle = color;
			cxt.fill();
			cxt.beginPath();
			cxt.arc(tank.x+10, tank.y+10, 10, 0.75 * 3.14, 1.75 * 3.14, true);
			cxt.fill();
			cxt.beginPath();
			break;
	}
	}
	for(var j=0; j<list2.length; j++){
		var tank= list2[j];
      if(tank.eaten==1){
      drawBodyIn(tank.x+10,tank.y+10,0);
      drawEyesIn(tank.x+20,tank.y+25,0);
      }
    
  }
	drawTank(tank2);
}

function drawBodyIn(x,y,alpha){
      cxt.beginPath();
      x-=5; y-=6;
      cxt.moveTo(x,y);
      cxt.lineTo(x,y+4);
      cxt.arc(x+4,y+4,4,Math.PI,Math.PI*2,false);
      cxt.lineTo(x+8,y+12);
      cxt.lineTo(x+6,y+10);
      cxt.lineTo(x+5,y+12);
      cxt.lineTo(x+4,y+10);
      cxt.lineTo(x+3,y+12);
      cxt.lineTo(x+2,y+10);
      cxt.lineTo(x,y+12);
      cxt.closePath();

      cxt.lineWidth = 3;
      cxt.fillStyle = "rgba(175,255,255,"+alpha+")";
      cxt.stroke();
      cxt.fill();
    }

    function drawEyesIn(x,y,alpha) {
    	x-=14; y-=18;
      cxt.beginPath();
      cxt.arc(x,y,1,0,Math.PI*2,false);
      cxt.moveTo(x+5,y);
      cxt.arc(x+4,y,1,0,Math.PI*2,false);
      cxt.closePath();

      cxt.lineWidth = 1;
      cxt.fillStyle = "rgb(255,255,255)";
      cxt.stroke();
      cxt.fill();

      cxt.beginPath();
      cxt.arc(x+1,y+0,1,0,Math.PI*2,false);
      cxt.moveTo(x+5,y+0);
      cxt.arc(x+5,y+0,3,0,Math.PI*2,false);
      cxt.closePath();

      cxt.fillStyle = "rgba(0,0,0,"+alpha+")";
      cxt.stroke();
      cxt.fill();
    }

function increment(list){
	in_interval=0;
	for(var i=0; i<list.length; i++){
	ghost=list[i];
	var dir= ghost.direct;
	var dice= Math.floor(Math.random()*2);
	//if distance bewteen ghost and pacman is within 5 grids
	if(ghost.level==2&&((ghost.x-hero.x)*(ghost.x-hero.x)+(ghost.y-hero.y)*(ghost.y-hero.y))<=range*range*20*20){
		if(ghost.x>hero.x){
			if(ghost.y>hero.y) {
				if(dice==0){dir=0; ghost.direct=0;}
				else {dir=3; ghost.direct=3;}
				}
			else if(ghost.y<hero.y){
				if(dice==0){dir=2; ghost.direct=2;}
				else {dir=3; ghost.direct=3;}
				}
			else{
				dir=3; ghost.direct=3; 
			}
		}
		else if(ghost.x<hero.x){
			if(ghost.y<hero.y) {
				if(dice==0){dir=2; ghost.direct=2;}
				else {dir=1; ghost.direct=1;}
				}
			else if(ghost.y>hero.y){
				if(dice==0){dir=0; ghost.direct=0;}
				else {dir=1; ghost.direct=1;}
			}
			else{
			   dir=1; ghost.direct=1;
			}
		}
		else if(ghost.x==hero.x){
			if(ghost.y>hero.y) {dir=0; ghost.direct=0;}
			else {dir=2; ghost.direct=2;}
		}
	}
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
    
    if(ghost.x==hero.x&&ghost.y==hero.y){window.alert("game over!"); }
   }
   
   
    for(var i=0; i<runnaway_list.length; i++){
    	if(runnaway_list[i].eaten==0) continue;
     	var dir= Math.floor(Math.random()*4);
     	var ghost= runnaway_list[i];
    	
     	
	switch(dir){
	case 1:
	if(ghost.x+30<canvas1.width&&((memory[ghost.x/20+1][ghost.y/20])==0)){
	if(ghost.x+20==hero.x&&ghost.y==hero.y){ghost.eaten=0;winning--;}
	ghost.x+=20;
	ghost.direct=1;
	} //right
	break;
	case 2:
	if(ghost.y+30<canvas1.height&&((memory[ghost.x/20][(ghost.y/20)+1])==0)){
		if(ghost.x==hero.x&&ghost.y+20==hero.y){ghost.eaten=0;winning--;}
		  ghost.y+=20;
		  ghost.direct=2;
		  } //down
	break;
	case 3:
	if(ghost.x+10>ghost.speed&&((memory[(ghost.x/20)-1][ghost.y/20])==0)){
		if(ghost.x-20==hero.x&&ghost.y==hero.y){ghost.eaten=0;winning--;}
		  ghost.x-=20;
		  ghost.direct=3;
		  } //left
	break;
	case 0:
	if(ghost.y+10>ghost.speed&&((memory[ghost.x/20][(ghost.y/20)-1])==0)){
		if(ghost.x==hero.x&&ghost.y-20==hero.y){ghost.eaten=0;winning--;}
		  ghost.y-=20;
		  ghost.direct=0;
		  } //up
    break;
    }
    }
    
	drawGhost(list, runnaway_list, hero);	
}
