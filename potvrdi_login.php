<?php 
	session_start();

	include 'includes/connection.php';
	include 'includes/functions.php';

	$con = new mysqli($host, $username, $password, $db);

	$email = !empty($_POST['email']) ? $_POST['email'] : '';
	$password = !empty($_POST['password']) ? $_POST['password'] : '';

	$result = $con->query("SELECT * FROM `korisnik` LEFT JOIN (SELECT `id_korisnik` as `is_admin` FROM `Administrator`) AS `x` ON `id`=`is_admin` where `email`='$email'");
	$numrows = $result->num_rows;

	if($numrows)
		$row = $result->fetch_array();

	if($numrows && password_verify($password, $row['lozinka'])) {
		$_SESSION['logged1'] = TRUE;
		$_SESSION['email'] = $email;
 		$_SESSION['ime'] = $row['ime'];
		if($row['is_admin'])
			$_SESSION['is_admin'] = true;
		else
			$_SESSION['is_admin'] = false;
 		mysqli_close($con);
 		header("Location: autotrolej.php");
	} else {
		$message = "Poštovani, upisali ste neispravne podatke, pokušajte ponovo.";
		$location = "login.php";
		alert($message, $location);
	}
?>
