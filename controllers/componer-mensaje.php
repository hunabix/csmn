<?php
/*
* Controlador de Componer mensaje
*/

$user = confirm_logged_in(); //revisa si el operador ha ingresado

//Get post data
$data = readRawPost(array_values($_POST));

// print_array($data);
// die;

//Initialize lead_ids
$lead_ids = array();

// Process lead ids
if (isset($data['formulario'])) { // Individual form
	if ($data['formulario'] == 'em-form') { // Individual form
		$lead_ids[0] = $data['lead-id'];
	}
}

if (isset($data['formulario'])) { // Individual form
	if ($data['formulario'] == 'em-mag-form') { // Multiform 
		$lead_ids = extract_checkbox_ids($data);
	}
}

if (isset($data['nuevo-mensaje'])) { // Enviar
	$lead_ids = extract_interesado_ids($data);
}

// Redirects to home when no ids are available
if (!$lead_ids)
	header('Location: ' . cs_url);

// Get leads info
foreach ($lead_ids as $lead_id => $id) {
		$leads_info['lead_'.$id] = get_lead_info_by_id($id);
}

// Se obtienen firmas
$firmas = obtener_firmas($user);
//print_array($firmas);

// Se obtiene las fechas de inscripción e inicio de cursos
$configuracion = obten_configuracion();

// print_array($configuracion);

// Se guarda la consulta en variables
$ciclo_esc = $configuracion['ciclo_esc'];
$current_dates = get_current_dates_by_ce($ciclo_esc, $configuracion);
$inicio_ins = $current_dates['inicio_ins'];
$cierre_ins = $current_dates['cierre_ins'];
$inicio_cur = $current_dates['inicio_cur'];


// Formateamos fecha de inscripción
$inicio_ins = fecha_inscripcion($inicio_ins);

// Formateamos decha de inicio de cursos
$inicio_cur = fecha_inicio_cursos($inicio_cur);


// Process new message if it's send
if (isset($data['nuevo-mensaje'])) {
	// echo 'pasó';
	// die;
	//Mensajes generales	
	if(isset($data['tipo'])){  $tipo = utf8_decode($data['tipo']); }
	if(isset($data['mensaje_op'])){ $mensaje_op = utf8_decode($data['mensaje_op']); }
	if(isset($data['firma'])){ $firma = $data['firma']; }
	if(isset($data['comentarios'])){  $comentarios = utf8_decode($data['comentarios']); }
	if(isset($data['asunto'])){  $asunto = utf8_decode($data['asunto']); }


	if ($firma == 'Equipo Musinetwork') {
	
		$firma = '<strong>Equipo Musinetwork</strong><br />';
	
	} else {
		
		if ($user['tipo'] == 'administrador') {

			foreach ($firmas as $key => $value) {
				// print_array($value);
				if ($value['ID'] == $firma) {
					$firma = '<strong>'.$firmas[$key]['nombre'].'</strong><br />';
				}
			}
	
	
		}
		
		else
		
		{
	
			$firma = '<strong>'.$firmas[1]['nombre'].'</strong><br />';
	
		}
	}
//echo $firma;
	//Enable old connection
	global $connection;
	foreach ($leads_info as $lead_info) {

			//Sets dates and name for message fore it's saved to the database
			$cMessage = replace_editor_shorcuts($mensaje_op, $current_dates, $ciclo_esc, $lead_info['nombre'], $firma);
			// print_array($lead_info);
			//die;

			$lead_ID = $lead_info['ID'];
			
			// Get last interaction
			$last_interaction = get_last_interaction($lead_info['ID']);
		
					
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
						VALUES ('$tipo','$lead_ID', '$fecha', '$cMessage', '', '$comentarios')";
			$resultado = mysql_query($consulta, $connection);
			$lastId = mysql_insert_id();
			confirm_query($resultado);
			
			$configuracion = obten_configuracion();
			$tipo_estatus = utf8_encode($tipo);	
			actualiza_recordatorio($configuracion['temporada'], $tipo_estatus, $fecha, $lead_info['ID'], 0);
				
			// ------------------------------------------------------------ ------------//
			// ---------  Envío de emails a los interedados ----------------------------//
			// -------------------------------------------------------------------------//
			
			$cMessage = stripslashes( $cMessage ); // Luego de grabar el mensaje en la DB, elimina los "/" (slashes) insertados por KCEditor para que aparezcan las imágenes y agrega un salto de línea para que se vea bonito en el mail :)
			
			// -----------------------------------------------------------------//
			// ---------  SE PREPARA Y ENVÍA EL EMAIL AL ALUMNO  --------------//
			// ----------------------------------------------------------------//
					 
	
			$message = $cMessage;
	
			//Calling library and setting up credentials for Amazon SES
			require_once "lib/PHPMailer/PHPMailerAutoload.php";
			$host = "ssl://email-smtp.us-east-1.amazonaws.com";
			$port = "465";
			$username = "AKIAIXA2XV6TZOOCK5KQ";
			$password = "Amhgery5dXtVT2T1j+DrcewX8MUiWOkIWme8Mchskv5N";
			$to = $lead_info['email'];
			// $to = 'musinetwork@gmail.com';
			$to = 'hibamiru@gmail.com';
			$subject = $asunto;
		
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
			$message;
			
			$mail->setFrom('informacion@musinetwork.com', 'Musinetwork School of Music');		
			
			//Send the message and check for errors
			if (!$mail->send()) {
				echo "Mailer Error: " . $mail->ErrorInfo;
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


$data['leads_info'] = $leads_info;

$plantillas = get_custom_templates();

//print_array($data);
//Llamando una vista
view('componer-mensaje', compact('data', 'user', 'firmas', 'plantillas'));
