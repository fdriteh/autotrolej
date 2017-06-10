<?php
	session_start();

	include 'includes/connection.php';
	include 'includes/functions.php';

	$conn = new mysqli($host, $username, $password, $db);
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}

	$logged1 = !empty($_SESSION['logged1']) ? $_SESSION['logged1'] : '';
	$ime = !empty($_SESSION['ime']) ? $_SESSION['ime'] : '';

	//dio koda zadužen za dodavanje nove karte u bazu -- u funkciji rj
	if(!empty($_POST['naziv']) && !empty($_POST["cijena"])){
		$sql = "INSERT INTO Karta VALUES(NULL,'".$_POST['naziv'].
			"','".$_POST['cijena']."')";
		if($conn->query($sql)== true) echo "YES";
		else echo "NO";
	}

?>

