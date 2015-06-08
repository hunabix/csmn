<?php require_once("includes/header.php"); ?>

<?php //COMIENZA A PROCESAR EL DOCUMENTO

$nombre = ""; $mail = ""; $telefono = ""; $instrumento = "";
$pais = ""; $ciudad = ""; $medio_contacto = ""; 
$info_sobre[1] = ""; $info_sobre[2] = ""; $info_sobre[3] = ""; $info_sobre[4] = ""; $info_sobre[5] = ""; $info_sobre[6] = ""; $info_sobre[7] = "";
$info_cursos[1] = ""; $info_cursos[2] = "";  $info_cursos[3] = "";  $info_cursos[4] = "";  $info_cursos[5] = "";  $info_cursos[6] = "";
$info_cert[1] = ""; $info_cert[2] = ""; $info_cert[3] = ""; $info_cert[4] = ""; $info_cert[5] = "";
$mensaje_int =""; $mensaje_op=""; $asunto="Equipo Musinetwork"; $responder_ahora='no'; $firma='';
$inicio_ins = ''; $inicio_cur = '';	$ciclo_esc = ''; $tipo_respuesta = '';

if (isset($_POST['nuevo-registro-btn'])) { // el formulario ha sido enviado

	// ------------------------------------------------------------ ------------//
	// ---------  SI ESTA CORRECTO TODO, SE PROCESA LA INFORMACIÓN  ------------//
	// -------------------------------------------------------------------------//
	if(isset($_POST['nombre'])){ $nombre = utf8_decode($_POST['nombre']); }
	if(isset($_POST['mail'])){ $mail = $_POST['mail']; }
	if(isset($_POST['telefono'])){ $telefono = $_POST['telefono']; }
	if(isset($_POST['instrumento'])){ $instrumento = utf8_decode($_POST['instrumento']); }
	if(isset($_POST['pais'])){ $pais = utf8_decode($_POST['pais']); }
	if(isset($_POST['ciudad'])){ $ciudad = utf8_decode($_POST['ciudad']);	}
    if(isset($_POST['medio_contacto'])){ $medio_contacto = utf8_decode($_POST['medio_contacto']); }
	if(isset($_POST['info_sobre1'])){ $info_sobre[1] = 1; }
    if(isset($_POST['info_sobre2'])){ $info_sobre[2] = 1; }
	if(isset($_POST['info_sobre3'])){ $info_sobre[3] = 1; }
	if(isset($_POST['info_sobre4'])){ $info_sobre[4] = 1; }
	if(isset($_POST['info_sobre5'])){ $info_sobre[5] = 1; }
	if(isset($_POST['info_sobre6'])){ $info_sobre[6] = 1; }
	if(isset($_POST['info_sobre7'])){ $info_sobre[7] = 1; }
	if(isset($_POST['info_cursos1'])){ $info_cursos[1] = 1; } 
	if(isset($_POST['info_cursos2'])){ $info_cursos[2] = 1; }
	if(isset($_POST['info_cursos3'])){ $info_cursos[3] = 1; }
	if(isset($_POST['info_cursos4'])){ $info_cursos[4] = 1; }
	if(isset($_POST['info_cursos5'])){ $info_cursos[5] = 1; }
	if(isset($_POST['info_cursos6'])){ $info_cursos[6] = 1; }
	if(isset($_POST['info_cert1'])){ $info_cert[1] = 1; }
	if(isset($_POST['info_cert2'])){ $info_cert[2] = 1; }
	if(isset($_POST['info_cert3'])){ $info_cert[3] = 1; }
	if(isset($_POST['info_cert4'])){ $info_cert[4] = 1; }
	if(isset($_POST['info_cert5'])){ $info_cert[5] = 1; }
	if(isset($_POST['mensaje_int'])){ $mensaje_int = utf8_decode($_POST['mensaje_int']); }
	if(isset($_POST['responder_ahora'])){ $responder_ahora = utf8_decode($_POST['responder_ahora']); }	
	if(isset($_POST['asunto'])){ $asunto = $_POST['asunto']; }	
	if(isset($_POST['mensaje_op'])){ $mensaje_op = stripslashes( utf8_decode($_POST['mensaje_op'])); }	

	
	// ------------------------------------------------------------ ------------//
	// ---------  ALMACENO INFORMACIÓN EN BD -----------------------------------//
	// -------------------------------------------------------------------------//
	
	// ---------  Se guardan en BD los datos generales del caso en interesado_cs --------------//
	$consulta = "INSERT 
				 INTO interesado_cs (
				 nombre,
				 email,
				 telefono,
				 pais,
				 ciudad,
				 instrumento,
				 medio_contacto
				)
				VALUES ('$nombre','$mail', '$telefono', '$pais', '$ciudad', '$instrumento', '$medio_contacto')";
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
		
		/*if(isset($_POST['nombre'])){  $nombre = $_POST['nombre']; }*/
		if(isset($_POST['tipo'])){  $tipo = utf8_decode($_POST['tipo']); }
		if(isset($_POST['mensaje_op'])){ $mensaje_op = utf8_decode($_POST['mensaje_op']); }
		if(isset($_POST['firma'])){ $firma = $_POST['firma']; }

		//Obtenemos la información de configuración para imprimirla en mails y scripts de plantillas
		// ---------  Se obtiene las fechas de inscripción e inicio de cursos --------------//
		
		$configuracion = obten_configuracion();
		// Se guarda la consulta en variables
		$inicio_ins = $configuracion['inicio_ins'];
		$inicio_cur = $configuracion['inicio_cur'];
		$ciclo_esc = $configuracion['ciclo_esc'];
		
		// Función que convierte meses de número a texto
		function genMonth_Text($m) {
			switch ($m) {
				case 01: $month_text = "Enero"; break;
				case 02: $month_text = "Febrero"; break;
				case 03: $month_text = "Marzo"; break;
				case 04: $month_text = "Abril"; break;
				case 05: $month_text = "Mayo"; break;
				case 06: $month_text = "Junio"; break;
				case 07: $month_text = "Julio"; break;
				case 08: $month_text = "Agosto"; break;
				case 09: $month_text = "Septiembre"; break;
				case 10: $month_text = "Octubre"; break;
				case 11: $month_text = "Noviembre"; break;
				case 12: $month_text = "Diciembre"; break;
			}
			return ($month_text);
		}
		
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

			//headers must be an array
			
			$from = "Musinetwork School of Music <informacion@musinetwork.com>";
			//$to = $mail; //DEV descomentar
			$to = 'soporte@inovanto.com'; //DEV comentar
			$subject = base64_encode( $asuntop ) ;
			$headers = array (
				'From' => $from,
				'To' => $to,
				'Subject' => "=?UTF-8?B?" . $subject . "?=",
				'MIME-Version' => '1.0',
				'Content-Type' => 'text/html; charset=utf-8',
				'Content-Transfer-Encoding' => '8bit',
				//'Reply-To' => 'reply@address.com' 
			);
			
			//$to = $mail;
			//$subject = $asuntop;
			
			//$headers = "From: Musinetwork School of Music <informacion@musinetwork.com>\r\n";
			//$headers = "From: informacion@musinetwork.com\r\n";
			//$headers .= "MIME-Version: 1.0\r\n";
			//$headers .= "Content-Type: text/html; charset=utf-8\r\n";
			 
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
			 
			require_once "../smtp-mailer/Mail.php"; // calls pear mail packages
			$host = "ssl://email-smtp.us-east-1.amazonaws.com";
			$port = "465";
			$username = "AKIAIXA2XV6TZOOCK5KQ";
			$password = "Amhgery5dXtVT2T1j+DrcewX8MUiWOkIWme8Mchskv5N";
			
			$smtp = Mail::factory('smtp', //prepares smtp vars
			array ('host' => $host,
			 'port' => $port,
			 'auth' => true,
			 'username' => $username,
			 'password' => $password));
			
			//$mail = $smtp->send($to, $headers, $message); //DEV
			
			if (PEAR::isError($mail)) {
			echo("<p>" . $mail->getMessage() . "</p>");
			} else {
			//echo("<p>Message successfully sent!</p>");
			}
			
			//mail($to, $subject, $message, $headers);

	}
	
