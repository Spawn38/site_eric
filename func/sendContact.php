<?php
	session_start();
	header("Content-Type: text/json; charset=utf8");

	try {			
		if (isset($_SESSION['token']) && hash_equals( crypt("access",date("m.d.y")),$_SESSION['token'])) {

			$to = "eric.silvestrini@spra-france.fr";
			$subject = "Demande de contact";
			$mail = "eric.silvestrini@spra-france.fr";
			$headers = "From: " . strip_tags($mail) . "\r\n";
			$headers .= "Reply-To: ". strip_tags($mail) . "\r\n";		
			$headers .= "MIME-Version: 1.0\r\n";
			$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

			$message = '<html><body>';
			$message .= '<h1>SPRA - Association spécialisée en Conseil et Management</h1>';
			$message .= '<p>Nom : '.$_POST['name'].'</p>';
			$message .= '<p>Email : '.$_POST['email'].'</p>';
			$message .= '<p>Message : </p>';
			$message .= '<p style="white-space: pre">'.$_POST['message'].'</p>';
			$message .= '</body></html>';

			$response = mail($to, $subject, $message, $headers);

			echo json_encode(array(
		        'success' => true,
		        'reponse'  => $reponse,
		    ));

		} else {
			throw new Exception('Accès refusé');
		}
	} catch(Exception $ex){
	    echo json_encode(array(
	        'success' => false,
	        'reason'  => $ex->getMessage(),
	    ));
	}
?>