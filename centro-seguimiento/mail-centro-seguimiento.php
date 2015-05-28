<?php if(isset($_POST['elm1'])){ 
	$elm1 = stripslashes( $_POST['elm1'] );
} ?>
    
    <?php
    // -----------------------------------------------------------------//
			// ---------  SE PREPARA Y ENVÍA EL EMAIL AL ALUMNO  --------------//
			// ----------------------------------------------------------------//
			$to = 'soporte@inovanto.com';

			$subject = 'Test Editor WISYWYG';
			
			$headers = "From: registro@musinetwork.com\r\n";
			$headers .= "MIME-Version: 1.0\r\n";
			$headers .= "Content-Type: text/html; charset=utf-8\r\n";
			 
			$message = '<html>';
			  
			$message .= '<body leftmargin="0" marginwidth="0" topmargin="0" marginheight="0" offset="0">';
			$message .= '<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center" style="background-color:#e3e3e3; '; 
			$message .= 'font-family: Trebuchet MS, Arial, Helvetica, sans-serif; line-height: 25px;"><tr><td>';
			$message .= '<!-- Tabla principal -->';
			$message .= '<table width="700" border="0" cellspacing="0" cellpadding="0" align="center" style="background-color: #ffffff;">';
			$message .= '<!-- Tabla contenedor -->';
			$message .= '<tr><td><!-- header -->';
			$message .= '<img src="http://musinetwork.com/centro-ayuda/imagenes/header-mail.png">';
			$message .= '</td></tr><!-- cierra header -->';
			$message .= '<tr><td style="padding: 0 20px;"><!-- Contenedor principal -->';
			$message .= $elm1;
			$message .= '<p>Muchas gracias, estamos para servirte.</p>';
			$message .= '<p style="line-height: 12px; font-size: 11px;"><strong>Laura Ortíz Alemán</strong> <br />
						 Departamento de Comunicación<br />
						 Musinetwork School of Music<br />
						 "Tu Escuela de Música Online"<br />
						 Tel: (01) 617-440-4373<br />
						 Email: registro@musinetwork.com<br />
						 Boston, MA 02132<br />
						 Estados Unidos<br /></p>';
			$message .= '</td></tr><!-- Cierra contenidor principal -->';
			$message .= '<tr><td><!-- footer -->';
			$message .= '<img src="http://musinetwork.com/centro-ayuda/imagenes/footer-mail.jpg">';
			$message .= '</td></tr><!-- cierra footer -->';
			$message .= '</table><!-- Cierra tabla contenedor -->';
			$message .= '</td></tr></table><!-- Cierra tabla principal -->';

			$message .= "</body></html>";
			 
			
			mail($to, $subject, $message, $headers);
			echo 'Chelas!!!<br>';
			echo $elm1;
    ?>
     
 