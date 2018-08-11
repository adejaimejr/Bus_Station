<?php
/*
smtp.php - classe para enviar email
autor: Julio Cesar Fernandes de Souza
data: mar/2018
email: jcfsouza@yahoo.com.br
*/

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../../PHPMailer/src/Exception.php';
require '../../PHPMailer/src/PHPMailer.php';
require '../../PHPMailer/src/SMTP.php';

//Load Composer's autoloader
//require 'vendor/autoload.php';

class SMTP {
    public $userName = '';
    public $password = '';
    public $server = 'smtp.mail.yahoo.com';
    public $port = 587;
    public $SMTPSecure = 'tls';
    public $from = "";
    public $fromName = "DispatcherPHP";
    private $mail = null;
    public $lastError = "";
	public $emailTest = "";

    public function __construct()
    {
    }

    function __destruct() {
        $this->mail = null;
    }

    public function connect(){
        if(!$this->mail){
            $this->mail = new PHPMailer(true); // Passing `true` enables exceptions

            //Server settings
            $this->mail->SMTPDebug = 0; // 2 - Enable verbose debug output
            $this->mail->isSMTP(); // Set mailer to use SMTP
            $this->mail->Host = $this->server;  // Specify main and backup SMTP servers
            $this->mail->SMTPAuth = true; // Enable SMTP authentication
            $this->mail->Username = $this->userName; // SMTP username
            $this->mail->Password = $this->password; // SMTP password
            $this->mail->SMTPSecure = $this->SMTPSecure; // Enable TLS encryption, `ssl` also accepted
            $this->mail->Port = $this->port; // TCP port to connect to
            $this->mail->SMTPKeepAlive = true;
        }
        return true;
    }

    public function disconnect(){
        if($this->mail){
            $this->mail->SmtpClose();
            $this->mail = null;
        }
    }

    public function send($address, $name, $subject, $message, $file){
        try {
            $this->mail->ClearAllRecipients( );
            $this->mail->charSet = "UTF-8";
            $this->mail->setFrom($this->from, $this->fromName);
			if($this->emailTest && trim($this->emailTest) != ""){
				$this->mail->addAddress($this->emailTest, $name);
			} else {
				$this->mail->addAddress($address, $name);
			}
            $this->mail->isHTML(true); // Set email format to HTML
            $this->mail->Subject = $subject;
            $this->mail->Body = $message;
            // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
            if($file){
                $this->mail->AddAttachment($file);
            }
            $this->mail->send();
            return true;
        } catch (Exception $e) {
            $this->lastError = $this->mail->ErrorInfo;
            return false;
        }
    }

}

?>
