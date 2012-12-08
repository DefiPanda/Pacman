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
    //current level, total of 5 levels
    var level=0;
    //this is for letting pacman move only at most 1 step each time
    var in_interval=0;
    var heroX=0;
	var heroY=0;
	//0: red; 1:blue; 2: green; 3:yellow
	var color=0;
	var canvas1=document.getElementById("tankMap");
	var cxt=canvas1.getContext("2d");
    //hunting range
    var range_1= <?php echo ($_POST['level_one_range'])?>;
    var range_2= <?php echo ($_POST['level_two_range'])?>;
    var range_3= <?php echo ($_POST['level_three_range'])?>;
    var range= range_1;
	var hero=new Hero(0,0,1,20);
	var random_1= <?php echo ($_POST['level_one_random'])?>;
	var attacking_1= <?php echo ($_POST['level_one_attacking'])?>;
	random_1= (random_1>10)? 10: random_1;
	attacking_1= (attacking_1>10)? 10: attacking_1;
	var size_1= random_1+attacking_1;
	
	var random_2= <?php echo ($_POST['level_two_random'])?>;
	var attacking_2= <?php echo ($_POST['level_two_attacking'])?>;
	random_2= (random_2>10)? 10: random_2;
	attacking_2= (attacking_2>10)? 10: attacking_2;
	var size_2= random_2+attacking_2;
	
	var random_3= <?php echo ($_POST['level_three_random'])?>;
	var attacking_3= <?php echo ($_POST['level_three_attacking'])?>;
	random_3= (random_3>10)? 10: random_3;
	attacking_3= (attacking_3>10)? 10: attacking_3;
	var size_3= random_3+attacking_3;
	
	
	var ghost_list= new Array(size_1);
	for(var i=0; i<random_1; i++){
		var w_rnd= Math.floor(Math.random()*4)+1;
		var h_rnd= Math.floor(Math.random()*3)+1;
		ghost_list[i]= new Ghost(100*w_rnd, 100*h_rnd, i%4, 20, 1);
	}
	for(var i=random_1; i<size_1; i++){
		var w_rnd= Math.floor(Math.random()*4)+1;
		var h_rnd= Math.floor(Math.random()*3)+1;
		ghost_list[i]= new Ghost(100*w_rnd, 100*h_rnd, i%4, 20, 2);
	}


var winning_1=<?php echo ($_POST['level_one_chase'])?>;
var winning_2=<?php echo ($_POST['level_two_chase'])?>;
var winning_3=<?php echo ($_POST['level_three_chase'])?>;
var winning= winning_1;
var runnaway_list= new Array(winning);
    for(var i=0; i<winning; i++){
		var w_rnd= Math.floor(Math.random()*4)+1;
		var h_rnd= Math.floor(Math.random()*3)+1;
		runnaway_list[i]= new Runnaway(100*w_rnd, 100*h_rnd, 1,20,3,1);
	}

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


window.setInterval("increment(ghost_list)",300);
	

	function getCommand(){
		cxt.clearRect(0,0,canvas1.width,canvas1.height);
		var code=event.keyCode;
		switch(code){
		 case 87:
		  if(in_interval==0){
			for(var i=0; i<ghost_list.length; i++){
			if(ghost_list[i].x==hero.x && ghost_list[i].y==hero.y-20) { init();  
			break;}
		}
		for(var i=0; i<runnaway_list.length; i++){
			if(runnaway_list[i].eaten==1&&runnaway_list[i].x==hero.x && runnaway_list[i].y==hero.y-20) {runnaway_list[i].eaten=0;winning--;
				
				if(winning==0) {
				init();}
				break;}
		}


		  if(hero.y+10>hero.speed&&((memory[hero.x/20][(hero.y/20)-1])==0)){
		  hero.moveUp();}
		  in_interval=1;
		  }
		  break;
		 case 68:
		 if(in_interval==0){
		 for(var i=0; i<ghost_list.length; i++){
			if(ghost_list[i].x==hero.x+20 && ghost_list[i].y==hero.y) {
			  init();
			break;}
		}
		for(var i=0; i<runnaway_list.length; i++){
			if(runnaway_list[i].eaten==1&&runnaway_list[i].x==hero.x+20 && runnaway_list[i].y==hero.y) {runnaway_list[i].eaten=0;winning--;
				
				if(winning==0) {
				init();}
				break;}
		}


		  if(hero.x+30<canvas1.width&&((memory[hero.x/20+1][hero.y/20])==0)){
		  hero.moveRight();}
		  in_interval=1;
		  }
		  break;
		 case 83:
		 if(in_interval==0){
		 for(var i=0; i<ghost_list.length; i++){
			if(ghost_list[i].x==hero.x && ghost_list[i].y==hero.y+20) {
			  init();
			break;}
		}
		for(var i=0; i<runnaway_list.length; i++){
			if(runnaway_list[i].eaten==1&&runnaway_list[i].x==hero.x && runnaway_list[i].y==hero.y+20) {runnaway_list[i].eaten=0;winning--;
				
				if(winning==0) {
				init();}
				break;}
		}


		  if(hero.y+30<canvas1.height&&((memory[hero.x/20][(hero.y/20)+1])==0)){
		  hero.moveDown();}
		  in_interval=1;
		  }
		  break;
		 case 65:
		 if(in_interval==0){
		 for(var i=0; i<ghost_list.length; i++){
			if(ghost_list[i].x==hero.x-20 && ghost_list[i].y==hero.y) { 
			   init();
			break;}
		}
		for(var i=0; i<runnaway_list.length; i++){
			if(runnaway_list[i].eaten==1&&runnaway_list[i].x==hero.x-20 && runnaway_list[i].y==hero.y) {runnaway_list[i].eaten=0; winning--;
				
				if(winning==0) {
				init();}
				break;}
		}


		  if(hero.x+10>hero.speed&&((memory[(hero.x/20)-1][hero.y/20])==0)){
		  hero.moveLeft();}
		  in_interval=1;}
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
		 drawGhost(ghost_list, runnaway_list, hero);
		
	}
		
</script>


<strong>Upload</strong> map here: <input type="file" id="fileinput"/> </p>
<script type="text/javascript">
   function readSingleFile(evt) {
    //Retrieve the first (and only!) File from the FileList object
    var f = evt.target.files[0]; 

    if (f) {
      var r = new FileReader();
      r.onload = function(e) { 
	      var contents = e.target.result;
	      var w= canvas1.width/20;
          var h= canvas1.height/20;
          var counter= 0;
                for(var j=0; j<w; j++){
                 for(var k=0; k<h; k++){
                 //right column by row, i.e. x by y
                 var character= contents.charAt(counter);
                 counter++;
                  memory[j][k]= parseInt(character);
     }
    }
         color= parseInt(contents.charAt(counter));
      }
      r.readAsText(f);
    } else { 
      alert("Failed to load file");
    }
  }

  document.getElementById('fileinput').addEventListener('change', readSingleFile, false);
</script>
</body>
</html>

