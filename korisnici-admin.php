<?php
	session_start();
	if(!$_SESSION['is_admin'])
		header('Location: /');

	include 'includes/connection.php';
	include 'includes/functions.php';

	$conn = new mysqli($host, $username, $password, $db);
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}

	if(!empty($_GET['delete']))
	{
		$sql = "DELETE FROM `korisnik` WHERE `id` = '".$_GET['delete']."'";
		if($_GET['delete'] != $_SESSION['logged1'] && $conn->query($sql) == true) alert("Korisnik je izbrisan.", "/admin.php");
		else alert("Korisnik nije mogao biti izbrisan.", "/admin.php");
	}
	else if(!empty($_POST['id'])
			&& !empty($_POST['email'])
			&& !empty($_POST['prezime'])
			&& !empty($_POST['ime'])
			&& !empty($_POST['adresa'])
			&& !empty($_POST['telefon']))
	{
		$sql = "UPDATE `korisnik` SET".
		 "`email`='".$_POST['email']."','".
		 "`prezime`='".$_POST['prezime']."','".
		 "`ime`='".$_POST['ime']."','".
		 "`adresa`='".$_POST['adresa']."','".
		 "`telefon`='".$_POST['telefon']."')";
		if($conn->query($sql)== true) alert("Podatci o korisniku su izmijenjeni.", "/admin.php");
		else alert("Podatci o korisniku nisu mogli biti izmijenjeni.", "/admin.php");
	}
	else alert("Podatci su nepotpuni. Promjena nije izvršena.", "/admin.php");

?>

