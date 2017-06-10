<?php
	session_start();

	include 'includes/connection.php';
	include 'includes/functions.php';

	$con = new mysqli($host, $username, $password, $db);

	$ime = !empty($_POST['ime']) ? $_POST['ime'] : '';
	$prezime = !empty($_POST['prezime']) ? $_POST['prezime'] : '';
	$adresa = !empty($_POST['adresa']) ? $_POST['adresa'] : '';
	$telefon = !empty($_POST['telefon']) ? $_POST['telefon'] : '';
	$email = !empty($_POST['email']) ? $_POST['email'] : '';
	$password1 = !empty($_POST['password1']) ? $_POST['password1'] : '';
	$password2 = !empty($_POST['password2']) ? $_POST['password2'] : '';
	$kartica = !empty($_POST['kartica']) ? $_POST['kartica'] : '';
	$brojkartice = !empty($_POST['brojkartice']) ? $_POST['brojkartice'] : '';
	$kod = !empty($_POST['kod']) ? $_POST['kod'] : '';

	$result = $con->query("SELECT * FROM korisnik where email='$email'");
 	$numrows = $result->num_rows;

 	$result = $con->query("SELECT * FROM privremeni where brojkartice='$kartica'");
 	$row = $result->fetch_array();

 	if($kartica) {
 		if($row) {
	 		$broj = mt_rand(1234,9876);

	 		$address = $row['email'];
			$subject = 'Kod za registraciju';
			$message = "Poštovani ".$row['ime']." ".$row['prezime'].", Vaš kod za registraciju je ".$broj."."; 
			$message2 = "Poštovani poslan vam je kod za nastavak registracije na vaš email.";
			$location = "registracija.php?odabir=kod";

			$result = $con->query("UPDATE privremeni SET kod = '$broj' where brojkartice='$kartica'");
			poruka($address,$subject,$message);
			
			alert($message2, $location);
		} else {
			$result = $con->query("SELECT * FROM privremeni where kod='$kod'");
			$row = $result->fetch_array();
			$message = "Poštovani, niste upisali ispravan broj kartice!";
	 		$location = "registracija.php?odabir=da";
	 		alert($message, $location);
		}
 	} else {
	 	if($numrows) {
	 		$message = "Poštovani,korisnik s upisanim email-om već postoji!";
	 		$location = "registracija.php?odabir=ne";
	 		alert($message, $location);
	 	} else if($password1 != $password2) {
	 		$message = "Poštovani, lozinke se ne podudaraju";
	 		$location = "registracija.php?odabir=ne";
	 		alert($message, $location);
	 	} else {
			$password_hash = password_hash($password1, PASSWORD_DEFAULT);
	 		$result = $con->query("INSERT INTO korisnik(ime,prezime,adresa,telefon,email,lozinka) VALUES ('$ime','$prezime','$adresa','$telefon','$email','$password_hash')");
	 		$result2 = $con->query("SELECT * FROM korisnik WHERE email = '$email' ");
	 		$row2 = $result2->fetch_array();
	 		$id = $row2['id'];
	 		$result = $con->query("INSERT INTO kartica(brojkartice,idkorisnik) VALUES('$brojkartice','$id')");
	 		$result5 = $con->query("DELETE FROM privremeni WHERE brojkartice = '$brojkartice'");

	 		$message = "Registracija uspješna!";
	 		$location = "login.php";
	 		alert($message, $location);

			//header("Location: autotrolej.php");	
	 	}
	}
 	mysqli_close($con);
?>
