<?php
namespace LEANGA;


require_once('PHPMailer/PHPMailerAutoload.php');
use PHPMailer\PHPMailer;


class Handler_Mail{
	private $server		=	'smtp.gmail.com';
	private $port		=	25;
	private $username	=	'colegioteresaparraca@gmail.com';
	private $password	=	'2100146luis';
	private $from 		=	'colegioteresaparraca@gmail.com';
	private $fromName	=	'E.E.I. Colegio Teresa de la Parra';
	private $mail;
	
	public function __construct(){
		$this->mail = new PHPMailer();
		//$this->mail->isSMTP();
		$this->mail->SMTPSecure = 'tsl';
		$this->mail->SMTPDebug = 2;
		$this->mail->Debugoutput = 'html';
		$this->mail->Port = $this->port;
		$this->mail->SMTPAuth = true;
		$this->mail->Username = $this->username;
		$this->mail->Password = $this->password;
	}
	
	public function replyto($mail, $name){
		$this->mail->AddReplyTo($mail, $name);
	}
	
	public function setSubject($subject){
		$this->mail->Subject = $subject;
	}
	
	public function setBody($body){
		$this->mail->Body = $body;
	}
	
	public function isHTML(boolean $is, $altBody){
		$this->mail->isHTML($is);
		$this->mail->AltBody($altBody);
	}
	
	public function addFile($path, $name = null){
		if($name)
			$this->mail->addAttachment($path,$name);
		else
			$this->mail->addAttachment($path);
	}
	
	public function addRecipients(array $recipients){
		foreach($recipients as $key => $value){
			if(is_numeric($key)){
				$this->mail->addAddress($value);
			}else{
				$this->mail->addAddress($value, $key);
			}
		
		}
	}
	
	public function send(){
		$this->mail->setFrom($this->from, $this->fromName);
		if($this->mail->send())
			return true;
		else{
			echo $this->mail->ErrorInfo;
			return false;
		}
	}
	
}