<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" style="text/css" href="style.css">
<meta charset="utf-8">
<meta title="hello">
</head>
<body onkeydown="getCommand()">
<canvas id="tankMap" width="620px" height="420px"></canvas>
<script type="text/javascript" src="tank.js"></script>
<script type="text/javascript" src="jquery-1.3.2-vsdoc2.js"></script>
<script type="text/javascript">
    var heroX=0;
	var heroY=0;
	//0: red; 1:blue; 2: green; 3:yellow
	var color=0;
	var canvas1=document.getElementById("tankMap");
	var cxt=canvas1.getContext("2d");
    
	var hero=new Hero(0,0,1,20);
	var memory= new Array(canvas1.width/20);
	for(var j=0; j<canvas1.width/20; j++){
	   memory[j]= new Array(k);
	 for(var k=0; k<canvas1.height/20; k++){
	 	memory[j][k]=0;
	 }
	}
		
	$('#tankMap').bind('click', function() {
		 var offset = $('#tankMap').offset();
		 var mouseX = event.pageX-offset.left;
         var mouseY = event.pageY-offset.top;
	   drawOneWall(20*Math.floor(mouseX/20),20*Math.floor(mouseY/20),20,20);
	}
);
	
	drawTank(hero);
	
	function getCommand(){
		cxt.clearRect(0,0,canvas1.width,canvas1.height);
		var code=event.keyCode;
		switch(code){
		 case 87:
		  if(hero.y+10>hero.speed&&((memory[hero.x/20][(hero.y/20)-1])==0)){
		  hero.moveUp();}
		  break;
		 case 68:
		  if(hero.x+30<canvas1.width&&((memory[hero.x/20+1][hero.y/20])==0)){
		  hero.moveRight();}
		  break;
		 case 83:
		  if(hero.y+30<canvas1.height&&((memory[hero.x/20][(hero.y/20)+1])==0)){
		  hero.moveDown();}
		  break;
		 case 65:
		  if(hero.x+10>hero.speed&&((memory[(hero.x/20)-1][hero.y/20])==0)){
		  hero.moveLeft();}
		  break;
		 case 48:
		  color=0;
		  break;
		 case 49:
		  color=1;
		  break;
		 case 50:
		  color=2;
		  break;
		 case 51:
		  color=3;
		  break;
		 case 52:
		  color=4;
		  break;
		 case 53:
		  color=5;
		  break;
		 case 54:
		  color=6;
		  break;
		 case 55:
		  color=7;
		  break;
		  }
		 drawTank(hero);
	}
		
</script>
</body>
</html>

