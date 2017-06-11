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

	$logged1 = !empty($_SESSION['logged1']) ? $_SESSION['logged1'] : '';
	$ime = !empty($_SESSION['ime']) ? $_SESSION['ime'] : '';
?>
<!DOCTYPE html>
<html>
<head>
	<title>Autotrolej</title>

	<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="admin.css">
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
				<a href="/" class="navbar-brand">Naslovna</a>
			</div>
			  <div class="collapse navbar-collapse" id="bs-nav-demo">
			<ul class="nav navbar-nav">
				<li><a href="#">Raspored</a></li>
				<li><a href="#">Planiranje puta</a></li>
				<li><a href="kupnja.php">Kupnja karte</a></li>
				<li><a href="admin.php">Administracija</a></li>
			</ul>
			<ul class="nav navbar-nav navbar-right">
			<?php
				echo "<li class='dropdown'><a class='dropdown-toggle' data-toggle='dropdown' href='#''><i class='fa fa-user' aria-hidden='true'></i> Korisnik: ".$ime."<span class='caret'></span></a><ul class='dropdown-menu'><li><a href='user_page.php'>Osobni podaci</a></li><li><a href='#'>Favoriti</a></li><li><a href='#'>Kupljene karte</a></li></ul></li>";
				echo "<li><a href='logout.php'><i class='fa fa-power-off' aria-hidden='true'></i> Logout</a></li>";
			?>
			</ul>
			</div>
		</div>
	</nav>

		 	<div class="container-fluid main-container">
  		<div class="col-md-2 sidebar">
  			<div class="row">
	<!-- uncomment code for absolute positioning tweek see top comment in css -->
	<div class="absolute-wrapper"> </div>
	<!-- Menu -->
	<div class="side-menu">
		<nav class="navbar navbar-default" role="navigation">
			<!-- Main Menu -->
			<div class="side-menu-container">
				<ul class="nav navbar-nav">

					<li class="active"><a href="#" id="oglasavanje"><span class="glyphicon glyphicon-dashboard"></span>Oglašavanje i obavijesti</a></li>


					<li><a href="#"  id="uprlinije"><i class="fa fa-bus" aria-hidden="true"></i> Upravljanje linijama</a></li>


					<li><a href="#"  id="uprkartama"><i class="fa fa-ticket" aria-hidden="true"></i> Upravljanje kartama</a></li>


					<li><a href="#"  id="regkorisnici"><i class="fa fa-user-circle-o" aria-hidden="true"></i>
						 Registriran korisnici</a></li>


					<li><a href="#"  id="pregled"><span class="glyphicon glyphicon-signal"></span> Pregled poslovanja</a></li>

				</ul>
			</div><!-- /.navbar-collapse -->
		</nav>

	</div>
</div>
</div>

