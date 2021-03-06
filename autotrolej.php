<?php
	session_start();

	$logged1 = !empty($_SESSION['logged1']) ? $_SESSION['logged1'] : '';
	$ime = !empty($_SESSION['ime']) ? $_SESSION['ime'] : '';
?>

<!DOCTYPE html>
<html>
<head>
	<title>Autotrolej</title>

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


	<div class="jumbotron">
 		<div class="container">
		  <h1>Dobro došli!</h1>
		  <?php
		  	if(!$logged1) {
		  		echo "<p>Na našoj stranici možete pratiti autobuse, planirati put, kupovati karte...</p>";
		  		echo "<p><a class='btn btn-primary btn-lg' href='login.php' role='button'>Login</a></p>";
		  	} else {
		  		echo "<p>Na našoj stranici možete pratiti autobuse, planirati put, kupovati karte...</p>";
		  	}
		  ?>
  		</div>
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
