<?php
	session_start();

	include 'includes/connection.php';
	include 'includes/functions.php';

	$con = new mysqli($host, $username, $password, $db);

	$logged1 = !empty($_SESSION['logged1']) ? $_SESSION['logged1'] : '';
	$ime = !empty($_SESSION['ime']) ? $_SESSION['ime'] : '';
	$email = $_SESSION['email'];
	$i = !empty($_GET['i']) ? $_GET['i'] : '';

	$result = $con->query("SELECT * FROM korisnik WHERE email='$email'");
	$row = $result->fetch_array();

	$result = $con->query("SELECT * FROM korisnik k JOIN kartica ka WHERE k.email='$email' AND ka.idkorisnik = k.id ");
	$row2 = $result->fetch_array();

	$mjesec_obnove = date("m",strtotime($row2['datum_obnove']));
	$godina = date("y",strtotime($row2['datum_obnove']));
	$mjesec = date("m");
	$datum_obnove = date('d-m-Y', strtotime($row2['datum_obnove']));
?>

<!DOCTYPE html>
<html>
<head>
	<title>Osobni podaci</title>

	<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="/css/autotrolej.css">
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
				<?php
					if(!$logged1) {
						echo "<li><a href='registracija.php'><i class='fa fa-user-plus' aria-hidden='true'></i> Registracija</a></li>";
						echo "<li><a href='login.php'><i class='fa fa-user' aria-hidden='true'></i>Login</a></li>";
					} else {
						echo "<li class='dropdown'><a class='dropdown-toggle' data-toggle='dropdown' href='#''><i class='fa fa-user' aria-hidden='true'></i> Korisnik: ".$ime."<span class='caret'></span></a><ul class='dropdown-menu'><li><a href='user_page.php'>Osobni podaci</a></li><li><a href='#'>Favoriti</a></li><li><a href='/pregled_karata.php'>Kupljene karte</a></li></ul></li>";
						//echo "<li><a href=''><i class='fa fa-user' aria-hidden='true'></i> Korisnik: ".$ime."</a></li>";
						echo "<li><a href='logout.php'><i class='fa fa-power-off' aria-hidden='true'></i> Logout</a></li>";
					}
 				?>
			</ul>
			</div>
		</div> 
	</nav>


	<div class="proba">
	<?php 
		if (!$i) {
	 		echo "<div class='lijevi'>";
				echo "<h1>Osobni podaci</h1><br>";
				echo "<p>";
			 	echo "<a href='user_page.php?i=2'><img src='/img/default.gif' width='150' height='150' border='0'></a><br>";
			  	echo $ime."<br>";
			  	echo "<a class='btn btn-primary btn-lg' href='user_page.php?i=1' role='button'>Izmjeni profil</a>";
			  	echo "</p>"; 
	  		echo "</div>";
	  		echo "<div class='desni'>";
	  			echo "<p>";
	  			echo "Ime: ".$row['ime']."<br>";
	  			echo "Prezime: ".$row['prezime']."<br>";
	  			echo "Adresa: ".$row['adresa']."<br>";
	  			echo "Telefon: ".$row['telefon']."<br>";
	  			echo "Email: ".$row['email']."<br>";
	  			if ($row2['brojkartice']) {
		  			echo "Broj kartice: ".$row2['brojkartice']."<br>";
		  			if ($mjesec == $mjesec_obnove) {
		  				echo "Status kartice: <span style='color:green;'><b>Aktivna</b></span><br>";
		  				echo "Datum posljednje obnove: ".$datum_obnove."<br>";
		  			} else if ($godina == 70) {
		  				echo "Status kartice: <span style='color:orange;'><b>Neaktivna</b></span><br>";
		  				echo "<form action='kupnja.php' method='POST'>";
		  				echo "<input type='hidden' name='karta' value='2'>";
		  				nbsp(30);
						echo "<button type='submit' class='btn btn-primary'>Aktiviraj kartu</button>";
						echo "</form>";
		  			} else {
		  				echo "Status kartice: <span style='color:red;'><b>Istekla</b></span><br>";
		  				echo "Datum posljednje obnove: ".$datum_obnove."<br>";
		  				echo "<form action='kupnja.php' method='POST'>";
		  				echo "<input type='hidden' name='karta' value='2'>";
		  				nbsp(30);
						echo "<button type='submit' class='btn btn-primary'>Produlji</button>";
						echo "</form>";
		  			} 
		  		} else {
		  			echo "<br><button><a href='kartica.php'>Izradi karticu</a></button>";
		  		}
	  			echo "</p>";
	  		echo "</div>";
	  	} else if ($i==1) {
	  		echo "<div class='lijevi'>";
				echo "<h1>Osobni podaci</h1><br>";
				echo "<p>";
			 	echo "<a href='autotrolej.php'><img src='/img/default.gif' width='150' height='150' border='0'></a><br>";
			  	echo $ime."<br>";
			  	echo "</p>"; 
	  		echo "</div>";
	  		echo "<div class='desni'>";
	  			echo "<p>";
	  			echo "Ime: ".$row['ime']."<br>";
	  			echo "Prezime: ".$row['prezime']."<br>";
	  			echo "<form action='azuriraj.php' method='POST'>";
	  			echo "Adresa: <input class='crno' type='text' name='adresa' value='".$row['adresa']."' required><br>";
	  			echo "Telefon: <input class='crno' type='text' name='telefon' value='".$row['telefon']."' required><br>";
	  			echo "Email: <input class='crno' type='email' name='email' value='".$row['email']."' required><br><br>";
	  			echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp";
	  			echo "<button type='submit' class='btn btn-primary btn-lg'>Spremi promjene</button>";
	  			echo "</form>";
	  			echo "</p>";
	  		echo "</div>";
	  	} else {
	  		echo "<div class='lijevi'>";
				echo "<h1>Osobni podaci</h1><br>";
				echo "<p>";
			 	echo "<a href='user_page.php?i=2'><img src='/img/default.gif' width='150' height='150' border='0'></a><br>";
			  	echo $ime."<br>";
			  	echo "<a class='btn btn-primary btn-lg' href='user_page.php?i=1' role='button'>Izmjeni profil</a>";
			  	echo "</p>"; 
	  		echo "</div>";
	  		echo "<div class='desni'>";
	  			echo "<p>";
	  			echo "Promjena slike profila<br><br>";
	  			echo "<input type='file' name='slika' value='Odaberi sliku...'>";
	  			echo "</p>";
	  		echo "</div>";
	  	}
	?>
	</div>
	
	<div class="container opis">

		<div class="row">

				<div class="col-lg-4 col-sm-6">
			 		<h3><span class="boja"><i class="fa fa-map-marker" aria-hidden="true"></i></span>
			 		 Lociranje buseva</h3>
			 		 <p>U svakom trenutku saznajte gdje se nalaze naši busevi</p>
				</div>
				<div class="col-lg-4 col-sm-6">
			 		<h3><span class="boja">
			 		 <i class="fa fa-bus" aria-hidden="true"></i></span> Planiranje puta</h3>
			 		 <p>Naš planer puta vam omogućuje da izaberete najbržu rutu od Vašeg mjesta do odredišta</p>
				</div>
				<div class="col-lg-4 col-sm-6">
			 		<h3><span class="boja"><i class="fa fa-list" aria-hidden="true"></i></span> Raspored vožnji</h3>
			 		 <p>Za svaku liniju postoji raspored u koliko busevi voze i koliko je potrebno da dođu do određene stanice</p>
				</div>
				<div class="col-lg-4 col-sm-6">
			 		<h3><span class="boja"><i class="fa fa-ticket" aria-hidden="true"></i></span> Kupnja karte</h3>
			 		 <p>Svim gostima je omogućena jednostavna kupnja jednodnevne karte, a registrirani korisnici mogu produžiti mjesečnu kartu</p>
				</div>
				<div class="col-lg-4 col-sm-6">
			 		<h3><span class="boja"><i class="fa fa-bookmark-o" aria-hidden="true"></i></span> Favoriti</h3>
			 		 <p>Sve linije koje najčešće koristite možete spremiti u favorite i dobivati obavijesti o liniji u slučaju kašnjenja</p>
				</div>
				<div class="col-lg-4 col-sm-6">
			 		<h3><span class="boja"><i class="fa fa-hourglass-end" aria-hidden="true"></i></span> Procjena vremena dolaska</h3>
			 		 <p>U svakom trenutku možete vidjeti u koliko bi bus trebao doći do Vaše stanice</p>
				</div>
			

			</div>

		</div>

	<script
	  src="https://code.jquery.com/jquery-2.2.4.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</body>
</html>
