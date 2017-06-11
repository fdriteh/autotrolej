<?php
	session_start();
	
	include 'includes/connection.php';
	include 'includes/functions.php';

	$con = new mysqli($host, $username, $password, $db);

	$email = $_SESSION['email'];
	$kartica = random_kartica();

	$result = $con->query("SELECT * FROM korisnik WHERE email='$email'");
	$row = $result->fetch_array();
	$id = $row['id'];
	$result = $con->query("INSERT INTO kartica(brojkartice,idkorisnik) VALUES('$kartica','$id')");
	
	mysqli_close($con);

	$message = "Uspješno ste izradili karticu!";	
	$location = "user_page.php";
	alert($message, $location);
?>
