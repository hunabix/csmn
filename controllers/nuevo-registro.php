<?php
/*
* Controlador de Nuevo registro
*/

$user = confirm_logged_in(); //revisa si el operador ha ingresado

$data = readRawPost(array_values($_POST));
//print_array($data);

global $connection;
//COMIENZA A PROCESAR EL DOCUMENTO

$nombre = ""; $apellidos = ""; $mail = ""; $telefono = ""; $instrumento = "";
$pais = ""; $ciudad = ""; $medio_contacto = ""; 
$info_sobre[1] = ""; $info_sobre[2] = ""; $info_sobre[3] = ""; $info_sobre[4] = ""; $info_sobre[5] = ""; $info_sobre[6] = ""; $info_sobre[7] = "";
$info_cursos[1] = ""; $info_cursos[2] = "";  $info_cursos[3] = "";  $info_cursos[4] = "";  $info_cursos[5] = "";  $info_cursos[6] = "";
$info_cert[1] = ""; $info_cert[2] = ""; $info_cert[3] = ""; $info_cert[4] = ""; $info_cert[5] = "";
$mensaje_int =""; $mensaje_op=""; $asunto="Equipo Musinetwork"; $responder_ahora='no'; $firma='';
$inicio_ins = ''; $inicio_cur = '';	$ciclo_esc = ''; $tipo_respuesta = '';

