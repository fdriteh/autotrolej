<?php
	session_start();

	include 'includes/connection.php';
	include 'includes/functions.php';

	$con = new mysqli($host, $username, $password, $db);

	$odabir = !empty($_GET['odabir']) ? $_GET['odabir'] : '';
	$kod = !empty($_SESSION['kod']) ? $_SESSION['kod'] : '';
?>

<html>
<head>
	<title>Registracija</title>

	<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="registracija.css">
	<link href="https://fonts.googleapis.com/css?family=Ubuntu" rel="stylesheet">
</head>
<body>

<script src="https://use.fontawesome.com/20310a0453.js"></script>
	<nav class="navbar navbar-inverse navbar-fixed-top">
		<div class="container">
			<div class="navbar-header">
			   <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-nav-demo" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
				<a href="autotrolej.php" class="navbar-brand">Naslovna</a>
			</div>
			  <div class="collapse navbar-collapse" id="bs-nav-demo">
			<ul class="nav navbar-nav">
				<li><a href="#">Raspored</a></li>
				<li><a href="#">Planiranje puta</a></li>
				<li><a href="kupnja.php">Kupnja karte</a></li>
			</ul>
			<ul class="nav navbar-nav navbar-right">
				<li><a href="registracija.php"><i class="fa fa-user-plus" aria-hidden="true"></i> Registracija</a></li>
				<li><a href="login.php"><i class="fa fa-user" aria-hidden="true"></i>
	 Login</a></li>
			</ul>
			</div>
		</div> 
	</nav>

	<div class="container forma">	
			
		<?php
			if(!$odabir) {
				echo "
				<form action='registracija.php' method='GET'>

					<div class='form-group'>
						<label for='odabir'>Imam karticu</label>
				   		<input type='radio' class='form-control' value='da' name ='odabir' id='odabir'>
					</div> 
					<div class='form-group'>
						<label for='odabir'>Nemam karticu</label>
				   		<input type='radio' class='form-control' value='ne' name='odabir' id='odabir'>
					</div>
					<button type='submit' class='btn btn-default ostalo'>Potvrdi</button>

				</form>";
			} else if ($odabir == 'ne') {
				echo "
				<form action='potvrda_registracije.php' method='POST'>

				<div class='form-group'>
					<label for='ime'>Ime</label>
			    	<input type='text' class='form-control' id='ime' name='ime' placeholder='Ime' required>
				</div>
				<div class='form-group'>
				    <label for='Prezime'>Prezime</label>
				    <input type='text' class='form-control' id='Prezime' name='prezime' placeholder='Prezime' required>
				</div>
				<div class='form-group'>
					<label for='adresa'>Adresa stanovanja</label>
			    	<input type='text' class='form-control' id='adresa' name='adresa' placeholder='Adresa stanovanja' required>
				</div>
				<div class='form-group'>
					<label for='telefon'>Broj telefona</label>
			    	<input type='number' class='form-control' id='telefon' name='telefon' placeholder='Broj telefona' required>
				</div>
				<div class='form-group'>
				    <label for='exampleInputEmail1'>Email address</label>
				    <input type='email' class='form-control' id='exampleInputEmail1' name='email' placeholder='example@gmail.com' required>
				</div>
				<div class='form-group'>
				    <label for='exampleInputPassword1'>Lozinka</label>
				    <input type='password' class='form-control' id='exampleInputPassword1' name='password1' placeholder='**********' required>
				</div>
				<div class='form-group'>
				    <label for='exampleInputPassword2'>Ponovi lozinku</label>
				    <input type='password' class='form-control' id='exampleInputPassword2' name='password2' placeholder='**********' required>
				</div>
					<button type='submit' class='btn btn-default ostalo'>Potvrdi registraciju</button>

				</form>";
			} else if ($odabir == 'da') {
				echo "
				<form action='potvrda_registracije.php' method='POST'>

				<div class='form-group'>
					<label for='kartica'>Broj kartice</label>
			    	<input type='text' class='form-control' id='kartica' name='kartica' placeholder='XXXX XXXX XXXX XXXX' required>
				</div>
					<button type='submit' class='btn btn-default ostalo'>Potvrdi</button>

				</form>";
			} else if ($odabir == 'kod') {
				echo "
				<form action='potvrda_koda.php' method='POST'>

				<div class='form-group'>
					<label for='kod'>Kod za registraciju</label>
			    	<input type='text' class='form-control' id='kod' name='kod' placeholder='XXXX' required>
				</div>
					<button type='submit' class='btn btn-default ostalo'>Potvrdi</button>

				</form>";
			} else {
				$result = $con->query("SELECT * FROM privremeni where kod='$kod'");
				$row = $result->fetch_array();

				echo "
				<form action='potvrda_registracije.php' method='POST'>

				<div class='form-group'>
					<label for='ime'>Ime</label>
			    	<input type='text' class='form-control' id='ime' name='ime' value='".$row['ime']."' required>
				</div>
				<div class='form-group'>
				    <label for='Prezime'>Prezime</label>
				    <input type='text' class='form-control' id='Prezime' name='prezime' value='".$row['prezime']."' required>
				</div>
				<div class='form-group'>
					<label for='adresa'>Adresa stanovanja</label>
			    	<input type='text' class='form-control' id='adresa' name='adresa' value='".$row['adresa']."' required>
				</div>
				<div class='form-group'>
					<label for='telefon'>Broj telefona</label>
			    	<input type='text' class='form-control' id='telefon' name='telefon' value='".$row['telefon']."' required>
				</div>
				<div class='form-group'>
				    <label for='exampleInputEmail1'>Email address</label>
				    <input type='email' class='form-control' id='exampleInputEmail1' name='email' value='".$row['email']."' required>
				</div>
				<div class='form-group'>
				    <label for='exampleInputPassword1'>Lozinka</label>
				    <input type='password' class='form-control' id='exampleInputPassword1' name='password1' required>
				</div>
				<div class='form-group'>
				    <label for='exampleInputPassword2'>Ponovi lozinku</label>
				    <input type='password' class='form-control' id='exampleInputPassword2' name='password2' required>
				    <input type='hidden' name='brojkartice' value='".$row['brojkartice']."'>
				</div>
					<button type='submit' class='btn btn-default ostalo'>Potvrdi registraciju</button>

				</form>";
			}
		?>
		
		
	</div>
	<script
	  src="https://code.jquery.com/jquery-2.2.4.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</body>
</html>
