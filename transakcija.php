<?php
	session_start();

	include 'includes/connection.php';
	include 'includes/functions.php';

	$con = new mysqli($host, $username, $password, $db);

	$logged1 = !empty($_SESSION['logged1']) ? $_SESSION['logged1'] : '';
	$ime = !empty($_SESSION['ime']) ? $_SESSION['ime'] : '';
	$email2 = !empty($_SESSION['email']) ? $_SESSION['email'] : '';
	$cijena = !empty($_POST['cijena']) ? $_POST['cijena'] : '';
	$bool = !empty($_SESSION['bool']) ? $_SESSION['bool'] : '0';
	$zona = !empty($_SESSION['zona']) ? $_SESSION['zona'] : '';
	$date = date('Y-m-d');
	$QRkod = bin2hex(openssl_random_pseudo_bytes(16));
	$cijena .= "kn";

	$subject = "Kupljena karta";
	$message1 = "POštovani ".$ime.", usješno ste produljili mjesečnu kartu.<br>Detalje o transakciji možete vidjeti na svom osobnom profilu na webu.";
	$message2 = "POštovani ".$ime.", usješno ste kupili jednodnevnu kartu.<br>Vaš kod je:<br><b>".$QRkod."</b>";
	$message3 = "POštovani, usješno ste kupili jednodnevnu kartu.<br>Vaš kod je:<br><b>".$QRkod."</b>";

	if($logged1) {
		$result = $con->query("SELECT * FROM korisnik k JOIN kartica ka ON k.id = ka.idkorisnik WHERE k.email='$email2'");
		$row = $result->fetch_array();
		$id = $row['id'];
		if($bool == 1) {
			$result = $con->query("INSERT INTO transakcija(idkorisnik,kartica,datum,zona,cijena) VALUES('$id','$bool','$date','$zona','$cijena')");
			$result2 = $con->query("UPDATE kartica SET datum_obnove = '$date' WHERE idkorisnik = '$id'");
			poruka($email2,$subject,$message1);
			alert("Poštovani ".$ime.", uspješno ste kupili dnevnu kartu.","autotrolej.php");
		} else {
			$result = $con->query("INSERT INTO transakcija(idkorisnik,kartica,datum,zona,cijena,QR) VALUES('$id','$bool','$date','$zona','$cijena','$QRkod')");
			poruka($email2,$subject,$message2);
			alert("Poštovani ".$ime.", uspješno ste produljili mjesečnu kartu.","autotrolej.php");
		}
	} else {
		poruka($email2,$subject,$message3);
		alert("Poštovani, uspješno ste kupili dnevnu kartu.","autotrolej.php");
	}

	header("Location: autotrolej.php");
?>
