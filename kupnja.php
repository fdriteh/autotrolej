<?php
	session_start();

	include 'includes/connection.php';
	include 'includes/functions.php';

	$con = new mysqli($host, $username, $password, $db);

	$logged1 = !empty($_SESSION['logged1']) ? $_SESSION['logged1'] : '';
	$email = !empty($_SESSION['email']) ? $_SESSION['email'] : '';
	$ime = !empty($_SESSION['ime']) ? $_SESSION['ime'] : '';
	$karta = !empty($_POST['karta']) ? $_POST['karta'] : '3';
	if(isset($_POST['email2'])) {
		$_SESSION['email2'] = $_POST['email2'];
	}
	if(isset($_POST['zona'])) {
		$_SESSION['zona'] = $_POST['zona'];
	}
	if(isset($_POST['bool'])) {
		$_SESSION['bool'] = $_POST['bool'];
	}
	$cijena = !empty($_POST['cijena']) ? $_POST['cijena'] : '';
	$metoda = !empty($_POST['metoda']) ? $_POST['metoda'] : '';

	$result = $con->query("SELECT * FROM korisnik k JOIN kartica ka ON k.id=ka.idkorisnik WHERE email = '$email'");
	$row = $result->fetch_array();

	$mjesec_obnove = date("m",strtotime($row['datum_obnove']));
	$mjesec = date("m");
