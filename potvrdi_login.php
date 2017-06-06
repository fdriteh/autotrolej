<?php 
	session_start();

	include 'includes/connection.php';
	include 'includes/functions.php';

	$con = new mysqli($host, $username, $password, $db);

	$email = !empty($_POST['email']) ? $_POST['email'] : '';
	$password = !empty($_POST['password']) ? $_POST['password'] : '';

	$result = $con->query("SELECT * FROM korisnik where email='$email' AND lozinka ='$password'");
	$numrows = $result->num_rows;

	if($numrows) {
		$row = $result->fetch_array();
		$_SESSION['logged1'] = TRUE;
		$_SESSION['email'] = $email;
 		$_SESSION['ime'] = $row['ime'];
 		mysqli_close($con);
 		header("Location: autotrolej.php");
	} else {
		$message = "Poštovani, upisali ste neispravne podatke, pokušajte ponovo.";
		$location = "login.php";
		alert($message, $location);
	}
?>
