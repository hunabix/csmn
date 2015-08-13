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
	

			// -----------------------------------------------------------------//
			// ---------  SE PREPARA Y ENVÍA EL EMAIL AL ALUMNO  --------------//
			// ----------------------------------------------------------------//
			 
			$message = $mensaje_op;

			//Calling library and setting up credentials for Amazon SES
			require_once "lib/PHPMailer/PHPMailerAutoload.php";
			$host = "ssl://email-smtp.us-east-1.amazonaws.com";
			$port = "465";
			$username = "AKIAIXA2XV6TZOOCK5KQ";
			$password = "Amhgery5dXtVT2T1j+DrcewX8MUiWOkIWme8Mchskv5N";
			$to = $mail;
			//$to = 'musinetwork@gmail.com';
			$to = 'hibamiru@gmail.com';
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

$notifications = filter_notifications_by_date_and_status(get_active_notifications());
// print_array($notifications);
		
//Llamando una vista
view('nuevo-registro', compact('user', 'notifications'));