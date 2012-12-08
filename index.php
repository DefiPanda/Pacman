<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<script type="text/javascript" src="jquery-1.3.2-vsdoc2.js"></script>
</head>
<body>
	<form method="POST" action="game.php">
	<input type="text" id="level_one_random" name="level_one_random">Enter # of random ghost at level one (MAX=10)<br>
	<input type="text" id="level_one_attacking" name="level_one_attacking">Enter # of attacking ghost at level one(MAX=10)<br>
	<input type="text" id="level_one_range" name="level_one_range">Enter # of grid that attacking ghost can see you at level one(MAX=5)<br>
	<input type="text" id="level_one_chase" name="level_one_chase">Enter # of things to chase at level one(MAX=20)<br>
		<input type="text" id="level_two_random" name="level_two_random">Enter # of random ghost at level two (MAX=10)<br>
	<input type="text" id="level_two_attacking" name="level_two_attacking">Enter # of attacking ghost at level two(MAX=10)<br>
	<input type="text" id="level_two_range" name="level_two_range">Enter # of grid that attacking ghost can see you at level two(MAX=10)<br>
	<input type="text" id="level_two_chase" name="level_two_chase">Enter # of things to chase at level two(MAX=20)<br>
		<input type="text" id="level_three_random" name="level_three_random">Enter # of random ghost at level three (MAX=10)<br>
	<input type="text" id="level_three_attacking" name="level_three_attacking">Enter # of attacking ghost at level three(MAX=10)<br>
	<input type="text" id="level_three_range" name="level_three_range">Enter # of grid that attacking ghost can see you at level three(MAX=15)<br>
	<input type="text" id="level_three_chase" name="level_three_chase">Enter # of things to chase at level three(MAX=20)<br><br>
	<input type="submit" id="submit" value="start game">
	</form>
<br><br><br><br><a href="make_map.php" id="make_map">Click here to make map!!!</div>

	
</body>
</html>

