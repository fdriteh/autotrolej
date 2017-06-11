<?php
	session_start();

	include 'includes/connection.php';
	include 'includes/functions.php';

	$con = new mysqli($host, $username, $password, $db);

	$logged1 = !empty($_SESSION['logged1']) ? $_SESSION['logged1'] : '';
	$ime = !empty($_SESSION['ime']) ? $_SESSION['ime'] : '';
	$email = $_SESSION['email'];
	$k = !empty($_GET['k']) ? $_GET['k'] : '';

	$result = $con->query("SELECT * FROM korisnik k JOIN transakcija t on k.id = t.idkorisnik WHERE email='$email' AND kartica=0 ORDER BY t.datum DESC, t.id DESC");
	$result2 = $con->query("SELECT * FROM korisnik k JOIN transakcija t on k.id = t.idkorisnik WHERE email='$email' AND kartica=1 ORDER BY t.datum DESC, t.id DESC");
?>

<!DOCTYPE html>
<html>
<head>
	<title>Osobni podaci</title>

	<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="autotrolej.css">
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
		if($k == 'j') {
			echo "<div class='lijevi2'>";
				echo "<br><br><br><br>";
				echo "<p>";
				echo "<span style='padding-left:250px;'><a href='pregled_karata.php?k=j'><button>Jednodnevne</button></a></span><br><br>";
				echo "<span style='padding-left:285px;'><a href='pregled_karata.php?k=m'><button>Mjesecne</button></a></span>";
				echo "</p>"; 
		  	echo "</div>";
		  	echo "<div class='desni2'>";
		  	echo "<p>";
		  	echo "<table border='0' class=\"pregled\"><br><br>";
		  	echo "<tr><th>Datum</th><th>Kod</th><th>Zona</th><th>Cijena</th></tr>";
				$i = true;
		  	while ($row = $result->fetch_array()) {
		  		echo "<tr class=\"".(($i=!$i) ? "even" : "odd")."\"><td>".$row['datum']."</td><td>".$row['QR']."</td><td>".$row['zona']."</td><td>".$row['cijena']."</td></tr>";
		  	}
		  	echo "</table>";
		  	echo "</p>";
		  	echo "</div>";
		} else if($k == 'm') {
			echo "<div class='lijevi2'>";
				echo "<br><br><br><br>";
				echo "<p>";
				echo "<span style='padding-left:250px;'><a href='pregled_karata.php?k=j'><button>Jednodnevne</button></a></span><br><br>";
				echo "<span style='padding-left:285px;'><a href='pregled_karata.php?k=m'><button>Mjesecne</button></a></span>";
				echo "</p>"; 
		  	echo "</div>";
		  	echo "<div class='desni2'>";
		  	echo "<table border='0' class=\"pregled\"><br><br>";
		  	echo "<tr><th>Datum</th><th>Zona</th><th>Cijena</th></tr>";
				$i = true;
		  	while ($row2 = $result2->fetch_array()) {
		  		echo "<tr class=\"".(($i=!$i) ? "even" : "odd")."\"><td>".$row2['datum']."</td><td>".$row2['zona']."</td><td>".$row2['cijena']."</td></tr>";
		  	}
		  	echo "</table>";
		  	echo "</div>";
		} else {
			echo "<div class='lijevi2'>";
				echo "<br><br><br><br>";
				echo "<p>";
				echo "<span style='padding-left:250px;'><a href='pregled_karata.php?k=j'><button>Jednodnevne</button></a></span><br><br>";
				echo "<span style='padding-left:285px;'><a href='pregled_karata.php?k=m'><button>Mjesecne</button></a></span>";
				echo "</p>"; 
		  	echo "</div>";
		  	echo "<div class='desni2'>";
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
