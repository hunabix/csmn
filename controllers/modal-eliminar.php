<?php
/*
* Controlador del modal Eliminar
*/

//echo $data['tipo-accion'];

//echo print_array($data);

// Deleting lead
$lead = array();
$con = db_con();
$query = $con->prepare('DELETE FROM interesado_cs WHERE ID = :id');

if ( $query->execute(array('id' => $data['lead-id'])) ) {

	//Returning lead ID
	$return['lead_id'] = $data['lead-id'];
	$return['tipo_accion'] = $data['tipo-accion'];
	$return['mensaje'] = 'Se eliminó el registro';
	echo json_encode($return, JSON_UNESCAPED_UNICODE);

}
$query->closeCursor();