<?php
			//spajanje
			$conn = new mysqli("localhost", "root", "dm","Autotrolej");
						if ($conn->connect_error) {
									die("Connection failed: " . $conn->connect_error);
						}
	
	
		//dio koda zadužen za dodavanje nove karte u bazu -- u funkciji rj
		if(!empty($_POST['naziv']) && !empty($_POST["cijena"])){
			$sql = "INSERT INTO Karta VALUES(NULL,'".$_POST['naziv'].
								"','".$_POST['cijena']."')";
			if($conn->query($sql)== true) echo "YES";
			else echo "NO";
			}


?>

