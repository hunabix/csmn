<?php
/*
* Controlador de Componer mensaje
*/

confirm_logged_in(); //revisa si el operador ha ingresado

//Get post data
$data = readRawPost(array_values($_POST));

//print_array($data);
//die;

//Initialize lead_ids
$lead_ids = array();

// Process lead ids
if ($data['formulario'] == 'em-form') {
	$lead_ids[0] = $data['lead-id'];
}

if ($data['formulario'] == 'em-mag-form' OR isset($data['nuevo-mensaje'])) {
	$lead_ids = extract_checkbox_ids($data);
}

// Redirects to home when no ids are available
if (!$lead_ids)
	header('Location: ' . cs_url);

// Get leads info
foreach ($lead_ids as $lead_id => $id) {
		$leads_info['lead_'.$id] = get_lead_info_by_id($id);
}

// Se obtiene las fechas de inscripción e inicio de cursos
$configuracion = obten_configuracion();

// Se guarda la consulta en variables
$inicio_ins = $configuracion['inicio_ins'];
$inicio_cur = $configuracion['inicio_cur'];
$ciclo_esc = $configuracion['ciclo_esc'];

// Formateamos fecha de inscripción
$inicio_ins = fecha_inscripcion($inicio_ins);

// Formateamos decha de inicio de cursos
$inicio_cur = fecha_inicio_cursos($inicio_cur);


