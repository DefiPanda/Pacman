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
    //hunting range
    var range= 5;
	var hero=new Hero(0,0,1,20);
	var ghost_list= new Array(4);
	ghost_list[0]= new Ghost(100,100,1,20, 2);
	ghost_list[1]= new Ghost(200,200,2,20, 1);
	ghost_list[2]= new Ghost(300,300,3,20, 2);
	ghost_list[3]= new Ghost(300,200,1,20, 2);
	// var ghost=new Ghost(100,100,1,20, 2);
    var runnaway_list= new Array(8);
    var winning= runnaway_list.length;
    runnaway_list[0]= new Runnaway(200,100,1,20,3,0);
    runnaway_list[1]= new Runnaway(200,300,1,20,3,1);
    runnaway_list[2]= new Runnaway(200,100,1,20,3,1);
    runnaway_list[3]= new Runnaway(200,300,1,20,3,1);
    runnaway_list[4]= new Runnaway(300,100,1,20,3,1);
    runnaway_list[5]= new Runnaway(300,200,1,20,3,1);
    runnaway_list[6]= new Runnaway(300,100,1,20,3,1);
    runnaway_list[7]= new Runnaway(300,200,1,20,3,1);
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



window.setInterval("increment(ghost_list)",400);
	

	function getCommand(){
		cxt.clearRect(0,0,canvas1.width,canvas1.height);
		var code=event.keyCode;
		switch(code){
		 case 87:
			for(var i=0; i<ghost_list.length; i++){
			if(ghost_list[i].x==hero.x && ghost_list[i].y==hero.y-20) {alert("game over!"); break;}
		}
		for(var i=0; i<runnaway_list.length; i++){
			if(runnaway_list[i].eaten==1&&runnaway_list[i].x==hero.x && runnaway_list[i].y==hero.y-20) {runnaway_list[i].eaten=0;winning--;
				
				if(winning==0) alert("you win!");
				break;}
		}
		  if(hero.y+10>hero.speed&&((memory[hero.x/20][(hero.y/20)-1])==0)){
		  hero.moveUp();}
		  break;
		 case 68:
		 for(var i=0; i<ghost_list.length; i++){
			if(ghost_list[i].x==hero.x+20 && ghost_list[i].y==hero.y) {alert("game over!"); break;}
		}
		for(var i=0; i<runnaway_list.length; i++){
			if(runnaway_list[i].eaten==1&&runnaway_list[i].x==hero.x+20 && runnaway_list[i].y==hero.y) {runnaway_list[i].eaten=0;winning--;
				
				if(winning==0) alert("you win!");
				break;}
		}
		  if(hero.x+30<canvas1.width&&((memory[hero.x/20+1][hero.y/20])==0)){
		  hero.moveRight();}
		  break;
		 case 83:
		 for(var i=0; i<ghost_list.length; i++){
			if(ghost_list[i].x==hero.x && ghost_list[i].y==hero.y+20) {alert("game over!"); break;}
		}
		for(var i=0; i<runnaway_list.length; i++){
			if(runnaway_list[i].eaten==1&&runnaway_list[i].x==hero.x && runnaway_list[i].y==hero.y+20) {runnaway_list[i].eaten=0;winning--;
				
				if(winning==0) alert("you win!");
				break;}
		}
		  if(hero.y+30<canvas1.height&&((memory[hero.x/20][(hero.y/20)+1])==0)){
		  hero.moveDown();}
		  break;
		 case 65:
		 for(var i=0; i<ghost_list.length; i++){
			if(ghost_list[i].x==hero.x-20 && ghost_list[i].y==hero.y) {alert("game over!"); break;}
		}
		for(var i=0; i<runnaway_list.length; i++){
			if(runnaway_list[i].eaten==1&&runnaway_list[i].x==hero.x-20 && runnaway_list[i].y==hero.y) {runnaway_list[i].eaten=0; winning--;
				
				if(winning==0) alert("you win!");
				break;}
		}
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
		 case 79:
		  window.webkitRequestFileSystem(window.TEMPORARY, 1024*1024, function(fs) {
        fs.root.getFile('map.bin', {create: true}, function(fileEntry) {
            fileEntry.createWriter(function(fileWriter) {
            	var w= canvas1.width/20;
            	var h= canvas1.height/20;
                var arr = new Uint8Array(w*h+1);
                var counter= 0;
                for(var j=0; j<w; j++){
	             for(var k=0; k<h; k++){
	             //right column by row, i.e. x by y
	 	         arr[counter]= (memory[j][k]+48);
	 	         counter++;
	 }
	}
           	    //last digit of map is the color
	            arr[counter]= (color+48);
                var blob = new Blob([arr]);
    
                fileWriter.addEventListener("writeend", function() {
                    // navigate to file, will download
                    location.href = fileEntry.toURL();
                }, false);
    
                fileWriter.write(blob);
            }, function() {});
        }, function() {});
    }, function() {});
		 break;
		// case 80:
		
		// break;
		 case 27:
		  range=prompt("Please enter the range:","default is 5");
		  window.alert("The range has been updated to "+range+" !");
		  break;
		  }
		 drawGhost(ghost_list, runnaway_list, hero);
		
	}
		
</script>

<p><strong>Set</strong> the hunter range K= (if the ghost's distance is within K blocks of that is Pacman, he will hunt Pacman.) by hitting "ESC" button<br>
<strong>Color</strong> wall differently by pressing 0,1,..7.<br>
<strong>Save</strong> current map by hitting "o". <strong>Upload</strong> map here: <input type="file" id="fileinput"/> </p>
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