?>
	<div id="content">
		<h1 class="aviso">Se ha guardado y enviado la información con éxito</h1>
			
		<script type="text/javascript">
			setTimeout(redirige(), '',5000);
			function redirige() {
				window.location="http://dev.musinetwork.com/centro-seguimiento/";
			}
		</script>
	</div><!-- fin #content-->
	
<?php }  // fin el formulario ha sido enviado





else








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

?>
		
<div id="content">
	<h1 class="titulo">Registrar nuevo caso de seguimiento*</h1>
	<div id="nuevo-registro">
		<form method="post" action="nuevo-registro.php">	
			<div id="info-general" class="contenedor full">
				<h3 class="titulo">Datos generales</h3>		
				<input type="text" name="nombre" placeholder="Nombre completo" required/> 
				<input type="email" name="mail" placeholder="Correo electrónico" required/> 
				<input type="text" name="telefono" placeholder="Teléfono(s)" /> 
				<input type="text" name="instrumento" placeholder="Instrumento"/> 
				<select name="pais">
					<?php imprime_paises(); ?>
				</select>
				<input type="text" name="ciudad" placeholder="Ciudad"/> 		
			</div><!-- fin #info-general -->
			
			<div id="info-adicional" class="contenedor full">
				<h3 class="titulo">Información adicional</h3>		
				<p>Medio por el que se enteró de Musinetwork:</p>				
					<label>
					  <input name="medio_contacto" value="Redes Sociales" checked="checked" type="radio">
					  Redes Sociales</label> 
					<label>
					  <input name="medio_contacto" value="Navegando la Web" type="radio">
					  Navegando la Web</label> 
					<label>
					  <input name="medio_contacto" value="Correo Electrónico" type="radio">
					  Correo Electrónico</label> 
					<label>
					  <input name="medio_contacto" value="Recomendación de un amigo" type="radio">
					  Recomendación de un amigo</label> 
    
				<p>Solicitó informes sobre:</p>	
				    <label><input name="info_sobre1" value="Cursos"  type="checkbox">
					Cursos</label> 
					<div class="caja-opciones group">  
						<label>
						<input name="info_cursos1" value="Curso de Preparación" type="checkbox">
						1) Curso de Preparación</label> 
						<label>
						<input name="info_cursos2" value="Teoría y Armonía Popular Contemporánea" type="checkbox">
						2) Teoría y Armonía Popular Contemporánea</label> 
						<label>
						<input name="info_cursos3" value="Arreglo Contemporáneo" type="checkbox">
						3) Arreglo Contemporáneo</label> 
						<label>
						<input name="info_cursos4" value="Estudios en Jazz" type="checkbox">
						4) Estudios en Jazz</label> 
						<label>
						<input name="info_cursos5" value="Historia" type="checkbox">
						5) Historia</label> 
						<label>
						<input name="info_cursos6" value="Ejecución Instrumental" type="checkbox">
						6) Ejecución Instrumental</label> 
					 </div> 
					   
				    <label>
					<input name="info_sobre2" value="Certificaciones" type="checkbox">
					Certificaciones</label> 
					<div class="caja-opciones">    
					    <label>
						<input name="info_cert1" value="Contemporary Musician Certificate" type="checkbox">
						1) Contemporary Musician Certificate</label>
						<label>
						<input name="info_cert2" value="Jazz Studies Certificate" type="checkbox">
						2) Jazz Studies Certificate</label> 
						<label>
						<input name="info_cert3" value="Validez" type="checkbox">
						3) Validez</label> 
						<label>
						<input name="info_cert4" value="Financiamiento" type="checkbox">
						4) Financiamiento</label> 
						<label>
						<input name="info_cert5" value="Duración" type="checkbox">
						5) Duración</label> 
					</div> 
      
					<label>    
					<input name="info_sobre3" value="Metodología" type="checkbox">
					Metodología</label> 
  
					<label>
					<input name="info_sobre4" value="Proceso de Inscripción"type="checkbox">
					Proceso de Inscripción</label> 
					
					<label>
					<input name="info_sobre5" value="Costos y Formas de Pago" type="checkbox">
					Costos y Formas de Pago</label> 
					
					<label>
					<input name="info_sobre6" value="Exámenes de Ingreso" type="checkbox">
					 Exámenes de Ingreso</label> 
					
					<label>
					<input name="info_sobre7" value="Prestigio y Validez" type="checkbox">
					Prestigio y Validez</label> 
			</div><!-- fin #info-general -->
			
			<div class="contenedor full">
				<h3 class="titulo">Mensaje proviniente del usuario</h3>
				<div id="mensaje-int">
					<textarea name="mensaje_int"></textarea>
				</div>		
			</div><!-- fin #info-general -->
			
			<div class="contenedor full">
				<h3 class="titulo">Mensaje de respuesta al usuario</h3>	
				<div id="mensaje-op">
					<label><input name="responder_ahora" value="si" type="checkbox">Responder ahora mismo</label>
                    
                    <h2 class="titulo">Tipo de correo electrónico a redactar</h2>	
		<div id="tipo-mensaje" class="group">
			<label><input name="tipo" value="Se respondió al interesado" type="radio" 
			<?php if ($tipo_respuesta == 'responder') { echo 'checked'; } ?>>
			Respuesta personalizada</label> 
			
			<label><input name="tipo" value="Correo de información enviado" type="radio"
			<?php if ($tipo_respuesta == 'informacion') { echo 'checked'; } ?>>
			Información <button id="infomacionb" class="boton-copiado-pm" data-clipboard-text="<?php echo $infomacionb; ?>" title="Click para copiar plantilla de Información."></button></label> 
			
			<label><input name="tipo" value="Correo de seguimiento enviado" type="radio"
			<?php if ($tipo_respuesta == 'seguimiento') { echo 'checked'; } ?>>
			Seguimiento <button id="seguimientob" class="boton-copiado-pm" data-clipboard-text="<?php echo $seguimientob; ?>" title="Click para copiar plantilla de Seguimiento."></button></label>
			
			<label><input name="tipo" value="Correo de inicio de cursos enviado" type="radio"
			<?php if ($tipo_respuesta == 'inicio') { echo 'checked'; } ?>>
			Inicio de cursos <button id="iniciodecursosb" class="boton-copiado-pm" data-clipboard-text="<?php echo $iniciodecursosb; ?>" title="Click para copiar plantilla de Inicio de cursos."></button></label> 	
			
			<label><input name="tipo" value="Recordatorio de pago enviado" type="radio"
			<?php if ($tipo_respuesta == 'recordatorio') { echo 'checked'; } ?>>
			Recordatorio de pago <button id="recordatoriodepagosb" class="boton-copiado-pm" data-clipboard-text="<?php echo $recordatoriodepagosb; ?>" title="Click para copiar plantilla de Recordatorio de pagos."></button></label> 	
		</div><!-- fin #tipo mensaje -->
                    
					<input style="width: 900px;" type="text" name="asunto" placeholder="Escribe el asunto del correo" />
                    <!-- Se manda a llamar la API de KCeditor -->
		<script src="../centro-seguimiento/ckeditor/ckeditor.js"></script>
        <!-- Se coloca un <textarea> cualquiera y se le asigna un identificador en el nombre -->
        <textarea name="mensaje_op"></textarea>
        <!-- Se coloca el textarea por una instancia de KCeditor colocando el identificador en la llamada al API -->
        <script>CKEDITOR.replace( 'mensaje_op', {
			toolbar : [
				{ name: 'document', groups: [ 'mode', 'document', 'doctools' ], items: [ 'Source', '-', 'Preview', '-', 'Templates' ] },
				{ name: 'clipboard', groups: [ 'clipboard', 'undo' ], items: [ 'Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo' ] },
			{ name: 'editing', groups: [ 'find', 'selection', 'spellchecker' ], items: [ 'Find', 'Replace', '-', 'SelectAll', '-', 'Scayt' ] },
				'/',
				{ name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ], items: [ 'Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript', '-', 'RemoveFormat' ] },
				{ name: 'paragraph', groups: [ 'list', 'indent', 'blocks', 'align', 'bidi' ], items: [ 'NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock', '-', 'BidiLtr', 'BidiRtl' ] },
				{ name: 'links', items: [ 'Link', 'Unlink', 'Anchor' ] },
				{ name: 'insert', items: [ 'Image', 'Table', 'HorizontalRule', 'Smiley', 'SpecialChar' ] },
				'/',
				{ name: 'styles', items: [ 'Styles', 'Format', 'Font', 'FontSize' ] },
				{ name: 'colors', items: [ 'TextColor' ] },
				{ name: 'tools', items: [ 'Maximize', 'ShowBlocks' ] },
				{ name: 'others', items: [ '-' ] },
				{ name: 'about', items: [ 'About' ] },
			],
			templates_files : [ '../centro-seguimiento/ckeditor/plugins/templates/templates/cs-mail-templates.php' ]
			} );
		</script>
				</div><!-- #mensaje-op -->
                
