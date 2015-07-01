<?php
/*
* Controlador del modal Recordatorio
*/

//echo $data['tipo-accion'];

//echo print_array($data);

//Initialize lead_ids
$lead_ids = array();

// Process lead ids
if ($data['formulario'] == 'leads-form') {
	$lead_ids[0] = $data['lead-id'];
}

if ($data['formulario'] == 'mag-form') {
	$lead_ids = extract_checkbox_ids($data);
}

// Prepare connection
$lead = array();
$con = db_con();

//file_put_contents("tracker.log",print_r($lead_ids,true));

foreach ($lead_ids as $lead_id) {
	
$query = $con->prepare('INSERT INTO interaccion_cs (tipo, id_interesado, fecha, observaciones) VALUES (:tipo, :id_interesado, :fecha, :observaciones)');

	// Get last interaction
	$last_interaction = get_last_interaction($lead_id);
	
	$lead_info = get_lead_info_by_id($lead_id);
	
	$date = date("Y-m-d H:i:s");
	
	// Register recordatorio
	if ($query->execute(array(
				'tipo' => 'Se agregó un recordatorio',
				'id_interesado' => $lead_id,
				'fecha' => $date,
				'observaciones' => $data['recordatorio'],
			))) {
				
		//Get last inserted ID
		$lastId = $con->lastInsertId();
		
		//Unflag old last interaction and falg new last interaction
		update_last_interaction($last_interaction['ID'],$lastId);
		
		// Update recordatorio_texto in interesado_cs
		$query = $con->prepare('UPDATE interesado_cs SET recordatorio = :recordatorio, recordatorio_texto = :recordatorio_texto WHERE ID = :ID');
		$query->execute(array(
			'recordatorio' => $data['fecha-recordatorio'],
			'recordatorio_texto' => $data['recordatorio'],
			'ID' => $lead_id,
		));

		//Returning info for ajax request
		if ($data['formulario'] == 'leads-form') {
					
			$fecha = fecha_en_array($data['fecha-recordatorio']);
			//Returning lead ID
			$return['lead_id'] = $lead_id;
			$return['tipo_accion'] = $data['tipo-accion'];
			$return['mensaje'] = 'Se agregó un recordatorio a';
			$return['nombre'] = $lead_info['nombre'];
			$return['apellidos'] = $lead_info['apellidos'];
			$return['recordatorio'] = $data['recordatorio'];
			$return['fecha_recordatorio'] = $fecha['dia'] . ' ' . $fecha['mes_texto_corto'];
			//echo print_array($return);
			echo json_encode($return, JSON_UNESCAPED_UNICODE);
			
		}
	
	}
	
}

if ($data['formulario'] == 'mag-form') {

	//Returning lead ID
	$return = TRUE;
	echo json_encode($return, JSON_UNESCAPED_UNICODE);

}

$query->closeCursor();