<div class="col-md-10 content">


	 <div class="panel panel-default" id="obavijest">
		<div class="panel-heading" >
			Nova obavijest
		</div>
			<form method = "POST" action = "add-info.php"  enctype="multipart/form-data">
				<div class="panel-body">
						Naslov:<br>
						<input type = "text" name = "title"> <br>
						Tekst objave:
						<textarea name = "info-txt" cols = "80" rows = "20">

						</textarea>
						<input type="file" name="file" id="fileToUpload" accept="application/pdf">
				</div>
				<input type = "submit" class="btn btn-primary" value = "Objavi">
			</form>
	</div>


	 <div class="panel panel-default" id="linije">
		<div class="panel-heading" >
			Upravljanje linijama
		</div>

				<div class="panel-body">
						UPRAVLJANJE LINIJAMA
						<?php
							$sql = "SELECT `Linija`.`id` AS `id_linija`, `br`, `naziv_pol`, `naziv_odr` FROM Linija LEFT JOIN (
								SELECT `id`, `naziv` AS `naziv_pol` FROM `Stanica`
							) AS `x` ON `id_stanica_pol`=`x`.`id` LEFT JOIN (
								SELECT `id`, `naziv` AS `naziv_odr` FROM `Stanica`
							) AS `y` ON `id_stanica_odr`=`y`.`id`";
							$result = $conn->query($sql);
							if ($result->num_rows > 0) {
								echo "<table width=\"80%\"><tr><th>Broj</th><th>Polazište</th><th>Povratište</th></tr>";
								while($row = $result->fetch_assoc()) {
									echo "<tr>".
										"<td>".$row['br']."</td>".
										"<td>".$row['naziv_pol']."</td>".
										"<td>".$row['naziv_odr']."</td>".
										"<td><button onclick=\"brisi_liniju(".$row['id_linija'].")\">Izbriši</button></td>".
										"</tr>";
									}
								echo "</table>";
							}
							else echo "0 results"
						?>
					<p>&nbsp;</p>
					<?php
						$sql = "SELECT `id`, `naziv` FROM `Stanica`";
						$result = $conn->query($sql);
						if ($result->num_rows > 0) {
							$stanice = array();
							while($row = $result->fetch_assoc())
								$stanice[$row['id']] = $row['naziv'];
					?>
					<div id = "dodaj-liniju">
							<form method = "POST" action = "linije-admin.php">
								Prva stanica:
								<select name="id_stanica_pol">
								<?php
									foreach ($stanice as $id=>$naziv)
										echo "<option value=\"$id\">$naziv</option>";
								?>
								</select>
								Zadnja stanica:
								<select name="id_stanica_odr">
								<?php
									foreach ($stanice as $id=>$naziv)
										echo "<option value=\"$id\">$naziv</option>";
								?>
								</select>
								Broj linije:
								<input type = "text" name = "br">
								<input type = "submit" class="btn btn-primary" value = "Dodaj" style = "margin : 0;">
							</form>
					</div>
					<?php
						}
					?>
				</div>

	</div>



	 <div class="panel panel-default" id="karte">
		<div class="panel-heading" >
			Upravljanje kartama
		</div>

				<div class="panel-body">
						<table  width = 80%>
								<tr><th>Naziv</th><th>Cijena (Kuna)</th></tr>
								<?php
											$sql = "SELECT *  FROM Karta";
											$result = $conn->query($sql);
											if ($result->num_rows > 0) {
												while($row = $result->fetch_assoc()) {
														echo "<tr><td>".$row['Naziv']."</td><td>"
																			.$row['Cijena']."</td>
																			<td><button onclick=\"brisi_kartu(".$row['id_Karta'].")\">Izbriši</button></td></tr>";
														}
											}
											else echo "0 results"
								?>
						</table>
						<p>&nbsp;</p>
						<div id = "dodaj-kartu">
								<form method = "POST" action = "karte-admin.php">
									Naziv karte:
									<input type = "text" name = "naziv">
									Cijena karte:
									<input type = "text" name = "cijena">
									<input type = "submit" class="btn btn-primary" value = "Dodaj" style = "margin : 0;">
								</form>
						</div>
				</div>

	</div>



	<div class="panel panel-default" id="korisnici">
		<div class="panel-heading" >
			Korisnici
		</div>

				<div class="panel-body">
						UPRAVLJANJE korisnicima, mijenjanje imena, adrese, emaila, broja karte ...
						<?php
							$sql = "SELECT * from `korisnik`";
							$result = $conn->query($sql);
							if ($result->num_rows > 0) {
								echo "<table width=\"80%\"><tr><th>Email</th><th>Prezime</th><th>Ime</th><th>Adresa</th><th>Telefon</th></tr>";
								while($row = $result->fetch_assoc()) {
									$id = $row['id'];
									echo "<tr>".
										"<td id=\"email-$id\">".$row['email']."</td>".
										"<td id=\"prezime-$id\">".$row['prezime']."</td>".
										"<td id=\"ime-$id\">".$row['ime']."</td>".
										"<td id=\"adresa-$id\">".$row['adresa']."</td>".
										"<td id=\"telefon-$id\">".$row['telefon']."</td>".
										"<td><button onclick=\"izmijeni_korisnika($id)\">Izmijeni</button></td>";
									if($row['id'] != $_SESSION['logged1'])
										echo "<td><button onclick=\"brisi_korisnika($id)\">Izbriši</button></td>";
									echo "</tr>";
									}
								echo "</table>";
						?>
						<p>&nbsp;</p>
						<div id="izmijeni-korisnika" style="display: none">
							<form method="POST" action="korisnici-admin.php">
								<table>
									<tr>
										<td>Email:</td>
										<td><input type="text" name="email"></td>
									</tr>
									<tr>
										<td>Prezime:</td>
										<td><input type="text" name="prezime"></td>
									</tr>
									<tr>
										<td>Ime:</td>
										<td><input type="text" name="ime"></td>
									</tr>
									<tr>
										<td>Adresa:</td>
										<td><input type="text" name="adresa"></td>
									</tr>
									<tr>
										<td>Telefon:</td>
										<td><input type="text" name="telefon"></td>
									</tr>
									<tr>
										<td>Lozinka:</td>
										<td><input type="password" name="lozinka"></td>
									</tr>
									<tr>
										<td><input type="submit" class="btn btn-primary" value="Izmijeni" style="margin:0;"> <input type="reset" class="btn btn-primary" value="Poništi" style="margin:0;" onclick="document.getElementById('izmijeni-korisnika').style.display = 'none';"></td>
									</tr>
								</table>
								<input type="hidden" name="id" value="">
							</form>
						</div>
						<?php
							}
							else echo "0 results"
						?>
				</div>
	</div>

	<div class="panel panel-default" id="poslovanje">
		<div class="panel-heading" >
			Poslovanje
		</div>

				<div class="panel-body">
						<table width = 80%>
							<tr><th>ID</th><th>Cijena</th></tr>
								<?php
											$sql = "SELECT *  FROM transakcija";
											$result = $conn->query($sql);
											if ($result->num_rows > 0) {
												while($row = $result->fetch_assoc()) {
														echo "<tr><td>".$row['id']."</td><td>"
																			.$row['cijena']."</td></tr>";
														}
											}
											else echo "0 results"
								?>

						</table>
				</div>
	</div>






	</div>





  	</div>
	<script
	  src="https://code.jquery.com/jquery-2.2.4.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="admin.js"></script>
</body>
</html>
