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
<script type="text/javascript">

<?php if(!isset($_GET["grid"])) {$num_of_grids=500;} else {$num_of_grids=$_GET["grid"];}?>
    var num_of_grids= <?php echo $num_of_grids;?>;
    var heroX=0;
	var heroY=0;
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
	
	//generate 10 walls
	var walls= new Array(num_of_grids);
	for(var j=0; j<num_of_grids; j++){
	   walls[j]= new Array(4);
	   generateRandomWalls(j);
	}
	
	
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
		  }
		 drawTank(hero);
	}
</script>
</body>
</html>

