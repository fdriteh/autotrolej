<?php

			error_reporting(E_ALL); // or E_STRICT
			ini_set("display_errors",1);
			ini_set("memory_limit","1024M");
			define ('SITE_ROOT', realpath(dirname(__FILE__)));
			
			session_start();
			if(!$_SESSION['is_admin'])
				header('Location: /');

			include 'includes/connection.php';
			include 'includes/functions.php';

			$conn = new mysqli($host, $username, $password, $db);
			if ($conn->connect_error) {
				die("Connection failed: " . $conn->connect_error);
			}
			echo "Connected successfully<br>";
			
			//stvaranje novog zapisa
			if(!empty($_POST['title']) && !empty($_POST['info-txt'])){
				$sql = "INSERT INTO Objava VALUES (CURRENT_TIMESTAMP,'".$_POST['title']."
								','".$_POST['info-txt']."')";
			
				if($conn->query($sql) == true){
						echo "New record <br> ";
					}
				else{
						echo "Error";
					}
			
			
				if($_FILES['file']){
						$uploaddir = '/uploads/';
						$uploadfile = $uploaddir . basename($_FILES['file']['name']);

						echo "<p> ".$uploadfile;
				
						if (move_uploaded_file($_FILES['file']['tmp_name'], SITE_ROOT.$uploadfile)) {
							echo "File is valid, and was successfully uploaded.\n";
						} else {
							echo "Upload failed";
						}
				
						echo "</p>";
						echo '<pre>';
						print_r($_FILES);
						print "</pre>";
					}
			
			
					header('Location: admin.php');
			
			}
			//greska u slučaju da je polje naslov ili objava prazan
			//mozda bolje putem JS rjesiti
			else{
				echo "Error!!";				
			}
?>