<!-- Scripts para los botones de copiado del contenido las plantillas de correo -->
		    <script src="http://dev.musinetwork.com/centro-seguimiento/zc/ZeroClipboard.js"></script>
		    <script>
				var clip = new ZeroClipboard( document.getElementById("infomacionb"), {
				  moviePath: "http://dev.musinetwork.com/centro-seguimiento/zc/ZeroClipboard.swf"} );
				var clip = new ZeroClipboard( document.getElementById("seguimientob"), {
				  moviePath: "http://dev.musinetwork.com/centro-seguimiento/zc/ZeroClipboard.swf"} );
				var clip = new ZeroClipboard( document.getElementById("iniciodecursosb"), {
				  moviePath: "http://dev.musinetwork.com/centro-seguimiento/zc/ZeroClipboard.swf"} );
				var clip = new ZeroClipboard( document.getElementById("recordatoriodepagosb"), {
				  moviePath: "http://dev.musinetwork.com/centro-seguimiento/zc/ZeroClipboard.swf"} );

				clip.on( 'load', function(client) {
				  // alert( "movie is loaded" );
				} );

				clip.on( 'complete', function(client, args) {
				  this // "this" is the element that was clicked

				} );
				
				clip.on( 'mouseover', function(client) {
				  // alert("mouse over");
				} );
				
				clip.on( 'mouseout', function(client) {
				  // alert("mouse out");
				} );
				
				clip.on( 'mousedown', function(client) {
				
				  // alert("mouse down");
				} );
				
				clip.on( 'mouseup', function(client) {
				  // alert("mouse up");
				} );
    		</script>
			<!-- Scripts -->

                
                <!-- FIRMAS PERSONALIZADAS -->
        <h2 class="titulo">Firma del mensaje</h2>	
        <div id="firma-mensaje" class="group">
			<label><input name="firma" value="Equipo Musinetwork" type="radio" checked>
			Equipo Musinetwork</label> 
			
			<label><input name="firma" value="Laura Ortíz Alemán" type="radio">
			Laura Ortíz Alemán</label> 
			
			<label><input name="firma" value="Marichú García Salazar" type="radio">
			Marichú García Salazar</label> 
			
			<label><input name="firma" value="Lucy Morales" type="radio">
			Lucy Morales</label>
		</div><!-- fin #firma mensaje -->
			</div><!-- .contenedor full -->
			
			<input name="nuevo-registro-btn" type="submit" id="submit" value="Finalizar" class="btn"/>
		</form>
	</div>

</div><!-- fin #content-->  

<?php } require_once("includes/footer.php"); ?>