if (isset($data['nuevo-mensaje'])) { // el formulario ha sido enviado

	// ------------------------------------------------------------ ------------//
	// ---------  SI ESTA CORRECTO TODO, SE PROCESA LA INFORMACIÓN  ------------//
	// -------------------------------------------------------------------------//
	if(isset($data['nombre'])){ $nombre = utf8_decode($data['nombre']); }
	if(isset($data['apellidos'])){ $apellidos = utf8_decode($data['apellidos']); }
	if(isset($data['correo'])){ $mail = $data['correo']; }
	if(isset($data['telefono'])){ $telefono = $data['telefono']; }
	if(isset($data['instrumento'])){ $instrumento = utf8_decode($data['instrumento']); }
	if(isset($data['pais'])){ $pais = utf8_decode($data['pais']); }
	if(isset($data['ciudad'])){ $ciudad = utf8_decode($data['ciudad']);	}
    if(isset($data['medio_contacto'])){ $medio_contacto = utf8_decode($data['medio_contacto']); }
	if(isset($data['info_sobre1'])){ $info_sobre[1] = 1; }
    if(isset($data['info_sobre2'])){ $info_sobre[2] = 1; }
	if(isset($data['info_sobre3'])){ $info_sobre[3] = 1; }
	if(isset($data['info_sobre4'])){ $info_sobre[4] = 1; }
	if(isset($data['info_sobre5'])){ $info_sobre[5] = 1; }
	if(isset($data['info_sobre6'])){ $info_sobre[6] = 1; }
	if(isset($data['info_sobre7'])){ $info_sobre[7] = 1; }
	if(isset($data['info_cursos1'])){ $info_cursos[1] = 1; } 
	if(isset($data['info_cursos2'])){ $info_cursos[2] = 1; }
	if(isset($data['info_cursos3'])){ $info_cursos[3] = 1; }
	if(isset($data['info_cursos4'])){ $info_cursos[4] = 1; }
	if(isset($data['info_cursos5'])){ $info_cursos[5] = 1; }
	if(isset($data['info_cursos6'])){ $info_cursos[6] = 1; }
	if(isset($data['info_cert1'])){ $info_cert[1] = 1; }
	if(isset($data['info_cert2'])){ $info_cert[2] = 1; }
	if(isset($data['info_cert3'])){ $info_cert[3] = 1; }
	if(isset($data['info_cert4'])){ $info_cert[4] = 1; }
	if(isset($data['info_cert5'])){ $info_cert[5] = 1; }
	if(isset($data['mensaje_int'])){ $mensaje_int = utf8_decode($data['mensaje_int']); }
	if(isset($data['responder_ahora'])){ $responder_ahora = utf8_decode($data['responder_ahora']); }	
	if(isset($data['asunto'])){ $asunto = $data['asunto']; }	
	if(isset($data['mensaje_op'])){ $mensaje_op = stripslashes( utf8_decode($data['mensaje_op'])); }	

	
	// ------------------------------------------------------------ ------------//
	// ---------  ALMACENO INFORMACIÓN EN BD -----------------------------------//
	// -------------------------------------------------------------------------//
	
	// ---------  Se guardan en BD los datos generales del caso en interesado_cs --------------//
	$consulta = "INSERT 
				 INTO interesado_cs (
				 nombre,
				 apellidos,
				 email,
				 telefono,
				 pais,
				 ciudad,
				 instrumento,
				 medio_contacto
				)
				VALUES ('$nombre','$apellidos','$mail', '$telefono', '$pais', '$ciudad', '$instrumento', '$medio_contacto')";
	$resultado = mysql_query($consulta, $connection);
	confirm_query($resultado);
	
	// ---------  Se obtiene el ID del caso que se acaba de guardar --------------//
	$consulta = " SELECT *
			  FROM interesado_cs
			  WHERE nombre = '$nombre' and
			  email = '$mail' 
			  ORDER BY ID ASC";	
	$resultado = mysql_query($consulta, $connection);
	confirm_query($resultado);
	$caso = mysql_fetch_array($resultado);  
	
	// ---------  se guarda en la tabla de intereses_cs los topicos que solicitó el interesado --------------//
	$consulta = "INSERT 
				 INTO intereses_cs (
				 id_interesado,
				 info_sobre_1, info_sobre_2, info_sobre_3, info_sobre_4, info_sobre_5, info_sobre_6, info_sobre_7,
				 info_cursos_1, info_cursos_2, info_cursos_3, info_cursos_4, info_cursos_5, info_cursos_6,
				 info_cert_1, info_cert_2, info_cert_3, info_cert_4, info_cert_5
				)
				VALUES (
				'$caso[ID]',
				'$info_sobre[1]', '$info_sobre[2]', '$info_sobre[3]', '$info_sobre[4]', '$info_sobre[5]', '$info_sobre[6]', '$info_sobre[7]',
				'$info_cursos[1]', '$info_cursos[2]', '$info_cursos[3]', '$info_cursos[4]', '$info_cursos[5]', '$info_cursos[6]',
				'$info_cert[1]', '$info_cert[2]', '$info_cert[3]', '$info_cert[4]', '$info_cert[5]')";
	$resultado = mysql_query($consulta, $connection);
	confirm_query($resultado);
	
	// ---------  Se guarda en la tabla de interaccion_cs  el alta del registro--------------//
	$fecha = date("Y-m-d H:i:s");
	$observaciones = utf8_decode('El caso se dió de alta desde el Centro de Seguimiento MN');
	$consulta = "INSERT 
				 INTO interaccion_cs (
				 tipo,
				 id_interesado,
				 fecha,
				 mensaje_op,
				 mensaje_int,
				 observaciones
				)
				VALUES ('Nuevo caso de seguimiento','$caso[ID]', '$fecha', '', '$mensaje_int', '$observaciones')";
	$resultado = mysql_query($consulta, $connection);
	confirm_query($resultado);
	
	//actualizo el recordatorio
	$configuracion = obten_configuracion();	
	actualiza_recordatorio($configuracion['temporada'], 'Nuevo caso de seguimiento', $fecha, $caso['ID'], 0);
	
	// ---------  Se guarda en la tabla de interaccion_cs  si se ha respondido al interesado --------------//
	if($responder_ahora == 'si'){
		$fecha = date("Y-m-d H:i:s", (strtotime ("+1 Seconds")));
		$observaciones = utf8_decode('Se respondió al usuario al momento de registrar elcaso desde "Nuevo registro"');
		$tipo_estatus = utf8_decode('Se respondió al interesado');
		$consulta = "INSERT 
					 INTO interaccion_cs (
					 tipo,
					 id_interesado,
					 fecha,
					 mensaje_op,
					 mensaje_int,
					 observaciones
					)
					VALUES ('$tipo_estatus','$caso[ID]', '$fecha', '$mensaje_op', '', '$observaciones')";
		$resultado = mysql_query($consulta, $connection);
	confirm_query($resultado);
	//actualizo el recordatorio
	actualiza_recordatorio($configuracion['temporada'], 'Se respondió al interesado', $fecha, $caso['ID'], 0);
	
	}
	
	// -----------------------------------------------------------------------------------//
	// --------------------  SE GUARDA EN LISTA DE SENDY --------------------------//
	// -----------------------------------------------------------------------------------//
				 
	$urltopost = "http://www.musinetwork.com/mailing/subscribe.php"; //The url where you want to post your data to
	$datatopost = array (
	'name' => $nombre,
	'email' => $mail,
	'Last' => '',
	'Phone' => $telefono,
	'Instrument' => $instrumento,
	'Country' => $pais,
	'City' => $ciudad,
	'list' => 'hTexKGgnjIpXuuDyTR7xcQ',
	'submit' => true,
	); //The post data as an associative array. The keys are the post variables
	
	$ch = curl_init ($urltopost); //Initializes cURL
	curl_setopt ($ch, CURLOPT_POST, true); //Tells cURL that we want to send post data
	curl_setopt ($ch, CURLOPT_POSTFIELDS, $datatopost); //Tells cURL what are post data is
	curl_setopt ($ch, CURLOPT_RETURNTRANSFER, true); //Tells cURL to return the output of the post
	//$returndata = curl_exec ($ch); //Executes the cURL and saves theoutput in $returndata //DEV - descomentar para producción
	//echo $returndata;
	
	if($responder_ahora == 'si'){
		
		/*if(isset($data['nombre'])){  $nombre = $data['nombre']; }*/
		if(isset($data['tipo'])){  $tipo = utf8_decode($data['tipo']); }
		if(isset($data['mensaje_op'])){ $mensaje_op = utf8_decode($data['mensaje_op']); }
		if(isset($data['firma'])){ $firma = $data['firma']; }

		//Obtenemos la información de configuración para imprimirla en mails y scripts de plantillas
		// ---------  Se obtiene las fechas de inscripción e inicio de cursos --------------//
		
		$configuracion = obten_configuracion();
		// Se guarda la consulta en variables
		$inicio_ins = $configuracion['inicio_ins'];
		$inicio_cur = $configuracion['inicio_cur'];
		$ciclo_esc = $configuracion['ciclo_esc'];
		
		// Formateamos fecha d einscripción
		$inicio_ins = explode("-",$inicio_ins);
		$y = $inicio_ins[0];
		$m = $inicio_ins[1];
		$d = $inicio_ins[2];
		$m = genMonth_Text($m);
		$inicio_ins = $d . ' de ' . $m . ' del ' . $y;
		
		// Formateamos decha de inicio de cursos
		$inicio_cur = explode("-",$inicio_cur);
		$y = $inicio_cur[0];
		$m = $inicio_cur[1];
		$d = $inicio_cur[2];
		$m = genMonth_Text($m);
		$inicio_cur = $d . ' de ' . $m . ' del ' . $y;
			
		//Casos posibles: Se respondió al interesado*, Correo de información enviado, Correo de seguimiento enviado, Correo de inicio de cursos enviado, Recordatorio de pago enviado
		$mail_a_enviar = utf8_encode($tipo);
		if ($mensaje_op != '') {
			$mensaje_op = stripslashes( $mensaje_op ); // Luego de grabar el mensaje en la DB, elimina los "/" (slashes) insertados por KCEditor para que aparezcan las imágenes y agrega un salto de línea para que se vea bonito en el mail :)
		}
	
	switch ( $mail_a_enviar ) {
		
		case 'Se respondió al interesado';
		$asuntop = 'Respuesta - Musinetwork School of Music';
		$msj_introductorio = '';
		$texto_personalizado = $mensaje_op . '<br />';
		break;
		
		case 'Correo de información enviado';
		$msj_introductorio = '<p style="margin-bottom: 10px;">Te escribimos de <strong>Musinetwork School of Music</strong>; quisiéramos saber si recibiste nuestra información y por otro lado, nos ponemos nuevamente a tus órdenes en caso de que tengas alguna otra duda o comentario.</p>';
		$texto_personalizado = $mensaje_op . '<p style="margin-bottom: 18px;">En caso de tener nuevas inquietudes puedes responder a este correo  o si lo prefieres comunícate a nuestras oficinas  al teléfono <strong>(+1) 617-440-4373 (INTL).</strong></p>';
		break;
		
		case 'Correo de seguimiento enviado';
		$asuntop = 'Seguimiento - Musinetwork School of Music';
		$msj_introductorio = '<p style="margin-bottom: 18px;">Te escribimos este correo con la finalidad de ponernos a tu disposición si necesitas resolver cualquier otra duda o inquietud acerca <strong>Musinetwork School of Music</strong>.</p>
		<p style="margin-bottom: 18px;">Te comentamos que que las <strong>INSCRIPCIONES</strong> para el ciclo escolar <strong>' . $ciclo_esc . '</strong> que inician el <strong>' . $inicio_cur . '</strong> se encuentran <strong>¡ABIERTAS!</strong></p>';
		$texto_personalizado = $mensaje_op . '<p style="margin-bottom: 18px;">Si tienes interés de integrarte a la escuela, por favor escríbenos para reservar tu espacio. Los lugares disponibles son limitados y damos preferencia a las personas que como tú, ya realizaron un primer contacto con nosotros.</p>';
		break;
		
		case 'Correo de inicio de cursos enviado';
		$asuntop = 'Inicio de Cursos - Musinetwork School of Music';
		$msj_introductorio = '<p style="margin-bottom: 18px;">Te escribo este correo con la intención de mantener un contacto personalizado contigo y ayudarte a formar parte de <strong>Musinetwork School of Music.</strong></p>
		<p style="margin-bottom: 18px;">El pasado <strong>' . $inicio_ins . '</strong> las inscripciones para el ciclo escolar <strong>' . $ciclo_esc . '</strong> fueron abiertas y los lugares comenzaron a ser reservados. En caso de querer formalizar tu inscripción, por favor confírmame por este medio para anotarte en la lista de epacios apartados.</p><p style="margin-bottom: 18px;">Te recuerdo que los cursos inician el <strong>' . $inicio_cur . '</strong>';
		$texto_personalizado = $mensaje_op . '<p style="margin-bottom: 18px;">Si tienes algún comentario, no dudes en escríbeme.</p>';
		break;
		
		case 'Recordatorio de pago enviado';
		$asuntop = 'Reservación de Lugar - Musinetwork School of Music';
		$msj_introductorio = '<p style="margin-bottom: 18px;">Te escribo para recordarte que tienes reservado un lugar para el ciclo escolar <strong>' . $ciclo_esc . '</strong> de <strong>Musinetwork School of Music</strong> con inicio el día <strong>' . $inicio_cur . '</strong></p>';
		$texto_personalizado = $mensaje_op. '<p style="margin-bottom: 18px;">Para asegurar tu lugar en el ciclo, te invitamos a realizar tu pago y completar el proceso de inscripción lo antes posible. Si necesitas un lapso mayor de tiempo para inscribirte, te pido me escribas a la brevedad para seguir apartando tu espacio.</p>';
		break;
	}
	$info_inscripciones = '<h3 style="color:#F36438; font-weight: bold; line-height:32px;">INSCRIPCIONES</h3>
	<p style="margin-bottom: 18px;">Cada curso tiene un <strong>costo</strong> de: <strong>$180</strong> dólares haciendo un pago trimestral, o si lo prefieres <strong>$75 dólares</strong> pagando mensualmente, solo escoge el método de pago que mejor te convenga.</p>
	<p style="margin-bottom: 18px;">Para realizar tu pago de inscripción puedes utilizar  <strong>tarjeta de crédito, envío de dinero en  efectivo o depósito bancario.</strong></p>
	<p style="text-align:center;"><strong>Para consultar las formas de pago haz click en el siguiente link:</strong></p><br />
	<p style="text-align:center;"><a style="font-size: 16px" href="http://musinetwork.com/registromn/inscripcion-paso2.php">http://musinetwork.com/registromn/inscripcion-paso2.php</a></p>';

	/* Se elige la firma a ser imprimida */	
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
			$message .= '<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center" style="background-color: #fff; '; 
			$message .= 'font-family: Trebuchet MS, Arial, Helvetica, sans-serif;"><tr><td>';
			$message .= '<!-- Tabla principal -->';
			$message .= '<table width="750px" border="0" cellspacing="0" cellpadding="0" align="center" style="background-color: #ffffff; font-size:14px;">';
			$message .= '<!-- Tabla contenedor -->';
			$message .= '<tr><td><!-- header -->';
			$message .= '<a href="http://musinetwork.com"><img src="http://musinetwork.com/centro-seguimiento/imagenes/header-mails-cs.jpg"></a>';
			$message .= '</td></tr><!-- cierra header -->';
			$message .= '<tr style="text-align:justify;"><td><!-- Contenedor principal -->';
			$message .= '<h3 style="padding-top: 30px;"><strong>Hola '. $nombre . ',</strong></h3>';
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
			//$to = $mail; DEV
			$to = 'hibamiru@gmail.com';
			//$to = 'musinetwork@gmail.com';
			//$to = 'hibamiru@gmail.com'; //mnmail
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
				//echo "Message sent!";
			}

	}
	header('Location: ' . cs_url);
	
}  




