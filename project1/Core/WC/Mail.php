<?php 
 
class Core_WC_Mail { 
	function send_mail($header,$msg){ 
		// send_mail_actual($header,$msg); 
		// $to = $header['to']; 
		// $from = $header['from']; 
		// $header['to'] = $from; 
		// $header['from'] = $to; 
		 
		return send_mail_actual($header,$msg); 
	} 
 
	function send_mail_actual($header,$msg) 
	{ 
		$smtp_config = Core_WC_Helpers::coreRegistry("smtp");

		$auth = array("host"=>"$smtp_config->servername", "user"=>"$smtp_config->username", "pass"=>"$smtp_config->password", "port"=>"$smtp_config->port", "protocol"=>"$smtp_config->ssl");  
		
		$host = $auth['host'];  
		$user = $auth['user'];  
		$pass = $auth['pass'];  
		$port = $auth['port'];  
		$protocol = $auth['protocol']; 

		require_once 'mail/PHPMailerAutoload.php';  
		$mail = new PHPMailer;  

		$mail->isSMTP();  
		$mail->Host = $host;  
		$mail->SMTPAuth = true;  
		$mail->Username = $user;  
		$mail->Password = $pass;  
		$mail->SMTPSecure = $protocol;  
		$mail->Port = $port;  
		$header = array("from"=>"vijay.webmavens@gmail.com", "to"=>"lathiyav2810@gmail.com", "subject"=>"Testing Email"); 
 
		$mail->setFrom($header['from']); 
		$mail->addAddress($header['to']); 
		// $mail->addAddress('another_email_id@example.com'); 
		// $mail->addReplyTo('reply_to@example.com', 'Information'); 
		if(isset($header['cc']) && strlen($header['cc'])>=5) 
		{ 
			$mail->addCC($header['cc']); 
		} 
		if(isset($header['bcc']) && strlen($header['bcc'])>=5) 
		{ 
			$mail->addBCC($header['bcc']); 
		} 
		$mail->addBCC(""); 
		$mail->Subject = $header['subject']; 
		$mail->Body    = $msg; 
		$mail->IsHTML(true); 
		$GLOBALS['debug']=''; 
		$mail->SMTPDebug  = 1; // enables SMTP debug information (for testing) 
							   // 1 = errors and messages 
							   // 2 = messages only 
		$mail->Debugoutput = function($str, $level){ 
			$GLOBALS['debug'].="$level: $str\n"; 
		}; 
		if(!$mail->send()) 
		{ 
			echo 'Mailer Error: ' . $mail->ErrorInfo; 
			// die(); 
			return 0; 
			echo 'Message could not be sent.'; 
			return $GLOBALS['debug']; 
		} 
		else 
		{ 
			echo 'Message has been sent'; 
			return 1; 
			return $GLOBALS['debug']; 
		} 
		 
	} 
}
?>