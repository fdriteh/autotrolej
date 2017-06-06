<?php
	session_start();

	include 'includes/connection.php';
	include 'includes/functions.php';

	$con = new mysqli($host, $username, $password, $db);

	$kod = !empty($_POST['kod']) ? $_POST['kod'] : '';

	$result = $con->query("SELECT * FROM privremeni where kod='$kod'");
	$row = $result->fetch_array();

	if($row) {
		$_SESSION['kod'] = $kod;
		header("Location: registracija.php?odabir=loz");
	} else {
		$message = "Poštovani upisali ste pogrešan kod, pokušajte ponovo.";
		$location = "registracija.php?odabir=kod";
		alert($message, $location);
	}
?>