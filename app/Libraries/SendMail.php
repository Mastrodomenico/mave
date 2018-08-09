<?php 

namespace app\Libraries;

use SendGrid;
use SendGrid\Email;
use SendGrid\Content;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


class SendMail{

	public $subject;
	public $emailTo;
	public $nameTo;
	public $from;
	public $template;
	public $templates = array();
	public $pathTemplates = 'Views/Templates/Emails/';

	public function to($to){
		$this->emailTo = $to;
	}

    public function name($to){
        $this->nameTo = $to;
    }

	public function from($from){
		$this->from = $from;
	}

	public function subject($subject){
		$this->subject = $subject;
	}

	public function template($template,$content,$gap){
		$this->template = $template;
		$this->templates[$this->template] = file_get_contents(dirname(__FILE__,2).'/'.$this->pathTemplates.$this->template.".email.html");

		$this->templates[$this->template] = str_replace($content, $gap, $this->templates[$this->template]);
	}

	public function go(){

		$mail = new PHPMailer(true);
		try {
			//Server settings
			$mail->SMTPDebug = 2;                                 // Enable verbose debug output
			// $mail->isSMTP();                                      // Set mailer to use SMTP
			// $mail->Host = 'smtp.clienteagente.grupofbn.com.br';  // Specify main and backup SMTP servers
			// $mail->SMTPAuth = true;                               // Enable SMTP authentication
			// $mail->Username = 'relacionamento@clienteagente.grupofbn.com.br';                 // SMTP username
			// $mail->Password = 'q1w2e3r4t5';                           // SMTP password
			// $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
			// $mail->Port = 587;                                    // TCP port to connect to
		
			$mail->CharSet = 'UTF-8';

			//Recipients
			$mail->setFrom('clienteagente@grupofbn.com.br', 'Cliente Agente');
			$mail->addAddress($this->emailTo, $this->nameTo);     // Add a recipient             // Name is optional
			$mail->addReplyTo('clienteagente@grupofbn.com.br', 'Grupo FBN');
				
			//Content
			$mail->isHTML(true);                                  // Set email format to HTML
			$mail->Subject = $this->subject;
			$mail->Body    = $this->templates[$this->template];
		
			$mail->send();

			return true;
		} catch (Exception $e) {
			echo 'Message could not be sent.';
			echo 'Mailer Error: ' . $mail->ErrorInfo;
			return false;
		}



        // $from = new Email("Cliente Agente", "clienteagente@clienteagente.com.br");
        // $to = new Email($this->nameTo, $this->emailTo);
        // $content = new Content("text/html", $this->templates[$this->template]);
        // $mail = new SendGrid\Mail($from, $this->subject, $to, $content);
        // $apiKey = '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';
        // $sg = new SendGrid($apiKey);
        // $response = $sg->client->mail()->send()->post($mail);
        // return $response;

	}

}