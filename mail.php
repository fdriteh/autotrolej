<?php

function poruka($address,$subject,$message) {

	require 'PHPMailer/PHPMailerAutoload.php';
	$mail = new PHPMailer;

	//$mail->SMTPDebug = 3;                               // Enable verbose debug output

	$mail->isSMTP();                                      // Set mailer to use SMTP
	$mail->Host = 'smtp.gmail.com';  					  // Specify main and backup SMTP servers
	$mail->SMTPAuth = true;                               // Enable SMTP authentication
	$mail->Username = 'piteambyte@gmail.com';             // SMTP username
	$mail->Password = 'bytebyte';                         // SMTP password
	$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl`port:465 also accepted- tls port:587
	$mail->Port = 587;   

	$mail->setFrom('piteambyte@gmail.com', 'Autotrolej');
	$mail->addAddress($address);               // Name is optional
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