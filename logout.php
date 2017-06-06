<?php
	session_start();

	include 'includes/functions.php';

	session_destroy();
	
	$message = "Hvala Vam što koristite naše usluge!";	
	$location = "autotrolej.php";
	alert($message, $location);
?>