else // fin el formulario ha sido enviado









{  //Si no se envio formulario se hace esto
//Se asigna el contenido de las variables que imprimen el contenido HTML de las plantillas de correo para el operador.
$infomacionb = htmlentities(utf8_decode('<!-- Correo de información enviado -->
<p>Te escribimos de <strong>Musinetwork School of Music</strong> para confirmar si recibiste la información que solicitaste hace algunos días y ponernos nuevamente a tus órdenes en caso de que tengas alguna otra duda o comentario.</p><br />

<p>Puedes responder a este correo o si lo prefieres, comunícate a nuestras oficinas al teléfono <strong>(+1) 617-440-4373 (INTL).</strong></p>'));

$seguimientob = htmlentities(utf8_decode('<!-- Correo de seguimiento enviado -->
<p>Te escribimos este correo con la finalidad de ponernos a tu disposición por si necesitas resolver cualquier duda o inquietud acerca de <strong>Musinetwork School of Music</strong>.</p><br />
		<p>Te recordamos que las <strong>INSCRIPCIONES</strong> para el ciclo escolar <strong>' . $ciclo_esc . '</strong>, que inicia el <strong>' . $inicio_cur . '</strong>, se encuentran <strong>¡ABIERTAS!</strong></p>

		<p>Si tienes interés en integrarte a la escuela, por favor escríbenos para reservar tu lugar. Los lugares disponibles son limitados y damos preferencia a las personas que como tú, ya realizaron un primer contacto con nosotros.</p><br />
        <h3><span style="color:#F36438; line-height:32px;"><strong>INSCRIPCIONES</strong></span></h3>
	<br />
	<p>Cada curso tiene una duración de 3 meses y su <strong>costo</strong> es de: <strong>$180</strong> dólares haciendo un solo pago trimestral, o si lo prefieres, puedes pagarlo en tres mensualidades de <strong>$75 dólares</strong> cada una.</p>
	<p>Para realizar tu pago de inscripción puedes utilizar  <strong>tarjeta de crédito, envío de dinero en  efectivo o depósito bancario.</strong></p><br />
	<p style="text-align:center;"><strong>Para consultar las formas de pago haz click en el siguiente link:</strong></p>
	<p style="text-align:center;"><a style="font-size: 16px" href="http://www.musinetwork.com/pago.html">http://www.musinetwork.com/pago.html</a></p>
<p>&nbsp;</p>'));

$iniciodecursosb = htmlentities(utf8_decode('<!-- Correo de inicio de cursos enviado -->
<p>Te escribo este correo con la intención de mantener un contacto personalizado contigo para ayudarte a formar parte de <strong>Musinetwork School of Music.</strong></p><br />
		<p>El pasado <strong>' . $inicio_ins . '</strong> las inscripciones para el ciclo escolar <strong>' . $ciclo_esc . '</strong> fueron abiertas y los lugares comenzaron a ser reservados. En caso de querer formalizar tu inscripción, por favor escríbeme para anotarte en la lista de espacios apartados.</p><br />
		<p>Si tienes algú comentario, no dudes en escribirme.</p><br />
        <h3><span style="color:#F36438; line-height:32px;"><strong>INSCRIPCIONES</strong></span></h3>
	<br />
	<p>Cada curso tiene una duración de 3 meses y su <strong>costo</strong> es de: <strong>$180</strong> dólares haciendo un solo pago trimestral, o si lo prefieres, puedes pagarlo en tres mensualidades de <strong>$75 dólares</strong> cada una.</p>
	<p>Para realizar tu pago de inscripción puedes utilizar  <strong>tarjeta de crédito, envío de dinero en  efectivo o depósito bancario.</strong></p><br />
	<p style="text-align:center;"><strong>Para consultar las formas de pago haz click en el siguiente link:</strong></p>
	<p style="text-align:center;"><a style="font-size: 16px" href="nuevo-registro.php">nuevo-registro.php</a></p>
	<p>&nbsp;</p>'));

$recordatoriodepagosb = htmlentities(utf8_decode('<!-- Recordatorio de pago enviado -->
<p>Te escribimos con la finalidad de recordarte que tienes reservado un lugar para el Ciclo Escolar <strong>' . $ciclo_esc . '</strong> de <strong>Musinetwork School of Music</strong> con inicio el día <strong>' . $inicio_cur . '</strong></p><br />
		<p>Con la intención de respetar tu lugar reservado, te invitamos a realizar tu pago y completar el proceso de inscripción lo antes posible.</p><br />
        <h3><span style="color:#F36438; line-height:32px;"><strong>INSCRIPCIONES</strong></span></h3>
	<p>Si deseas inscribirte a la escuela de música online, Musinetwork School of Music, es muy sencillo.</p><br />
	<p>Cada curso tiene una duración de 3 meses y su <strong>costo</strong> es de: <strong>$180</strong> dólares haciendo un solo pago trimestral, o si lo prefieres, puedes pagarlo en tres mensualidades de <strong>$75 dólares</strong> cada una.</p>
	<p>Para realizar tu pago de inscripción puedes utilizar  <strong>tarjeta de crédito, envío de dinero en  efectivo o depósito bancario.</strong></p><br />
	<p style="text-align:center;"><strong>Para consultar las formas de pago haz click en el siguiente link:</strong></p>
	<p style="text-align:center;"><a style="font-size: 16px" href="http://www.musinetwork.com/pago.html">http://www.musinetwork.com/pago.html</a></p>
<p>&nbsp;</p>'));
		

}

$notifications = filter_notifications_by_date(get_active_notifications());
// print_array($notifications);
		
//Llamando una vista
view('nuevo-registro', compact('user', 'notifications'));

