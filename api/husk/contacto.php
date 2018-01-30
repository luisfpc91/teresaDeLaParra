<?php
	if(local!='pQoRCy9SDQ3f'){
		exit();}
	
	use LEANGA\Handler_Mail;
	
	$nombre_contacto = $_POST['nombre_contacto']; 
	$email_contacto = $_POST['email_contacto']; 
	$asunto_contacto = $_POST['asunto_contacto']; 
	$mensaje_contacto = $_POST['mensaje_contacto']; 
	
	$mail=new Handler_Mail();
	$mail->replyto($email_contacto,$nombre_contacto);
	$mail->setSubject($asunto_contacto);
	$mail->setBody($mensaje_contacto);
	$mail->addRecipients(array('colegioteresaparraca@gmail.com'));
	if($mail->send()){
		$return=array("e"=>0);
	}else{
		$return=array("e"=>1);
	}
		
	
		
		
?>