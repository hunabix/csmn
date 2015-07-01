<?php
/*
* Controlador del modal Eliminar
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
$query = $con->prepare('DELETE FROM interesado_cs WHERE ID = :id');

//file_put_contents("tracker.log",print_r($lead_ids,true));

foreach ($lead_ids as $lead_id) {
	
	if ( $query->execute(array('id' => $lead_id)) ) {

		//Returning info for ajax request
		if ($data['formulario'] == 'leads-form') {	

			//Returning lead ID
			$return['lead_id'] = $lead_id;
			$return['tipo_accion'] = $data['tipo-accion'];
			$return['mensaje'] = 'Se eliminó el registro';
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