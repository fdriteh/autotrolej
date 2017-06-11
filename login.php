<html>
<head>
	<title>Login</title>

	<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="/css/registracija.css">
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
				<li><a href="#"><i class="fa fa-user" aria-hidden="true"></i>
	 Login</a></li>
			</ul>
			</div>
		</div> 
	</nav>

	<div class="container forma">	
			
		<?php
			echo "
			<form action='potvrdi_login.php' method='POST'>

			<div class='form-group'>
				<label for='exampleInputPassword1'>Email</label>
				<input type='email' class='form-control' id='email' name='email' placeholder='example@gmail.com' required>
			</div>
			<div class='form-group'>
				<label for='exampleInputPassword1'>Lozinka</label>
				<input type='password' class='form-control' id='exampleInputPassword1' name='password' placeholder='**********' required>
			</div>
				<button type='submit' class='btn btn-default ostalo'>Prijavi se</button>

			</form>";
		?>
			
	</div>
	<script
	  src="https://code.jquery.com/jquery-2.2.4.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</body>
</html>
