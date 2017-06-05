<?php 
require 'connect.php';
?>

<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<style>
.dropbtn {
    background-color: #4CAF50;
    color: white;
    padding: 16px;
    font-size: 16px;
    border: none;
    cursor: pointer;
}

/* Dropdown button on hover & focus */
.dropbtn:hover, .dropbtn:focus {
    background-color: #3e8e41;
}

/* The container <div> - needed to position the dropdown content */
.dropdown {
    position: relative;
    display: inline-block;
}

/* Dropdown Content (Hidden by Default) */
.dropdown-content {
    display: none;
    position: absolute;
    background-color: #f9f9f9;
    min-width: 160px;
    box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
    z-index: 1;
}

/* Links inside the dropdown */
.dropdown-content a {
    color: black;
    padding: 12px 16px;
    text-decoration: none;
    display: block;
}

/* Change color of dropdown links on hover */
.dropdown-content a:hover {background-color: #f1f1f1}

/* Show the dropdown menu (use JS to add this class to the .dropdown-content container when the user clicks on the dropdown button) */
.show {display:block;}
</style>
</head>
<body>

<h3>Autotrolej interaktivna karta</h3>
<?php 
	if(isset($_GET['stanica'])){
		$search = "naziv like '".$_GET['stanica']."'";
		}
	else{
		$search="1";
	}
	
	
	$sql = "SELECT * FROM Stanica WHERE 1 AND ".$search;
	$result = $conn->query($sql);	
	$row = mysqli_fetch_row($result);
	
	$vrijeme0=$row[4];
	$vrijeme1=$row[5];
		
	$sql = "SELECT * FROM Autobus ";
	$result = $conn->query($sql);	
	$autobus = mysqli_fetch_row($result);
	
	if(isset($_GET['smjer'])){
	if($_GET['smjer']=='polazak'){	
		if($autobus[4]==0){
		
			if($vrijeme0>=$autobus[2]){
	
				$vrijeme_pol=$vrijeme0-$autobus[2];
			
			}
		
			if($vrijeme0<$autobus[2]){
			
				$vrijeme_pol=2*$autobus[3]-$autobus[2]+$vrijeme0;
			
				}
		}
		else{
	
			$vrijeme_pol=$autobus[3]-$autobus[2]+$vrijeme0;
		
			}
	
		echo "Procijenjeno vrijeme dolaska za ".$vrijeme_pol." min";
	}
	else{
		if($autobus[4]==1){
		
			if($vrijeme1>=$autobus[2]){
	
				$vrijeme_pov=$vrijeme1-$autobus[2];
			
			}
		
			if($vrijeme1<$autobus[2]){
			
				$vrijeme_pov=2*$autobus[3]-$autobus[2]+$vrijeme1;
			
				}
		}
		else{
	
			$vrijeme_pov=$autobus[3]-$autobus[2]+$vrijeme1;
		
		}
	
		echo "Procijenjeno vrijeme dolaska za ".$vrijeme_pov." min";	

	}
	}
	//izračun vremena
	
	//dohvat podataka za odabranu stanicu lat,lng
	
	$br_stanica = 0;
			
	if(isset($_GET['linija'])){
							
		$lin = $_GET['linija'];	
		
		$sql = "SELECT count(*) FROM Stanica s,LinijaStanica ls,Linija l WHERE s.id=ls.id_stanica AND ls.id_linija=l.id AND l.br=".$_GET['linija'];
		$result = $conn->query($sql);	
		$row2 = mysqli_fetch_row($result);
		$br_stanica = $row2[0];
		
		$sql = "SELECT * FROM Stanica s,LinijaStanica ls,Linija l WHERE s.id=ls.id_stanica AND ls.id_linija=l.id AND l.br=".$_GET['linija'];
		$result2 = $conn->query($sql);	
	}/*
		for($i=0;$i <$br_stanica;$i++){	
		
		$wp = mysqli_fetch_row($result2); 
		
		if(i==1){			

			echo $wp[2];
			echo 	"  ";
		
			}
			
		else if(i==$br_stanica-1){

			echo $wp[2]; 
			echo 	"  ";
			}
			
		else{
			echo $wp[2];
			echo 	"  ";}
		
			
	}
	*/

?>
<div id="googleMap" style="width:100%;height:500px;"></div>

<script>
function myMap() {
	var stanica = {lat: <?php echo $row[2]; ?>, lng: <?php echo $row[1]; ?>};
	//defaultna stanica ili odabrana
	var bus = {lat: 45.3267496, lng: 14.4407941};	//lokaciaj busa - Tablica pozicija

	var start = {lat: 45.3256496, lng: 14.4457941}; //prva default
	var end = {lat: 45.3570211, lng: 14.4250032};	//zadnja default
	
	var waypts = [];								//sve između 2-(count(*)-1)
	
		//stanice poredane od prve do zadnje po id
	<?php
	for($i=0;$i <$br_stanica;$i++){	
		
		$wp = mysqli_fetch_row($result2); 
		
		if($i==0){			

			echo 	"start ={lat:".$wp[2].", lng:".$wp[1]."};";
		
			}
			
		else if($i==($br_stanica-1)){

			echo 	"end ={lat:".$wp[2].", lng:".$wp[1]."};";
			
			}
			
		else{
			
			echo 	"var wp= {lat:".$wp[2].", lng:".$wp[1]." };
		
			waypts.push({
				location: wp,
				stopover: false
				});  ";
				}	
			
	}
	?>
         
	var mapProp = {
		center: new google.maps.LatLng(45.3367319,14.4363472),
		zoom: 14,
	};
	
	var map = new google.maps.Map(document.getElementById("googleMap"),mapProp);

	var marker = new google.maps.Marker({
          position: stanica,
          map: map,
          label: "S"
	});
	var marker2 = new google.maps.Marker({
          position: bus,
          map: map,
          label: "BUS"
        });

	var directionsService = new google.maps.DirectionsService;
	var directionsDisplay = new google.maps.DirectionsRenderer;
	
	directionsDisplay.setMap(map);
	calculateAndDisplayRoute(directionsService, directionsDisplay);

	function calculateAndDisplayRoute(directionsService, directionsDisplay) {
			directionsService.route({
				origin: start,
				destination: end,
				waypoints: waypts,
				optimizeWaypoints: true,
				travelMode: 'DRIVING'
			}, 
			function(response, status) {
					if (status === 'OK') {
						directionsDisplay.setDirections(response);
						var route = response.routes[0];
					} 
					else {
						window.alert('Directions request failed due to ' + status);
					}
			});
	}
 
}
</script>

<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDIlgKDbV-f1e25HG8TgbN-KyTtsk377f8&callback=myMap"
  type="text/javascript"></script>


<?php

	$sql = "SELECT count(*) FROM Linija";
	$result = $conn->query($sql);	
	$row2 = mysqli_fetch_row($result);
	$br_linija = $row2[0];
	
	//dohvat broja linija
	
	$sql = "SELECT br FROM Linija";
	$result = $conn->query($sql);	
		
	echo '						
		<div class="dropdown">
		<button onclick="myFunction()" class="dropbtn">Linija</button>
			<div id="myDropdown" class="dropdown-content">';
		
	for($i=0;$i<$br_linija;$i++){
		$row3 = mysqli_fetch_row($result);
		echo '<a href="karta.php?linija='.$row3[0].'">'.$row3[0].'</a>';
	}
				
	echo '</div> </div>';

	//LINIJE

	if(isset($_GET['linija'])){
							
		$lin = $_GET['linija'];	
		
		$sql = "SELECT count(*) FROM Stanica s,LinijaStanica ls,Linija l WHERE s.id=ls.id_stanica AND ls.id_linija=l.id AND l.br=".$_GET['linija'];
		$result = $conn->query($sql);	
		$row2 = mysqli_fetch_row($result);
		$br_stanica = $row2[0];
		
		//dohvat broja stanica s odabrane linije
		
		$sql = "SELECT naziv FROM Stanica s,LinijaStanica ls,Linija l WHERE s.id=ls.id_stanica AND ls.id_linija=l.id AND l.br=".$_GET['linija'];
		$result = $conn->query($sql);	
		
		echo '						
		<div class="dropdown">
		<button onclick="myFunction2()" class="dropbtn">Stanica</button>
			<div id="myDropdown2" class="dropdown-content">';
		
		for($i=0;$i<$br_stanica;$i++){
			$row3 = mysqli_fetch_row($result);
			echo '<a href="karta.php?linija='.$lin.'&stanica='.$row3[0].'">'.$row3[0].'</a>';
		}
				
		echo '</div> </div>';
		
	/*	echo '<form action="karta.php?linija='.$lin.'&stanica='.$row3[0].'" method="get">
		<input type="radio" name="smjer" value="polazak"> Polazak
		<input type="radio" name="smjer" value="povratak"> Povratak
		<input type="submit" value="Submit">
		</form>';*/
		if(isset($_GET['stanica'])){
			$stan=$_GET['stanica'];
						echo '						
		<div class="dropdown">
		<button onclick="myFunction3()" class="dropbtn">Smjer</button>
		<div id="myDropdown3" class="dropdown-content">
		<a href="karta.php?linija='.$lin.'&stanica='.$stan.'&smjer=polazak">Polazak</a>
		<a href="karta.php?linija='.$lin.'&stanica='.$stan.'&smjer=povratak">Povratak</a>
		</div> </div>'	;
		
			}
		
	}
	//STANICE

	

?>



<script>
function myFunction() {
    document.getElementById("myDropdown").classList.toggle("show");
}
function myFunction2() {
    document.getElementById("myDropdown2").classList.toggle("show");
}
function myFunction3() {
    document.getElementById("myDropdown3").classList.toggle("show");
}

// Close the dropdown menu if the user clicks outside of it
window.onclick = function(event) {
	if (!event.target.matches('.dropbtn')) {

		var dropdowns = document.getElementsByClassName("dropdown-content");
		var i;
		for (i = 0; i < dropdowns.length; i++) {
			var openDropdown = dropdowns[i];
			if (openDropdown.classList.contains('show')) {
				openDropdown.classList.remove('show');
			}
		}
	}
}
</script>

</body>
</html>
