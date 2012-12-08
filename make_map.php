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
   
	var color=0;
	var canvas1=document.getElementById("tankMap");
	var cxt=canvas1.getContext("2d");
  
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

<br><br><strong>Save</strong> current map by hitting "o". 
</body>
</html>

