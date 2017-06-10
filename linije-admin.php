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

	//dio koda zadužen za dodavanje nove linije u bazu -- u funkciji rj
	if(!empty($_POST['id_stanica_pol']) && !empty($_POST['id_stanica_odr']) && !empty($_POST['br'])){
		$sql = "INSERT INTO `Linija` VALUES(NULL,'".
			$_POST['id_stanica_pol']."','".
			$_POST['id_stanica_odr']."','".
			$_POST['br']."')";
		if($conn->query($sql)== true) alert("Linija je dodana.", "/admin.php");
		else alert("Linija nije mogla biti dodana.", "/admin.php");
	}

	if(!empty($_GET['delete']))
	{
		$sql = "DELETE FROM `Linija` WHERE `id` = '".$_GET['delete']."'";
		if($conn->query($sql) == true) alert("Linija je izbrisana.", "/admin.php");
		else alert("Linija nije mogla biti izbrisana.", "/admin.php");
	}

?>

