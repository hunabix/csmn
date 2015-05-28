<?php
    // -----------------------------------------------------------------//
	// ---------  SE PREPARA Y ENVÍA EL EMAIL AL ALUMNO  --------------//
	// ----------------------------------------------------------------//
			
			//headers must be an array
			
			$from = "Musinetwork School of Music <informacion@musinetwork.com>";
			$to = 'soporte@inovanto.com';
			$subject = base64_encode( 'Mensaje' ) ;
			$headers = array (
				'From' => $from,
				'To' => $to,
				'Subject' => "=?UTF-8?B?" . $subject . "?=",
				'MIME-Version' => '1.0',
				'Content-Type' => 'text/html; charset=utf-8',
				'Content-Transfer-Encoding' => '8bit',
				//'Reply-To' => 'informacion@musinetwork.com'
			);
			
			//$to = 'soporte@metrorama.mx, hibam_iru@yahoo.com.mx';
			//$to = $email[$i];

			//$subject = $asuntop;
			
			//$headers = "From: Musinetwork School of Music <informacion@musinetwork.com>\r\n";
			//$headers = "From: informacion@musinetwork.com\r\n";
			//$headers .= "MIME-Version: 1.0\r\n";
			//$headers .= "Content-Type: text/html; charset=utf-8\r\n";
			 
			$message = '<html>';
			  
			$message .= '<body leftmargin="0" marginwidth="0" topmargin="0" marginheight="0" offset="0">';
			$message .= '<table width="600px" border="0" cellspacing="0" cellpadding="0" align="center" style="background-color: #fff; '; 
			$message .= 'font-family: Trebuchet MS, Arial, Helvetica, sans-serif;"><tr><td>';
			$message .= '<!-- Tabla principal -->';
			$message .= '<table width="600px" border="0" cellspacing="0" cellpadding="0" align="center" style="background-color: #ffffff; font-size:14px;">';
			$message .= '<!-- Tabla contenedor -->';
			$message .= '<tr><td><!-- header -->';
			$message .= '<a href="http://musinetwork.com"><img src="http://musinetwork.com/centro-seguimiento/imagenes/header-mails-cs.jpg"></a>';
			$message .= '</td></tr><!-- cierra header -->';
			$message .= '<tr style="text-align:justify;"><td><!-- Contenedor principal -->';
			$message .= '<h3 style="padding-top: 30px;"><strong>Hola hibam,</strong></h3>';;
			//$message .= '<p>&nbsp;</p>';
			$message .= '<p style="margin-bottom: 18px;">También nos puedes localizar en:</p><br>';
			$message .= '<table width="100%" border="0" cellspacing="0" cellpadding="0">';
			$message .= '<tr>';
			$message .= '<td width="36px"><img src="http://musinetwork.com/registromn/imagenes/icon-skype.jpg"></td><td width="200px"><strong style="line-height:33px; display:block;">Skype: Musinetwork</strong></td>';
			$message .= '<td width="36px"><a style="text-decoration:none;" ';
			$message .= 'href="http://www.facebook.com/pages/Musinetwork-School-of-Music/116451791642">';
			$message .= '<img src="http://musinetwork.com/registromn/imagenes/icon-facebook.jpg"></a></td><td><a style="text-decoration:none; color:black !important;" ';
			$message .= 'href="http://www.facebook.com/pages/Musinetwork-School-of-Music/116451791642"><strong style="line-height:33px; display:block;">Facebook</strong></a></td>';
			$message .= '<td width="36px"><a style="text-decoration:none;" href="https://twitter.com/Musinetwork">';
			$message .= '<img style="float:left;" src="http://musinetwork.com/registromn/imagenes/icon-twitter.jpg"></a></td><td><a style="text-decoration:none; color:black !important;" href="https://twitter.com/Musinetwork"><strong style="line-height:33px; display:block;">Twitter</strong></a></td>';
			$message .= '</tr>';
			$message .= '</table>';
			$message .= '<p style="margin-bottom: 18px; margin-top:18px;">Muchas gracias, estamos para servirte.<br /><br />';
			'Musinetwork School of Music<br />
			"Tu Escuela de Música Online"<br />
			Tel: (01) 617-440-4373<br />
			Email: <a href="mailto:registro@musinetwork.com">registro@musinetwork.com</a><br />
			Boston, MA 02132<br />
			Estados Unidos</p><p>Responde este correo pidiendo darte de baja de nuestra lista en caso de que no desees seguir recibiendo notificaciones de Musinetwork.</p>';
			$message .= '</td></tr><!-- Cierra contenidor principal -->';
			$message .= '<tr><td><!-- footer -->';
			$message .= '<a href="http://musinetwork.com"><img src="http://musinetwork.com/centro-seguimiento/imagenes/footer-mails-cs.jpg"></a>';
			$message .= '</td></tr><!-- cierra footer -->';
			$message .= '</table><!-- Cierra tabla contenedor -->';
			$message .= '</td></tr></table><!-- Cierra tabla principal -->';
			$message .= '</body></html>';
			 
			require_once "../smtp-mailer/Mail.php"; // calls pear mail packages
			$host = "ssl://email-smtp.us-east-1.amazonaws.com";
			$port = "465";
			$username = "AKIAIXA2XV6TZOOCK5KQ";
			$password = "Amhgery5dXtVT2T1j+DrcewX8MUiWOkIWme8Mchskv5N";
			
			/*require_once "../smtp-mailer/Mail.php"; // calls pear mail packages
			$host = "ssl://smtp.gmail.com";
			$port = "465";
			$username = "soporte@metrorama.mx";
			$password = "Rbnhzdhrv5";*/
			
			$smtp = Mail::factory('smtp', //prepares smtp vars
			array ('host' => $host,
			 'port' => $port,
			 'auth' => true,
			 'username' => $username,
			 'password' => $password));
			
			$mail = $smtp->send($to, $headers, $message);
			
			if (PEAR::isError($mail)) {
			echo("<p>" . $mail->getMessage() . "</p>");
			} else {
			//echo("<p>Message successfully sent!</p>");
			}
			
			//mail($to, $subject, $message, $headers);
			echo $message;
		
		

?>

