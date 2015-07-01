<?php
/*
* Controlador del modal Lista general
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
$query = $con->prepare('INSERT INTO interaccion_cs (tipo, id_interesado, fecha, observaciones) VALUES (:tipo, :id_interesado, :fecha, :observaciones)');

//file_put_contents("tracker.log",print_r($lead_ids,true));

foreach ($lead_ids as $lead_id) {

	// Get last interaction
	$last_interaction = get_last_interaction($lead_id);
	
	$lead_info = get_lead_info_by_id($lead_id);
	
	$new_status_date = date("Y-m-d H:i:s");

	// Register interaction
	if ($query->execute(array(
				'tipo' => 'Se ha agregado a la lista general',
				'id_interesado' => $lead_id,
				'fecha' => $new_status_date,
				'observaciones' => $data['comentario'],
			))) {
				
		//Get last inserted ID
		$lastId = $con->lastInsertId();
		
		//Unflag old last interaction and falg new last interaction
		update_last_interaction($last_interaction['ID'],$lastId);
		
		remove_from_main_list($lead_id);

		//Returning info for ajax request
		if ($data['formulario'] == 'leads-form') {
	
			//Returning lead ID
			$return['lead_id'] = $lead_id;
			$return['tipo_accion'] = $data['tipo-accion'];
			$return['mensaje'] = 'se movió a lista general';
			$return['nombre'] = $lead_info['nombre'];
			$return['apellidos'] = $lead_info['apellidos'];
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