?>
<!DOCTYPE html>
<html>
<head>
	<title>Autotrolej</title>

	<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="kupnja.css">
		<link href="https://fonts.googleapis.com/css?family=Ubuntu" rel="stylesheet">
		
			<script type='text/javascript'>
				function promjena(m) {
					document.getElementById('cijena').innerHTML = 'Cijena: ' + 10*m.value + "kn";
					document.getElementById('hid').value = 10*m.value;
				}

				function promjena2(m) {
					document.getElementById('cijena').innerHTML = 'Cijena: ' + (100+10*m.value) + "kn";
					document.getElementById('hid').value =  100 + 10*m.value;
				}
			</script>
		
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
				<a href="/" class="navbar-brand">Naslovna</a>
			</div>
			  <div class="collapse navbar-collapse" id="bs-nav-demo">
			<ul class="nav navbar-nav">
				<li><a href="#">Raspored</a></li>
				<li><a href="#">Planiranje puta</a></li>
				<li><a href="kupnja.php">Kupnja karta</a></li>
				<?php
					if($_SESSION['is_admin'])
						echo "<li><a href=\"admin.php\">Administracija</a></li>";
				?>
			</ul>
			<ul class="nav navbar-nav navbar-right">
				<?php
					if(!$logged1) {
						echo "<li><a href='registracija.php'><i class='fa fa-user-plus' aria-hidden='true'></i> Registracija</a></li>";
						echo "<li><a href='login.php'><i class='fa fa-user' aria-hidden='true'></i>Login</a></li>";
					} else {
						echo "<li class='dropdown'><a class='dropdown-toggle' data-toggle='dropdown' href='#''><i class='fa fa-user' aria-hidden='true'></i> Korisnik: ".$ime."<span class='caret'></span></a><ul class='dropdown-menu'><li><a href='user_page.php'>Osobni podaci</a></li><li><a href='#'>Favoriti</a></li><li><a href='#'>Kupljene karte</a></li></ul></li>";
						//echo "<li><a href=''><i class='fa fa-user' aria-hidden='true'></i> Korisnik: ".$ime."</a></li>";
						echo "<li><a href='logout.php'><i class='fa fa-power-off' aria-hidden='true'></i> Logout</a></li>";
					}
 				?>
			</ul>
			</div>
		</div> 
	</nav>

	<div class="main">

		<div class="container">

			<div class="row">
			<?php
				if($karta == 1) {	
					echo "<div class='col-lg-4 col-md-6 col-sm-12 ''>";
					echo "</div>";
					echo "<div class='col-lg-4 col-md-6 col-sm-12 kupnja'>";
						echo "<h3>Poštovani, upišite Vašu email adresu:</h3>";
						echo "<p>Na upisanu adresu biti će Vam poslan kod nakon završetka kupnje.</p>";
						echo "<form action='kupnja.php' method='POST'>";
						if(!$logged1) {
							echo "<input type='email' name='email2' required><br><br>";
						} else {
							echo "<input type='email' name='email2' value='".$email."' required><br><br>";
						}
						echo "<input type='hidden' name='karta' value='4'>";
						echo "<button type='submit' class='btn btn-primary'>Nastavi</button>";
						echo "</form>";
					echo "</div>";
				} else if($karta == 2) {
					if(!$logged1) {
						$message = "Poštovani, za nastavak se morate prijaviti u sustav!";
						$location = "login.php";
						alert($message, $location);
					} else {
						if($mjesec_obnove != $mjesec) {
							echo "<div class='col-lg-4 col-md-6 col-sm-12 ''>";
							echo "</div>";
							echo "<div class='col-lg-4 col-md-6 col-sm-12 kupnja'>";
							echo "<p>Odaberite zonu</p>";
							echo "<select name='zona' form='form' onchange='promjena2(this)'>";
	  						echo "<option value='1'>Zona 1.</option>";
	  						echo "<option value='2'>Zona 2.</option>";
	  						echo "<option value='3'>Zona 3.</option>";
							echo "</select>";
							echo "&nbsp;&nbsp;<span id='cijena'>Cijena: 110kn</span>";
							echo "<form action='kupnja.php' method='POST' id='form'>";
							echo "<br><p>Odaberite način plaćanja</p>";
							echo "<img src='visa.png' id='img1' width='50' height='55'>&nbsp;";
							echo "<input type='radio' name='metoda' value='visa' checked><br>";
							echo "<img src='paypal.png' id='img2' width='60' height='60'>&nbsp;";
							echo "<input type='radio' name='metoda' value='paypal'><br><br>";
							echo "<input type='hidden' id='hid' name='cijena' value='110'>";
							echo "<input type='hidden' name='karta' value='5'>";
							echo "<input type='hidden' name='bool' value='1'>";
							echo "<button type='submit' class='btn btn-primary'>Nastavi</button>";
							echo "</form>";
							echo "</div>";
						}else {
							echo "<div class='col-lg-4 col-md-6 col-sm-12 ''>";
							echo "</div>";
							echo "<div class='col-lg-4 col-md-6 col-sm-12 kupnja'>";
							echo "<h3>Poštovani, kartica Vam je trenutno aktivna.</h3>";
							echo "<form action='user_page.php' method='POST' id='form'>";
							echo "<button type='submit' class='btn btn-primary'>Povratak</button>";
							echo "</form>";
							echo "</div>";	
						} 	
					}
				} else if($karta == 3){
					echo "<div class='col-lg-4 col-md-6 col-sm-12 kupnja'>";
						echo "<h3>Kupnja jednodnevne karte</h3>";
						echo "<p>Svi korisnici mogu kupiti jednodnevnu kartu</p>";
						echo "<form action='kupnja.php' method='POST'>";
						echo "<input type='hidden' name='karta' value='1'>";
						echo "<button type='submit' class='btn btn-primary'>Kupi kartu</button>";
						echo "</form>";
					echo "</div>";
					echo "<div class='col-lg-4 col-md-6 col-sm-12 '>";
					echo "</div>";
					echo "<div class='col-lg-4 col-md-6 col-sm-12 kupnja'>";
						echo "<h3>Produljenje mjesecne karte</h3>";
						echo "<p>Za produljenje mjesecne karte potrebna je registracija ili login</p>";
						echo "<form action='kupnja.php' method='POST'>";
						echo "<input type='hidden' name='karta' value='2'>";
						echo "<button type='submit' class='btn btn-primary'>Produlji kartu</button>";
						echo "</form>";
					echo "</div>";
				} else if ($karta == 4){
					echo "<div class='col-lg-4 col-md-6 col-sm-12 ''>";
					echo "</div>";
					echo "<div class='col-lg-4 col-md-6 col-sm-12 kupnja'>";
						echo "<p>Odaberite kartu</p>";
						echo "<select name='zona' form='form' onchange='promjena(this)'>";
  						echo "<option value='1'>Zona 1.</option>";
  						echo "<option value='2'>Zona 2.</option>";
  						echo "<option value='3'>Zona 3.</option>";
						echo "</select>";
						echo "&nbsp;&nbsp;<span id='cijena'>Cijena: 10kn</span>";
						echo "<form action='kupnja.php' method='POST' id='form'>";
						echo "<br><p>Odaberite način plaćanja</p>";
						echo "<img src='visa.png' id='img1' width='50' height='55'>&nbsp;";
						echo "<input type='radio' name='metoda' value='visa' checked><br>";
						echo "<img src='paypal.png' id='img2' width='60' height='60'>&nbsp;";
						echo "<input type='radio' name='metoda' value='paypal'><br><br>";
						echo "<input type='hidden' id='hid' name='cijena' value='10'>";
						echo "<input type='hidden' name='karta' value='5'>";
						echo "<input type='hidden' name='bool' value='0'>";
						echo "<button type='submit' class='btn btn-primary'>Nastavi</button>";
						echo "</form>";
					echo "</div>";
				} else if ($karta == 5) {
					if($metoda == 'paypal') {
						window('https://www.paypal.com/signin?country.x=HR&locale.x=en_HR');
						header( "refresh:2;kupnja.php" );
					} else {
						echo "<div class='col-lg-4 col-md-6 col-sm-12 ''>";
						echo "</div>";
						echo "<div class='col-lg-4 col-md-6 col-sm-12 kupnja'>";
						echo "<form action='transakcija.php' method='POST'>";
						echo "<br>Broj kartice<br>";
						echo "<input type='text' required><br>";
						echo "Datum isteka<br>";
						echo "<input type='text' value='MM / YY' required><br>";
						echo "CVC<br>";
						echo "<input type='number' required><br><br>";
						echo "Cijena: ".$cijena."kn<br><br>";
						echo "<input type='hidden' name='cijena' value='".$cijena."'>";
						echo "<button type='submit' class='btn btn-primary'>Plati</button>";
						echo "</form>";
						echo "</div>";
					}
				}
			?>
			</div>
		</div>

	</div>

	<script
	  src="https://code.jquery.com/jquery-2.2.4.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</body>
</html>
