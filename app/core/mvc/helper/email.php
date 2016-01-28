<?php


class Email{
    public $to_email;
    public $from_email;
    public $subject_str;
    public $message_str;
    public $message_arr = array();
    
    public function __construct() {
             
    }
    
    public function sendmail(){
		
		//trebalo bi ovako nesto da ide ja sam otvorio ovaj mail nalog i dodelio mu ovaj password
		$mail = new PHPMailer;
		$mail->isSMTP();
		$mail->Host = 'mail.aleksinackenovosti.com';  					// Specify main and backup SMTP servers
		$mail->SMTPAuth = true;                               	// Enable SMTP authentication
		$mail->Username = 'vlada@aleksinackenovosti.com'; 				// SMTP username
		$mail->Password = 'dimirVla11';                          	// SMTP password
		$mail->SMTPSecure = 'tls';                            	// Enable TLS encryption, `ssl` also accepted
		$mail->Port = 465;                                    	// TCP port to connect to
			
		$mail->From = $this->from_email;
		$mail->FromName = 'Son Tours Inc.';
		$mail->addAddress($this->to_email);     						// Add a recipient
		$mail->addReplyTo('info@son-tours.com');
			
		$mail->isHTML(true);
		$mail->Subject = $this->subject_str;
		$mail->Body    = $this->setup_message();
		
		//slanje
		$mail->send();
		
		
		
        //mail($this->to_email, $this->subject_str, $this->setup_message(), $this->setup_headers());
    }
    
    private function setup_message(){
            $m = '<html><body>';
            $m .= $this->message_str;
            $m .='</body></html>';
            return $m;
    
    }
    
}
