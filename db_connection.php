<?php 
	$mysqli = @mysqli_connect('localhost','root','', 'cr10_markus_szokoll_biglibrary');
	if (!$mysqli) {
	   die("Connection failed: " . mysqli_connect_error());
	}
?>