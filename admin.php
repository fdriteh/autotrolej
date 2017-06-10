<?php
		include("karte-admin.php");
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
				<li><a href="kupnja.html">Kupnja karta</a></li>
			</ul>
			<ul class="nav navbar-nav navbar-right">
				
				<li><a href="#"><i class="fa fa-user" aria-hidden="true"></i>
	 Admin</a></li>
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
																			<td><button >Izbriši</button></td></tr>";
														}
											} 
											else echo "0 results" 
								?>
						</table>
						
						<button id = "dodaj-btn" class="btn btn-primary" onClick = "dodaj_kartu()">Dodaj kartu</button>
										
						<div id = "dodaj" style = "visibility : hidden;">
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