// Process new message if it's send
if (isset($data['nuevo-mensaje'])) {
	
	//Mensajes generales	
	if(isset($data['tipo'])){  $tipo = utf8_decode($data['tipo']); }
	if(isset($data['mensaje_op'])){ $mensaje_op = utf8_decode($data['mensaje_op']); }
	if(isset($data['firma'])){ $firma = $data['firma']; }
	if(isset($data['comentarios'])){  $comentarios = utf8_decode($data['comentarios']); }
	if(isset($data['asunto'])){  $asunto = utf8_decode($data['asunto']); }

	//Enable old connection
	global $connection;
	
	foreach ($leads_info as $lead_info) {
			
			// Get last interaction
			$last_interaction = get_last_interaction($lead_info['ID']);
			//print_array($last_interaction);
		
					
			// ------------------------------------------------------------ ------------//
			// ---------  ALMACENO INFORMACIÓN EN BD -----------------------------------//
			// -------------------------------------------------------------------------//	
				
			// ---------  Se guardan los datos de la nueva interacción  --------------//
			$fecha = date("Y-m-d H:i:s");
			$consulta = "INSERT 
						 INTO interaccion_cs (
						 tipo,
						 id_interesado,
						 fecha,
						 mensaje_op,
						 mensaje_int,
						 observaciones
						)
						VALUES ('$tipo','$lead', '$fecha', '$mensaje_op', '', '$comentarios')";
			$resultado = mysql_query($consulta, $connection);
			$lastId = mysql_insert_id();
			confirm_query($resultado);
			
			$configuracion = obten_configuracion();
			$tipo_estatus = utf8_encode($tipo);	
			actualiza_recordatorio($configuracion['temporada'], $tipo_estatus, $fecha, $lead_info['ID'], 0);
				
			// ------------------------------------------------------------ ------------//
			// ---------  Envío de emails a los interedados ----------------------------//
			// -------------------------------------------------------------------------//
			
			//Casos posibles: Se respondió al interesado*, Correo de información enviado, Correo de seguimiento enviado, Correo de inicio de cursos enviado, Recordatorio de pago enviado
			
			$mail_a_enviar = utf8_encode($tipo);
			if ($mensaje_op != '') {
				$mensaje_op = stripslashes( $mensaje_op ); // Luego de grabar el mensaje en la DB, elimina los "/" (slashes) insertados por KCEditor para que aparezcan las imágenes y agrega un salto de línea para que se vea bonito en el mail :)
			}
			
			switch ( $mail_a_enviar ) {
				
				case 'Se respondió al interesado';
				$asuntop = $asunto;
				$msj_introductorio = '';
				$texto_personalizado = $mensaje_op . '<br />';
				break;
				
				case 'Correo de información enviado';
				$asuntop = 'Información - Musinetwork School of Music';
				$msj_introductorio = '<p style="margin-bottom: 10px;">Te escribimos de <strong>Musinetwork School of Music</strong> para confirmar si recibiste la información que solicitaste hace algunos días y ponernos nuevamente a tus órdenes en caso de que tengas alguna otra duda o comentario.</p>';
				$texto_personalizado = $mensaje_op . '<p style="margin-bottom: 18px;">Puedes responder a este correo o si lo prefieres, comunícate a nuestras oficinas al teléfono <strong>(+1) 617-440-4373 (INTL).</strong></p>';
				break;
				
				case 'Correo de seguimiento enviado';
				$asuntop = 'Seguimiento - Musinetwork School of Music';
				$msj_introductorio = '<p style="margin-bottom: 18px;">Te escribimos este correo con la finalidad de ponernos a tu disposición por si tienes alguna duda o inquietud acerca de <strong>Musinetwork School of Music</strong>.</p>
				<p style="margin-bottom: 18px;">Te comentamos que las <strong>INSCRIPCIONES</strong> para el ciclo escolar <strong>' . $ciclo_esc . '</strong>, que inicia el <strong>' . $inicio_cur . '</strong>, se encuentran <strong>¡ABIERTAS!</strong></p>';
				$texto_personalizado = $mensaje_op . '<p style="margin-bottom: 18px;">Si tienes interés de integrarte a la escuela, por favor escríbenos para reservar tu espacio. Los lugares disponibles son limitados y damos preferencia a las personas que como tú, ya realizaron un primer contacto con nosotros.</p>';
				break;
				
				case 'Correo de inicio de cursos enviado';
				$asuntop = 'Inicio de Cursos - Musinetwork School of Music';
				$msj_introductorio = '<p style="margin-bottom: 18px;">Te escribimos este correo con la intención de mantener un contacto cercano y personalizado contigo, dado que sabemos de tu interés por integrarte a <strong>Musinetwork School of Music.</strong></p>
				<p style="margin-bottom: 18px;">El <strong>' . $inicio_ins . '</strong> las inscripciones para el próximo Ciclo Escolar <strong>' . $ciclo_esc . '</strong> fueron abiertas y los lugares comenzaron a ser reservados, te pido que en caso de querer formalizar tu inscripción, confírmalo por este medio para anotarte en la lista de lugares reservados.</p><p style="margin-bottom: 18px;">La fecha de inicio de cursos es el <strong>' . $inicio_cur . '</strong></p>';
				$texto_personalizado = $mensaje_op . '<p style="margin-bottom: 18px;">Si tienes alguna otra duda o comentario, escríbenos, estamos para servirte.</p>';
				break;
				
				case 'Recordatorio de pago enviado';
				$asuntop = 'Reservación de Lugar - Musinetwork School of Music';
				$msj_introductorio = '<p style="margin-bottom: 18px;">Te escribo para recordarte que tienes reservado un lugar para el ciclo escolar <strong>' . $ciclo_esc . '</strong> de <strong>Musinetwork School of Music</strong> con inicio el día <strong>' . $inicio_cur . '</strong></p>';
				$texto_personalizado = $mensaje_op. '<p style="margin-bottom: 18px;">Para asegurar tu lugar en el ciclo, te invitamos a realizar tu pago y completar el proceso de inscripción lo antes posible. Si necesitas un lapso mayor de tiempo para inscribirte, te pido me escribas a la brevedad para seguir apartando tu espacio.</p>';
				break;
			}
			$info_inscripciones = '<h3 style="color:#F36438; font-weight: bold; line-height:32px;">INSCRIPCIONES</h3>
			<p>Cada curso tiene una duración de <strong>3 meses</strong> y su costo es de: <strong>$180 dólares</strong> haciendo un solo pago trimestral, o si lo prefieres, puedes pagarlo en tres mensualidades de <strong>$75 dólares</strong> cada una.</p><br>También tienes la opción de pagar todo el <strong>Programa de Certificación</strong> que consta de <strong>6 cursos</strong> y obtener hasta un 25% de descuento. Puedes realizar un pago único de <strong>$950 dólares</strong> o seis mensualidades de <strong>$165 dólares</strong> cada una.</p><br><br>
			<p>Puedes usar:<br><br><strong>- Tarjeta de crédito</strong> o <strong>débito</strong><br><br><strong>- Transferencia</strong> o <strong>depósito bancario</strong> desde tu banco local<br><br><strong>- Envío de dinero en efectivo</strong> desde cualquier parte del mundo</p><br />
			<p>Solo haz click en:</strong></p><br>
			<p style="text-align:center;"><a style="font-size: 16px" href="http://musinetwork.com/registromn/inscripcion-paso2.php">http://musinetwork.com/registromn/inscripcion-paso2.php</a></p><br>';
			
			switch  ($firma) {
			
				case $firma == 'Equipo Musinetwork';
				$firma = '<strong>Equipo Musinetwork</strong><br />';
				break;
			
				case $firma == 'Laura Ortíz Alemán';
				$firma = '<strong>Laura Ortíz Alemán<br />
						Departamento de Comunicación</strong><br />';
				break;
			
				case $firma == 'Marichú García Salazar';
				$firma = '<strong>Marichú García Salazar <br />
						Head Staff <br />
						Oficina de Registro</strong><br />';
				break;
			
				case $firma == 'Lucy Morales';
				$firma = '<strong>Lucy Morales<br />
						Consejero Académico<br />
						Oficina de Registro</strong><br />';
				break;
			}
			
			// -----------------------------------------------------------------//
			// ---------  SE PREPARA Y ENVÍA EL EMAIL AL ALUMNO  --------------//
			// ----------------------------------------------------------------//
					 
					$message = '<html>';
					  
					$message .= '<body leftmargin="0" marginwidth="0" topmargin="0" marginheight="0" offset="0">';
					$message .= '<table width="600px" border="0" cellspacing="0" cellpadding="0" align="center" style="background-color: #fff; '; 
					$message .= 'font-family: Trebuchet MS, Arial, Helvetica, sans-serif;"><tr><td>';
					$message .= '<!-- Tabla principal -->';
					$message .= '<table width="600pxpx" border="0" cellspacing="0" cellpadding="0" align="center" style="background-color: #ffffff; font-size:14px;">';
					$message .= '<!-- Tabla contenedor -->';
					$message .= '<tr><td><!-- header -->';
					$message .= '<a href="http://musinetwork.com"><img src="http://musinetwork.com/centro-seguimiento/imagenes/header-mails-cs.jpg"></a>';
					$message .= '</td></tr><!-- cierra header -->';
					$message .= '<tr style="text-align:justify;"><td><!-- Contenedor principal -->';
					$message .= '<h3 style="padding-top: 30px;"><strong>Hola '. $lead_info['nombre'] . ',</strong></h3>';
					$message .= $msj_introductorio;
					$message .= $texto_personalizado ;
					if ( $mail_a_enviar == 'Correo de información enviado' ) {
						$info_inscripciones = '';
					}  elseif ( $mail_a_enviar == 'Se respondió al interesado' ) {
						$info_inscripciones = '';
					}
					$message .= $info_inscripciones;
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
					$message .= $firma .
					'Musinetwork School of Music<br />
					"Tu Escuela de Música Online"<br />
					Tel: (01) 617-440-4373<br />
					Email: <a href="mailto:registro@musinetwork.com">registro@musinetwork.com</a><br />
					Boston, MA 02132<br />
					Estados Unidos</p>';
					$message .= '</td></tr><!-- Cierra contenidor principal -->';
					$message .= '<tr><td><!-- footer -->';
					$message .= '<a href="http://musinetwork.com"><img src="http://musinetwork.com/centro-seguimiento/imagenes/footer-mails-cs.jpg"></a>';
					$message .= '</td></tr><!-- cierra footer -->';
					$message .= '</table><!-- Cierra tabla contenedor -->';
					$message .= '</td></tr></table><!-- Cierra tabla principal -->';
					$message .= '</body></html>';
			
					//Calling library and setting up credentials for Amazon SES
					require_once "lib/PHPMailer/PHPMailerAutoload.php";
					$host = "ssl://email-smtp.us-east-1.amazonaws.com";
					$port = "465";
					$username = "AKIAIXA2XV6TZOOCK5KQ";
					$password = "Amhgery5dXtVT2T1j+DrcewX8MUiWOkIWme8Mchskv5N";
					//$to = $email[$i]; DEV
					$to = 'hibamiru@gmail.com';
					//$to = 'musinetwork@gmail.com';
					$subject = utf8_encode($asuntop);
				
					//Preparing mail
					$mail = new PHPMailer();
					$mail->CharSet = 'UTF-8';
					$mail->isSMTP();
					$mail->isHTML(true);
					$mail->SMTPDebug = 0;
					$mail->Debugoutput = 'html';
					$mail->Host = "ssl://email-smtp.us-east-1.amazonaws.com";
					$mail->Port = 465;
					$mail->SMTPAuth = true;
					$mail->Username = "AKIAIXA2XV6TZOOCK5KQ";
					$mail->Password = "Amhgery5dXtVT2T1j+DrcewX8MUiWOkIWme8Mchskv5N";
					$mail->addAddress($to, '');
					$mail->Subject = $subject;
					$mail->Body = $message;
					$mail->setFrom('informacion@musinetwork.com', 'Musinetwork School of Music');		
					
					//Send the message and check for errors
					if (!$mail->send()) {
						//echo "Mailer Error: " . $mail->ErrorInfo;
					} else {
						update_last_interaction($last_interaction['ID'],$lastId);
						//echo 'OI'.$last_interaction['ID'];
						//echo 'NI'.$lastId;
						//die;
						//echo "Message sent!";
					}
				
				
			//fin del EX for
			?>
	
		<?php
	} //end foreach
	
		header('Location: ' . cs_url);
		exit();

} // End if nuevo-mensaje
	
	
if (isset($data['tipo-accion'])) {  
	
		// Se preparan datos para la vista
		
		//Se asigna el contenido de las variables que imprimen el contenido HTML de las plantillas de correo para el operador.
		$infomacionb = htmlentities(utf8_decode('<!-- Correo de información enviado -->
		<p>Te escribimos de <strong>Musinetwork School of Music</strong> para confirmar si recibiste la información que solicitaste hace algunos días y ponernos nuevamente a tus órdenes en caso de que tengas alguna otra duda o comentario.</p><br />
		
		<p>Puedes responder a este correo o si lo prefieres, comunícate a nuestras oficinas  al teléfono <strong>(+1) 617-440-4373 (INTL).</strong></p>'));
		
		$seguimientob = htmlentities(utf8_decode('<!-- Correo de seguimiento enviado -->
		<p>Te escribimos este correo con la finalidad de ponernos a tu disposición por si necesitas resolver cualquier duda o inquietud acerca de <strong>Musinetwork School of Music</strong>.</p><br />
			<p>Te recordamos que las <strong>INSCRIPCIONES</strong> para el ciclo escolar <strong>' . $ciclo_esc . '</strong>, que inicia el <strong>' . $inicio_cur . '</strong>, se encuentran <strong>¡ABIERTAS!</strong></p>
		
			<p>Si tienes interés en integrarte a la escuela, por favor escríbenos para reservar tu espacio. Los lugares disponibles son limitados y damos preferencia a las personas que como tú, ya realizaron un primer contacto con nosotros.</p><br />
			<h3><span style="color:#F36438; line-height:32px;"><strong>INSCRIPCIONES</strong></span></h3>
		<br />
		<p>Cada curso tiene una duración de <strong>3 meses</strong> y su costo es de: <strong>$180 dólares</strong> haciendo un solo pago trimestral, o si lo prefieres, puedes pagarlo en tres mensualidades de <strong>$75 dólares</strong> cada una.</p><br>También tienes la opción de pagar todo el <strong>Programa de Certificación</strong> que consta de <strong>6 cursos</strong> y obtener hasta un 25% de descuento. Puedes realizar un pago único de <strong>$950 dólares</strong> o seis mensualidades de <strong>$165 dólares</strong> cada una.</p><br><br>
		<p>Puedes usar:<br><br><strong>- Tarjeta de crédito</strong> o <strong>débito</strong><br><br><strong>- Transferencia</strong> o <strong>depósito bancario</strong> desde tu banco local<br><br><strong>- Envío de dinero en efectivo</strong> desde cualquier parte del mundo</p><br />
		<p>Solo haz click en:</strong></p><br>
		<p style="text-align:center;"><a style="font-size: 16px" href="http://musinetwork.com/registromn/inscripcion-paso2.php">http://musinetwork.com/registromn/inscripcion-paso2.php</a></p><br>
		<p>&nbsp;</p>'));
		
		$iniciodecursosb = htmlentities(utf8_decode('<!-- Correo de inicio de cursos enviado -->
		<p>Te escribo este correo con la intención de mantener un contacto personalizado contigo y ayudarte a formar parte de <strong>Musinetwork School of Music.</strong></p><br />
			<p>El pasado <strong>' . $inicio_ins . '</strong> las inscripciones para el ciclo escolar <strong>' . $ciclo_esc . '</strong> fueron abiertas y los lugares comenzaron a ser reservados. En caso de querer formalizar tu inscripción, por favor confírmame por este medio para anotarte en la lista de epacios apartados.</p><br />
			<p>Si tienes algún comentario, no dudes en escribirme.</p><br />
			<h3><span style="color:#F36438; line-height:32px;"><strong>INSCRIPCIONES</strong></span></h3>
		<p>Si deseas inscribirte a la escuela de música online, Musinetwork School of Music, es muy sencillo.</p><br />
		<p>Cada curso tiene una duración de <strong>3 meses</strong> y su costo es de: <strong>$180 dólares</strong> haciendo un solo pago trimestral, o si lo prefieres, puedes pagarlo en tres mensualidades de <strong>$75 dólares</strong> cada una.</p><br>También tienes la opción de pagar todo el <strong>Programa de Certificación</strong> que consta de <strong>6 cursos</strong> y obtener hasta un 25% de descuento. Puedes realizar un pago único de <strong>$950 dólares</strong> o seis mensualidades de <strong>$165 dólares</strong> cada una.</p><br><br>
		<p>Puedes usar:<br><br><strong>- Tarjeta de crédito</strong> o <strong>débito</strong><br><br><strong>- Transferencia</strong> o <strong>depósito bancario</strong> desde tu banco local<br><br><strong>- Envío de dinero en efectivo</strong> desde cualquier parte del mundo</p><br />
		<p>Solo haz click en:</strong></p><br>
		<p style="text-align:center;"><a style="font-size: 16px" href="http://musinetwork.com/registromn/inscripcion-paso2.php">http://musinetwork.com/registromn/inscripcion-paso2.php</a></p><br>
		<p>&nbsp;</p>'));
		
		
		$recordatoriodepagosb = htmlentities(utf8_decode('<!-- Recordatorio de pago enviado -->
		<p>Te escribimos con la finalidad de recordarte que tienes reservado un lugar para el Ciclo Escolar <strong>' . $ciclo_esc . '</strong> de <strong>Musinetwork School of Music</strong> con inicio el día <strong>' . $inicio_cur . '</strong></p><br />
			<p>Con la intención de respetar tu lugar reservado, te invitamos a realizar tu pago y completar el proceso de inscripción lo antes posible.</p><br />
			<h3><span style="color:#F36438; line-height:32px;"><strong>INSCRIPCIONES</strong></span></h3>
		<p>Cada curso tiene una duración de <strong>3 meses</strong> y su costo es de: <strong>$180 dólares</strong> haciendo un solo pago trimestral, o si lo prefieres, puedes pagarlo en tres mensualidades de <strong>$75 dólares</strong> cada una.</p><br>También tienes la opción de pagar todo el <strong>Programa de Certificación</strong> que consta de <strong>6 cursos</strong> y obtener hasta un 25% de descuento. Puedes realizar un pago único de <strong>$950 dólares</strong> o seis mensualidades de <strong>$165 dólares</strong> cada una.</p><br><br>
		<p>Puedes usar:<br><br><strong>- Tarjeta de crédito</strong> o <strong>débito</strong><br><br><strong>- Transferencia</strong> o <strong>depósito bancario</strong> desde tu banco local<br><br><strong>- Envío de dinero en efectivo</strong> desde cualquier parte del mundo</p><br />
		<p>Solo haz click en:</strong></p><br>
		<p style="text-align:center;"><a style="font-size: 16px" href="http://musinetwork.com/registromn/inscripcion-paso2.php">http://musinetwork.com/registromn/inscripcion-paso2.php</a></p><br>
		<p>&nbsp;</p>'));
		
		$completarinscripcionb = htmlentities(utf8_decode('<!-- Recordatorio de pago enviado -->
		<p>Te escribo para recordarte que tienes reservado un lugar para el ciclo escolar <strong>' . $ciclo_esc . '</strong> de <strong>Musinetwork School of Music</strong> con inicio el día <strong>' . $inicio_cur . '</strong></p><br />
			<p>Para asegurar tu lugar en el ciclo, te invitamos a realizar tu pago y completar el proceso de inscripción lo antes posible. Si necesitas un lapso mayor de tiempo para inscribirte, te pido me escribas a la brevedad para seguir apartando tu espacio.</p><br />
			<h3><span style="color:#F36438; line-height:32px;"><strong>INSCRIPCIONES</strong></span></h3>
		<br />
		<p>Cada curso tiene una duración de <strong>3 meses</strong> y su costo es de: <strong>$180 dólares</strong> haciendo un solo pago trimestral, o si lo prefieres, puedes pagarlo en tres mensualidades de <strong>$75 dólares</strong> cada una.</p><br>También tienes la opción de pagar todo el <strong>Programa de Certificación</strong> que consta de <strong>6 cursos</strong> y obtener hasta un 25% de descuento. Puedes realizar un pago único de <strong>$950 dólares</strong> o seis mensualidades de <strong>$165 dólares</strong> cada una.</p><br><br>
		<p>Puedes usar:<br><br><strong>- Tarjeta de crédito</strong> o <strong>débito</strong><br><br><strong>- Transferencia</strong> o <strong>depósito bancario</strong> desde tu banco local<br><br><strong>- Envío de dinero en efectivo</strong> desde cualquier parte del mundo</p><br />
		<p>Solo haz click en:</strong></p><br>
		<p style="text-align:center;"><a style="font-size: 16px" href="http://musinetwork.com/registromn/inscripcion-paso2.php">http://musinetwork.com/registromn/inscripcion-paso2.php</a></p><br>
		<p>&nbsp;</p>'));

}

$data['leads_info'] = $leads_info;	
//print_array($data);
//Llamando una vista
view('componer-mensaje', compact('data'));



