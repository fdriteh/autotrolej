<?php
	$server = "localhost";
	$username = "root";
	$password = "";//promijeniti
	$db = "autotrolej";
	
	$conn = new mysqli($server,$username,$password,$db);
	$conn->query('SET NAMES utf8');
	if ($conn->connect_error) {
		echo ("Connection failed: " . $conn->connect_error);
	}else{
		//echo "Connected successfully";
	}
	

?>
