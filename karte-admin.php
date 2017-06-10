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

	//dio koda zadužen za dodavanje nove karte u bazu -- u funkciji rj
	if(!empty($_POST['naziv']) && !empty($_POST["cijena"])){
		$sql = "INSERT INTO Karta VALUES(NULL,'".$_POST['naziv'].
			"','".$_POST['cijena']."')";
		if($conn->query($sql)== true) alert("Karta je dodana.", "/admin.php");
		else alert("Karta nije mogla biti dodana.", "/admin.php");
	}

	if(!empty($_GET['delete']))
	{
		$sql = "DELETE FROM `Karta` WHERE `id_Karta` = '".$_GET['delete']."'";
		if($conn->query($sql) == true) alert("Karta je izbrisana.", "/admin.php");
		else alert("Karta nije mogla biti izbrisana.", "/admin.php");
	}

?>

