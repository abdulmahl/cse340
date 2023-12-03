<?php 
    
    $lastNames = array("Smith", "Ley", "Day");
    $pets = array("cat", "dog", "iguana");
    $numbers = array(33, 56, $pets);

	echo 
	"
		<br>
		<center>
			<h1>Hello, Mr $lastNames[0], you own pet $pets[2]</h1>
		</center>
	";
?> 