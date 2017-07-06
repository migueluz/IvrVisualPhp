<?php
require("include/PHPMailer/class.phpmailer.php");
require("include/PHPMailer/class.smtp.php");

function Correo($destino){
	try{
		$mail= new PHPMailer();
		$mail->IsSMTP();  // telling the class to use SMTP
		$mail->SMTPDebug  = 2;
		$mail->SMTPAuth   = true;
		$mail->SMTPSecure = "ssl";
		$mail->Host       = "smtp.gmail.com";
		$mail->Port       = 465;
		$mail->Username = 'servicoatcclaro@gmail.com';
		$mail->Password = 'BOH@2015..';
		$mail->From = "servicoatcclaro@gmail.com";
		$mail->FromName = "Servicio de Atencion Al Cliente de Claro";
		$mail->Subject = "Factura del Mes de Septiembre";
		$mail->Body = "Estimado Cliente,\n En el presente encontrara adjunta su factura correspondiente al mes de Septiembre.";
		$mail->WordWrap = 50;
		//$mail->AddAddress("jehuty38@gmail.com");
		$mail->AddAddress($destino);
		//$mail->IsHTML(true);

			if(!$mail->Send()) {
				$ddf = fopen('log_ErrornMail.log','a');
				fwrite($ddf,'Error En Envio de Email: '.$mail->ErrorInfo."\r\n");
				fclose($ddf);
// 				echo 'Mensaje no enviado.';
// 				echo 'Error: ' . $mail->ErrorInfo;
				return false;
				} else {
					$ddf = fopen('log_ErrornMail.log','a');
					fwrite($ddf,'Envio de Email Exitoso'."\r\n");
					fclose($ddf);
					return true;
// 					echo 'Mensaje enviado.';
						}
	}catch (Exception $e) {
    	$ddf = fopen('log_ExceptionMail.log','a'); 
			fwrite($ddf,':Error de conexión a la Base de Datos: '.$e->getMessage()."\r\n"); 
			fclose($ddf); 
    		exit(1);
							}

}

?>