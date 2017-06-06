<?php
	session_start();

	include 'includes/connection.php';

	$e = !empty($_SESSION['email']) ? $_SESSION['email'] : '';
	$adresa = !empty($_POST['adresa']) ? $_POST['adresa'] : '';
	$telefon = !empty($_POST['telefon']) ? $_POST['telefon'] : '';
	$email = !empty($_POST['email']) ? $_POST['email'] : '';

	$con = new mysqli($host, $username, $password, $db);

	$con->query("UPDATE korisnik SET adresa = '$adresa', telefon = '$telefon' ,email = '$email' WHERE email = '$e' ");

	mysqli_close($con);	
	header("Location: user_page.php");	
?>