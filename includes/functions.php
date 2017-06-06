<?php
	function alert($message, $location) {
		echo "<script type='text/javascript'>"; 
		echo "alert('".$message."');";
		echo "window.location.href='".$location."';";
		echo "</script>";
	}

	function window($location) {
		echo "<script>window.open('".$location."');</script>";
	}

	function nbsp($n) {
		for($i=0;$i<$n;$i++) {
			echo "&nbsp;";
		}
	}

	function random_kartica() {
		$kartica = " ";

		for ($i=0; $i<4; $i++) {
			$broj = (string)mt_rand(1234,9876);
			$kartica = $kartica .= $broj .= " ";
		}
		return $kartica;
	}

	function poruka($address,$subject,$message) {

	require 'PHPMailer/PHPMailerAutoload.php';
	$mail = new PHPMailer;

	$mail->isSMTP();                                      // Set mailer to use SMTP
	$mail->Host = 'smtp.gmail.com';  					  // Specify main and backup SMTP servers
	$mail->SMTPAuth = true;                               // Enable SMTP authentication
	$mail->Username = 'piteambyte@gmail.com';             // SMTP username
	$mail->Password = 'bytebyte';                         // SMTP password
	$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl`port:465 also accepted- tls port:587
	$mail->Port = 587;   

	$mail->setFrom('piteambyte@gmail.com', 'Autotrolej'); // Name is optional
	$mail->addAddress($address);               
	$mail->isHTML(true);                                  // Set email format to HTML
	$mail->Subject = $subject;
	$mail->Body = $message;
	
	if(!$mail->send()) {
	    echo 'Message could not be sent.';
	    echo 'Mailer Error: ' . $mail->ErrorInfo;
	} else {
	    echo 'Message has been sent';
	}
}
?>